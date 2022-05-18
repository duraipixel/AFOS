<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function location_wise_report(Request $request) {
        return view('backend.reports.index');
    }
}
