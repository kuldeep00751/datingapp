@extends('layouts.app') 
@section('content')
<style>
   body{
      /* background: url('public/pictures/Background2.jpg') no-repeat center center;
      background-size: cover; */
      height: auto;
      color: white;
   }
   main
   {
      background: url('public/pictures/Background2.jpg') no-repeat center center;
      background-size: cover;
      background-attachment: fixed;
   }
   
   .slidecontainer {
   width: 100%;
   }
   .intl-tel-input,
   .iti{
   width: 100%;
   }
   .slider {
   -webkit-appearance: none;
   width: 100%;
   height: 15px;
   border-radius: 5px;
   background: #d3d3d3;
   outline: none;
   opacity: 0.7;
   -webkit-transition: .2s;
   transition: opacity .2s;
   }
   .slider:hover {
   opacity: 1;
   }
   .slider::-webkit-slider-thumb {
   -webkit-appearance: none;
   appearance: none;
   width: 25px;
   height: 25px;
   border-radius: 50%;
   background: #d0211c;
   cursor: pointer;
   }
   .select2-container--default .select2-selection--single.is-invalid {
   border: 1px solid #dc3545 !important; /* Bootstrap's red border for invalid fields */
   border-radius: 0.375rem;  /* Bootstrap's border-radius for form controls */
   }
   .select2-container--default.select2-container--focus .select2-selection--multiple {
   border: solid #d4d4d4 1px !important;
   outline: 0;
   padding: 6px !important;
   }
   .select2-container--default .select2-selection--multiple {
   border: 1px solid #d6d6d6 !important;
   padding: 6px !important;
   }
   .slider::-moz-range-thumb {
   width: 25px;
   height: 25px;
   border-radius: 50%;
   background: #d0211c;
   cursor: pointer;
   }
   label {
   display: inline-block;
   margin-bottom: 0.5rem;
   font-weight: 700;
   margin: 15px 0px 0px;
   }
   .select2-container .select2-selection--single {
   height: 37px !important;
   border: 1px solid #ced4da !important;
   }
   .select2-container--default .select2-selection--single .select2-selection__rendered {
   line-height: 37px !important;
   }
   .select2-container--default .select2-selection--single .select2-selection__arrow {
   height: 36px !important;
   }
   .heading_title {
   /* background: #ccc;
   padding: 10px; */
   font-size: 20px;
   border-bottom: 2px solid gray;
   }
   .image-container {
   position: relative;
   width: 100px;
   height: 100px;
   overflow: hidden;
   }
   .image-overlay {
   display: none; /* Initially hidden */
   position: absolute;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   background: rgba(0, 0, 0, 0.6); /* Semi-transparent black */
   
   z-index: 1; /* Ensure it appears above the image */
   }
   .image-container:hover .image-overlay {
   display: flex; /* Show overlay on hover */
   }
   .image-container img {
   display: block; /* Ensure no gaps around the image */
   width: 100%;
   height: 100%;
   object-fit: cover; /* Ensure the image fits the container */
   }
   #controls {
   margin: 20px 0;
   }
   .profile-header {
   text-align: center;
   margin-bottom: 20px;
   }
   .profile-picture {
   width: 120px;
   height: 120px;
   border-radius: 50%;
   object-fit: cover;
   margin-bottom: 10px;
   }
   .form-section {
   margin-top: 30px;
   margin-bottom: 20px;
   }
   .count-display{
   display:none;
   }
   .textarea-container {
   margin-bottom: 20px;
   }
   .word-count {
   font-size: 14px;
   color: #555;
   }
   .error {
   font-size: 14px;
   color: red;
   margin-top: 5px;
   }
   .swal-custom-popup {
   width: 600px !important;  
   height: 420px !important; 
   }
   .swal-custom-title {
   font-size: 32px !important; 
   }
   .swal-custom-text {
   font-size: 28px !important; 
   }
   .page-img-bottom {
   position: absolute;
   bottom: 0px;
   width: 100%;
   right: 0px;
   }
</style>
<style>
   .box-4567 {
    position: relative;
    
   }
   .gettop-200
   {
      margin-top: -80px !important;
   }
   .heading-page {
      font-family: 'AvenirNext';
      color: #a7a6a6;
      font-size: 43px;
   }
   .profile-cover{
   background-size: cover;
   background-position: center;
   height: 350px;
   width: 1100px;
   
   content: ''; 
   
   left: 0;
   height: 100%;
   width: 100%;

   }
   .upload {
   padding: 5px;
   position: absolute;
   right: 29px;
   }
   .uploadIcon{
   color: white;
   float: right;
   padding: 8px;
   border: 1px solid #b5b5b5;
   background: #626262b8;
   }
   .profile-pic-upload:hover{
   opacity: 0.9;
   content: ''; 
   top: 0;
   left: 0;
   height: 100%;
   width: 100%;
   background: #000;
   }
</style>
<style>
   ._success {
   width: 100%;
   text-align: center;
   margin: 40px auto;
   }
   ._success i {
   font-size: 55px;
   color: #28a745;
   }
   ._success h2 {
   margin-bottom: 12px;
   font-size: 30px;
   font-weight: 500;
   line-height: 1.2;
   margin-top: 10px;
   }
   ._success p {
   margin-bottom: 0px;
   font-size: 20px;
   color: #495057;
   font-weight: 500;
   }
   .cropper-bg {
   background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAQMAAAAlPW0iAAAAA3NCSVQICAjb4U/gAAAABlBMVEXMzMz////TjRV2AAAACXBIWXMAAArrAAAK6wGCiw1aAAAAHHRFWHRTb2Z0d2FyZQBBZG9iZSBGaXJld29ya3MgQ1M26LyyjAAAABFJREFUCJlj+M/AgBVhF/0PAH6/D/HkDxOGAAAAAElFTkSuQmCC);
   width: 100% !important;
   }
   .btnupload
   {  
      /* padding: 4px 18px 2px;
      font-size: 25px; */
      background: unset;
      /* border: 3px solid #797676;
      border-radius: 10px;
      outline: initial; */
      color: #333;
      background-color: unset !important;
      border: unset !important;
   }
   .btnupload-plus
   {  
      padding: 4px 18px 2px;
      font-size: 40px;
      /* background: inherit; */
      border: 3px solid #797676;
      border-radius: 10px;
      outline: initial;
      /* color: #333; */
   }
</style>
<style>
   body {
   font-family: 'Segoe UI', sans-serif;
   background: url('public/pictures/Background2.jpg'), #f3f3f3;
   background-size: cover;
   color: #fff;
   }

   .top-bar {
   display: flex;
   justify-content: space-between;
   align-items: center;
   background-color: #444;
   padding: 10px 20px;
   }

   .logo {
   /* width: 30px;
   height: 30px; */
   /* background-color: #fff; */
   clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
   }

   .nav-icons {
   display: flex;
   gap: 10px;
   }

   .icon {
   background-color: #111;
   color: #fff;
   padding: 10px;
   text-align: center;
   width: 60px;
   font-size: 12px;
   cursor: pointer;
   }

   .icon.profile {
   width: 30px;
   height: 30px;
   border-radius: 50%;
   background-image:url('{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : (Auth::user()->avatar ? Auth::user()->avatar : asset('pictures/default.png')) }}');
   background-size: cover;
   }

   .profile-container {
   text-align: center;
   /* padding: 40px 20px; */
   }

   .profile-container h1 {
   font-weight: 300;
   color: #666;
   margin-bottom: 20px;
   }

   .profile-images {
   display: flex;
   justify-content: center;
   gap: 20px;
   margin-bottom: 20px;
   }

   .profile-images img {
   width: 200px;
   height: 250px;
   object-fit: cover;
   border-radius: 4px;
   }

   .image-instructions {
   display: flex;
   align-items: center;
   justify-content: center;
   gap: 15px;
   color: #ccc;
   margin-bottom: 40px;
   }

   .plus-box {
   border: 1px solid #ccc;
   padding: 10px 15px;
   font-size: 20px;
   border-radius: 6px;
   }

   .form-section {
   background-color: #222222e0;
   padding: 40px;
   max-width: 1000px;
   margin: 0 auto;
   border-radius: unset;
   }

   .form-section h2,.form-section h1 {
   font-weight: 300;
   margin-bottom: 30px;
   color: #ccc;
   font-family: 'AvenirNext', sans-serif;
   }

   form {
   display: flex;
   justify-content: space-between;
   flex-wrap: wrap;
   gap: 20px;
   }

   .form-group {
   flex: 1;
   min-width: 250px;
   display: flex;
   flex-direction: column;
   }

   label {
   margin-bottom: 5px;
   color: #aaa;
   }
   .profile-section input[type="text"],
   .profile-section input[type="email"],
   .profile-section input[type="date"],
   .profile-section textarea,
   .profile-section select,
   .profile-section input[type="number"],
   .profile-section #radius-select,
   .profile-section #location-prompt,
   .profile-section .select2-selection{
      padding: 10px;
      background-color: #22222205;
      border: 1px solid #777;
      border-radius: 4px;
      color: #fff;
      width: 100%;
      box-sizing: border-box;
      transition: 0.3s ease;
   }

   .profile-section input[type="text"]:focus,
   .profile-section input[type="email"]:focus,
   .profile-section input[type="date"]:focus,
   .profile-section textarea:focus,
   .profile-section select:focus,
   .profile-section input[type="number"]:focus,
   .profile-section #radius-select:focus,
   .profile-section #location-prompt:focus,
   .profile-section .select2-selection:focus{
      background-color: #222; /* slightly darker */
      border-color: #fff;     /* highlight border */
      color: #fff;
      outline: none;
   }
   /* Style the original select element (in case JS fails or for fallback) */
   .profile-section select {
   padding: 10px;
   background-color: #22222205;
   border: 1px solid #777;
   border-radius: 4px;
   color: #fff;
   width: 100%;
   box-sizing: border-box;
   }

   /* Style the visible Select2 element */
   .profile-section .select2-container--default .select2-selection--single {
   background-color: #22222205;
   border: 1px solid #777;
   border-radius: 4px;
   color: #fff;
   height: 38px;
   display: flex;
   align-items: center;
   }

   /* Style the text inside the selected item */
   .profile-section .select2-container--default .select2-selection--single .select2-selection__rendered {
   color: #fff;
   line-height: 36px;
   padding-left: 10px;
   }

   /* Style the arrow */
   .profile-section .select2-container--default .select2-selection--single .select2-selection__arrow {
   height: 36px;
   }

   /* Dropdown panel */
   .profile-section .select2-container--default .select2-results>.select2-results__options {
   background-color: ##22222205;
   color: #fff;
   }

   /* Hover/focus on options */
   .profile-section .select2-container--default .select2-results__option--highlighted {
   background-color: #22222205;
   color: #fff;
   }
   .profile-section select{
      padding-top:5px;
      padding-bottom:5px;
   }
   .profile-section .row .col-md-6{
      margin-bottom:1rem;
   }
   .btn-icon123 a,.btn-icon123 button
   {
      
   border-radius: 100%;
   width: 30px;
   height: 30px;

   }

   .profile-section-heading {
      text-align: center;
      margin-top: 30px;
      color: #ccc;
   }

   .profile-title {
      font-weight: 300;
      margin-bottom: 3px !important;
      font-family: 'AvenirNext', sans-serif;
   }

   .profile-subtext {
      font-size: 21px;
      font-style: italic;
      max-width: 680px;
      margin: 0 auto;
      font-family: 'AvenirNext', sans-serif;
      line-height: 27px;
      margin-bottom: 30px;
   }
   .imgprofile-23
   {
      margin: 5px; 
      width: 180px; 
      height: 330px;
      border-radius: 0%;
      border: 3px solid #ffffffd9;
   }
   @media(max-width : 786px)
   {
      .imgprofile-23 
      {
      width: 140px;
      height: 255px;
      }
      #location-prompt img
      {
         height: 100px;
      }
      #location-prompt h1
      {
        font-size: 20px;
        font-weight: bold;
      }
      #location-prompt p
      {
        font-size: 16px;
      }
      #location-prompt .float-left
      {
         margin-top:0% !important; 
      }

      .box-342
      {
         display: flex;
         vertical-align: top;
         align-items: baseline;
         margin-top: 35px;
      }
      .box-2344
      {
         display: flex;
         vertical-align: top;
         align-items: baseline;
      }
      .adjust-upload .upload-text{
         font-size:12px !important;
      }
   }
   .checkbox-with-label {
      display: flex;
      align-items: flex-start;
      gap: 10px;
   }

   .checkbox-with-label input[type="checkbox"] {
      margin-top: 10px; /* fine-tune alignment */
      transform: scale(1.5);
   }
   .adjust-upload .upload-text{
      font-size:16px;
   }
</style>

<div class="container d-flex flex-column justify-content-center align-items-center h-100">
   <div class="row justify-content-center">
      <!-- Profile Picture -->
      @if (session('status'))
      <div class="alert alert-success" role="alert">
         {{ session('status') }}
      </div>
      @endif
      <!-- Modal for cropping -->
      
      <div class="modal" id="imageModal" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-modal="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">@lang('messages.profile_crop_title')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @php 
               $feedbacks = getUserFeedback(auth()->user()->id);
               $feedbackExit = ($feedbacks['feedbackAverages']['photogenic_avg']) ?? 0;
               @endphp
               <div class="modal-body" id="Modal-body-1">
                  <div style="position: relative;">
                     <img id="imageToCrop" src="" style="max-width: 100%;">
                  </div>
                  <button id="cropImageButton" class="btn btn-primary mt-3" data-feedback="{{$feedbackExit}}">crop </button>
               </div>
               <div class="modal-body d-none" id="Modal-body-2">
                  <h4 id="previewText" class="mt-1 mb-1">@lang('messages.profile_preview_message')</h4>
                  <div id="imagePreviews" style="position: relative;"></div>
                  <button id="uploadCropImageButton" class="btn btn-primary mt-3">@lang('messages.profile_preview_btn_upload') <span id="loadingSpinner" class="spinner-border spinner-border-sm text-light d-none" role="status" aria-hidden="true"></span></button>
                  <button id="backToCrop" class="btn btn-secondary mt-3">@lang('messages.profile_preview_btn_tryagain')</button>
               </div>
            </div>
         </div>
      </div>
      @if($user->provide_proof != 1 || $user->is_single != 1 || $user->is_enjoy != 1 || $user->is_take_care != 1 || $user->is_meet_people != 1 || $user->is_understand_platform != 1 || $user->is_term_condition != 1)
      <style>
         .navbar-custom { display:none;}
         main
         {
            position: relative;
            width: 100%;
            height: 100%;
            background: url('{{ asset("pictures/welcome_background.png") }}') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
         }

         main::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
            z-index: 0;
         }
         .form-section {
            background-color: #2222227a;
            padding: 25px 0px 25px 20px;
            width: 100%;
            margin: 0;
            border-radius: unset;
         }
         form {
            border: 2px solid;
         }
      </style>
      
      <form id="profileInstructionForm" action="{{ route('profile.updateInstruction') }}" method="POST" style="z-index: 1;margin-top: 10%;border: unset">
         @csrf
         <div class="d-flex justify-content-center w-100 my-5">
            <div class="col-lg-12 col-md-12 col-sm-10">
               <section class="form-section profile-section p-3" style="border: 2px solid #fff;">
                  <div class="row">
                     <div class="col-9 mb-5 mx-1" style="border-right:2px solid gray;height: 3rem;margin-top: 5px;">
                        <img src="{{ asset('pictures/logo.png') }}" width="80%" style="margin-top: -10px;"/>
                     </div>
                     <div class="col-2">
                        <h5> <a href="{{ route('lang.switch', ['lang' => 'en']) }}" class="text-white-50">English</a></h5>
                        <h5><a href="{{ route('lang.switch', ['lang' => 'es']) }}" class="text-white-50">Spanish</a></h5>
                     </div>
                  </div>
                  <label class="mt-2 mb-1 mx-4 mb-3">@lang('messages.profile_confirm_title'):</label>
                  
                  <div class="text-left mb-3">
                     <input type="checkbox" class="auto-check" id="is_single" name="is_single" style="transform: scale(1.5); margin-right: 5px;" {{ ($user->is_single == 1) ? 'checked': '' }}>
                     <label class="form-check-label m-0" for="is_single">@lang('messages.profile_is_single')</label>
                  </div>
                  <div class="text-left mb-3">
                     <input type="checkbox"  class="auto-check" id="is_enjoy" name="is_enjoy" style="transform: scale(1.5); margin-right: 5px;" {{ ($user->is_enjoy == 1) ? 'checked': '' }}>
                     <label class="form-check-label m-0" for="is_enjoy">@lang('messages.profile_is_enjoy')</label>
                  </div>
                  <div class="text-left mb-3">
                     <input type="checkbox"  class="auto-check" id="is_take_care" name="is_take_care" style="transform: scale(1.5); margin-right: 5px;" {{ ($user->is_take_care == 1) ? 'checked': '' }}>
                     <label class="form-check-label m-0" for="is_take_care">@lang('messages.profile_is_take_care').</label>
                  </div>
                  <div class="text-left mb-3">
                     <input type="checkbox"  class="auto-check" id="is_meet_people" name="is_meet_people" style="transform: scale(1.5); margin-right: 5px;" {{ ($user->is_meet_people == 1) ? 'checked': '' }}>
                     <label class="form-check-label m-0" for="is_meet_people">@lang('messages.profile_is_meet_people').</label>
                  </div>
                  <div class="text-left mb-3">
                     <input type="checkbox"  class="auto-check" id="is_understand_platform" name="is_understand_platform" style="transform: scale(1.5); margin-right: 5px;" {{ ($user->is_understand_platform == 1) ? 'checked': '' }}>
                     <label class="form-check-label m-0" for="is_understand_platform">@lang('messages.profile_is_understand_platform').</label>
                  </div>
                  <div class="text-left mb-3">
                     <input type="checkbox" class="auto-check" id="is_term_condition" name="is_term_condition" style="transform: scale(1.5); margin-right: 5px;" {{ ($user->is_term_condition == 1) ? 'checked': '' }}>
                     <label class="form-check-label m-0" for="is_term_condition">@lang('messages.profile_is_term_condition1') <a href="{{route('privacy')}}">@lang('messages.profile_is_term_condition2')</a> @lang('messages.profile_is_term_condition3') <a href="{{route('term&condition')}}">@lang('messages.profile_is_term_condition4')</a>.</label>
                  </div>
                  <div class="checkbox-with-label text-left mb-3">
                     <input type="checkbox"  class="auto-check"  id="provide_proof" name="provide_proof" style="transform: scale(1.5); margin-right: 5px;" {{ ($user->provide_proof == 1) ? 'checked': '' }}>
                     <label class="form-check-label m-0" for="provide_proof">@lang('messages.profile_provide_proof')<br><small>@lang('messages.profile_provide_proof-sub')</small></label>
                  </div>
               </section>
           </div>
         </div>
      </form>
      <div class="col-md-12 footer mt-3 mb-5 text-center">
         <img src='{{ asset("pictures/1._First_Page-removebg-preview.png") }}' width="300">
        </div>
       
      @else
      <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
         @csrf
         <div class="w-100">
            @php
               $count = count($pictures);
            @endphp
           
            <div class="text-center profile-cover p-2 box-4567" style="background: #ffffff00; ">
               @if($count > 0)
               <h1 class="heading-page">@lang('messages.profile_0_1')</h1>
               @endif
               <!-- Display Uploaded Profile Picture or Default -->
               <div id="image_preview" class="p-2 d-flex flex-wrap justify-content-center ">
                  <div id="profilePicture-preview" class="d-flex flex-wrap justify-content-center" >
                     @foreach($pictures as $value)
                     <div class="image-container position-relative imgprofile-23" >
                        <!-- Link to Full Image -->
                        <a href="{{ asset('storage/' . $value->picture_location) }}" data-lightbox="gallery" data-title="{{ $value->profile_picture }}" class="image-link">
                        <img src="{{ asset('storage/' . $value->picture_location) }}" width="100" height="100" alt="Selected Image" style="aspect-ratio: 1 / 3; object-fit: cover;">
                        </a>
                        <!-- Overlay -->
                        <div class="image-overlay  align-items-center justify-content-center btn-icon123" >
                           <a class="btn btn-sm btn-primary btn-sm p-1 m-1 edit-image" href="{{ asset('storage/' . $value->picture_location) }}" data-lightbox="gallery" data-title="{{ $value->profile_picture }}" title="Preview"><i class="fa-solid fa-magnifying-glass"></i></a>
                           <button class="btn btn-sm btn-danger btn-sm delete-image p-1 m-1" data-id="{{ $value->id }}"  title="Delete"><i class="fa-solid fa-trash"></i></button>
                           <a href="" class="btn btn-sm btn-success btn-sm set-profile-image p-1 m-1 setProfileImage"  data-id="{{ $value->id }}" title="Set as Profile Image"><i class="fa-solid fa-user"></i></a>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
            </div>
            
            <!-- Preview Selected Images -->
         </div>
      
         <section class="form-section profile-section gettop-200">
            @if($count == 0)
            <h1 class="heading-page text-center">@lang('messages.profile_0_1')</h1>
            @endif
            <div class="image-instructions">
               <div id="profile-picture">
                  <div id="profile-picture-view">
                     
                     <!-- Hidden File Input -->
                     <input type="file" class="form-control d-none" id="profile_picture" name="profile_picture"  accept="image/*"  />
                     <!-- Custom Upload Button -->
                     <input type="hidden" id="croppedImage" name="croppedImage">
                     <div class="d-flex justify-content-center adjust-upload">
                        <p>
                           <button type="button" class="btnupload mt-2" title="@lang('messages.profile_0')" id="imageUpload" onclick="document.getElementById('profile_picture').click();" data-image-count="{{ getUploadImageCount() }}">
                              <i class="fas fa-plus btnupload-plus" style="color:#b7b3b3;font-weight:20;"></i> <!-- @lang('messages.profile_0') -->
                           </button>
                        </p>
                        <p style="font-family: 'AvenirNext', sans-serif;width: 50%;" class="m-2 upload-text">@lang('messages.profile_0_3'), @lang('messages.profile_0_4').</p>
                     </div>
                  </div>
               </div>
               
            </div>
            <!-- <h1 class="text-center" style="border-bottom: 2px solid gray;line-height: 2; ">@lang('messages.profile_0_2')</h1> -->
            <!-- Personal Information -->
            <!-- <div class="form-section">-->
               <div class="profile-section-heading">
                  <h1 class="profile-title">@lang('messages.profile_1')</h1>
                  <p class="profile-subtext">@lang('messages.profile_1_text')</p>
                  <p style="border-bottom: 2px solid gray;line-height: 2; margin-bottom:30px;"></p>
               </div>
               <div class="row g-3">
                  <div class="col-md-6">
                     <label for="name" class="form-label">@lang('messages.reg_name')</label>
                     <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your first name" value="{{ old('name', $user->name) }}" >
                  </div>
                  <div class="col-md-6">
                     <label for="last_name" class="form-label">@lang('messages.reg_last_name')</label>
                     <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="Enter your last name">
                  </div>
                  <div class="col-md-6">
                     <label for="like_to_be_called" class="form-label">@lang('messages.profile_3')</label>
                     <input type="text" class="form-control @error('like_to_be_called') is-invalid @enderror" id="like_to_be_called" name="like_to_be_called" placeholder="Preferred nickname" value="{{ old('like_to_be_called', $user->like_to_be_called) }}">
                  </div>
                  <div class="col-md-6">
                     <label for="email" class="form-label">@lang('messages.profile_2')</label>
                     <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" value="{{ old('email', $user->email) }}" >
                  </div>
                  <div class="col-md-6">
                     <label for="phone">@lang('messages.profile_4')</label>
                     <div class="input-group">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="e.g., 234 567 8901" value="{{ old('phone', $user->phone) }}" >
                        <input type="hidden" name="dialCode" id="dialCode" value="{{ old('dialCode', $user->dialCode) }}">
                     </div>
                  </div>
                  
                  <div class="col-md-6">
                     <label for="location" class="form-label d-none">@lang('messages.profile_11')</label>
                     <input type="hidden" class="form-control" id="location" name="location" placeholder="Where do you live?" value="{{ old('location', $user->location) }}" >
                     <input type="hidden" id="latitude" name="latitude">
                     <input type="hidden" id="longitude" name="longitude">
                     <input type="hidden" id="city" name="city">
                     <input type="hidden" id="country" name="country">
                     <ul id="address-dropdown"></ul>
                  </div>
                   <div class="col-md-12 mb-2">
                     <div class="px-2" id="radius-select">
                        <label for="radiusInput" class="form-label">@lang('messages.profile_13')</label><br>
                        <input type="range" id="radiusInput" name="radius" min="500" max="20000" step="100" value="{{ old('other_nationality_country', $user->radius ?? '500') }}"></br>
                        <span id="radiusValue">500 @lang('messages.profile_13_meters_text')</span>
                     </div>
                  </div>
                  <div class="col-md-12" style="width: 100%; height: 400px;">
                     <!-- Location Prompt Message -->
                     <div id="location-prompt" class="d-flex justify-content-center" >
                        <img src="{{ asset('feedback_Icons/google map.png') }}" alt="Location Placeholder" width="40%" />
                        <div class="float-left" style="margin-top:12%; line-height:1.1">
                           <h1 style="font-family: 'FutureBTBook', sans-serif;">@lang('messages.profile_13_map_1')</h1>
                           <p style="font-family: 'AvenirNext', sans-serif; font-weight:1000;font-size: 18px;">@lang('messages.profile_13_map_2').</p>
                           <a  href="" class="btn text-light" id="checkLocation"style="font-family: 'AvenirNext', sans-serif; font-weight:1000;border-radius: 0px; background:#FF0066;font-size: 18px;">@lang('messages.profile_13_map_3')</a>
                        </div>
                     </div>
                     <!-- Google Map Container -->
                     <div id="map" class="hide" style="width: 100%; height: 100%;"></div>
                  </div>
                  <div class="col-md-12 mb-2 mt-4 box-342">
                     <input type="radio" id="lock" name="is_lock_location" value="1"
                           style="transform: scale(1.5); margin-right: 5px;"
                           {{ $user->is_lock_location == 1 ? 'checked' : '' }}>
                     <label class="form-check-label m-0 mx-4" for="lock">
                        @lang('messages.profile_13_locklocation_1')
                     </label>
                  </div>

                  <div class="col-md-12 mb-2 box-342">
                     <input type="radio" id="unlock" name="is_lock_location" value="0"
                           style="transform: scale(1.5); margin-right: 5px;"
                           {{ $user->is_lock_location == 0 ? 'checked' : '' }}>
                     <label class="form-check-label m-0 mx-4" for="unlock">
                         @lang('messages.profile_13_locklocation_2')
                     </label>
                  </div>
               </div>
               <div class="profile-section-heading">
                  <h1 class="profile-title">@lang('messages.profile_14')</h1>
                  <p class="profile-subtext">@lang('messages.profile_14_text')</p>
                  <p style="border-bottom: 2px solid gray;line-height: 2; margin-bottom:30px;"></p>
               </div>
               <div class="row g-3 pt-3">
                  <div class="col-md-6">
                     <label for="academic_level" class="form-label">@lang('messages.profile_20')</label>
                     <select class="form-control @error('academic_level') is-invalid @enderror" id="academic_level" name="academic_level">
                        <option value="">@lang('messages.profile_20_option0')</option>
                        <option value="No formal education" {{ $user->academic_level == 'No formal education' ? 'selected' : '' }}>@lang('messages.profile_20_option1')</option>
                        <option value="Professional degree" {{ $user->academic_level == 'Professional degree' ? 'selected' : '' }}>@lang('messages.profile_20_option2')</option>
                        <option value="Especialized degree" {{ $user->academic_level == 'Especialized degree' ? 'selected' : '' }}>@lang('messages.profile_20_option3')</option>
                        <option value="Master’s degree" {{ $user->academic_level == 'Master’s degree' ? 'selected' : '' }}>@lang('messages.profile_20_option4')</option>
                        <option value="PhD" {{ $user->academic_level == 'PhD' ? 'selected' : '' }}>@lang('messages.profile_20_option5')</option>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label for="industry_you_work" class="form-label">@lang('messages.profile_21')</label>
                     <select class="form-control @error('industry_you_work') is-invalid @enderror" id="industry_you_work" name="industry_you_work">
                        <option value="" {{ $user->industry_you_work == '' ? 'selected' : '' }}>@lang('messages.profile_21_option0') </option>
                        <option value="Private and Public Administration - Control and Audits - Documentation" {{ $user->industry_you_work == 'Private and Public Administration - Control and Audits - Documentation' ? 'selected' : '' }}> @lang('messages.profile_21_option1') 
                        </option>
                        <option value="Food and Beverages - Culinary Arts" {{ $user->industry_you_work == 'Food and Beverages - Culinary Arts' ? 'selected' : '' }}> @lang('messages.profile_21_option2') 
                        </option>
                        <option value="Arts, Architecture, Music, Design, and Fashion" {{ $user->industry_you_work == 'Arts, Architecture, Music, Design, and Fashion' ? 'selected' : '' }}> @lang('messages.profile_21_option3') 
                        </option>
                        <option value="Commerce - Marketing and Advertising" {{ $user->industry_you_work == 'Commerce - Marketing and Advertising' ? 'selected' : '' }}> @lang('messages.profile_21_option4') 
                        </option>
                        <option value="Social Communication, Journalism, Languages, and Related Fields" {{ $user->industry_you_work == 'Social Communication, Journalism, Languages, and Related Fields' ? 'selected' : '' }}> @lang('messages.profile_21_option5')
                        </option>
                        <option value="Defense, Security, and Control" {{ $user->industry_you_work == 'Defense, Security, and Control' ? 'selected' : '' }}> @lang('messages.profile_21_option6') 
                        </option>
                        <option value="Sports, Wellness, Entertainment, and Tourism" {{ $user->industry_you_work == 'Sports, Wellness, Entertainment, and Tourism' ? 'selected' : '' }}> @lang('messages.profile_21_option7') 
                        </option>
                        <option value="Law, Political Science, Public and International Relations, and Related Fields" {{ $user->industry_you_work == 'Law, Political Science, Public and International Relations, and Related Fields' ? 'selected' : '' }}> @lang('messages.profile_21_option8') 
                        </option>
                        <option value="Education - Training - Coaching" {{ $user->industry_you_work == 'Education - Training - Coaching' ? 'selected' : '' }}> @lang('messages.profile_21_option9') 
                        </option>
                        <option value="Finance, Economics, Statistics - Accounting, Mathematics, and Related Fields" {{ $user->industry_you_work == 'Finance, Economics, Statistics - Accounting, Mathematics, and Related Fields' ? 'selected' : '' }}> @lang('messages.profile_21_option10') 
                        </option>
                        <option value="Engineering" {{ $user->industry_you_work == 'Engineering' ? 'selected' : '' }}> @lang('messages.profile_21_option11') 
                        </option>
                        <option value="Manual Labor - Construction, Manufacturing, Maintenance" {{ $user->industry_you_work == 'Manual Labor - Construction, Manufacturing, Maintenance' ? 'selected' : '' }}> @lang('messages.profile_21_option12') 
                        </option>
                        <option value="Health Sciences, Nutrition, and Aesthetics" {{ $user->industry_you_work == 'Health Sciences, Nutrition, and Aesthetics' ? 'selected' : '' }}> @lang('messages.profile_21_option13')
                        </option>
                        <option value="Psychology, Human Resources, and Mental Health" {{ $user->industry_you_work == 'Psychology, Human Resources, and Mental Health' ? 'selected' : '' }}> @lang('messages.profile_21_option14') 
                        </option>
                        <option value="Service and Customer Interaction" {{ $user->industry_you_work == 'Service and Customer Interaction' ? 'selected' : '' }}> @lang('messages.profile_21_option15') 
                        </option>
                        <option value="Assistance in Health and Therapeutic Care" {{ $user->industry_you_work == 'Assistance in Health and Therapeutic Care' ? 'selected' : '' }}> @lang('messages.profile_21_option16') 
                        </option>
                        <option value="Various Services" {{ $user->industry_you_work == 'Various Services' ? 'selected' : '' }}> @lang('messages.profile_21_option17') 
                        </option>
                        <option value="Software and Hardware Technologies" {{ $user->industry_you_work == 'Software and Hardware Technologies' ? 'selected' : '' }}> @lang('messages.profile_21_option18') 
                        </option>
                        <option value="Social Work, Sociology, Theology, Counseling, Philanthropy, and Volunteering" {{ $user->industry_you_work == 'Social Work, Sociology, Theology, Counseling, Philanthropy, and Volunteering' ? 'selected' : '' }}> @lang('messages.profile_21_option19') 
                        </option>
                        <option value="Transportation" {{ $user->industry_you_work == 'Transportation' ? 'selected' : '' }}> @lang('messages.profile_21_option20') 
                        </option>
                        <option value="Animal Health" {{ $user->industry_you_work == 'Animal Health' ? 'selected' : '' }}> @lang('messages.profile_21_option21') 
                        </option>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label for="about_your_job" class="form-label">@lang('messages.profile_22')</label>
                     <textarea  class="form-control @error('about_your_job') is-invalid @enderror" id="about_your_job" name="about_your_job" rows="3" placeholder="Write here..." data-word-limit-min="0" data-word-limit-max="150" data-word-count="googleWordCount2" data-error="googleError2" oninput="googleWordLimitChecker(this)">{{ old('about_your_job', $user->about_your_job ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount2"></span><span class="error float-right" id="googleError2"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label for="country_of_birth" class="form-label">@lang('messages.profile_7')</label>
                     <select class="form-control @error('country_of_birth') is-invalid @enderror" id="country_of_birth" name="country_of_birth" >
                        <option value="">@lang('messages.profile_contryofbirth_option0')...</option>
                        @foreach($countries as $code => $country)
                        <option value="{{ $country['name'] }}" data-code="{{ $country['code'] }}" {{ $user->country_of_birth == $country['name'] ? 'selected' : '' }}>{{ $country['name'] }}</option>
                        @endforeach
                        <!-- Add more countries here -->
                     </select>
                     <div>
                        @error('country_of_birth')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label for="languages" class="form-label ">@lang('messages.profile_8')</label>
                     @php
                        $languages = json_decode($user->languages, true) ?? [];
                        $allLanguages = [
                           'English', 'Spanish', 'French', 'German', 'Chinese',
                           'Hindi', 'Arabic', 'Russian', 'Japanese', 'Portuguese',
                           'Korean', 'Italian'
                        ];
                     @endphp

                     <select class="form-control @error('languages') is-invalid @enderror select2" id="languages" name="languages[]" multiple>
                        @foreach($allLanguages as $lang)
                           <option value="{{ $lang }}" {{ in_array($lang, $languages) ? 'selected' : '' }}>
                                 {{ __('languages.' . $lang) }}
                           </option>
                        @endforeach
                     </select>
                     @error('languages')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="other_languages" class="form-label">@lang('messages.profile_9')</label>
                     <input type="text" class="form-control @error('other_languages') is-invalid @enderror" id="other_languages" name="other_languages" placeholder="Specify other languages?" value="{{ old('other_languages', $user->other_languages) }}">
                     @error('other_languages')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="country" class="form-label">@lang('messages.profile_residence')</label>
                     <select class="form-control @error('country') is-invalid @enderror" id="residenceCountry" name="res_country">
                        <option value="">@lang('messages.profile_residence_option0')...</option>
                        @foreach($resCountries as $resCountrie)
                        <option value="{{ $resCountrie->name }}" {{ $user->res_country == $resCountrie->name ? 'selected' : '' }} data-id="{{ $resCountrie->id }}">{{ $resCountrie->name }}</option>
                        @endforeach
                     </select>
                     @error('res_country')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="state" class="form-label">@lang('messages.profile_residence_state')</label>
                     <select class="form-control @error('state') is-invalid @enderror" id="residenceState" name="res_state" data-selected-state="{{ $user->res_state }}">
                        <option value="">@lang('messages.profile_residence_state_option0')...</option>
                     </select>
                     @error('res_state')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6 mb-2">
                     <label for="city" class="form-label">@lang('messages.profile_residence_city')</label>
                     <select class="form-control @error('city') is-invalid @enderror" id="residenceCity" name="res_city"  data-selected-city="{{ $user->res_city }}">
                        <option value="">@lang('messages.profile_residence_city_option0') </option>
                     </select>
                     @error('res_city')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="travel_frecuency" class="form-label">@lang('messages.profile_34')</label>
                     <select class="form-control @error('travel_frecuency') is-invalid @enderror" id="travel_frecuency" name="travel_frecuency" >
                        <option value="">@lang('messages.profile_34_option0')</option>
                        <option value="occasional" {{ $user->travel_frecuency == 'occasional' ? 'selected' : '' }}>@lang('messages.profile_34_option1')</option>
                        <option value="vacations" {{ $user->travel_frecuency == 'vacations' ? 'selected' : '' }}>@lang('messages.profile_34_option2')</option>
                        <option value="frequent" {{ $user->travel_frecuency == 'frequent' ? 'selected' : '' }}>@lang('messages.profile_34_option3')</option>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label for="social_cause" class="form-label">@lang('messages.profile_32')</label>
                     <textarea  class="form-control @error('social_cause') is-invalid @enderror" id="social_cause" name="social_cause" rows="3" placeholder="Describe your cause" data-word-limit-min="0" data-word-limit-max="50" data-word-count="googleWordCount5" data-error="googleError5" oninput="googleWordLimitChecker(this)">{{ old('social_cause', $user->social_cause ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount5"></span><span class="error float-right" id="googleError5"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label for="other_nationality" class="form-label">@lang('messages.profile_10')</label>
                     <select class="form-control @error('other_nationality') is-invalid @enderror" id="other_nationality" name="other_nationality" onchange="toggleCountryInput()" >
                     <option value="None" {{ $user->other_nationality == 'None' ? 'selected' : '' }}>@lang('messages.profile_10_option1')</option>
                     <option value="Dual" {{ $user->other_nationality == 'Dual' ? 'selected' : '' }}>@lang('messages.profile_10_option2')</option>
                     </select>
                     @error('other_nationality')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  
                  <div class="col-md-6" id="country_input_div" style="{{ $user->other_nationality == 'Dual' ? 'display:block' : 'display:none' }}">
                     <label for="other_nationality_country" class="form-label">@lang('messages.profile_12')</label>
                     <input type="text" class="form-control @error('other_nationality_country') is-invalid @enderror" id="other_nationality_country" name="other_nationality_country" placeholder="Please specify the country" value="{{ old('other_nationality_country', $user->other_nationality_country) }}" >
                     @error('other_nationality_country')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="profile-section-heading">
                  <h1 class="profile-title">@lang('messages.profile_19')</h1>
                  <p class="profile-subtext">@lang('messages.profile_19_text')</p>
                  <p style="border-bottom: 2px solid gray;line-height: 2; margin-bottom:30px;"></p>
               </div>
               <div class="row g-3 pt-3">
                  <div class="col-md-6">
                     <label for="life_in_general" class="form-label">@lang('messages.profile_40')</label>
                     <textarea  class="form-control @error('life_in_general') is-invalid @enderror" id="life_in_general" name="life_in_general" rows="3" placeholder="Share a few words about your life" data-word-limit-min="100" data-word-limit-max="150" data-word-count="googleWordCount11" data-error="googleError11" oninput="googleWordLimitChecker(this)">{{ old('life_in_general', $user->life_in_general ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount11"></span><span class="error float-right" id="googleError11"></span>
                     </div>
                     @error('life_in_general')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="what_qualities" class="form-label">@lang('messages.profile_42')</label>
                     <textarea  class="form-control @error('what_qualities') is-invalid @enderror" id="what_qualities" name="what_qualities" rows="3" placeholder="Enter your answer here" data-word-limit-min="100" data-word-limit-max="150" data-word-count="googleWordCount13" data-error="googleError13" oninput="googleWordLimitChecker(this)">{{ old('what_qualities', $user->what_qualities ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount13"></span><span class="error float-right" id="googleError13"></span>
                     </div>
                     @error('what_qualities')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="what_relaxes_you" class="form-label">@lang('messages.profile_37')</label>
                     <textarea  class="form-control @error('what_relaxes_you') is-invalid @enderror" id="what_relaxes_you" name="what_relaxes_you" rows="3" placeholder="Write here..." data-word-limit-min="100" data-word-limit-max="150" data-word-count="googleWordCount8" data-error="googleError8" oninput="googleWordLimitChecker(this)">{{ old('what_relaxes_you', $user->what_relaxes_you ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount8"></span><span class="error float-right" id="googleError8"></span>
                     </div>
                     @error('what_relaxes_you')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="conversational_style" class="form-label">@lang('messages.profile_41') </label>
                     <textarea  class="form-control @error('conversational_style') is-invalid @enderror" id="conversational_style" name="conversational_style" rows="3" placeholder="How would you describe your conversational style?" data-word-limit-min="100" data-word-limit-max="150" data-word-count="googleWordCount12" data-error="googleError12" oninput="googleWordLimitChecker(this)">{{ old('conversational_style', $user->conversational_style ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount12"></span><span class="error float-right" id="googleError12"></span>
                     </div>
                     @error('conversational_style')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="what-makes-you-laugh" class="form-label">@lang('messages.profile_43')</label>
                     <textarea  class="form-control @error('you_laugh') is-invalid @enderror" id="what-makes-you-laugh" name="you_laugh" rows="3" placeholder="Describe what makes you laugh..." data-word-limit-min="100" data-word-limit-max="150" data-word-count="googleWordCount14" data-error="googleError14" oninput="googleWordLimitChecker(this)">{{ old('you_laugh', $user->you_laugh ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount14"></span><span class="error float-right" id="googleError14"></span>
                     </div>
                     @error('you_laugh')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="profile-section-heading">
                  <h1 class="profile-title">@lang('messages.profile_25')</h1>
                  <p class="profile-subtext">@lang('messages.profile_25_text')</p>
                  <p style="border-bottom: 2px solid gray;line-height: 2; margin-bottom:30px;"></p>
               </div>
               <div class="row g-3">
                  <!-- Children -->
                  <div class="col-md-6">
                     <label for="children" class="form-label">@lang('messages.profile_26')</label>
                     <select class="form-control @error('children') is-invalid @enderror" id="children" name="children">
                        <option value="">@lang('messages.profile_26_option0')</option>
                        <option value="1" {{ $user->children == '1' ? 'selected' : '' }}>@lang('messages.profile_26_option1')</option>
                        <option value="2" {{ $user->children == '2' ? 'selected' : '' }}>@lang('messages.profile_26_option2')</option>
                     </select>
                  </div>
                  <!-- Children Details (Shown only if "I HAVE" is selected) -->
                  <div class="col-md-6 d-none" id="children_details">
                     <label for="children_age" class="form-label">@lang('messages.profile_27')</label>
                     <textarea  class="form-control" id="children_age" name="children_age" rows="2" placeholder="Enter details about your children" data-word-limit-min="0" data-word-limit-max="100" data-word-count="googleWordCount3" data-error="googleError3" oninput="googleWordLimitChecker(this)">{{ old('children_age', $user->children_age ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount3"></span><span class="error float-right" id="googleError3"></span>
                     </div>
                  </div>
                  <!-- Preferences if "I DON’T HAVE" is selected -->
                  <div class="col-md-6 d-none" id="children_preferences">
                     <label for="children_have_many" class="form-label">@lang('messages.profile_28')</label>
                     <select class="form-control" id="children_have_many" name="children_have_many">
                        <option value="">@lang('messages.profile_28_option0')</option>
                        <option value="1" {{ $user->children_have_many == '1' ? 'selected' : '' }}>@lang('messages.profile_28_option1')</option>
                        <option value="2" {{ $user->children_have_many == '2' ? 'selected' : '' }}>@lang('messages.profile_28_option2')</option>
                        <option value="3" {{ $user->children_have_many == '3' ? 'selected' : '' }}>@lang('messages.profile_28_option3')</option>
                        <option value="4" {{ $user->children_have_many == '4' ? 'selected' : '' }}>@lang('messages.profile_28_option4')</option>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label for="pets" class="form-label">@lang('messages.profile_45')</label>
                     <select class="form-control @error('pets') is-invalid @enderror" id="pets" name="pets" >
                        <option value="">@lang('messages.profile_45_option0')</option>
                        <option value="frequent" {{ $user->pets == 'frequent' ? 'selected' : '' }}>@lang('messages.profile_45_option1')</option>
                        <option value="occasional" {{ $user->pets == 'occasional' ? 'selected' : '' }}>@lang('messages.profile_45_option2')</option>
                        <option value="vacations" {{ $user->pets == 'vacations' ? 'selected' : '' }}>@lang('messages.profile_45_option3')</option>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label for="preferences" class="form-label">@lang('messages.profile_46')</label>
                     <textarea  class="form-control @error('preferences') is-invalid @enderror" id="preferences" name="preferences" rows="3" placeholder="@lang('messages.profile_46')" data-word-limit-min="0" data-word-limit-max="100" data-word-count="googleWordCount4" data-error="googleError4" oninput="googleWordLimitChecker(this)">{{ old('you_laugh', $user->preferences ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount4"></span><span class="error float-right" id="googleError4"></span>
                     </div>
                     @error('preferences')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="follow_any_religion" class="form-label">@lang('messages.profile_33')</label>
                     <textarea  class="form-control @error('follow_any_religion') is-invalid @enderror" id="follow_any_religion" name="follow_any_religion" rows="3" placeholder="Do you follow any religion..." data-word-limit-min="0" data-word-limit-max="50" data-word-count="googleWordCount6" data-error="googleError6" oninput="googleWordLimitChecker(this)">{{ old('follow_any_religion', $user->follow_any_religion ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount6"></span><span class="error float-right" id="googleError6"></span>
                     </div>
                  </div>
                   <!-- Work Out -->
                  <div class="col-md-6">
                     <label for="work-out" class="form-label">@lang('messages.profile_@33')</label>
                     <select class="form-control @error('work_out') is-invalid @enderror" id="work-out" name="work_out" >
                        <option value="">@lang('messages.profile_@33_option0')</option>
                        <option value="never" {{ $user->work_out == 'never' ? 'selected' : '' }}>@lang('messages.profile_@33_option1')</option>
                        <option value="sometimes" {{ $user->work_out == 'sometimes' ? 'selected' : '' }}>@lang('messages.profile_@33_option2')</option>
                        <option value="often" {{ $user->work_out == 'often' ? 'selected' : '' }}>@lang('messages.profile_@33_option3')</option>
                        <option value="daily" {{ $user->work_out == 'daily' ? 'selected' : '' }}>@lang('messages.profile_@33_option4')</option>
                     </select>
                  </div>
                   <div class="col-md-6 d-none" id="workout-habit">
                     <label for="comment_workout" class="form-label">@lang('messages.profile_@34')</label>
                     <textarea  class="form-control @error('comment_workout') is-invalid @enderror" id="comment_workout" name="comment_workout" rows="3" placeholder="comment about workout habit..." data-word-limit-min="0" data-word-limit-max="50" data-word-count="googleWordCount17" data-error="googleError17" oninput="googleWordLimitChecker(this)">{{ old('comment_workout', $user->comment_workout ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount17"></span><span class="error float-right" id="googleError17"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label for="hobbies" class="form-label">@lang('messages.profile_39')</label>
                     <textarea  class="form-control @error('describe_your_lifestyle') is-invalid @enderror" id="describe_your_lifestyle" name="describe_your_lifestyle" rows="3" placeholder="This is about your everyday life." data-word-limit-min="100" data-word-limit-max="150" data-word-count="googleWordCount10" data-error="googleError10" oninput="googleWordLimitChecker(this)">{{ old('describe_your_lifestyle', $user->describe_your_lifestyle ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount10"></span><span class="error float-right" id="googleError10"></span>
                     </div>
                     @error('describe_your_lifestyle')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                 
                  <div class="col-md-6 " id="usually-eat">
                     <label for="usually_eat" class="form-label">@lang('messages.profile_@34_9')</label>
                     <textarea  class="form-control @error('usually_eat') is-invalid @enderror" id="usually_eat" name="usually_eat" rows="3"  data-word-limit-min="20" data-word-limit-max="100" data-word-count="googleWordCount179" data-error="googleError179" oninput="googleWordLimitChecker(this)">{{ old('usually_eat', $user->usually_eat ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount179"></span><span class="error float-right" id="googleError179"></span>
                     </div>
                  </div>
               </div>
               <div class="profile-section-heading">
                  <h1 class="profile-title">@lang('messages.profile_25_11')</h1>
                  <p class="profile-subtext">@lang('messages.profile_25_11_text')</p>
                  <p style="border-bottom: 2px solid gray;line-height: 2; margin-bottom:30px;"></p>
               </div>
               <div class="row g-3">
                  <div class="col-md-6">
                     <label for="birthday" class="form-label">@lang('messages.profile_5')</label>
                     <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="birthday" name="birthday" data-val="{{$user->birthday}}" value="{{ old('birthday', $user->birthday) }}" >
                     @error('birthday')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <div class="input-group">
                        <!-- Height in CM -->
                        <div style="{{ $user->description == 'Feet' ? 'display:none;' : 'display:block;' }}">
                           <label for="height">@lang('messages.profile_6')</label>
                           <input 
                              type="text" 
                              class="form-control @error('height') is-invalid @enderror" 
                              id="height" 
                              name="height" 
                              placeholder="Enter your height" 
                              value="{{ old('height', $user->height) }}" 
                              oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                              maxlength="3" 
                              inputmode="numeric"
                              />
                        </div>
                        <!-- Feet Input -->
                        <div style="{{ $user->description == 'Feet' ? 'display:block;' : 'display:none;' }}">
                           <label for="feet">@lang('messages.profile_description_feet')</label>
                           <input 
                              type="text" 
                              class="form-control" 
                              id="feet" 
                              name="feet" 
                              placeholder="Feet"
                              value="{{ old('feet', $user->feet) }}"  
                              oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                              maxlength="2" 
                              />
                        </div>
                        <!-- Inches Input -->
                        <div style="{{ $user->description == 'Feet' ? 'display:block;' : 'display:none;' }}">
                           <label for="inches">@lang('messages.profile_description_inches')</label>
                           <input 
                              type="text" 
                              class="form-control" 
                              id="inches" 
                              name="inches" 
                              placeholder="Inches" 
                              value="{{ old('inches', $user->inches) }}"
                              oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                              maxlength="2" 
                              />
                        </div>
                        <!-- Dropdown to Select Description -->
                        <div>
                           <label for="description">@lang('messages.profile_measurement')</label>
                           <select 
                              name="description" 
                              id="description" 
                              class="form-control" 
                              onchange="toggleFeetInches(this.value)">
                           <option value="CM" {{ $user->description == 'CM' ? 'selected' : '' }}>@lang('messages.profile_measurement_option1')</option>
                           <option value="Feet" {{ $user->description == 'Feet' ? 'selected' : '' }}>@lang('messages.profile_measurement_option2')</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <!-- Alcohol -->
                  <div class="col-md-6">
                     <label for="alcohol" class="form-label">@lang('messages.profile_30')</label>
                     <select class="form-control @error('alcohol') is-invalid @enderror" id="alcohol" name="alcohol" >
                        <option value="">@lang('messages.profile_30_option0')</option>
                        <option value="never" {{ $user->alcohol == 'never' ? 'selected' : '' }}>@lang('messages.profile_30_option1')</option>
                        <option value="occasionally" {{ $user->alcohol == 'occasionally' ? 'selected' : '' }}>@lang('messages.profile_30_option2')</option>
                        <option value="weekends" {{ $user->alcohol == 'weekends' ? 'selected' : '' }}>@lang('messages.profile_30_option3')</option>
                        <option value="daily" {{ $user->alcohol == 'daily' ? 'selected' : '' }}>@lang('messages.profile_30_option4')</option>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label for="smoke" class="form-label">@lang('messages.profile_31')</label>
                     <select class="form-control @error('smoke') is-invalid @enderror" id="smoke" name="smoke" >
                        <option value="">@lang('messages.profile_31_option0')</option>
                        <option value="never" {{ $user->smoke == 'never' ? 'selected' : '' }}>@lang('messages.profile_31_option1')</option>
                        <option value="occasionally" {{ $user->smoke == 'occasionally' ? 'selected' : '' }}>@lang('messages.profile_31_option2')</option>
                        <option value="daily" {{ $user->smoke == 'daily' ? 'selected' : '' }}>@lang('messages.profile_31_option3')</option>
                        <option value="quitting" {{ $user->smoke == 'quitting' ? 'selected' : '' }}>@lang('messages.profile_31_option4')</option>
                     </select>
                  </div>
                  <div class="col-md-6 d-none" id="smoke-habit">
                     <label for="comment_smoke" class="form-label">@lang('messages.profile_next_to_32')</label>
                     <textarea  class="form-control @error('comment_smoke') is-invalid @enderror" id="comment_smoke" name="comment_smoke" rows="3" placeholder="comment about smoke..." data-word-limit-min="0" data-word-limit-max="50" data-word-count="googleWordCount16" data-error="googleError16" oninput="googleWordLimitChecker(this)">{{ old('comment_smoke', $user->comment_smoke ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount16"></span><span class="error float-right" id="googleError16"></span>
                     </div>
                  </div>
                  <!-- Music Genres -->
                  <div class="col-md-6">
                     <label for="music-genres" class="form-label">@lang('messages.profile_35')</label>
                     <textarea  class="form-control @error('music_genres') is-invalid @enderror" id="music-genres" name="music_genres" rows="3" placeholder="List your favorite music genres..." data-word-limit-min="0" data-word-limit-max="100" data-word-count="googleWordCount7" data-error="googleError7" oninput="googleWordLimitChecker(this)">{{ old('music_genres', $user->music_genres ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount7"></span><span class="error float-right" id="googleError7"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label for="internal-attraction " class="form-label">@lang('messages.profile_17')</label>
                     <textarea  class="form-control @error('find_internally_attractive') is-invalid @enderror" id="internal-attraction" name="find_internally_attractive" rows="3" placeholder="Write your thoughts..." data-word-limit-min="0" data-word-limit-max="150" data-word-count="googleWordCount1" data-error="googleError1" oninput="googleWordLimitChecker(this)">{{ old('find_internally_attractive', $user->find_internally_attractive ?? '') }}</textarea>
                     <div class="word-count">
                        <span class="float-left" id="googleWordCount1"></span><span class="error float-right" id="googleError1"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label for="interested_in" class="form-label">@lang('messages.profile_15')</label>
                     <select class="form-control @error('interested_in') is-invalid @enderror" id="interested_in" name="interested_in" >
                     <option value="Female" {{ $user->interested_in == 'Female' ? 'selected' : '' }}>@lang('messages.profile_15_option1')</option>
                     <option value="Male" {{ $user->interested_in == 'Male' ? 'selected' : '' }}>@lang('messages.profile_15_option2')</option>
                     <option value="Male-Male" {{ $user->interested_in == 'Male-Male' ? 'selected' : '' }}>@lang('messages.profile_15_option3')</option>
                     <option value="Female-Female" {{ $user->interested_in == 'Female-Female' ? 'selected' : '' }}>@lang('messages.profile_15_option4')</option>
                     <option value="Male-both" {{ $user->interested_in == 'Male-both' ? 'selected' : '' }}>@lang('messages.profile_15_option5')</option>
                     <option value="Female-both" {{ $user->interested_in == 'Female-both' ? 'selected' : '' }}>@lang('messages.profile_15_option6')</option>
                     </select>
                     @error('interested_in')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6" id="preference-container" style="display: none;">
                     <label for="interested_preference">@lang('messages.profile_interest_prefrence')</label>
                     <select class="form-control" id="interested_preference" name="interested_preference">
                        <option value="">@lang('messages.profile_interest_prefrence_option0')</option>
                        <option value="Passive" {{ $user->interested_preference == 'Passive' ? 'selected' : '' }}>@lang('messages.profile_interest_prefrence_option1')</option>
                        <option value="Active" {{ $user->interested_preference == 'Active' ? 'selected' : '' }}>@lang('messages.profile_interest_prefrence_option2')</option>
                        <option value="Versatile" {{ $user->interested_preference == 'Versatile' ? 'selected' : '' }}>@lang('messages.profile_interest_prefrence_option3')</option>
                     </select>
                     @error('interested_preference')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6" id="activePassiveDiv" >
                     <label for="activePassive">@lang('messages.profile_@15')</label>
                     <select id="activePassive" class="form-control" name="activePassive">
                        <option value="">--Select--</option>
                        <option value="1" {{ $user->activePassive == '1' ? 'selected' : '' }}>@lang('messages.profile_interest_prefrence_option1')</option>
                        <option value="2" {{ $user->activePassive == '2' ? 'selected' : '' }}>@lang('messages.profile_interest_prefrence_option2')</option>
                     </select>
                     @error('activePassive')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
            </div>
            <div class="row g-3">
                  <!-- What Relaxes You -->
                  <div class="col-md-6">
                     <label for="age-range" class="form-label">@lang('messages.profile_18')</label>
                     <div class="row">
                        <div class="col-md-6">
                           <input type="number" class="form-control @error('interested_min_age_range') is-invalid @enderror" id="age-range-1" name="interested_min_age_range" placeholder="Minimum Age"  value="{{ old('min', $user->interested_min_age_range ?? '') }}">
                        </div>
                        <div class="col-md-6">
                           <input type="number" class="form-control @error('interested_max_age_range') is-invalid @enderror" id="age-range-2" name="interested_max_age_range" placeholder="Maximum Age"  value="{{ old('max', $user->interested_max_age_range ?? '') }}">
                        </div>
                        <div class="col-md-12" style="line-height: 1.0 !important;">
                        <small id="age-tip" class="text-muted" style="display: none; color:#01FFFF !important;">
                           Tip: @lang('messages.interested_max_age_range_message').
                        </small>
                        </div>
                        <div class="col-md-12 d-none" id="badges">
                           <label for="" class="form-label"></label>
                           <div id="badges-show"></div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <label for="height_preference">@lang('messages.profile_height_prefrence')</label>
                     <select id="height_preference" class="form-control" name="height_preference">
                        <option value=""> @lang('messages.profile_height_prefrence_option0') </option>
                        <option value="Taller than me" {{ $user->height_preference == 'Taller than me' ? 'selected' : '' }}>@lang('messages.profile_height_prefrence_option1')</option>
                        <option value="Shorter than me" {{ $user->height_preference == 'Shorter than me' ? 'selected' : '' }}>@lang('messages.profile_height_prefrence_option2')</option>
                        <option value="Taller or equal than me" {{ $user->height_preference == 'Taller or equal than me' ? 'selected' : '' }}>@lang('messages.profile_height_prefrence_option3')</option>
                        <option value="Shorter or equal than me" {{ $user->height_preference == 'Shorter or equal than me' ? 'selected' : '' }}>@lang('messages.profile_height_prefrence_option4')</option>
                        <option value="Any height" {{ $user->height_preference == 'Any height' ? 'selected' : '' }}>@lang('messages.profile_height_prefrence_option5')</option>
                     </select>
                     @error('height_preference')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  
                  
                  <!-- Smoking -->
                  <div class="col-md-6 d-none">
                     <label for="sex" class="form-label">@lang('messages.profile_gender')</label>
                     <select class="form-control @error('sex') is-invalid @enderror" id="sex" name="sex">
                        <option value="" selected></option>
                        <option value="Male" {{ $user->sex == 'Male' ? 'selected' : '' }}>@lang('messages.profile_gender_select_option1')</option>
                        <option value="Female" {{ $user->sex == 'Female' ? 'selected' : '' }}>@lang('messages.profile_gender_select_option2')</option>
                        <option value="LGBTIQ+" {{ $user->sex == 'LGBTIQ+' ? 'selected' : '' }}>@lang('messages.profile_gender_select_option3')</option>
                     </select>
                  </div>
               <!-- </div> -->
            <!-- </div> -->
            <!-- Interests and Preferences -->
            <!-- <div class="form-section">-->
                  <div class="col-md-6 d-none">
                     <label for="form_which_countries" class="form-label">@lang('messages.profile_16')</label>
                     <select class="form-control @error('form_which_countries') is-invalid @enderror" id="form_which_countries" name="form_which_countries">
                        <option value="">@lang('messages.profile_contryofbirth_option0')...</option>
                        @foreach($countries as $code => $country)
                        <option value="{{ $country['name'] }}" data-code="{{ $country['code'] }}" {{ $user->form_which_countries == $country['name'] ? 'selected' : '' }}>{{ $country['name'] }}</option>
                        @endforeach
                     </select>
                     @error('form_which_countries')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                 
                 
                  <!-- Preferred Age Range -->
               </div>
            <!-- </div> -->
            <!-- <div class="form-section">-->
               
               <!-- Academic Level -->
               <div class="row g-3">
                  <div class="col-md-6 d-none">
                     <label for="company_country">@lang('messages.profile_23')</label>
                     <select class="form-control @error('company_country') is-invalid @enderror" id="company_country" name="company_country">
                        <option value="">@lang('messages.profile_23_option0')...</option>
                        @foreach($countries as $code => $country)
                        <option value="{{ $country['name'] }}" data-code="{{ $country['code'] }}" {{ $user->company_country == $country['name'] ? 'selected' : '' }}>{{ $country['name'] }}</option>
                        @endforeach
                     </select>
                     @error('company_country')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="col-md-6 d-none">
                     <label for="company-id">@lang('messages.profile_24')</label>
                     <input  type="text"  id="company-id"  name="company_id"  class="form-control"  placeholder="Enter your company's ID number" value="{{ old('company_id', $user->company_id ?? '') }}" />
                     <small class="form-text text-muted">
                     >@lang('messages.profile_24_note')
                     </small>
                  </div>
                  <div class="col-md-6 d-none">
                     <label for="working_status" class="form-label">@lang('messages.profile_24_next_workingstatus')</label>
                     <select class="form-control @error('working_status') is-invalid @enderror" id="working_status" name="working_status">
                        <option value="">@lang('messages.profile_24_next_option0')</option>
                        <option value="working" {{ $user->working_status == 'working' ? 'selected' : '' }}>@lang('messages.profile_24_next_option1')</option>
                        <option value="not-working" {{ $user->working_status == 'not-working' ? 'selected' : '' }}>@lang('messages.profile_24_next_option2')</option>
                     </select>
                  </div>
               </div>
            <!-- </div> -->
            <!-- <div class="form-section"> -->
               
            <!-- </div>  -->
            <!-- <div class="form-section"> -->
            <!-- </div> -->
            <!-- This information makes your profile more authentic -->
            <!-- <div class="form-section"> -->
            <!-- </div> -->
            <div class="text-left box-2344 d-flex align-items-start"> 
               <input type="checkbox" name="is_subscribed" id="subscribe" style="transform: scale(1.5);  margin-right: 10px; margin-top: 6px;" {{ ($user->is_subscribed == 1) ? 'checked': '' }}>
               <div style="font-family: 'AvenirNext', sans-serif;">
                  <label for="is_subscribed" class="mx-2" style="font-size: 13px;">@lang('messages.profile_is_subscribed_message')</label>
                  <p  class="mx-2" style="font-family: 'AvenirNext', sans-serif;">@lang('messages.profile_is_subscribed_message1')</p>
               </div>
            </div>
            <!-- Submit Button -->
            <hr>
            <div class="text-center">
               <button type="submit" class="btn btn-danger btn-lg" id="formVerifyId" data-verify="{{$countvalue}}">@lang('messages.profile_44')</button>
            </div>
         </section>
      </form>
      @endif
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-body p-5">
            <div class="text-center message-box _success">
               <i class="fa fa-check-circle" aria-hidden="true"></i>
               <h2>@lang('messages.profile_modal_verification1') .</h2>
            </div>
            <p>@lang('messages.profile_modal_verification2'):</p>
            <!-- Option 1: Corporate Email -->
            <div class="form-check">
               <input type="radio" class="form-check-input" id="emailOption" name="verificationOption" value="email">
               <label class="form-check-label m-0" for="emailOption">@lang('messages.profile_modal_verification3').</label>
            </div>
            <div id="emailInputDiv" class="mt-3" style="display: none;">
               <label for="corporateEmail">@lang('messages.profile_modal_verification4'):</label>
               <input type="email" id="corporateEmail" class="form-control" name="corporateEmail" placeholder="Enter corporate email">
            </div>
            <!-- Option 2: Upload Employment Certificate -->
            <div class="form-check mt-3">
               <input type="radio" class="form-check-input" id="certificateOption" name="verificationOption" value="certificate">
               <label class="form-check-label m-0" for="certificateOption">@lang('messages.profile_modal_verification5').</label>
            </div>
            <div id="certificateInputDiv" class="mt-3" style="display: none;">
               <label for="employmentCertificate">@lang('messages.profile_modal_verification6'):</label>
               <input type="file" id="employmentCertificate" name="employmentCertificate" class="form-control">
            </div>
            <!-- Option 3: No Verification -->
            <div class="form-check mt-3">
               <input type="radio" class="form-check-input" id="noOption" name="verificationOption" value="noOption">
               <label class="form-check-label m-0" for="noOption">@lang('messages.profile_modal_verification7')</label>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.profile_modal_verification8')</button>
            <button  id="updateVerificationStatusBtn" type="button" class="btn btn-primary">
            <span id="corporateLoader" class="d-none"><i class="fa fa-spinner fa-spin"></i></span><span>@lang('messages.profile_modal_verification9')</span></button>
         </div>
      </div>
   </div>
</div>
@endsection 
@push('link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet">
@endpush
@push('scripts')
<script>
   const userLocale = "{{ Auth::user()->locale ?? app()->getLocale() }}";

   function calculateAge(birthDateString) {
      const today = new Date();
      const birthDate = new Date(birthDateString);
      if (isNaN(birthDate.getTime())) return 0;
      let age = today.getFullYear() - birthDate.getFullYear();
      const m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
         age--;
      }
      return age;
   }

   function showBadgeImage() {
      const badgeHTML = (userLocale === 'es')
         ? `<img src="{{ asset('pictures/badges1.png') }}" class="img-fluid" style="width: 50%;">`
         : `<img src="{{ asset('pictures/badges2.png') }}" class="img-fluid" style="width: 50%;">`;

      $('#badges-show').html(badgeHTML);
      $('#badges').removeClass('d-none');
   }

   function hideBadgeImage() {
      $('#badges-show').empty();
      $('#badges').addClass('d-none');
   }

   function showPopupMessage(suggestedMax) {
      const messages = {
         en: {
            title:'',
         html: "<div style='margin-top:8rem; text-align: left;'><strong>This is the mark of men who choose with intention, not impulse. Men who are sure of themselves. This represents more than maturity — it represents presence.</strong><br> <br><br>The maximum age you choose is a powerful reflection of your intent. Are you looking for a true partner to share life and power with? Or are you prioritizing a different dynamic? <br></br>When you limit that range, the badge is deactivated — because the message you send changes. <br>Men with true power don’t collect moments; they build legacies.<br> They seek an attractive, mature partner to create something solid, real, and lasting.<br></br> And yes, age is just a number for many women —<br> Women who look, feel, and live better than many who are younger.<br></br> The story you tell through your range is powerful. Choose it with intention.<br></br><br></div>",
            confirm: 'Ok, keep the suggested age',
            cancel: 'Thanks, I prefer to change the maximum age'
         },
         es: {
            title:'',
               html: "<div style='margin-top:8rem; text-align: left;'><strong>Este es el sello de los hombres que eligen con sentido, no por impulso. De quienes están seguros de sí. Esto representa más que madurez: representa presencia.</strong><br><br><br> La edad máxima que eliges es un poderoso reflejo de tu intención. ¿Buscas una aliada para compartir poder y vida? ¿O priorizas otra dinámica? <br></br>Al limitar ese rango, la insignia se desactiva, porque el mensaje que envías cambia. <br>Los hombres con verdadero poder no acumulan momentos: construyen legados.<br> Buscan una compañera atractiva y madura con quien crear algo sólido, real y duradero.<br></br> Y sí, hay mujeres cuya edad es solo un número.<br> Mujeres que se ven, se sienten y viven mejor que muchas con años menos.<br></br> La historia que cuentas con tu rango es poderosa. Elígela con intención.<br></br><br></div>",
            confirm: 'Genial, mantendré la edad máxima sugerida.',
            cancel: 'Gracias, prefiero cambiar la edad máxima sugerida.'
         }
      };

      const lang = messages[userLocale] || messages.en;

      Swal.fire({
         icon: 'info',
         title: lang.title,
         html: lang.html,
         showCancelButton: true,
         confirmButtonText: lang.confirm,
         cancelButtonText: lang.cancel,
         width: '700px'
      }).then((result) => {
         if (result.isConfirmed) {
            $('#age-range-2').val(suggestedMax);
            showBadgeImage();
         }
      });
   }

   jQuery(document).ready(function ($) {
      const $interestedIn = $('#interested_in');
      const $birthday = $('#birthday');
      const $ageMin = $('#age-range-1');
      const $ageMax = $('#age-range-2');
      const $tip = $('#age-tip'); 

      function applyLogic(isload=0) {
         const dob = $birthday.attr('data-val');

         // Ensure complete and valid date input
         if (!dob) {
               hideBadgeImage();
               $tip.hide();
               return;
         }
         if (typeof isload === 'object' && isload !== null) {
            isload = 0;
         }
         const age = calculateAge(dob);
         const interest = $interestedIn.val();

         if (interest == 'Female' && age >= 40) {
               const suggestedMin = age - 10;
               const suggestedMax = age - 2;

               const currentMin = parseInt($ageMin.val(), 10) || 0;
               const currentMax = parseInt($ageMax.val(), 10) || 0;
               let isMinInvalid, isMaxInvalid;

               if (isload == 1) {
                  isMinInvalid = !currentMin || currentMin == suggestedMin;
                  isMaxInvalid = !currentMax || currentMax == suggestedMax;
               } else {
                  isMinInvalid = !currentMin || currentMin > 0;
                  isMaxInvalid = !currentMax || currentMax > 0;
               }

               if (isMinInvalid && isMaxInvalid) {
                  $ageMin.val(suggestedMin);
                  $ageMax.val(suggestedMax);
                  showBadgeImage();
                  $tip.show();
               }else{
                   $tip.show();
               }

               // Remove previous blur listener to prevent multiple triggers
               $ageMax.off('blur').on('blur', function () {
                  const dob1 = $('#birthday').attr('data-val');
                  const age1 = calculateAge(dob1);
                  const interest1 = $interestedIn.val();
                  
                  const newMax = parseInt($(this).val()) || 0;
                  if (interest1 == 'Female' && age1 >= 40 && newMax < suggestedMax) {
                     hideBadgeImage();
                     setTimeout(() => {
                           showPopupMessage(suggestedMax);
                     }, 1000);
                     $tip.show();
                  }

                  if (interest1 == 'Female' && age1 >= 40 && newMax == suggestedMax) {
                     showBadgeImage();
                     $tip.hide();
                     $tip.show();
                  }
               });
               
         } else {
               // $ageMin.val('');
               // $ageMax.val('');
               hideBadgeImage();
               $tip.hide();
         }
      }

      // Trigger logic on change/blur
      $interestedIn.on('change', applyLogic);
      $birthday.on('blur', function () {
         let selectedDate = $(this).val();
         $('#birthday').attr('data-val', selectedDate);
         applyLogic();
      });
      $ageMin.on('blur', applyLogic);
      $ageMax.on('blur', applyLogic);
      // Run on page load
      applyLogic(1);
   });

   
</script>


<script>
   // $('#imageModal').modal({
   //    backdrop: 'static',
   //    keyboard: false
   // });
   document.querySelector('.uploadIcon').addEventListener('click', function () {
      document.getElementById('coverPictureInput').click();
   });
   
   document.getElementById('coverPictureInput').addEventListener('change', function (event) {
      let formData = new FormData();
      formData.append('cover_picture', event.target.files[0]);
   
      fetch('/upload-cover-picture', {
         method: 'POST',
         headers: {
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
         },
         body: formData
      })
      .then(response => response.json())
      .then(data => {
         if (data.success) {
            Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Cover picture updated successfully!',
            }).then(() => {
         
            location.reload();
            });
         } else {
            Swal.fire({
               icon: 'error',
               title: 'Error!',
               text: 'Failed to upload cover picture. Try again.',
            });
         }
      })
   });
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNlIby3pLN2YsnmPyeSFA0rxn6LP9oTPg&callback=initMap&libraries=places&callback=initAutocomplete">
</script>

<script>
   let autocomplete;
   let addressInput = document.getElementById('location');
   let addressDropdown = document.getElementById('address-dropdown');
   
   function initAutocomplete() {
      autocomplete = new google.maps.places.Autocomplete(addressInput, {
         types: ['geocode'], // Restrict to addresses
         componentRestrictions: { country: 'us' }, // Optional: limit to a specific country (US)
         fields: ['address_components', 'geometry']
      });
   
      autocomplete.addListener('place_changed', onPlaceChanged);
      
      // Create a listener for input changes to show suggestions
      addressInput.addEventListener('input', onInputChange);
   }
   
   function onInputChange() {
      const query = addressInput.value;
      if (query.length > 2) { // Start showing suggestions after 3 characters
         // Trigger autocomplete search
         const service = new google.maps.places.AutocompleteService();
         service.getPlacePredictions({ input: query, types: ['geocode'], componentRestrictions: { country: 'us' } }, displaySuggestions);
      } else {
         addressDropdown.innerHTML = ''; // Clear dropdown
      }
   }
   
   function displaySuggestions(predictions, status) {
      if (status !== google.maps.places.PlacesServiceStatus.OK) {
         addressDropdown.innerHTML = '';
         return;
      }
   
      addressDropdown.innerHTML = ''; // Clear previous suggestions
      predictions.forEach(prediction => {
         let li = document.createElement('li');
         li.textContent = prediction.description;
         li.addEventListener('click', function() {
               addressInput.value = prediction.description;
               addressDropdown.innerHTML = ''; // Clear suggestions
         });
         addressDropdown.appendChild(li);
      });
   }
   
   function onPlaceChanged() {
      const place = autocomplete.getPlace();
      if (place.geometry) {
         // Handle the selected place here, e.g., display details or perform an action
         console.log('Selected place:', place.formatted_address);
      }
   }
   
   window.onload = function () {
      getLocationByIP();
      toggleCountryInput();
   
      
   };
   let circle; // Declare circle in the global scope
   
   function initMap(latitude, longitude) {
   
      //const [latitude, longitude] = tet.split(',').map(parseFloat);
      
      // Set your location (latitude, longitude)
      const location = { lat: latitude, lng: longitude }; // Example: San Francisco
      // Create the map
      const map = new google.maps.Map(document.getElementById("map"), {
         zoom: 15,
         center: location,
         zoomControl: false,
          streetViewControl: false,
          mapTypeControl: false,
          fullscreenControl: false
      });
   
      // Define a circle with a specific radius (in meters)
      circle = new google.maps.Circle({
         map: map,
         center: location,
         radius: 5000, // Initial radius
         fillColor: "#FF0000",
         fillOpacity: 0.3,
         strokeColor: "#FF0000",
         strokeOpacity: 0.8,
         strokeWeight: 2,
      });
   
      // Add a marker at the center
      const marker = new google.maps.Marker({
         position: location,
         map: map,
         title: "Center Location",
      });
   
      const radiusget = $("#radiusInput").val();
      const radius = parseInt(radiusget, 10);
      circle.setRadius(radius); // Update the circle's radius
      document.getElementById('radiusValue').textContent = `${radius} meters`; // Update the displayed value
   
   }
   
   document.getElementById('radiusInput').addEventListener('input', function (e) {
      const radius = parseInt(e.target.value, 10);
      circle.setRadius(radius); // Update the circle's radius
      document.getElementById('radiusValue').textContent = `${radius} meters`; // Update the displayed value
   });
   
</script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
      // Show/Hide the appropriate input fields based on selected option
      document.querySelectorAll('input[name="verificationOption"]').forEach(function(radio) {
         radio.addEventListener('change', function() {
            let emailDiv = document.getElementById('emailInputDiv');
            let certificateDiv = document.getElementById('certificateInputDiv');
            
            if (radio.value === 'email') {
                  emailDiv.style.display = 'block';
                  certificateDiv.style.display = 'none';
            } else if (radio.value === 'certificate') {
                  emailDiv.style.display = 'none';
                  certificateDiv.style.display = 'block';
            } else {
                  emailDiv.style.display = 'none';
                  certificateDiv.style.display = 'none';
            }
         });
      });
   });
   
   // Fetch location based on IP
   const userdata = @json($user);
   function getLocationByIP() {
      navigator.geolocation.getCurrentPosition(
         (position) => {
            let latitude, longitude;

            if (userdata.is_lock_location == 1 && userdata.latitude!=null && userdata.longitude!=null) {
               latitude = parseFloat(userdata.latitude);
               longitude = parseFloat(userdata.longitude);
            } else {
               latitude = position.coords.latitude;
               longitude = position.coords.longitude;
            }
            
            document.getElementById('location-prompt').classList.add('hide');
            document.getElementById('map').classList.remove('hide');
             // Use a Geocoding API to convert coordinates to an address
             const apiKey = "AIzaSyDNlIby3pLN2YsnmPyeSFA0rxn6LP9oTPg"; // Replace with your API Key
             fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`)
                 .then((response) => response.json())
                 .then((data) => {
                     if (data.status === "OK") {
                        initMap(latitude, longitude);
   
                        let city = "";
                        let country = "";
   
                        // Loop through address components to extract city & country
                        data.results[0].address_components.forEach(component => {
                           if (component.types.includes("locality")) {
                              city = component.long_name; // Extracts City
                           }
                           if (component.types.includes("country")) {
                              country = component.long_name; // Extracts Country
                           }
                        });
                        document.getElementById('location').value = data.results[0].formatted_address;
                        document.getElementById('latitude').value = latitude;
                        document.getElementById('longitude').value = longitude;
                        document.getElementById('city').value = city;
                        document.getElementById('country').value = country;
                     } else {
                         console.error("Geocoding error:", data.status);
                     }
                 });
         },
         (error) => console.error("Geolocation error:", error),
         { enableHighAccuracy: true }
     )
     
   }
   
   // Toggle country input when 'Dual' nationality is selected
   function toggleCountryInput() {
      var nationalitySelect = document.getElementById('other_nationality');
      var countryInputDiv = document.getElementById('country_input_div');
      if (nationalitySelect.value == 'Dual') {
         countryInputDiv.style.display = 'block';
      } else {
         countryInputDiv.style.display = 'none';
      }
   }
   
   // Event listener for the 'children' select element
   // Define a function to handle the change logic
   function handleChildrenChange() {
      const value = document.getElementById('children').value;
      const childrenDetails = document.getElementById('children_details');
      const childrenPreferences = document.getElementById('children_preferences');
      
      // Reset fields
      childrenDetails.classList.add('d-none');
      childrenPreferences.classList.add('d-none');
      
      // Show the appropriate section based on the selected value
      if (value === '1') {
         childrenDetails.classList.remove('d-none');
      } else if (value === '2') {
         childrenPreferences.classList.remove('d-none');
      }
   }
   
   // Attach the change event listener
   document.getElementById('children').addEventListener('change', handleChildrenChange);
   
   // Call the function on page load to set the initial state
   document.addEventListener('DOMContentLoaded', handleChildrenChange);
   
   // Initialize phone input with international code
   function handleinterestedinChange() {
      const value = document.getElementById('interested_in').value;
      const activePassiveDiv = document.getElementById('activePassiveDiv');
      
      // Reset fields
      activePassiveDiv.classList.add('d-none');
      
      // Show the appropriate section based on the selected value
      if (value === 'LGBTIQ+') {
         activePassiveDiv.classList.remove('d-none');
      } 
   }

   // Attach the change event listener
   document.getElementById('interested_in').addEventListener('change', handleinterestedinChange);
   
   // Call the function on page load to set the initial state
   document.addEventListener('DOMContentLoaded', handleinterestedinChange);
   
   // Initialize select2 dropdowns
   jQuery(document).ready(function($) {
      $('#country_of_birth').select2();
      if ($('#country_of_birth').hasClass('is-invalid')) {
         $('.select2-selection').addClass('is-invalid');
      }
      $('#form_which_countries').select2();
      $('#languages').select2();
      $('#company_country').select2();
      $('#industry_you_work').select2();
   });
   
   jQuery(document).ready(function($) {
      var phonenub = $("#phone");
      var dialCodeInput = $("#dialCode");
   
      function getCountryByDialCode(dialCode) {
         var countryData = phonenub.intlTelInput("getCountryData");
         if(countryData){
            for (var i = 0; i < countryData.length; i++) {
               if (countryData[i].dialCode == dialCode) {
                  return countryData[i].iso2;
               }
            }
         }
         return "co";
      }
      function getCountryCodeByDialCode(dialCode) {
         var countryData = window.intlTelInputGlobals.getCountryData();
         var country = countryData.find(c => c.dialCode == dialCode);
         return country ? country.iso2 : "co";
      }
   
      var countryCode = getCountryByDialCode() ?? "co";
      var init = phonenub.intlTelInput({initialCountry: countryCode,separateDialCode: true,});
         
      
      var storedDialCode = dialCodeInput.val();
      
      if (storedDialCode) {
            var countryCode = String(getCountryCodeByDialCode(storedDialCode));
            init.intlTelInput("setCountry", countryCode);
            dialCodeInput.val(storedDialCode);
      }else{
            var initialCountryData  = init.intlTelInput("getSelectedCountryData");
            dialCodeInput.val(initialCountryData .dialCode);
      }
      
      phonenub.on("countrychange", function() {
         var selectedCountryData = phonenub.intlTelInput("getSelectedCountryData");
            dialCodeInput.val(selectedCountryData.dialCode);
      });
   });
   
   $(document).ready(function () {
      const freeEmailProviders = [
         "gmail.com",
         "yahoo.com",
         "hotmail.com",
         "outlook.com",
         "aol.com",
         "icloud.com",
         "zoho.com",
         "protonmail.com",
         "tutanota.com",
         "gmx.com",
         "yandex.com",
         "mail.com",
         "fastmail.com",
         "hushmail.com",
         "posteo.de",
         "runbox.com",
         "countermail.com",
         "guerrillamail.com",
         "10minutemail.com",
         "mailinator.com"
      ];

      //updateVerificationStatusBtn function
      $('#updateVerificationStatusBtn').click(function () {
         var selectedOption = $('input[name="verificationOption"]:checked').val();
         var formData = new FormData();
         
   
         if (typeof selectedOption === 'undefined' || selectedOption === null) {
            //first toaster
            toastr.error('{{ __('messages.profile_update_verification_title') }}', '{{ __('messages.profile_update_verification_message') }}');
            return; 
         }
         // Append the selected verification option
         formData.append('verificationOption', selectedOption);
         // If 'email' option is selected, append corporate email
         if (selectedOption === 'email') {
            formData.append('corporateEmail', $('#corporateEmail').val());
            
            const email = $("#corporateEmail").val().trim();
                     const domain = email.split("@")[1]; // Extract domain
         
                     // Check if domain is in the free email providers list
                     if (freeEmailProviders.includes(domain)) 
                     {
                        //toaster second
                        toastr.error('{{ __('messages.profile_update_verification_second') }}', '{{ __('messages.profile_update_verification_message') }}');
                        return false;  
                     } 
                     
            
         }
         
         // If 'certificate' option is selected, append the file
         if (selectedOption === 'certificate') {
            var fileInput = $('#employmentCertificate')[0];
            if (fileInput.files.length > 0) {
               formData.append('employmentCertificate', fileInput.files[0]);
            }
         }
   
         $('#corporateLoader').removeClass('d-none');
         $('#updateVerificationStatusBtn').attr('disabled', true);
         // Get CSRF token from meta tag
         var csrfToken = $('meta[name="csrf-token"]').attr('content');
         
         // Make AJAX request to save the form data
         $.ajax({
            url: '/update-verification-status', // Laravel route
            method: 'POST',
            data: formData,
            processData: false, //  for FormData
            contentType: false, //  for FormData
            headers: {
               'X-CSRF-TOKEN': csrfToken, // Include CSRF token in headers
            },
            success: function (response) {
               if (response.success) {
                     toastr.success(response.message, 'Success');
                     $('#exampleModal').modal('hide'); // Hide modal
                    
                     $('#corporateLoader').addClass('d-none');
                     $('#updateVerificationStatusBtn').attr('disabled', false);
                     setTimeout(function() {
                           window.location.href = "{{ url('approve-pending') }}"; 
                     }, 2000);
               } else {
                     toastr.error(response.message, '{{ __('messages.profile_update_verification_message') }}');
                     $('#corporateLoader').addClass('d-none');
                     $('#updateVerificationStatusBtn').attr('disabled', false);
               }
            },
            error: function (xhr) {
               var errors = xhr.responseJSON.errors || {};
               if (errors.verificationOption) {
                     toastr.error(errors.verificationOption.join(', '), '{{ __('messages.profile_update_verification_message') }}');
               } else {
                     
                     toastr.error('{{ __('messages.profile_update_verification_third') }}', '{{ __('messages.profile_update_verification_message') }}');
               }
            },
         });
      });
   
   });
   
   $(document).on('click', '.delete-image', function (e) {
      e.preventDefault();
      const imageId = $(this).data('id');
      
      Swal.fire({
         title: '{{ __('messages.profile_delete_image1') }}',
         text: '{{ __('messages.profile_delete_image2') }}',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: '{{ __('messages.profile_delete_image3') }}',
         cancelButtonText: '{{ __('messages.profile_delete_image4') }}',
      }).then((result) => {
         if (result.isConfirmed) {
            $.ajax({
               url: '/delete-image', // Update with your route
               type: 'POST',
               data: {
                     id: imageId,
                     _token: '{{ csrf_token() }}'
               },
               success: function (response) {
                  if (response.success) {
                     Swal.fire({
                        icon: 'success',
                        title: '{{ __('messages.profile_delete_image5') }}',
                        text: '{{ __('messages.profile_delete_image6') }}',
                     }).then(() => {
                        location.reload();
                     });
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: '{{ __('messages.profile_delete_image7') }}',
                        text: '{{ __('messages.profile_delete_image8') }}',
                     });
                  }
               },
               error: function () {
                  let errorMessage = '{{ __('messages.profile_delete_image9') }}';
                  Swal.fire({
                        icon: 'error',
                        title: '{{ __('messages.profile_delete_image7') }}',
                        text: errorMessage,
                  });
               }
            });
         }
      });
   });
   
   $(document).on('click', '.setProfileImage', function (e) {
      e.preventDefault();
      const imageId = $(this).data('id');
      Swal.fire({
         title: '{{ __('messages.profile_set_image1') }}',
         text: '{{ __('messages.profile_set_image2') }}',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: '{{ __('messages.profile_set_image3') }}',
         cancelButtonText: '{{ __('messages.profile_set_image4') }}',
      }).then((result) => {
         if (result.isConfirmed) {
               $.ajax({
                  url: '{{ route('user.setProfileImage') }}',
                  type: 'POST',
                  data: {
                     _token: $('meta[name="csrf-token"]').attr('content'),
                     image_id: imageId
                  },
                  success: function(response) {
                           if (response.success) {
                           Swal.fire({
                           icon: 'success',
                           title: '{{ __('messages.profile_set_image5') }}',
                           text: response.message || '{{ __('messages.profile_set_image6') }}',
                           }).then(() => {
                        
                           location.reload();
                           });
                           // Optionally, update the UI
                           $('#current-profile-picture').attr('src', response.newProfileImageUrl); 
                     } else {
                           Swal.fire({
                              icon: 'error',
                              title: 'Error!',
                              text: response.message || '{{ __('messages.profile_set_image7') }}',
                           });
                     }
                  },
                  error: function(xhr) {
                     let errorMessage = xhr.responseJSON?.message || '{{ __('messages.profile_set_image8') }}';
                     Swal.fire({
                           icon: 'error',
                           title: '{{ __('messages.profile_set_image9') }}',
                           text: errorMessage,
                     });
                  }
               });
         }
      });
   });
   
   



   $(document).ready(function () {
      $('#profileForm').on('submit', function (e) {
         e.preventDefault();
   
         const uploadImageButton = document.getElementById('imageUpload');
         const imageCount = parseInt(uploadImageButton.dataset.imageCount, 10);
         
         if (imageCount < 2) {
            Swal.fire({
                  title: '{{ __('messages.profile_set_image254') }}',
                  text: '{{ __('messages.profile_set_image255') }}',
                  icon: 'warning',
            });
            return false;
         }

         let formData = new FormData(this); 
         $('.error-message').remove();
   
         $.ajax({
            url: $(this).attr('action'),
            type: 'POST', 
            data: formData,
            contentType: false, 
            processData: false, 
            success: function (response) {
               // Show success message with Swal
               if(response.countvalue == 0){
                  $('#exampleModal').modal('show');
               }else{
                  Swal.fire({
                     // icon: 'success',
                     title: '{{ __('messages.profile_form_submit4_0') }}',
                     text: response.message || '{{ __('messages.profile_form_submit4') }}',
                     // imageUrl: `{{ asset('pictures/LOGOGV.png') }}`,
                     // imageWidth: 200,
                     imageAlt: '{{ __('messages.profile_form_submit5') }}',
                  }).then(() => {
                     // location.reload();
                     Swal.fire({
                        title: '{{ __('messages.profile_form_submit6') }}',
                        text: '{{ __('messages.profile_form_submit7') }}',
                        // imageUrl: `{{ asset('pictures/LOGOGV.png') }}`, // Custom logo
                        // imageWidth: 200,
                        showCancelButton: true,
                        confirmButtonText: '{{ __('messages.profile_form_submit8') }}',
                        cancelButtonText: '{{ __('messages.profile_form_submit9') }}',
                        allowOutsideClick: false,
                     }).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = `/show-all/${response.userId}/view`;
                        }
                     });
                  });
               } 
            },
            error: function (xhr, status, error) {
               if (xhr.status === 422) {
                  let errors = xhr.responseJSON.errors;
                  $.each(errors, function (field, messages) {
                        let inputField = $('[name="' + field + '"]');
                        if (inputField.length) {
                           inputField
                              .after('<span class="error-message text-danger">' + messages[0] + '</span>');
                        }
                  });
                  Swal.fire({
                        icon: 'error',
                        title: '{{ __('messages.profile_form_submit10') }}',
                        text: '{{ __('messages.profile_form_submit11') }}',
                  });
               }else if (xhr.status === 412) {
                  let message = xhr.responseJSON.message;

                  Swal.fire({
                        icon: 'warning',
                        title: '{{ __('messages.profile_form_submit12') }}',
                        text: message,
                  }).then((result) => {
                     if (result.isConfirmed) {
                        window.location.href = `/login`;
                     }
                  });
               }else {
                  // Other errors
                  Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || '{{ __('messages.profile_form_submit13') }}',
                  });
               }
            }
         });
      });
   
      let verifyValue = $('#formVerifyId').data('verify');
      if (verifyValue == 0) {
         $('#exampleModal').modal('show');
      }
   });
   
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $(document).ready(function () {
      const $form = $('#profileInstructionForm');
      const $checkboxes = $('.auto-check');

      function allChecked() {
         return $checkboxes.length === $checkboxes.filter(':checked').length;
      }

      $checkboxes.on('change', function () {
         if (allChecked()) {
            $form.submit();
         }
      });

      $form.on('submit', function (e) {
         e.preventDefault();
         let formData1 = new FormData(this);

         $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData1,
            contentType: false,
            processData: false,
            success: function (response) {
               Swal.fire('Success!', 'Profile updated successfully!', 'success').then(() => {
                  location.reload();
               });
            },
            error: function (xhr) {
               Swal.fire('Error!', xhr.responseJSON?.message || 'Something went wrong.', 'error');
            }
         });
      });
   });
</script>
<script>
   function googleWordLimitChecker(textarea) {
      const wordLimitMin = parseInt(textarea.getAttribute('data-word-limit-min')); 
      const wordLimitMax = parseInt(textarea.getAttribute('data-word-limit-max'));
      const charLimitMin = 0;
      const charLimitMax = 100;
   
      const wordCountDisplay = document.getElementById(textarea.getAttribute('data-word-count'));
      const errorDisplay = document.getElementById(textarea.getAttribute('data-error'));
   
      // Get the current words and characters in the textarea
      const text = textarea.value.trim();
      const words = text.split(/\s+/).filter(word => word.length > 0);
      const wordCount = words.length;
      const charCount = text.length;
   
      // Update the word count display
      wordCountDisplay.textContent = `{{ __('messages.profile_google_word_validation1') }} ${charCount}/${wordLimitMin}-${wordLimitMax}`;
   
      // Validate character count
      if (charCount < wordLimitMin) {
         textarea.style.borderColor = 'orange';
         errorDisplay.style.color ='orange';
         errorDisplay.textContent = `{{ __('messages.profile_google_word_validation2') }} ${wordLimitMin} {{ __('messages.profile_google_word_validation3') }} `;
      } else if (charCount > wordLimitMax) {
         textarea.style.borderColor = 'red';
         errorDisplay.style.color ='red';
         errorDisplay.textContent = `{{ __('messages.profile_google_word_validation4') }} ${wordLimitMax} {{ __('messages.profile_google_word_validation5') }}`;
      }else {
         textarea.style.borderColor = 'green'; 
         errorDisplay.style.color ='green';
         errorDisplay.textContent = '{{ __('messages.profile_google_word_validation6') }}';
      }
   }

   function previewImages(event) {
      const previewContainer = document.getElementById('image_preview');
      const uploadImageButton = document.getElementById('imageUpload');
      const imageCount = parseInt(uploadImageButton.dataset.imageCount, 10);
      
      if (imageCount >= 2) {
         Swal.fire({
               title: '{{ __('messages.preview_image1') }}',
               text: '{{ __('messages.preview_image2') }}',
               icon: 'warning',
               confirmButtonText: '{{ __('messages.preview_image3') }}'
         });
         return false;
      }
   
   }
   
   function uploadImages(formData) {
      $.ajax({
         url: "{{ route('upload.profile.picture') }}",
         method: "POST",
         data: formData,
         processData: false,
         contentType: false,
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function (response) {
            //console.log(response);
            $('#imageModal').modal('hide');
            $('#profile_picture').val('');
            $('#imageToCrop').attr('src', '');
            $('#imagePreviews').html('');
               if (response.success) {
                  ///alert(response.message);
                  $('#profile-picture').load(' #profile-picture-view', function() {
                     $('#image_preview').load(' #profilePicture-preview');
                  });
                  $('#loadingSpinner').addClass('d-none');
                  $('#Modal-body-2').addClass('d-none');
                  $('#Modal-body-1').removeClass('d-none');
                  $('#cropImageButton').prop('disabled', false);
                  $('#uploadCropImageButton').prop('disabled', false);
                  
               } else {
                  alert('{{ __('messages.upload_image1') }}');
               }
         }
      });
   }
</script>
<script>
   document.getElementById('interested_in').addEventListener('change', function() {
      const selectedValue = this.value;
      const preferenceContainer = document.getElementById('preference-container');
      
      if (selectedValue === 'Male-Male') {
            preferenceContainer.style.display = 'block';
            document.getElementById('interested_preference').setAttribute('required', 'true');
      } else {
         preferenceContainer.style.display = 'none';
         document.getElementById('interested_preference').removeAttribute('required');
      }
   });
   
   // Trigger the change event on page load to handle pre-selected value
   document.getElementById('interested_in').dispatchEvent(new Event('change'));
</script>
<!-- Include Cropper.js CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<!-- Include Cropper.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
   $(document).ready(function() {
      let cropper;
      $(document).on('change', '#profile_picture',function(e) {
         const previewContainer = document.getElementById('image_preview');
         const uploadImageButton = document.getElementById('imageUpload');
         const imageCount = parseInt(uploadImageButton.dataset.imageCount, 10);
         if (imageCount >= 2) {
            $('#profile_picture').val('');
            Swal.fire({
                  title: '{{ __('messages.preview_image1') }}',
                  text: '{{ __('messages.preview_image2') }}',
                  icon: 'warning',
                  confirmButtonText: '{{ __('messages.preview_image3') }}'
            });
            return false;
         }
   
         var files = e.target.files;
         if (files && files.length > 0) {
            var reader = new FileReader();
            reader.onload = function(e) {
                  // Set the image source and show the modal
                  $('#imageToCrop').attr('src', e.target.result);
                  $('#imageModal').modal('show');

                  // Check if a cropper instance already exists, and destroy it
                  if (typeof cropper !== 'undefined') {
                     cropper.destroy();
                  }

                  // Initialize cropper after image is set
                  var image = document.getElementById('imageToCrop');
                  cropper = new Cropper(image, {
                     aspectRatio: 0.5373,  
                     viewMode: 2,    
                     autoCropArea: 0.5
                  });
            };
            reader.readAsDataURL(files[0]);
         
         }
      });
   
   
      $('#cropImageButton').on('click', function() {
         
         var feedbackValue = $(this).data('feedback');
         var profileFrameBottom = "{{ asset('/pictures/profile-frame-bottom.png') }}";
   
         if(feedbackValue > 0){
            Swal.fire({
               title: "{{ __('messages.crop_image1') }}",
               text: "{{ __('messages.crop_image2') }}",
               icon: "warning",
               showCancelButton: true,
               confirmButtonText: "{{ __('messages.crop_image3') }}",
               cancelButtonText: "{{ __('messages.crop_image4') }}",
               customClass: {
                  popup: 'swal-custom-popup',
                  title: 'swal-custom-title',
                  htmlContainer: 'swal-custom-text'
               }
            }).then((result) => {
               if (result.isConfirmed) {
                  if (cropper) { 
                     $('#cropImageButton').prop('disabled', true);
                        // $('#loadingSpinner').removeClass('d-none');
                        var canvas = cropper.getCroppedCanvas({
                           width: 2382,  // Resize the image if needed
                           height: 2382,
                        });
   
                        if (canvas) {
                           canvas.toBlob(function(blob) {
                              var reader = new FileReader();
                              reader.readAsDataURL(blob);
                              reader.onloadend = function() {
                                    var base64data = reader.result;
                                    $('#croppedImage').val(base64data);
                                    $('#imagePreviews').html('<img id="previewImageShow" src="'+base64data+'" width="100%" style="position:relative;"><img class="page-img-bottom " src="{!! asset('/pictures/profile-frame-bottom.png') !!}"/>');
   
                                    const form = document.querySelector('#profileForm');  
                                    const formData = new FormData(form);
                                    formData.append('cropped_image', blob, 'cropped.jpg');
                                    //uploadImages(formData);
                                    $('#Modal-body-1').addClass('d-none');
                                    $('#Modal-body-2').removeClass('d-none');
                              };
                           }, 'image/jpeg', 0.7);
                        } else {
                           console.error("{{ __('messages.crop_image5') }}");
                        }
                  } else {
                        alert('{{ __('messages.crop_image6') }}');
                  }
               } 
            });
         }else{
            if (cropper) { 
               $('#cropImageButton').prop('disabled', true);
                  // $('#loadingSpinner').removeClass('d-none');
                  var canvas = cropper.getCroppedCanvas({
                     width: 2382,  // Resize the image if needed
                     height: 2382,
                  });
   
                  if (canvas) {
                     canvas.toBlob(function(blob) {
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = function() {
                              var base64data = reader.result;
   
                              $('#croppedImage').val(base64data);
                              $('#imagePreviews').html('<img id="previewImageShow" src="'+base64data+'" width="100%" style="position:relative;"><img class="page-img-bottom " src="{!! asset('/pictures/profile-frame-bottom.png') !!}"/>');
                              
                              const form = document.querySelector('#profileForm');  
                              const formData = new FormData(form);
                              formData.append('cropped_image', blob, 'cropped.jpg');
                              //uploadImages(formData);
                              $('#Modal-body-1').addClass('d-none');
                              $('#Modal-body-2').removeClass('d-none');
                        };
                     }, 'image/jpeg', 0.7);
                  } else {
                     console.error("{{ __('messages.crop_image5') }}");
                  }
            } else {
                  alert('{{ __('messages.crop_image6') }}');
            }
         }
      });
   
      $('#backToCrop').on('click', function(e) {
         $('#cropImageButton').prop('disabled', false);
         $('#Modal-body-2').addClass('d-none');
         $('#Modal-body-1').removeClass('d-none');
      });
   
      $('#imageModal').on('hidden.bs.modal', function() {
         // Reset the file input value to allow selecting the same file again
         $('#profile_picture').val('');
      });
      // Crop the image when the user clicks the crop button
      $('#uploadCropImageButton').on('click', function() {
         $('#loadingSpinner').removeClass('d-none');
         $('#uploadCropImageButton').prop('disabled', true);
         const form = document.querySelector('#profileForm');  
         const formData = new FormData(form);
         uploadImages(formData);
      });
   
   });
   
</script> 
<script>
   function toggleFeetInches(value) {
      const cmSection = document.querySelector('[for="height"]').parentNode;
      const feetSection = document.querySelector('[for="feet"]').parentNode;
      const inchesSection = document.querySelector('[for="inches"]').parentNode;
   
      const heightInput = document.getElementById('height');
      const feetInput = document.getElementById('feet');
      const inchesInput = document.getElementById('inches');
   
      if (value === 'Feet') {
         // Toggle visibility
         cmSection.style.display = 'none';
         feetSection.style.display = 'block';
         inchesSection.style.display = 'block';
   
         // Update validation rules
         heightInput.removeAttribute('required');
         feetInput.setAttribute('required', 'required');
         inchesInput.setAttribute('required', 'required');
   
         // Add ARIA attributes
         cmSection.setAttribute('aria-hidden', 'true');
         feetSection.setAttribute('aria-hidden', 'false');
         inchesSection.setAttribute('aria-hidden', 'false');
      } else {
         // Toggle visibility
         cmSection.style.display = 'block';
         feetSection.style.display = 'none';
         inchesSection.style.display = 'none';
   
         // Update validation rules
         heightInput.setAttribute('required', 'required');
         feetInput.removeAttribute('required');
         inchesInput.removeAttribute('required');
   
         // Add ARIA attributes
         cmSection.setAttribute('aria-hidden', 'false');
         feetSection.setAttribute('aria-hidden', 'true');
         inchesSection.setAttribute('aria-hidden', 'true');
      }
   }
   
   // Initialize on page load
   document.addEventListener('DOMContentLoaded', () => {
      const dropdown = document.getElementById('description');
      toggleFeetInches(dropdown.value);
   
      dropdown.addEventListener('change', (e) => toggleFeetInches(e.target.value));
   });
   
   
   $(document).ready(function () {
      function loadStates(countryId, selectedState = '') {
         if (countryId) {
               $.ajax({
                  url: '/get-states',
                  type: 'GET',
                  data: { countryId:countryId },
                  success: function (response) {
                     $('#residenceState').html('<option value="">{{ __('messages.profile_residence_state_option0') }}</option>');
                     $.each(response, function (index, state) {
                           let isSelected = (state.name === selectedState) ? 'selected' : '';
                           $('#residenceState').append(`<option value="${state.name}" data-id="${state.id}" ${isSelected}>${state.name}</option>`);
                     });
   
                     if (selectedState) {
                        let selectedCity = $('#residenceCity').data('selected-city');
                        let stateId = $('#residenceState').find(':selected').data('id');
                        loadCities(stateId, selectedCity);
                     }
   
                  }
               });
         }
      }
   
   
      function loadCities(stateId, selectedCity = '') {
         if (stateId) {
               $.ajax({
                  url: '/get-cities',
                  type: 'GET',
                  data: { 
                     stateId:stateId
                   },
                  success: function (response) {
                     $('#residenceCity').html('<option value="">{{ __('messages.profile_residence_city_option0') }}</option>'); 
                     $.each(response, function (index, city) {
                           let isSelected = (city.name === selectedCity) ? 'selected' : '';
                           $('#residenceCity').append(`<option value="${city.name}" data-id="${city.id}" ${isSelected}>${city.name}</option>`);
                     });
                  }
               });
         }
   
      }
   
      $('#residenceCountry').on('change', function () {
         var countryId = $(this).find(':selected').data('id'); 
         if(countryId) {
            loadStates(countryId);
         }
      });
   
      $('#residenceState').on('change', function () {
         var stateId = $(this).find(':selected').data('id');
         if(stateId) {
            loadCities(stateId);
         }
      });
   
   
      let selectedCountry = $('#residenceCountry').data('selected-country');
      let selectedState = $('#residenceState').data('selected-state');
      let countryId = $('#residenceCountry').find(':selected').data('id');
   
      if (countryId) {
         loadStates(countryId, selectedState);
      }
   });
   
   $(document).ready(function () {
      $('#work-out').on('change', function () {
         let selectedValue = $(this).val();
   
         if (selectedValue === 'never' || selectedValue === '') {
               $('#workout-habit').addClass('d-none'); 
         } else {
               $('#workout-habit').removeClass('d-none');
         }
      });
   
      $('#smoke').on('change', function () {
         let selectedValue = $(this).val();
   
         if (selectedValue === 'never' || selectedValue === '') {
               $('#smoke-habit').addClass('d-none'); 
         } else {
               $('#smoke-habit').removeClass('d-none');
         }
      });
   
      $('#work-out').trigger('change');
      $('#smoke').trigger('change');
   });
   $('form').on('keydown', function(e) {
      if (e.key === 'Enter') {
         e.preventDefault();
         return false;
      }
   });
</script>
@endpush