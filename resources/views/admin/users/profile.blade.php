@extends('admin.layouts.master')
@section('content')
<style>
   body{
   background: url('{{url('public/img/profile_users.jpg')}}');
   }
   .slidecontainer {
   width: 100%;
   }
   .intl-tel-input,
   .iti{
   width: 100%;
   }
   .slider {
   -webkit-appearance: none;
   width: 100%;
   height: 15px;
   border-radius: 5px;
   background: #d3d3d3;
   outline: none;
   opacity: 0.7;
   -webkit-transition: .2s;
   transition: opacity .2s;
   }
   .slider:hover {
   opacity: 1;
   }
   .slider::-webkit-slider-thumb {
   -webkit-appearance: none;
   appearance: none;
   width: 25px;
   height: 25px;
   border-radius: 50%;
   background: #d0211c;
   cursor: pointer;
   }
   .slider::-moz-range-thumb {
   width: 25px;
   height: 25px;
   border-radius: 50%;
   background: #d0211c;
   cursor: pointer;
   }
   label {
   display: inline-block;
   margin-bottom: 0.5rem;
   font-weight: 700;
   margin: 15px 0px 0px;
   }
   .select2-container .select2-selection--single {
   height: 37px !important;
   border: 1px solid #ced4da !important;
   }
   .select2-container--default .select2-selection--single .select2-selection__rendered {
   line-height: 37px !important;
   }
   .select2-container--default .select2-selection--single .select2-selection__arrow {
   height: 36px !important;
   }
   .heading_title {
   background: #ccc;
   padding: 10px;
   font-size: 20px;
   }
</style>
<div class="container">
   <div class="row justify-content-center">
      <div class="card">
         <style>
            .profile-header {
            text-align: center;
            margin-bottom: 20px;
            }
            .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            }
            .form-section {
            margin-top: 30px;
            margin-bottom: 20px;
            }
         </style>
         <!-- Profile Header -->
         <div class="card-header"> 
            <h1>Edit Profile</h1>
            <p>Complete your profile to stand out!</p>
         </div>
         <div class="card-body">
            <!-- Profile Picture -->
            @if (session('status'))
            <div class="alert alert-success" role="alert">
               {{ session('status') }}
            </div>
            @endif
            <!-- Profile Form -->
            <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
               @csrf 
               <!-- Personal Information -->
               <div class="text-center">
                  @php $countries = [ 'AF' => ['name' => 'Afghanistan', 'code' => '+93'], 'AL' => ['name' => 'Albania', 'code' => '+355'], 'DZ' => ['name' => 'Algeria', 'code' => '+213'], 'AD' => ['name' => 'Andorra', 'code' => '+376'], 'AO' => ['name' => 'Angola', 'code'
                  => '+244'], 'AR' => ['name' => 'Argentina', 'code' => '+54'], 'AM' => ['name' => 'Armenia', 'code' => '+374'], 'AU' => ['name' => 'Australia', 'code' => '+61'], 'AT' => ['name' => 'Austria', 'code' => '+43'], 'AZ' => ['name' =>
                  'Azerbaijan', 'code' => '+994'], 'BS' => ['name' => 'Bahamas', 'code' => '+1-242'], 'BH' => ['name' => 'Bahrain', 'code' => '+973'], 'BD' => ['name' => 'Bangladesh', 'code' => '+880'], 'BB' => ['name' => 'Barbados', 'code' => '+1-246'],
                  'BY' => ['name' => 'Belarus', 'code' => '+375'], 'BE' => ['name' => 'Belgium', 'code' => '+32'], 'BZ' => ['name' => 'Belize', 'code' => '+501'], 'BJ' => ['name' => 'Benin', 'code' => '+229'], 'BT' => ['name' => 'Bhutan', 'code'
                  => '+975'], 'BO' => ['name' => 'Bolivia', 'code' => '+591'], 'BA' => ['name' => 'Bosnia and Herzegovina', 'code' => '+387'], 'BW' => ['name' => 'Botswana', 'code' => '+267'], 'BR' => ['name' => 'Brazil', 'code' => '+55'], 'BN'
                  => ['name' => 'Brunei', 'code' => '+673'], 'BG' => ['name' => 'Bulgaria', 'code' => '+359'], 'BF' => ['name' => 'Burkina Faso', 'code' => '+226'], 'BI' => ['name' => 'Burundi', 'code' => '+257'], 'KH' => ['name' => 'Cambodia',
                  'code' => '+855'], 'CM' => ['name' => 'Cameroon', 'code' => '+237'], 'CA' => ['name' => 'Canada', 'code' => '+1'], 'CV' => ['name' => 'Cape Verde', 'code' => '+238'], 'KY' => ['name' => 'Cayman Islands', 'code' => '+1-345'], 'CF'
                  => ['name' => 'Central African Republic', 'code' => '+236'], 'TD' => ['name' => 'Chad', 'code' => '+235'], 'CL' => ['name' => 'Chile', 'code' => '+56'], 'CN' => ['name' => 'China', 'code' => '+86'], 'CO' => ['name' => 'Colombia',
                  'code' => '+57'], 'KM' => ['name' => 'Comoros', 'code' => '+269'], 'CD' => ['name' => 'Congo (Democratic Republic)', 'code' => '+243'], 'CG' => ['name' => 'Congo (Republic)', 'code' => '+242'], 'CR' => ['name' => 'Costa Rica',
                  'code' => '+506'], 'HR' => ['name' => 'Croatia', 'code' => '+385'], 'CU' => ['name' => 'Cuba', 'code' => '+53'], 'CY' => ['name' => 'Cyprus', 'code' => '+357'], 'CZ' => ['name' => 'Czech Republic', 'code' => '+420'], 'DK' => ['name'
                  => 'Denmark', 'code' => '+45'], 'DJ' => ['name' => 'Djibouti', 'code' => '+253'], 'DM' => ['name' => 'Dominica', 'code' => '+1-767'], 'DO' => ['name' => 'Dominican Republic', 'code' => '+1-809'], 'EC' => ['name' => 'Ecuador', 'code'
                  => '+593'], 'EG' => ['name' => 'Egypt', 'code' => '+20'], 'SV' => ['name' => 'El Salvador', 'code' => '+503'], 'GQ' => ['name' => 'Equatorial Guinea', 'code' => '+240'], 'ER' => ['name' => 'Eritrea', 'code' => '+291'], 'EE' =>
                  ['name' => 'Estonia', 'code' => '+372'], 'ET' => ['name' => 'Ethiopia', 'code' => '+251'], 'FI' => ['name' => 'Finland', 'code' => '+358'], 'FR' => ['name' => 'France', 'code' => '+33'], 'GA' => ['name' => 'Gabon', 'code' => '+241'],
                  'GM' => ['name' => 'Gambia', 'code' => '+220'], 'GE' => ['name' => 'Georgia', 'code' => '+995'], 'DE' => ['name' => 'Germany', 'code' => '+49'], 'GH' => ['name' => 'Ghana', 'code' => '+233'], 'GR' => ['name' => 'Greece', 'code'
                  => '+30'], 'GD' => ['name' => 'Grenada', 'code' => '+1-473'], 'GT' => ['name' => 'Guatemala', 'code' => '+502'], 'GN' => ['name' => 'Guinea', 'code' => '+224'], 'GW' => ['name' => 'Guinea-Bissau', 'code' => '+245'], 'GY' => ['name'
                  => 'Guyana', 'code' => '+592'], 'HT' => ['name' => 'Haiti', 'code' => '+509'], 'HN' => ['name' => 'Honduras', 'code' => '+504'], 'HK' => ['name' => 'Hong Kong', 'code' => '+852'], 'HU' => ['name' => 'Hungary', 'code' => '+36'],
                  'IS' => ['name' => 'Iceland', 'code' => '+354'], 'IN' => ['name' => 'India', 'code' => '+91'], 'ID' => ['name' => 'Indonesia', 'code' => '+62'], 'IR' => ['name' => 'Iran', 'code' => '+98'], 'IQ' => ['name' => 'Iraq', 'code' =>
                  '+964'], 'IE' => ['name' => 'Ireland', 'code' => '+353'], 'IL' => ['name' => 'Israel', 'code' => '+972'], 'IT' => ['name' => 'Italy', 'code' => '+39'], 'JM' => ['name' => 'Jamaica', 'code' => '+1-876'], 'JP' => ['name' => 'Japan',
                  'code' => '+81'], 'JO' => ['name' => 'Jordan', 'code' => '+962'], 'KE' => ['name' => 'Kenya', 'code' => '+254'], 'KI' => ['name' => 'Kiribati', 'code' => '+686'], 'KR' => ['name' => 'South Korea', 'code' => '+82'], 'KW' => ['name'
                  => 'Kuwait', 'code' => '+965'], 'KG' => ['name' => 'Kyrgyzstan', 'code' => '+996'], 'LA' => ['name' => 'Laos', 'code' => '+856'], 'LV' => ['name' => 'Latvia', 'code' => '+371'], 'LB' => ['name' => 'Lebanon', 'code' => '+961'],
                  'LS' => ['name' => 'Lesotho', 'code' => '+266'], 'LR' => ['name' => 'Liberia', 'code' => '+231'], 'LY' => ['name' => 'Libya', 'code' => '+218'], 'LI' => ['name' => 'Liechtenstein', 'code' => '+423'], 'LT' => ['name' => 'Lithuania',
                  'code' => '+370'], 'LU' => ['name' => 'Luxembourg', 'code' => '+352'], 'MO' => ['name' => 'Macau', 'code' => '+853'], 'MK' => ['name' => 'North Macedonia', 'code' => '+389'], 'MG' => ['name' => 'Madagascar', 'code' => '+261'],
                  'MW' => ['name' => 'Malawi', 'code' => '+265'], 'MY' => ['name' => 'Malaysia', 'code' => '+60'], 'MV' => ['name' => 'Maldives', 'code' => '+960'], 'ML' => ['name' => 'Mali', 'code' => '+223'], 'MT' => ['name' => 'Malta', 'code'
                  => '+356'], 'MH' => ['name' => 'Marshall Islands', 'code' => '+692'], 'MQ' => ['name' => 'Martinique', 'code' => '+596'], 'MR' => ['name' => 'Mauritania', 'code' => '+222'], 'MU' => ['name' => 'Mauritius', 'code' => '+230'], 'YT'
                  => ['name' => 'Mayotte', 'code' => '+262'], 'MX' => ['name' => 'Mexico', 'code' => '+52'], 'FM' => ['name' => 'Micronesia', 'code' => '+691'], 'MD' => ['name' => 'Moldova', 'code' => '+373'], 'MC' => ['name' => 'Monaco', 'code'
                  => '+377'], 'MN' => ['name' => 'Mongolia', 'code' => '+976'], 'ME' => ['name' => 'Montenegro', 'code' => '+382'], 'MA' => ['name' => 'Morocco', 'code' => '+212'], 'MZ' => ['name' => 'Mozambique', 'code' => '+258'], 'MM' => ['name'
                  => 'Myanmar', 'code' => '+95'], 'NA' => ['name' => 'Namibia', 'code' => '+264'], 'NR' => ['name' => 'Nauru', 'code' => '+674'], 'NP' => ['name' => 'Nepal', 'code' => '+977'], 'NL' => ['name' => 'Netherlands', 'code' => '+31'],
                  'NZ' => ['name' => 'New Zealand', 'code' => '+64'], 'NI' => ['name' => 'Nicaragua', 'code' => '+505'], 'NE' => ['name' => 'Niger', 'code' => '+227'], 'NG' => ['name' => 'Nigeria', 'code' => '+234'], 'NO' => ['name' => 'Norway',
                  'code' => '+47'], 'NP' => ['name' => 'Nepal', 'code' => '+977'], 'OM' => ['name' => 'Oman', 'code' => '+968'], 'PK' => ['name' => 'Pakistan', 'code' => '+92'], 'PA' => ['name' => 'Panama', 'code' => '+507'], 'PG' => ['name' =>
                  'Papua New Guinea', 'code' => '+675'], 'PY' => ['name' => 'Paraguay', 'code' => '+595'], 'PE' => ['name' => 'Peru', 'code' => '+51'], 'PH' => ['name' => 'Philippines', 'code' => '+63'], 'PL' => ['name' => 'Poland', 'code' => '+48'],
                  'PT' => ['name' => 'Portugal', 'code' => '+351'], 'PR' => ['name' => 'Puerto Rico', 'code' => '+1-787'], 'QA' => ['name' => 'Qatar', 'code' => '+974'], 'RO' => ['name' => 'Romania', 'code' => '+40'], 'RU' => ['name' => 'Russia',
                  'code' => '+7'], 'RW' => ['name' => 'Rwanda', 'code' => '+250'], 'SA' => ['name' => 'Saudi Arabia', 'code' => '+966'], 'SN' => ['name' => 'Senegal', 'code' => '+221'], 'RS' => ['name' => 'Serbia', 'code' => '+381'], 'SC' => ['name'
                  => 'Seychelles', 'code' => '+248'], 'SL' => ['name' => 'Sierra Leone', 'code' => '+232'], 'SG' => ['name' => 'Singapore', 'code' => '+65'], 'SK' => ['name' => 'Slovakia', 'code' => '+421'], 'SI' => ['name' => 'Slovenia', 'code'
                  => '+386'], 'SB' => ['name' => 'Solomon Islands', 'code' => '+677'], 'SO' => ['name' => 'Somalia', 'code' => '+252'], 'ZA' => ['name' => 'South Africa', 'code' => '+27'], 'ES' => ['name' => 'Spain', 'code' => '+34'], 'LK' => ['name'
                  => 'Sri Lanka', 'code' => '+94'], 'SD' => ['name' => 'Sudan', 'code' => '+249'], 'SR' => ['name' => 'Suriname', 'code' => '+597'], 'SZ' => ['name' => 'Swaziland', 'code' => '+268'], 'SE' => ['name' => 'Sweden', 'code' => '+46'],
                  'CH' => ['name' => 'Switzerland', 'code' => '+41'], 'SY' => ['name' => 'Syria', 'code' => '+963'], 'TW' => ['name' => 'Taiwan', 'code' => '+886'], 'TJ' => ['name' => 'Tajikistan', 'code' => '+992'], 'TZ' => ['name' => 'Tanzania',
                  'code' => '+255'], 'TH' => ['name' => 'Thailand', 'code' => '+66'], 'TL' => ['name' => 'Timor-Leste', 'code' => '+670'], 'TG' => ['name' => 'Togo', 'code' => '+228'], 'TO' => ['name' => 'Tonga', 'code' => '+676'], 'TT' => ['name'
                  => 'Trinidad and Tobago', 'code' => '+1-868'], 'TN' => ['name' => 'Tunisia', 'code' => '+216'], 'TR' => ['name' => 'Turkey', 'code' => '+90'], 'TM' => ['name' => 'Turkmenistan', 'code' => '+993'], 'TV' => ['name' => 'Tuvalu', 'code'
                  => '+688'], 'UG' => ['name' => 'Uganda', 'code' => '+256'], 'UA' => ['name' => 'Ukraine', 'code' => '+380'], 'AE' => ['name' => 'United Arab Emirates', 'code' => '+971'], 'GB' => ['name' => 'United Kingdom', 'code' => '+44'], 'US'
                  => ['name' => 'United States', 'code' => '+1'], 'UY' => ['name' => 'Uruguay', 'code' => '+598'], 'UZ' => ['name' => 'Uzbekistan', 'code' => '+998'], 'VU' => ['name' => 'Vanuatu', 'code' => '+678'], 'VE' => ['name' => 'Venezuela',
                  'code' => '+58'], 'VN' => ['name' => 'Vietnam', 'code' => '+84'], 'WF' => ['name' => 'Wallis and Futuna', 'code' => '+681'], 'YE' => ['name' => 'Yemen', 'code' => '+967'], 'ZM' => ['name' => 'Zambia', 'code' => '+260'], 'ZW' =>
                  ['name' => 'Zimbabwe', 'code' => '+263'] ]; // Extracting country names $countryNames = array_map(function($country) { return $country['name']; }, $countries); @endphp 
                  
                @if($user->profile_picture)
                    <img id="imageLoad1" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="preview" width="180" style="border-radius: 0%;"> 
                @elseif($user->avatar)
                    <img src="{{ $user->avatar }}" alt="Profile Picture" width="150" height="150" class="preview" width="180" style="border-radius: 0%;"> 
                @else
                    <img src="{{ url('/public/pictures/default.png') }}" alt="Profile Picture" class="preview" width="180" style="border-radius: 0%;"> 
                @endif
                  <!-- Hidden File Input -->
                  <input type="file" class="form-control d-none" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">
                  <!-- Custom Upload Button -->
                  <p>
                     <button type="button" class="btn btn-primary mt-2" onclick="document.getElementById('profile_picture').click();">
                     <i class="fas fa-plus"></i> Upload Profile Image
                     </button>
                  </p>
               </div>
               <div class="form-section">
                  <h5 class="heading_title"><strong>Personal Information</strong></h5>
                  <div class="row g-3">
                     <div class="col-md-6">
                        <label for="email" class="form-label">Your Best Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ old('email', $user->email) }}" >
                     </div>
                     <div class="col-md-6 d-none">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your first name" value="{{ old('name', $user->name) }}" readonly>
                     </div>
                     <div class="col-md-6 d-none">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last-name" name="last-name" value="{{ old('last-name', $user->last_name) }}">
                     </div>
                     <div class="col-md-6 d-none">
                        <label for="like_to_be_called" class="form-label">What do you like to be called?</label>
                        <input type="text" class="form-control" id="like_to_be_called" name="like_to_be_called" placeholder="Preferred nickname" value="{{ old('like_to_be_called', $user->like_to_be_called) }}">
                     </div>
                     <div class="col-md-6 d-none">
                        <label for="phone">Phone Number</label>
                        <div class="input-group">
                           <input type="text" class="form-control" id="mobile_code" name="phone" placeholder="e.g., 234 567 8901" value="{{ old('phone', $user->phone) }}" >
                        </div>
                     </div>
                     <div class="col-md-6 d-none">
                        <label for="birthday" class="form-label">Born Date (D/M/Y)</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" value="{{ old('birthday', $user->birthday) }}" >
                     </div>
                     <div class="col-md-6 d-none">
                           
                           <div class="input-group">
                              <!-- Height in CM -->
                              <div style="{{ $user->description == 'Feet' ? 'display:none;' : 'display:block;' }}">
                                 <label for="height">@lang('messages.profile_6')</label>
                                 <input 
                                    type="text" 
                                    class="form-control @error('height') is-invalid @enderror" 
                                    id="height" 
                                    name="height" 
                                    placeholder="Enter your height" 
                                    value="{{ old('height', $user->height) }}" 
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                                    maxlength="3" 
                                    inputmode="numeric"
                                 />
                              </div>

                              <!-- Feet Input -->
                              <div style="{{ $user->description == 'Feet' ? 'display:block;' : 'display:none;' }}">
                                 <label for="feet">Feet</label>
                                 <input 
                                    type="text" 
                                    class="form-control" 
                                    id="feet" 
                                    name="feet" 
                                    placeholder="Feet"
                                    value="{{ old('feet', $user->feet) }}"  
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                                    maxlength="2" 
                                 />
                              </div>

                              <!-- Inches Input -->
                              <div style="{{ $user->description == 'Feet' ? 'display:block;' : 'display:none;' }}">
                                 <label for="inches">Inches</label>
                                 <input 
                                    type="text" 
                                    class="form-control" 
                                    id="inches" 
                                    name="inches" 
                                    placeholder="Inches" 
                                    value="{{ old('inches', $user->inches) }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                                    maxlength="2" 
                                 />
                              </div>

                              <!-- Dropdown to Select Description -->
                              <div>
                                 <label for="description">Select Measurement</label>
                                 <select 
                                    name="description" 
                                    id="description" 
                                    class="form-control" 
                                    onchange="toggleFeetInches(this.value)">
                                    <option value="CM" {{ $user->description == 'CM' ? 'selected' : '' }}>CM</option>
                                    <option value="Feet" {{ $user->description == 'Feet' ? 'selected' : '' }}>Feet/Inches</option>
                                 </select>
                              </div>
                           </div>

                        </div>
                     <div class="col-md-6 d-none">
                        <label for="country_of_birth" class="form-label">Country of Birth</label>
                        <select class="form-control" id="country_of_birth" name="country_of_birth" >
                           <option>Select Countries...</option>
                           @foreach($countries as $code => $country)
                           <option value="{{ $country['name'] }}" data-code="{{ $country['code'] }}" {{ $user->country_of_birth == $country['name'] ? 'selected' : '' }}>{{ $country['name'] }}</option>
                           @endforeach
                           <!-- Add more countries here -->
                        </select>
                     </div>
                     <div class="col-md-6 d-none">
                        <label for="languages" class="form-label">Which languages do you speak</label>
                        <select class="form-control" id="languages" name="languages">
                           <option value="English" {{ $user->languages == 'English' ? 'selected' : '' }}>English</option>
                           <option value="Spanish" {{ $user->languages == 'Spanish' ? 'selected' : '' }}>Spanish</option>
                           <option value="French" {{ $user->languages == 'French' ? 'selected' : '' }}>French</option>
                           <!-- Add more languages here -->
                        </select>
                     </div>
                     <div class="col-md-6 d-none">
                        <label for="other_nationality" class="form-label">Do you hold any other nationality?</label>
                        <select class="form-control" id="other_nationality" name="other_nationality" onchange="toggleCountryInput()" >
                        <option value="None" {{ $user->other_nationality == 'None' ? 'selected' : '' }}>None</option>
                        <option value="Dual" {{ $user->other_nationality == 'Dual' ? 'selected' : '' }}>Yes, I have dual nationality</option>
                        </select>
                     </div>
                     <div class="col-md-6 d-none">
                        <label for="other_nationality" class="form-label">Where do you live? </label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Where do you live?" value="{{ old('location', $user->location) }}" >
                     </div>
                     <div class="col-md-6 d-none" id="country_input_div" style="{{ $user->other_nationality == 'Dual' ? 'display:block' : 'display:none' }}">
                        <label for="other_nationality_country" class="form-label">Please specify the country</label>
                        <select class="form-control" id="other_nationality_country" name="other_nationality_country">
                           <option>Select country name</option>
                           @foreach($countries as $code => $country)
                           <option value="{{ $country['name'] }}" data-code="{{ $country['code'] }}" {{ $user->other_nationality_country == $country['name'] ? 'selected' : '' }}>{{ $country['name'] }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               <!-- Interests and Preferences -->
               <div class="form-section d-none">
                  <h5 class="heading_title"><strong>Interests and Preferences</strong></h5>
                  <div class="row g-3">
                     <div class="col-md-6">
                        <label for="interested_in" class="form-label">Interest</label>
                        <select class="form-control" id="interested_in" name="interested_in" >
                        <option value="Male" {{ $user->interested_in == 'Male' ? 'selected' : '' }}>Male interested in Women</option>
                        <option value="Female" {{ $user->interested_in == 'Female' ? 'selected' : '' }}>Female interested in Men</option>
                        <option value="LGBTIQ+" {{ $user->interested_in == 'LGBTIQ+' ? 'selected' : '' }}>LGBTIQ+</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <label for="form_which_countries" class="form-label">From which countries do you want to meet people?</label>
                        <select class="form-control" id="form_which_countries" name="form_which_countries">
                           <option>Select Countries...</option>
                           @foreach($countries as $code => $country)
                           <option value="{{ $country['name'] }}" data-code="{{ $country['code'] }}" {{ $user->form_which_countries == $country['name'] ? 'selected' : '' }}>{{ $country['name'] }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="col-md-6">
                        <label for="internal-attraction" class="form-label">What Do You Find Internally Attractive About Someone?</label>
                        <textarea class="form-control" id="internal-attraction" name="find_internally_attractive" rows="3" placeholder="Write your thoughts...">{{ old('find_internally_attractive', $user->find_internally_attractive ?? '') }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="form-section d-none">
                  <h5 class="heading_title"><strong>Academic and Job details </strong></h5>
                  <!-- Academic Level -->
                  <div class="row g-3">
                     <div class="col-md-6">
                        <label for="academic_level" class="form-label">Academic Level</label>
                        <select class="form-control" id="academic_level" name="academic_level">
                           <option value="">Select your academic level</option>
                           <option value="No formal education" {{ $user->academic_level == 'No formal education' ? 'selected' : '' }}>No formal education</option>
                           <option value="Professional degree" {{ $user->academic_level == 'Professional degree' ? 'selected' : '' }}>Professional degree</option>
                           <option value="Especialized degree" {{ $user->academic_level == 'Especialized degree' ? 'selected' : '' }}>Especialized degree</option>
                           <option value="Master’s degree" {{ $user->academic_level == 'Master’s degree' ? 'selected' : '' }}>Master’s degree</option>
                           <option value="PhD" {{ $user->academic_level == 'PhD' ? 'selected' : '' }}>PhD</option>
                        </select>
                     </div>
                     <!-- Children -->
                     <div class="col-md-6">
                        <label for="children" class="form-label">Children</label>
                        <select class="form-control" id="children" name="children">
                           <option value="">Do you have children?</option>
                           <option value="I HAVE" {{ $user->children == 'I HAVE' ? 'selected' : '' }}>I HAVE</option>
                           <option value="I DON’T HAVE" {{ $user->children == 'I DON’T HAVE' ? 'selected' : '' }}>I DON’T HAVE</option>
                        </select>
                     </div>
                     <!-- Children Details (Shown only if "I HAVE" is selected) -->
                     <div class="col-md-6 d-none" id="children_details">
                        <label for="children_age" class="form-label">How many and their ages</label>
                        <textarea class="form-control" id="children_age" name="children_age" rows="2" placeholder="Enter details about your children">{{ old('children_age', $user->children_age ?? '') }}</textarea>
                     </div>
                     <!-- Preferences if "I DON’T HAVE" is selected -->
                     <div class="col-md-6 d-none" id="children_preferences">
                        <label for="children_ifnot_region" class="form-label">If you don't have children, what are your thoughts?</label>
                        <select class="form-control" id="children_ifnot_region" name="children_ifnot_region">
                           <option value="">Choose your preference</option>
                           <option value="I don’t want" {{ $user->interested_in == 'I don’t want' ? 'selected' : '' }}>I don’t want</option>
                           <option value="I want" {{ $user->interested_in == 'I want' ? 'selected' : '' }}>I want</option>
                           <option value="I want, but not yet" {{ $user->interested_in == 'I want, but not yet' ? 'selected' : '' }}>I want, but not yet</option>
                           <option value="I’m not sure yet" {{ $user->interested_in == 'I’m not sure yet' ? 'selected' : '' }}>I’m not sure yet</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <label for="industry_you_work" class="form-label">Industry You Work In</label>
                        <select class="form-control" id="industry_you_work" name="industry_you_work">
                        <option value="" {{ $user->industry_you_work == '' ? 'selected' : '' }}>Select your industry</option>
                        <option value="Private and Public Administration - Control and Audits - Documentation" {{ $user->industry_you_work == 'Private and Public Administration - Control and Audits - Documentation' ? 'selected' : '' }}> Private and Public Administration - Control and Audits - Documentation
                        </option>
                        <option value="Food and Beverages - Culinary Arts" {{ $user->industry_you_work == 'Food and Beverages - Culinary Arts' ? 'selected' : '' }}> Food and Beverages - Culinary Arts
                        </option>
                        <option value="Arts, Architecture, Music, Design, and Fashion" {{ $user->industry_you_work == 'Arts, Architecture, Music, Design, and Fashion' ? 'selected' : '' }}> Arts, Architecture, Music, Design, and Fashion
                        </option>
                        <option value="Commerce - Marketing and Advertising" {{ $user->industry_you_work == 'Commerce - Marketing and Advertising' ? 'selected' : '' }}> Commerce - Marketing and Advertising
                        </option>
                        <option value="Social Communication, Journalism, Languages, and Related Fields" {{ $user->industry_you_work == 'Social Communication, Journalism, Languages, and Related Fields' ? 'selected' : '' }}> Social Communication, Journalism, Languages, and Related Fields
                        </option>
                        <option value="Defense, Security, and Control" {{ $user->industry_you_work == 'Defense, Security, and Control' ? 'selected' : '' }}> Defense, Security, and Control
                        </option>
                        <option value="Sports, Wellness, Entertainment, and Tourism" {{ $user->industry_you_work == 'Sports, Wellness, Entertainment, and Tourism' ? 'selected' : '' }}> Sports, Wellness, Entertainment, and Tourism
                        </option>
                        <option value="Law, Political Science, Public and International Relations, and Related Fields" {{ $user->industry_you_work == 'Law, Political Science, Public and International Relations, and Related Fields' ? 'selected' : '' }}> Law, Political Science, Public and International Relations, and Related Fields
                        </option>
                        <option value="Education - Training - Coaching" {{ $user->industry_you_work == 'Education - Training - Coaching' ? 'selected' : '' }}> Education - Training - Coaching
                        </option>
                        <option value="Finance, Economics, Statistics - Accounting, Mathematics, and Related Fields" {{ $user->industry_you_work == 'Finance, Economics, Statistics - Accounting, Mathematics, and Related Fields' ? 'selected' : '' }}> Finance, Economics, Statistics - Accounting, Mathematics, and Related Fields
                        </option>
                        <option value="Engineering" {{ $user->industry_you_work == 'Engineering' ? 'selected' : '' }}> Engineering
                        </option>
                        <option value="Manual Labor - Construction, Manufacturing, Maintenance" {{ $user->industry_you_work == 'Manual Labor - Construction, Manufacturing, Maintenance' ? 'selected' : '' }}> Manual Labor - Construction, Manufacturing, Maintenance
                        </option>
                        <option value="Health Sciences, Nutrition, and Aesthetics" {{ $user->industry_you_work == 'Health Sciences, Nutrition, and Aesthetics' ? 'selected' : '' }}> Health Sciences, Nutrition, and Aesthetics
                        </option>
                        <option value="Psychology, Human Resources, and Mental Health" {{ $user->industry_you_work == 'Psychology, Human Resources, and Mental Health' ? 'selected' : '' }}> Psychology, Human Resources, and Mental Health
                        </option>
                        <option value="Service and Customer Interaction" {{ $user->industry_you_work == 'Service and Customer Interaction' ? 'selected' : '' }}> Service and Customer Interaction
                        </option>
                        <option value="Assistance in Health and Therapeutic Care" {{ $user->industry_you_work == 'Assistance in Health and Therapeutic Care' ? 'selected' : '' }}> Assistance in Health and Therapeutic Care
                        </option>
                        <option value="Various Services" {{ $user->industry_you_work == 'Various Services' ? 'selected' : '' }}> Various Services
                        </option>
                        <option value="Software and Hardware Technologies" {{ $user->industry_you_work == 'Software and Hardware Technologies' ? 'selected' : '' }}> Software and Hardware Technologies
                        </option>
                        <option value="Social Work, Sociology, Theology, Counseling, Philanthropy, and Volunteering" {{ $user->industry_you_work == 'Social Work, Sociology, Theology, Counseling, Philanthropy, and Volunteering' ? 'selected' : '' }}> Social Work, Sociology, Theology, Counseling, Philanthropy, and Volunteering
                        </option>
                        <option value="Transportation" {{ $user->industry_you_work == 'Transportation' ? 'selected' : '' }}> Transportation
                        </option>
                        <option value="Animal Health" {{ $user->industry_you_work == 'Animal Health' ? 'selected' : '' }}> Animal Health
                        </option>
                        </select>
                     </div>
                     <!-- Travel Frequency -->
                     <div class="col-md-6">
                        <label for="travel_frecuency" class="form-label">Travel Frequency</label>
                        <select class="form-control" id="travel_frecuency" name="travel_frecuency" >
                           <option value="">Select travel frequency</option>
                           <option value="frequent" {{ $user->travel_frecuency == 'frequent' ? 'selected' : '' }}>I travel with frequency</option>
                           <option value="occasional" {{ $user->travel_frecuency == 'occasional' ? 'selected' : '' }}>I travel occasionally</option>
                           <option value="vacations" {{ $user->travel_frecuency == 'vacations' ? 'selected' : '' }}>I travel during part of my free time and vacations</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <label for="about_your_job" class="form-label">What do you enjoy most about your job?</label>
                        <textarea class="form-control" id="about_your_job" name="about_your_job" rows="3" placeholder="Write here...">{{ old('about_your_job', $user->about_your_job ?? '') }}</textarea>
                     </div>
                     <!-- Music Genres -->
                     <div class="col-md-6">
                        <label for="music-genres" class="form-label">Music Genres</label>
                        <textarea class="form-control" id="music-genres" name="music_genres" rows="3" placeholder="List your favorite music genres...">{{ old('music_genres', $user->music_genres ?? '') }}</textarea>
                     </div>
                     <!-- What Relaxes You -->
                     <div class="col-md-6">
                        <label for="age-range" class="form-label">Preferred Age Range</label>
                        <div class="row">
                           <div class="col-md-6">
                              <input type="number" class="form-control" id="age-range-1" name="interested_min_age_range" placeholder="Minimum Age"  value="{{ old('interested_min_age_range', $user->interested_min_age_range ?? '') }}">
                           </div>
                           <div class="col-md-6">
                              <input type="number" class="form-control" id="age-range-2" name="interested_max_age_range" placeholder="Maximum Age"  value="{{ old('interested_max_age_range', $user->interested_max_age_range ?? '') }}">
                           </div>
                        </div>
                     </div>
                     <!-- Preferred Age Range -->
                  </div>
               </div>
               <div class="form-section d-none">
                  <h5 class="heading_title"><strong>Family and other one for Habits</strong></h5>
                  <!-- Academic Level -->
                  <div class="row g-3">
                     <!-- Alcohol -->
                     <div class="col-md-6">
                        <label for="alcohol" class="form-label">Alcohol Consumption</label>
                        <select class="form-control" id="alcohol" name="alcohol" >
                           <option value="">Select an option</option>
                           <option value="never" {{ $user->alcohol == 'never' ? 'selected' : '' }}>I never drink</option>
                           <option value="daily" {{ $user->alcohol == 'daily' ? 'selected' : '' }}>I drink daily</option>
                           <option value="weekends" {{ $user->alcohol == 'weekends' ? 'selected' : '' }}>I drink on weekends</option>
                           <option value="occasionally" {{ $user->alcohol == 'occasionally' ? 'selected' : '' }}>I occasionally drink</option>
                        </select>
                     </div>
                     <!-- Smoking -->
                     <div class="col-md-6">
                        <label for="smoke" class="form-label">Smoking Habits</label>
                        <select class="form-control" id="smoke" name="smoke" >
                           <option value="">Select an option</option>
                           <option value="never" {{ $user->smoke == 'never' ? 'selected' : '' }}>I never smoke</option>
                           <option value="daily" {{ $user->smoke == 'daily' ? 'selected' : '' }}>I smoke daily</option>
                           <option value="occasionally" {{ $user->smoke == 'occasionally' ? 'selected' : '' }}>I occasionally smoke</option>
                           <option value="quitting" {{ $user->smoke == 'quitting' ? 'selected' : '' }}>I’m quitting smoking</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <label for="social_cause" class="form-label">Do you have a social cause that inspires you?</label>
                        <textarea class="form-control" id="social_cause" name="social_cause" rows="3" placeholder="Describe your cause">{{ old('social_cause', $user->social_cause ?? '') }}</textarea>
                     </div>
                     <div class="col-md-6">
                        <label for="follow_any_religion" class="form-label">Do you follow any religion or have specific beliefs?</label>
                        <textarea class="form-control" id="follow_any_religion" name="follow_any_religion" rows="3" placeholder="Do you follow any religion...">{{ old('follow_any_religion', $user->follow_any_religion ?? '') }}</textarea>
                     </div>
                     <!-- Work Out -->
                     <div class="col-md-6">
                        <label for="work-out" class="form-label">Work Out Habits</label>
                        <select class="form-control" id="work-out" name="work_out" >
                           <option value="">Select an option</option>
                           <option value="never" {{ $user->work_out == 'never' ? 'selected' : '' }}>I never work out</option>
                           <option value="daily" {{ $user->work_out == 'daily' ? 'selected' : '' }}>I work out daily</option>
                           <option value="often" {{ $user->work_out == 'often' ? 'selected' : '' }}>I work out often</option>
                           <option value="sometimes" {{ $user->work_out == 'sometimes' ? 'selected' : '' }}>I work out sometimes</option>
                        </select>
                     </div>
                  </div>
               </div>
               <!-- This information makes your profile more authentic -->
               <div class="form-section d-none">
                  <h5 class="heading_title"><strong>This information makes your profile more authentic</strong></h5>
                  <div class="row">
                     <div class="col-md-6">
                        <label for="what_relaxes_you" class="form-label">What Relaxes You?</label>
                        <textarea class="form-control" id="what_relaxes_you" name="what_relaxes_you" rows="3" placeholder="Write here...">{{ old('what_relaxes_you', $user->what_relaxes_you ?? '') }}</textarea>
                     </div>
                     <div class="col-md-6">
                        <label for="internal-attraction" class="form-label">What Do You Find Internally Attractive About Someone?</label>
                        <textarea class="form-control" id="internal-attraction" name="find_internally_attractive" rows="3" placeholder="Write your thoughts...">{{ old('find_internally_attractive', $user->find_internally_attractive ?? '') }}</textarea>
                     </div>
                     <div class="col-md-6">
                        <label for="life_in_general" class="form-label">How would you describe this stage of your life in general?</label>
                        <textarea class="form-control" id="life_in_general" name="life_in_general" rows="3" placeholder="Share a few words about your life">{{ old('life_in_general', $user->life_in_general ?? '') }}</textarea>
                     </div>
                     <div class="col-md-6">
                        <label for="conversational_style" class="form-label">How would you describe your conversational style? </label>
                        <textarea class="form-control" id="conversational_style" name="conversational_style" rows="3" placeholder="How would you describe your conversational style?">{{ old('conversational_style', $user->conversational_style ?? '') }}</textarea>
                     </div>
                     <div class="col-md-6">
                        <label for="what_qualities" class="form-label">Which qualities best describes you in a relationship?</label>
                        <textarea class="form-control" id="what_qualities" name="what_qualities" rows="3" placeholder="Enter your answer here">{{ old('what_qualities', $user->what_qualities ?? '') }}</textarea>
                     </div>
                     <div class="col-md-6">
                        <label for="hobbies" class="form-label">How would you describe your lifestyle? </label>
                        <textarea class="form-control" id="describe_your_lifestyle" name="describe_your_lifestyle" rows="3" placeholder="Enter your hobbies">{{ old('describe_your_lifestyle', $user->describe_your_lifestyle ?? '') }}</textarea>
                     </div>
                     <div class="col-md-6">
                        <label for="what-makes-you-laugh" class="form-label">What Makes You Laugh?</label>
                        <textarea class="form-control" id="what-makes-you-laugh" name="you_laugh" rows="3" placeholder="Describe what makes you laugh...">{{ old('you_laugh', $user->you_laugh ?? '') }}</textarea>
                     </div>
                  </div>
               </div>
               <!-- Submit Button -->
               <hr>
               <div class="text-center">
                  <button type="submit" class="btn btn-danger btn-lg">Save Profile</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@csrf
<script>
    function toggleFeetInches(value) {
        const cmSection = document.querySelector('[for="height"]').parentNode;
        const feetSection = document.querySelector('[for="feet"]').parentNode;
        const inchesSection = document.querySelector('[for="inches"]').parentNode;

        const heightInput = document.getElementById('height');
        const feetInput = document.getElementById('feet');
        const inchesInput = document.getElementById('inches');

        if (value === 'Feet') {
        // Toggle visibility
        cmSection.style.display = 'none';
        feetSection.style.display = 'block';
        inchesSection.style.display = 'block';

        // Update validation rules
        heightInput.removeAttribute('');
        feetInput.setAttribute('', '');
        inchesInput.setAttribute('', '');

        // Add ARIA attributes
        cmSection.setAttribute('aria-hidden', 'true');
        feetSection.setAttribute('aria-hidden', 'false');
        inchesSection.setAttribute('aria-hidden', 'false');
        } else {
        // Toggle visibility
        cmSection.style.display = 'block';
        feetSection.style.display = 'none';
        inchesSection.style.display = 'none';

        // Update validation rules
        heightInput.setAttribute('', '');
        feetInput.removeAttribute('');
        inchesInput.removeAttribute('');

        // Add ARIA attributes
        cmSection.setAttribute('aria-hidden', 'false');
        feetSection.setAttribute('aria-hidden', 'true');
        inchesSection.setAttribute('aria-hidden', 'true');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
         const dropdown = document.getElementById('description');
         toggleFeetInches(dropdown.value);

         dropdown.addEventListener('change', (e) => toggleFeetInches(e.target.value));
      });

      
    function previewImage() {
        let formData = new FormData();
        let fileInput = document.getElementById("profile_picture");

        if (fileInput.files.length === 0) {
            alert("Please select an image to upload.");
            return;
        }

        formData.append("profile_picture", fileInput.files[0]);

        $.ajax({
            url: "{{ route('admin.upload.profile.picture') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                if (response.success) {
                    $('#imageLoad1').attr('src', response.image_url + '?t=' + new Date().getTime());
                }
            },
            error: function () {
                alert("An error occurred while uploading the image.");
            }
        });
    }

</script> 
@endsection