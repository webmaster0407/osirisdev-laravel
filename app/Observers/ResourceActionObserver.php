<?php

namespace App\Observers;

use App\Models\Resource;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class ResourceActionObserver
{
    public function created(Resource $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Resource'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Resource $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Resource'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Resource $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Resource'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
