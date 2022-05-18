<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Products';
        return view('backend.products.index', compact('title'));
    }

    public function add_edit_modal(Request $request) {
        $title = 'Add Product';
        return view('backend.products.add_edit', compact('title'));
    }

    public function save_role(Request $request) {
        $response  = array( 'error' => '0', 'message' => 'Added successfully');
        return response()->json($response);

    }

    public function delete_role(Request $request) {
        $id = $request->id;
        echo 1;
    }
}
