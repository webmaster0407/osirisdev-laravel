<?php

namespace App\Observers;

use App\Models\Incident;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class IncidentActionObserver
{
    public function created(Incident $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Incident'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Incident $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Incident'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Incident $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Incident'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
