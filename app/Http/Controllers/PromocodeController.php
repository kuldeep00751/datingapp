<?php

namespace App\Http\Controllers;

use App\Models\Promocode;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;

class PromocodeController extends Controller
{
    public function index()
    {
        $promoCode = Promocode::get();
        $users = User::get();
        return view('admin.subscriptions.promocode.index', compact('promoCode','users'));
    }

    // Show the form to create a new feature
    public function create()
    {
        return view('admin.subscriptions.promocode.create');
    }

    // Store a new feature
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
            'expires_at' => 'required',
            'duration' => 'required',
        ]);

        Promocode::create($request->all());
        $response = array('message' => 'Promo code created successfully!','alert-type' => 'success');
        return redirect()->route('admin.promocode.index')->with($response);
    }

    // Show the form to edit a feature
    public function edit(Promocode $promocode)
    {
        return view('admin.subscriptions.promocode.edit', compact('promocode'));
    }

    // Update a feature
    public function update(Request $request, Promocode $promocode)
    {
        $request->validate([
            'code' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
            'expires_at' => 'required',
            'duration' => 'required',
        ]);

        $promocode->update($request->all());

        $response = array('message' => 'Promo code updated successfully!','alert-type' => 'success');
        return redirect()->route('admin.promocode.index')->with($response);
    }

    // Delete a feature
    public function destroy(Promocode $promocode)
    {
        $promocode->delete();
        $response = array('message' => 'Promo code deleted successfully!','alert-type' => 'success');
        return redirect()->route('admin.promocode.index')->with($response);
    }


    public function getPromocode(Request $request)
    {
        // Fetch DataTable request parameters
        $draw = $request->get('draw');
        $start = $request->get("start", 0);
        $rowperpage = $request->get("length", 10); // Rows per page
        $searchValue = $request->input('search.value', ''); // Search value

        $columnIndex = $request->input('order.0.column', 0); // Column index
        $columnName = $request->input("columns.$columnIndex.data", 'id'); // Column name
        $columnSortOrder = $request->input('order.0.dir', 'asc'); // Sort direction

        // Count total records
        $totalRecords = Promocode::count();

        // Count records with filters
        $totalRecordswithFilter = Promocode::where('code', 'like', '%' . $searchValue . '%')->count();

        // Fetch filtered and sorted records
        $records = Promocode::where('code', 'like', '%' . $searchValue . '%')
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        // Prepare response data
        $data_arr = [];
        $i = $start + 1;

        foreach ($records as $record) {
            $token = csrf_token();

            // Actions column
            $actions = '<div class="btn-group" role="group">';
            $actions .= '<a href="' . route('admin.promocode.edit', $record->id) . '" class="btn bg-gradient-info btn-sm mx-2" style="border-radius: 0.5rem;">Edit</a>';
            
            $actions .= '
                    <form action="' . route('admin.promocode.destroy', $record->id) . '" method="POST">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger btn-sm" style="border-radius: 0.5rem;" onclick="confirm_submit(this)">Delete</button>
                    </form>';
            // $actions .= '<button class="btn bg-gradient-success btn-sm mx-2" onclick="openEmailPopup(\'' . $record->code . '\')">Send Promo Email</button>';

            $actions .= '</div>';

            $data_arr[] = [
                "id" => $i++,
                "code" => $record->code,
                "discount_type" => $record->discount_type,
                "discount" => $record->discount,
                "expires_at" => $record->expires_at ? $record->expires_at->format('d-m-y') : null,
                "duration" => $record->duration,
                "action" => $actions,
            ];
        }

        // Prepare the response
        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        ];

        return response()->json($response);
    }

    public function apply(Request $request)
    {
        
        $request->validate([
            'code' => 'required|string',
        ]);

        $promocode = Promocode::where('code', $request->code)->first();
        $plans = SubscriptionPlan::findorfail($request->subscriptionPackage);

        if($promocode->duration != $plans->duration){
            return response()->json(['message' => 'This Promo Code Cannot Be Applied to the Selected Membership.'], 404);
        }

        if (!$promocode) {
            return response()->json(['message' => 'Invalid promocode.'], 404);
        }

        if (!$promocode->isValid()) {
            return response()->json(['message' => 'Promocode expired.'], 400);
        }

        session([
            'applied_promocode' => $promocode->code,
            'discount_type' => $promocode->discount_type,
            'discount' => $promocode->discount,
        ]);

        return response()->json([
            'message' => 'Promocode applied successfully!',
            'discount' => $promocode->discount,
        ]);
    }

    public function sendPromoEmail(Request $request)
    {
        $request->validate([
            'users' => 'required|array',
            'promo_code' => 'required|string'
        ]);

        $users = User::whereIn('id', $request->users)->get();

        foreach ($users as $user) {
            if (!empty($user->local)) {
                App::setLocale($user->local);
            }
            Mail::to($user->email)->send(new \App\Mail\PromoCodeMail($user, $request->promo_code));
            App::setLocale(config('app.locale'));
        }

        return response()->json(['success' => true]);
    }
}
