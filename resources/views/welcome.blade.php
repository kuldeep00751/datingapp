<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@lang('welcome.meta-title')</title>
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
      @font-face {
         font-family: 'AvenirNext';
         src: url('/fonts/avenir-next-ultra-light.ttf') format('truetype');
         font-style: normal;
      }
      @font-face {
         font-family: 'CambriaItalic';
         src: url('/fonts/Cambria Italic.ttf') format('truetype');
         font-style: italic;
      }
      @font-face {
         font-family: 'FutureBTBook';
         src: url('/fonts/futura-bk-bt-book.woff2') format('woff2'),
         url('/fonts/futura-bk-bt-book.woff') format('woff'),
         url('/fonts/futura-bk-bt-book.ttf') format('truetype');
         font-style: normal;
      }
    body {
      background: url('public/pictures/BACKGROUND.png') no-repeat center center;
      background-size: cover;
      background-attachment: fixed;
      color: white;
      text-align: center;
    }
    
    .overlay-box {
      background-color: rgba(0, 0, 0, 0.5);
      padding: 1rem 1rem;
      border-radius: 0px;
      backdrop-filter: blur(10px);
      font-family: 'AvenirNext', sans-serif;
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
      font-size: 24px;
    font-style: italic;
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
      font-size: 36px;
    font-style: italic;
   }

   .link-style:hover,
   .link-style:focus,
   .lang-link:hover,
   .lang-link:focus {
      /* border-color: #03b9c3; */
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
   
   .box-23-login 
   {
   width: 250px;
   height: 250px;
   justify-content: center;
   padding-top: 65px;
   box-shadow: -1px 0px 3px 5px #ffffff73;
   }
   .gap-3 a
   {
      font-size: 20px;
   }

   @media (min-width : 992px){
      .footer-display{
         display: flex !important;
         justify-content: center !important;
      }
   }
   @media (max-width : 991.98px)
   {
      .img-top-34
      {
         width: 250px;
      }
      /* .bottom-footer
      {
         margin-left: 0rem;
      } */

      .footer-display{
         /* display: flex !important;
         justify-content: center !important; */
      }
      
   }
   
      .footer-content p{
         margin-left: 1rem !important;
         margin-right: 1rem !important;
         margin-top: 0 !important;
         margin-bottom: 0 !important;
      }
   @media (max-width : 786px)
   {
      .footer-position-bottom{
         position:static;
         bottom:0px;
      }
   }
   @media (min-width : 787px){
      .footer-position-bottom{
         position:fixed;
         bottom:0px;
      }
   }
   
   .footer-display p{
      text-align: center;
      margin-bottom:5px !important;
   }
   @media (max-width: 575px) {
   body {
      background-color: #f9f9f9;
   }

   .container {
      padding: 10px;
      font-size: 14px;
   }
   }
  </style>
</head>
<body>
   <div class="container d-flex flex-column justify-content-center align-items-center h-100">
      <img class="my-5 img-top-34" src="{{asset('public/pictures/1._First_Page-removebg-preview.png')}}" width="450"/>
      <div class="overlay-box my-5 box-23-login">
         <h5 class="">
            <a href="{{ route('login') }}" class="text-white text-decoration-none fws-24 link-style">@lang('welcome.login')</a>
         </h5>
         <hr class="text-white my-1" style="border-bottom:1px solid #03b9c37a;">
         <h5 class="">
            <a href="{{ route('register') }}" class="text-white text-decoration-none fws-24 link-style">@lang('welcome.register')</a>
         </h5>
         <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('lang.switch', ['lang' => 'en']) }}" class="text-white-50 px-2 lang-link {{ App::getLocale() == 'en' ? 'active-button' : '' }}">
               English
            </a>
            <a href="{{ route('lang.switch', ['lang' => 'es']) }}" class="text-white-50 px-2 lang-link {{ App::getLocale() == 'es' ? 'active-button' : '' }}">
               Spanish
            </a>
         </div>
      </div>

      <div class="bottom-footer">
         <div class="" style="margin-bottom:6rem;">
         <img src="{{asset('public/pictures/output-onlinepngtools.png')}}" alt="Silverbridge Logo" style="height: 100px;">
         <div class="text-white" style="font-size:13px;">@lang('messages.TextLogin3')</div>
         </div>
         <!-- <div class="footer-links">
         <a href="#">Know more</a> |
         <a href="{{ route('contact.form') }}">Contact Us</a>
         </div>
         <div class="mt-1">&copy; The Silverbridge™ All rights reserved</div> -->
      </div>
   </div>
   
   <div class="footer-position-bottom w-100 py-0 mt-5" style="background: rgb(0 0 0 / 50%);color: #fff;">
      <div class="footer-display footer-content py-3 align-items-center" bis_skin_checked="1">
            <p><img src="{{asset('public/pictures/image49.png')}}" width="120"></p>
            <p><img src="{{asset('public/pictures/image4.png')}}" width="80"></p>
            <p><img src="{{asset('public/pictures/image19.png')}}" width="40"></p>
            <p><img src="{{asset('public/pictures/image26.png')}}" width="120"></p>
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif"><a style="color: unset;" href="https://www.thesilverbridge.com">@lang('messages.TextLogin5')</a></p>
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif"><a style="color: unset;" href="{{route('contact.form')}}">@lang('messages.TextLogin6')</a></p>
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif"><a style="color: unset;" href="{{route('term&condition')}}">@lang('messages.TextLogin7')</a></p>
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif"><a style="color: unset;" href="{{route('privacy')}}">@lang('messages.TextLogin8')</a></p>
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif"><a style="color: unset;" href="https://www.thesilverbridge.com/qa">@lang('messages.TextLogin9')</a></p>
            <p class="pt-2" style="font-family: 'AvenirNext', sans-serif">© 2025 The Silverbridge™. @lang('messages.TextLogin4')</p>
      </div>
   </div>
</body>
</html>
