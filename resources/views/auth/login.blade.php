@extends('layouts.app')
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>@lang('welcome.meta-title')</title>
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <style>
      html, body {
      height: 100%;
      }
      .container {
      min-height: 100vh;
      }
      body {
         /* background: url('public/pictures/BACKGROUND.png') no-repeat center center;
         background-size: cover; */
         height: 100vh;
         color: white;
         text-align: center;
      }
      main 
      {
         background: url('public/pictures/BACKGROUND.png') no-repeat center center;
         background-size: cover;
      }
      .overlay-box {
         background-color: rgb(0 0 0 / 0%);
         border: 1px solid #fff;
         padding: 0px 0px;
         border-radius: 0px;
         backdrop-filter: blur(10px);
         font-family: 'AvenirNext', sans-serif;
         width: 25rem;
      }
      .bottom-footer {
         /* position: absolute;
         bottom: 7rem; */
         width: 100%;
         font-size: 0.9rem;
         color: #ccc;
         font-family: 'AvenirNext', sans-serif;
      }
      .footer-links a {
         color: #ccc;
         margin: 0 10px;
         text-decoration: none;
         font-family: 'AvenirNext', sans-serif;
         font-style:italic;
      }
      .height-logo{
         height: 65%;
      }
      .fws-24{
         font-size:24px;
      }
      .link-style, .lang-link {
         transition: all 0.3s ease;
         padding: 0.25rem 0.5rem;
         border: 1px solid transparent;
         border-radius: 0.25rem;
      }

      .link-style:hover,
      .link-style:focus,
      .lang-link:hover,
      .lang-link:focus {
         border-color: #03b9c3;
         outline: none;
         text-decoration: none;
         color: #ffffff !important;
      }

      .active-button{
         /* border-color: #03b9c3; */
         outline: none;
         text-decoration: none;
         /* color: #ffffff !important; */
      }
      .navbar{
         display:none !important;
      }
      footer{
         display:none !important;
      }
      .form-control{
         border-radius:unset !important;
      }
      
      @media (max-width : 786px)
      {
         .overlay-box 
         {
         width: 100%;
         }
      }
      @media (min-width : 992px){
         .footer-display{
            display: flex !important;
            justify-content: center !important;
         }
      }
      @media (max-width : 991.98px)
      {
         .footer-display{
            /* display: flex !important; */
            /* justify-content: center !important; */
         }
      }
      
      .footer-content p{
         margin-left: 1rem !important;
         margin-right: 1rem !important;
         margin-top: 0 !important;
         margin-bottom: 0 !important;
      }
   </style>
</head>
@section('content')
   @if (session('success'))
   <div class="alert badge-success text-white" role="alert">
      {{ session('success') }}
   </div>
   @endif
   @if (session('error'))
   <div class="alert badge-danger text-white" role="alert">
      {{ session('error') }}
   </div>
   @endif
   <div class="container d-flex flex-column justify-content-center align-items-center">
      <img class="my-2 img-fluid" src="{{asset('public/pictures/1._First_Page-removebg-preview.png')}}" alt="Logo" style="width:70%;"/>
      <div class="overlay-box my-3">
         <h2 class="text-center py-2 text-white" style="background-color: rgba(0, 0, 0, 0.5); font-style:italic;">@lang('login.login')</h2>
         <div class="card-body p-0">
            <form method="POST" action="{{ route('login') }}"  id="login-form">
               @csrf
               <div class="form-group">
                  <div class="col-12 col-md-12">
                     <label class="mb-0 text-white" for="email"  style="font-size: 18px;float:left; font-style:italic;">@lang('login.email')</label>
                     <input id="email" type="email"class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus style="font-weight: 800 !important;">
                     <span class="glyphicon form-control-feedback"></span>
                     <i class="fas fa-check form-control-feedback" style="display:none;"></i>
                     @error('email')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-12 col-md-12">
                     <label class="mb-0 text-white" for="password" style="font-size: 18px; float:left; font-style:italic;">@lang('login.password')</label>
                     <div class="input-group">
                        <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" name="password"
                           autocomplete="current-password" >
                        <div class="input-group-append">
                           <span class="input-group-text" id="toggle-password" style="cursor: pointer;border-radius: unset;">
                           <i class="fas fa-eye" id="password-icon"></i>
                           </span>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
               </div>
               <div class="form-group row mx-1">
                  <div class="col-md-6 d-flex align-items-center">
                     <div class="form-check mx-0 text-white">
                        <input class="form-check-input" type="checkbox" name="remember"
                        id="remember" {{ old('remember') ? 'checked' : '' }} style="transform: scale(1.5); margin-right: 8px;">
                        <label class="form-check-label ms-2" for="remember">
                           @lang('login.remember_me')
                        </label>
                     </div>
                  </div>

                  <div class="col-md-6 d-flex justify-content-end align-items-center">
                     @if (Route::has('password.request'))
                     <a class="btn btn-link p-0 text-white" href="{{ route('password.request') }}">
                        @lang('login.forgot')
                     </a>
                     @endif
                  </div>
               </div>
               <div class="form-group mb-0">
                  <div class="col-md-12 ">
                     <button type="submit" class="btn w-100 fs-18 text-white mb-3" style="font-size: 16px;background-color: rgba(0, 0, 0, 0.5); font-style:italic;border-radius: unset;">
                     @lang('login.btn-login')
                     </button>
                     <a href="{{url('auth/facebook')}}" class="btn w-100 mb-2 text-white" style="background-color:#205c90; font-size: 16px;border-radius: unset;">
                     <i class="fa-brands fa-facebook"></i> &nbsp; &nbsp;@lang('login.btn-facebook')
                     </a>
                     <a href="{{url('auth/google')}}" class="btn w-100  mb-2 text-white " style="background-color:#008cff;font-size: 16px;border-radius: unset;">
                     <i class="fa-brands fa-google"></i>&nbsp; &nbsp;@lang('login.btn-google')
                     </a>
                  </div>
               </div>
            </form>
         </div>
         <div class="d-flex justify-content-center my-3 text-white">
            <h4 class="text-center">@lang('messages.TextLogin1')?<br><a class="text-white text-center" href="{{ route('register') }}">@lang('messages.TextLogin2')</a></h4>
         </div>
         <div class="d-flex justify-content-center gap-3 footer-links mb-2 fs-5 fs-md-4 fs-lg-3">
            <a href="{{ route('lang.switch', ['lang' => 'en']) }}" class="text-white-50 px-2 lang-link {{ App::getLocale() == 'en' ? 'active-button' : '' }}">
               English
            </a>
            <a href="{{ route('lang.switch', ['lang' => 'es']) }}" class="text-white-50 px-2 lang-link {{ App::getLocale() == 'es' ? 'active-button' : '' }}">
               Spanish
            </a>
         </div>
      </div>

      <div class="bottom-footer text-center my-3" style="">
         <div class="mb-1">
         <img src="{{asset('public/pictures/output-onlinepngtools.png')}}" alt="Silverbridge Logo" style="height: 50px;">
         <div class="text-white" style="font-size:13px;">@lang('messages.TextLogin3')</div>
         </div>
         <!-- <div class="footer-links text-center">
            <a class="d-inline-block px-2 fs-6 fs-md-5" href="#">Know more</a> |
            <a class="d-inline-block px-2 fs-6 fs-md-5" href="{{ route('contact.form') }}">Contact Us</a>
         </div>
         <div class="my-3">&copy; The Silverbridge™ All rights reserved</div> -->
      </div>
   </div>
   <!-- <div class="footer-position-bottom w-100 py-0 mt-3" style="background: rgb(0 0 0 / 50%);color: #fff;">
      <div class="footer-display footer-content py-3 align-items-center" bis_skin_checked="1">
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif">© 2025 The Silverbridge™. @lang('messages.TextLogin4')</p>
            <p><img src="{{asset('public/pictures/image49.png')}}" width="120"></p>
            <p><img src="{{asset('public/pictures/image4.png')}}" width="80"></p>
            <p><img src="{{asset('public/pictures/image19.png')}}" width="40"></p>
            <p><img src="{{asset('public/pictures/image26.png')}}" width="120"></p>
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif"><a style="color: unset;" href="https://www.thesilverbridge.com">@lang('messages.TextLogin5')</a></p>
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif"><a style="color: unset;" href="{{route('contact.form')}}">@lang('messages.TextLogin6')</a></p>
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif"><a style="color: unset;" href="{{route('term&condition')}}">@lang('messages.TextLogin7')</a></p>
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif"><a style="color: unset;" href="{{route('privacy')}}">@lang('messages.TextLogin8')</a></p>
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif"><a style="color: unset;" href="https://www.thesilverbridge.com/qa">@lang('messages.TextLogin9')</a></p>
      </div>
   </div> -->
@endsection
@push('scripts')
<script>
   document.getElementById('toggle-password').addEventListener('click', function () {
       const passwordInput = document.getElementById('password');
       const passwordIcon = document.getElementById('password-icon');
       if (passwordInput.type === 'password') {
           passwordInput.type = 'text';
           passwordIcon.classList.remove('fa-eye');
           passwordIcon.classList.add('fa-eye-slash');
       } else {
           passwordInput.type = 'password';
           passwordIcon.classList.remove('fa-eye-slash');
           passwordIcon.classList.add('fa-eye');
       }
   });
   
   document.addEventListener('DOMContentLoaded', function() {
       const emailInput = document.getElementById('email');
       const passwordInput = document.getElementById('password');
       
       // Function to validate email
       const validateEmail = () => {
           if (emailInput.validity.valid) {
               // Add 'valid' class and show green check mark for email
               emailInput.classList.add('is-valid');
               emailInput.classList.remove('is-invalid');
               
           } else {
               // Add 'invalid' class and hide check mark for email
               emailInput.classList.remove('is-valid');
               emailInput.classList.add('is-invalid');
               
           }
       };
   
       // Function to validate password
       const validatePassword = () => {
           if (passwordInput.validity.valid && passwordInput.value.length >= 8) {
               // Add 'valid' class and show green check mark for password
               passwordInput.classList.add('is-valid');
               passwordInput.classList.remove('is-invalid');
               
           } else {
               // Add 'invalid' class and hide check mark for password
               passwordInput.classList.remove('is-valid');
               passwordInput.classList.add('is-invalid');
               
           }
       };
   
       // Validate email and password when user types
       emailInput.addEventListener('input', validateEmail);
       passwordInput.addEventListener('input', validatePassword);
   });
   
   
</script>
@endpush
