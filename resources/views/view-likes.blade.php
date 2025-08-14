@extends('layouts.app')
@section('content')
    <head>
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body {
                position: relative;
                margin: 0;
                height: auto;
            }

            /* body::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url('{{url('public/img/tinder_banner-view.jpg')}}') no-repeat center center fixed;
                background-size: cover;
                opacity: 0.9;
                z-index: -1; */
            /* } */
            .item-navbar-item.item-active-menu a{
                color: #ed147d !important;
                
            }
            .backgroundGray{
                background:#dddddd;
            }
            .all-member p:last-child{
                background: #df314d;
                position: relative;
                margin-bottom: 0px;
                border-radius: 2px;
            }
            .all-member p:last-child:before {
                left: -10px;
                top: 50%;
                transform: translateY(-50%);
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 12.5px 21.7px 12.5px 0;
                border-color: transparent #df314d transparent transparent;
                position: absolute;
                content: "";
            }
            .w-40{

            }
            .fontStyle{
                font-weight:bold;
            }
            
            .banner-cover {
                display: block;
                object-fit: cover;
                position: relative;
                border-top-right-radius: 5px;
                border-top-left-radius: 5px;
                margin-bottom:1rem;
            }
            .item-avatar {
                margin: auto;
                width: 100px;
                height: 100px;
                display: block;
                position: relative;
            }
            .item-avatar:before{
                top: -3px;
                right: -3px;
                width: 6px;
                height: 6px;
                content: '';
                display: block;
                text-align: right;
                position: absolute;
            }
            .item-avatar img{
                -webkit-border-radius: 100%;
                -moz-border-radius: 100%;
                -ms-border-radius: 100%;
                -o-border-radius: 100%;
                border-radius: 100%;
                width: 100%;
                height: 100%;
                border: 8px solid transparent;
                background-color: rgba(255, 255, 255, .35);
            }
            .user-data {
                padding: 0px 0 0;
                position: relative;
                text-align: center;
                /* margin: 0 17.5px 35px; */
                background-color: var(--yzfy-card-bg-color);
                background: #fdfdfd;
            }
            .item-avatar {
                margin: -55px auto 20px;
                margin-bottom: 12px;
            }
            .item-fullname {
                color: #858f94;
                display: block;
                font-size: 14px;
                font-weight: 600;
                line-height: 18px;
                text-transform: capitalize;
            }
            .item a:active, .item a:focus, .item a:hover, .item a:visited {
                outline: 0;
                text-decoration: none;
            }
            .item-meta {
                margin-bottom: 10px;
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
                background-color: #4fc8ff;
            }
            .item-user-statistics .item-data-item:nth-child(2) span {
                background-color: #ffc107;
            }
            .item-user-statistics .item-data-item:nth-child(3) span {
                background-color: #975dfd;
            }
            .item-user-statistics .item-data-item:nth-child(4) span {
                background-color: #39e9d9;
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
            .col-xl, .col-xl-auto, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-lg, .col-lg-auto, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-md, .col-md-auto, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-sm, .col-sm-auto, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col, .col-auto, .col-12, .col-11, .col-10, .col-9, .col-8, .col-7, .col-6, .col-5, .col-4, .col-3, .col-2, .col-1 {
                position: relative;
                width: 100%;
                padding-right: 0px;
                padding-left: 0px;
            }
            .font-sm{
                font-size: 16px;
            }

            .nav-item-list {
                padding: 10px 20px;
                border: none;
                border-bottom: 1px solid #df314d;
            }
            .tab-nav .active {
                display: block;
                border: 1px solid #df314d;
                border-top-right-radius: 5px;
                border-top-left-radius: 5px;
                background: #df314d;
                color: #fff;
                font-weight: bold;
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
                left:0px;
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
                padding: 10px 40px;
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
            .item-page-main-content {
                margin: auto;
                padding: 35px 0 0;
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
                width: 180px;
                height: 180px;
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
                width: calc(33.33% - 6.66px);
                margin: 5px 10px 5px 0;
            }
            .item-media-widget .item-media-item {
                margin: 0;
                float: left;
                width: 33.33%;
                text-align: left;
                position: relative;
                border: 3px solid #fff;
            }
            .item-media-item .item-media-item-img img, .item-media-item-video video {
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
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
        </style>
    </head>
    <header id="item-profile-header" class="item-profile-header item-hdr-v1 item-header-overlay item-header-pattern  animated fadeIn full-visible" data-effect="fadeIn">
        <div class="item-header-cover">
            <img class="item-user-profile-cover-img lazyl" src="{{asset('public/img/banner-1.jpeg') }}" alt="" loading="lazy" data-src="">									
            <div class="item-cover-content">
                <div class="item-inner-content">
                
                <div class="item-user-statistics youzify-statistics-bg youzify-use-borders item-user-statistics-head">
                    <ul class="w-100 text-center p-0">
                        <li>
                            <div class="youzify-snumber" title=""></div>
                            <h1 class="youzify-sdescription">All Matches</h1>
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
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card m bg-transparent border-0">
                    <div class="card-body bg-transparent"> 
                        <div class="tab-content">
                            <div class="col-12 m-0 p-0" >
                                <div class="row" id="user-list">
                                    @if(count($matches) != 0)
                                        @foreach($matches as $match)
                                            @php
                                                if (substr($match->profile_picture, 0, 4) === "http") {
                                                    $profileMatch = $match->getURL();
                                                } else {
                                                    $profileMatch = $match->getPicture();
                                                }
                                            @endphp
                                        <div class="col-md-4 col-sm-4 col-lg-4 mb-0">
                                            <div class="user-data shadow-sm" style="border-top-right-radius: 5px;border-top-left-radius: 5px;">
                                                <div class="banner-cover">
                                                    <img 
                                                        src="{{$profileMatch}}" 
                                                        class="" 
                                                        style="width:100%; border-top-right-radius: 5px; border-top-left-radius: 5px;" 
                                                        alt="{{ $match->like_to_be_called }}" 
                                                    />
                                                    <img src="{{asset('silverbridge.png')}}" class="" style="width: 50%; float: right; position: absolute; bottom: 6px; right: 4px;" />
                                                    
                                                </div>
                                                <div class="item">
                                                    <div class="item-title">
                                                        <a class="item-fullname" href="">{{$match->like_to_be_called}}</a>
                                                    </div>
                                                    <div class="item-meta">
                                                        <span class="item-meta-item"><strong>Date of Birth</strong>:
                                                        {{ $match->birthday ? \Carbon\Carbon::parse($match->birthday)->age : '' }}  years
                                                        </span>						
                                                    </div>
                                                    <div class="item-meta">
                                                        <span class="item-meta-item"><strong>Interested in</strong>: {{$match->interested_in}}</span>					
                                                    </div>
                                                    <div class="item-meta">
                                                        <span class="item-meta-item"><strong>Location</strong>:{{$match->location}}</span>					
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="item-user-statistics">
                                                    <a href="{{ route('users.show-user', $match->id) }}" class="item-data-item item-data-posts" data-item-tooltip="0 Posts">
                                                    <span class="dashicons dashicons-edit"><i class="fa fa-eye font-sm" aria-hidden="true"></i></span>
                                                    </a>
                                                    <a href="{{ route('user.chat',$match->id)}}" class="item-data-item item-data-comments" data-item-tooltip="0 Comments">
                                                    <span class="dashicons dashicons-format-status"><i class="fa-solid fa-comment-dots font-sm"></i></span>
                                                    </a>

                                                    <a href="#" class="item-data-item item-data-comments" data-item-tooltip="0 Comments" onclick="acceptInvite(event, ${user.id})">
                                                        <span class="dashicons dashicons-format-status bg-success" title="Accept Invitation" style="width: 105px; font-size: 9px; font-weight: bold;">ACCEPT INVITATION</span>
                                                    </a>
                                                    <a href="javascript:;" class="item-data-item item-data-vues" data-item-tooltip="1 View" onclick="rejectInvite(event, {{$match->id}})">
                                                        <span class="dashicons dashicons-welcome-view-site bg-danger" title="Reject profile" style="width: 92px; font-size: 9px; font-weight: bold;">REJECT PROFILE</span>
                                                    </a>

                                                    <!-- <a href="#" class="item-data-item item-data-comments" data-item-tooltip="0 Comments">
                                                        <span class="dashicons dashicons-format-status bg-success" title="Accept Invitation" style="width: 105px; font-size: 9px; font-weight: bold;">ACCEPTED INVITATION</span>
                                                    </a>
                                                    <a href="javascript:;" class="item-data-item item-data-vues" data-item-tooltip="1 View">
                                                        <span class="dashicons dashicons-welcome-view-site bg-danger" title="Reject profile" style="width: 92px; font-size: 9px; font-weight: bold;">REJECTED PROFILE</span>
                                                    </a> -->

                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-12 col-sm-12 col-lg-12 mb-0">
                                            <div class="user-data shadow-sm p-4 m-3" style="background: #fdfdfd;">
                                                <h4>Sorry, no matches yet.. Be patient!</h4>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const navbarItems = document.querySelectorAll('.item-navbar-item');
        const tabContents = document.querySelectorAll('.tab-content-data');

        navbarItems.forEach(item => {
            item.addEventListener('click', () => {
                // Remove active class from all nav items
                navbarItems.forEach(nav => nav.classList.remove('item-active-menu'));

                // Remove active class from all tab contents
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to clicked nav item
                item.classList.add('item-active-menu');

                // Get target tab ID from data-target
                const targetId = item.getAttribute('data-target');
                const targetContent = document.getElementById(targetId);

                // Show the associated tab content
                if (targetContent) {
                    targetContent.classList.add('active');
                }
            });
        });

        // Submit Dislike Action
        function rejectInvite(event, userId) {
            event.preventDefault(); // Prevent default action (e.g., form submission)
            
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to Reject this profile?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, send the dislike action via Ajax
                    $.ajax({
                        url: '/reject-action-url', // Your backend URL for disliking the profile
                        type: 'POST', // Change the method to PUT
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
                            reject_user_id: userId, // User ID to be disliked
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Disliked!',
                                    'You have rejected this profile.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was a problem rejecting the profile.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong while processing your request.',
                                'error'
                            );
                        }
                    });
                } else {
                    // If cancelled, show message
                    Swal.fire(
                        'Cancelled',
                        'The reject action was cancelled.',
                        'error'
                    );
                }
            });
        }
    </script>
@endsection