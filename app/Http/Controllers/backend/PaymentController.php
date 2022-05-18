<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $title = 'Payments';
        return view('backend.payments.index', compact('title'));
    }
}
