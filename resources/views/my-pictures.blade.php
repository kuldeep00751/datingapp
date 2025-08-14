@extends('layouts.app')
@section('content')
<style>
   body {
   /* background: url('{{url('public/img/profile_users.jpg')}}'); */
   }
   .user-picture:hover {
   opacity: 0.7;
   cursor: pointer;
   }
   .modal {
   display: none;
   position: fixed;
   z-index: 1;
   padding-top: 100px;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
   overflow: auto;
   background-color: rgb(0, 0, 0);
   background-color: rgba(0, 0, 0, 0.9);
   }
   .modal-content {
   margin: auto;
   display: block;
   width: 80%;
   max-width: 700px;
   }
   #caption {
   margin: auto;
   display: block;
   width: 80%;
   max-width: 700px;
   text-align: center;
   color: #ccc;
   padding: 10px 0;
   height: 150px;
   }
   .modal-content, #caption {
   -webkit-animation-name: zoom;
   -webkit-animation-duration: 0.6s;
   animation-name: zoom;
   animation-duration: 0.6s;
   }
   @-webkit-keyframes zoom {
   from {
   -webkit-transform: scale(0)
   }
   to {
   -webkit-transform: scale(1)
   }
   }
   @keyframes zoom {
   from {
   transform: scale(0)
   }
   to {
   transform: scale(1)
   }
   }
   .close {
   position: absolute;
   top: 15px;
   right: 35px;
   color: #f1f1f1;
   font-size: 40px;
   font-weight: bold;
   transition: 0.3s;
   }
   .close:hover,
   .close:focus {
   color: #bbb;
   text-decoration: none;
   cursor: pointer;
   }
   .image-container {
   position: relative;
   overflow: hidden;
   }
   .image-container img {
   width: 100%;           
   height: 200px;         
   object-fit: fill;
   transition: transform 0.3s ease-in-out;
   }
   .zoom-icon {
   position: absolute;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   font-size: 2rem;
   color: white;
   opacity: 0;
   transition: opacity 0.3s ease-in-out;
   pointer-events: none; /* Prevents the icon from blocking clicks */
   }
   .image-container:hover {
   background-color: rgba(0, 0, 0, 0.55); /* Change background color on hover */
   }
   .image-container:hover .zoom-icon {
   opacity: 1; /* Show zoom icon on hover */
   }
   .image-container:hover img {
   opacity: 0.7; /* Optional: fade the image on hover */
   }
</style>
<style>
    .py-4{
        padding-top:0px !important;
        padding-bottom:0px !important;
    }
    .item-header-content {
        width: 100%;
        margin: 0 auto;
    }
    .item-user-profile-cover-img {
        height: 260px;
        width: 100%;
        object-fit: cover;
    }
    .item-inner-content{
        margin-left:185px;
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
        background-color: rgba(0, 0, 0, 0.7);
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
        z-index: 9;
        position: absolute;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        left:0px
    }
    .item-user-statistics-head {
        left:37%;
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
        font-size: 12.5px;
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
        color: #ed147d !important;
    }
    .item-navbar-item a i {
        margin: 0 10px 0 0;
        color: 14px;
        font-weight: 700;
    }
    .item-navbar-item.item-active-menu {
        border-color: #ed147d !important;
        border-bottom: 4px solid;
    }
</style>
<style>     
    .item-page-main-content {
        margin: auto;
        padding: 35px 0 0;
        max-width: 1170px;
        position: relative;
    }
    .item-right-sidebar-layout {
        grid-template-columns: calc(100% - 0px) 28%;
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
        border-bottom: 1px solid #f2f2f2;
    }
    .item-widget .item-widget-title {
        margin: 0;
        color: #858f94;
        font-size: 14px;
        font-weight: 400;
        line-height: 22px;
        padding: 15px 35px;
        letter-spacing: initial;
    }
    .item-wg-title-icon-bg .item-widget-title i {
        width: 35px;
        height: 35px;
        line-height: 35px;
        margin-right: 10px;
        text-align: center;
        background-color: #f2f2f2;
        color: #8b8b8b;
        border-radius: 100%;
    }
    .item-infos-content{
        padding: 35px 40px;
    }
    .item-infos-content .item-infos-item {
        padding-bottom: 15px;
        display:flex;
    }
    .item-infos-content .item-info-label {
        color: #939ba3;
        font-size: 14px;
        font-weight: 600;
        min-width: 160px;
    }
    .item-infos-content .item-info-data {
        text-align: left;
        line-height: 22px;
        vertical-align: top;
        width: calc(100% - 180px);
    }
    .item-user-img img {
        width: 120px;
        height: 120px;
        margin: 12px 35px;
    }
    .item-default-content{
        padding:35px;
    }
    .item-profile-sidebar .item-aboutme-container {
        text-align: center;
    }
    .item-aboutme-name {
        color: #858f94;
        font-size: 18px;
        font-weight: 400;
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
        background-color: #ed147d !important;
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
        background: url(https://qiupid.modeltheme.com/wp-content/plugins/youzify/includes/public/assets/images/pattern.svg), linear-gradient(to right, #E91E63, #673AB7);
    }
    .item-media-title{
        color: #fff;
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
        width: calc(15% - 0px);
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
       
</style>
<header id="item-profile-header" class="item-profile-header item-hdr-v1 item-header-overlay item-header-pattern  animated fadeIn full-visible" data-effect="fadeIn">
    <div class="item-header-cover">
        <img class="item-user-profile-cover-img lazyl" src="{{asset('public/img/banner-1.jpeg') }}" alt="" loading="lazy" data-src="">									
        <div class="item-cover-content">
            <div class="item-inner-content">
            
            <div class="item-user-statistics youzify-statistics-bg youzify-use-borders item-user-statistics-head">
                <ul class="w-100 text-center p-0">
                    <li>
                        
                        <div class="youzify-snumber" title=""></div>
                        <h1 class="youzify-sdescription">Gallery!</h1>
                        
                    </li>

                </ul>
            </div>
            </div>
        </div>
    </div>
    <div class="item-header-content">
        <div class="youzify-header-head">
        </div>
    </div>
</header>
<nav id="item-profile-navmenu" class="item-navbar-inline-icons fadeIn full-visible" data-effect="fadeIn"><div class="item-inner-content ">
    <div class="col-sm-12 col-md-12 col-lg-12 " style="padding: 1rem 1rem;">
        <form class="d-flex justify-content-end" method="post" action="{{ route('pictures.upload', $user) }}"enctype="multipart/form-data">
            @csrf
            @method('POST')
            <!-- Hidden File Input -->
            <input type="file" class="form-control d-none" id="files" name="files[]" accept="image/*" multiple  onchange="previewImage(event)">
            <!-- Custom Upload Button -->
            <p class="p-0 m-0">
                <i class="fas fa-plus" style="position: relative; top: 0px; left: 2.7rem; background: #2c7fc3; color: #fff; padding: 13px;"></i>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('files').click();" style="padding-left: 5rem;padding-right: 5rem;padding-top: 11px;">
                 Upload Images
                </button>
                <button type="submit" class="btn btn-danger py-2 px-5">Add</button>
            </p>
            
        </form>
    </div>
</nav>
<main class="item-page-main-content media-content">
    <div  class="item-right-sidebar-layout">
        <div class="grid-column">
            <div class="item-widget fadeIn" data-effect="fadeIn">
                <div class="item-widget-main-content">
                    <!-- <div class="item-media-head">
                        <h4 class="item-media-title p-3">
                            <i class="fas fa-photo-video fontview px-2 p-2 mx-2" style="font-size: 14px;"></i>Gallery					
                        </h4>
                    </div> -->
                    <div class="item-media-group-content">
                        <div class="item-media-items">
                            @foreach($pictures as $picture)
                                @if(substr( $picture->picture_location, 0, 4 ) === "http")
                                    <div data-item-id="92" class="item-media-item">
                                        <div class="item-media-item-img">
                                            <img loading="lazy" class=" ls-is-cached lazyloaded" src="{{$picture->picture_location}}">
                                            <div class="item-media-item-tools">
                                            <a href="{{$picture->picture_location()}}" data-lightbox="gallery" class="image-link"><i class="fas fa-search-plus item-media-post-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div data-item-id="92" class="item-media-item">
                                            <div class="item-media-item-img">
                                                <img loading="lazy" class=" ls-is-cached lazyloaded" src="{{$picture->getPicture()}}">
                                                <div class="item-media-item-tools">
                                                <a href="{{$picture->getPicture()}}" data-lightbox="gallery" class="image-link"><i class="fas fa-search-plus item-media-post-link"></i></a>
                                                </div>
                                            </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Lightbox2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet">
<!-- Lightbox2 JS -->
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js"></script>
<script>
   let modal = document.getElementById("myModal");
   let img = document.getElementsByClassName("myImg");
   let modalImg = document.getElementById("img01");
   let captionText = document.getElementById("caption");
   
   for (let i = 0; i < img.length; i++) {
       img[i].onclick = showCaption;
   }
   
   function showCaption() {
       modal.style.display = "block";
       modalImg.src = this.src;
       captionText.innerHTML = this.alt;
   }
   
   let span = document.getElementsByClassName("close")[0];
   span.onclick = function () {
       modal.style.display = "none";
   }
   
</script>
@endsection