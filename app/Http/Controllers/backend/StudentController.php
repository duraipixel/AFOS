<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $title = 'Students';
        return view('backend.students.index', compact('title'));
    }

    public function import_students() {
        return view('backend.students.import');
    }   
}
