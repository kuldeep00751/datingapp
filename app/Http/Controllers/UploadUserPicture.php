<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Faker\Generator as Faker;

use Illuminate\Support\Facades\App;

class UploadUserPicture extends Controller
{
    public function __invoke(Faker $faker, Request $request)
    {
        $user = auth()->user();
        if(auth()->user()->status == "Pending" || auth()->user()->status == "pending")
        {
            return redirect('approve-pending');
        }
        
        elseif(auth()->user()->status == "rejected")
        {
            return redirect('account-rejected');
        }
        
        elseif(auth()->user()->status == "approved" && !activeSubscriptionCheck())
        {
            return redirect('payment-now');
        }
        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $file) {

                DB::table('pictures')->insert([

                    'user_id' => auth()->user()->id,

                    'name' => $faker->firstName,

                    'picture_location' => $file->store('profilePictures', 'public')

                ]);

            }

        }

        return redirect()->back()->with('status', 'Pictures has been uploaded!');

    }
}

