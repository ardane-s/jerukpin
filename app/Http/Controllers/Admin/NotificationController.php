<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::forAdmin()
            ->unread()
            ->recent(10)
            ->get();
            
        return response()->json([
            'notifications' => $notifications,
            'count' => $notifications->count(),
        ]);
    }
    
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->markAsRead();
        
        return response()->json(['success' => true]);
    }
    
    public function markAllAsRead()
    {
        Notification::forAdmin()
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
            
        return response()->json(['success' => true]);
    }
}
