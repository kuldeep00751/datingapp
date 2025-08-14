<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Admin;
// use App\Rules\ReCaptcha;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class AdminProfileController extends Controller
{
    public function user_profile(){
        $page_title="Admin Profile";
        
        $user = Admin::find(auth()->guard('admin')->user()->id);
       
        return view('admin.users.profile',compact('user','page_title'));     
    }

    public function update_user_profile(Request $request)
    {
      
        // try {
            // $this->validate($request, [
            //     'first_name' => 'required',
            //     'email' => 'required|email|unique:admins,email,' . auth()->guard('admin')->user()->id,
            //     // 'password' => ['required', 'string', 'min:6',
            //     //     'regex:/^(?=.*[a-zA-Z\d])(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            //     //     'same:confirm-password',
            //     // ]
            // ]);  

            // $validated = $request->validate([
            //     'name' => 'required|string|max:255',
            //     'last_name' => 'required|string|max:255',
            //     'location' => 'required|string|max:255',
            //     'interested_in' => 'required|string',
            //     'interested_min_age_range' => 'required|integer|min:18|max:100',
            //     'interested_max_age_range' => 'required|integer|min:18|max:100',
            //     'height_preference' => 'required',
            //     'working_status' => 'required',
            //     'like_to_be_called' => 'required|string|max:255',
            //     'phone' => 'required|max:20',
            //     'birthday' => ['required','date','before:' . now()->subYears(18)->format('Y-m-d'),],
            //     'languages' => 'required',
            //     'languages.*' => 'string',
            //     'country_of_birth' => 'required|string|max:50',
            //     'other_nationality' => 'required|string|max:50',
            //     'academic_level' => 'required|string|max:50',
            //     'children' => 'required',
            //     'music_genres' => 'required|string|max:50',
            //     'alcohol' => 'required',
            //     'smoke' => 'required',
            //     'work_out' => 'required',
            //     'what_relaxes_you' => 'required|string|min:100|max:150',
            //     'social_cause' => 'required|string|max:50',
            //     'you_laugh' => 'required|string|min:100|max:150',
            //     'what_qualities' => 'required|string|min:100|max:150',
            //     'about_your_job'  =>'required|string|min:0|max:150',
            //     'describe_your_lifestyle' => 'required|string|min:100|max:150',
            //     'life_in_general' => 'required|string|min:100|max:150',
            //     'form_which_countries' => 'required',
            //     'follow_any_religion' => 'required|string|max:50',
            //     'find_internally_attractive' => 'required|string||min:0|max:50',
            //     'conversational_style' => 'required|string|min:100|max:150',
            //     'company_country' => 'required|string|max:50',
            //     'profile_picture.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // ],
            // [
            //     'birthday.before' => 'You must be at least 18 years old.',
            // ]);
           
            
            $user = Admin::find(auth()->guard('admin')->user()->id);
            
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

            // Update User Data
            $res = $user->update([
                'email' => $request->get('email'),
                // 'name' => $request->get('name'),
                // 'last_name' => $request->get('last_name'),
                // 'location' => $request->get('location'),
                // 'interested_in' => $request->get('interested_in'),
                // 'interested_preference'=> $interested_preference,
                // 'interested_min_age_range' => $request->get('interested_min_age_range'),
                // 'interested_max_age_range' => $request->get('interested_max_age_range'),
                // 'height_preference' => $request->get('height_preference'),
                // 'working_status' => $request->get('working_status'),
                // 'like_to_be_called' => $request->get('like_to_be_called'),
                // 'phone' => $request->get('phone'),
                // 'about_your_job' => $request->get('about_your_job'),
                // 'dialCode' => $request->get('dialCode'),
                // 'activePassive' => $request->get('activePassive'),
                // 'birthday' => $request->get('birthday'),
                // 'languages' => json_encode($request->get('languages')),
                // 'height' => $height,
                // 'feet' => $feet,
                // 'inches' => $inches,
                // 'description' => $request->get('description'),
                // 'country_of_birth' => $request->get('country_of_birth'),
                // 'other_nationality' => $request->get('other_nationality'),
                // 'other_nationality_country' => $otherNationalityCountry,
                // 'academic_level' => $request->get('academic_level'),
                // 'children' => $request->get('children'),
                // 'travel_frecuency' => $request->get('travel_frecuency'),
                // 'children_have_many' => $request->get('children_have_many'),
                // 'children_age' => $request->get('children_age'),
                // 'music_genres' => $request->get('music_genres'),
                // 'alcohol' => $request->get('alcohol'),
                // 'smoke' => $request->get('smoke'),
                // 'comment_smoke' => $request->get('comment_smoke'),
                // 'industry_you_work' => $request->get('industry_you_work'),
                // 'work_out' => $request->get('work_out'),
                // 'comment_workout' => $request->get('comment_workout'),
                // 'what_relaxes_you' => $request->get('what_relaxes_you'),
                // 'social_cause' => $request->get('social_cause'),
                // 'you_laugh' => $request->get('you_laugh'),
                // 'what_qualities' => $request->get('what_qualities'),
                // 'describe_your_lifestyle' => $request->get('describe_your_lifestyle'),
                // 'life_in_general' => $request->get('life_in_general'),
                // 'form_which_countries' => $request->get('form_which_countries'),
                // 'follow_any_religion' => $request->get('follow_any_religion'),
                // 'find_internally_attractive' => $request->get('find_internally_attractive'),
                // 'company_country' => $request->get('company_country'),
                // 'conversational_style' => $request->get('conversational_style'),
                // 'company_id' => $request->get('company_id'),
                // 'radius' => $request->get('radius'),
                // 'other_languages' => $request->get('other_languages'),
                // 'pets' => $request->get('pets'),
                // 'preferences' => $request->get('preferences'),
                'ip_address' => $ip_address,
                // 'latitude' => $request->get('latitude'),
                // 'longitude' => $request->get('longitude'),
                // 'res_country' => $request->get('res_country'),
                // 'res_state' => $request->get('res_state'),
                // 'res_city' => $request->get('res_city'),
                
            ]);
            
            $response = [
                'message' => 'Admin Profile updated successfully',
                'alert-type' => 'success'
            ];
        
            return redirect()->back()->with($response);
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     $errorMessages = $e->validator->errors()->all();
        //     $response = [
        //         'message' => implode(', ', $errorMessages),
        //         'alert-type' => 'error'
        //     ];
        
        //     return redirect()->back()->with($response);
        // }
        
       
            // $input = $request->only(['first_name', 'email']);
        
            // if ($request->filled('password')) {
            //     $input['password'] = Hash::make($request->input('password'));
            // }
        
            // $user = Admin::find(auth()->guard('admin')->user()->id);
            
            // $user->update($input);
           
            // if($user){
            //     $response = array(
            //         'message' => 'Profile updated successfully',
            //         'alert-type' => 'success'
            //     );
            //     return redirect()->back()->with($response);
            // }else{
            //     $response = array(
            //         'message' => 'Something went wrong. Profile is not updated',
            //         'alert-type' => 'error'
            //     );
            //     return redirect()->back()->with($response);
            // }
        
        
    }

    

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = auth()->guard('admin')->user();


        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Store the image
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('profile_pictures', $imageName, 'public');

            $user->update([
                'profile_picture' => $path,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile picture uploaded successfully.',
                'image_url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['success' => false, 'message' => 'File upload failed.']);
    }
}