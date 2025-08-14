<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AdminNotification;

class AdminNotificationController extends Controller
{
    public function fetchNotifications(Request $request)
    {
        $userId = auth()->guard('admin')->user()->id; 
        $notifications = DB::table('admin-notifications')
                        ->join('admins', 'admin-notifications.admin_id', '=', 'admins.id')
                        ->select('admin-notifications.*', 'admin-notifications.created_at as senddate', 'admins.*')
                        ->where('admin-notifications.admin_id', $userId)
                        ->orderBy('admin-notifications.created_at', 'desc')
                        ->get();
     
        return response()->json([
            'notifications' => $notifications,
        ]);
    }

    public function markAsRead(Request $request)
    {
        AdminNotification::where('id', $request->id)->update(['read' => 1]);

        return response()->json(['message' => 'Notifications marked as read']);
    }
}