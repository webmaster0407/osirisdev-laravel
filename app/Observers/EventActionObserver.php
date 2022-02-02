<?php

namespace App\Observers;

use App\Models\Event;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class EventActionObserver
{
    public function created(Event $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Event'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Event $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Event'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Event $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Event'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
