<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    // List all features
    public function index()
    {
        $features = Feature::get();
        return view('admin.subscriptions.features.index', compact('features'));
    }

    public function getFeatures(Request $request)
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
        $totalRecords = Feature::count();

        // Count records with filters
        $totalRecordswithFilter = Feature::where('name', 'like', '%' . $searchValue . '%')->count();

        // Fetch filtered and sorted records
        $records = Feature::where('name', 'like', '%' . $searchValue . '%')
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
            $actions .= '<a href="' . route('admin.features.edit', $record->id) . '" class="btn bg-gradient-info btn-sm mx-2" style="border-radius: 0.5rem;">Edit</a>';
            
            $actions .= '
                    <form action="' . route('admin.features.destroy', $record->id) . '" method="POST">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger btn-sm" style="border-radius: 0.5rem;" onclick="confirm_submit(this)">Delete</button>
                    </form>';

            $actions .= '</div>';

            $data_arr[] = [
                "id" => $i++,
                "name" => $record->name,
                "description" => $record->description,
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

    // Show the form to create a new feature
    public function create()
    {
        return view('admin.subscriptions.features.create');
    }

    // Store a new feature
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Feature::create($request->all());
        $response = array('message' => 'Feature created successfully!','alert-type' => 'success');
        return redirect()->route('admin.features.index')->with($response);
    }

    // Show the form to edit a feature
    public function edit(Feature $feature)
    {
        return view('admin.subscriptions.features.edit', compact('feature'));
    }

    // Update a feature
    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $feature->update($request->all());

        $response = array('message' => 'Feature updated successfully!','alert-type' => 'success');
        return redirect()->route('admin.features.index')->with($response);
    }

    // Delete a feature
    public function destroy(Feature $feature)
    {
        $feature->delete();
        $response = array('message' => 'Feature deleted successfully!','alert-type' => 'success');
        return redirect()->route('admin.features.index')->with($response);
    }
}
