
@extends('admin.layouts.app')

@section('contentauth')
<style>
    .toggle-password {
		position: absolute;
		/* top: 17px; */
		right: 30px;
		cursor: pointer;
		z-index: 9999;
        margin-top: -26px;
	}
    .fixed-bottom, .fixed-top {
        left: 0;
        position: relative;
        right: 0;
        z-index: 1030;

    }
    footer
    {
        display:none;
    }
</style>

<div class="page-header min-vh-100" style="background:url({{url('public/img/profile_users.jpg')}})">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 d-flex flex-column mx-auto">
                <div class="card mt-5">
                    <div class="card-header pb-0 text-left bg-transparent">
                        <h3 class="font-weight-bolder text-info text-center">
                            <img src="https://datingapp.ciws.in/pictures/ISO G.png" width="80">
                        </h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.password.reset') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"
                                        style="font-size: 16px">@lang('auth.reset-email_address')</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"
                                        style="font-size: 16px">@lang('auth.reset-password')</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">
                                    <i class="fa fa-eye toggle-password" onclick="getsad('password', this)"
                                    style="position:absolute; right:20px; top:100%; transform:translateY(-50%); cursor:pointer;"></i>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style="font-size: 16px">@lang('auth.reset-confirm_password')</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                <i class="fa fa-eye toggle-password" onclick="getsad('password-confirm', this)"
                                        style="position:absolute; right:20px; top:100%; transform:translateY(-50%); cursor:pointer;"></i>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-danger">
                                    @lang('auth.reset-btn-reset-password')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script>
    function getsad(inputId, icon) {
        const input = document.getElementById(inputId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
@endsection