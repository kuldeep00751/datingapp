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
      /* border-bottom: 1px solid #dddcdc; */
      }
      .item-widget .item-widget-title {
         margin: 0;
         color: #e9e9e9 !important;
         font-size: 34px;
         font-weight: bold;
         line-height: 25px;
         padding: 15px 35px;
         margin-bottom: 0px !important;
         text-align: center;
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
      padding: 40px 80px;
      position: relative;
      color:white !important;
      }
      .item-infos-content .item-infos-item {
      padding-bottom: 0px;
      display:flex;
      }
      .item-infos-content .item-info-label {
      color: #000;
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
      background: #e7e7e7;
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
      #meetingForm h4
      {
      color:#000;
      }
      @media (max-width: 768px)
      {
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
     
      .text-right{
      text-align:right !important;
      }
      .m2{
      margin-bottom: 5rem !important;
      line-height: 0.9;
      margin-top: 1rem;
      }
      .mb6{
      margin-bottom: 3rem;
      }
      .text-pink {
      color: #e596d0 !important;
      }
      .profile-res{
      font-size: 30px;
      font-family: 'FutureBTBook', serif;
      padding-left: 20px;
      padding-right: 20px;
      }
      .icon-container {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100px; /* Adjust size as needed */
      height: 80px;
      }
      .thumbs-up {
      background-color: black; /* Circle background */
      color: white; /* Icon color */
      width: 70px;
      height: 70px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 40px;
      }
      .feedback-img {
         width: 47px;
         height: 47px;
         color: #fff;
         text-align: center;
      }
      .tl-37
      {
         font-size: 32px;
         font-weight: 100;
         font-family: 'AvenirNext', sans-serif;
         font-style:normal;
         color:#666666;
      }
      .tl-37-1{
         margin-bottom: 0px;
         line-height: 0.8;
      }
      .sub-37 {
         font-size: 24px;
      }
      .feedback-title-comment{
      line-height: 16px !important; 
      font-size: 16px;
     
      font-weight:100 !important;
      }
      .sub-title-37{
      font-size:22px;
      }
      @media (max-width:786px)
      {
         .item-infos-content
         {
            padding: inherit;
         }
         .feedback-title-comment
         {
            margin-left:0px;
         }
         .tl-37-1
         {
         margin-bottom: 0px;
         line-height: 1;
         }
         .tl-37 
         {
         font-size: 20px;
         }
         .sub-37 
         {
         font-size: 18px;
         }
      }
   </style>
</head>
<div class="">
   <main class="item-page-main-content mt-3 d-flex justify-content-center">
      <div id="info" class="grid-column tab-content-data active container">
         <div class="item-widget item-white-bg item-wg-title-icon-bg fadeIn " data-effect="fadeIn">
            <div class="item-widget-main-content " style="background: url('{{ asset('feedback_Icons/feedback-background-img.png') }}'); background-size: 100% 100%;">
               <div class="item-widget-head" style="font-family: 'AvenirNext', sans-serif;">
                  <h2 class="item-widget-title mb-3 text-white py-5 px-0 ">
                     <!-- <i class="fas fa-info float-left"></i> <br> -->
                     <b class="text-uppercase" style="color: #666666;">@lang('messages.feedback-form-title')</b>
                     <div class="col-md-12 feedback-title-comment mt-4 text-center" style="font-family: 'FutureBTBook', sans-serif; color: #b5b5b5;">@lang('messages.show_feedback_1')</div>
                  </h2>
               </div>
               @if($feedback)
                  @php
                  $photogenic_avg = $feedback->photogenic ?? 0;
                  $expressiveness_avg = $feedback->expressiveness ?? 0;
                  $attention = $feedback->attention ?? 0;
                  $manners_avg = $feedback->manners ?? 0;
                  $opinions_ideas_avg = $feedback->opinions_ideas ?? 0;
                  $sense_humer_avg = $feedback->sense_humer ?? 0;
                  $energy_avg = $feedback->energy ?? 0;
                  $willingness_avg = $feedback->willingness ?? 0;
                  $commentUserName = getUserDetails($feedback->user_id)->like_to_be_called ?? '';
                  @endphp
                  @if($isPendingFeedback == 1)
                     <div class="item-widget-content" style="font-family: 'FutureBTBook', sans-serif;">
                        <div class="item-infos-content">
                           <div class="mb-3 mx-3 py-3">
                              <h5 >
                              {{ $likedUserName }} @lang('messages.show_feedback_2').<br> <br>
                              <a href="/sendFeedback" class="btn btn-sm btn-primary">@lang('messages.show_feedback_3')</a></h4>
                           </div>
                        </div>
                     </div>
                  @else
                     <div class="item-widget-content" style="font-family: 'FutureBTBook', sans-serif;">
                        <div class="item-infos-content">
                           
                           
                           <div class="row mx-2 py-3">
                           <div class="col-12 col-md-12 offset-md-1  mb-5">
                              <h1 ><b style="font-family: 'AvenirNext', sans-serif;font-weight: 100;color: #666666;" class="text-uppercase">@lang('messages.view_profile_43')</b></h1>
                              <p class="sub-title-37 mb-5">@lang('messages.show_feedback_4') {{$commentUserName}} @lang('messages.show_feedback_5').</p>
                           </div>

                              @if($photogenic_avg > 0)
                                 <div class="col-2 col-md-1 offset-md-1 text-right mb-5">
                                    <div class="box-imge"><img class="feedback-img " src="{{ asset('feedback_Icons/photo_icon.png') }}"></div>
                                 </div>
                                 <div class="col-10 col-md-10">
                                    <h4 class="tl-37 tl-37-1"> @lang('messages.view_profile_45')</h4>
                                    <p class="sub-37 {{ $photogenic_avg == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_46')</p>
                                    <p class="sub-37 {{ $photogenic_avg == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_47')</p>
                                    <p class="sub-37 {{ $photogenic_avg == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_48')</p>
                                    <p class="sub-37 {{ $photogenic_avg == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_49')</p>
                                    <p class="sub-37 {{ $photogenic_avg == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_50')</p>
                                 </div>
                              @endif
                              @if($expressiveness_avg > 0)
                                 <div class="col-2 col-md-1 offset-md-1 text-right mb-5">
                                    <div class="box-imge"><img class="feedback-img " src="{{ asset('feedback_Icons/expresiveness_icon.png') }}"></div>
                                 </div>
                                 <div class="col-10 col-md-10">
                                    <h4 class="tl-37 tl-37-1"> @lang('messages.view_profile_51')</h4>
                                    <p class="sub-37 {{ optional($feedback)->expressiveness == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_52')</p>
                                    <p class="sub-37 {{ optional($feedback)->expressiveness == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_53')</p>
                                    <p class="sub-37 {{ optional($feedback)->expressiveness == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_54')</p>
                                    <p class="sub-37 {{ optional($feedback)->expressiveness == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_55')</p>
                                    <p class="sub-37 {{ optional($feedback)->expressiveness == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_56')</p>
                                 </div>
                              @endif
                              @if($attention > 0)

                                 <div class="col-2 col-md-1 offset-md-1 text-right mb-5">
                                    <div class="box-imge"><img class="feedback-img " src="{{ asset('feedback_Icons/attention_icon.png') }}"></div>
                                 </div>
                                 <div class="col-10 col-md-10">
                                    <h4 class="tl-37 tl-37-1">@lang('messages.view_profile_57')</h4>
                                    <p class="sub-37 {{ optional($feedback)->attention == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_58')</p>
                                    <p class="sub-37 {{ optional($feedback)->attention == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_59')</p>
                                    <p class="sub-37 {{ optional($feedback)->attention == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_60')</p>
                                    <p class="sub-37 {{ optional($feedback)->attention == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_61')</p>
                                    <p class="sub-37 {{ optional($feedback)->attention == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_62')</p>
                                 </div>

                              @endif
                              @if($manners_avg > 0)
                              <div class="col-2 col-md-1 offset-md-1 text-right mb-5">
                                 <div class="box-imge"><img class="feedback-img " src="{{ asset('feedback_Icons/manners_icon.png') }}"></div>
                              </div>
                              <div class="col-10 col-md-10">
                                 <h4 class="tl-37 tl-37-1">@lang('messages.view_profile_63') </h4>
                                 <p class="sub-37 {{ optional($feedback)->manners == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_64')</p>
                                 <p class="sub-37 {{ optional($feedback)->manners == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_65')</p>
                                 <p class="sub-37 {{ optional($feedback)->manners == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_66')</p>
                                 <p class="sub-37 {{ optional($feedback)->manners == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_67')</p>
                                 <p class="sub-37 {{ optional($feedback)->manners == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_68')</p>
                              </div>
                              @endif
                              @if($opinions_ideas_avg > 0)
                              <div class="col-2 col-md-1 offset-md-1 text-right mb-5">
                                 <div class="box-imge"><img class="feedback-img " src="{{ asset('feedback_Icons/opinions_icon.png') }}"></div>
                              </div>
                              <div class="col-10 col-md-10">
                                 <h4 class="tl-37 tl-37-1">@lang('messages.view_profile_69')</h4>
                                 <p class="sub-37 {{ optional($feedback)->opinions_ideas == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_70')</p>
                                 <p class="sub-37 {{ optional($feedback)->opinions_ideas == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_71')</p>
                                 <p class="sub-37 {{ optional($feedback)->opinions_ideas == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_72')</p>
                                 <p class="sub-37 {{ optional($feedback)->opinions_ideas == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_73')</p>
                                 <p class="sub-37 {{ optional($feedback)->opinions_ideas == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_74')</p>
                              </div>
                              @endif
                              @if($sense_humer_avg > 0)
                              <div class="col-2 col-md-1 offset-md-1 text-right mb-5">
                                 <div class="box-imge"><img class="feedback-img " src="{{ asset('feedback_Icons/comments_icon.png') }}"></div>
                              </div>
                              <div class="col-10 col-md-10">
                                 <h4 class="tl-37 tl-37-1">@lang('messages.view_profile_75')</h4>
                                 <p class="sub-37 {{ optional($feedback)->sense_humer == 1 ? '' : 'd-none' }}"> @lang('messages.view_profile_76')</p>
                                 <p class="sub-37 {{ optional($feedback)->sense_humer == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_77')
                                 </p>
                                 <p class="sub-37 {{ optional($feedback)->sense_humer == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_78')</p>
                                 <p class="sub-37 {{ optional($feedback)->sense_humer == 4 ? '' : 'd-none' }}"> @lang('messages.view_profile_79')</p>
                                 <p class="sub-37 {{ optional($feedback)->sense_humer == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_80')</p>
                              </div>
                              @endif
                              @if($energy_avg > 0)
                              <div class="col-2 col-md-1 offset-md-1 text-right mb-5">
                                 <div class="box-imge"><img class="feedback-img " src="{{ asset('feedback_Icons/energy_icon.png') }}"></div>
                              </div>
                              <div class="col-10 col-md-10">
                                 <h4 class="tl-37 tl-37-1">@lang('messages.view_profile_81')</h4>
                                 <p class="sub-37 {{ optional($feedback)->energy == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_82')</p>
                                 <p class="sub-37 {{ optional($feedback)->energy == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_83')</p>
                                 <p class="sub-37 {{ optional($feedback)->energy == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_84')</p>
                                 <p class="sub-37 {{ optional($feedback)->energy == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_85')</p>
                                 <p class="sub-37 {{ optional($feedback)->energy == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_86')</p>
                              </div>
                              @endif
                              @if($willingness_avg > 0)
                              <div class="col-2 col-md-1 offset-md-1 text-right mb-5">
                                 <div class="box-imge"><img class="feedback-img " src="{{ asset('feedback_Icons/willingness_icon.png') }}"></div>
                              </div>
                              <div class="col-10 col-md-10">
                                 <h4 class="tl-37 tl-37-1">@lang('messages.view_profile_87')</h4>
                                 <p class="sub-37 {{ optional($feedback)->willingness == 1 ? '' : 'd-none' }}">@lang('messages.view_profile_88')</p>
                                 <p class="sub-37 {{ optional($feedback)->willingness == 2 ? '' : 'd-none' }}">@lang('messages.view_profile_89')</p>
                                 <p class="sub-37 {{ optional($feedback)->willingness == 3 ? '' : 'd-none' }}">@lang('messages.view_profile_90')</p>
                                 <p class="sub-37 {{ optional($feedback)->willingness == 4 ? '' : 'd-none' }}">@lang('messages.view_profile_91')</p>
                                 <p class="sub-37 {{ optional($feedback)->willingness == 5 ? '' : 'd-none' }}">@lang('messages.view_profile_93')</p>
                              </div>
                              @endif
                              <div class="col-2 col-md-1 offset-md-1 text-right mb-5">
                                 <div class="box-imge">
                                    <img class="feedback-img " src="{{ asset('feedback_Icons/comments_icon.png') }}">
                                 </div>
                              </div>
                              <div class="col-10 col-md-10" style="border-bottom: 1px solid #fff;width: 60%;">
                                 <h4 class="tl-37 tl-37-1">@lang('messages.view_profile_95')</h3> 
                                 <p class="sub-37 mb-2" style="width: 100%;">
                                    @if(optional($feedback)->serious_relationship =="Yes")
                                    {{ optional($feedback)->connect_person }}
                                    @else
                                    {{ optional($feedback)->compliment }}
                                    @endif
                                 </p>
                                 
                                 <div class="btn-group" role="group" aria-label="Publish Comment Option" style="font-family: 'FutureBTBook', sans-serif;"> 
                                    <label>@lang('messages.view_profile_96')</label><br>
                                    <div class="btn-group " role="group">
                                       <button type="button"
                                          class="btn btn-outline-success publish-comment-btn mx-2 mb-3 text-white
                                          @if($feedback->is_publish_comments == 1) active @endif"
                                          data-status="1"
                                          data-user-id="{{ $feedback->like_user_id }}"
                                          data-liked-user-id="{{ $feedback->user_id }}"
                                          data-comment-id="{{ $feedback->id }}" 
                                          style="padding: 1px 5px 5px 5px;height: 25px; border-radius: 0;">
                                       @lang('messages.view_profile_97')
                                       </button>
                                       <button type="button"
                                          class="btn btn-outline-danger publish-comment-btn mx-2 mb-3 text-white
                                          @if($feedback->is_publish_comments == 0) active @endif"
                                          data-status="0"
                                          data-user-id="{{ $feedback->like_user_id }}"
                                          data-liked-user-id="{{ $feedback->user_id }}"
                                          data-comment-id="{{ $feedback->id }}" 
                                          style="padding: 1px 5px 5px 5px;height: 25px; border-radius: 0;">
                                       @lang('messages.view_profile_98')
                                       </button>
                                    </div>
                                 </div>
                                 
                              </div>
                              
                           </div>
                           <div class="text-center mx-4 publish-activity" id="publish-activity" style="font-family: 'FutureBTBook', sans-serif;">
                              
                           </div>
                        </div>
                     
                     </div>
                  @endif
               @else
                  <div class="item-widget-content" style="font-family: 'FutureBTBook', sans-serif;">
                     <div class="item-infos-content">
                        <div class="mb-3">
                           <h5>
                           @lang('messages.show_feedback_no_feedback').</h4>
                        </div>
                     </div>
                  </div>
               @endif
            </div>
         </div>
      </div>
   </main>
</div>
<script>
   $(document).ready(function () {
     $('.publish-comment-btn').click(function () {
        let button = $(this);
        let status = button.data('status');
        let commentId = button.data('comment-id');
        let userId = button.data('user-id');
        let likedUserId = button.data('liked-user-id');
   
        // Remove 'active' class from sibling buttons
        button.siblings().removeClass('active');
        // Add 'active' class to the clicked one
        button.addClass('active');
   
        $.ajax({
              url: '/publish-comment',
              method: 'POST',
              data: {
                 _token: $('meta[name="csrf-token"]').attr('content'),
                 user_id: userId,
                 liked_user_id: likedUserId,
                 comment_id: commentId,
                 status: status
              },
              success: function (response) {

               // $('#publish-activity').html(`
               // <a href="/show-all/${userId}/view"
               //    class="btn btn-outline-secondary text-white"
               //    style="height: 40px;">
               //    Ok, thanks
               // </a>
               // `);
               Swal.fire({
                  title: `{{ __('messages.showfeedbackconfirm') }}`,
                  icon: 'success',
                  confirmButtonText: 'OK'
               }).then((result) => {
                  if (result.isConfirmed) {
                        window.location.href = `/show-all/${userId}/view`;
                  }
               });
              }
        });
     });
   }); 
</script>
@endsection