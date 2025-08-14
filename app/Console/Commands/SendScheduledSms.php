<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notification;
use Carbon\Carbon;

class SendScheduledSms extends Command
{
    protected $signature = 'sms:send';
    protected $description = 'Send scheduled SMS messages';

    public function handle()
    {
        // Get all notifications that haven't had SMS sent yet
        $notifications = Notification::where('is_send_sms', 0)->get();

        foreach ($notifications as $notification) {
            // $messageData = 'Silverbridge™: '.$notification->message . ' Visit: https://www.slvr.co';
            $notiSpanish = $notification['message-spanish'];
            $messageData = 'Silverbridge™: ' . $notiSpanish . ' Visita: https://www.slvr.co';

            // Get user details using the correct notification ID
            $userDetail = getUserDetails($notification->to_id);

            // Build phone number (e.g., +91XXXXXXXXXX)
            $phone = "+".$userDetail->dialCode . $userDetail->phone;
        
            // Send SMS
            $response = sendTelerivetSms($phone, $messageData);

            // Check if sending was successful
            if (!empty($response['success']) && $response['success']) {
                $notification->is_send_sms = 1;
                $notification->save();

                // $this->info("SMS sent to {$phone}");
            } else {
                // $this->error("Failed to send SMS to {$phone}");
            }
        }
    }

}
