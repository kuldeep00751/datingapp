<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use App\Models\Subscription;
use App\Mail\ExpireReminderEmail;
use Illuminate\Support\Facades\Mail;

class EditUserProfileController extends Controller
{
    public function __invoke()
    {
        
        $user = auth()->user();

        if(auth()->user()->status == "Pending" || auth()->user()->status == "pending")
        {
            return redirect('approve-pending');
        }
        
        elseif(auth()->user()->status == "rejected")
        {
            return redirect('account-rejected');
        }else{
            $countries=$this->showCountries();
            $pictures = $user->pictures()->latest()->get();

            $user = auth()->user();
            $countvalue=1;
            $updatedFields = [
                'name' => $user->name,
                'last_name' => $user->last_name,  
                'location' => $user->location,
                'interested_in' => $user->interested_in,
                'interested_min_age_range' => $user->interested_min_age_range,
                'interested_max_age_range' => $user->interested_max_age_range,
                'working_status' => $user->working_status,
                'like_to_be_called' => $user->like_to_be_called,
                'phone' => $user->phone,
                'birthday' => $user->birthday,
                'languages' => $user->languages,
                'description' => $user->description,
                'country_of_birth' => $user->country_of_birth,
                'other_nationality' => $user->other_nationality,
                'academic_level' => $user->academic_level,
                'children' => $user->children,
                'industry_you_work' => $user->industry_you_work,
                'conversational_style' => $user->conversational_style,
                'about_your_job' => $user->about_your_job,
                'travel_frecuency' => $user->travel_frecuency,
                'music_genres' => $user->music_genres,
                'alcohol' => $user->alcohol,
                'smoke' => $user->smoke,
                'work_out' => $user->work_out,
                'what_relaxes_you' => $user->what_relaxes_you,
                'social_cause' => $user->social_cause,
                'you_laugh' => $user->you_laugh,
                'what_qualities' => $user->what_qualities,
                'describe_your_lifestyle' => $user->describe_your_lifestyle,
                'life_in_general' => $user->life_in_general,
                'form_which_countries' => $user->form_which_countries,
                'follow_any_religion' => $user->follow_any_religion,
                'find_internally_attractive' => $user->find_internally_attractive,
                'company_country' => $user->company_country,
                ];
                $nonEmptyFields = array_filter($updatedFields, function($value) {
                return empty($value);
            });

            if(count($nonEmptyFields)==0 && ($user->verificationOption=='' || $user->verificationOption==null)){
                $countvalue = 0;
            }

            $resCountries =DB::table('countries')->get();

            return view('profile', [
                'user' => $user,
                'pictures' => $pictures,
                'countries' =>$countries,
                'resCountries' =>$resCountries,
                'countvalue' =>$countvalue
            ]);
        }
    }

    public function showCountries()
    {
        $countries = [ 'AF' => ['name' => 'Afghanistan', 'code' => '+93'], 'AL' => ['name' => 'Albania', 'code' => '+355'], 'DZ' => ['name' => 'Algeria', 'code' => '+213'], 'AD' => ['name' => 'Andorra', 'code' => '+376'], 'AO' => ['name' => 'Angola', 'code'
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
        ['name' => 'Zimbabwe', 'code' => '+263'] ]; // Extracting country names $countryNames = array_map(function($country) { return $country['name']; }, $countries); 

        return $countries;
    }

    public function getStates(Request $request)
    {
        // $resCountries =DB::table('countries')->where('name', $request->countryName)->where('id', $request->countryId)->first();
        $states = DB::table('states')->where('country_id', $request->countryId)->get();
        return response()->json($states);
    }

    public function getCities(Request $request)
    {
        // $states = DB::table('states')->where('name', $request->stateName)->where('id', $request->stateId)->first();
        $cities = DB::table('cities')->where('state_id',$request->stateId)->get();
        return response()->json($cities);
    }
}
