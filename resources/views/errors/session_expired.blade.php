@extends('layouts.app')
@section('content')
    <style>
    ._failed{ border-bottom: solid 4px red !important; }
    ._failed i{  color:red !important;  }

    ._warning {
        box-shadow: 0 15px 25px #00000019;
        padding: 45px;
        width: 100%;
        text-align: center;
        margin: 40px auto;
        border-bottom: solid 4px #e6e628;
    }

    ._warning i {
        font-size: 55px;
        color: #e6e628;
    }

    ._warning h2 {
        margin-bottom: 12px;
        font-size: 40px;
        font-weight: 500;
        line-height: 1.2;
        margin-top: 10px;
    }

    ._warning p {
        margin-bottom: 0px;
        font-size: 18px;
        color: #495057;
        font-weight: 500;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="message-box _warning ">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                <h2>Sorry</h2>
                <p>The Silverbridge web expired due to inactivity, please log in again to continue.</p> 
                <a href="{{ route('login') }}" class="btn btn-outline mb-3 btn-primary btn-pay p-0 mx-5 my-3 py-2 px-5">Login</a>
        </div> 
    </div> 
</div>
@endsection
