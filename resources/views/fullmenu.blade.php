@extends('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>

    body{

      background: url('{{ asset("pictures/welcome_background.png") }}') no-repeat center center;

      background-size: cover;

      height: auto;

      color: #000;

   }

   .menu-page {

    background: #000000b3; 

    border: 3px solid #ffffffd9;

   }

    .menu-page a {

        display: grid;

        text-align: center;

        justify-items: center;

        padding: 54px 0px;

        font-size: 35px;

        font-family: "AvenirNext", sans-serif;

        color: #adadad;

    }

   .menu-page a img 

   {

      width: 65px;

    height: 65px;

   }

   

   main

   {

      position: relative;

      width: 100%;

      height: 100%;

      /* background: url('{{ asset("pictures/welcome_background.png") }}') no-repeat center center;

      background-size: cover; */

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



   @media (max-width : 786px)

   {

        .menu-page {

            margin: 10% 0%;

        }

      .footer-position-bottom{

         position:static;

         bottom:0px;

      } 

      .menu-page a 

      {

        padding: 25px 0px;

      } 

     

   }

   @media (min-width : 787px){

        .footer-position-bottom{

            position:fixed;

            bottom:0px;

        }

        .menu-page {

            margin: 3% 30%;

        }

   }

   .menu-cusmtom-p{

        font-size: 14px;

        line-height: 0;

        margin-bottom: 0rem !important;

   }



   .quote 

   {

      text-align: center;

      color: white;

   }


   .quote h2 {

      margin: 0;

      font-weight: 300;

   }



   .quote p {

      margin: 0;

      font-size: 0.9rem;

      opacity: 0.8;

   }

   .footer {

         

         text-align: center;

         color: white;

         font-weight: bold;

         letter-spacing: 2px;

      }

      .modal-backdrop {

            height: unset !important;

        }

    .menu-cusmtom-p {

        line-height: 0.9 !important;

    }

</style>



<div class="container" style="margin-bottom: 3rem;">

    <div class="row">

        <div class="col-md-12">

         

        <div class="justify-content-center ">

        @php

            $quote = \App\Models\Quote::where('is_active', true)->inRandomOrder()->first();

        @endphp



        @if($quote)

            <div class="col-md-12 quote mt-5">

                <h2>“{{ $quote->text }}”</h2>

                <p>- {{ $quote->author ?? 'Anonymous' }}</p>

            </div>

        @endif

         

        <div class="row menu-page">

         

            <div class="col-6 ">

            <a href="#" data-bs-toggle="modal" data-bs-target="#myModal" class="nav-link text-capitalize affinity-1">

                <img src="{{ url('/public/pictures/Affinity Icon.png') }}" alt="" class="logo-bg" width="30">

                @lang('messages.menu-affinity')

                <p class="menu-cusmtom-p">@lang('messages.menu-affinity-p')</p>

            </a>

            </div>

            <div class="col-6" onclick="loadNotifications({{getMatchProfile()}})">

                <a class="nav-link position-relative chat-1" href="#" data-bs-toggle="modal" data-bs-target="#myModalNews">   

                    <img src="{{ url('/public/pictures/News Icon.png') }}"  alt="" class="logo-bg" width="30" >

                    @lang('messages.menu-header-news')

                    <p class="menu-cusmtom-p">@lang('messages.menu-header-news-p')</p>

                </a>

            </div>



            <div class="col-6">

            <a class="nav-link position-relative chat-1" href="javascript:void(0);" onclick="ChatOpen();">

                <img src="https://datingapp.ciws.in/public/pictures/Chat Icon.png" alt="" class="logo-bg" width="30">

                @lang('messages.menu-header-chat')

                <p class="menu-cusmtom-p">@lang('messages.menu-header-chat-p')</p>

            </a>

            </div>

            <div class="col-6">

            <a class="nav-link text-capitalize status-1" href="#" data-bs-toggle="modal" data-bs-target="#myModalStatus">

                <img src="{{ url('/public/pictures/Status Icon.png') }}" alt="" class="logo-bg" width="30">

                @lang('messages.menu-header-status')

                <p class="menu-cusmtom-p">@lang('messages.menu-header-status-p')</p>

            </a>

            </div>

            

        </div>

        <div class="col-md-12 footer mb-5">

         <img src='{{ asset("pictures/1._First_Page-removebg-preview.png") }}' width="300">

        </div>

        </div>

        

        </div>

        </div>

</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" style="margin-top: 20%;">

    <div class="modal-content">

        <div class="modal-body">

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

                    <a class="dropdown-item" href="javascript:;" onclick="masteringResponseMain(1,{{$user->id}},this)" ><i class="fa-solid fa-user font-size-custom"></i>@lang('messages.submenu-decline-affinity-master')</a>

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

    </div>

  </div>

</div>



<div class="modal fade" id="myModalNews" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-md" style="margin-top: 15%;">

    <div class="modal-content">

        <div class="modal-header">

            <h5 class="modal-title" id="myModalLabel">@lang('messages.menu-notifications') <b class="notificationcount"></b></h5>

            <span class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom" title="Tümü okundu."><i class="fa fa-dot-circle-o"></i></span>

        </div>

        <div class="modal-body">

            <ul class="notify-drop menu-dropdown-news px-0" id="newsDropdownMenu">

                <div class="drop-content" style="overflow-y: auto;height: 300px;">

                </div>

            </ul>  

        </div>

    </div>

  </div>

</div>



<div class="modal fade" id="myModalStatus" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-md" style="margin-top: 15%;">

    <div class="modal-content">

        <div class="modal-body">

            <div class="notify-drop dropdown-menu-right pt-0 pb-3 menu-dropdown-status" aria-labelledby="navbarDropdown" id="statusDropdownMenu">

                <div class="row m-0" id="myProfileStatus2"></div>

            </div>              

        </div>

    </div>

  </div>

</div>

<script>

    function toggleAffinityDropdown() {

        const menu = document.getElementById('affinityDropdownMenu');

        menu.classList.toggle('show');

    }

    function toggleNewsDropdown() {

        const menu2 = document.getElementById('newsDropdownMenu');

        menu2.classList.toggle('show');

    }

    function toggleStatusDropdown() {

        const menu3 = document.getElementById('statusDropdownMenu');

        menu3.classList.toggle('show');

    }

</script>

@endsection

