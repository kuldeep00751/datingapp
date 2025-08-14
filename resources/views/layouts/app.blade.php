<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title> @lang('messages.meta-title')</title>
      <script src="{{ asset('js/app.js') }}" defer></script>
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
      @stack('link')
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <style>
         @font-face {
            font-family: 'AvenirNext';
            src: url('/fonts/avenir-next-ultra-light.ttf') format('truetype');
            font-style: normal;
            color:#000;
         }

         @font-face {
            font-family: 'AvenirLight';
            src: url('/fonts/avenir-light.ttf') format('truetype');
            color:#fff;
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
         .youzify-sdescription
         {
         font-size: 45px;
         font-weight: bold;
         }
         .item-header-overlay .item-header-cover:before {
         opacity: .8;
         z-index: 5;
         background-color: rgba(0, 0, 0, 0.7);
         }
         /* main {
         min-height: 49.8rem;
         } */
          main {
            min-height: calc(100vh - 100px); 
         }
         .glyphicon-ok {
         color: green;
         }
         .glyphicon-remove {
         color: red;
         }
         .form-control-feedback {
         display: none;
         }
         .nav-item .nav-link {
         position: relative;
         display: inline-block;
         }
         .nav-item .badgetoggle 
         {
           
         position: absolute !important;
         top: 12px !important;
         right: 38% !important;
         background-color: #FF0066;
         color: white;
         padding: 5px 0px;
         font-size: 10px;
         font-weight: bold;
         border-radius: 0%;
         line-height: 1;
         display: inline-block;
         width: 20px;
         height: 20px;
         left: 38%;
         text-align: center;

         }
         #navbarSupportedContent li a:hover 
         {
         /* color: #FF0066 !important; */
            color: #01FFFF !important;
         }
         .dropdown-toggle-notification::after {
         display: none !important;
         margin-left: 0.255em;
         vertical-align: 0.255em;
         content: "";
         border-top: 0.3em solid;
         border-right: 0.3em solid transparent;
         border-bottom: 0;
         border-left: 0.3em solid transparent;
         }
         .dropdown-menu{
         right: 2rem !important;
         left: unset !important;
         }
         .notify-drop-title{
         padding: 9px 2rem !important;
         border-bottom: 1px solid #e1dcdc !important;
         }
         .content-section{
         border-bottom: 1px solid #e1dcdc !important;
         }
      </style>
      <style>
         /* Basic footer styles */
         footer {
         background-color: #333;
         color: white;
         padding: 20px;
         text-align: center;
         }
         /* Footer layout for larger screens */
         .footer-container {
         display: flex;
         justify-content: space-between;
         flex-wrap: wrap;
         }
         .footer-item {
         flex: 1;
         padding: 10px;
         }
         /* Copyright section */
         .footer-copyright {
         font-size: 0.9em;
         color: #aaa;
         }
         .font-size-custom{
         padding-right: 7px;
         font-size: 14px;
         }
         .mobile-box
         {
         display:none !important;
         visibility:hidden;
         }
         @media (max-width: 768px)
         {
         .logo-bg
         {
         width:50px;
         }
         .navbar-nav
         {
         display: block;
         }
         
         .mobile-box {
         padding-left: 0px;
         margin-bottom: 0px;
         display:flex !important;
         visibility:visible;
         }  
         .mobile-box li 
         {
         list-style: none;
         position: inherit;
         }
         .dropdown-menu {
         right: 0rem !important;
         left: 0px !important;
         }
         .iteminnercontent 
         {
         top: -39px !important;
         left: 10px !important;
         }
         .iteminnercontent .user-228-avatar {
         width: 90px;
         }
         .youzify-name h2 {
         font-size: 14px !important;
         }
         .item-head-content 
         {
         margin-top: 38px!important;
         }
         .item-navbar-item a 
         {
         padding: 10px !important;
         font-size: 14px !important;
         margin-top: 40px;
         }
         .item-user-img img {
         width: 100% !important;
         height: auto !important;
         margin: 0px !important;
         }
         .footer-container {
         flex-direction: column;
         text-align: left;
         }
         .item-user-profile-cover-img 
         {
         height: 80px !important;
         }
         .youzify-sdescription 
         {
         font-size: inherit !important;
         }
         .messenger-messagingView,.messenger-listView{
         top:58px !important;
         }
         }
         .buttonload {
         background-color:unset !important;
         border: none; 
         color: white; 
         font-size: 16px;
         }
         .buttonload .fa-spinner{
         margin-left: 50%;
         margin-top: 69%;
         }
         .master-class li{
         float:left;
         }
         .master-class ul{
         list-style:none;
         }
         /* .swal2-actions{
         margin-left: 5% !important;
         display: flex;
         padding-left: 23px;
         padding-bottom: 12px;
         margin-top: -6px;
         } */
         .profile-status-custom{
         width: 150px; 
         height: 45px; 
         text-align: center;
         font-size: 10px;
         padding: 3px; 
         border: 1px solid gray;
         text-transform: capitalize;
         font-weight: bold;
         }
         .profile-status-custom:hover {
         color: #ff0a0ad1;
         }
         .custom-modal {
         display: none;
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         z-index: 9999;
         justify-content: center;
         align-items: center;
         }
         .custom-modal-dialog {
            background: rgb(255 255 255 / 0%);;
            padding: 20px;
            border-radius: 0px;
            max-width: 345px;
            width: 100%;
            margin: auto;
            color: #fff !important;
            border: 3px solid #ffffffd9;
            backdrop-filter: blur(35px);
            -webkit-backdrop-filter: blur(35px);
         }
         .custom-modal.show {
         display: flex;
         }
         label{
         margin: 0px 0px 0px !important;
         }
         .hide{
         display:none !important;
         }
      </style>
      <style>
         .model-head h3{
            font-family: "AvenirNext", sans-serif;
            font-weight:700;
         }
         .model-head h3 div{
            width: 35px;
            height: 35px;
            font-weight: bold;
            font-size: 26px;
            /* background: #e3342f; */
            color: #fff;
            margin-left: 3rem;
         }
         .feedback-model-head  h3 div{
            font-weight: bold;
            font-size: 26px;
            color: #fff;
         }

         .model-head h3 div img{
         /* background: #e3342f; */
         }
         .comment-body-content{
         height: 300px;
         overflow-y: auto;
         }
         .comment-main-title{
            font-family: 'AvenirNext', sans-serif;
         }

         .comment-main-body{
            font-family: 'FutureBTBook', sans-serif;
         }
         .heading-font-family{
         font-family: 'FutureBTBook', sans-serif;
         }
         .mastering-text-content p{
         /* font-family: 'AvenirNext', sans-serif; */
         }
         .feedback-content div h5{
            font-family: 'FutureBTBook', sans-serif;
         }
         .feedback-content div .form-check{
         /* font-family: 'AvenirNext', sans-serif; */
         font-size: 12px;
         }
         
         #dropdown-1 .affinity-1
         {
            display: inline-grid;
            place-items: center;
            padding: 36px 11px 17px;
            border-right: 2px solid #504f4f;
            font-family: 'AvenirNext';
            color: #b9b9b9;
         }

         #dropdown-2 .notification-1
         {
            display: inline-grid;
            place-items: center;
            padding: 36px 11px 17px;
            border-right: 2px solid #504f4f;
            font-family: 'AvenirNext';
            color: #b9b9b9;
         }

         #dropdown-3 .chat-1
         {
            display: inline-grid;
            place-items: center;
            padding: 36px 11px 17px;
            border-right: 2px solid #504f4f;
            font-family: 'AvenirNext';
            color: #b9b9b9;
         }

         #dropdown-4 .status-1
         {
            display: inline-grid;
            place-items: center;
            padding: 36px 11px 17px;
            border-right: 2px solid #504f4f;
            font-family: 'AvenirNext';
            color: #b9b9b9;
         }
         .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: black;
         }
         .select2-container--default .select2-results__option {
            background: #333;
         }
         #dropdown-5 .profile-1
         {
            display: inline-grid;
            place-items: center;
            padding: 36px 11px 17px;
            border-right: 2px solid #504f4f;
            font-family: 'AvenirNext';
            color: #b9b9b9;
         }

         #dropdown-1 img,#dropdown-2 img, #dropdown-3 img , #dropdown-4 img, #dropdown-5 img
         {
         height: 36px;
         width: 36px;
         }
         .swal2-popup{
            width: 400;
            display: grid;
            color: #fff;
            border: 3px solid #ffffffd9;
            border-radius: unset;
            font-size: 16px;
            font-weight: unset;
            width: 520px;
           
            background: rgb(255 255 255 / 0%);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 4px 30px rgb(0 0 0 / 8%);
            padding: 2rem;
            color: #ffffffd9;
            text-align: center;
            
         }
         .swal2-title,#feedbackForm,#commentForm{
            margin-top: 8rem;
         }
         .swal2-actions .swal2-confirm {
            background:#00CCFF !important;
            border-radius: unset;
            /* padding: 4px 15px; */
            --swal2-confirm-button-background-color: #00CCFF;
            --swal2-action-button-outline: #00CCFF;
         }
        .swal2-actions .swal2-cancel{
            border-radius: unset;
            background: #EF2B7C;
            /* padding: 4px 15px; */
            --swal2-confirm-button-background-color: #EF2B7C;
            --swal2-action-button-outline: #EF2B7C;
         }
         .swal2-success-circular-line-left, .swal2-success-fix, .swal2-success-circular-line-right{
            display:none;
         }

         .swal2-title{
            display: block;
            font-family: "AvenirNext", sans-serif !important;
            font-style: italic !important;
            font-weight: unset !important;
            font-size: 3rem;
         }

          
         .swal2-popup,
         .custom-modal-dialog.m-3 {
            position: relative; /* Needed for ::before to position absolutely */
            overflow: hidden;   /* Optional, helps clip the image if needed */
         }

         .swal2-popup::before,
         .custom-modal-dialog.m-3::before {
            content: "";
            background-image: url(/pictures/LOGO-H-W1.png);
            background-size: contain;
            background-repeat: no-repeat;
            position: absolute;
            width: 50%;
            height: 10rem;
            top: 0;
            left: 35%; /* Use 50% + translateX for proper centering */
            transform: translateX(-50%);
            z-index: 1; /* Ensure it's visible */
         }
        .swal2-icon{
            display:none !important;
         }

         @media (max-width: 768px)
         {
            #dropdown-1, #dropdown-2, #dropdown-3, #dropdown-4, #dropdown-5 {
               float: left;
               height: 87px;
               width: 20%;
               padding: 20px 10px;
               border-right: 2px solid;
               position: inherit;
               text-align: center;
            }
            #dropdown-1 img,#dropdown-2 img, #dropdown-3 img , #dropdown-4 img, #dropdown-5 img
            {
            height: 20px;
            width: 20px;
            }
            #dropdown-1 .affinity-1, #dropdown-2 .notification-1, #dropdown-3 .chat-1, #dropdown-4 .status-1, #dropdown-5 .profile-1 {
               padding: 0px;
               border: none;
            } 
            .nav-item .badgetoggle {
            position: absolute !important;
            top: -16px !important;
            right: -9px !important;
            }
            .navbar-custom{
           
            }
            .navbar-custom .contain-custom{
               
            }
            .swal2-title, #feedbackForm, #commentForm 
            {
            margin-top: 6rem;
            }
            .swal2-title 
            {
            font-size: 2rem;
            }
            .swal2-popup
            {
            padding:0rem;
            }
            .navbar-light .navbar-toggler 
            {
               margin-right: 10px;
            }
            main
            {
            margin-top: 0px;
            min-height: auto;
            }
            .navbar-collapse {
               margin-right: 0px;
            }
         }
         
         /* .custom-modal-dialog{
            border-radius: unset;
            background: rgb(255 255 255 / 11%);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 4px 30px rgb(0 0 0 / 8%);
            color: #ffffffd9;
         } */
          .footer-position-bottom{
            position:static;
            bottom:0px;
         }
         .navbar-custom{
            padding: 0px;
            margin: 0px;
         }
         .navbar-custom .contain-custom{
            margin: 0px;
            padding: 0px;
            flex: 0 0 100%;
            max-width: 100%;
         }
         .footer-display p{
            text-align: center;
         }

         
         @media (min-width : 992px){
            .footer-display{
               display: flex !important;
               justify-content: center !important;
            }
            .menu-dropdown-news{
               width: 50%;
            }
         }
         @media (max-width : 991.98px)
         {
            .footer-display{
               /* display: flex !important; */
               /* justify-content: center !important; */
            }
            .menu-dropdown-news{
               width: 100%;
            }
         }
         
         .footer-content p{
            margin-left: 1rem !important;
            margin-right: 1rem !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
         }
         .custom-modal-content{
            margin-top: 6rem !important;
         }
         .modal-header i {
            display: none !important;
         }
         small{
            color:#fff !important;
         }
         @media (max-width : 585){
         .navbar-collapse {
            margin-right: -20px;
         }
         
      }
      </style>
   </head>
   <body>
      <div id="app">
      @php
         $userLocale = Auth::check() && Auth::user()->locale ? Auth::user()->locale : (session('locale') ?? App::getLocale() ?? 'en');
      @endphp
      @if(auth()->check())   
         <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm navbar-custom" id="refreshData1">
            <div class="container contain-custom" id="refreshData2">
            <a class="navbar-brand" href="{{ url('/menu') }}" style="margin: 1%;">
              <img src="{{ url('/public/pictures/ISO-W.png') }}"  alt="{{ config('app.name', 'Laravel') }}" class="logo-bg" width="100px">
               </a>
               
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent" aria-expanded="false"
                  aria-label="{{ __('Toggle navigation') }}">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent" style="float: right;">
                  <!-- Left Side Of Navbar -->
                  <ul class="navbar-nav mr-auto">
                  </ul>
                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ">
                     <!-- Authentication Links -->
                     
                     <li class="nav-item dropdown" id="dropdown-1" style="background: url('{{ env('APP_URL') }}public/pictures/Background button Affinity.png') no-repeat center center; background-size: 100% 100%;">
                        <a id="navbarDropdown" class="nav-link text-capitalize  dropdown-toggle affinity-1" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                           <img src="{{ url('/public/pictures/Affinity Icon.png') }}"  alt="" class="logo-bg" width="30" >

                           @lang('messages.menu-affinity')
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pt-0 pb-3 menu-dropdown-affinity" aria-labelledby="navbarDropdown" id="affinityDropdownMenu">
                           <div class="row m-0" id="data2">
                              <a class="dropdown-item mt-1" 
                                 href="{{ getMatchProfile() !== 0 ? route('users.show-user', getMatchProfile()) : 'javascript:void(0);' }}" 
                                 onclick="{{ getMatchProfile() === 0 ? 'showNoProfileWarning()' : '' }}"
                                 ><i class="fa-solid fa-user font-size-custom"></i>@lang('messages.submenu-watch-profile')</a>
                              @if(getMatchProfile() !== 0)
                                 @php 
                                    $userId = getMatchProfile();
                                    $user = getUserDetails($userId);
                                    $emailMatchData = getMatchProfileStatus($user->id)['emailMatch'] ?? null;
                                    $secondMatchData = getMatchProfileStatus($user->id)['secondEmailMatch'] ?? null;
                                    $affectin_is_connect = 0;

                                    if($emailMatchData->affection == "accept" && $secondMatchData->affection == "accept"){
                                       $affectin_is_connect = 1;
                                    }

                                 @endphp
                                 @if(is_object($emailMatchData))

                                    @if($emailMatchData->affection == "email" && $emailMatchData->is_mastering == 0 && $emailMatchData->is_profile_view == 1)
                                       <a class="dropdown-item" href="javascript:;" onclick="acceptInviteMain({{getMatchProfile()}},this,'{{ $user->like_to_be_called }}')"><i class="fa-solid fa-user font-size-custom"></i>@lang('messages.submenu-confirm-affinity')</a>
                                       <a class="dropdown-item" href="javascript:;" onclick="rejectInviteMain({{getMatchProfile()}}, this, {{$affectin_is_connect}})"><i class="fa-solid fa-right-from-bracket font-size-custom"></i>
                                       @lang('messages.submenu-decline-affinity')</a>
                                    @endif

                                    @if($emailMatchData->is_mastering == 1 && $emailMatchData->is_profile_view == 1)
                                    <a class="dropdown-item" href="javascript:;" onclick="masteringResponseMain(0,{{$user->id}},this)"><i class="fa-solid fa-user font-size-custom"></i>@lang('messages.submenu-confirm-affinity-master')</a> 
                                       @if($secondMatchData->visualPicture == 1 || $secondMatchData->visualDescription == 1 || $secondMatchData->comments != "")
                                          <a class="dropdown-item" href="javascript:;" onclick="masteringResponseMain(2,{{$user->id}},this)" ><i class="fa-solid fa-user font-size-custom"></i>@lang('messages.submenu-decline-affinity-master')</a>
                                       @else
                                          <a class="dropdown-item" href="javascript:;" onclick="masteringResponseMain(1,{{$user->id}},this)" ><i class="fa-solid fa-user font-size-custom"></i>@lang('messages.submenu-decline-affinity-master')</a>
                                       @endif
                                    @endif

                                    @if($emailMatchData->affection == "accept" && $emailMatchData->is_mastering == 0 && $emailMatchData->is_profile_view == 1  && $secondMatchData->affection == "accept" &&  $secondMatchData->is_mastering ==0)
                                       @php
                                          $howsGone = getUserDetails($emailMatchData->liked_user_id ?? 0)->like_to_be_called ?? '';
                                       @endphp
                                       @if ($emailMatchData->want_to_continue == "Yes")
                                          <a class="dropdown-item" href="javascript:;" onclick="rejectInviteMain({{getMatchProfile()}}, this, 3)"><i class="fa-solid fa-right-from-bracket font-size-custom"></i>
                                             @lang('messages.submenu-want1') 
                                          </a>
                                       @else
                                          <a class="dropdown-item" href="javascript:;" onclick="rejectInviteMain({{getMatchProfile()}}, this, {{$affectin_is_connect}})"><i class="fa-solid fa-right-from-bracket font-size-custom"></i>
                                              @lang('messages.submenu-want2') {{$howsGone}}?
                                          </a>
                                       @endif
                                    @endif

                                    {{--
                                    @if($emailMatchData->affection == "accept" && isActiveFeedback() && $emailMatchData->is_profile_view == 1)
                                    <a class="dropdown-item" href="{{route('meeting.sendFeedback')}}">
                                       <i class="fa-solid fa-right-from-bracket font-size-custom"></i>
                                       @lang('messages.submenu-feedback')
                                    </a>
                                    @endif
                                    --}}
       
                                 @endif
                              @endif
                           </div>
                        </div>
                     </li>
                     
                     <li class="nav-item menu23" id="dropdown-2" style="background: url('{{ env('APP_URL') }}public/pictures/Background Button News.png') no-repeat center center; background-size: 100% 100%;" onclick="loadNotifications({{getMatchProfile()}})">
                        <a href="javascript:;" class="nav-link position-relative dropdown-toggle-notification dropdown-toggle notification-1"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ url('/public/pictures/News Icon.png') }}"  alt="" class="logo-bg" width="30" >
                        <!-- <i class="fa-solid fa-bell" style="font-size:16px; color: #ff3131;"></i> -->
                        
                        
                        <span class="badge badgetoggle {{(getUnseenNotification(getMatchProfile())==0)? 'd-none': ''}}" id="notificationBadge2" class="badge">{{ getUnseenNotification(getMatchProfile()) }}</span> 
                       
                        @lang('messages.menu-header-news')
                        
                        </a>
                        <ul class="dropdown-menu notify-drop menu-dropdown-news" id="newsDropdownMenu">
                           <div class="notify-drop-title">
                              <div class="row">
                                 <div class="col-8">@lang('messages.menu-notifications') <b class="notificationcount"></b></div>
                                 <div class="col-4 text-right">
                                    <span class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom" title="Tümü okundu.">
                                    <i class="fa fa-dot-circle-o"></i>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <!-- end notify title -->
                           <!-- notify content -->
                           <div class="drop-content" style="overflow-y: auto;height: 300px;">
                           </div>
                        </ul>
                     <li>
                     <li class="nav-item menu23" id="dropdown-3" style="background: url('{{ env('APP_URL') }}public/pictures/Background Button Chat.png') no-repeat center center; background-size: 100% 100%;">
                        <a class="nav-link position-relative chat-1" 
                           href="javascript:void(0);" 
                           onclick="ChatOpen();"
                           >
                           <img src="{{ url('/public/pictures/Chat Icon.png') }}"  alt="" class="logo-bg" width="30" >

                           
                        <!-- <i class="fa-brands fa-rocketchat" style="font-size:16px; color: #ff3131;"></i> -->
                        @lang('messages.menu-header-chat')
                        
                        <span class="badge badgetoggle {{(getUnseenMessages()==0)? 'd-none': ''}}" id="unseen-count2">{{ getUnseenMessages() }}</span>
                        </a>
                        
                     </li>


                     <li class="nav-item dropdown" id="dropdown-4" style="background: url('{{ env('APP_URL') }}public/pictures/Background Button Status.png') no-repeat center center; background-size: 100% 100%;">
                     
                     <a id="navbarDropdown" class="nav-link text-capitalize  dropdown-toggle status-1" href="javascript:;" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     
                     
                     
                     <img src="{{ url('/public/pictures/Status Icon.png') }}"  alt="" class="logo-bg" width="30" >
                        @lang('messages.menu-header-status')
                     <span class="badge badgetoggle d-none" id="statusBadge5"></span>   
                     </a>
                     <div class="dropdown-menu dropdown-menu-right pt-0 pb-3 menu-dropdown-status" aria-labelledby="navbarDropdown" id="statusDropdownMenu">
                           <div class="row m-0" id="myProfileStatus1">      
                        </div>
                     </div>
                       
                     
                     </li>
                     
                     <li class="nav-item dropdown menu23" id="dropdown-5" style="background:#000; background-size: 100% 100%;">
                        <a id="navbarDropdown" class="nav-link text-capitalize  dropdown-toggle dropdown-toggle-notification profile-1" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  onclick="ProfileStatus();">
                        <img src="{{ Auth::user()->profile_picture ? url('storage/' . Auth::user()->profile_picture) : (Auth::user()->avatar ? Auth::user()->avatar: url('pictures/default.png')) }}" width="45" height="45" class="text-center" style="border: 2px solid #fff;">
                         @lang('messages.menu-header-profile')
                        
                     </a>
                        <div class="dropdown-menu dropdown-menu-right pt-0 pb-3" aria-labelledby="navbarDropdown" style="width: 250px;">
                           <span class="dropdown-item bg-light" style=" width: 100%;font-weight: bold;">@lang('messages.menu-accounts')</span>  
                           <!-- <a class="dropdown-item p-2 text-capitalize" href="{{ route('profile.edit') }}"><img src="{{ Auth::user()->profile_picture ? url('storage/' . Auth::user()->profile_picture) : (Auth::user()->avatar ?Auth::user()->avatar: url('pictures/default.png')) }}" width="40" height="40" class="text-center" style="border-radius: 50%;"> {{ Auth::user()->like_to_be_called }}</a> -->
                           <a class="dropdown-item" href="{{ route('users.show-user', Auth::user()->id) }}"><i class="fa-regular fa-eye font-size-custom"></i>@lang('messages.menu-preview-profile')</a>
                           <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user font-size-custom"></i>@lang('messages.menu-edit-profile')</a>
                           
                           <a class="dropdown-item" href="{{ route('meeting.showFeedbacks',isFeedbackComment()['feedback_id']) }}"><i class="fa-solid fa-user font-size-custom"></i>@lang('messages.menu-feedback')</a>
                           <a class="dropdown-item" href="{{ route('meeting.showComments',isFeedbackComment()['comment_id']) }}"><i class="fa-solid fa-user font-size-custom"></i>@lang('messages.menu-first-impression')</a>

                           @if(auth()->user()->status == "approved")
                           <a class="dropdown-item mt-2" href="{{ route('user.subscription.index') }}"><i class="fa-solid fa-ticket font-size-custom"></i>@lang('messages.menu-subscription')</a> 
                           @endif
                            <span class="dropdown-item bg-light mt-3" style=" width: 100%;font-weight: bold;"><i class="fa-solid fa-globe font-size-custom"></i>Language</span> 
                            
                           <a class="dropdown-item" href="{{ route('lang.switch', ['lang' => 'en']) }}">
                              <i class="fa-solid fa-flag-usa font-size-custom"></i>English 
                              @if($userLocale == 'en')
                                 <i class="fa-solid fa-check text-success"></i>
                              @endif
                           </a>
                           <a class="dropdown-item" href="{{ route('lang.switch', ['lang' => 'es']) }}">
                              <i class="fa-solid fa-flag font-size-custom"></i>Spanish
                              @if($userLocale == 'es')
                                 <i class="fa-solid fa-check text-success"></i>
                              @endif
                           </a>
                           <hr>
                           <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket font-size-custom"></i>@lang('messages.menu-logout')
                           </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                           </form>
                        </div>
                     </li>
                     <!-- <li class="nav-item">
                        <a class="nav-link mt-1" href="{{ route('contact.form') }}">@lang('messages.menu-contact')</a>
                     </li>
                     <li class="nav-item" >
                        <form action="{{ route('lang.switch') }}" method="GET" class="mt-1">
                           <select class="form-control border-0" name="lang" onchange="this.form.submit()" style="padding:5px;">
                           <option value="en" {{ App::getLocale() == 'en' ? 'selected' : '' }}>English</option>
                           <option value="es" {{ App::getLocale() == 'es' ? 'selected' : '' }}>Español</option>
                           </select>
                        </form>
                     </li> -->
                     
                     
                  </ul>
               </div>
            </div>
         </nav>
         @endif
         <main class="pb-0">
            @if(session('error'))
            <div class="alert alert-danger">
               {{ session('error') }}
            </div>
            @endif
            @yield('content')
         </main>
         <!-- <footer>
            <div class="footer-copyright">
               @lang('messages.footer-text')
            </div>
         </footer> -->
         <div class="footer-position-bottom w-100 py-0" style="background: rgb(0 0 0 / 50%);color: #fff;">
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
         <!-- Modal structure -->
         <!-- <div class="modal" id="myModal1" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="modalLabel">Why didn't you want to connect?</h5>
                     <button type="button" class="btn-close closedata" data-bs-dismiss="modal1">X</button>
                  </div>
                  <div class="modal-body">
                     <p>Please select a reason:</p>
                     <div class="mt-3">
                        <label class="form-label" for="reasonPicture">Picture</label>
                        <select class="form-control" id="reasonPicture1" name="reasonPicture">
                           <option value="">Select</option>
                           <option value="one">One</option>
                           <option value="two">Two</option>
                           <option value="both">Both</option>
                        </select>
                     </div>
                     <div class="mt-3">
                        <label class="form-check-label" for="reasonDescription">Description</label>
                        <textarea class="form-control" name="reasonDescription" id="reasonDescription1" rows="2" placeholder="Enter your Description..."></textarea>
                     </div>
                     <div class="mt-3">
                        <label for="comments" class="form-label">Additional Comments:</label>
                        <textarea class="form-control" id="comments1" rows="3" name="comments" placeholder="Enter your comments..." style="height:auto; resize:none;"></textarea>
                     </div>
                  </div>
                  <div class="modal-footer">
                     @if(isset($user))
                     <button type="button" class="btn btn-primary" id="submitFeedback" onclick="masteringResponseMain(1,{{$user->id}},this)">Submit</button>
                     @endif
                  </div>
               </div>
            </div>
         </div> -->
      </div>
      <!-- have A DAte Modal -->
      <div  class="custom-modal" id="havedateModal">
         <div class="custom-modal-dialog m-3">
            <form id="haveDAteForm">
               @csrf
               <input type="hidden" name="reject_user_id" id="rejectUserId">
               <div class="custom-modal-content">
                  <div class="modal-body ">
                     <div class="item-infos-item my-2 comment-main-title">
                        <h3 class="item-info-label" style="font-family: 'AvenirNext', sans-serif; font-weight:700;">
                           <span class="heading-span">@lang('messages.have-date-modal-title')</span>
                        </h3>
                     </div>
                     <div class="item comment-main-body">
                        <div class="row g-3">
                           <div class="col-md-12 mb-2">
                              <select class="form-control" name="have_date">
                                 <option value="yes">@lang('messages.btn-yes')</option>
                                 <option value="no">@lang('messages.btn-no')</option>
                              </select>
                           </div>
                           <div class="col-md-12 mb-0 mt-3">
                              <button type="button" id="havesubmitBtn" onclick="haveADate();" class="btn btn-sm" style="background: #00CCFF !important; color:#fff;">
                              <span id="havesubmitBtnText">@lang('messages.btn-submit-Etgr')</span>
                              <span id="havesubmitLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                              </button>
                              <button type="button" onclick="closeModal()" class="btn btn-sm" style="background: #EF2B7C; !important;color:#fff;">@lang('messages.btn-cancel')</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!-- feedback Modal -->
      <div   class="custom-modal" id="feedbackModal">
         <div class="custom-modal-dialog m-3" style="max-width:600px !important;">
            <form id="feedbackForm">
               @csrf
               <input type="hidden" name="feedback_user" id="feedback_user">
               <div class="custom-modal-content">
                  <div class="modal-header feedback-model-head">
                     <h3>
                        <div class="d-inline-flex" style="font-family: 'AvenirNext', sans-serif; font-weight:700;">
                        <!-- <img src="{{ url('/public/pictures/ISO G.png') }}" width="10%;"/>  -->
                        <b class="mt-1">@lang('messages.feedback-form-title')</b>
                        </div>
                     </h3>
                  </div>
                  <style>
                     .main-feedback-modal h5{
                        color:#fff;
                     }
                  </style>
                  <div class="modal-body" style="font-family: 'FutureBTBook', sans-serif;">
                     <div class="item-widget-main-content">
                        <div class="item-widget-content" style="height: 350px;overflow-y: scroll;">
                           <div class="feedback-content main-feedback-modal">
                              <div class="mb-3">
                                 <h5> @lang('messages.feedback-photo-reality-title')</h5>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input"   id="photogenic5" name="photogenic" value="5">
                                    <label class="form-check-label" for="photogenic5">@lang('messages.feedback-photo-reality-question5')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input"   id="photogenic4" name="photogenic" value="4" >
                                    <label class="form-check-label" for="photogenic4">@lang('messages.feedback-photo-reality-question4')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input"   id="photogenic3" name="photogenic" value="3">
                                    <label class="form-check-label" for="photogenic3">@lang('messages.feedback-photo-reality-question3')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input"   id="photogenic2" name="photogenic" value="2">
                                    <label class="form-check-label" for="photogenic2">@lang('messages.feedback-photo-reality-question2')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="photogenic1" name="photogenic" value="1">
                                    <label class="form-check-label" for="photogenic1">@lang('messages.feedback-photo-reality-question1')</label>
                                 </div>
                                 <small id="photogenicError" class="text-danger d-block mt-1"></small>
                              </div>
                              <div class="mb-3">
                                 <h5>@lang('messages.feedback-Expressiveness-title')</h5>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="expressiveness5" name="expressiveness" value="5">
                                    <label class="form-check-label" for="expressiveness5"> @lang('messages.feedback-Expressiveness-question5')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="expressiveness4" name="expressiveness" value="4">
                                    <label class="form-check-label" for="expressiveness4"> @lang('messages.feedback-Expressiveness-question4')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="expressiveness3" name="expressiveness" value="3">
                                    <label class="form-check-label" for="expressiveness3"> @lang('messages.feedback-Expressiveness-question3')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="expressiveness2" name="expressiveness" value="2">
                                    <label class="form-check-label" for="expressiveness2"> @lang('messages.feedback-Expressiveness-question2')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="expressiveness1" name="expressiveness" value="1">
                                    <label class="form-check-label" for="expressiveness1">@lang('messages.feedback-Expressiveness-question1')</label>
                                 </div>
                                 <small id="expressivenessError" class="text-danger d-block mt-1"></small>
                              </div>

                              <div class="mb-3">
                                 <h5>@lang('messages.feedback-Attention-title')</h5>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="attention5" name="attention" value="5">
                                    <label class="form-check-label" for="attention5">@lang('messages.feedback-Attention-question5')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="attention4" name="attention" value="4">
                                    <label class="form-check-label" for="attention4">@lang('messages.feedback-Attention-question4')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="attention3" name="attention" value="3">
                                    <label class="form-check-label" for="attention3">@lang('messages.feedback-Attention-question3')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="attention2" name="attention" value="2">
                                    <label class="form-check-label" for="attention2">@lang('messages.feedback-Attention-question2')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="attention1" name="attention" value="1">
                                    <label class="form-check-label" for="attention1">@lang('messages.feedback-Attention-question1')</label>
                                 </div>
                                 <small id="attentionError" class="text-danger d-block mt-1"></small>
                              </div>
                              <div class="mb-3">
                                 <h5>@lang('messages.feedback-Manners-title')</h5>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="manners5" name="manners" value="5">
                                    <label class="form-check-label" for="manners5">@lang('messages.feedback-Manners-question5')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="manners4" name="manners" value="4">
                                    <label class="form-check-label" for="manners4">@lang('messages.feedback-Manners-question4')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="manners3" name="manners" value="3">
                                    <label class="form-check-label" for="manners3">@lang('messages.feedback-Manners-question3')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="manners2" name="manners" value="2" >
                                    <label class="form-check-label" for="manners2">@lang('messages.feedback-Manners-question2')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="manners1" name="manners" value="1">
                                    <label class="form-check-label" for="manners1">@lang('messages.feedback-Manners-question1')</label>
                                 </div>
                                 <small id="mannersError" class="text-danger d-block mt-1"></small>
                              </div>
                              <div class="mb-3">
                                 <h5>@lang('messages.feedback-concept-idea-title')</h5>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="opinions_ideas5" name="opinions_ideas" value="5">
                                    <label class="form-check-label" for="opinions_ideas5">@lang('messages.feedback-concept-idea-question5')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="opinions_ideas4" name="opinions_ideas" value="4">
                                    <label class="form-check-label" for="opinions_ideas4">@lang('messages.feedback-concept-idea-question4')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="opinions_ideas3" name="opinions_ideas" value="3">
                                    <label class="form-check-label" for="opinions_ideas3">@lang('messages.feedback-concept-idea-question3')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="opinions_ideas2" name="opinions_ideas" value="2">
                                    <label class="form-check-label" for="opinions_ideas2">@lang('messages.feedback-concept-idea-question2')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="opinions_ideas1" name="opinions_ideas" value="1">
                                    <label class="form-check-label" for="opinions_ideas1">@lang('messages.feedback-concept-idea-question1')</label>
                                 </div>
                                 <small id="opinions_ideasError" class="text-danger d-block mt-1"></small>
                              </div>
                              <div class="mb-3">
                                 <h5>@lang('messages.feedback-sense-of-humor-title')</h5>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="sense_humer5" name="sense_humer" value="5">
                                    <label class="form-check-label" for="sense_humer5">@lang('messages.feedback-sense-of-humor-question5')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="sense_humer4" name="sense_humer" value="4">
                                    <label class="form-check-label" for="sense_humer4">@lang('messages.feedback-sense-of-humor-question4')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="sense_humer3" name="sense_humer" value="3" >
                                    <label class="form-check-label" for="sense_humer3">@lang('messages.feedback-sense-of-humor-question3')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="sense_humer2" name="sense_humer" value="2" >
                                    <label class="form-check-label" for="sense_humer2">@lang('messages.feedback-sense-of-humor-question2')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="sense_humer1" name="sense_humer" value="1">
                                    <label class="form-check-label" for="sense_humer1">@lang('messages.feedback-sense-of-humor-question1')</label>
                                 </div>
                                 <small id="sense_humerError" class="text-danger d-block mt-1"></small>
                              </div>
                              <div class="mb-3">
                                 <h5>@lang('messages.feedback-energy-title')</h5>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="energy5" name="energy" value="5">
                                    <label class="form-check-label" for="energy5">@lang('messages.feedback-energy-question5')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="energy4" name="energy" value="4">
                                    <label class="form-check-label" for="energy4">@lang('messages.feedback-energy-question4')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="energy3" name="energy" value="3">
                                    <label class="form-check-label" for="energy3">@lang('messages.feedback-energy-question3')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="energy2" name="energy" value="2">
                                    <label class="form-check-label" for="energy2">@lang('messages.feedback-energy-question2')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="energy1" name="energy" value="1">
                                    <label class="form-check-label" for="energy1">@lang('messages.feedback-energy-question1')</label>
                                 </div>
                                 <small id="energyError" class="text-danger d-block mt-1"></small>
                              </div>
                              <div class="mb-3">
                                 <h5>@lang('messages.feedback-willingness-title')</h5>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="willingness5" name="willingness" value="5" >
                                    <label class="form-check-label" for="willingness5">@lang('messages.feedback-willingness-question5')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="willingness4" name="willingness" value="4">
                                    <label class="form-check-label" for="willingness4">@lang('messages.feedback-willingness-question4')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="willingness3" name="willingness" value="3">
                                    <label class="form-check-label" for="willingness3">@lang('messages.feedback-willingness-question3')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="willingness2" name="willingness" value="2">
                                    <label class="form-check-label" for="willingness2">@lang('messages.feedback-willingness-question2')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="willingness1" name="willingness" value="1" >
                                    <label class="form-check-label" for="willingness1">@lang('messages.feedback-willingness-question1')</label>
                                 </div>
                                 <small id="willingnessError" class="text-danger d-block mt-1"></small>
                              </div>
                              <div class="mb-3">
                                 <h5>@lang('messages.feedback-serious-relationship-question')</h5>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="serious_relationship1" name="serious_relationship" value="Yes" onclick="toggleFeedbackFields1('Yes')">
                                    <label class="form-check-label" for="serious_relationship1">@lang('messages.btn-yes')</label>
                                 </div>
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="serious_relationship2" name="serious_relationship" value="No" onclick="toggleFeedbackFields1('No')">
                                    <label class="form-check-label" for="serious_relationship2">@lang('messages.btn-no')</label>
                                 </div>
                              </div>
                              <div class="mb-3" id="not_connect_box1">
                                 <h5> @lang('messages.feedback-serious-dating-question')</h5>
                                 <textarea class="form-control @error('not_connect') is-invalid @enderror" id="not_connect" name="not_connect"></textarea>
                                 <small id="not_connect_counter" class="form-text">0 / 150</small>
                                 <small id="not_connect_error" class="form-text text-danger" style="display: none;">Character limit exceeded!</small>
                                 @error('not_connect')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                 @enderror
                                 <small id="notConnectError" class="text-danger d-block mt-1"></small>
                              </div>

                              <div class="mb-3" id="connect_person_box1">
                                 <h5>@lang('messages.feedback-connect-person-question')</h5>
                                 <textarea class="form-control" id="connect_person" name="connect_person"></textarea>
                                 <small id="connect_person_counter" class="form-text ">0 / 150</small>
                                 <small id="connect_person_error" class="form-text text-danger" style="display: none;">Character limit exceeded!</small>
                              </div>

                              <div class="mb-3" id="not_connect_box2">
                                 <h5>@lang('messages.feedback-compliment-question')<br>
                                    <span style="font-size: 12px;">( @lang('messages.feedback-compliment-Note') )</span>
                                 </h5>
                                 <textarea class="form-control @error('compliment') is-invalid @enderror" id="compliment" name="compliment"></textarea>
                                 <small id="compliment_counter" class="form-text">0 / 150</small>
                                 <small id="compliment_error" class="form-text text-danger" style="display: none;">Character limit exceeded!</small>
                                 @error('compliment')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                 @enderror
                                 <small id="complimentError" class="text-danger d-block mt-1"></small>
                              </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer heading-font-family" style="justify-content: flex-start !important;">
                     <button type="button" id="feedbacksubmitBtn" onclick="SubmitFeedback();" class="btn btn-sm" style="background: #00CCFF !important; color:#fff;">
                        <span id="feedbacksubmitBtnText">@lang('messages.btn-submit-Etgr')</span>
                        <span id="feedbacksubmitLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                     </button>
                     <button type="button" onclick="closefeedbackModal();" class="btn btn-sm" style="background: #EF2B7C; !important;color:#fff;">@lang('messages.btn-cancel')</button>
                  </div>
                  <span id="feedbackError"></span><br>
               </div>
            </form>
         </div>
      </div>
      <!-- comment Modal -->
      <div  class="custom-modal" id="commentModal">
         <div class="custom-modal-dialog m-3" style="max-width:600px !important; color: #000;">
            <form id="commentForm">
               @csrf
               <input type="hidden" name="comment_user" id="comment_user">
               <input type="hidden" id="processStatus">
               <input type="hidden" id="processIsConnect">
               <div class="custom-modal-content">
                  <div class="modal-header row comment-main-title">
                     <h3>
                        <div class="d-inline-flex" style="font-family: 'AvenirNext', sans-serif; font-size: 19px;font-weight:700;">
                            @lang('messages.comment-title1')<br>@lang('messages.comment-title')
                        </div>
                        
                     </h3>
                     <span id="commentError"></span>
                  </div>
                  <div class="modal-body comment-main-body">
                     <div class="item-widget-main-content">
                        <div class="item-widget-content">
                           <div class="comment-body-content" >
                              <div class="mb-3">
                                 <h6>@lang('messages.comment-top-message')</h4>
                              </div>
                              <!-- Picture Option -->
                              <div class="mb-3">
                                 <h6>
                                    <input type="checkbox" id="pictureCheckbox1" name="visual_picture" onclick="toggleReasonSelectMain()"> @lang('messages.comment-visual-picture')
                                 </h6>
                              </div>
                              <div class="mb-3" id="reasonSelectContainer1" style="display: none;">
                                 <p>@lang('messages.comment-visual-picture-message1')
                                 <p>@lang('messages.comment-visual-picture-message2')</p>
                                 @if(isset(auth()->user()->id) &&  getMatchProfile() != 0)
                                    @php
                                       $Image = getAffinityPicture(getMatchProfile());
                                    @endphp
                                    @if($Image['pictureCount'] > 0)
                                       @foreach($Image['pictureData'] as $key => $value)
                                       <h6 class="m-2">
                                          <input type="checkbox" name="reason_profile{{ $key }}" id="reason_profile{{ $key }}">
                                          <img class="m-3" src="{{ asset('storage/' . $value->picture_location) }}" width="100" />
                                       </h6>
                                       @endforeach
                                    @endif
                                 @endif
                              </div>
                              <!-- Description Option -->
                              <div class="mb-3">
                                 <h6>
                                    <input type="checkbox" id="descriptionCheckbox1" name="visual_description" onclick="toggleDescriptionSelectMain();" > @lang('messages.comment-description')
                                 </h6>
                              </div>
                              <div class="mb-3" id="descriptionSelectContainer1" style="display: none;">
                                 <p>@lang('messages.comment-description-message1')</p>
                                 <textarea class="form-control" name="reason_description" id="reasonDescription1" rows="2" placeholder="" maxlength="150"></textarea>
                              </div>
                              <div class="mb-3">
                                 <h6>
                                 @lang('messages.comment-additional-comment'):</h4>
                                 <textarea class="form-control" id="comments12" name="comments" rows="3" placeholder="{{ __('messages.comment-additional-comment-placeholder')}}..." maxlength="150"></textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footercomment-body-content" style="justify-content: flex-start !important;">
                     <button type="button" id="submitBtn" onclick="SubmitComment();" class="btn btn-sm" style="background: #00CCFF !important; color:#fff;">
                     <span id="submitBtnText">@lang('messages.btn-submit-Etgr')</span>
                     <span id="submitLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                     </button>
                     <button type="button" onclick="closecommentModal();" class="btn btn-sm" style="background: #EF2B7C; !important;color:#fff;">@lang('messages.btn-cancel')</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </body>
   @stack('scripts')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.17.1/echo.iife.min.js"></script>
   <script>
      function ChatOpen() {
        
         $.ajax({
            url: '/getChatActivate',
            type: 'GET',
            data: {
               _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {
               if (response.inviteUser !== 0) {
                  window.location.href = `/messenger/${response.inviteUser}`;
               } else {
                  showNoProfileWarning();
               }
            },
            error: function() {
               console.error("{{ __('messages.chat-function-error') }}");
            }
         });
      }
      
      $(document).ready(function() {
         ProfileStatus();
      });
      
      function ProfileStatus() {
         $.ajax({
            url: '/getProfileStatus',
            type: 'GET',
            data: {
               _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {
               
               if (response.message == '<a class="dropdown-item mt-1" href="https://datingapp.ciws.in/user/subscription/plans">Pending payment</a>' || response.message == '<a class="dropdown-item mt-1" href="https://datingapp.ciws.in/user/subscription/plans">Pago pendiente</a>') {
                  const statusBadge = document.getElementById('statusBadge5');
                  statusBadge.textContent = 1;
                  statusBadge.classList.remove("d-none");
               }
               $('#myProfileStatus').html(response.message);
               $('#myProfileStatus1').html(response.message);
               $('#myProfileStatus2').html(response.message);
            }
         });
      }
      
      function NotificationDelete(id) {
         const notification1 = document.getElementById('notificationBadge1');
         const notification2 = document.getElementById('notificationBadge2');
         $.ajax({
            url: '/deleteNotification',
            type: 'GET',
            data: {
               _token: $('meta[name="csrf-token"]').attr('content'),
               id:id,
            },
            success: function(response) {
               if(response.count>0)
               {
               document.getElementById("notification2").classList.remove("d-none");
               }
               notification1.textContent = response.count;
               notification2.textContent = response.count;
            }
         });
      }
   </script>
   <script>
      //const userloginId = {!! auth()->id() !!};
      const userloginId =@json(auth()->id());
      // Initialize Laravel Echo
      window.Echo = new Echo({
         broadcaster: 'pusher',
         key: '{{ config('broadcasting.connections.pusher.key') }}',
         cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
         forceTLS: true
      });
      
      // Listen for 'UnseenMessagesUpdated' event
      window.Echo.channel('UnseenMessage')
      .listen('UnseenMessagesUpdated', (event) => {
         
         const badge1 = document.getElementById('unseen-count1');
         const badge2 = document.getElementById('unseen-count2');
         const unseenData = event.unseenCount;
         const senderId = event.userId;
         
            if(unseenData>0)
            {
            document.getElementById("unseen-count2").classList.remove("d-none");
            }
         if (event.unseenCount > 0 && senderId == userloginId) {

          
            badge1.textContent = unseenData;
            badge2.textContent = unseenData;
            fetch('/send-notification-chat', {
             method: 'POST',
             headers: {
                 'Content-Type': 'application/json',
                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
             },
               body: JSON.stringify({ userId: senderId })
            })
            .then(response => response.json())
            .then(data => {
               // console.log(data); 
            })
            .catch(error => {
               // console.error('Error sending mail:', error);
            });
         }
      });
      
      // Listen for 'UnseenMessagesUpdated' event
      window.Echo.channel('UnseenNotification')
      .listen('NotificationEvent', (event) => {
         const notification1 = document.getElementById('notificationBadge1');
         const notification2 = document.getElementById('notificationBadge2');
         const unseenNotification = event.unseenNotiCount;
         const senderUserId = event.userId;
         
         if (unseenNotification && senderUserId === userloginId) {
         if(response.count>0)
         {
         document.getElementById("notification2").classList.remove("d-none");
         }
            if (notification1) notification1.textContent = unseenNotification;
            if (notification2) notification2.textContent = unseenNotification;
         }
      });
      
      function loadNotifications(id) {
         
         $.ajax({
               url: '{{ route("notifications.fetch") }}',
               data:{id:id},
               type: 'GET',
               success: function(response) {
      
                  let notificationcount = 0;
      
                  if (response.notifications.length > 0) {
                     let notificationHtml = '';
                     const notificationcount = response.notifications.length;
                     

                     response.notifications.forEach(function(notification) {
                        let imageUrl = notification.profile_picture 
                                       ? '{{ asset('storage') }}' + '/' + notification.profile_picture 
                                       : (notification.avatar || '{{ url('pictures/default.png') }}');
                        const userProfileRoute = "{{ route('users.show-user', ':id') }}";
                        let profileUrl = userProfileRoute.replace(':id', notification.id);
                        let links = notification.link;
                      
                        let messageRead = `{{ __('messages.notification-message-read') }}`;
      
                        if (notification.read === 1) {
                           messageRead = `{{ __('messages.notification-message-unread') }}`; 
                        }
                        const currentLocale = "{{ $userLocale }}";

                        const messageToShow = currentLocale === 'es' 
                           ? notification['message-spanish'] 
                           : notification.message;

                        notificationHtml += `
                           <li class="d-flex align-items-center py-2 px-2 content-section">
                              
                              <div class="col-3 col-md-2">
                                 <div class="notify-img">
                                    <span ${links ? `onclick="return allReadAndRedirect('${notification.user_id}','${profileUrl}','${links}')"` : ''}  style="cursor: pointer;">
                                       <img src="${imageUrl}" alt="" style="border-radius: 50%; width:50px;height:50px;">
                                    </span>
                                 </div>
                              </div>
                              <div class="col-9 col-md-10 px-4">
                                    <div ${links ? `onclick="return allReadAndRedirect('${notification.user_id}','${profileUrl}','${links}')"` : ''} style="color:unset;" class="mb-2">
                                       <span style="cursor: pointer; font-size: 0.9rem;">${messageToShow}</span>
                                       </div>
                                    <p class="time float-left" style="font-size: 0.7rem;">${timeAgo(notification.senddate)}</p> 
                                    <a href="javascript:void(0);" class="float-right" style="font-size: 0.7rem;" onclick="NotificationDelete('${notification.notificationId}')">
                                       <i class="fas fa-trash-alt"></i>
                                    </a>
                              </div>
                              
                           </li>
                        `;
                     });

                     $('.dropdown-menu .drop-content').html(notificationHtml);
                     $('.notify-drop .drop-content').html(notificationHtml);
                     $('.notificationcount').html();
                  } else {
                     $('.dropdown-menu .drop-content').html('<li class="p-2" style="text-align:center;margin-left: 2rem;margin-right: 2rem; margin-top:35%;">{{ __('messages.notification-message-no-message') }}</li>');
                     $('.notify-drop .drop-content').html('<li class="p-2" style="text-align:center;margin-left: 2rem;margin-right: 2rem; margin-top:35%;">{{ __('messages.notification-message-no-message') }}</li>');
                     $('.notificationcount').html();
                  }
               }
         });
      }
      
      function allReadAndRedirect(notificationId, profileUrl, links) {
         $.ajax({
            url: '{{ route("notifications.markAsRead") }}',
            type: 'POST',
            data: {
                  _token: '{{ csrf_token() }}',
                  user_id:notificationId
            },
            success: function(response) {
             
               if (links && links !== 'null') {
                  window.location.href = links;
               } else {
                  window.location.href = profileUrl;
               }
            }
         });
      };
      
      function timeAgo(dateString) {
         
         const now = new Date();
         const then = new Date(dateString);
         
         const seconds = Math.floor((now - then) / 1000);
      
         const intervals = [
            { label: '{{ __('messages.timeAgo-label-year') }}', seconds: 31536000 },
            { label: '{{ __('messages.timeAgo-label-month') }}', seconds: 2592000 },
            { label: '{{ __('messages.timeAgo-label-day') }}', seconds: 86400 },
            { label: '{{ __('messages.timeAgo-label-hour') }}', seconds: 3600 },
            { label: '{{ __('messages.timeAgo-label-minute') }}', seconds: 60 },
            { label: '{{ __('messages.timeAgo-label-second') }}', seconds: 1 }
         ];
      
         for (let i = 0; i < intervals.length; i++) {
            const interval = intervals[i];
            if (seconds >= interval.seconds) {
                  const amount = Math.floor(seconds / interval.seconds);
                  return `${amount} ${interval.label}${amount !== 1 ? 's' : ''} {{ __('messages.timeAgo-label-ago') }}`;
            }
         }
      
         return "{{ __('messages.timeAgo-label-just-now') }}";
      }
   </script>
   <script>
      function showNoProfileWarning() {
        
         Swal.fire({
            
            title: `{{ __('messages.function-no-profile-warning-title') }}`,
            html: `<div style="text-align: left;">
                     <strong>{{ __('messages.function-no-profile-warning-html-first') }}</strong><br>
                     {{ __('messages.function-no-profile-warning-html-second') }}<br>
                     <strong>{{ __('messages.function-no-profile-warning-html-third') }}</strong>
                  </div>`,
            confirmButtonText: `{{ __('messages.function-no-profile-warning-btn-ok') }}`,
            width: '710px' 
         });
      }
      
      const loader = document.querySelector('.dot-loader');
      if (loader) {
         loader.style.display = 'flex';
      }
   </script> 
   <script>
      // Submit Like Action
      function acceptInviteMain(userId , element,username) {
         
         //first swal
         Swal.fire({
            title: '{{ __('messages.acceptInviteMain-title') }}',
            // html: `<div style="text-align: center;">
            //       <p>{!! __('messages.acceptInviteMain-html-first') !!} <strong>${username}</strong>. {!! __('messages.acceptInviteMain-html-second') !!}</p>   
            //    </div>`,
            html: `
                  <div style="text-align: center;">
                        <p>{!! __('messages.acceptInviteMain-html-first') !!} <strong>${username}</strong>. {!! __('messages.acceptInviteMain-html-second') !!}</p>   
                  </div>
               `,
            // icon: 'warning',
            // imageUrl: "{{ asset('pictures/LOGO-H-W1.png') }}",
            // imageHeight: 100,
            showCancelButton: true,
            confirmButtonColor: '#38c172',
            cancelButtonColor: '#e3342f',
            confirmButtonText: '{{ __('messages.acceptInviteMain-confirmButtonText') }}',
            cancelButtonText: '{{ __('messages.acceptInviteMain-cancelButtonText') }}',
            width:'520px',
            customClass: {
               confirmButton: 'custom-confirm-button',
               cancelButton: 'custom-cancel-button',
               popup: 'swal2-custom-logo-padding'
            }
         }).then((result) => {
            if (result.isConfirmed) {
                  //second swal
                  Swal.fire({
                     title: '{{ __('messages.acceptInviteMain-syncing-title') }}',
                     html: `{{ __('messages.acceptInviteMain-syncing-html-first') }}<br><br>
                           <span style="color: #f59800; padding: 2px 5px; font-weight: bold;">
                           {{ __('messages.acceptInviteMain-syncing-html-second') }}
                           </span>`,
                     allowOutsideClick: false,
                     didOpen: () => {
                        Swal.showLoading();
                     }
                  });
      
                  $.ajax({
                     url: '/accept-action-url',
                     type: 'POST', 
                     data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        accept_user_id: userId,
                     },
                     success: function(response) {
                        if (response.success) {
                              if (response.isChatActivated) {
                                  //third swal
                                 Swal.fire({
                                    title: '{{ __('messages.acceptInviteMain-official-title') }}',
                                    html: '{{ __('messages.acceptInviteMain-official-html-first') }}',
                                    
                                    confirmButtonText: '{{ __('messages.acceptInviteMain-official-confirmButtonText') }}'
                                 }).then((result) => {
                                    if (result.isConfirmed) {
                                       window.location.href = `/messenger/${userId}`; 
                                    }
                                 });
                              }else{
                                 //fourth swal
                                 Swal.fire(
                                    '{{ __('messages.acceptInviteMain-spark-title') }}',
                                    `{{ __('messages.acceptInviteMain-spark-html-first') }} ${response.nickname} {{ __('messages.acceptInviteMain-spark-html-second') }}`,
                                    
                                 );
                              }
                              $('#affinityDropdownMenu').load(' #data2');
                        }else if(response.subscription){
                            //fifth swal
                              Swal.fire(
                                 '{{ __('messages.swal-error-title') }}',
                                 response.message,
                                 'error'
                              );
                              loader.style.display = 'none';
                        } else {
                           //sixth swal
                              Swal.fire(
                                 '{{ __('messages.swal-error-title') }}',
                                 '{{ __('messages.sixth-swal-error-message') }}',
                              );
                        }
                     }
                  });
            } else {
               //seventh swal
                  Swal.fire(
                     '{{ __('messages.seventh-swal-error-title') }}',
                     '{{ __('messages.seventh-swal-error-message') }}',
                  );
            }
         });
      }
      
      // Submit Dislike Action
      function rejectInviteMain(userId, element, is_connected, is_date=0) {
         // Prevent default action (e.g., form submission)
         if (is_connected == 0 && is_date == 0) {
            document.getElementById('comment_user').value = userId;
            document.getElementById('rejectUserId').value = userId;
            document.getElementById('commentModal').classList.add('show'); 
            document.getElementById('processStatus').value = "reject";
            document.getElementById('processIsConnect').value = is_connected;
         }else if (is_connected == 1 && is_date == 0) {
            document.getElementById('rejectUserId').value = userId;
            document.getElementById('havedateModal').classList.add('show');
            document.getElementById('processStatus').value = "reject";
            document.getElementById('processIsConnect').value = is_connected;
         }else{
            //first swal
            Swal.fire({
               title: '{{ __('messages.rejectInviteMain-title') }}',
               text: '{{ __('messages.rejectInviteMain-html-first') }}',
               showCancelButton: true,
               confirmButtonColor: '#38c172',
               cancelButtonColor: '#e3342f',
               confirmButtonText: '{{ __('messages.rejectInviteMain-confirmButtonText') }}',
               cancelButtonText: '{{ __('messages.rejectInviteMain-cancelButtonText') }}',
            }).then((result) => {
               if (result.isConfirmed) {
      
                  if(is_connected == 1){
                     //second swal
                     Swal.fire({
                     title: "{{ __('messages.rejectInviteMain-affinity-title') }}",
                     html: `{{ __('messages.rejectInviteMain-affinity-html-first') }}<br><br>
                              <span style="color: #f59800; padding: 2px 5px; font-weight: bold;">
                              {{ __('messages.rejectInviteMain-affinity-html-second') }}
                              </span>`,
                     allowOutsideClick: false,
                        didOpen: () => {
                           Swal.showLoading(); 
                        }
                     });
                  }else{
                     //third swal
                     Swal.fire({
                     title: "{{ __('messages.rejectInviteMain-syncing-title') }}",
                     html: `{{ __('messages.rejectInviteMain-syncing-html-first') }}<br><br>
                              <span style="color: #f59800; padding: 2px 5px; font-weight: bold;">
                              {{ __('messages.rejectInviteMain-syncing-html-second') }}
                              </span>`,
                     allowOutsideClick: false,
                        didOpen: () => {
                           Swal.showLoading(); 
                        }
                     });
                  }
      
                  $.ajax({
                     url: '/reject-action-url', 
                     type: 'POST', 
                     data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), 
                        reject_user_id: userId, 
                     },
                     success: function(response) {
                        if (response.success) {
                           //fourth swal
                              Swal.fire(
                                 '{{ __('messages.rejectInviteMain-hold—for-title') }}',
                                 '{{ __('messages.rejectInviteMain-hold—for-html-first') }}',
                                 
                              );
                              $('#affinityDropdownMenu').load(' #data2');
                              $('#data-refresh1').load(' #data-refresh2');
                        } else {
                           //fifth swal
                              Swal.fire(
                                 '{{ __('messages.rejectInviteMain-fifth-swal-error-title') }}',
                                 '{{ __('messages.rejectInviteMain-fifth-swal-error-message') }}',
                                 
                              );
                              $('#affinityDropdownMenu').load(' #data2');
                              $('#data-refresh1').load(' #data-refresh2');
                        }
                     }
                  });
               } else {
                  //sixth swal
                     Swal.fire(
                        '{{ __('messages.rejectInviteMain-sixth-swal-cancel-title') }}',
                        '{{ __('messages.rejectInviteMain-sixth-swal-cancel-message') }}',
                        
                     );
               }
            });
         }
      }
      
      // Submit Like Action
      function masteringResponseMain(status,userId) {
         if(status == 0){
            //first swal
            Swal.fire({
               title: '{{ __('messages.masteringResponseMain-title') }}',
               text: '{{ __('messages.masteringResponseMain-html-first') }}',
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#38c172',
               cancelButtonColor: '#e3342f',
               confirmButtonText: '{{ __('messages.masteringResponseMain-confirmButtonText') }}',
               cancelButtonText: '{{ __('messages.masteringResponseMain-cancelButtonText') }}'
            }).then((result) => {
               if (result.isConfirmed) {
                  //second swal
                  Swal.fire({
                     title: "{{ __('messages.masteringResponseMain-syncing-title') }}",
                     html: `{{ __('messages.masteringResponseMain-syncing-html-first') }}<br><br>
                           <span style="color: #f59800; padding: 2px 5px; font-weight: bold;">
                           {{ __('messages.masteringResponseMain-syncing-html-second') }}
                           </span>`,
                     allowOutsideClick: false,
                     didOpen: () => {
                        Swal.showLoading(); 
                     }
                  });
                  
                  $.ajax({
                     url: '/mastering-response-url',
                     type: 'POST', 
                     data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        accept_user_id: userId,
                        status: status,
                     },
                     success: function(response) {
                        if (response.success) {
                           $('#data-refresh1').load(' #data-refresh2');
                           if (response.isChatActivated) {
                              //third swal
                              Swal.fire({
                                 title: '{{ __('messages.masteringResponseMain-perfect-moment-title') }}',
                                 html: `{!! __('messages.masteringResponseMain-perfect-moment-html-first') !!}`,
                                 
                                 confirmButtonText: '{{ __('messages.masteringResponseMain-perfect-moment-confirmButtonText') }}'
                              }).then((result) => {
                                 if (result.isConfirmed) {
                                    window.location.href = `/messenger/${userId}`; 
                                 }
                                 $('#data-refresh1').load(' #data-refresh2');
                              });
                           }else{
                              //fourth swal
                              Swal.fire({
                                 title: '{{ __('messages.masteringResponseMain-almost-title') }}',
                                 text: "{{ __('messages.masteringResponseMain-almost-html-first') }}",
                                
                              });
                              
                           }
                           $('#affinityDropdownMenu').load(' #data2');
                           $('#data-refresh1').load(' #data-refresh2');
                        } else {
                           //fifth swal
                              Swal.fire(
                                 '{{ __('messages.masteringResponseMain-fifth-swal-error-title') }}',
                                 '{{ __('messages.masteringResponseMain-fifth-swal-error-message') }}',
                                 
                              );
                        }
                     }
                  });
               }
            });
         }else{
            if(status == 1){
               document.getElementById('comment_user').value = userId;
               document.getElementById('rejectUserId').value = userId;
               document.getElementById('commentModal').classList.add('show'); 
               document.getElementById('processStatus').value = "mastering";
            }else{
               $.ajax({
                     url: '/mastering-response-url',
                     type: 'POST', 
                     data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        accept_user_id: userId,
                        status: 1,
                     },
                     success: function(response) {
                        $('#data-refresh1').load(' #data-refresh2'); 
                        if (response.success) {
                           //sixth swal
                           Swal.fire(
                              '{{ __('messages.masteringResponseMain-sixth-swal-cancel-title') }}',
                              '{{ __('messages.masteringResponseMain-sixth-swal-cancel-message') }}',
                              
                           );
                           $('#refreshData1').load(' #refreshData2');
      
                        } else {
                           //seventh swal
                           Swal.fire(
                                 '{{ __('messages.masteringResponseMain-seventh-swal-cancel-title') }}',
                                 '{{ __('messages.masteringResponseMain-seventh-swal-cancel-message') }}',
                                 
                           );
                        }
                     }
               });
            }
         }
      }
      
      function publishCommentMain(user_id, liked_user_id) {
         //first swal
         Swal.fire({
            title: '{{ __('messages.publishCommentMain-title') }}',
            text: '{{ __('messages.publishCommentMain-html-first') }}',
            
            showCancelButton: true,
            confirmButtonColor: '#38c172',
            cancelButtonColor: '#e3342f',
            confirmButtonText: '{{ __('messages.publishCommentMain-confirmButtonText') }}',
             cancelButtonText: '{{ __('messages.publishCommentMain-cancelButtonText') }}'
         }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                  url: '/publish-comment',
                  type: 'POST', 
                  data: {
                     _token: $('meta[name="csrf-token"]').attr('content'),
                     user_id: user_id,
                     liked_user_id: liked_user_id,
                  },
                  success: function(response) {
                     if(response.success) {
                        //second swal
                        Swal.fire(
                           '{{ __('messages.publishCommentMain-second-title') }}',
                           '{{ __('messages.publishCommentMain-second-html-first') }}',
                           
                        );
                        $("#commentsSection").load(location.href + " #commentsSection");
                     }
                  }
               });
            }
         });
      
      }
   </script>
   <script>
      // Get modal and button elements
      const modal1 = document.getElementById("myModal1");
      const openBtn1 = document.getElementById("openModal1");
      const closeBtn1 = document.querySelector(".closedata");
      
      
      function openDisagreeModal() {
         modal1.style.display = "block";
      }
      // Open modal when button is clicked
      openBtn1.onclick = function () {
         modal1.style.display = "block";
      };
      
      // Close modal when (x) is clicked
      closeBtn1.onclick = function () {
         modal1.style.display = "none";
      };
      
      // Close modal when clicking outside the modal
      window.onclick = function (event) {
         if (event.target === modal1) {
               modal1.style.display = "none";
         }
      };
      
      $(document).ready(function () {
         
         const urlParams = new URLSearchParams(window.location.search);
         
         if (urlParams.has('mastering-activate')) {
            const userId = urlParams.get('mastering-activate');
            triggerMasteringSwal(userId);
         }
      
      });
      
      function triggerMasteringSwal(userId) {
         $.ajax({
            url: '/mastering-activation-check',
            type: 'POST', 
            data: {
               _token: $('meta[name="csrf-token"]').attr('content'),
               user_id: userId,
            },
            success: function(response) {
               
               if (response.success) {
                  Swal.fire({
                     title: '',
                     html: `
                        <div class="master-class p-4 mastering-text-content" style="margin-top:5rem;">
                           <p class="my-4" style="text-align: left;"><img src="{{asset('/pictures/mastering-logo-whi.png') }}" width="100%" /></p>
                           <p class="my-4" style="text-align: left;"><strong>{{ __('messages.triggerMasteringSwal-first') }}</strong></p>
                           <p class="my-0" style="text-align: left;"><strong>🔥 {{ __('messages.triggerMasteringSwal-second') }}</strong></p>
                           <p style="text-align: left;">{{ __('messages.triggerMasteringSwal-third') }}</p>
                           <p class="my-4" style="text-align: left;"><strong>{{ __('messages.triggerMasteringSwal-fourth') }}</strong></p>
                           <ul class="my-2 px-0">
                           <li>✨ <strong>{{ __('messages.triggerMasteringSwal-fifth-l1') }} –</strong> {{ __('messages.triggerMasteringSwal-fifth-l2') }}</li><br>
                           <li>✨ <strong>{{ __('messages.triggerMasteringSwal-fifth-l3') }} –</strong> {{ __('messages.triggerMasteringSwal-fifth-l4') }}</li><br>
                           <li>✨ <strong>{{ __('messages.triggerMasteringSwal-fifth-l5') }} –</strong> {{ __('messages.triggerMasteringSwal-fifth-l6') }}</li><br>
                           <li>✨ <strong>{{ __('messages.triggerMasteringSwal-fifth-l7') }} –</strong> {{ __('messages.triggerMasteringSwal-fifth-l8') }}</li><br>
                           </ul>
                           <p class="my-4" style="text-align: left;">{{ __('messages.triggerMasteringSwal-eighth') }}</p>
                           <p class="my-2" style="text-align: left;"><strong>💡 {{ __('messages.triggerMasteringSwal-ninth') }}</strong></p>
                        </div>
                        <div class="text-center mt-4">
                           <button id="btnImIn" class="btn btn-primary mx-2 my-2">{{ __('messages.triggerMasteringSwal-btn-in') }}</button>
                           <button id="btnReplay" class="btn mx-2 my-2" style="background: #00CCFF !important;">{{ __('messages.triggerMasteringSwal-btn-reply') }}</button>
                           <button id="btnNoThanks" class="btn mx-2 my-2" style="background: #EF2B7C; !important;">{{ __('messages.triggerMasteringSwal-btn-nothanks') }}</button>
                        </div>
                     `,
                     showConfirmButton: false,
                     showCancelButton: false,
                     width: 780,
                     didOpen: () => {
                        document.getElementById('btnImIn').addEventListener('click', () => {
                           Swal.close();
                           masteringResponseMain(0, userId);
                        });
      
                        document.getElementById('btnReplay').addEventListener('click', () => {
                           Swal.close();
                           if (userId && userId !== null && userId !== 0) {
                              window.location.href = `/show-all/${userId}/view`;
                           }
                            
                        });
      
                        document.getElementById('btnNoThanks').addEventListener('click', () => {
                           Swal.close();
                           if (response.IsCommentDone) {
                              masteringResponseMain(2, userId);
                           }else{
                              masteringResponseMain(1, userId);
                           }
                        });
                     }
                  });      
               }else{
                  Swal.fire({
                     title: '',
                     text: "{{ __('messages.triggerMasteringSwal-swal-error-message') }}",
                  });
               }
            }
         });
         
      }  
      
      function haveADate() {
         let form = $('#haveDAteForm')[0];
         let formData = new FormData(form);
      
         document.getElementById('havesubmitBtnText').classList.add('d-none');
         document.getElementById('havesubmitLoader').classList.remove('d-none');
      
         $.ajax({
               url: '/have-date',
               type: 'POST',
               data: formData,
               processData: false,
               contentType: false,
               success: function (response) {
                  document.getElementById('havesubmitBtnText').classList.remove('d-none');
                  document.getElementById('havesubmitLoader').classList.add('d-none');
                  closeModal();
                  if (response.success) {
                     const userId = $('#rejectUserId').val(); 
   
                     if (response.link === 'feedback') {
                        document.getElementById('feedback_user').value = userId;
                        document.getElementById('feedbackModal').classList.add('show');
                     } else if (response.link === 'comment') {
                        document.getElementById('comment_user').value = userId;
                        document.getElementById('commentModal').classList.add('show'); 
                     }
                  }
               }
         });
      }
      
      function SubmitFeedback() {
         const maxLength = 150;
         const fields = [
            { id: 'not_connect', counter: 'not_connect_counter' },
            { id: 'connect_person', counter: 'connect_person_counter' },
            { id: 'compliment', counter: 'compliment_counter' }
         ];

         let valid = true;
         $('#photogenicError').text('');
         $('#expressivenessError').text('');
         $('#attentionError').text('');
         $('#mannersError').text('');
         $('#opinions_ideasError').text('');
         $('#sense_humerError').text('');
         $('#energyError').text('');
         $('#willingnessError').text('');

         // Check if "photogenic" is selected
         if (!$('input[name="photogenic"]:checked').val()) {
            $('#photogenicError').text('{{ __("messages.info_required") }}');
            valid = false;
         }

         if (!$('input[name="expressiveness"]:checked').val()) {
            $('#expressivenessError').text('{{ __("messages.info_required") }}');
            valid = false;
         }
         if (!$('input[name="attention"]:checked').val()) {
            $('#attentionError').text('{{ __("messages.info_required") }}');
            valid = false;
         }
         if (!$('input[name="manners"]:checked').val()) {
            $('#mannersError').text('{{ __("messages.info_required") }}');
            valid = false;
         }
         if (!$('input[name="opinions_ideas"]:checked').val()) {
            $('#opinions_ideasError').text('{{ __("messages.info_required") }}');
            valid = false;
         }
         if (!$('input[name="sense_humer"]:checked').val()) {
            $('#sense_humerError').text('{{ __("messages.info_required") }}');
            valid = false;
         }
         if (!$('input[name="energy"]:checked').val()) {
            $('#energyError').text('{{ __("messages.info_required") }}');
            valid = false;
         }
         if (!$('input[name="willingness"]:checked').val()) {
            $('#willingnessError').text('{{ __("messages.info_required") }}');
            valid = false;
         }


          // --- Validate serious_relationship selection ---
         let seriousRelationship = $('input[name="serious_relationship"]:checked').val();

         if (seriousRelationship === 'No') {
            const maxLength = 150;

            let notConnectVal = $('#not_connect').val().trim();
            let complimentVal = $('#compliment').val().trim();

            if (notConnectVal.length === 0) {
               $('#notConnectError').text('{{ __("messages.info_required") }}');
               valid = false;
            } else if (notConnectVal.length > maxLength) {
               $('#notConnectError').text('Max 150 characters allowed.');
               valid = false;
            }

            if (complimentVal.length === 0) {
               $('#complimentError').text('{{ __("messages.info_required") }}');
               valid = false;
            } else if (complimentVal.length > maxLength) {
               $('#complimentError').text('Max 150 characters allowed.');
               valid = false;
            }
         }
         fields.forEach(field => {
            const textarea = document.getElementById(field.id);
            const counter = document.getElementById(field.counter);
            const currentLength = textarea.value.length;

            if (currentLength > maxLength) {
                  // Disable the submit button and show an error if limit is exceeded
                  document.getElementById('feedbacksubmitBtn').disabled = true;
                  valid = false;
            } else {
                  // Update character count and re-enable button if valid
                  document.getElementById('feedbacksubmitBtn').disabled = false;
            }

            counter.textContent = `${currentLength} / ${maxLength}`;
         });

         if (!valid) {
            // Show error message if the form is invalid
            Swal.fire({
                  title: 'Character limit exceeded',
                  text: 'One or more fields have exceeded the 150 character limit.',
            });
            return; // Prevent form submission if invalid
         }

         // If everything is valid, proceed with form submission
         let form = $('#feedbackForm')[0];
         let formData = new FormData(form);
         const process_is_connect = $('#processIsConnect').val();

         document.getElementById('feedbacksubmitBtnText').classList.add('d-none');
         document.getElementById('feedbacksubmitLoader').classList.remove('d-none');

         $.ajax({
            url: '/feedback-submit',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                  document.getElementById('feedbacksubmitBtnText').classList.remove('d-none');
                  document.getElementById('feedbacksubmitLoader').classList.add('d-none');
                  closefeedbackModal();
                  const userId = $('#rejectUserId').val();
                  if (response.success && seriousRelationship == 'No') {
                     Swal.fire({
                        title: '{{ __('messages.SubmitFeedback-title') }}',
                        html: `{{ __('messages.SubmitFeedback-message-first') }}<br>{{ __('messages.SubmitFeedback-message-second') }}`,
                        
                     });
                     $('#affinityDropdownMenu').load(' #data2');
                  }
                  if (response.success && seriousRelationship == 'Yes') {
                     Swal.fire({
                        title: '{{ __('messages.SubmitFeedback-title') }}',
                        html: `{{ __('messages.SubmitFeedback-message-first') }}<br>{{ __('messages.SubmitFeedback-message-second') }}`,
                        
                     });
                     $('#affinityDropdownMenu').load(' #data2');
                  }
            },
            error: function (xhr) {
                  document.getElementById('feedbacksubmitBtnText').classList.remove('d-none');
                  document.getElementById('feedbacksubmitLoader').classList.add('d-none');

                  let feedbackError = document.getElementById('feedbackError');
                  feedbackError.innerHTML = ''; 

                  if (xhr.status === 422) {
                     let response = xhr.responseJSON;
                     let errors = response.errors;
                     let errorMessages = '';

                     // Loop through each field error
                     for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                              errors[field].forEach(function (error) {
                                 errorMessages += '<div class="text-danger">' + error + '</div>';
                              });
                        }
                     }

                     feedbackError.innerHTML = errorMessages; 
                  } else {
                     feedbackError.innerHTML = '<div class="text-danger">{{ __('messages.SubmitFeedback-error-title') }}</div>';
                  }
            }
         });
      }

      
      
      function SubmitComment(){
         const addComment = $('#comments12').val(); 
         const reasonDescription1 = $('#reasonDescription1').val();
         const reason_profile1 = $('#reason_profile0').is(':checked'); 
         const reason_profile2 = $('#reason_profile1').is(':checked');
         let commentError = document.getElementById('commentError');
         commentError.innerHTML = '';
      
         if (
            (!reasonDescription1 || reasonDescription1.trim() === '') && !reason_profile1 && !reason_profile2){
            commentError.innerHTML = '<div class="text-danger">{{ __('messages.SubmitComment-validation-error') }}</div>';
            return;
         }
      
         let form = $('#commentForm')[0];
         let formData = new FormData(form);
         const userId = $('#rejectUserId').val(); 
         const process__status = $('#processStatus').val();
         const process_is_connect = $('#processIsConnect').val();
    
         document.getElementById('submitBtnText').classList.add('d-none');
         document.getElementById('submitLoader').classList.remove('d-none');
      
         $.ajax({
            url: '/comment-submit',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
               document.getElementById('submitBtnText').classList.remove('d-none');
               document.getElementById('submitLoader').classList.add('d-none');
               closecommentModal();
               if (response.success) {
                  if(process__status == "reject"){
                     rejectInviteMain(userId, "", process_is_connect, 1);
                  }else if(process__status == "mastering"){
                     masteringResponseMain(2,userId);
                  }
               }
            },
            error: function (xhr) {
               document.getElementById('submitBtnText').classList.remove('d-none');
               document.getElementById('submitLoader').classList.add('d-none');
      
                  if (xhr.status === 422) {
                     let response = xhr.responseJSON;
                     let errors = response.errors;
                     let errorMessages = '';
      
                     // Loop through each field error
                     for (let field in errors) {
                           if (errors.hasOwnProperty(field)) {
                              errors[field].forEach(function (error) {
                                 errorMessages += '<div class="text-danger">' + error + '</div>';
                              });
                           }
                     }
      
                     commentError.innerHTML = errorMessages; // Show the errors inside the span
               } else {
                  commentError.innerHTML = '<div class="text-danger">{{ __('messages.SubmitFeedback-error-title') }}</div>';
               }
            }
         });
      }
      
      function closeModal() {
         document.getElementById('havedateModal').classList.remove('show');
      }
      
      function closefeedbackModal() {
         document.getElementById('feedbackModal').classList.remove('show');
      }
      
      function closecommentModal() {
         document.getElementById('commentModal').classList.remove('show');
      }
      
      function toggleReasonSelectMain() {
         var checkbox1 = document.getElementById('pictureCheckbox1');
         var container1 = document.getElementById('reasonSelectContainer1');
         
         if (checkbox1.checked) {
               container1.style.display = 'block'; 
         } else {
               container1.style.display = 'none'; 
         }
      }
      
      function toggleDescriptionSelectMain() {
         var checkbox2 = document.getElementById('descriptionCheckbox1');
         var container2 = document.getElementById('descriptionSelectContainer1');
         
         if (checkbox2.checked) {
               container2.style.display = 'block'; 
         } else {
               container2.style.display = 'none'; 
         }
      }
      
      function toggleFeedbackFields1(selectVal) {
         if (selectVal === "Yes") {
            $('#not_connect_box1').addClass('hide');
            $('#not_connect_box2').addClass('hide');
            $('#connect_person_box1').removeClass('hide');
         } else if (selectVal === "No") {
            $('#not_connect_box1').removeClass('hide');
            $('#not_connect_box2').removeClass('hide');
            $('#connect_person_box1').addClass('hide');
         } else {
            $('#not_connect_box1').removeClass('hide');
            $('#not_connect_box2').removeClass('hide');
            $('#connect_person_box1').removeClass('hide');
         }
      }
   </script>
   <script>
      document.addEventListener('DOMContentLoaded', function () {
         const fields = [
            { id: 'not_connect', counter: 'not_connect_counter', error: 'not_connect_error' },
            { id: 'connect_person', counter: 'connect_person_counter', error: 'connect_person_error' },
            { id: 'compliment', counter: 'compliment_counter', error: 'compliment_error' }
         ];

         const submitButton = document.getElementById('feedbacksubmitBtn');
         const submitText = document.getElementById('feedbacksubmitBtnText');
         const submitLoader = document.getElementById('feedbacksubmitLoader');

         fields.forEach(field => {
            const textarea = document.getElementById(field.id);
            const counter = document.getElementById(field.counter);
            const error = document.getElementById(field.error);

            if (textarea && counter && error) {
                  textarea.addEventListener('input', function () {
                     let len = this.value.length;
                     if (len > 150) {
                        this.value = this.value.substring(0, 150);
                        len = 150;
                        error.style.display = 'block';
                        submitButton.disabled = true;  // Disable the submit button
                     } else {
                        error.style.display = 'none';
                        submitButton.disabled = false; // Enable the submit button
                     }
                     counter.textContent = `${len} / 150`;
                  });
            }
         });
      });
   </script>
 
</html>