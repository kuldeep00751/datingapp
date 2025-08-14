<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerifyEmail;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\MeetingResponse;
use Carbon\Carbon;
use App\Models\LegalContent;
use Illuminate\Support\Facades\App;



class UpdateUserProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        
        /** @var User $user */
        if(Auth::check())
        {
            $user = auth()->user();

            try { 
                // Validation
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'interested_in' => 'required|string',
                    'interested_min_age_range' => 'required|integer|min:18|max:100',
                    'interested_max_age_range' => 'required|integer|min:18|max:100',
                    'height_preference' => 'required',
                    // 'working_status' => 'required',
                    'like_to_be_called' => 'required|string|max:255',
                    'phone' => 'required|max:20',
                    'birthday' => [
                        'required',
                        'date',
                        'before:' . now()->subYears(18)->format('Y-m-d'),
                    ],
                    'languages' => 'required|array',
                    'country_of_birth' => 'required|string|max:50',
                    'other_nationality' => 'required|string|max:50',
                    'academic_level' => 'required|string|max:50',
                    'children' => 'required',
                    'music_genres' => 'required|string|max:100',
                    'alcohol' => 'required',
                    'smoke' => 'required|in:never,occasionally,daily,quitting',
                    'comment_smoke' => 'required_unless:smoke,never',
                    'work_out' => 'required',
                    'usually_eat' =>'required|string|min:20|max:100',
                    'what_relaxes_you' => 'required|string|min:100|max:150',
                    'social_cause' => 'required|string|max:50',
                    'you_laugh' => 'required|string|min:100|max:150',
                    'what_qualities' => 'required|string|min:100|max:150',
                    'about_your_job'  =>'required|string|min:0|max:150',
                    'describe_your_lifestyle' => 'required|string|min:100|max:150',
                    'life_in_general' => 'required|string|min:100|max:150',
                    // 'form_which_countries' => 'required',
                    'follow_any_religion' => 'required|string|max:50',
                    'find_internally_attractive' => 'required|string|min:0|max:150',
                    'conversational_style' => 'required|string|min:100|max:150',
                    // 'company_country' => 'required|string|max:50',
                    'profile_picture.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
                    'travel_frecuency' => 'required',
                    'pets' => 'required',
                    'industry_you_work' => 'required',
                    'res_city' => 'required',
                    'res_state' => 'required',
                    'res_country' => 'required',
                ],
                [
                    'birthday.before' => __('controllerText.UpdateUserProfileController_1'),
                ]);
            
                // Handle Profile Picture
                if ($request->hasFile('profile_picture')) {
                    $faker = Faker::create();
            
                    // Remove old pictures for the user
                    //DB::table('pictures')->where('user_id', $user->id)->delete();
            
                    $updatedProfilePicturePath = null;
            
                    foreach ($request->file('profile_picture') as $key => $file) {
                        $filePath = $file->store('profilePictures', 'public');
            
                        DB::table('pictures')->insert([
                            'user_id' => $user->id,
                            'name' => $faker->firstName,
                            'picture_location' => $filePath,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
            
                        // Set the first image as profile picture
                        if ($key === 0) {
                            $updatedProfilePicturePath = $filePath;
                        }
                    }
            
                    // Update profile picture
                    if ($updatedProfilePicturePath) {
                        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                            //Storage::disk('public')->delete($user->profile_picture);
                        }
            
                        $user->update([
                            'profile_picture' => $updatedProfilePicturePath,
                        ]);
                    }
                }
            
                // Handle Other Nationality
                $otherNationalityCountry = $request->get('other_nationality') === 'Dual' 
                    ? $request->get('other_nationality_country') 
                    : null;

                $interested_preference = in_array($request->get('interested_in'), ['Male-Male', 'Female-Female'])
                ? $request->get('interested_preference')
                : null;


                $ip_address=$request->ip();

                if ($request->get('description') == "CM") {
                    $heightInCm = $request->get('height'); 
                    $heightInFeet = intval($heightInCm / 30.48); 
                    $heightInInches = intval(($heightInCm / 2.54) % 12); 

                    $height = $heightInCm;
                    $feet = $heightInFeet;
                    $inches = $heightInInches;

                }elseif($request->get('description') == "Feet") {
                    $feet = intval($request->get('feet'));
                    $inches = intval($request->get('inches')); 
                    $totalInches = ($feet * 12) + $inches;
                    $heightInCm = $totalInches * 2.54;
                    $height = number_format($heightInCm, 2);

                    $height = $height;
                    $feet = $feet;
                    $inches = $inches;

                }else{
                    $height = $request->get('height') ?? '';
                    $feet = $request->get('feet') ?? '';
                    $inches = $request->get('inches') ?? '';
                }

                $isSubscribe = $request->has('is_subscribed') =="on" ? 1 : 0;
                
                $is_lock_location = $request->get('is_lock_location') == "1" ? 1 : 0;
                
                // Update User Data
                $user->update([
                    'name' => $request->get('name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'interested_in' => $request->get('interested_in'),
                    'interested_preference'=> $interested_preference,
                    'interested_min_age_range' => $request->get('interested_min_age_range'),
                    'interested_max_age_range' => $request->get('interested_max_age_range'),
                    'height_preference' => $request->get('height_preference'),
                    'working_status' => $request->get('working_status') ?? null,
                    'like_to_be_called' =>ucfirst(strtolower($request->get('like_to_be_called'))),
                    'phone' => $request->get('phone'),
                    'about_your_job' => $request->get('about_your_job'),
                    'dialCode' => $request->get('dialCode'),
                    'activePassive' => $request->get('activePassive'),
                    'birthday' => $request->get('birthday'),
                    'languages' => json_encode($request->get('languages')), // Store as JSON
                    'height' => $height,
                    'feet' => $feet,
                    'inches' => $inches,
                    'description' => $request->get('description'),
                    'country_of_birth' => $request->get('country_of_birth'),
                    'other_nationality' => $request->get('other_nationality'),
                    'other_nationality_country' => $otherNationalityCountry,
                    'academic_level' => $request->get('academic_level'),
                    'children' => $request->get('children'),
                    'travel_frecuency' => $request->get('travel_frecuency'),
                    'children_have_many' => $request->get('children_have_many'),
                    'children_age' => $request->get('children_age'),
                    'music_genres' => $request->get('music_genres'),
                    'alcohol' => $request->get('alcohol'),
                    'smoke' => $request->get('smoke'),
                    'comment_smoke' => $request->get('comment_smoke'),
                    'industry_you_work' => $request->get('industry_you_work'),
                    'work_out' => $request->get('work_out'),
                    'comment_workout' => $request->get('comment_workout'),
                    'usually_eat' => $request->get('usually_eat'),
                    'what_relaxes_you' => $request->get('what_relaxes_you'),
                    'social_cause' => $request->get('social_cause'),
                    'you_laugh' => $request->get('you_laugh'),
                    'what_qualities' => $request->get('what_qualities'),
                    'describe_your_lifestyle' => $request->get('describe_your_lifestyle'),
                    'life_in_general' => $request->get('life_in_general'),
                    'form_which_countries' => $request->get('form_which_countries') ?? null,
                    'follow_any_religion' => $request->get('follow_any_religion'),
                    'find_internally_attractive' => $request->get('find_internally_attractive'),
                    'company_country' => $request->get('company_country')  ?? null,
                    'conversational_style' => $request->get('conversational_style'),
                    'company_id' => $request->get('company_id')  ?? null,
                    'radius' => $request->get('radius'),
                    'other_languages' => $request->get('other_languages') ?? null,
                    'pets' => $request->get('pets'),
                    'preferences' => $request->get('preferences') ?? null,
                    'ip_address' => $ip_address,
                    'res_country' => $request->get('res_country'),
                    'res_state' => $request->get('res_state'),
                    'res_city' => $request->get('res_city'),
                    'is_subscribed' =>  $isSubscribe,
                    'is_lock_location' =>$is_lock_location,
                ]);

                $datalocation = [];
               
                if ($is_lock_location == 0) {
                    
                    $datalocation['location'] = $request->get('location');
                    $datalocation['latitude'] = $request->get('latitude');
                    $datalocation['longitude'] = $request->get('longitude');
                    $user->update($datalocation);
                }
                
                    $user = auth()->user();
                    $countvalue=1;
                    $updatedFields = [
                        'name' => $user->name,
                        'last_name' => $user->last_name,  
                        // 'location' => $user->location,
                        'interested_in' => $user->interested_in,
                        'interested_min_age_range' => $user->interested_min_age_range,
                        'interested_max_age_range' => $user->interested_max_age_range,
                        'height_preference' => $user->height_preference,
                        // 'working_status' => $user->working_status,
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
                        'usually_eat' => $user->usually_eat,
                        'what_relaxes_you' => $user->what_relaxes_you,
                        'social_cause' => $user->social_cause,
                        'you_laugh' => $user->you_laugh,
                        'what_qualities' => $user->what_qualities,
                        'describe_your_lifestyle' => $user->describe_your_lifestyle,
                        'life_in_general' => $user->life_in_general,
                        // 'form_which_countries' => $user->form_which_countries,
                        'follow_any_religion' => $user->follow_any_religion,
                        'find_internally_attractive' => $user->find_internally_attractive,
                        // 'company_country' => $user->company_country,
                        'res_country' => $user->res_country,
                        'res_state' => $user->res_state,
                        'res_city' => $user->res_city,
                        ];
                        $nonEmptyFields = array_filter($updatedFields, function($value) {
                        return empty($value);
                    });

                    if(count($nonEmptyFields)==0 && ($user->verificationOption=='' || $user->verificationOption==null))
                    {
                        $countvalue=0;
                        
                    }
                
                // Success Response
                return response()->json(['message' => __('controllerText.UpdateUserProfileController_2'),'countvalue' => $countvalue,'userId' => $user->id]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Return validation errors
                return response()->json([
                    'message' => __('controllerText.UpdateUserProfileController_3'),
                    'errors' => $e->errors(), // Errors as key-value pairs
                ], 422);
            } catch (\Exception $e) {
                // Handle unexpected errors
                return response()->json([
                    'message' => __('controllerText.UpdateUserProfileController_4'),
                    'error' => $e->getMessage(),
                ], 500);
            }
        }else{
            return response()->json([
                'message' => __('controllerText.UpdateUserProfileController_5'),
            ], 412);
        }
    }
    

    public function updateInstruction(Request $request)
    {
        $user = Auth::user();

        $user->provide_proof = $request->has('provide_proof') ? 1 : 0;
        $user->is_single = $request->has('is_single') ? 1 : 0;
        $user->is_enjoy = $request->has('is_enjoy') ? 1 : 0;
        $user->is_take_care = $request->has('is_take_care') ? 1 : 0;
        $user->is_meet_people = $request->has('is_meet_people') ? 1 : 0;
        $user->is_understand_platform = $request->has('is_understand_platform') ? 1 : 0;
        $user->is_term_condition = $request->has('is_term_condition') ? 1 : 0;

        $user->save();

        return redirect('/profile');
    }


    public function uploadPicture(Request $request){
        
        $user = auth()->user();

        $image = $request->input('croppedImage');
       
        if (!$image) {
            return response()->json(['success' => false, 'message' => __('controllerText.UpdateUserProfileController_6')]);
        }
    
        // Remove base64 prefix
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
    
        // Generate unique name
        $imageName = uniqid() . '.jpg';
    
        // Decode the image data
        $imageData = base64_decode($image);
        
        $imaged = ImageManager::imagick()->read($imageData);
        // $imaged->place(public_path('LOGOwhiteTSBshadow.png'), 'bottom-right', 2, 2);
        $filePath = 'profilePictures/' . $imageName;
        $imaged->save(storage_path('app/public/' .$filePath));
        
        DB::table('pictures')->insert([
            'user_id' => $user->id,
            'name' => $imageName,
            'picture_location' => $filePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        if (!$user->profile_picture) {
            $user->update([
                'profile_picture' => $filePath,
            ]);
        }
    
        $feedbacks = getUserFeedback($user->id);
        $feedbackExit = ($feedbacks['feedbackAverages']['photogenic_avg']) ?? 0;
        
        if($feedbackExit > 0){
            Feedback::where('like_user_id', $user->id)
            ->update(['photogenic' => 0]);
        }

        return response()->json(['success' => true, 'message' => __('controllerText.UpdateUserProfileController_7')]);
    



        if ($request->hasFile('profile_picture')) {
            $faker = \Faker\Factory::create();
            $updatedProfilePicturePath = null;
    
            foreach ($request->file('profile_picture') as $key => $file) {

                $fileName = time() . '_' . $file->getClientOriginalName();
                $image = ImageManager::imagick()->read($file);
                $image->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio(); 
                });
                // $image->place(public_path('silverbridge-300.png'), 'bottom-right', 2, 2);

                $filePath = 'profilePictures/' . $fileName;
                $image->save(storage_path('app/public/' .$filePath));

                // $filePath = $file->store('profilePictures', 'public');
    
                // Insert the uploaded file info into the database
                DB::table('pictures')->insert([
                    'user_id' => $user->id,
                    'name' => $faker->firstName,
                    'picture_location' => $filePath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    
                // Set the first image as profile picture
                if ($key === 0) {
                    $updatedProfilePicturePath = $filePath;
                }
            }
            // Update profile picture for the user
            if ($updatedProfilePicturePath) {
                // if ($user->profile_picture && \Storage::disk('public')->exists($user->profile_picture)) {
                //     \Storage::disk('public')->delete($user->profile_picture);
                // }
                
                if (!$user->profile_picture) {

                    $user->update([
                        'profile_picture' => $updatedProfilePicturePath,
                    ]);
                }
            }
    
            return response()->json(['success' => true, 'message' => __('controllerText.UpdateUserProfileController_7')]);
        }
    
        return response()->json(['success' => false, 'message' => __('controllerText.UpdateUserProfileController_8')]);
    }

    public function uploadCoverPicture(Request $request)
    {
        $request->validate([
            'cover_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        

        $file = $request->file('cover_picture');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $image = ImageManager::imagick()->read($file);
        // $image->resize(1098, 228);

        $image->resize(1098, 228, function ($constraint) {
            $constraint->aspectRatio();
        });

        $filePath = 'cover_img/' . $fileName;
        $image->save(storage_path('app/public/' .$filePath));
        
        // $filePath = $file->storeAs('cover_pictures', $image, 'public');

        

        // Update user record
        $user = auth()->user();
        $user->cover_picture =  $filePath;
        $user->save();

        return response()->json([
            'success' => true,
            'cover_picture_url' => asset('storage/' . $filePath),
        ]);
    }

    public function updateVerificationStatus(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'verificationOption' => 'required|string',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Process based on the selected verification option
        $verificationOption = $request->input('verificationOption');

        if ($verificationOption === 'email') {
            $emailId = $request->input('corporateEmail'); 
            if($user->is_subscribed == 1){
                Mail::to($emailId)->send(new SendVerifyEmail($user));
            }
            $user->update([
                'verificationOption' => $verificationOption,
                'corporate_email' => $emailId,
                'status' => 'pending',
                'last_Verify_reminder' =>Carbon::now()
            ]);
            return response()->json(['success' => true, 'message' => __('controllerText.UpdateUserProfileController_9'),'userId' => $user->id]);
        } elseif ($verificationOption === 'certificate') {
            $certificatePath = null;
            if ($request->hasFile('employmentCertificate')) {
                $file = $request->file('employmentCertificate');
                if ($file->isValid()) {
                    $certificatePath = $file->store('certificates', 'public');
                    $user->update([
                        'verificationOption' => $verificationOption,
                        'employmentCertificate' => $certificatePath,
                        'status' => 'pending',
                    ]);
                    return response()->json(['success' => true, 'message' => __('controllerText.UpdateUserProfileController_10'),'userId' => $user->id]);
                } else {
                    return response()->json(['success' => false, 'message' => __('controllerText.UpdateUserProfileController_11')]);
                }
            } else {
                return response()->json(['success' => false, 'message' => __('controllerText.UpdateUserProfileController_12')]);
            }
        
            return response()->json(['success' => true, 'message' => __('controllerText.UpdateUserProfileController_13') ,'userId' => $user->id]);
        } else {
            $user->update([
                'verificationOption' => $verificationOption,
                'status' => 'pending',
            ]);
            return response()->json(['success' => true, 'message' => __('controllerText.UpdateUserProfileController_14'),'userId' => $user->id]);
        }
    }


    public function verifyEmail($encodedUserId)
    {
        // Decode the user ID
        $userId = base64_decode($encodedUserId);

        // Find the user by ID
        $user = User::find($userId);

        if (!$user) {
            return redirect('/')->with('error', __('controllerText.UpdateUserProfileController_15'));
        }

        // Check if the email is already verified
        if ($user->email_verified_at) {
            return redirect('/')->with('success', __('controllerText.UpdateUserProfileController_16'));
        }

        // Update the user's email verification status
        $user->update([
            'corporate_email_status' => 1
            
        ]);

        return redirect('/')->with('success', __('controllerText.UpdateUserProfileController_17'));
    }

    public function delete(Request $request)
    {
        $user = auth()->user();
        $image = DB::table('pictures')->where('id', $request->id)->first();

        if ($image) 
        {
            $wasProfilePicture = $image->picture_location == $user->profile_picture;
            // if($image->picture_location == $user->profile_picture){
            //     $user->update([
            //         'profile_picture' => null,
            //     ]);
            // }

            Storage::disk('public')->delete($image->picture_location);
            DB::table('pictures')->where('id', $request->id)->delete();
            if ($wasProfilePicture) {
                $nextImage = DB::table('pictures')
                    ->where('user_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->first();

                $user->update([
                    'profile_picture' => $nextImage ? $nextImage->picture_location : null,
                ]);
            }
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => __('controllerText.UpdateUserProfileController_18')]);
    }
    
    public function setProfileImage(Request $request)
    {
        $request->validate([
            'image_id' => 'required|exists:pictures,id',
        ]);
    
        $image = DB::table('pictures')->where('id', $request->image_id)->first();

        if (!$image) {
            return response()->json(['success' => false, 'message' => __('controllerText.UpdateUserProfileController_18')], 404);
        }

        $user = auth()->user(); 

        $user->profile_picture = $image->picture_location; 
        $user->save();

        return response()->json(['success' => true, 'message' => __('controllerText.UpdateUserProfileController_19')]);
    }


    public function paymentnow(Request $request)
    {
        $planId = $request->id;
        return view('payment_now',compact('planId'));
    }

    public function accountrejected()
    {
        return view('account_rejected');
    }

    public function approvalpending()
    {
        $user = auth()->user();
        if(auth()->user()->status == "approved" && !activeSubscriptionCheck())
        {
            return redirect('payment-now');
        }
        return view('approval_pending');
    }

    
    public function getProfileStatus(): JsonResponse
    {
        $user = auth()->user();
        $profileStatus ="";
        // List of required fields for a complete profile
        $requiredFields = [
            'name' => $user->name,
            'last_name' => $user->last_name,
            'interested_in' => $user->interested_in,
            'interested_min_age_range' => $user->interested_min_age_range,
            'interested_max_age_range' => $user->interested_max_age_range,
            'height_preference' => $user->height_preference,
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
            'usually_eat' => $user->usually_eat,
            'what_relaxes_you' => $user->what_relaxes_you,
            'social_cause' => $user->social_cause,
            'you_laugh' => $user->you_laugh,
            'what_qualities' => $user->what_qualities,
            'describe_your_lifestyle' => $user->describe_your_lifestyle,
            'life_in_general' => $user->life_in_general,
            'follow_any_religion' => $user->follow_any_religion,
            'find_internally_attractive' => $user->find_internally_attractive,
            'res_country' => $user->res_country,
            'res_state' => $user->res_state,
            'res_city' => $user->res_city,
        ];

        // Count how many required fields are empty
        $incompleteFields = array_filter($requiredFields, function ($value) {
            return empty($value);
        });

        // Default status
        // $profileStatus = __('controllerText.UpdateUserProfileController_20_3');

        if (count($incompleteFields) > 0) {
            $profileStatus = __('controllerText.UpdateUserProfileController_20_1');
        } elseif (empty($user->verificationOption)) {
            $profileStatus = __('controllerText.UpdateUserProfileController_20_2');
        }

        if($profileStatus != ""){
            $profileUrl = route('profile.edit');
                return response()->json(['message' => '<a class="dropdown-item mt-1" href="' . $profileUrl . '">'.$profileStatus.'</a>']);
        }else{

            $profileStatusData = 0;
            $matchUserId = auth()->user()->match_user_id;

            if (is_array($matchUserId)) {
                $user_like = end($matchUserId);
            } else {
                $user_like = $matchUserId; 
            }

            $response = null;

            $feedbacks = Feedback::where('user_id', $user->id)
                        ->where('like_user_id',$user_like)
                        ->first();
            if ($user_like) {
                $response = MeetingResponse::where('user_id', $user->id)
                    ->where('user_like_id', $user_like)
                    ->first();
                
                $AFterUpdate = DB::table('user_likes')
                ->where('user_id', $user->id)
                ->where('liked_user_id', $user_like)
                ->first();

                $AnotherUserUpdate = DB::table('user_likes')
                ->where('user_id', $user_like)
                ->where('liked_user_id', $user->id)
                ->first();
                

                // $is_feedback_pending = false;
                // $is_comment_pending = false;

                // if(isset($AFterUpdate) && $AFterUpdate->affection == "exit"){
                //     $createdAt = Carbon::parse($AFterUpdate->created_at);
                //     $today = Carbon::now();

                //     $diffInDays = $createdAt->diffInDays($today) + 1;

                //     if($diffInDays > 0 && $diffInDays < 7){
                //         if($AFterUpdate->follow_up_status > 0){
                //             $is_feedback_pending = true;
                //             $is_comment_pending = false;
                //         }else{
                //             $is_feedback_pending = false;
                //             $is_comment_pending = true;
                //         }
                //     }
                // }
                $profileStatusData = 1;
            
            }

            if ($user->status === "pending" || $user->status === "" || $user->status === null) {
                $profileUrl = route('profile.edit');
                $profileStatusData = 1;
                return response()->json(['message' => '<a class="dropdown-item mt-1" href="' . $profileUrl . '">'.__('controllerText.UpdateUserProfileController_20').'<br>by The Silverbridge Team</a>']);
            }

            if ($user->status === "approved" && !activeSubscriptionCheck()) {
                $profileUrl = route('user.subscription.plans');
                $profileStatusData = 1;
                return response()->json(['message' => '<a class="dropdown-item mt-1" href="' . $profileUrl . '">'.__('controllerText.UpdateUserProfileController_21').'</a>']);
            }

            if (
                $user->status === "approved" &&
                activeSubscriptionCheck() &&
                $user->last_email_sent_at != null &&
                $user->is_hidden == 0
            ) {
                if ($user->exit_at != null && ($AFterUpdate->is_feedback_pending == 1)
                ) {
                    $profileUrl = route('meeting.showFeedbacks');
                    return response()->json(['message' => '<a class="dropdown-item mt-1" href="' . $profileUrl . '">'.__('controllerText.UpdateUserProfileController_22').'</a>']);
                }else{
                    $profileUrl = route('profile.edit');
                    return response()->json(['message' => '<a  class="dropdown-item mt-1" href="' . $profileUrl . '">'.__('controllerText.UpdateUserProfileController_23').'</a>']);
                } 
                $profileStatusData = 1;
            }

            if (
                $user->status === "approved" &&
                activeSubscriptionCheck() &&                       
                $user->last_email_sent_at !== null &&
                $user->is_hidden == 1 &&
                $AFterUpdate &&                                         
                $AFterUpdate->affection == "email" 
            ) {
                $profileUrl = route('users.show-user',$AFterUpdate->liked_user_id);

                $remainingDay = 5 - ($AFterUpdate->count_email);
                $profileStatusData = 1;
                return response()->json(['message' => '<a class="dropdown-item mt-1" href="' . $profileUrl . '">'.__('controllerText.UpdateUserProfileController_24').' (' . $remainingDay . ')</a>']);
            }


            if (
                $user->status === "approved" &&
                activeSubscriptionCheck() &&
                $user->last_email_sent_at !== null &&
                $user->is_hidden == 1 && $response && $response->is_feedback_pending ==1 && empty($feedbacks)
            ) {
                $profileUrl = route('meeting.showFeedbacks');
                $profileStatusData = 1;
                return response()->json(['message' => '<a class="dropdown-item mt-1" href="' . $profileUrl . '">'.__('controllerText.UpdateUserProfileController_22').'</a>']);
            }

            if($profileStatusData ==0){
                $profileUrl1 = route('profile.edit');
                return response()->json(['message' => '<a class="dropdown-item mt-1" href="' . $profileUrl1 . '">'.__('controllerText.UpdateUserProfileController_20_3').'</a>']);
            }
        }

    }

    public function privacy()
    {
        $locale = App::getLocale();

        $data = LegalContent::where('type', 'privacy')
                    ->where('locale', $locale)
                    ->first();

        return view('privacy_policy', compact('data'));
    }

    public function termCondition()
    {
        $locale = App::getLocale();

        $data = LegalContent::where('type', 'Terms&Condition')
                    ->where('locale', $locale)
                    ->first();

        return view('term_condition', compact('data'));
    }
}