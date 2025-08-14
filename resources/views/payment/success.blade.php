@extends('layouts.app')
@section('content')

<style>
    ._failed{ border-bottom: solid 4px red !important; }
    ._failed i{  color:red !important;  }

    ._success {
        box-shadow: 0 15px 25px #00000019;
        padding: 45px;
        width: 100%;
        text-align: center;
        margin: 40px auto;
        border-bottom: solid 4px #28a745;
    }

    ._success i {
        font-size: 55px;
        color: #28a745;
    }

    ._success h2 {
        margin-bottom: 12px;
        font-size: 40px;
        font-weight: 500;
        line-height: 1.2;
        margin-top: 10px;
    }

    ._success p {
        margin-bottom: 0px;
        font-size: 18px;
        color: #495057;
        font-weight: 500;
    }
</style>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="message-box _success">
                     <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <h2> @lang('messages.payment_success_1')</h2>
                   <p> @lang('messages.payment_success_2') <br> @lang('messages.payment_success_3') </p>
                   <a href="{{route('profile.edit')}}" class="btn btn-outline mb-3 btn-primary btn-pay p-0 mx-5 my-3 py-2 px-5">@lang('messages.payment_success_4')</a>      
            </div> 
        </div> 
    </div> 
</div>

<script>
    setTimeout(function() {
        window.location.href = "{{ route('profile.edit') }}";
    }, 2000);
</script>
@endsection
