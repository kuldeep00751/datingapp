<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string|min:10',
            'attachment' => 'nullable|file|max:2048|mimes:jpg,jpeg,png,pdf,doc,docx'
        ]);

        $data = [
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        $supportmail =env('SUPPORT_TEAM_MAIL');
        Mail::to($supportmail)->send(new ContactMail($data, $attachmentPath));

        return back()->with('success', __('controllerText.ContactController_1'));
    }
}
