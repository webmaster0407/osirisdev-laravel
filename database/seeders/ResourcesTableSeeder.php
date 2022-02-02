<?php

namespace Database\Seeders;

use App\Models\Resource;

use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    public function run()
    {
        $resources = [
            [
                'name' => 'Interventievoertuig',
                'type' => 'vehicle',
                'idtag' => 'XMY-135'
            ],[
                'name' => 'Ziekenwagen',
                'type' => 'vehicle',
                'idtag' => 'XZX-026'
            ],[
                'name' => 'Aanhangwagen',
                'type' => 'vehicle',
                'idtag' => 'Q-AHK-921'
            ],
            [
                'name' => 'Fiets 1',
                'type' => 'vehicle',
                'idtag' => ''
            ],
            [
                'name' => 'Fiets 2',
                'type' => 'vehicle',
                'idtag' => ''
            ],
            [
                'name' => "Set radio's",
                'type' => 'other',
                'idtag' => ''
            ],[
                'name' => "Gewichten tent",
                'type' => 'other',
                'idtag' => ''
            ],[
                'name' => "Extra brancards",
                'type' => 'other',
                'idtag' => ''
            ],
            [
                'name' => "Tent SG300",
                'type' => 'tent',
                'idtag' => ''
            ],
            [
                'name' => "A-tent",
                'type' => 'tent',
                'idtag' => ''
            ],
            [
                'name' => "Vouwtent 3x3",
                'type' => 'tent',
                'idtag' => ''
            ],
            [
                'name' => "Vouwtent 3x4,5",
                'type' => 'tent',
                'idtag' => ''
            ],
            [
                'name' => "Vouwtent 3x6",
                'type' => 'tent',
                'idtag' => ''
            ],
            [
                'name' => "Koffer Warm",
                'type' => 'box',
                'idtag' => ''
            ],
            [
                'name' => "Koffer Tent",
                'type' => 'box',
                'idtag' => ''
            ],
            [
                'name' => "Koffer Elec",
                'type' => 'box',
                'idtag' => ''
            ],
            [
                'name' => "Koffer Lamp",
                'type' => 'box',
                'idtag' => ''
            ],
            [
                'name' => "Koffer Catering",
                'type' => 'box',
                'idtag' => ''
            ],
        ];

        Resource::insert($resources);
    }
}
