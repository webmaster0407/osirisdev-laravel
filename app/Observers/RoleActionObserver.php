<?php

namespace App\Observers;

use App\Models\Role;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class RoleActionObserver
{
    public function created(Role $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Role'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Role $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Role'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Role $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Role'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
