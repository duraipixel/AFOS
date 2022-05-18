<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $title = 'Product Category';
        return view('backend.productcategory.index', compact('title'));
    }

    public function add_edit_modal(Request $request) {
        $title = 'Add Product Category';
        return view('backend.productcategory.add_edit', compact('title'));
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
