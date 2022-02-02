<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'prev_create',
            ],
            [
                'id'    => 20,
                'title' => 'prev_edit',
            ],
            [
                'id'    => 21,
                'title' => 'prev_show',
            ],
            [
                'id'    => 22,
                'title' => 'prev_delete',
            ],
            [
                'id'    => 23,
                'title' => 'prev_access',
            ],
            [
                'id'    => 24,
                'title' => 'management_access',
            ],
            [
                'id'    => 25,
                'title' => 'note_create',
            ],
            [
                'id'    => 26,
                'title' => 'note_edit',
            ],
            [
                'id'    => 27,
                'title' => 'note_show',
            ],
            [
                'id'    => 28,
                'title' => 'note_delete',
            ],
            [
                'id'    => 29,
                'title' => 'note_access',
            ],
            [
                'id'    => 30,
                'title' => 'preventiefe_access',
            ],
            [
                'id'    => 31,
                'title' => 'location_create',
            ],
            [
                'id'    => 32,
                'title' => 'location_edit',
            ],
            [
                'id'    => 33,
                'title' => 'location_show',
            ],
            [
                'id'    => 34,
                'title' => 'location_delete',
            ],
            [
                'id'    => 35,
                'title' => 'location_access',
            ],
            [
                'id'    => 36,
                'title' => 'competence_create',
            ],
            [
                'id'    => 37,
                'title' => 'competence_edit',
            ],
            [
                'id'    => 38,
                'title' => 'competence_show',
            ],
            [
                'id'    => 39,
                'title' => 'competence_delete',
            ],
            [
                'id'    => 40,
                'title' => 'competence_access',
            ],
            [
                'id'    => 41,
                'title' => 'competenceregistration_create',
            ],
            [
                'id'    => 42,
                'title' => 'competenceregistration_edit',
            ],
            [
                'id'    => 43,
                'title' => 'competenceregistration_show',
            ],
            [
                'id'    => 44,
                'title' => 'competenceregistration_delete',
            ],
            [
                'id'    => 45,
                'title' => 'competenceregistration_access',
            ],
            [
                'id'    => 46,
                'title' => 'prevregistration_create',
            ],
            [
                'id'    => 47,
                'title' => 'prevregistration_edit',
            ],
            [
                'id'    => 48,
                'title' => 'prevregistration_show',
            ],
            [
                'id'    => 49,
                'title' => 'prevregistration_delete',
            ],
            [
                'id'    => 50,
                'title' => 'prevregistration_access',
            ],
            [
                'id'    => 51,
                'title' => 'resource_create',
            ],
            [
                'id'    => 52,
                'title' => 'resource_edit',
            ],
            [
                'id'    => 53,
                'title' => 'resource_show',
            ],
            [
                'id'    => 54,
                'title' => 'resource_delete',
            ],
            [
                'id'    => 55,
                'title' => 'resource_access',
            ],
            [
                'id'    => 56,
                'title' => 'task_create',
            ],
            [
                'id'    => 57,
                'title' => 'task_edit',
            ],
            [
                'id'    => 58,
                'title' => 'task_show',
            ],
            [
                'id'    => 59,
                'title' => 'task_delete',
            ],
            [
                'id'    => 60,
                'title' => 'task_access',
            ],
            [
                'id'    => 61,
                'title' => 'event_create',
            ],
            [
                'id'    => 62,
                'title' => 'event_edit',
            ],
            [
                'id'    => 63,
                'title' => 'event_show',
            ],
            [
                'id'    => 64,
                'title' => 'event_delete',
            ],
            [
                'id'    => 65,
                'title' => 'event_access',
            ],
            [
                'id'    => 66,
                'title' => 'eventmenu_access',
            ],
            [
                'id'    => 67,
                'title' => 'eventregistration_create',
            ],
            [
                'id'    => 68,
                'title' => 'eventregistration_edit',
            ],
            [
                'id'    => 69,
                'title' => 'eventregistration_show',
            ],
            [
                'id'    => 70,
                'title' => 'eventregistration_delete',
            ],
            [
                'id'    => 71,
                'title' => 'eventregistration_access',
            ],
            [
                'id'    => 72,
                'title' => 'incident_create',
            ],
            [
                'id'    => 73,
                'title' => 'incident_edit',
            ],
            [
                'id'    => 74,
                'title' => 'incident_show',
            ],
            [
                'id'    => 75,
                'title' => 'incident_delete',
            ],
            [
                'id'    => 76,
                'title' => 'incident_access',
            ],
            [
                'id'    => 77,
                'title' => 'comlog_create',
            ],
            [
                'id'    => 78,
                'title' => 'comlog_edit',
            ],
            [
                'id'    => 79,
                'title' => 'comlog_show',
            ],
            [
                'id'    => 80,
                'title' => 'comlog_delete',
            ],
            [
                'id'    => 81,
                'title' => 'comlog_access',
            ],
            [
                'id'    => 82,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 83,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 84,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 85,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 86,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
