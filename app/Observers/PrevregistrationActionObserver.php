<?php

namespace App\Observers;

use App\Models\Prevregistration;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class PrevregistrationActionObserver
{
    public function created(Prevregistration $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Prevregistration'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Prevregistration $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Prevregistration'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Prevregistration $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Prevregistration'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
