<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Users';
        return view('backend.user.index', compact('title'));
    }

    public function add_edit_modal(Request $request) {
        $title = 'Add Users';
        return view('backend.user.add_edit', compact('title'));
    }

    public function save_users(Request $request) {
        $response  = array( 'error' => '0', 'message' => 'Added successfully');
        return response()->json($response);

    }

    public function delete_users(Request $request) {
        $id = $request->id;
        echo 1;
    }
}
