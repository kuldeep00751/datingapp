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
         background-color: rgb(0 0 0 / 14%);
         border: 1px solid #fff;
         padding: 0px 0px;
         border-radius: 0px;
         backdrop-filter: blur(10px);
         font-family: 'AvenirNext', sans-serif;
         width: 90%;
         max-width: 25rem;
         margin: 0 auto;
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
   <div class="container d-flex flex-column justify-content-center align-items-center ">
      <img class="my-2 img-fluid" src="{{asset('public/pictures/1._First_Page-removebg-preview.png')}}" alt="Logo" style="width:70%;"/>
      <div class="overlay-box my-3">
         <h2 class="text-center py-2 text-white" style="background-color: rgba(0, 0, 0, 0.5); font-style:italic;">@lang('register.register-title')</h2>
         <div class="card-body p-0">
            <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                     <div class="col-12 col-md-12">
                        <label class="mb-0 text-white" for="email"  style="font-size: 18px;float:left; font-style:italic;">@lang('register.reg_email')</label>
                        <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"   autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-12 col-md-12">
                        <label for="email_confirmation"
                        class="mb-0 text-white" style="font-size: 18px;float:left; font-style:italic;">@lang('register.reg_confirmemail')</label>
                        <input id="email_confirmation" type="email" class="form-control @error('email_confirmation') is-invalid @enderror"
                           name="email_confirmation" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  autocomplete="email_confirmation" value="{{ old('email_confirmation') }}">
                        @if ($errors->has('email_confirmation'))
                        <span class="invalid-feedback" role="alert">
                        <strong> {{ $errors->first('email_confirmation') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
                  <div class="form-group ">
                     <div class="col-12 col-md-12">
                        <label for="password"
                        class="mb-0 text-white" style="font-size: 18px;float:left; font-style:italic;">@lang('register.password')</label>
                        <div class="input-group">
                           <input id="password" type="password"
                              class="form-control @error('password') is-invalid @enderror" minlength="8" 
                              pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                              name="password" autocomplete="new-password" >
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
                        <div id="message" style="display: none;">
                        <h3>@lang('register.password-validation-text'):</h3>
                        <p id="letter" class="invalid">A <b>@lang('register.password-validation-lowercase')</b> @lang('register.password-validation-letter')</p>
                        <p id="capital" class="invalid">@lang('register.password-validation-A') <b>@lang('register.password-validation-capital') (@lang('register.password-validation-uppercase'))</b> @lang('register.password-validation-letter')</p>
                        <p id="number" class="invalid">@lang('register.password-validation-A') <b>@lang('register.password-validation-number')</b></p>
                        <p id="length" class="invalid">@lang('register.password-validation-minimum') <b>8 @lang('register.password-validation-characters')</b></p>
                        </div>
                        </div>
                        
                     </div>
                  </div>

                  <div class="form-group">
                     <div class="col-12 col-md-12">
                     <label for="password-confirm" class="mb-0 text-white" style="font-size: 18px;float:left; font-style:italic;">
                     @lang('register.confirm_password')
                     </label>
                        <div class="input-group">
                              <input 
                                 id="password-confirm" 
                                 type="password" 
                                 class="form-control @error('password_confirmation') is-invalid @enderror" 
                                 name="password_confirmation" 
                                  
                                 autocomplete="new-password"
                              >
                              <div class="input-group-append">
                                 <span class="input-group-text" id="toggle2-password" style="cursor: pointer;border-radius: unset;">
                                    <i class="fas fa-eye" id="passwordconfirmation-icon"></i>
                                 </span>
                              </div>
                              @error('password_confirmation')
                              <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-12 col-md-12 text-white text-center">
                        <label for="sex" class="mb-0 " style="font-size: 18px;float:left; font-style:italic;"></label>
                        <input type="checkbox" name="older_than_18" value="1" class="@error('older_than_18') is-invalid @enderror" id="older_than_18" >
                        @lang('register.reg_iconfirm18')
                        @error('older_than_18')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-12 col-md-12">
                        <button type="submit" class="btn w-100 fs-18 text-white mb-3" style="font-size: 16px;background-color: rgba(0, 0, 0, 0.5); font-style:italic;border-radius: unset;">
                        @lang('register.btn-register')
                        </button>
                        
                        <a href="{{url('auth/facebook')}}" class="btn w-100  mb-2 fs-18 text-white" style="background-color:#205c90;border-radius: unset;">
                           <i class="fa-brands fa-facebook"></i> &nbsp; &nbsp;@lang('register.btn-facebook')
                        </a>
                        <a href="{{url('auth/google')}}" class="btn w-100  mb-2 text-white fs-18" style="background-color:#008cff;border-radius: unset;">
                           <i class="fa-brands fa-google"></i>&nbsp; &nbsp;@lang('register.btn-google')
                        </a>
                     </div>
                  </div>
               </form>
         </div>
         <div class="d-flex justify-content-center my-3 text-white">
            <h4 class="text-center">@lang('messages.TextLogin10')?<br><a class="text-white text-center" href="{{ route('login') }}">@lang('messages.TextLogin11')</a></h4>
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
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
<script>
   document.querySelectorAll('input').forEach(input => {
   input.addEventListener('input', function () {
       if (this.checkValidity()) {
           this.classList.add('is-valid');
           this.classList.remove('is-invalid');
       } else {
           this.classList.add('is-invalid');
           this.classList.remove('is-valid');
       }
   });
   });
   
   
   document.getElementById('toggle2-password').addEventListener('click', function () {
       const passwordInput = document.getElementById('password-confirm');
       const passwordIcon = document.getElementById('passwordconfirmation-icon');
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


    function checkAge() {
        var birthdayInput = document.getElementById('birthday');
        var selectedDate = new Date(birthdayInput.value);
        var today = new Date();
        
        // Calculate age
        var age = today.getFullYear() - selectedDate.getFullYear();
        var month = today.getMonth() - selectedDate.getMonth();
        
        // If birthday hasn't occurred yet this year, subtract 1 from age
        if (month < 0 || (month === 0 && today.getDate() < selectedDate.getDate())) {
            age--;
        }
        
        // Get the error span element
        var errorSpan = document.querySelector('.invalidfeedback');
       
        // Check if age is less than 18
        if (age < 18) {
            // Add invalid class to input
            birthdayInput.classList.add('is-invalid');
            
            // Set custom error message
            if (errorSpan) {
                errorSpan.innerHTML = "<strong>You must be at least 18 years old.</strong>";
            }
            
            // Optionally clear the input field
            birthdayInput.value = '';
        } else {
            // Remove invalid class if the age is valid
            birthdayInput.classList.remove('is-invalid');
            
            // Reset the error message if valid
            if (errorSpan) {
                errorSpan.innerHTML = '';
            }
        }
    }
</script>
@endpush