<?php

namespace App\Observers;

use App\Models\Competence;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class CompetenceActionObserver
{
    public function created(Competence $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Competence'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Competence $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Competence'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Competence $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Competence'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
