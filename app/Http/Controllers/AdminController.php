<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use App\Models\Feature;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendApproveProfile;
use App\Models\Feedback;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendTemporaryPassword;
use App\Mail\TestMail;
use App\Services\MercadoPagoService;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{
    use AuthenticatesUsers {
        login as protected traitLogin;
    }

    protected $mercadoPagoService;
    public function __construct(MercadoPagoService $mercadoPagoService)
    {
        $this->mercadoPagoService = $mercadoPagoService;
    }
    
    protected function guard()
    {
        return Auth::guard('admin'); 
    }


    public function login_form()
    {
       
        return view('admin.login-form');
    }

    use AuthenticatesUsers {
        login as protected traitLogin;
    }

    
    public function login_functionality(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->remember)) {
            // Authentication successful
            return redirect()->route('admin.dashboard'); // Redirect to the admin dashboard or another route
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }

    public function dashboard()
    {
        // dd(auth()->guard('admin')->user());
        
        $page_title="Admin Dashboard";
        return view('admin.dashboard',compact('page_title'));
    }

    public function logout(){
        
        Auth::guard('admin')->logout();
        return redirect()->route('login.form');
    }

    public function user_list(Request $request)
    {
        $page_title="User Management";
        return view('admin.users.user_list', compact('page_title'));
    }

    public function getuser(Request $request)
    {
        // Fetch DataTable request parameters
        $draw = $request->get('draw');
        $start = $request->get("start", 0);
        $rowperpage = $request->get("length", 10); // Rows per page
        $searchValue = $request->input('search.value', ''); // Search value

        $columnIndex = $request->input('order.0.column', 0); // Column index
        $columnName = $request->input("columns.$columnIndex.data", 'id'); // Column name
        $columnSortOrder = $request->input('order.0.dir', 'desc'); // Sort direction

        // Count total records
        $totalRecords = User::count();

        // Count records with filters
        $totalRecordswithFilter = User::where('name', 'like', '%' . $searchValue . '%')
            ->orWhere('email', 'like', '%' . $searchValue . '%')
            ->orWhere('phone', 'like', '%' . $searchValue . '%')
            ->orWhere('status', 'like', '%' . $searchValue . '%')
            ->count();

        // Fetch filtered and sorted records
        $records = User::where('name', 'like', '%' . $searchValue . '%')
            ->orWhere('email', 'like', '%' . $searchValue . '%')
            ->orWhere('phone', 'like', '%' . $searchValue . '%')
            ->orWhere('status', 'like', '%' . $searchValue . '%')
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        // Prepare response data
        $data_arr = [];
        $i = $start + 1;

        foreach ($records as $record) {
            $token = csrf_token(); // CSRF token for forms

            $approveStatus = ($record->status == 'approved')?'Approved':'Pending ';

            $rejectStatus = ($record->status == 'rejected')?'Rejected':'Reject  ';
            // Actions column
            $actions = '<div class="btn-group" role="group">';
            $actions .= '<form id="approveForm'.$record->id.'" action="' . route('admin.user_list.approve', $record->id) . '" method="get" style="display:inline;" onclick="confirmApproval('.$record->id.')">
                        ' . csrf_field() . '
                        <button type="button" class="btn btn-success btn-sm" style="border-radius: 0.5rem;">'.$approveStatus.'</button>
                    </form>';
                $actions .= '<form id="rejectForm'.$record->id.'" action="' . route('admin.user_list.reject', $record->id) . '" method="get" style="display:inline;" onclick="confirmRejection('.$record->id.')">
                            ' . csrf_field() . '
                            <button type="button" class="btn btn-danger btn-sm" style="border-radius: 0.5rem;">'.$rejectStatus.'</button>
                        </form>';
            $actions .= '<a href="' . route('admin.user_list.viewUser', $record->id) . '" class="btn bg-info btn-sm text-light" style="border-radius: 0.5rem;">View</a>';

            //reset password
           
            // Delete button
            $actions .= '<form id="deleteForm'.$record->id.'" action="' . route('admin.user_list.delete_user', $record->id) . '" method="POST" style="display:inline;" onclick="confirmDeletion('.$record->id.')">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger btn-sm" style="border-radius: 0.5rem;">Delete</button>
                    </form>';
            $actions .= '<form action="' . route('admin.sendTemporaryPassword', $record->id) . '" method="POST">' . csrf_field() . '
                <button type="submit" class="btn btn-warning btn-md" style="border-radius: 0.5rem;">
                    Reset Password
                </button>
            </form>';

            $actions .= '</div>';

            $data_arr[] = [
                "id" => $i++,
                "name" => ucfirst($record->like_to_be_called),
                "birthday" => date('d-m-Y', strtotime($record->birthday)),
                "email" => $record->email,
                "phone" => $record->phone,
                "created_at" => $record->created_at->format('d-m-Y H:i:s') ?? '',
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

    public function userApprove($id) {
        $user = User::findOrFail($id);
        if (!empty($user->verificationOption)) { 
            if ($user->verificationOption == "certificate") {
                if (is_null($user->employmentCertificate)) {
                    return back()->with('error', 'Failed to approve. User has not verified his employment status.');
                }
            } elseif ($user->verificationOption == "email") {
                if ($user->corporate_email_status == 0) {
                    return back()->with('error', 'Failed to approve. User has not verified his employment status.');
                }
            }
        } else {
            return back()->with('error', 'Failed to approve. User has not set any verification option.');
        }

        $user->status = 'approved';
        $user->save();
        
        if($user){
            $url = url('/login');
            if($user->is_subscribed == 1){
                if (!empty($user->local)) {
                    App::setLocale($user->local);
                }
                Mail::to($user->email)->send(new SendApproveProfile($user, $url));
                App::setLocale(config('app.locale'));
            }
            //Mail::to($data['email'])->send(new SendWelcomeEmail($user));
        }
        return back()->with('success', 'User approved successfully.');
    }
    
    public function userReject($id) {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();
    
        return back()->with('error', 'User rejected.');
    }

    public function userPermanentblock($id) {
        // $user = User::findOrFail($id);
        // $user->is_hidden = 1;
        // $user->save();
        $subscriptions = Subscription::findOrFail($id);
        $subscriptions->update(['renew_status' =>3]);
        return back()->with('success', 'User blocked successfully.');
    }

    public function activateRenewal($id) {
        // $user->status = 'activate-renewal';
        // $user->save();
    
        $subscriptions = Subscription::findOrFail($id);
        $subscriptions->update(['renew_status' =>1]);

        return back()->with('success', 'User renewal activated successfully.');
    }
    
    public function edit_user($id)
    {
        $page_title = "Edit User";
        $user = User::findOrFail($id);
        return view('admin.users.edit_user', compact('page_title', 'user'));
    }

    public function viewUser($id)
    {
        $page_title = "User Detail";
        $user = User::findOrFail($id);
        $pictures = $user->pictures()->latest()->get();
        $interestInData = [
            "Female"=>__('messages.profile_15_option1'),
            "Male"=>__('messages.profile_15_option2'),
            "Male-Male"=>__('messages.profile_15_option3'),
            "Female-Female"=>__('messages.profile_15_option4'),
            "Male-both"=>__('messages.profile_15_option5'),
            "Female-both"=>__('messages.profile_15_option6'),
        ];
        return view('admin.users.view_user', compact('page_title', 'user', 'pictures','interestInData'));
    }

    public function update_user(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            // Add other validations as needed
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.users.user_list')->with('success', 'User updated successfully.');
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $response = array('message' => 'User deleted successfully.','alert-type' => 'success');
        return redirect()->route('admin.user_list')->with( $response);
    }

    public function subscription()
    {
        $subscriptions = SubscriptionPlan::get();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function subscriptionList(Request $request)
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
        $totalRecords = SubscriptionPlan::count();

        // Count records with filters
        $totalRecordswithFilter = SubscriptionPlan::where('name', 'like', '%' . $searchValue . '%')->count();

        // Fetch filtered and sorted records
        $records = SubscriptionPlan::where('name', 'like', '%' . $searchValue . '%')
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        // Prepare response data
        $data_arr = [];
        $i = $start + 1;

        foreach ($records as $record) {
            $token = csrf_token();

            if($record->status == 1){
                $status ="Active";
            }elseif($record->status == 0){
                $status ="Inactive";
            }else{
                $status =""; 
            }
            // Actions column
            $actions = '<div class="btn-group" role="group">';
            $actions .= '<a href="' . route('admin.subscriptions.edit', $record->id) . '" class="btn bg-gradient-info btn-sm mx-2" style="border-radius: 0.5rem;">Edit</a>';
            
            $actions .= '
                    <form action="' . route('admin.subscriptions.destroy') . '" method="POST">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <input type="hidden" name="id" value="' . $record->id . '">
                        <button type="button" class="btn btn-danger btn-sm" style="border-radius: 0.5rem;" onclick="confirm_submit(this)">Delete</button>
                    </form>';

            $actions .= '</div>';

            $data_arr[] = [
                "id" => $i++,
                "name" => $record->name,
                "price" => $record->price,
                "duration" => $record->duration,
                "status" => $status,
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

    public function userSubscription()
    {
        $plans = SubscriptionPlan::get();
        $userSubscriptions = Subscription::get();
        return view('admin.user-membership.index', compact('userSubscriptions','plans'));
    }

    public function userSubscriptionList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start", 0);
        $rowperpage = $request->get("length", 10); 
        $searchValue = $request->input('search.value', '');

        $columnIndex = $request->input('order.0.column', 0);
        $columnName = $request->input("columns.$columnIndex.data", 'id');
        $columnSortOrder = $request->input('order.0.dir', 'asc'); 

        $totalRecords = Subscription::count();

        $totalRecordswithFilter = Subscription::whereHas('user', function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
            })
            ->orWhereHas('planDetail', function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
            })
            ->count();

        $records = Subscription::with(['user', 'planDetail'])
            ->whereHas('user', function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
            })
            ->orWhereHas('planDetail', function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
            })
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = [];
        $i = $start + 1;

       
        foreach ($records as $record) {
            $token = csrf_token();

            $actions = '<div class="btn-group" role="group">';
            $actions = '<div class="d-flex align-items-center">';

            if ($record->status == 'paused') {
                $actions .= '<form action="' . route('admin.subscription.pause') . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                <input type="hidden" name="subscription_id" value="' . $record->id . '">
                                <button type="submit" class="badge badge-secondary border-0 px-3 py-2">Paused</button>
                             </form>';
            } else {
                // $actions .= '<button type="button" class="badge badge-secondary border-0 px-3 py-2" data-bs-toggle="modal" data-bs-target="#subscriptionModal" data-subscription-id="' . $record->id . '">Pause</button>';
            
                $actions .= '<button type="button" class="badge badge-secondary border-0 px-3 py-2" onclick="confirmPause(' . $record->id . ')">Pause</button>';
            }
            
            //$actions .= '<button type="button" class="badge badge-primary mx-2 border-0 px-3 py-2" data-bs-toggle="modal" data-bs-target="#subscriptionModal-extend" data-subscription-extend-id="' . $record->id . '">Extend</button>';
            
            $actions .= '<button type="button" class="badge badge-primary mx-2 border-0 px-3 py-2"  onclick="confirmExtend(' . $record->id . ')">Extend</button>';
            
            if ($record->status == 'cancelled') {
                $actions .= '<button class="badge badge-danger border-0 px-3 py-2 mx-2">Cancelled</button>';
                $actions .= '<form id="reactive-form-' . $record->id . '" action="' . route('admin.subscription.reactiveSubscription') . '" method="POST" class="d-inline">
                            ' . csrf_field() . '
                            <input type="hidden" name="id" value="' . $record->id . '">
                            <button type="button" class="badge badge-success border-0 px-3 py-2" onclick="confirmReactive(' . $record->id . ')">Reactive</button>
                        </form>';
            } else {
                $actions .= '<form id="cancel-form-' . $record->id . '" action="' . route('admin.subscription.cancel') . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                <input type="hidden" name="id" value="' . $record->id . '">
                                <button type="button" class="badge badge-danger border-0 px-3 py-2" onclick="confirmCancel(' . $record->id . ')">Cancel</button>
                            </form>';
            }
            
            $actions .= '</div>';

            $data_arr[] = [
                "id" => $i++,
                "username" => $record->user->like_to_be_called,
                "email" => $record->user->email,
                "plan" =>  $record->planDetail->name,
                "price" => $this->mercadoPagoService->getPaymentAmount($record->payment_id) ?? $record->planDetail->price,
                "start_date" => Carbon::parse($record->start_date)->format('d-m-Y'),
                "end_date" =>  Carbon::parse($record->end_date)->format('d-m-Y'),
                "status" => $record->status,
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
    
    public function pauseSubscription(Request $request)
    {
        // $subscription = Subscription::findOrFail($request->id);
        // $subscription->status = 'paused';
        // $subscription->save();

        $subscription = Subscription::where('id', $request->subscription_id)->first();
        if($subscription->status == 'paused'){
                $subscription->update([
                    'status' => 'active',
                ]);
                return redirect()->back()->with('success', 'Subscription activated successfully.');
        }else{
            $request->validate([
                'paused_until' => 'nullable|date|after:today'
            ]);
            if ($subscription) {
                $pausedUntil = $request->paused_until ?? null;
                $subscription->update([
                    'status' => 'paused',
                    'paused_until' => $pausedUntil,
                ]);
                return redirect()->back()->with('success', 'Subscription paused successfully.');
            }
        }

        return redirect()->back()->with('error', 'Subscription pause process failed, Try again.');
    }

    public function extendSubscription(Request $request)
    {
        // $subscription = Subscription::findOrFail($request->id);
        
        // // Assuming you add 30 days to the end_date
        // $subscription->end_date = now()->addDays(30);
        // $subscription->save();
        $request->validate([
            'months' => 'required'
        ]);
 
        $subscription = Subscription::where('id', $request->subscription_id)->first();
        $plans = SubscriptionPlan::where('id',$request->months)->first();
       
        if ($subscription && $subscription->status === 'active') {
          
            $newDate = Carbon::parse($subscription->end_date)->addMonths($plans->duration);

            $subscription->update([
                'end_date' =>  $newDate,
            ]);
            return redirect()->back()->with('success', 'Subscription extended successfully.');
        }
        
        return redirect()->back()->with('error', 'Subscription extend process failed, Try again.');
    } 

    public function cancelSubscription(Request $request)
    {
        $subscription = Subscription::findOrFail($request->id);
        if($subscription) {
            $subscription->status = 'cancelled';
            $subscription->save();
            return redirect()->back()->with('success', 'Subscription cancelled successfully.');
        }

        return redirect()->back()->with('error', 'Subscription cancel process failed, Try again.');
    }

    public function reactiveSubscription(Request $request)
    {
        $subscription = Subscription::findOrFail($request->id);
        if($subscription) {
            $subscription->status = 'active';
            $subscription->save();
            return redirect()->back()->with('success', 'Subscription reactivated successfully.');
        }

        return redirect()->back()->with('error', 'Subscription cancel process failed, Try again.');
    }


    public function subscriptionCreate()
    {
        $subscriptions = [];
        $featuresAll = Feature::all();
        return view('admin.subscriptions.create',compact('subscriptions','featuresAll'));
    }

    public function subscriptionStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'features' => '',
            'status' => 'required',
        ]);
        
        SubscriptionPlan::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'features' => json_encode($request->features),
            'status' => $request->status,
        ]);

        $response = array('message' => 'Subscription Plan created successfully!','alert-type' => 'success');
        return redirect()->route('admin.subscriptions.index')->with($response);
    }

    public function subscriptionEdit($id)
    {
        $subscriptions = SubscriptionPlan::findOrFail($id);
        $featuresAll = Feature::all();
        return view('admin.subscriptions.edit', compact('subscriptions','featuresAll'));
    }

    public function subscriptionUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'features' => '',
            'status' => 'required',
        ]);

        $subscriptions = SubscriptionPlan::findOrFail($request->id);
        $subscriptions->update([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'features' => json_encode($request->features),
            'status' => $request->status,
        ]);

        $response = array('message' => 'Subscription Plan updated successfully!','alert-type' => 'success');

        return redirect()->route('admin.subscriptions.index')->with($response);
    }

    
    public function subscriptionDestroy(Request $request)
    {
        $subscriptionId = $request->input('id'); 

        if (!$subscriptionId) {
            return back()->with('error', 'Invalid request. No subscription ID provided.');
        }

        $subscription = SubscriptionPlan::find($subscriptionId);

        if ($subscription) {
            $subscription->delete();
            return back()->with('success', 'Subscription deleted successfully.');
        } else {
            return back()->with('error', 'Subscription not found.');
        }
    }

    public function subscriptionUpdateStatus(Request $request, $id)
    {
        $subscription = SubscriptionPlan::findOrFail($id);
        $subscription->update(['status' => $request->status]);

        return back();
    }

    public function reviewFeedback($id){
        if (!empty($id)) {
            $link = url("/admin/user/review-feedback/{$id}");

            DB::table('admin-notifications')
                ->where('link', $link)
                ->update(['read' => 1]);
        }
        $feedback = Feedback::where('id',$id)->first();
        return view('admin.users.review_feedback',compact('feedback'));
    }

    public function ReviewFeedbackstore(Request $request): JsonResponse
    {
                    
        $request->validate([
            'manners' => 'required|integer|between:1,5',
            'photogenic' => 'required|integer|between:1,5',
            'expressiveness' => 'required|integer|between:1,5',
            'opinions_ideas' => 'required|integer|between:1,5',
            'energy' => 'required|integer|between:1,5',
            'willingness' => 'required|integer|between:1,5',
            'attention' => 'required|integer|between:1,5',
            'sense_humer' => 'required|integer|between:1,5',
            'serious_relationship' => 'required',
            'not_connect' => 'nullable|string',
            'connect_person' => 'nullable|string',
            'compliment' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);
        try {
            $feedback=[];
        
            $feedbacks = Feedback::where('id', $request->feedbackId)->first();

            if($feedbacks){
                $respones= $feedbacks->update([
                    'manners' => $request->manners,
                    'photogenic' => $request->photogenic,
                    'expressiveness' => $request->expressiveness,
                    'opinions_ideas' => $request->opinions_ideas,
                    'energy' => $request->energy,
                    'attention' => $request->attention,
                    'sense_humer' => $request->sense_humer,
                    'serious_relationship' => $request->serious_relationship,
                    'not_connect' => $request->not_connect ?? null,
                    'connect_person' => $request->connect_person ?? null,
                    'compliment' => $request->compliment,
                    'willingness' => $request->willingness,
                ]);
            }
            return response()->json(['success' => true, 'message' => __('controllerText.FeedbackController_3'),'continue_meet' =>  ""]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('controllerText.FeedbackController_4'), 'error' => $e->getMessage()]);
        }
    }
    public function getChartData(Request $request)
    {

        $year = $request->input('year', Carbon::now()->year);

        $subscriptions = Subscription::select(
                DB::raw("COUNT(DISTINCT user_id) as count"),
                DB::raw("MONTH(created_at) as month")
            )
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->get();

        // Define labels for all 12 months
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = array_fill(0, 12, 0); // Initialize array with 12 zeros

        // Map subscription count to respective months
        foreach ($subscriptions as $subscription) {
            $data[$subscription->month - 1] = $subscription->count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'year' => $year
        ]);
    }  


    public function getMemberChartData(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $users = User::selectRaw('
                COUNT(*) as total_users,
                SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as total_pending_users,
                SUM(CASE WHEN status = "approved" THEN 1 ELSE 0 END) as total_approved_users,
                SUM(CASE WHEN status = "rejected" THEN 1 ELSE 0 END) as total_rejected_users,
                SUM(CASE WHEN status IS NULL THEN 1 ELSE 0 END) as total_incomplete_profile,
                SUM(CASE WHEN status = "blocked" THEN 1 ELSE 0 END) as total_blocked_profile
            ')
            ->first();

        // Define labels and assign data values dynamically
        $labels = ['Pending Profile', 'Approved Profile', 'Rejected Profile','Incomplete Profile', 'Blocked Profile'];
        $data = [
            $users->total_pending_users,
            $users->total_approved_users,
            $users->total_rejected_users,
            $users->total_incomplete_profile,
            $users->total_blocked_profile,
        ];

       $expectedCategories = [
            'Male',
            'Female',
            'Male-Male',
            'Female-Female',
            'Male-both',
            'Female-both'
        ];

        // Step 2: Get actual data from DB
        $usersData = User::selectRaw('interested_in, COUNT(*) as total_users')
            ->groupBy('interested_in')
            ->get()
            ->pluck('total_users', 'interested_in')
            ->toArray();

        // Step 3: Ensure all expected categories are included
        $formatted = [];
        foreach ($expectedCategories as $category) {
            $formatted[$category] = $usersData[$category] ?? 0;
        }

       
        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'totalUser' => $users->total_users,
            'totlUsersGender' => $formatted
        ]);     
    } 
    
    public function reviewFeedback_list(Request $request)
    {
        $page_title="Review Feedback List";
        return view('admin.users.review_feedback_list', compact('page_title'));
    }

    public function getreviewFeedback_list(Request $request)
    {
        // Fetch DataTable request parameters
        $draw = $request->get('draw');
        $start = $request->get("start", 0);
        $rowperpage = $request->get("length", 10); // Rows per page
        $searchValue = $request->input('search.value', ''); // Search value

        $columnIndex = $request->input('order.0.column', 0); // Column index

       
        $columnName = $request->input("columns.$columnIndex.data", 'id'); // Column name
        $columnSortOrder = $request->input('order.0.dir', 'desc'); // Sort direction

        $userId = auth()->guard('admin')->user()->id;
        // Count total records
        $totalRecords =  DB::table('admin-notifications')
                        ->join('admins', 'admin-notifications.admin_id', '=', 'admins.id')
                        ->select('admin-notifications.*', 'admin-notifications.created_at as senddate', 'admins.*')
                        ->where('admin-notifications.admin_id', $userId)
                        ->where('read', 0)
                        ->count();

        // Count records with filters
        $totalRecordswithFilter = DB::table('admin-notifications')
                        ->join('admins', 'admin-notifications.admin_id', '=', 'admins.id')
                        ->select('admin-notifications.*', 'admin-notifications.created_at as senddate', 'admins.*')
                        ->where('admin-notifications.admin_id', $userId)
                        ->where('read', 0)
                        ->count();

        // Fetch filtered and sorted records
        if ($columnName === 'created_at') {
            $columnName = 'admin-notifications.created_at';
        }

        $records = DB::table('admin-notifications')
            ->join('admins', 'admin-notifications.admin_id', '=', 'admins.id')
            ->select('admin-notifications.*', 'admins.*')
            ->where('admin-notifications.admin_id', $userId)
            ->where('read', 0)
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
            $action = '<div class="btn-group" role="group">';
            $action .= '<a href="' . $record->link . '" class="btn bg-info btn-sm text-light" style="border-radius: 0.5rem;">Review</a>';
            $action .= '</div>';
            $userName = getUserDetails($record->to_id);
            
            $data_arr[] = [
                "id" => $i++,
                "name" => ucfirst($userName->name).' '.$userName->last_name,
                "message" => $record->message,
                "created_at" => $record->updated_at,
                "action" => $action,
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

    public function getreviewedFeedback_list(Request $request)
    {
        // Fetch DataTable request parameters
        $draw = $request->get('draw');
        $start = $request->get("start", 0);
        $rowperpage = $request->get("length", 10); // Rows per page
        $searchValue = $request->input('search.value', ''); // Search value

        $columnIndex = $request->input('order.0.column', 0); // Column index

       
        $columnName = $request->input("columns.$columnIndex.data", 'id'); // Column name
        $columnSortOrder = $request->input('order.0.dir', 'desc'); // Sort direction

        $userId = auth()->guard('admin')->user()->id;
        // Count total records
        $totalRecords =  DB::table('admin-notifications')
                        ->join('admins', 'admin-notifications.admin_id', '=', 'admins.id')
                        ->select('admin-notifications.*', 'admin-notifications.created_at as senddate', 'admins.*')
                        ->where('admin-notifications.admin_id', $userId)
                        ->where('read', 1)
                        ->count();

        // Count records with filters
        $totalRecordswithFilter = DB::table('admin-notifications')
                        ->join('admins', 'admin-notifications.admin_id', '=', 'admins.id')
                        ->select('admin-notifications.*', 'admin-notifications.created_at as senddate', 'admins.*')
                        ->where('admin-notifications.admin_id', $userId)
                        ->where('read', 1)
                        ->count();

        // Fetch filtered and sorted records
        if ($columnName === 'created_at') {
            $columnName = 'admin-notifications.created_at';
        }

        $records = DB::table('admin-notifications')
            ->join('admins', 'admin-notifications.admin_id', '=', 'admins.id')
            ->select('admin-notifications.*', 'admins.*')
            ->where('admin-notifications.admin_id', $userId)
            ->where('read', 1)
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
            $action = '<div class="btn-group" role="group">';
            $action .= '<a href="' . $record->link . '" class="btn bg-info btn-lg text-light" style="border-radius: 0.5rem;">Resolved Feedback</a>';
            $action .= '</div>';
            $userName = getUserDetails($record->to_id);
            
            $data_arr[] = [
                "id" => $i++,
                "name" => ucfirst($userName->name).' '.$userName->last_name,
                "message" => $record->message,
                "created_at" => $record->updated_at,
                "action" => $action,
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

    public function sendTemporaryPassword($id)
    {
        $user = User::findOrFail($id);
        $tempPassword = Str::random(10);

        $user->password = Hash::make($tempPassword);
        $user->save();
        if (!empty($user->local)) {
            App::setLocale($user->local);
        }
        Mail::to($user->email)->send(new SendTemporaryPassword($user, $tempPassword));
        App::setLocale(config('app.locale'));
        return back()->with('success', 'Temporary password sent to user\'s email.');
    }
}