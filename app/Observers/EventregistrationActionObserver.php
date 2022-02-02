<?php

namespace App\Observers;

use App\Models\Eventregistration;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class EventregistrationActionObserver
{
    public function created(Eventregistration $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Eventregistration'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Eventregistration $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Eventregistration'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Eventregistration $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Eventregistration'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
