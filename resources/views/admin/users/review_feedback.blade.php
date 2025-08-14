
@extends('admin.layouts.master')
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
      padding: 35px 40px;
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
  .table>:not(caption)>*>* {
        border-bottom-width: 0px !important;
        border-top: 0px solid #dee2e6 !important;
    }
    .table th, .table td {
    padding: 0rem;
}
   </style>
</head>
<div class="container">
   <main class="item-page-main-content mt-3">
        <div id="info" class="grid-column tab-content-data active">
        <div class="item-widget item-white-bg item-wg-title-icon-bg fadeIn" data-effect="fadeIn">
            <div class="item-widget-main-content">
                <div class="item-widget-head">
                    <h2 class="item-widget-title mb-3">
                        <i class="fas fa-info float-left"></i>Feedback	
                        
                    </h2>
                </div>
                <div class="item-widget-content">
                    <div class="item-infos-content">
                        <div class="col-12 mb-3" style="border: 1px solid gray;padding: 1rem;">
                            <div class="row">
                                <!-- From User Table -->
                                 @php 
                                    $userDetail = getUserDetails($feedback->user_id);
                                    $likeUserDetail = getUserDetails($feedback->like_user_id);
                                 @endphp
                                <div class="col-md-6">
                                    <h5>From:</h5>
                                    <table class="review-feedback table">
                                        <tr><th>Name</th><td>{{ $userDetail->name}} {{ $userDetail->lastname}}</td></tr>
                                        <tr><th>Email</th><td>{{ $userDetail->email}}</td></tr>
                                        <tr><th>Mobile#</th><td>{{ $userDetail->phone}}</td></tr>
                                        <!-- Add more fields as needed -->
                                    </table>
                                </div>

                                <!-- To User Table -->
                                <div class="col-md-6">
                                    <h5>To:</h5>
                                    <table class="review-feedback table">
                                        <tr><th>Name</th><td>{{ $likeUserDetail->name}} {{ $likeUserDetail->lastname}}</td></tr>
                                        <tr><th>Email</th><td>{{ $likeUserDetail->email}}</td></tr>
                                        <tr><th>Mobile#</th><td>{{ $likeUserDetail->phone}}</td></tr>
                                        <!-- Add more fields as needed -->
                                    </table>
                                </div>
                            </div>
                        </div>

                        <form method="post" action="{{ route('admin.review.feedback') }}" enctype="multipart/form-data" id="reviewFeedback">
                            @csrf
                            <input type="hidden" name="feedbackId" value="{{optional($feedback)->id ?? 0}}">
                            <div class="mb-3">
                                <h4>Photo vs Reality</h4>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input"   id="photogenic5" name="photogenic" value="5" {{ optional($feedback)->photogenic == 5 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="photogenic5">Looks much better in person</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input"   id="photogenic4" name="photogenic" value="4" {{ optional($feedback)->photogenic == 4 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="photogenic4">Looks better in person</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input"   id="photogenic3" name="photogenic" value="3" {{ optional($feedback)->photogenic == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="photogenic3">Looks practically the same as in photos</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input"   id="photogenic2" name="photogenic" value="2" {{ optional($feedback)->photogenic == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="photogenic2">Looks better in photos</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="photogenic1" name="photogenic" value="1" {{ optional($feedback)->photogenic == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="photogenic1">Looks much better in photos</label>
                                </div>
                            </div> 

                            <div class="mb-3">
                                <h4>Level of Expressiveness</h4>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="expressiveness5" name="expressiveness" value="5" {{ optional($feedback)->expressiveness == 5 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="expressiveness5">Expresses their ideas very well</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="expressiveness4" name="expressiveness" value="4" {{ optional($feedback)->expressiveness == 4 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="expressiveness4">Is more eloquent than reserved</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="expressiveness3" name="expressiveness" value="3" {{ optional($feedback)->expressiveness == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="expressiveness3">In-between, doesn’t talk too much but isn’t too reserved either</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="expressiveness2" name="expressiveness" value="2" {{ optional($feedback)->expressiveness == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="expressiveness2">Is reserved but has certain moments of eloquence</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="expressiveness1" name="expressiveness" value="1" {{ optional($feedback)->expressiveness == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="expressiveness1">Is quite reserved</label>
                                </div>
                            </div>


                            <div class="mb-3">
                                <h4>Level of Attention </h4>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="attention5" name="attention" value="5" {{ optional($feedback)->attention == 5 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="attention5">Maintains attention to details expressed by the other person</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="attention4" name="attention" value="4" {{ optional($feedback)->attention == 4 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="attention4">Misses some things but generally pays attention</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="attention3" name="attention" value="3" {{ optional($feedback)->attention == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="attention3">In-between, doesn’t listen in detail but pays attention to the main points</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="attention2" name="attention" value="2" {{ optional($feedback)->attention == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="attention2">Pays attention to certain topics but generally prefers to be the one talking</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="attention1" name="attention" value="1" {{ optional($feedback)->attention == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="attention1">Pays little attention to details in the conversation</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h4>Manners</h4>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="manners5" name="manners" value="5" {{ optional($feedback)->manners == 5 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="manners5">Handles manners very well</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="manners4" name="manners" value="4" {{ optional($feedback)->manners == 4 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="manners4">Misses a few details, but generally has good manners</label>
                                </div>
                                    <div class="form-check">
                                    <input type="radio" class="form-check-input" id="manners3" name="manners" value="3" {{ optional($feedback)->manners == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="manners3">Is balanced</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="manners2" name="manners" value="2" {{ optional($feedback)->manners == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="manners2">Is a bit picky</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="manners1" name="manners" value="1" {{ optional($feedback)->manners == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="manners1">There are quite a few details that could be improved.</label>
                                </div>
                                
                            </div>

                            <div class="mb-3">
                                <h4>Concepts & Ideas</h4>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="opinions_ideas5" name="opinions_ideas" value="5" {{ optional($feedback)->opinions_ideas == 5 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="opinions_ideas5">Many of their concepts and ideas are quite interesting</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="opinions_ideas4" name="opinions_ideas" value="4" {{ optional($feedback)->opinions_ideas == 4 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="opinions_ideas4">Has several interesting concepts and ideas</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="opinions_ideas3" name="opinions_ideas" value="3" {{ optional($feedback)->opinions_ideas == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="opinions_ideas3">Holds balanced views on topics</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="opinions_ideas2" name="opinions_ideas" value="2" {{ optional($feedback)->opinions_ideas == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="opinions_ideas2">Has some unusual concepts</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="opinions_ideas1" name="opinions_ideas" value="1" {{ optional($feedback)->opinions_ideas == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="opinions_ideas1">Has several concepts and ideas that are quite extreme and unusual</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h4>Sense of Humer</h4>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="sense_humer5" name="sense_humer" value="5" {{ optional($feedback)->sense_humer == 5 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sense_humer5">Excellent at making people laugh</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="sense_humer4" name="sense_humer" value="4" {{ optional($feedback)->sense_humer == 4 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sense_humer4">Good at making funny comments</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="sense_humer3" name="sense_humer" value="3" {{ optional($feedback)->sense_humer == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sense_humer3">Balanced</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="sense_humer2" name="sense_humer" value="2" {{ optional($feedback)->sense_humer == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sense_humer2">Rarely connected with a funny remark, or their humor wasn't quite right</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="sense_humer1" name="sense_humer" value="1" {{ optional($feedback)->sense_humer == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sense_humer1">Seriousness is their thing</label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h4>Energy When Interacting</h4>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="energy5" name="energy" value="5" {{ optional($feedback)->energy == 5 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="energy5">Vibrant: Radiates stimulating energy</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="energy4" name="energy" value="4" {{ optional($feedback)->energy == 4 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="energy4">Dynamic: Displays high energy</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="energy3" name="energy" value="3" {{ optional($feedback)->energy == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="energy3">Balanced: Their energy is stable and moderate</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="energy2" name="energy" value="2" {{ optional($feedback)->energy == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="energy2">Passive: Their energy is weak, doesn’t drive much interaction</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="energy1" name="energy" value="1" {{ optional($feedback)->energy == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="energy1">Dull: Gives off very little energy</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h4>Willingness to Connect (Before the Date)</h4>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="willingness5" name="willingness" value="5" {{ optional($feedback)->willingness == 5 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="willingness5">Excellent: Almost immediate responses, shows great willingness</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="willingness4" name="willingness" value="4" {{ optional($feedback)->willingness == 4 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="willingness4">High: Responds quickly, shows prior interest</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="willingness3" name="willingness" value="3" {{ optional($feedback)->willingness == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="willingness3">Adequate: Responds within reasonable time frames</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="willingness2" name="willingness" value="2" {{ optional($feedback)->willingness == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="willingness2">Low: Frequent delays, little effort to connect</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="willingness1" name="willingness" value="1" {{ optional($feedback)->willingness == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="willingness1">Very low: Very delayed responses</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h4>@lang('messages.feedback-serious-relationship-question')</h4>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="serious_relationship1" name="serious_relationship" value="Yes" {{ optional($feedback)->serious_relationship == "Yes" ? 'checked' : '' }}>
                                    <label class="form-check-label" for="serious_relationship1">@lang('messages.btn-yes')</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="serious_relationship2" name="serious_relationship" value="No" {{ optional($feedback)->serious_relationship == "No" ? 'checked' : '' }}>
                                    <label class="form-check-label" for="serious_relationship2">@lang('messages.btn-no')</label>
                                </div>
                                
                            </div>

                            <div class="mb-3" id="not_connect_box">
                                <h4>@lang('messages.feedback-serious-dating-question')</h4>
                                <textarea class="form-control" id="not_connect1" name="not_connect" >{{optional($feedback)->not_connect}}</textarea>
                                <small id="not_connect_counter1" class="form-text text-muted">0 / 150</small>
                                    <small id="not_connect_error1" class="form-text text-danger" style="display: none;">Character limit exceeded!</small>
                            </div>

                            <div class="mb-3" id="connect_person_box">
                                <h4>@lang('messages.feedback-connect-person-question')</h4>
                                <textarea class="form-control" id="connect_person1" name="connect_person" >{{optional($feedback)->connect_person}}</textarea> 
                                <small id="connect_person_counter1" class="form-text text-muted">0 / 150</small>
                                <small id="connect_person_error1" class="form-text text-danger" style="display: none;">Character limit exceeded!</small>  
                            </div>

                            <div class="mb-3" id="not_connect_box1">
                                <h4>@lang('messages.feedback-compliment-question')<br>
                                <span style="font-size: 12px;">(@lang('messages.feedback-compliment-Note'))</span></h4>
                                <textarea class="form-control" id="compliment1" name="compliment">{{optional($feedback)->compliment}}</textarea>
                                <small id="compliment_counter1" class="form-text text-muted">0 / 150</small>
                                    <small id="compliment_error1" class="form-text text-danger" style="display: none;">Character limit exceeded!</small>
                            </div>
                            
                            <div class="text-left">
                                <button type="submit" class="btn btn-danger btn-lg">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
   </main>
</div>
<script>
$(document).ready(function () {
    $('#reviewFeedback').on('submit', function (e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Feedback Reviewed successfully',
                    }); 
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.message,
                    });
                }
            },
            error: function (xhr, status, error) {
                // Handle the error response
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.',
                });
            }
        });
    });
    toggleFeedbackFields();
    $('input[name="serious_relationship"]').on('change', toggleFeedbackFields);
});
</script>
<script>
    function toggleFeedbackFields() {
       
        const selected = $('input[name="serious_relationship"]:checked').val();
        
        if (selected === "Yes") {
            $('#not_connect_box').hide();
            $('#not_connect_box1').hide();
            $('#connect_person_box').show();
        } else if (selected === "No") {
            $('#not_connect_box').show();
            $('#not_connect_box1').show();
            $('#connect_person_box').hide();
        } else {
            $('#not_connect_box').show();
            $('#not_connect_box1').show();
            $('#connect_person_box').show();
        }
    }
</script>

@endsection
