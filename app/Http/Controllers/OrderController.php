<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Product;
use App\Models\Institution;
use Validator;
use Auth;

class OrderController extends Controller
{
    public function index()
    {
        $institution = Institution::all();
        $info = '';
        if(session()->get('order') ) {
            $session = session()->get('order');
            if( isset($session['student_id'])){
                $info = Student::find($session['student_id']);
            }
        }
        return view('front_end.wizard.students.index', compact('institution', 'info'));
    }

    public function get_food_info() {
        $product_info = Product::all();
        return view('front_end.wizard.food.index', compact('product_info'));
    }

    public function order_info(Request $request ) {
        if( session()->get('order')) {
            $session = session()->get('order');
            // dd( $session );
            $student_id = $session['student_id'];
            $product_id = $session['product_id'];
            $info = Student::find($student_id);
            $items = Product::whereIn('id', $product_id)->get();
            return view('front_end.wizard.confirm.index', compact('info', 'items'));
        } else {
            abort(404);
        }
    }

    public function confirmation() {
        return view( 'front_end.wizard.confirmation');
    }

    public function check_student(Request $request) {
        
        $institute = $request->institute;
        $register_no = $request->register_no;
        $dob = $request->dob;
        $info = Student::where('register_no', $register_no)->where('institute_id', $institute)->where('dob', $dob)->first();
        if( isset( $info ) && !empty($info)) {
            $id = $info->id;
            $error = 0;
        } else {
            $error = 1;
            $id = '';
        }
        $response = array('error' => $error, 'id' => $id );
        return $response;
    }

    public function student_list(Request $request) {
        $student_id = $request->student_id;

        $info = Student::find($student_id);
        return view('front_end.wizard.students.info', compact('info'));
    }

    public function initialize_order(Request $request) {
        
        $id = $request->id;

        $info = Student::find($id);
        if( session()->get('order')) {
            $session = session()->get('order');
        }
        $session['student_id'] = $id;
        session()->put('order', $session);
        echo 1;
    }

    public function change_student(Request $request) {
        session()->forget('order');
        echo 1;
    }

    public function select_food(Request $request) {

        $validator = Validator::make($request->all(), [
            'food' => 'required',
        ]);

        if ($validator->passes()) {
            
            if( session()->get('order')) {
                $session = session()->get('order');
            }
            $session['product_id'] = $request->food;
            session()->put('order', $session);

            $error = 0;
            $message = '';
        } else {
            $error = 1;
            $message = $validator->errors()->all();
        }
        return response()->json(['error'=> $error, 'message' => $message]);
    }

    public function delete_food(Request $request) {
        $item_id = $request->item_id;
        $view = '';
        if( session()->get('order')) {
            $session = session()->get('order');
            $order_items = $session['product_id'];

            if( count($order_items) <= 1 ) {
                $error = 1;
                $message = 'You cannot delete food, atleast have one food';
            } else {
                if( isset( $order_items ) && !empty( $order_items ) ) {
                    $key = array_search($item_id, $order_items);
                    unset($order_items[$key]);
    
                    $session['product_id'] = $order_items;
                    session()->put('order', $session);
                    $items = Product::whereIn('id', $order_items)->get();
                    $error = 0;
                    $message = '';
                    $view = view('front_end.wizard.confirm._order_info', compact('items'));
                }
            }
            $response = array('error' => $error, 'message' => $message, 'view' => $view );
            return $response;
        } 
        abort(404);
    } 

    public function order_list(Request $request) {
        if( session()->get('order')) {
            $session = session()->get('order');
            $order_items = $session['product_id'];
            $items = Product::whereIn('id', $order_items)->get();
            
            return view('front_end.wizard.confirm._order_info', compact('items'));
        }
        abort(404);
    }

    public function confirm_payment(Request $request) {
        
    }
}
