@extends('layouts.app')

@section('content')
    <style>
        body {
            background-image: url('{{ asset('public/img/bgdating.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        body:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #00000057;
            z-index: -1;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="margin-top: 40%;">
                    <p class="text-center p-2" style="color: white;font-size: 20px;font-weight: bolder;background: #595959;">@lang('auth.email-reset_password')</p>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                

                                <div class="col-md-12">
                                <label for="email" class="col-form-label "
                                       style="font-size: 16px">@lang('auth.email-email_address')</label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success w-100">
                                    @lang('auth.email-send_password')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
