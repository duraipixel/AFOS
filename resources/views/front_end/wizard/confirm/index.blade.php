@extends('front_end.wizard.index')
@section('wizard_content')
<div class="wizard_menu col-lg-10 mx-auto"> 
    <!--========= Wizard Body  ======-->  
    <div class="col-lg-10 mx-auto ">
        <div class="card option_card shadow-sm ">
            <div class="card-body p-0">
                <div class="card-title">
                    Your Order
                </div> 
                <div id="order_info">
                    @include('front_end.wizard.confirm._order_info')
                </div>
                <div class="card-body mb-5 p-0" >
                    @include('front_end.wizard.common._student_info')
                </div>
                <form id="payment_form" method="POST" action="{{ route('confirm.food.payment')}}" >
                    @csrf
                    <div>
                        @include('front_end.wizard.confirm._payee_form')
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('online.food') }}" class="px-3 btn btn-light border shadow-sm">Prev</a>
                        <a href="#" class="px-3 btn btn-primary float-end">Confirm Payment</a>
                    </div>
                </form>
            </div> 
        </div>
    </div>
    <!--========= End : Wizard Body  ======-->  
</div>
<script>

    $('#payee_name').keyup(function(){
        var cur = $(this).val();
        if( $(this).hasClass('error') ) {
            if( cur.length > 0 ) {
                $('#payee_name').removeClass('error');
            }
        }
    })

    $('#mobile_no').keyup(function(){
        var cur = $(this).val();
        if( $(this).hasClass('error') ) {
            if( cur.length > 0 ) {
                $('#mobile_no').removeClass('error');
            }
        }
    })
    

    $("#payment_form").click(function() {
        var payee_name = $('#payee_name').val();
        var mobile_no = $('#mobile_no').val();

        if( payee_name == undefined || payee_name == '' || payee_name == null ){
            $('#payee_name').addClass('error');
            error = true;
        } else {
            $('#payee_name').removeClass('error');
        }

        if( mobile_no == undefined || mobile_no == '' || mobile_no == null ){
            $('#mobile_no').addClass('error');
            error = true;
        } else {
            $('#mobile_no').removeClass('error');
        }
        if( error ) {
            return false;
        }
        var form = $('#payment_form')
        var formData = form.serialize();
        $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        beforeSend:function(){
            $('#select_food').attr('disabled', true);
        },
        success: function(response) {
            $('#select_food').attr('disabled', false);
            
            if( response.error == 1 ){
                $('#error_msg').show();
                $('#error_msg').html('Atleast one food need to select');
                $('#error_msg').fadeOut(5000);
            } else {
                window.location.href="{{ route('confirm.order') }}";
            }
        }            
        });		

    });
</script>
@endsection
