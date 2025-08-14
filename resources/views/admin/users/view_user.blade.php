@extends('admin.layouts.master')
@section('content')
<style>
    .heading_title {
        background: rgba(0, 0, 0, 0.03);
        padding: 10px;
        font-size: 20px;
    }

    .info-header{
        border: 1px solid #e6e6e6;
        margin-bottom: 2rem;
        border-radius: 3px;
    }

    .padding-row-1{
        padding: 1rem;
    }
    .feedback-row .column-align{
        display: flex !important;
        justify-content: center !important;
    }
    
      .text-left{
      text-align:center !important;
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
         font-family: 'FutureBTBook', sans-serif;
         color:#fff;
      }
      .feedback-title-comment{
      line-height: 16px !important; 
      font-size: 16px;
      margin-left: 45px;
      font-weight:100 !important;
      }
      .sub-title-37{
        font-size: 2.2rem;
        line-height: 0.5;
        font-family: 'FutureBTBook', sans-serif;
         color:#fff;
        
      }
      .item-infos-content{
        padding: 40px 80px;
        position: relative;
        color: white !important;
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
</style>
<div class="container-fluid py-4">
      <div class="card">
         <!-- Profile Header -->
         <div class="card-header p-3">
            <h5 class="mb-0 p-0"><strong>User Detail</strong>
                <div class="float-end">Profile Created: {{ $user->created_at->format('Y-m-d') ?? '' }}</div>
            </h5>
         </div>
         <div class="card-body pt-4 p-3">
            @if (session('success'))
                <div class="alert badge-success text-white" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert badge-danger text-white" role="alert">
                    {{ session('error') }}
                </div>
            @endif
               <!-- Personal Information -->
               <div class="text-center">
                    @if(!empty($pictures))
                        @foreach($pictures as $value)
                            <img src="{{ asset('storage/' . $value->picture_location) }}" alt="Profile Picture" class="preview" width="150" height="150" style=" border-radius: 50%;">
                        @endforeach
                    @else
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="preview" width="150" height="150" style=" border-radius: 50%;"> 
                        @elseif($user->avatar)
                            <img src="{{ $user->avatar }}" alt="Profile Picture" width="150" height="150" class="preview" style=" border-radius: 50%; "> 
                        @else
                            <img src="{{ url('/public/pictures/default.png') }}" alt="Profile Picture" class="preview" width="150" height="150" style=" border-radius: 50%;"> 
                        @endif
                    @endif
               </div>
               <div class="info-header mt-3">
                  <h5 class="heading_title"><strong>Personal Information</strong></h5>
                  <div class="row padding-row-1">
                     <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Name:</strong> &nbsp; {{$user->name}}</li>
                        </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Last Name:</strong> &nbsp; {{$user->last_name}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">What do you like to be called?:</strong> &nbsp; {{$user->like_to_be_called}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Your Best Email:</strong> &nbsp; {{$user->email}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                        <div class="input-group">
                        <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong>Phone Number:</strong> &nbsp; {{$user->phone}}</li>
                        </ul>
                        </div>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong>Born Date:</strong> &nbsp; {{$user->birthday}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                        <div class="input-group">
                        <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Height:</strong> &nbsp; {{$user->height}} {{$user->height_unit}}{{$user->description}}</li>
                        </ul>
                        </div>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Country of Birth:</strong> &nbsp; {{$user->country_of_birth}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Which languages do you speak:</strong> &nbsp; {{$user->languages}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Do you hold any other nationality?:</strong> &nbsp; {{$user->other_nationality}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Where do you live?:</strong> &nbsp; {{$user->location}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6" style="{{ $user->other_nationality == 'Dual' ? 'display:block' : 'display:none' }}">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Other nationality Country :</strong> &nbsp; {{$user->other_nationality_country}}</li>
                     </ul>
                     </div>
                     
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Residence Country :</strong> &nbsp; {{$user->res_country}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Residence State :</strong> &nbsp; {{$user->res_state}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Residence City :</strong> &nbsp; {{$user->res_city}}</li>
                     </ul>
                     </div>
                  </div>
               </div>
               <!-- Interests and Preferences -->
               <div class="info-header">
                  <h5 class="heading_title"><strong>Interests and Preferences</strong></h5>
                  <div class="row padding-row-1">
                     <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                <strong class="text-dark">Interest</strong><br> 
                                {{ $interestInData[$user->interested_in] ?? '' }}
                            </li>
                             @if($user->interested_in =='Male-Male')
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                <strong class="text-dark">@lang('messages.view_profile_42_1')</strong><br> 
                                {{ $user->interested_preference ?? '' }}
                            </li>
                            @endif
                        </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">From which countries do you want to meet people?</strong> <br> {{$user->form_which_countries}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">What Do You Find Internally Attractive About Someone?</strong> <br> {{$user->find_internally_attractive}}</li>
                     </ul>
                     </div>
                  </div>
               </div>
               <div class="info-header">
                  <h5 class="heading_title"><strong>Academic and Job details </strong></h5>
                  <!-- Academic Level -->
                  <div class="row padding-row-1">
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Academic Level :</strong> &nbsp; {{$user->academic_level}}</li>
                     </ul>
                     </div>
                     <!-- Children -->
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Children :</strong> &nbsp; {{$user->children}}</li>
                     </ul>
                     </div>
                     <!-- Children Details (Shown only if "I HAVE" is selected) -->
                     <div class="col-md-6 d-none" id="children_details">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">How many and their ages :</strong> &nbsp; {{$user->children_age}}</li>
                     </ul>
                     </div>
                     <!-- Preferences if "I DON’T HAVE" is selected -->
                     <div class="col-md-6 d-none" id="children_preferences">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">If you don't have children, what are your thoughts? :</strong> &nbsp; {{$user->interested_in}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Industry You Work In :</strong> &nbsp; {{$user->industry_you_work}}</li>
                     </ul>
                     </div>
                     <!-- Travel Frequency -->
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Travel Frequency :</strong> &nbsp; 
                            @if($user->travel_frecuency == 'frequent')
                                I travel with frequency
                            @elseif($user->travel_frecuency == 'occasional')
                                I travel occasionally
                            @elseif($user->travel_frecuency == 'vacations')
                                I travel during part of my free time and vacations
                            @else
                                Not Travel
                            @endif
                            </li>
                            </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">What do you enjoy most about your job?</strong> <br> {{$user->about_your_job}}</li>
                     </ul>
                     </div>
                     <!-- Music Genres -->
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Music Genres </strong> <br> {{$user->music_genres}}</li>
                     </ul>
                     </div>
                     <!-- What Relaxes You -->
                     <div class="col-md-12">
                        <h5 class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Preferred Age Range</strong></h5>
                        <div class="row">
                           <div class="col-md-6">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Interested Minium Age :</strong> &nbsp; {{$user->interested_min_age_range}}</li>
                                </ul>
                           </div>
                           <div class="col-md-6">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Interested Maximum Age :</strong> &nbsp; {{$user->interested_max_age_range}}</li>
                                </ul>
                           </div>
                        </div>
                     </div>
                     <!-- Preferred Age Range -->
                  </div>
               </div>
               <div class="info-header">
                  <h5 class="heading_title"><strong>Family and other one for Habits</strong></h5>
                  <!-- Academic Level -->
                  <div class="row padding-row-1">
                     <!-- Alcohol -->
                     <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Alcohol Consumption :</strong> &nbsp;
                                    @if($user->alcohol == 'never')
                                        I never drink
                                    @elseif($user->alcohol == 'daily')
                                        I drink daily
                                    @elseif($user->alcohol == 'weekends')
                                        I drink on weekends
                                    @elseif($user->alcohol == 'occasionally')
                                        I occasionally drink
                                    @else
                                        No drink
                                    @endif
                            </li>
                        </ul>
                     </div>
                     <!-- Smoking -->
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Smoking Habits :</strong> &nbsp;
                                @if($user->smoke == 'never')
                                    I never smoke
                                @elseif($user->smoke == 'daily')
                                    I smoke daily
                                @elseif($user->smoke == 'occasionally')
                                    I occasionally smoke
                                @elseif($user->smoke == 'quitting')
                                    I’m quitting smoking
                                @else
                                    No smoking
                                @endif
                            </li>
                        </ul>
                     </div>
                     @if($user->smoke != 'never' && $user->smoke != '')
                     <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                <strong class="text-dark">Comment About Smoking Habits :</strong> <br>{{ optional($user)->comment_smoke}};
                            </li>
                        </ul>
                     </div>
                     @endif
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Do you have a social cause that inspires you? </strong><br> {{$user->social_cause}}</li>
                     </ul>
                     </div>
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Do you follow any religion or have specific beliefs?</strong> <br> {{$user->follow_any_religion}}</li>
                     </ul>
                     </div>
                     <!-- Work Out -->
                     <div class="col-md-6">
                     <ul class="list-group">
                     <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Work Out Habits :</strong> &nbsp;
                            @if($user->work_out == 'never')
                                I never work out
                            @elseif($user->work_out == 'daily')
                                I work out daily
                            @elseif($user->work_out == 'often')
                                I work out often
                            @elseif($user->work_out == 'sometimes')
                                I work out sometimes
                            @else
                                Not work out
                            @endif
                            </li>
                            </ul>
                     </div>
                     @if($user->work_out != 'never' && $user->work_out != '')
                     <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                <strong class="text-dark">Comment About Workout Habits :</strong> <br>{{ optional($user)->comment_workout}};
                            </li>
                        </ul>
                     </div>
                     @endif
                  </div>
               </div>
               <!-- This information makes your profile more authentic -->
                <div class="info-header">
                    <h5 class="heading_title"><strong>This information makes your profile more authentic</strong></h5>
                    <div class="row padding-row-1">
                        <div class="col-md-6">
                        <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">What Relaxes You? </strong> <br> {{$user->what_relaxes_you}}</li>
                        </ul>
                        </div>
                        <div class="col-md-6">
                        <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">What Do You Find Internally Attractive About Someone? </strong> <br>  {{$user->find_internally_attractive}}</li>
                        </ul>
                        </div>
                        <div class="col-md-6">
                        <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">How would you describe this stage of your life in general?</strong> <br>  {{$user->life_in_general}}</li>
                        </ul>
                        </div>
                        <div class="col-md-6">
                        <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">How would you describe your conversational style?</strong> <br>  {{$user->conversational_style}}</li>
                        </ul>
                        </div>
                        <div class="col-md-6">
                        <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Which qualities best describes you in a relationship? </strong> <br>  {{$user->what_qualities}}</li>
                        </ul>
                        </div>
                        <div class="col-md-6">
                        <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">How would you describe your lifestyle?</strong> <br> {{$user->describe_your_lifestyle}}</li>
                        </ul>
                        </div>
                        <div class="col-md-6">
                        <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">What Makes You Laugh? </strong> <br> {{$user->you_laugh}}</li>
                        </ul>
                        </div>
                    </div>
                </div>

                <div class="info-header">
                    <h5 class="heading_title"><strong>User employment status</strong></h5>
                    <div class="row p-5">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="emailOption" name="verificationOption" value="email" disabled  {{ $user->verificationOption == 'email' ? 'checked' : '' }}>
                        <span><label class="form-check-label m-0" for="emailOption">Specify your corporate email (A confirmation message will be sent to this email, while all other communications will remain with your personal email).</label></span> 
                        </br>
                        <p class="pt-3 {{ $user->verificationOption != 'email' ? 'd-none' : '' }}">CorporateEmail : {{ $user->corporate_email != '' ? $user->corporate_email : '' }}</p>  
                    </div>
                        <!-- Option 2: Upload Employment Certificate -->
                    <div class="form-check mt-3">
                        <input type="radio" class="form-check-input" id="emailOption" name="verificationOption" value="certificate" disabled {{ $user->verificationOption == 'certificate' ? 'checked' : '' }}>
                        <span><label class="form-check-label m-0" for="certificateOption">Send an employment certificate dated within the last two months (no salary info ).</label></span>
                        </br>
                        <a class="{{ $user->verificationOption != 'certificate' ? 'd-none' : '' }}" 
                            href="{{ asset('storage/' . $user->employmentCertificate) }}" 
                            target="_blank">
                            <i class="fa-solid fa-eye"></i> View Document
                        </a>
                    </div>
                        
                        <!-- Option 3: No Verification -->
                    <div class="form-check mt-3">
                        <input type="radio" class="form-check-input" id="emailOption" name="verificationOption" value="noOption" disabled {{ $user->verificationOption == 'noOption' ? 'checked' : '' }}>
                        <span><label class="form-check-label m-0" for="noOption">I don’t have any of these. (We will communicate with you)</label></span>
                    </div>
                    </div>
                </div>
               <?php
              
                    $feedbackData = getUserFeedback($user->id);
                    $photogenic_avg = 0;
                    $expressiveness_avg = 0;
                    $manners_avg = 0;
                    $opinions_ideas_avg = 0;
                    $sense_humer_avg = 0;
                    $energy_avg = 0;
                    $willingness_avg = 0;

                    
                    $photogenic_avg = $feedbackData['feedbackAverages']['photogenic_avg'];
                    $expressiveness_avg = $feedbackData['feedbackAverages']['expressiveness_avg'];
                    $manners_avg = $feedbackData['feedbackAverages']['manners_avg'];
                    $opinions_ideas_avg = $feedbackData['feedbackAverages']['opinions_ideas_avg'];
                    $sense_humer_avg = $feedbackData['feedbackAverages']['sense_humer_avg'];
                    $energy_avg = $feedbackData['feedbackAverages']['energy_avg'];
                    $willingness_avg = $feedbackData['feedbackAverages']['willingness_avg'];
                    
                ?>
                <div class="info-header" id="feedback-section">
                    
                    <h5 class="heading_title mb-0 shadow-sm"><strong>Feedback</strong></h5>
                    <div class="row p-1 feedback-row feeback-box-color m-0 py-5" style="background: url('{{ asset('feedback_Icons/feedback-background-img.png') }}');background-size: cover;">
                        <div class="col-12 text-center">
                            <h2 style="font-size: 2.7rem;"><b style="font-family: 'AvenirNext', sans-serif;font-weight: 100;color: #666666;" class="text-uppercase">What stands out on Silverbridge</b></h2>
                            <p class="sub-title-37 mb-5 text-center">These ratings are based in the feedback received</p>
                        </div>
                        <div class="col-12 mx-2 py-3 d-flex justify-content-center">
                           
                            <div class="col-2 offset-1 mr2 mb6 text-right text-right">
                                <div class="box-imge"><img class="feedback-img mt-1" src="{{ asset('feedback_Icons/photo_icon.png') }}"></div>
                            </div>
                            <div class="col-10 mb6">
                                <h4 class="tl-37 tl-37-1"> PHOTO VS REALITY</h4>
                                <p class="sub-37 {{ $photogenic_avg == 0 ? '' : 'd-none' }}">No Rating</p>
                                <p class="sub-37 {{ $photogenic_avg == 1 ? '' : 'd-none' }}">It's much better in photos</p>
                                <p class="sub-37 {{ $photogenic_avg == 2 ? '' : 'd-none' }}">It's better in photos</p>
                                <p class="sub-37 {{ $photogenic_avg == 3 ? '' : 'd-none' }}">It's practically the same as in photos</p>
                                <p class="sub-37 {{ $photogenic_avg == 4 ? '' : 'd-none' }}">It's better in person</p>
                                <p class="sub-37 {{ $photogenic_avg == 5 ? '' : 'd-none' }}">It's much better in person</p>
                            </div>
                        </div>
                        <div class="col-12 mx-2 py-3 d-flex justify-content-center">
                            <div class="col-2 offset-1 mr2 mb6 text-right">
                            <div class="box-imge"><img class="feedback-img" src="{{ asset('feedback_Icons/expresiveness_icon.png') }}"></div>
                            </div>
                            <div class="col-10 mb6">
                            <h4 class="tl-37 tl-37-1"> LEVEL OF EXPRESSIVENESS</h4>
                            <p class="sub-37 {{  $expressiveness_avg == 0 ? '' : 'd-none' }}">No Rating</p>
                            <p class="sub-37 {{ $expressiveness_avg == 1 ? '' : 'd-none' }}">Is quite reserved</p>
                            <p class="sub-37 {{ $expressiveness_avg == 2 ? '' : 'd-none' }}">Is reserved but has certain moments of eloquence</p>
                            <p class="sub-37 {{ $expressiveness_avg == 3 ? '' : 'd-none' }}">In-between, doesn’t talk too much but isn’t too reserved either</p>
                            <p class="sub-37 {{ $expressiveness_avg == 4 ? '' : 'd-none' }}">Is more eloquent than reserved</p>
                            <p class="sub-37 {{ $expressiveness_avg == 5 ? '' : 'd-none' }}">Expresses their ideas very well</p>
                            </div>
                        </div>
                        <div class="col-12 mx-2 py-3 d-flex justify-content-center">
                            <div class="col-2 offset-1 mr2 mb6 text-right">
                            <div class="box-imge"><img class="feedback-img" src="{{ asset('feedback_Icons/manners_icon.png') }}"></div>
                            </div>
                            <div class="col-10 mb6">
                            <h4 class="tl-37 tl-37-1">MANNERS </h4>
                            <p class="sub-37 {{  $manners_avg == 0 ? '' : 'd-none' }}">No Rating</p>
                            <p class="sub-37 {{  $manners_avg == 1 ? '' : 'd-none' }}">There are quite a few details that could be improved.</p>
                            <p class="sub-37 {{  $manners_avg == 2 ? '' : 'd-none' }}">Is a bit picky</p>
                            <p class="sub-37 {{  $manners_avg == 3 ? '' : 'd-none' }}">Is balanced</p>
                            <p class="sub-37 {{  $manners_avg == 4 ? '' : 'd-none' }}">Misses a few details, but generally has good manners</p>
                            <p class="sub-37 {{  $manners_avg == 5 ? '' : 'd-none' }}">Handles manners very well</p>
                            </div>
                        </div>
                        <div class="col-12 mx-2 py-3 d-flex justify-content-center">
                            <div class="col-2 offset-1 mr2 mb6 text-right">
                                <div class="box-imge"><img class="feedback-img" src="{{ asset('feedback_Icons/opinions_icon.png') }}"></div>
                            </div>
                            <div class="col-10 mb6">
                                <h4 class="tl-37 tl-37-1">CONCEPTS & IDEAS</h4>
                                <p class="sub-37 {{  $opinions_ideas_avg == 0 ? '' : 'd-none' }}">No Rating</p>
                                <p class="sub-37 {{ $opinions_ideas_avg == 1 ? '' : 'd-none' }}">Has several concepts and ideas that are quite extreme and unusual</p>
                                <p class="sub-37 {{ $opinions_ideas_avg == 2 ? '' : 'd-none' }}">Has some unusual concepts</p>
                                <p class="sub-37 {{ $opinions_ideas_avg == 3 ? '' : 'd-none' }}">Holds balanced views on topics</p>
                                <p class="sub-37 {{ $opinions_ideas_avg == 4 ? '' : 'd-none' }}">Has several interesting concepts and ideas</p>
                                <p class="sub-37 {{ $opinions_ideas_avg == 5 ? '' : 'd-none' }}">Many of their concepts and ideas are quite interesting</p>
                            </div>   
                        </div>
                        <div class="col-12 mx-2 py-3 d-flex justify-content-center">
                            
                            <div class="col-2 offset-1 mr2 mb6 text-right">
                            <div class="box-imge"><img class="feedback-img" src="{{ asset('feedback_Icons/comments_icon.png') }}"></div>
                            </div>
                            <div class="col-10 mb6">
                            <h4 class="tl-37 tl-37-1">SENSE OF HUMOR</h4>
                            <p class="sub-37 {{  $sense_humer_avg == 0 ? '' : 'd-none' }}">No Rating</p>
                            <p class="sub-37 {{ $sense_humer_avg == 1 ? '' : 'd-none' }}"> Seriousness is their thing</p>
                            <p class="sub-37 {{ $sense_humer_avg == 2 ? '' : 'd-none' }}">Rarely connected with a funny remark, or their humor wasn't quite right
                            </p>
                            <p class="sub-37 {{ $sense_humer_avg == 3 ? '' : 'd-none' }}">Balanced</p>
                            <p class="sub-37 {{ $sense_humer_avg == 4 ? '' : 'd-none' }}"> Good at making funny comments</p>
                            <p class="sub-37 {{ $sense_humer_avg == 5 ? '' : 'd-none' }}">Excellent at making people laugh</p>
                            </div>
                            
                        </div>
                        <div class="col-12 mx-2 py-3 d-flex justify-content-center">
                            
                            <div class="col-2 offset-1 mr2 mb6 text-right">
                            <div class="box-imge"><img class="feedback-img" src="{{ asset('feedback_Icons/energy_icon.png') }}"></div>
                            </div>
                            <div class="col-10 mb6">
                            <h4 class="tl-37 tl-37-1">ENERGY WHEN INTERACTING</h4>
                            <p class="sub-37 {{  $energy_avg == 0 ? '' : 'd-none' }}">No Rating</p>
                            <p class="sub-37 {{ $energy_avg == 1 ? '' : 'd-none' }}">Dull: Gives off very little energy</p>
                            <p class="sub-37 {{ $energy_avg == 2 ? '' : 'd-none' }}">Passive: Their energy is weak, doesn’t drive much interaction</p>
                            <p class="sub-37 {{ $energy_avg == 3 ? '' : 'd-none' }}">Balanced: Their energy is stable and moderate</p>
                            <p class="sub-37 {{ $energy_avg == 4 ? '' : 'd-none' }}">Dynamic: Displays high energy</p>
                            <p class="sub-37 {{ $energy_avg == 5 ? '' : 'd-none' }}">Vibrant: Radiates stimulating energy</p>
                            </div>
                        
                        </div>
                        <div class="col-12 mx-2 py-3 d-flex justify-content-center">
                        
                            <div class="col-2 offset-1 mr2 mb6 text-right">
                            <div class="box-imge"><img class="feedback-img" src="{{ asset('feedback_Icons/willingness_icon.png') }}"></div>
                            </div>
                            <div class="col-10 mb6">
                            <h4 class="tl-37 tl-37-1">WILLINGNESS TO CONNECT (before the date)</h4>
                            <p class="sub-37 {{$willingness_avg == 0 ? '' : 'd-none' }}">No Rating</p>
                            <p class="sub-37 {{ $willingness_avg  == 1 ? '' : 'd-none' }}">Very low: Very delayed responses</p>
                            <p class="sub-37 {{ $willingness_avg  == 2 ? '' : 'd-none' }}">Low: Frequent delays, little effort to connect</p>
                            <p class="sub-37 {{ $willingness_avg  == 3 ? '' : 'd-none' }}">Adequate: Responds within reasonable time frames</p>
                            <p class="sub-37 {{ $willingness_avg  == 4 ? '' : 'd-none' }}">High: Responds quickly, shows prior interest</p>
                            <p class="sub-37 {{ $willingness_avg  == 5 ? '' : 'd-none' }}">Excellent: Almost immediate responses, shows great willingness</p>
                            </div>
                        
                        </div>
                        <div class="col-12 mx-2 py-3 d-flex justify-content-center">
                            @if($photogenic_avg == 0 && $expressiveness_avg == 0 && $manners_avg == 0 && $opinions_ideas_avg == 0 && $sense_humer_avg == 0 && $energy_avg == 0 && $willingness_avg == 0)
                            <!-- <div class="col-md-2 offset-1">
                                <div class="box-imge"><img class="feedback-img" src="{{ asset('feedback_Icons/comments_icon.png') }}"></div>
                            </div> 
                            <div class="col-md-8 text-left">
                                <h4 class="tl-37 tl-37-1">No ratings yet</h4>
                                <p class="sub-37">You'll start getting ratings after your in-person meetings!</p>
                            </div> -->
                            @endif

                            @if(auth()->user()->id != $user->id)
                            @if(!empty($comments->reason_profile) && !empty($comments->reason_description) && !empty($comments->comments) && $comments->is_comment_publish == 1)
                                <div class="col-md-2 offset-1">
                                    <div class="box-imge"><img class="feedback-img" src="{{ asset('feedback_Icons/comments_icon.png') }}"></div>
                                </div> 
                                <div class="col-md-8 text-left">
                                    <h4 class="tl-37 tl-37-1">Highlighted Comments</h4>
                                    <p class="sub-37">Profile: {{optional($comments)->reason_profile}}</p>
                                    <p class="sub-37">Description: {{optional($comments)->reason_description}}</p>
                                    <p class="sub-37">Comment: {{optional($comments)->comments}}</p>
                                </div>
                            @endif
                            @else
                                @if(!empty($comments->reason_profile) && !empty($comments->reason_description) && !empty($comments->comments))
                                    <div class="col-md-2 offset-1">
                                        <div class="box-imge"><img class="feedback-img" src="{{ asset('feedback_Icons/comments_icon.png') }}"></div>
                                    </div> 
                                    <div class="col-md-8 text-left">
                                        <h4 class="tl-37 tl-37-1">Highlighted Comments</h4>
                                        <p class="sub-37">Profile: {{optional($comments)->reason_profile}}</p>
                                        <p class="sub-37">Description: {{optional($comments)->reason_description}}</p>
                                        <p class="sub-37">Comment: {{optional($comments)->comments}}</p>
                                        <div id="commentsSection">
                                            @if($comments->is_comment_publish == 1)
                                            <button class="btn btn-primary">PUBLISHED</button>
                                            @else
                                            <button type="button" class="btn btn-primary" onclick="publishComment({{$comments->user_id}}, {{$comments->liked_user_id}})">PUBLISH</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif

                        </div class="col-12" style="margin-left: 14%;">
                            @php 
                                $approveStatus = ($user->status == 'approved') ? 'Approved' : 'Approve ';
                                $rejectStatus = ($user->status == 'rejected') ? 'Rejected' : 'Reject';

                                $subscription = getSubscriptionActive($user->id);

                                $blockStatus = isset($subscription['subscription']) && $subscription['subscription']->renew_status == 3 
                                    ? 'Permanent Blocked' 
                                    : 'Permanent Block';

                                $activeStatus = isset($subscription['subscription']) && $subscription['subscription']->renew_status == 1 
                                    ? 'Activated renewal' 
                                    : 'Active Renewal';
                            @endphp
                            <div>
                                @if(isset($subscription['subscription']) && $subscription['isactive'] == 0)
                                    <form id="activateRenewalForm{{$subscription['subscription']->id}}" action="{{route('admin.user_list.activateRenewal', $subscription['subscription']->id)}}" method="get" style="display:inline;" onclick="confirmActivateRenewal({{$subscription['subscription']->id}})">
                                    @csrf
                                        <button type="button" class="btn btn-success" >{{$activeStatus}}</button>
                                    </form>

                                    <form id="permanentBlockForm{{$subscription['subscription']->id}}" action="{{route('admin.user_list.permanentblock', $subscription['subscription']->id)}}" method="get" style="display:inline;" onclick="confirmPermanentBlock({{$subscription['subscription']->id}})">
                                    @csrf
                                        <button type="button" class="btn btn-danger" >{{$blockStatus}}</button>
                                    </form>
                                @endif
                            </div>
                    </div>
                    
                </div>


               
                <div class="info-footer">
                    @if($user->status == 'approved')
                        <button type="button" class="btn btn-success">{{$approveStatus}}</button>
                    @else
                        <form id="approveForm{{$user->id}}" action="{{route('admin.user_list.approve', $user->id)}}" method="get" style="display:inline;" onclick="confirmApproval({{$user->id}})">
                        @csrf
                            <button type="button" class="btn btn-success">{{$approveStatus}}</button>
                        </form>
                    @endif

                    @if($user->status == 'Rejected')
                        <button type="button" class="btn btn-danger" >{{$rejectStatus}}</button>
                    @else
                        <form id="rejectForm{{$user->id}}" action="{{route('admin.user_list.reject', $user->id)}}" method="get" style="display:inline;" onclick="confirmRejection({{$user->id}})">
                        @csrf
                            <button type="button" class="btn btn-danger" >{{$rejectStatus}}</button>
                        </form>
                    @endif
                </div>
         </div>
      </div>
</div>
<script>
    function confirmApproval(id) {
        return Swal.fire({
            title: 'Are you sure?',
            text: "You want to approve this user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('approveForm'+id).submit();
            }
        });
    }
    
    function confirmRejection(id) {
        return Swal.fire({
            title: 'Are you sure?',
            text: "You want to reject this user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('rejectForm'+id).submit();
            }
        });
    }

    function confirmPermanentBlock(id) {
        return Swal.fire({
            title: 'Are you sure?',
            text: "You want to block this user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('permanentBlockForm'+id).submit();
            }
        });
    }

    function confirmActivateRenewal(id) {
        return Swal.fire({
            title: 'Are you sure?',
            text: "You want to Active renewal for this user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('activateRenewalForm'+id).submit();
            }
        });
    }
</script>
@endsection