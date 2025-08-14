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

            body::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                /* background: url('{{url('public/img/tinder_banner-view.jpg')}}') no-repeat center center fixed; */
                background-size: cover;
                opacity: 0.9;
                z-index: -1;
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
                width: 100%;
                height: 150px;
                display: block;
                object-fit: cover;
                position: relative;
                border-top-right-radius: 5px;
                border-top-left-radius: 5px;
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
                border: 8px solid #fff;
                background-color: rgba(255, 255, 255, .35);
            }
            .user-data {
                padding: 0px 0 0;
                position: relative;
                text-align: center;
                margin: 0 17.5px 35px;
                background-color: var(--yzfy-card-bg-color);
                background: #fdfdfd;
            }
            .item-avatar {
                margin: -55px auto 20px;
                margin-bottom: 12px;
            }
            .item-fullname {
                color: #000;
                display: block;
                font-size: 16px;
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
                padding: 0 25px;
                margin-bottom: 25px;
                display:inline-flex;
            }
            .item-user-statistics .item-data-item:nth-child(1) span {
                background-color: #4fc8ff;
            }
            .item-user-statistics .item-data-item:nth-child(3) span {
                background-color: #42a16af2;
            }
            .item-user-statistics .item-data-item:nth-child(5) span {
                background-color: #e3342f;
            }
            .item-user-statistics .item-data-item:nth-child(4) span {
                background-color: #39e9d9;
            }
            .item-data-item span {
                color: #fff;
                width: 35px;
                margin: 5px;
                height: 35px;
                display: block;
                font-size: 20px;
                line-height: 35px;
                text-align: center;
                background-color: #eee;
                border-radius: 8px;
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
            .rotate-left-down {
                transform: rotate(180deg);
                display: inline-block;
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
            #filter-form input, #filter-form select 
            {
            height: 55px;
            border-radius: 9px;
            font-size: 16px;
            border: 2px solid #d3d3d3;
            }

            #filter-form .btn {
            padding: 10px 16px;
            font-size: 19px;
            }
                @media (max-width: 786px) 
                {
                    #filterbox 
                    {
                        display: inherit !important;   
                    }
                    .item-user-statistics-head 
                    {
                        left: 0%;
                    }
                    
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
                            <h1 class="youzify-sdescription">Find a Date!</h1>
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
    
    <nav id="item-profile-navmenu" class="item-navbar-inline-icons fadeIn full-visible" data-effect="fadeIn"><div class="item-inner-content shadow">
        <div class="col-sm-12 col-md-12 col-lg-12 shadow" style="padding: 1rem 1rem;">
            <form id="filter-form" method="GET">
                <div class="d-flex justify-content-between" id="filterbox" style="width: 100%;">
                
                <input type="hidden" name="form_which_countries" id="form_which_countries" value="{{ auth()->user()->form_which_countries }}">
                    <div class="col-sm-2 col-md-2 col-lg-2 flex-column mx-2">
                        <label for="interested_min_age_range" class="form-label fontStyle">@lang('messages.profile_18'):</label>
                        <div class="d-flex gap-3">
                        <input type="number" name="interested_min_age_range" id="mininterested_min_age_range_age" 
                            class="form-control w-50 mx-1" 
                            placeholder="Min age" 
                            value="{{ request('interested_min_age_range', auth()->user()->interested_min_age_range) }}">
                            
                        <input type="number" name="interested_max_age_range" id="interested_max_age_range" 
                            class="form-control w-50 mx-1" 
                            placeholder="Max age" 
                            value="{{ request('interested_max_age_range', auth()->user()->interested_max_age_range)}}">
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2 flex-column mx-2">
                        <label for="interested_in" class="form-label fontStyle">@lang('messages.profile_15'):</label>
                        <select name="interested_in" id="interested_in" class="form-control">
                            <option value="">All</option>
                            <option value="Male" {{ request('interested_in', auth()->user()->interested_in) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('interested_in', auth()->user()->interested_in) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="LGBTIQ+" {{ request('interested_in', auth()->user()->interested_in) == 'LGBTIQ+' ? 'selected' : '' }}>LGBTIQ+</option>
                        </select>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2  flex-column mx-2">
                        <label for="married_status" class="form-label fontStyle">@lang('messages.married_status')</label>
                        <select class="form-control" id="married_status" name="married_status">
                            <option value="">All</option>
                            <option value="single" {{ request('married_status', auth()->user()->married_status) == 'single' ? 'selected' : '' }}>Single</option>
                            <option value="divorce" {{ request('married_status', auth()->user()->married_status) == 'divorce' ? 'selected' : '' }}>Divorce</option>
                        </select>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2  flex-column mx-2">
                        <label for="working_status" class="form-label fontStyle">@lang('messages.working_status')</label>
                        <select class="form-control" id="working_status" name="working_status">
                            <option value="">All</option>
                            <option value="working" {{ request('working_status', auth()->user()->working_status) == 'working' ? 'selected' : '' }}>Working</option>
                            <option value="not-working" {{ request('working_status', auth()->user()->working_status) == 'not-working' ? 'selected' : '' }}>Not-working</option>
                        </select>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2  flex-column mx-2">
                        <label for="search" class="form-label fontStyle">Search:</label>
                        <input type="text" name="search" id="search" 
                            class="form-control" 
                            placeholder="@lang('messages.showall_04')" 
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-sm-1 col-md-1 col-lg-1  flex-column mx-2">
                        <label for="min_age" class="form-label"> &nbsp;</label>
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-danger mx-1 fontStyle"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                            <a href="{{url('/show-all')}}" class="btn btn-secondary fontStyle"><i class="fa-solid fa-arrows-rotate"></i></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card m bg-transparent border-0">
                    <div class="card-body bg-transparent"> 
                        <div class="col-12 my-4 p-10 all-member d-flex shadow" style="padding: 1.25rem;background: #fdfdfd;">
                            <span class="py-2 px-3 fontStyle" style="background: #fdfdfd;">Invitation Profile : </span>
                        </div>

                        <div class="col-12 m-0 p-0">
                            <div class="row" id="Invitation-user-list">
                               
                            </div>
                        </div>
                        <div class="col-12 my-4 p-10 all-member d-flex shadow" style="padding: 1.25rem;background: #fdfdfd;">
                            <span class="py-2 px-3 fontStyle" style="background: #fdfdfd;">All Members : </span>
                            <p class="py-2 text-white text-center px-2 fontStyle" style="width: 3rem;" id="member-count">0</p>
                        </div>

                        <div class="col-12 m-0 p-0">
                            <div class="row" id="user-list">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Submit Like Action
    function submitLikeForm(event, userId) {
        event.preventDefault(); // Prevent default action (e.g., form submission)
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to send invitation to this profile?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#38c172',
            cancelButtonColor: '#e3342f',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, send the like action via Ajax
                $.ajax({
                    url: '/like-action-url', // Your backend URL for liking the profile
                    type: 'POST', // Change the method to PUT
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
                        liked_user_id: userId, // User ID to be liked
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Liked!',
                                'Invitation has been successfully sent to this profile.',
                                'success'
                            );
                            getresult();
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was a problem to send invitation',
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
                    'The send invitation action is cancelled.',
                    'error'
                );
            }
        });
    }

    // Submit Dislike Action
    function submitDislikeForm(event, userId) {
        event.preventDefault(); // Prevent default action (e.g., form submission)
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to reject invitation to this profile?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#38c172',
            cancelButtonColor: '#e3342f',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, send the dislike action via Ajax
                $.ajax({
                    url: '/dislike-action-url', // Your backend URL for disliking the profile
                    type: 'POST', // Change the method to PUT
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
                        disliked_user_id: userId, // User ID to be disliked
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Disliked!',
                                'You have rejected invitation to this profile.',
                                'success'
                            );
                            getresult();
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was a problem to reject invitation',
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
                    'The rejected invitation action is cancelled.',
                    'error'
                );
            }
        });
    }


    // Submit Like Action
    function acceptInvite(event, userId) {
        event.preventDefault(); // Prevent default action (e.g., form submission)
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to Accept the invitation from this profile?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#38c172',
            cancelButtonColor: '#e3342f',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, send the like action via Ajax
                $.ajax({
                    url: '/accept-action-url', // Your backend URL for liking the profile
                    type: 'POST', // Change the method to PUT
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
                        accept_user_id: userId, // User ID to be liked
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Liked!',
                                'You have Accepted the invitation from this profile.',
                                'success'
                            );
                            getresult();
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was a problem accepting invitation from this profile.',
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
                    'The accept invitation action is cancelled.',
                    'error'
                );
            }
        });
    }

    // Submit Dislike Action
    function rejectInvite(event, userId) {
        event.preventDefault(); // Prevent default action (e.g., form submission)
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to Reject invitation from this profile?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#38c172',
            cancelButtonColor: '#e3342f',
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
                                'You have rejected invitation from this profile.',
                                'success'
                            );
                            getresult();
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
                    'The reject invitation action is cancelled.',
                    'error'
                );
            }
        });
    }

    function formatDate(dateString) {
        if (!dateString) {
            return ""; 
        }
        const months = [
            "Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = months[date.getMonth()];
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
    }

    function getresult(){
        $.ajax({
            url: "{{ route('getMatchResult') }}",
            method: "GET",
            data: $('#filter-form').serialize(),
            success: function(response) {
                
                $('#user-list').empty();
                $('#member-count').text(response.users.length);

                

                $.each(response.users, function(index, user) {

                    let imagePath = user.profile_picture ? `{{ asset('storage/') }}/` + user.profile_picture : user.avatar ? user.avatar : `{{ asset('public/pictures/') }}/` + user.sex + '.png';
                    let coverImagePath = user.cover_picture ? `{{ asset('storage/') }}/` + user.cover_picture : `{{ asset('public/img/imresizer-1735553880961.jpg') }}`;
                    const userProfileRoute = "{{ route('users.show-user', ':id') }}";
                    const likeUserRoute = "{{ route('users.like-user', ':id') }}";

                    let profileUrl = userProfileRoute.replace(':id', user.id);
                    let likeActionUrl = likeUserRoute.replace(':id', user.id);
                    
                    let userHtml = '';
                    let invitationUserHtml = '';

                    if (!response.likedUserIDs.includes(user.id)){
                         userHtml += `
                        <div class="col-md-4 col-sm-4 col-lg-4 mb-0 ">
                            <div class="user-data shadow" style="border-top-right-radius: 5px;border-top-left-radius: 5px;">
                                <div class="banner-cover">
                                    <img src="${coverImagePath}" class="" style="height: 150px;width: 100%;border-top-right-radius: 5px;border-top-left-radius: 5px; object-fit: cover;" alt="${user.name} ${user.last_name}"/>
                                </div>
                                <div class="item-avatar">
                                    <a href="">
                                        <img loading="lazy" src="${imagePath}" class="avatar user-295-avatar avatar-100 photo lazyloaded" width="100" height="100" alt="Profile picture of Raymondfip">
                                    </a>
                                </div>
                                <div class="item">
                                    <div class="item-title">
                                        <a class="item-fullname" href="">${user.name} ${user.last_name} ${user.like_to_be_called ? `(${user.like_to_be_called})` : ''}</a>
                                    </div>
                                    <div class="item-meta">
                                        <span class="item-meta-item"><strong>Date of Birth</strong>: ${formatDate(user.birthday)}</span>					
                                    </div>
                                    <div class="item-meta">
                                        <span class="item-meta-item"><strong>Interested In</strong>: ${user.interested_in}</span>					
                                    </div>
                                    <div class="item-meta">
                                        <span class="item-meta-item"><strong>Location</strong>: ${user.location}</span>					
                                    </div>
                                </div>`;
                        if (response.likedUserIDs.includes(user.id) && !response.followUserIDs.includes(user.id)) {
                            userHtml += `
                                <div class="item-user-statistics">
                                    <a href="${profileUrl}" class="item-data-item item-data-posts" data-item-tooltip="0 Posts">
                                        <span class="dashicons dashicons-edit"><i class="fa fa-eye font-sm" aria-hidden="true"></i></span>
                                    </a>
                                    <a href="#" class="item-data-item item-data-comments" data-item-tooltip="0 Comments" onclick="acceptInvite(event, ${user.id})">
                                        <span class="dashicons dashicons-format-status bg-success" title="Accept Invitation" style="width: 150px; font-size: 14px; font-weight: bold;">ACCEPT INVITATION</span>
                                    </a>
                                    <a href="#" class="item-data-item item-data-vues" data-item-tooltip="1 View" onclick="rejectInvite(event, ${user.id})">
                                        <span class="dashicons dashicons-welcome-view-site bg-danger" title="Reject Invitation" style="width: 150px; font-size: 14px; font-weight: bold;">REJECT PROFILE</span>
                                    </a>
                                </div>
                                <div class="clear"></div>
                            `;
                        } else if (!response.likedUserIDs.includes(user.id) && response.followUserIDs.includes(user.id)) {
                            userHtml += `
                                <div class="item-user-statistics">
                                    <a href="${profileUrl}" class="item-data-item item-data-posts" data-item-tooltip="0 Posts">
                                        <span class="dashicons dashicons-edit"><i class="fa fa-eye font-sm" aria-hidden="true"></i></span>
                                    </a>
                                    <a href="#" class="item-data-item item-data-comments" data-item-tooltip="0 Comments">
                                        <span class="dashicons dashicons-format-status bg-success" title="Accept Invitation" style="width: 150px; font-size: 16px; font-weight: bold;">INVITATION SENT</span>
                                    </a>
                                    <a href="#" class="item-data-item item-data-vues" data-item-tooltip="1 View" onclick="rejectInvite(event, ${user.id})">
                                        <span class="dashicons dashicons-welcome-view-site bg-danger" title="Reject Invitation" style="width: 150px; font-size: 16px; font-weight: bold;">REJECT PROFILE</span>
                                    </a>
                                </div>
                                <div class="clear"></div>
                            `;
                        } else if (response.likedUserIDs.includes(user.id) && response.followUserIDs.includes(user.id)) {
                            userHtml += `
                                <div class="item-user-statistics">
                                    <a href="${profileUrl}" class="item-data-item item-data-posts" data-item-tooltip="0 Posts">
                                        <span class="dashicons dashicons-edit"><i class="fa fa-eye font-sm" aria-hidden="true"></i></span>
                                    </a>
                                    <a href="#" class="item-data-item item-data-comments" data-item-tooltip="0 Comments">
                                        <span class="dashicons dashicons-format-status bg-success" title="Matched Profile" style="width: 150px; font-size: 16px; font-weight: bold;">Matched Profile</span>
                                    </a>
                                    <a href="#" class="item-data-item item-data-vues" data-item-tooltip="1 View" onclick="rejectInvite(event, ${user.id})">
                                        <span class="dashicons dashicons-welcome-view-site bg-danger" title="Reject Invitation" style="width: 150px; font-size: 16px; font-weight: bold;">Reject Invitation</span>
                                    </a>
                                </div>
                                <div class="clear"></div>
                            `;
                        } else {
                            userHtml += `
                                <div class="item-user-statistics">
                                    <a href="${profileUrl}" class="item-data-item item-data-posts" data-item-tooltip="0 Posts">
                                        <span class="dashicons dashicons-edit"><i class="fa fa-eye font-sm" aria-hidden="true"></i></span>
                                    </a>
                                    <a href="#" class="item-data-item item-data-comments" data-item-tooltip="0 Comments" onclick="submitLikeForm(event, ${user.id})">
                                        <span class="dashicons dashicons-format-status bg-success" title="SEND INVITATION" style="width: 150px; font-size: 14px; font-weight: bold;">SEND INVITATION</span>
                                    </a>
                                    <a href="#" class="item-data-item item-data-vues" data-item-tooltip="1 View" onclick="submitDislikeForm(event, ${user.id})">
                                        <span class="dashicons dashicons-welcome-view-site bg-danger" title="REJECT PROFILE" style="width: 150px; font-size: 14px; font-weight: bold;">REJECT PROFILE</span>
                                    </a>
                                </div>
                                <div class="clear"></div>
                            `;
                        }
                    }
                    if (response.likedUserIDs.includes(user.id)){
                        invitationUserHtml += `
                        <div class="col-md-4 col-sm-4 col-lg-4 mb-0 ">
                            <div class="user-data shadow" style="border-top-right-radius: 5px;border-top-left-radius: 5px;">
                                <div class="banner-cover">
                                    <img src="${coverImagePath}" class="" style="height: 150px;width: 100%;border-top-right-radius: 5px;border-top-left-radius: 5px; object-fit: cover;" alt="${user.name} ${user.last_name}"/>
                                </div>
                                <div class="item-avatar">
                                    <a href="">
                                        <img loading="lazy" src="${imagePath}" class="avatar user-295-avatar avatar-100 photo lazyloaded" width="100" height="100" alt="Profile picture of Raymondfip">
                                    </a>
                                </div>
                                <div class="item">
                                    <div class="item-title">
                                        <a class="item-fullname" href="">${user.name} ${user.last_name} ${user.like_to_be_called ? `(${user.like_to_be_called})` : ''}</a>
                                    </div>
                                    <div class="item-meta">
                                        <span class="item-meta-item"><strong>Date of Birth</strong>: ${formatDate(user.birthday)}</span>					
                                    </div>
                                    <div class="item-meta">
                                        <span class="item-meta-item"><strong>Interested In</strong>: ${user.interested_in}</span>					
                                    </div>
                                    <div class="item-meta">
                                        <span class="item-meta-item"><strong>Location</strong>: ${user.location}</span>					
                                    </div>
                                </div>`;
                        if (response.likedUserIDs.includes(user.id)) {
                            invitationUserHtml += `
                                <div class="item-user-statistics">
                                    <a href="${profileUrl}" class="item-data-item item-data-posts" data-item-tooltip="0 Posts">
                                        <span class="dashicons dashicons-edit"><i class="fa fa-eye font-sm" aria-hidden="true"></i></span>
                                    </a>
                                    <a href="#" class="item-data-item item-data-comments" data-item-tooltip="0 Comments" onclick="acceptInvite(event, ${user.id})">
                                        <span class="dashicons dashicons-format-status bg-success" title="Accept Invitation" style="width: 150px; font-size: 14px; font-weight: bold;">ACCEPT INVITATION</span>
                                    </a>
                                    <a href="#" class="item-data-item item-data-vues" data-item-tooltip="1 View" onclick="rejectInvite(event, ${user.id})">
                                        <span class="dashicons dashicons-welcome-view-site bg-danger" title="Reject Invitation" style="width: 150px; font-size: 14px; font-weight: bold;">REJECT PROFILE</span>
                                    </a>
                                </div>
                                <div class="clear"></div>
                            `;
                        } 
                    }

                    $('#Invitation-user-list').html(invitationUserHtml);
                    $('#user-list').append(userHtml);
                });
            }
        });
    }

    $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        getresult();
    });

    $('#filter-form').on('change', 'input, select, textarea', function() 
    {
    getresult();
    });

    getresult();

    
</script>
@endpush
