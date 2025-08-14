<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdminForgottPasswordMail;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('admin.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $userAdmin = Admin::where('email', $request->email)->first();
        if (!$userAdmin) {
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }

        $token = Str::random(64);
        $userAdmin->remember_token = $token;
        $userAdmin->save();

        $resetLink = route('admin.password.reset.form', $token);
        
        // Send email (use your email config)
        Mail::to($userAdmin->email)->send(new AdminForgottPasswordMail($userAdmin, $resetLink));

        return back()->with('status', 'We have emailed your password reset link!');
    }

    public function showResetForm($token)
    {
        return view('admin.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $reset = DB::table('admins')
                    ->where('email', $request->email)
                    ->where('remember_token', $request->token)
                    ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Invalid token or email']);
        }

        $userAdmin = Admin::where('email', $request->email)->first();
        if (!$userAdmin) {
            return back()->withErrors(['email' => 'User does not exist']);
        }

        $userAdmin->password = Hash::make($request->password);
        $userAdmin->remember_token = "";
        $userAdmin->save();

        return redirect()->route('login.form')->with('status', 'Password has been reset Successfully!');
    }
}
