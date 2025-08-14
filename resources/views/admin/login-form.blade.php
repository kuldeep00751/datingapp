
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
            <div class="col-xl-4 col-lg-4 col-md-5 d-flex flex-column mx-auto">
            <div class="card mt-5">
                <div class="card-header pb-0 text-left bg-transparent">
                    <h3 class="font-weight-bolder text-info text-center">
                        <img src="https://datingapp.ciws.in/pictures/ISO G.png" width="80">
                    </h3>
                </div>
                <div class="card-body">
                
                <form method="POST" action="{{ route('login.functionality') }}" id="LoginForm">
                    @csrf                   
                    <label>Email</label>
                    <div class="mb-3">
                   
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                  
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                                        </div>
                    <label>Password</label>
                    <div class="mb-3">
                   
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        <i class="toggle-password fa fa-eye" onclick="getsad('password');"></i>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check ">
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label " for="rememberMe">
                        {{ __('Remember Me') }}
                    </label>
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                    </div>
                    <div class="text-end mt-2">
                        <a href="{{ route('admin.forgot.password.form') }}" class="text-sm text-info">Forgot Password?</a>
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
    function getsad(getdd)
	{
        if($("input[name='"+getdd+"']").attr("type") == "password"){

            $("input[name='"+getdd+"']").attr('type', 'text');
            $(".password-input-container'"+getdd+"' i").removeClass("fa-eye");
            $(".password-input-container'"+getdd+"' i").addClass("fa-eye-slash");
        }else
        {
            $("input[name='"+getdd+"']").attr('type', 'password');
            $(".password-input-container-'"+getdd+"' i").removeClass("fa-eye-slash");
            $(".password-input-container'"+getdd+"' i").addClass("fa-eye");
        }
	}
</script>
@endsection