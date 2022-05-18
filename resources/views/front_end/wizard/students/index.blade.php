@extends('layouts.app')
@section('content')
<main>
    <!--========= Wizard Header  ======-->
        <div class="col-lg-8 mx-auto"></div>
            <div class="wizard-nav">
                <a href="order-food-online.html" class="menu-item active">
                    <img src="./images/student.png" alt="">
                    <span>Student Info</span>
                </a>
                <a href="choose-food.html" class="menu-item">
                    <img src="./images/food.png" alt="">
                    <span>Food Info</span>
                </a>
                <a href="confirm-order.html" class="menu-item confirm-order">
                    <img src="./images/confirm-order.png" alt="">
                    <span>Confirm Order</span>
                </a>
            </div>
        </div>
    <!--========= End : Wizard Header ======-->
    <div class="menu">
        <div class="wizard_menu"> 
            <!--========= Wizard Body  ======-->  
            <div class="col-lg-10   mx-auto">
                <div class="card option_card shadow-sm">
                    <div class="card-body p-0">
                        <div class="card-title">
                            Order Food Online
                        </div>
                        <form action="">
                            <div class="my-3 mb-4">
                                <h5>Choose the school</h5>
                                <label for="pay_fees_online" class="check-box">
                                    <div>
                                        <input type="radio" name="some" class="form-check-input" id="pay_fees_online">
                                    </div>
                                    <span>Amalorpavam Higher Secondary School (State Board)</span>
                                </label>
                                <label for="Order_Food_online" class="check-box">
                                    <div>
                                        <input type="radio" name="some" class="form-check-input" id="Order_Food_online">
                                    </div>
                                    <span>Amalorpavam Lourdes Academy (CBSE)</span>
                                </label>
                            </div>
                            <div class="my-3">
                                <h5>Enter Student Details</h5>
                                <div class="row">
                                    <div class="col-md-6 my-2">
                                        <span>Register Number / Application Number</span>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <input type="number" name="" class="form-control" placeholder="Type here ...">
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <span>Date Of Birth</span>
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <input type="date" name="" class="form-control">
                                    </div>
                                </div> 
                            </div>
                            <input type="submit" value="Submit" class="w-100 btn btn-primary">
                        </form>
                    </div>
                    <br>
                    <div class="card-body p-0">
                        <div class="card-title">
                            Student Info
                        </div>
                        <table class="table order-table">
                            <thead>
                                <tr>
                                    <th>Particular</th>
                                    <th></th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Student Name</th>
                                    <td>:</td>
                                    <td>P. Sam</td>
                                </tr>
                                <tr>
                                    <th>Register No</th>
                                    <td>:</td>
                                    <td>131300001</td>
                                </tr>
                                <tr>
                                    <th>Class</th>
                                    <td>:</td>
                                    <td>4 std</td>
                                </tr>
                                <tr>
                                    <th>Section</th>
                                    <td>:</td>
                                    <td>A sec</td>
                                </tr>
                                <tr>
                                    <th>Father Name</th>
                                    <td>:</td>
                                    <td>P. Prem</td>
                                </tr>
                                <tr>
                                    <th>Mother Name</th>
                                    <td>:</td>
                                    <td>Debora</td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="submit" value="Confirm" class="w-100 btn btn-primary">
                    </div>
                </div>
            </div>
            <!--========= End : Wizard Body  ======-->  

        </div>
    </div>
</main>
@endsection
