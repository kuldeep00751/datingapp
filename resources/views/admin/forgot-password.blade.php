
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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.forgot.password.send') }}">
                            @csrf

                            <div class="form-group row">
                                

                                <div class="col-md-12">
                                <label for="email" class="col-form-label" style="font-size: 16px">@lang('auth.email-email_address')</label>
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