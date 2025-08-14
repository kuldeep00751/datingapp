<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function fetchNotifications(Request $request)
    {
        $matchUserId = auth()->user()->match_user_id;
        $lastId = end($matchUserId);
        $userId = auth()->id();
        $liked_user_id = $request->id;
        
        $query = DB::table('notifications')
                        ->join('users', 'notifications.user_id', '=', 'users.id')
                        ->join('user_likes', 'users.id', '=', 'user_likes.user_id')
                        ->select('notifications.*', 'notifications.created_at as senddate', 'users.*','notifications.id as notificationId')
                        ->where('notifications.to_id', $userId);

                        if ($liked_user_id != 0) {
                            $query->where('notifications.user_id', $liked_user_id)
                            ->where('user_likes.affection', "!=",'exit');
                        }elseif($lastId !=null){
                            $query->where('notifications.user_id', $lastId)
                            ->where(function ($q) {
                                $q->where('message', 'like', '%explore a different path this time%')
                                  ->orWhere('message', 'like', '%has provided feedback about your date%')
                                  ->orWhere('message', 'like', '%passed without mutual confirmation%');
                            })
                            ->where('user_likes.affection', "=",'exit');
                        }else{
                            $query->where('notifications.user_id', $liked_user_id)
                            ->where('user_likes.affection', "!=",'exit');
                        }

                        $notifications = $query->distinct('notifications.id')->orderBy('notifications.created_at', 'desc')
                        ->get();
       
        return response()->json([
                'notifications' => $notifications
            ]);
    }

    public function markAsRead(Request $request)
    {
       
        $userId = auth()->id();
        Notification::where('user_id', $request->user_id)->where('to_id', $userId)->where('read', 0)->update(['read' => 0]);

        return response()->json(['message' => 'Notifications marked as read']);
    }

    public function deleteNotification(Request $request)
    {
        $noti = Notification::where('id', $request->id)->delete();
        $count = getUnseenNotification(getMatchProfile());

        if($noti){
            return response()->json(['success' => true,'count'=>$count]);
        }
        return response()->json(['success' => false ,'count'=>$count]);
    }
}
