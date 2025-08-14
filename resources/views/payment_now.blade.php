@extends('layouts.app')

@section('content')

@php

session()->forget(['applied_promocode', 'discount','discount_type']);

@endphp

<style>

.title-p2

{

    font-size: 46px;

    font-family: 'AvenirNext';

    font-weight: bold;

    color: #a1a1a1;

}

.box-337

{

    padding: 0px 60px;

}

.box-337 .content-21

{

    font-size: 25px; 

    font-family: 'AvenirNext'; 

    font-weight: 400;   

}

.box-337 .form-label

{

    font-size: 40px;

    font-family: 'AvenirNext';

    font-style: italic;

    color: #000;

    font-weight: 600;

}

.box-337 #applyPromocodeBtn

{

    background: #990099;

    border-color: #990099;

    color: #fff;

    font-size: 40px;

    font-style: italic;

    padding: 10px 30px;

}

.box-337 #promocode

{

    height: 85px; 

    font-size: 30px;

}

.btnshowing-34 

{

    background: linear-gradient(to right, #8ffcff, #00aaff);

    padding: 10px 40px;

    font-size: 1.5rem;

    border-radius: 0;

    width: 100%;

    max-width: 700px;

}

.payment-324

{

    border: 1px solid #ccc;

    margin: 26px;

    padding: 0px;

}

.card-footer {

    position: relative;

    padding: 0px 0px 0px 60px;

    background: #fff;

    border: none;

    margin-top: 4%;



}

.card-footer::before {

    content: "";

    position: absolute;

    left: -1px;

    top: 13px;

    width: 100%;

    height: 87%;

    background-image: url("{{ asset('pictures/bg123.png') }}"); /* <-- Replace with your image path */

    background-size: contain;

    background-repeat: no-repeat;

}

@media(max-width : 786px)

{

    .title-p2

    { 

        font-size: 18px;  

    } 

    .box-337

    {

        padding: 0px 10px;

    } 

    .box-337 .content-21

    {

        font-size: 18px; 

    }

    .box-337 .form-label

    {

        font-size: 22px;

    }

    .box-337 #applyPromocodeBtn

    {

        font-size: 18px;

        padding: 0px 10px;

    }

    .box-337 #promocode 

    {

        height: 45px;

        font-size: 20px;

    }

    .btnshowing-34 

    {

               padding: 9px 39px;
        font-size: 18px;
        height: 44px;

    }

    .card-footer {

        position: relative;

        padding: 0px 0px 0px 100px;

        background: #fff;

        border: none;

        margin-top: 4%;

    }

    .card-footer::before 

    {

    content: "";

    position: absolute;

    left: -1px;

    top: 6px !important;

    width: 100%;

    height: 87%;

    background-image: url(https://datingapp.ciws.in/pictures/bg123.png);

    background-size: 19% !important;

    background-repeat: no-repeat;

    }

    .payment-324

    {

    border: 1px solid #ccc;

    margin: 10px;

    padding: 0px;

    }
     .img-3456 {
           right: 2rem !important;
        width: 6% !important;
        position: absolute !important;
        top: 11px;
        display: block !important;
}



}



@media(max-width : 585px)

{

    .card-footer {

        position: relative;

        padding: 0px 0px 0px 75px;

        background: #fff;

        border: none;

        margin-top: 4%;

    }

}

@media(max-width : 320px)

{

    .card-footer {

        position: relative;

        padding: 0px 0px 0px 40px;

        background: #fff;

        border: none;

        margin-top: 4%;

    }

  

}

</style>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class=d-flex justify-content-center align-items-center">

                <div class="card shadow-lg" >

                    <!-- <div class="card-header bg-info text-white text-center">

                        <h2>@lang('messages.payment_now_1')</h2>

                    </div> -->

                    <div class="card-body text-center payment-324" >

                        <!-- <p class="lead text-muted">@lang('messages.payment_now_2')</p> -->



                        <div class="mb-4 ">

                            <img src="{{ asset('pictures/bg-mm1234.png') }}" alt="Payment Illustration" class="img-fluid w-100">

                            <p class="mb-4 title-p2">

                            @lang('messages.payment_now_01')

                            </p>

                        

                            <img src="{{ asset('pictures/bg-mm12345.png') }}" alt="Payment Illustration" class="img-fluid w-100">

                        </div>

                        <div class="box-337">

                        <p class="mb-4 content-21">@lang('messages.payment_now_02')</p>

                        <hr>

                        <div class="mb-3 px-md-5 px-3 text-start">

                            <!-- <label for="promocode" class="form-label">@lang('messages.payment_promo1')</label> -->

                            <label for="promocode" class="form-label" > @lang('messages.payment_now_03')</label> 

                            <div class="input-group">

                                <input type="text" id="promocode" class="form-control rounded-0" >

                                <input type="hidden" id="subscriptionPackage" value="{{ subscriptionPlan($planId)->id }}">

                                <button id="applyPromocodeBtn" class="btn  rounded-0 ms-2" >

                                    @lang('messages.payment_promo3')

                                </button>

                            </div>

                        </div>



                        <div id="promocode-feedback" class="mt-2 text-success mb-2 text-start" style="display: none;"></div>



                            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3 position-relative px-3">

                                <a href="{{ route('payment.checkout', ['id' => subscriptionPlan($planId)->id]) }}"

                                class="btn btn-lg text-white fw-bold fst-italic text-center btnshowing-34">

                                    @lang('messages.payment_now_4')

                                </a>



                                <img src="{{ asset('pictures/lock-img.png') }}"

                                    alt="Payment Illustration"

                                    class="position-absolute d-none d-md-block img-3456"

                                    style="right: 8rem; width: 5%;">

                            </div>

                        <p class="w-100" style=" font-size: 26px; font-family: 'AvenirNext'; font-style: italic;">@lang('messages.payment_now_04')</p>

                        <hr>

                        <a href="" class="mb-2" style=" font-size: 28px; color: #000; font-family: 'Nunito'; font-weight: bold; ">

                            @lang('messages.payment_now_05')

                            </a> 

                    </div> 

                    <div class="card-footer text-left">

                        <!-- <small>@lang('messages.payment_now_6') <a href="#">@lang('messages.payment_now_7')</a>.</small> -->

                        <img src="{{ asset('pictures/bg243.png') }}" alt="Payment Illustration" class="img-fluid w-25">

                        <p class="w-100" style="font-size: 12px;font-weight: bold;">

                            @lang('messages.payment_now_06')

                        </p>

                        

                    </div> 

                </div>

            </div>

        </div>    

    </div>

</div>

<script>

    document.getElementById('applyPromocodeBtn').addEventListener('click', function () {

        const code = document.getElementById('promocode').value;

        const subscriptionPackage = document.getElementById('subscriptionPackage').value;

        

        const feedback = document.getElementById('promocode-feedback');

        

        if (!code) {

            feedback.style.display = 'block';

            feedback.classList.remove('text-success');

            feedback.classList.add('text-danger');

            feedback.innerText = 'Please enter a promocode.';

            return;

        }



        fetch('{{ route("promocode.apply") }}', {

            method: 'POST',

            headers: {

                'Content-Type': 'application/json',

                'X-CSRF-TOKEN': '{{ csrf_token() }}'

            },

            body: JSON.stringify({ 

                code: code,

                subscriptionPackage: subscriptionPackage,

            })

        })

        .then(res => res.json())

        .then(data => {

            if (data.discount) {

                feedback.style.display = 'block';

                feedback.classList.remove('text-danger');

                feedback.classList.add('text-success');

                feedback.innerText = `Promocode applied!`;

            } else {

                throw new Error(data.message || 'Failed to apply promocode.');

            }

        })

        .catch(err => {

            feedback.style.display = 'block';

            feedback.classList.remove('text-success');

            feedback.classList.add('text-danger');

            feedback.innerText = err.message;

        });

    });

</script>

@endsection



