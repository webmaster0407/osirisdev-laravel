<?php

namespace App\Observers;

use App\Models\Prev;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class PrevActionObserver
{
    public function created(Prev $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Prev'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Prev $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Prev'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Prev $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Prev'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
