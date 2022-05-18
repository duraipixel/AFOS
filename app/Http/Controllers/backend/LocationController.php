<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Validator;
use Auth;
use DataTables;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Locations';
        if ($request->ajax()) {
            $data = Location::all();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0);" class="action-icon" onclick="return view_location('.$row->id.')"> <i class="mdi mdi-eye-outline"></i></a>
                    <a href="javascript:void(0);" class="action-icon" onclick="return add_modal('.$row->id.')"> <i class="mdi mdi-square-edit-outline"></i></a>
                    <a href="javascript:void(0);" class="action-icon" onclick="return delete_location('.$row->id.')"> <i class="mdi mdi-delete"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.location.index', compact('title'));
    }

    public function ajax_list(Request $request) {
        if ($request->ajax()) {
            $data = Location::select('id', 'location_name', 'address', 'status')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                    <a href="javascript:void(0);" class="action-icon" onclick="return delete_user(1)"> <i class="mdi mdi-delete"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function add_edit_modal(Request $request) {
        $title = 'Add Locations';
        $id = $request->id;
        $info = '';
        if( isset( $id ) && !empty( $id ) ) {
            $info = Location::find($id);
        }
        return view('backend.location.add_edit', compact('title', 'info', 'id'));
    }

    public function save(Request $request) {
        $id = $request->id;
        
        $validator = Validator::make($request->all(), [
            'location_name' => 'required|unique:locations,location_name,'.$id,
        ]);
        if ($validator->passes()) {
            $ins['location_name'] = $request->location_name;
            $ins['address'] = $request->description;
            $ins['status'] = 1;
            $info = Location::updateOrCreate(['id' => $id],$ins);
            
            $error = 0;
            $message = (isset($id) && !empty($id)) ? 'Updated Successfully' :'Added successfully';
        } else {
            $error = 1;
            $message = $validator->errors()->all();
        }
        return response()->json(['error'=> $error, 'message' => $message]);

    }

    public function delete(Request $request) {
        $id = $request->id;

        $info = Location::find($id);
        $info->delete();
        echo 1;
    }
}
