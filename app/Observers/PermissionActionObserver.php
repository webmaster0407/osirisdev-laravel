<?php

namespace App\Observers;

use App\Models\Permission;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class PermissionActionObserver
{
    public function created(Permission $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Permission'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Permission $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Permission'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Permission $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Permission'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
