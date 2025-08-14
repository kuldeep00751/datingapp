@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset("pictures/Background2.jpg") }}') no-repeat center center fixed;
        background-size: cover;
    }

    .overlay-dark {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(6px);
        z-index: -1;
    }

    .approval-card {
        background-color: rgba(0, 0, 0, 0.35);
        border: 1px solid #ccc;
        color: white;
        padding: 40px 30px;
        border-radius: 8px;
        backdrop-filter: blur(2px);
    }

    .card-header {
        border-bottom: none;
    }

    .card-title {
        font-weight: 400;
        font-size: 1.5rem;
    }

    .approval-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .approval-logo img {
        content: "";
            background-size: contain;
            background-repeat: no-repeat;
            position: absolute;
            /* width: 50%; */
            height: 10rem;
            top: 0;
            left: 35%; /* Use 50% + translateX for proper centering */
            transform: translateX(-50%);
            z-index: 1; /* Ensure it's visible */
    }

    .approval-logo span {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .alert-info {
        background-color: rgba(255, 255, 255, 0.15);
        color: #e6f0ff;
        border-left: 5px solid #17a2b8;
    }
</style>

<div class="overlay-dark"></div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="approval-card shadow text-center">
                <div class="approval-logo">
                    <img src="{{ asset('pictures/LOGO-H-W1.png') }}" alt="Silverbridge Logo">
                </div>
                <h3 class="card-title" style="margin-top: 9rem;">@lang('messages.approval_pending_1') ⏳</h3>
                <p class="mt-4">@lang('messages.approval_pending_2')</p>
                <div class="alert alert-info mt-4" role="alert">
                    <strong>@lang('messages.approval_pending_3')</strong>
                    @lang('messages.approval_pending_4')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


