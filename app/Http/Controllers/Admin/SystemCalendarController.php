<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Event',
            'date_field' => 'date',
            'field'      => 'name',
            'prefix'     => 'Evenement',
            'suffix'     => '',
            'route'      => 'admin.events.edit',
        ],
        [
            'model'      => '\App\Models\Prev',
            'date_field' => 'date',
            'field'      => 'name',
            'prefix'     => 'PHA',
            'suffix'     => '',
            'route'      => 'admin.prevs.edit',
        ],
        [
            'model'      => '\App\Models\User',
            'date_field' => 'birthdate',
            'field'      => 'name',
            'prefix'     => 'Verjaardag',
            'suffix'     => '',
            'route'      => 'admin.users.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
