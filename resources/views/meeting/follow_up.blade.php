@extends('layouts.app')
@section('content')
<head>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <style>
      body {
      /* background: linear-gradient(to left, #8942a8, #ba382f); */
      }
      .py-4{
      padding-top:0px !important;
      padding-bottom:0px !important;
      }
      .item-header-content {
      width: 100%;
      margin: 0 auto;
      }
      .item-user-profile-cover-img {
      height: 100px;
      width: 100%;
      object-fit: cover;
      }
      .item-hdr-v1 .item-cover-content .item-inner-content {
      z-index: 9;
      width: 100%;
      bottom: 30px;
      position: absolute;
      }
      .item-hdr-v1 .item-profile-photo {
      position: relative;
      z-index: 999999;
      height: 160px;
      width: 160px;
      float: left;
      }
      .item-photo-border {
      background: transparent !important;
      }
      .item-photo-circle img {
      -webkit-border-radius: 100%;
      -moz-border-radius: 100%;
      -ms-border-radius: 100%;
      -o-border-radius: 100%;
      border-radius: 100%;
      }
      .item-user-statistics {
      top: 50%;
      z-index: 9998;
      position: absolute;
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
      }
      .item-head-content {
      float: left;
      margin-left: 15px;
      margin-top: 128px;
      }
      .item-cover-content{
      width: 100%;
      margin: 0 auto;
      }
      .lazyloaded {
      opacity: 1;
      transition: opacity .3s;
      }
      .item-header-cover {
      position: relative;
      background-position: center;
      }
      .item-header-overlay .item-header-cover:before {
      opacity: .8;
      z-index: 5;
      }
      .item-header-cover:after, .item-header-cover:before {
      top: 0;
      left: 0;
      z-index: 0;
      content: "";
      width: 100%;
      height: 100%;
      position: absolute;
      } 
      .item-hdr-v1 .item-header-cover, .item-hdr-v2 .item-header-cover {
      font-size: 22px;
      color: #fff;
      }
      .item-user-ratings-details {
      z-index: 9;
      margin-top: 15px;
      position: relative;
      }
      .item-user-ratings-details .item-separator, .item-user-ratings-details .item-user-rating-stars, .item-user-ratings-details .item-user-ratings-rate, .item-user-ratings-details .item-user-ratings-total {
      vertical-align: middle;
      display: inline-block;
      }
      .item-hdr-v1 .item-user-statistics {
      right: 0;
      }
      .item-profile-header .item-user-statistics li {
      min-width: 65px;
      }
      .item-user-statistics li {
      color: #fff;
      padding: 0 20px;
      text-align: center;
      display: inline-block;
      text-transform: uppercase;
      }
      .item-hdr-v1 .item-cover-content .item-head-content, .item-hdr-v1 .item-user-statistics {
      top: 50%;
      z-index: 9998;
      position: absolute;
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
      }
      .item-hdr-v1 .item-cover-content .item-head-content {
      /* float: left; */
      margin-left: 185px;
      }
      .item-user-statistics ul {
      margin: 0;
      }
      .youzify li, .youzify ul {
      margin: 0;
      padding: 0;
      list-style: none;
      }
      .item-user-statistics li a{
      color: #fff;
      padding: 0 20px;
      text-align: center;
      display: inline-block;
      text-transform: uppercase;
      }
      .item-usermeta ul{
      padding-left: 0px;
      }
      .item-usermeta li{
      list-style:none;
      }
      .item-account-verified{
      border: 3px solid #56f756;
      border-radius: 50%;
      font-size: 15px;
      margin: 6px;
      color: #56f756;
      padding: 2px 2px;
      }
      #item-profile-navmenu {
      z-index: 1;
      height: initial;
      line-height: initial;
      position: relative;
      background-color: var(--yzfy-card-bg-color);
      }
      #item-profile-navmenu .item-inner-content{
      width: 100%;
      margin: 0 auto;
      display: table;
      position: relative;
      }
      .fadeIn {
      -webkit-animation-name: fadeIn;
      animation-name: fadeIn;
      }
      .bounceInLeft, .bounceInRight, .fadeIn, .fadeInDown, .fadeInLeft, .fadeInRight, .fadeInUp, .fadeInUpDelay {
      visibility: visible;
      }
      article, aside, details, figcaption, figure, footer, header, main, menu, nav, section, summary {
      display: block;
      }
      .item-profile-navmenu {
      margin: 0 auto;
      position: relative;
      display: -webkit-flex;
      display: flex;
      -webkit-flex-wrap: wrap;
      flex-wrap: wrap;
      float: right;
      }
      .item-profile-navmenu > ul {
      list-style: none;
      }
      .item-profile-navmenu > li {
      margin: 0;
      float: left;
      text-align: center;
      position: relative;
      margin: 0;
      padding: 0;
      list-style: none;
      font-weight: 300;
      font-size: 17px;
      }
      .item-navbar-item a {
      color: #848b92;
      cursor: pointer;
      font-weight: 600;
      line-height: 22px;
      font-size: 16px;
      padding: 26px 25px;
      display: inline-block;
      text-transform: uppercase;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      -webkit-touch-callout: none;
      -khtml-user-select: none;
      -webkit-tap-highlight-color: transparent;
      min-width: 130px;
      }
      li a:hover {
      color: #ff3535 !important;
      }
      .item-navbar-item a i {
      margin: 0 10px 0 0;
      color: 14px;
      font-weight: 700;
      }
      .item-navbar-item.item-active-menu {
      border-color: #ff3535 !important;
      border-bottom: 4px solid;
      }
      .item-page-main-content {
      margin: auto;
      padding: 0 0 35px;
      max-width: 1170px;
      position: relative;
      }
      .item-right-sidebar-layout {
      grid-template-columns: calc(72% - 35px) 28%;
      }
      .item-left-sidebar-layout, .item-right-sidebar-layout {
      display: grid
      ;
      grid-gap: 35px;
      }
      .item-white-bg{
      box-shadow: 0 0 20px rgb(0 0 0 / 10%);
      -webkit-box-shadow: 0 0 20px rgb(0 0 0 / 10%);
      }
      .item-widget .item-widget-main-content {
      width: 100%;
      z-index: 9999;
      color: #8d8c8c;
      }
      .item-widget .item-widget-head {
      border-bottom: 1px solid #dddcdc;
      }
      .item-widget .item-widget-title {
      margin: 0;
      color: #333;
      font-size: 18px;
      font-weight: bold;
      line-height: 35px;
      padding: 15px 35px;
      margin-bottom: 0px !important;
      }
      .item-wg-title-icon-bg .item-widget-title i {
      width: 35px;
      height: 35px;
      line-height: 35px;
      margin-right: 10px;
      text-align: center;
      background-color: #ff3131;
      color: #ffffff;
      border-radius: 100%;
      }
      .item-infos-content{
      padding: 142px 240px;
      }
      .item-infos-content .item-infos-item {
      padding-bottom: 0px;
      display:flex;
      }
      .item-infos-content .item-info-label {
      color: #fff;
      font-size: 14px;
      font-weight: 600;
      min-width: 160px;
      margin-right: 1rem;
      }
      .item-infos-content .item-info-data {
      text-align: left;
      line-height: 22px;
      vertical-align: top;
      /* width: calc(100% - 180px); */
      }
      .item-user-img img {
      width: 180px;
      height: 200px;
      margin: 12px 35px;
      }
      .item-default-content{
      padding:35px;
      }
      .item-profile-sidebar .item-aboutme-container {
      text-align: center;
      }
      .item-navbar-item.item-active-menu a{
      color: #ff3535 !important;
      }
      .item-aboutme-name {
      color: #000;
      font-size: 18px;
      font-weight: bold;
      line-height: 24px;
      letter-spacing: .02em;
      text-transform: uppercase;
      }
      .item-aboutme-description{
      font-size: 13px;
      }
      .item-aboutme-head:after {
      margin: 23px auto 23px;
      content: "";
      width: 50px;
      height: 4px;
      display: block;
      margin-top: 24px;
      background-color: #f0f0f0;
      }
      .item-widget {
      position: relative;
      margin-bottom: 35px;
      }
      .item-media-box {
      padding-top: 5px;
      background-color: #f4f4f4;
      display: block !important;
      }
      .item-media-filter {
      padding: 0 5px;
      overflow: hidden;
      background: #f4f4f4;
      }
      .item-media-filter .item-filter-item {
      width: 20%;
      float: left;
      display: block;
      padding: 4px;
      }
      .item-filter-content{
      background-color: #ff3535 !important;
      color: #ffffff !important;
      width: 100%;
      padding: 12px 5px;
      color: #898989;
      cursor: pointer;
      text-align: center;
      border-radius: 3px;
      }
      .item-filter-item .item-filter-content i {
      font-size: 15px;
      margin-bottom: 8px;
      display: block;
      }
      .item-media-widget .item-media-group-photos .item-media-item, .item-media-widget .item-media-group-videos .item-media-item {
      /* width: calc(33.33% - 6.66px); */
      /* margin: 5px 10px 5px 0; */
      }
      .item-media-widget .item-media-item {
      margin: 0;
      float: left;
      /* width: 33.33%; */
      text-align: left;
      position: relative;
      border: 3px solid #fff;
      }
      .item-media-item .item-media-item-img img, .item-media-item-video video {
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      width: 96px;
      height: 95px;
      object-fit: cover;
      object-position: center;
      display: flex
      ;
      flex-wrap: wrap;
      }
      .item-media-item .item-media-item-tools {
      text-align: center;
      top: calc(50% - 10px);
      z-index: 9;
      cursor: pointer;
      position: absolute;
      top: calc(50% - 22px);
      left: 0;
      right: 0;
      }
      .item-media-widget-content{
      padding: 0 10px 5px;
      overflow: hidden;
      }
      .item-media-view-all {
      color: #898989;
      display: block;
      font-size: 13px;
      font-weight: 600;
      background: #fff;
      padding: 20px 0;
      text-align: center;
      }
      .item-media-item-tools{
      position: absolute;
      top: 2rem;
      left: 1rem;
      }
      .item-media-post-link{
      color: #fff;
      width: 45px;
      height: 45px;
      margin: auto;
      line-height: 45px;
      text-align: center;
      border-radius: 100%;
      background: rgba(0, 0, 0, .3);
      }
      .tab-content-data {
      display: none;
      }
      .tab-content-data.active {
      display: block;
      }
      .item-media-head{
      background: url(https://qiupid.modeltheme.com/wp-content/plugins/youzify/includes/public/assets/images/pattern.svg), linear-gradient(to right, #ff3131, #ff3131);
      }
      .item-media-title{
      color: #fff;
      padding: 10px !important;
      }
      .item-media-title .fontview{
      background: #514A9D;
      }
      .item-media-group-content .item-media-item {
      width: calc(25% - 10px);
      margin-right: 13px;
      margin-bottom: 12.5px;
      border: 6px solid #fff;
      }
      .item-media-item-img-data{
      position:absolute;
      }
      .item-media-item-tools-data {
      position: relative;
      top: -7rem;
      left: 6rem;
      }
      .item-media-group, .item-media-4columns .item-media-group {
      margin-bottom: 22.5px;
      }
      .media-content .item-media-item .item-media-item-img img {
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      object-position: center;
      }
      .media-content .item-media-item .item-media-item-img .item-media-item-tools {
      z-index: 9;
      cursor: pointer;
      text-align: center;
      top: calc(50% - 10px);
      z-index: 9;
      cursor: pointer;
      position: absolute;
      top: calc(50% - 22px);
      left: 0;
      right: 0;
      }
      .media-content .item-media-item .item-media-item-tools {
      text-align: center;
      top: calc(50% - 10px);
      z-index: 9;
      cursor: pointer;
      position: absolute;
      top: calc(50% - 22px);
      left: 0;
      right: 0;
      }
      .media-content .item-media-item {
      width: calc(25% - 0px);
      margin-right: 0px;
      margin-bottom: 12.5px;
      border: 6px solid #fff;
      display: block;
      float: left;
      position: relative;
      }
      .media-content .item-media-item-img {
      position: relative;
      padding-top: 100%;
      display: block;
      }
      .item-media-item {
      position: relative;
      display: inline-block;
      }
      .item-media-item-img {
      display: block;
      width: 100%;
      }
      .item-media-post-link {
      position: absolute;
      bottom: 0px;
      left: 0px;
      background-color: rgba(0, 0, 0, 0.7);
      color: white;
      padding: 0px 10px;
      text-decoration: none;
      font-size: 14px;
      transition: opacity 0.3s ease;
      right: 0px;
      top: 15px;
      opacity: 0;
      }
      .item-media-item:hover .item-media-post-link  {
      opacity: 1;
      }
      .iteminnercontent 
      {
      position: absolute;
      top: -120px;
      left: 12px;
      z-index: 9;
      }
      .youzify-name h2 
      {
      font-weight: bolder;
      margin: 0px;
      font-size: 24px;
      text-transform: uppercase;
      }
      @media(max-width : 768px)
      {
      #item-profile-navmenu .item-inner-content 
      {
      padding-top: 16%;
      }
      .item-left-sidebar-layout, .item-right-sidebar-layout
      {
      display: inherit;
      grid-gap: 0px;
      }
      .media-content .item-media-item 
      {
      display: inline-flex;
      float: inherit;
      }
      }
      .heading{
      color:#fff;
      padding-right: 5rem ;
      padding-top: 10px !important;
      padding-bottom: 10px !important;
      padding-left: 5px !important;
      }
      .heading-span{
      font-size: 18px;
      }
      .item-meta-item {
      color: #898989;
      display: block;
      font-size: var(--yzfy-big-font-size);
      margin-top: 10px;
      }
      .item-user-statistics {
      padding: 0 0px;
      margin-bottom: 25px;
      display:inline-flex;
      }
      .item-user-statistics .item-data-item:nth-child(1) span {
      background-color: #ffc107;
      }
      .item-data-item span {
      color: #fff;
      width: 35px;
      margin: 3px;
      height: 35px;
      display: block;
      font-size: 20px;
      line-height: 35px;
      text-align: center;
      background-color: #eee;
      border-radius: 5px;
      }
      .page-img-bottom {
      position: absolute;
      bottom: 0px;
      height: 170px;
      width: auto !important;
      right: 0px;
      }
      .page-img-top {
      height: 240px;
      position: absolute;
      top: 0px;
      left:0px;
      }
      @media (max-width: 768px)
      {
      .page-img-bottom, .page-img-top {
      height: 144px;
      width: 100%;
      }
      .item-infos-content {
      padding: 158px 40px;
      }
      .heading 
      {
      padding-right: 0rem !important;
      width:100%;
      }
      .heading-span 
      {
      font-size: 16px;
      }
      .item-account-verified {
      border: 3px solid #ff3131;
      border-radius: 50%;
      font-size: 10px;
      margin: 6px;
      color: #ff3131;
      padding: 2px 3px;
      }
      .item-infos-content .item-infos-item {
      padding-bottom: 0px;
      display: inherit;
      }
      }
      #info
      {
      background: url('pictures/PROFILE BACKGROUND.png');
      /* background: linear-gradient(14deg, #7edbff, #75dfff, #99ffd5, #ceeaf5, #a1f0fd); */
      color:#fff;
      }
   </style>
   <style>
      .form-section {
         max-width: 700px;
         margin: auto;
         padding: 2rem;
         /* background-color: #f9f9f9; */
         border-radius: 1rem;
         box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      }

      .form-section h3 {
         font-size: 2rem;
         font-weight: 700;
         margin-bottom: 1.5rem;
         color: #333;
      }

      .heading-span1 {
         font-size: 1.25rem;
         font-weight: 500;
         color: #555;
      }

      .form-control {
         border-radius: 0.5rem;
      }

      .btn-danger {
         padding: 0.75rem 2rem;
         font-size: 1.1rem;
         border-radius: 0.5rem;
      }

      .submit-section {
         margin-top: 2rem;
      }
   </style>
</head>
<div class="container py-5" >
      <div class="form-section" id="info" style="color:#fff !important;">
         <form method="post" action="{{ route('meeting.followUp.response') }}" enctype="multipart/form-data" id="meetingForm">
            @csrf
            <div class="mb-4 text-center" >
               <h3 style="color:#fff !important;">@lang('messages.follow_up_1'):</h3>
            </div>
            <div class="mb-3">
               <span class="heading-span" style="color:#fff !important;">@lang('messages.follow_up_2')</span>
            </div>
            <div class="mb-4">
               <label for="already_meet" class="form-label">@lang('messages.follow_up_2')</label>
               <select class="form-select" name="already_meet" id="already_meet" required>
                  <option value="yes">@lang('messages.follow_up_3')</option>
                  <option value="no">@lang('messages.follow_up_4')</option>
               </select>
            </div>
            <div class="submit-section text-center">
               <button type="submit" class="btn btn-danger btn-lg">
                  <i class="fas fa-paper-plane me-2"></i> @lang('messages.btn-submit')
               </button>
            </div>
         </form>
      </div>
   </div>

</div>
</main>
</div>
<script>
   $(document).ready(function () {
       $('#meetingForm').on('submit', function (e) {
           e.preventDefault();
           
           var formData = new FormData(this);
           var already_meet = $('select[name="already_meet"]').val();
           
           $.ajax({
               url: $(this).attr('action'),
               type: 'POST', 
               data: formData, 
               processData: false, 
               contentType: false,
               success: function (response) {
                  
                   if (response.success) {
                     const iscontinue =response.likeUserresponse?.continue_meet ?? null;
                       Swal.fire({
                            icon: 'success',
                            title: '{{ __('messages.follow_up_6') }}',
                            text: '{{ __('messages.follow_up_7') }}',
                            }).then(() => {
                            if(already_meet=='yes' && (iscontinue == null || iscontinue == "yes"))
                            {
                                window.location.href = "{{ route('meeting.likeToContinue') }}"; 
                            }
                            if(already_meet=='yes' && iscontinue == "no")
                            {
                              window.location.href = "{{ route('meeting.sendFeedback') }}"; 
                            }
                        });
                     // comment
                   } else {
                       Swal.fire({
                            icon: 'error',
                            title: '{{ __('messages.swal-error-title') }}',
                            text: response.message,
                        });
                   }
               }
           });
       });
   });
</script>
@endsection