@extends('layouts.app')

<style>

    /* body::before {

        background: url('{{ url('public/pictures/profile-frame-1.png') }}') no-repeat center center !important;

        background-size: cover !important; 

    } */

     main

    {

        position: relative;

        width: 100%;

        /* height: 100%; */

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

</style>

@section('content')

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

    <style>



        .pricing-price {

            /* border-bottom: 1px solid #f6f6f6; */

            padding: 5px 17.5pxpx;

        }

        .list-unstyled {

            padding-left: 0;

            list-style: none;

        }

        dl, ol, ul {

            margin-top: 0;

            margin-bottom: 1rem;

        }

        



        .pricing-price strong {

            color: #fff;

            font-size: 35px;

            -webkit-transition: all 0.3s ease-in-out;

            transition: all 0.3s ease-in-out;

            line-height: 50px;

            font-weight: 500;

        }

        .list-unstyled {

            padding-left: 0;

            list-style: none;

        }



        dl, ol, ul {

            margin-top: 0;

            margin-bottom: 0.5rem;

        }

        ol, ul {

            padding-left: 2rem;

        }

        *, ::after, ::before {

            box-sizing: border-box;

        }

        user agent stylesheet

        ul {

            display: block;

            list-style-type: disc;

            margin-block-start: 1em;

            margin-block-end: 1em;

            margin-inline-start: 0px;

            margin-inline-end: 0px;

            padding-inline-start: 40px;

            unicode-bidi: isolate;

        }

        .text-center {

            text-align: center !important;

        }

        .g-0, .gy-0 {

            --bs-gutter-y: 0;

        }

        .g-0, .gx-0 {

            --bs-gutter-x: 0;

        }

        .btn-outline:hover {

            background: #ff8a00;

            border-color: #ff8a00;

            color: #ffffff;

        }

        .btn.btn-lg {

            padding: 14px 30px;

        }

        .btn:hover {

            -webkit-box-shadow: none;

            box-shadow: none;

            outline: none;

        }

        .btn:hover {

            color: #212529;

        }

        a:hover {

            color: #ff8a00;

            text-decoration: none !important;

        }

        a:hover {

            color: #0a58ca;

        }

        .btn-outline {

            border: 1px solid #eeeeee;

        }

        .btn {

            font-size: 14px;

            font-weight: 600;

            padding: 12px 30px;

            border-radius: 3px;

        }

        .pricing-list li:nth-child(even) {

            background: #f6f6f6;

        }

        .pricing-list li {

            border-bottom: 1px solid #f6f6f6;

            padding: 5px;

            font-size: 12px;

        }

        .btn-pay{

            border-radius:2rem;

        }

        .pricing-container {

            display: flex;

            flex-wrap: wrap;

        }



        .pricing-list {

            flex: 1 1 100%; /* Adjust width for smaller screens */

            /* min-width: 200px; Prevent boxes from getting too small */

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            height: 100%; /* Ensures all boxes are the same height */

        }



        .pricing-plan {

            

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            height: 100%; /* Ensures all boxes are the same height */

        }

        .logo {

        font-size: 32px;

        font-weight: bold;

        }



        .sub-logo {

        font-size: 20px;

        color: #00ffff;

        }

        .plan-footer tr td{
            text-align:center;
        }

        .plan-footer tr td p{

            text-align:left;

            margin-bottom:0px !important;

            margin-left: 2rem;

           font-size: 15px;

        }

        .footer-display{

            display:none !important;

        }



        .tag {

            position: absolute;

            top: -15px;

            right: 35%;

            background-color: #00c8ff;

            color: white;

            padding: 3px 9px;

            font-size: 13px;

            font-weight: bold;

        }



        .tag.red {

            background-color: #ff3b6b;

        }
        .table-323
        {
            width: 70%;
            color: white;
        }
        .plans-show{
            position: absolute;
            top: 27%;
            right: 23%;
            color: #fff;
            background: #000;
            padding: 23px;
            width: 34%;
            text-align: center;
        }
        @media(max-width :786px)
        {
            main
            {
                height: auto;
            }
            .table-323
            {
                width: 100%;
            
            }
            .plan-footer tr td p
            {
                margin-left:0px;
                margin-bottom: 10px !important;

            }
            .table-323 img
            {
               max-height: 30px !important; 
               margin-right: 10px;
            }
                  .box-23456 {
        flex: 0 0 41%;
        max-width: 45.6666666667%;
    }
                .plans-show {
        
        position: absolute;
        top: 65%;
        right: 8%;
        color: #fff;
        background: #000;
        padding: 30px;
        width: 85%;
        text-align: center;
    
    }
        }
        @media(max-width :585px)
        {
              .box-23456 {
        flex: 0 0 41%;
        max-width: 45.6666666667%;
    }
                .plans-show {
        position: absolute;
        top: 65%;
        right: 2%;
        color: #fff;
        background: #000;
        padding: 30px;
        width: 96%;
        text-align: center;
    }

        }
        .plan-footer tr td {
            padding-bottom: 10px; 
        }
    </style>

    @if(session('error'))

        <script>

            Swal.fire({

                icon: 'error',

                title: 'Oops...',

                text: '{{ session('error') }}'

            });

        </script>

    @endif

    <div class="d-flex  justify-content-center" style="font-family: 'AvenirNext', sans-serif;">

        <div class="col-md-10">

            <div class="row justify-content-center m-3">

                <div class="pricing-container col-lg-12 col-md-12 col-sm-12">

                    <div class="col-lg-12 col-md-12 col-sm-12 text-center"><img src='{{ asset("pictures/LOGO H W.png") }}' width="300"></div>

                    <div class="col-lg-12 col-md-12 col-sm-12 text-center text-white h3" style="margin-top: -1rem;font-size: 28px;">@lang('messages.subscription_plan_0')</div>

                </div>
                @php
                    $boxShow = "hide";
                    $boxShowCount =0;
                    if(!checkAnySubscription()){
                        $boxShow = "show";
                        $boxShowCount =1;
                    }
                @endphp
                <div class="col-lg-12 col-md-12 col-sm-12  justify-content-center my-3">
                    <div class="row justify-content-center">
                    @foreach($plans as $key=>$plan)
                        @php
                            
                            if ($plan->duration == 6) {

                                $buttonText = __('messages.subscription_plan_2');

                                $textTag = '<div class="tag red">' . __('messages.subscription_plan_6') . ' 25%</div>';

                                $addclass='box-23456';

                            } elseif ($plan->duration == 4) {

                                $buttonText = __('messages.subscription_plan_3');

                                $textTag = '<div class="tag">' . __('messages.subscription_plan_7') . ' 20%</div>';
                                $addclass='box-23456';

                            } else {

                                $buttonText = __('messages.subscription_plan_4');

                                $textTag = '';
                                $addclass='';

                            }

                        @endphp

                        <div class="col-md-2 col-sm-12 col-xl-2 col-lg-2 mx-3 text-white mb-4 {{ $addclass }}" style="background-color: #2222227a; border: 2px solid #fff; position:relative;">

                            @if($textTag != '')
                                {!! $textTag !!}
                            @endif

                            <div class="text-center px-4 pb-4">

                                <div class="pricing-title py-3">

                                    <h2>{{ $plan->duration }} @lang('messages.subscription_plan_1')</h2>

                                </div>

                                @if($key ==0 && $boxShowCount == 1)
                                <div class="pricing-title" style="font-size: 12px;line-height: 0;">
                                    <p>@lang('messages.subscription_plan_1_1')</p>
                                    <p style="line-height: 1.2;">@lang('messages.subscription_plan_1_2')</p>
                                </div>
                                @endif

                                @php

                                    $days = $plan->duration * 30;

                                    $perDay = (int) ($plan->price / $days);;

                                @endphp



                                <div class="pricing-price text-white">

                                    <h4>${{ number_format($plan->price, 0, '', '.') }}</h4>

                                    <h6>${{ round(number_format($perDay, 0, '', '.'),3) }} @lang('messages.subscription_plan_5')</h6>

                                </div>

                                

                                <a href="{{ route('payment.paymentnow', ['id' => $plan->id]) }}"

                                class="btn p-0 mt-2 text-white px-4 py-1" style="background: #000;">

                                    {{ $buttonText }}

                                </a>

                            </div>

                        </div>

                    @endforeach
                    </div>
                    <div class="plans-show {{$boxShow}}">
                        <h6>@lang('messages.subscription_plan_8_0')</h6>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-white text-center">

                    <p>@lang('messages.subscription_plan_8').</p>

                </div>

                <div class="col-lg-9 col-md-9 col-sm-9 d-flex justify-content-center text-white text-center my-3">

                    <table class="plan-footer table-323">

                        <tr>

                            <td>

                                <img src="{{ asset('pictures/image49.png') }}" alt="TrueOne" style="max-height: 40px;">

                            </td>

                            <td>

                                <p>@lang('messages.subscription_plan_9').</p>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <img src="{{ asset('pictures/image4.png') }}" alt="Safe Circle" style="max-height: 40px;">

                            </td>

                            <td>

                                <p>@lang('messages.subscription_plan_10') .</p>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <img src="{{ asset('pictures/image19.png') }}" alt="Real Standards" style="max-height: 40px;">

                            </td>

                            <td>

                                <p>@lang('messages.subscription_plan_11').</p>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <img src="{{ asset('pictures/image26.png') }}" alt="Mastering Delivery" style="max-height: 40px;">

                            </td>

                            <td>

                                <p>@lang('messages.subscription_plan_12').</p>

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>



@endsection