@extends('layouts.app')

<style>
    .messenger{
        height: 80vh;
        max-height: 80vh;
        overflow: hidden;
    }
    .messenger-listView {
        overflow: hidden !important;
    }
    .messenger-messagingView{
        height: unset !important;
    }
    .messenger .messenger-listView{
        display:none;
    }
    .messenger-messagingView .m-body{
        min-height: 200px;
    }
    main
   {
      background: url('{{ asset('pictures/Background2.jpg') }}') no-repeat center center;
      background-size: cover;
      background-attachment: fixed;
   }
    @media (max-width: 680px) {
        .messenger-messagingView {
            position: unset  !important;
            top: 0;
            left: 0;
            height: 100%;
        }
    }
    @media (max-width: 768px) {
    .navbar-nav {
        display: block !important;
    }
}
</style>
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card m bg-transparent border-0">
                <div class="card-body bg-transparent" > 
                    @include('Chatify::layouts.headLinks')
                    <div>
                        <p>@lang('messages.chat_message_header_display')</p>
                    </div>
                    <div class="messenger">
                    {{-- ----------------------Users/Groups lists side---------------------- --}}
                        <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
                            {{-- Header and search bar --}}
                            <div class="m-header">
                                <nav>
                                    <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">MESSAGES</span> </a>
                                </nav>
                                {{-- Search input --}}
                                <input type="text" class="messenger-search" placeholder="Search" />
                                {{-- Tabs --}}
                                {{-- <div class="messenger-listView-tabs">
                                    <a href="#" class="active-tab" data-view="users">
                                        <span class="far fa-user"></span> Contacts</a>
                                </div> --}}
                            </div>
                            {{-- tabs and lists --}}
                            <div class="m-body contacts-container">
                            {{-- Lists [Users/Group] --}}
                            {{-- ---------------- [ User Tab ] ---------------- --}}
                            <div class="show messenger-tab users-tab app-scroll" data-view="users">
                                {{-- Favorites --}}
                                <div class="favorites-section">
                                    <p class="messenger-title"><span>Favorites</span></p>
                                    <div class="messenger-favorites app-scroll-hidden"></div>
                                </div>
                                
                                {{-- Contact --}}
                                <p class="messenger-title"><span>All Messages</span></p>
                                <div class="listOfContacts" style="width: 100%;height:100%;"></div>
                            </div>
                                {{-- ---------------- [ Search Tab ] ---------------- --}}
                            <div class="messenger-tab search-tab app-scroll" data-view="search">
                                    {{-- items --}}
                                    <p class="messenger-title"><span>Search</span></p>
                                    <div class="search-records">
                                        <p class="message-hint center-el"><span>Type to search..</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ----------------------Messaging side---------------------- --}}
                        <div class="messenger-messagingView">
                            {{-- header title [conversation name] amd buttons --}}
                            <div class="m-header m-header-messaging">
                                <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                                    {{-- header back button, avatar and user name --}}
                                    <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                                        <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                                        <div class="avatar av-l header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                                        </div>
                                        <a href="#" class="user-name">@lang('messages.chat_1')</a>
                                    </div>
                                    {{-- header buttons --}}
                                    <nav class="m-header-right d-none">
                                        <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                                    </nav>
                                </nav>
                                {{-- Internet connection --}}
                                <div class="internet-connection">
                                    <span class="ic-connected">@lang('messages.chat_2')</span>
                                    <span class="ic-connecting">@lang('messages.chat_3')...</span>
                                    <span class="ic-noInternet">@lang('messages.chat_4')</span>
                                </div>
                            </div>

                            {{-- Messaging area --}}
                            <div class="m-body messages-container app-scroll">
                                <div class="messages">
                                    <p class="message-hint center-el"><span>@lang('messages.chat_5')</span></p>
                                </div>
                                {{-- Typing indicator --}}
                                <div class="typing-indicator">
                                    <div class="message-card typing">
                                        <div class="message">
                                            <span class="typing-dots">
                                                <span class="dot dot-1"></span>
                                                <span class="dot dot-2"></span>
                                                <span class="dot dot-3"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Send Message Form --}}
                            <div class="messenger-sendCard">
                                <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- <button class="emoji-button"></span><span class="fas fa-smile"></button> -->
                                    <textarea  name="message" class="m-send app-scroll" placeholder="{{ __('messages.chat_9') }}.."></textarea>
                                    <button  class="send-button"><span class="fas fa-paper-plane"></span></button>
                                </form>
                            </div>
                        </div>
                        {{-- ---------------------- Info side ---------------------- --}}
                        <div class="messenger-infoView app-scroll d-none">
                            {{-- nav actions --}}
                            <nav>
                                <p>@lang('messages.chat_6')</p>
                                <a href="#"><i class="fas fa-times"></i></a>
                            </nav>
                            <div class="avatar av-l chatify-d-flex"></div>
                            <p class="info-name">@lang('messages.chat_7')</p>
                            <div class="messenger-infoView-btns">
                                <a href="#" class="danger delete-conversation">@lang('messages.chat_8')</a>
                            </div>
                            {{-- shared photos --}}
                            <div class="messenger-infoView-shared">
                                <p class="" style="height:200px;"><span></span></p>
                            </div>
                        </div>
                    </div>
                    @include('Chatify::layouts.modals')
                    @include('Chatify::layouts.footerLinks')
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.dropdown-toggle').click(function(e) {
            e.preventDefault();
            var $this = $(this);
            var $dropdownMenu = $this.next('.dropdown-menu');
            
            if ($dropdownMenu.is(':visible')) {
                $dropdownMenu.slideUp();
            } else {
                $dropdownMenu.slideDown();
            }
        });
    });
</script>
@endsection

