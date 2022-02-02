<?php

namespace App\Observers;

use App\Models\Competenceregistration;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class CompetenceregistrationActionObserver
{
    public function created(Competenceregistration $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Competenceregistration'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Competenceregistration $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Competenceregistration'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Competenceregistration $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Competenceregistration'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
