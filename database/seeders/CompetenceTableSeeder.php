<?php

namespace Database\Seeders;

use App\Models\Competence;

use Illuminate\Database\Seeder;

class CompetenceTableSeeder extends Seeder
{
    public function run()
    {
        $competences = [
            [
                'key' => 'A1',
                'name' => 'Logistiek',
                'abbreviation' => 'LOG',
                'type' => 'sanitary',
                'color' => null,
                'expirable' => 0,

            ],
            [
                'key' => 'A3',
                'name' => 'Eerstehulpverlener',
                'abbreviation' => 'EHV',
                'type' => 'sanitary',
                'color' => "yellow",
                'expirable' => 1,

            ],
            [
                'key' => 'B3',
                'name' => 'Eventhulpverlener',
                'abbreviation' => 'EVH',
                'type' => 'sanitary',
                'color' => "orange",
                'expirable' => 1,

            ],
            [
                'key' => 'G1',
                'name' => 'Dringende geneeskundige hulpverlener',
                'abbreviation' => 'DGH',
                'type' => 'sanitary',
                'color' => "blue",
                'expirable' => 1,

            ],
            [
                'key' => 'D3',
                'name' => 'Ambulancier NDLZ (voorlopig)',
                'abbreviation' => 'NDLZ-V',
                'type' => 'sanitary',
                'color' => "grey",
                'expirable' => 1,

            ],
            [
                'key' => 'D4',
                'name' => 'Ambulancier NDLZ',
                'abbreviation' => 'NDLZ',
                'type' => 'sanitary',
                'color' => "grey",
                'expirable' => 1,

            ],
            [
                'key' => 'E1',
                'name' => 'Verpleegkundige',
                'abbreviation' => 'VPK',
                'type' => 'sanitary',
                'color' => "green",
                'expirable' => 0,

            ],
            [
                'key' => 'E3',
                'name' => 'Spoed-Verpleegkundige',
                'abbreviation' => 'S-VPK',
                'type' => 'sanitary',
                'color' => "green",
                'expirable' => 0,

            ],
            [
                'key' => 'F1',
                'name' => 'Arts',
                'abbreviation' => 'ARTS',
                'type' => 'sanitary',
                'color' => "red",
                'expirable' => 0,

            ],
            [
                'key' => 'F2',
                'name' => 'Urgentie-Arts',
                'abbreviation' => 'U-ARTS',
                'type' => 'sanitary',
                'color' => "red",
                'expirable' => 0,

            ],
            [
                'key' => 'B2',
                'name' => 'Interventie (oud)',
                'abbreviation' => 'INT',
                'type' => 'sanitary',
                'color' => "yellow",
                'expirable' => 1,

            ],
            [
                'key' => 'L1',
                'name' => 'Leiding 1',
                'abbreviation' => 'L1',
                'type' => 'qualification',
                'color' => null,
                'expirable' => 0,

            ],
            [
                'key' => 'L2',
                'name' => 'Leiding 2',
                'abbreviation' => 'L2',
                'type' => 'qualification',
                'color' => null,
                'expirable' => 0,

            ],
            [
                'key' => 'L3',
                'name' => 'Leiding 3',
                'abbreviation' => 'L3',
                'type' => 'qualification',
                'color' => null,
                'expirable' => 0,

            ],
            [
                'key' => 'RADIO',
                'name' => 'Radiocommunicatie',
                'abbreviation' => 'RADIO',
                'type' => 'qualification',
                'color' => null,
                'expirable' => 0,

            ],
            [
                'key' => 'RAMP',
                'name' => 'Rampenbestrijding',
                'abbreviation' => 'RAMP',
                'type' => 'qualification',
                'color' => null,
                'expirable' => 0,

            ],
            [
                'key' => 'SIT',
                'name' => 'SIM/SIT',
                'abbreviation' => 'SIT',
                'type' => 'qualification',
                'color' => null,
                'expirable' => 0,

            ],
            [
                'key' => 'RB',
                'name' => 'Rijbewijs B',
                'abbreviation' => 'RB',
                'type' => 'driverslicense',
                'color' => null,
                'expirable' => 0,

            ],
            [
                'key' => 'RBE',
                'name' => 'Rijbewijs BE',
                'abbreviation' => 'RBE',
                'type' => 'driverslicense',
                'color' => null,
                'expirable' => 0,

            ],
            [
                'key' => 'RGA',
                'name' => 'Rijgeschiktheidsattest',
                'abbreviation' => 'RGA',
                'type' => 'driverslicense',
                'color' => null,
                'expirable' => 1,

            ]
        ];

        Competence::insert($competences);
    }
}
