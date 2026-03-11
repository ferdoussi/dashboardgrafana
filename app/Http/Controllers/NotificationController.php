<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $user = auth()->user();
        $notification = $user->unreadNotifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
   public function deleteNotification($id)
{
    $notification = auth()->user()->notifications()->find($id);

    if ($notification) {
        $notification->delete();

        return response()->json([
            'success' => true,
            'notif_id' => $id,
            'message' => 'Notification deleted successfully'
        ], 200);
    }

    return response()->json([
        'success' => false,
        'notif_id' => $id,
        'message' => 'Notification not found'
    ], 404);
}
}
