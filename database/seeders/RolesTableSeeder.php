<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Afd. Verantw.',
            ],
            [
                'id'    => 2,
                'title' => 'Adj. Afd. Verantw.',
            ],
            [
                'id'    => 3,
                'title' => 'Ondersteuner',
            ],
            [
                'id'    => 99,
                'title' => 'Vrijwilliger',
            ],
        ];

        Role::insert($roles);
    }
}
