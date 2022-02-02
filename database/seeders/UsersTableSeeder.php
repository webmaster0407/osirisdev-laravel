<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'              => 1,
                'name'            => 'Petillion',
                'email'           => 'michel.petillion@vrijwilliger.rodekruis.be',
                'password'        => bcrypt('Wachtwoord123'),
                'firstname'       => 'Michel',
                'two_factor' => '1',
                'city'            => 'Oostmalle',
                'Birthdate'            => '1985-06-04',
                'rkid'            => '85060400355',
                'dghid'            => '106101'
            ],
            [
                'id'              => 2,
                'name'            => 'Verelst',
                'email'           => 'dave.verelst@vrijwilliger.rodekruis.beTEST',
                'password'        => bcrypt('Wachtwoord123'),
                'firstname'       => 'Dave',
                'two_factor' => '0',
                'city'            => null,
                'Birthdate'            => null,
                'rkid'            => '87040500284',
                'dghid'            => null
            ],
            [
                'id'              => 3,
                'name'            => 'Verguts',
                'email'           => 'ken.verguts@vrijwilliger.rodekruis.beTEST',
                'password'        => bcrypt('Wachtwoord123'),
                'firstname'       => 'Ken',
                'two_factor' => '0',
                'city'            => null,
                'Birthdate'            => null,
                'rkid'            => '89092000170',
                'dghid'            => '30699'
            ],
            [
                'id'              => 5,
                'name'            => 'Vrijwilliger',
                'email'           => 'none1@none.com',
                'password'        => bcrypt('Wachtwoord123'),
                'firstname'       => 'Eerste',
                'two_factor' => '0',
                'city'            => null,
                'Birthdate'            => null,
                'rkid'            => '10000000001',
                'dghid'            => null
            ],
            [
                'id'              => 6,
                'name'            => 'Vrijwilliger',
                'email'           => 'none2@none.com',
                'password'        => bcrypt('Wachtwoord123'),
                'firstname'       => 'Tweede',
                'two_factor' => '0',
                'city'            => null,
                'Birthdate'            => null,
                'rkid'            => '10000000002',
                'dghid'            => null
            ]
        ];

        User::insert($users);
    }
}
