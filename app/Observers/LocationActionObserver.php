<?php

namespace App\Observers;

use App\Models\Location;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class LocationActionObserver
{
    public function created(Location $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Location'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Location $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Location'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Location $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Location'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
