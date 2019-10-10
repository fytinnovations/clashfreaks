<?php

namespace Fytinnovations\ClashFreaks\Updates;

use Seeder;
use Fytinnovations\ClashFreaks\Models\TownHall;
use Fytinnovations\ClashFreaks\Models\VillageType;

class SeedInitialTables extends Seeder
{
    public function run()
    {
        $home_village    = VillageType::create([
            'name'                 => 'Home',
            'slug'                 => 'home',
        ]);

        $builder_village = VillageType::create([
            'name'                 => 'Builder',
            'slug'                 => 'builder',
        ]);

        $th7 = new TownHall([
            'name'                 => 'Town Hall 7',
            'slug'                 => 'town-hall-7',
        ]);
        $th8 = new TownHall([
            'name'                 => 'Town Hall 8',
            'slug'                 => 'town-hall-8',
        ]);
        $th9 = new TownHall([
            'name'                 => 'Town Hall 9',
            'slug'                 => 'town-hall-9',
        ]);
        $th10 = new TownHall([
            'name'                 => 'Town Hall 10',
            'slug'                 => 'town-hall-10',
        ]);
        $th11 = new TownHall([
            'name'                 => 'Town Hall 11',
            'slug'                 => 'town-hall-11',
        ]);
        $th12 = new TownHall([
            'name'                 => 'Town Hall 12',
            'slug'                 => 'town-hall-12',
        ]);
        $builder_village->townhalls()->add($th7);
        $builder_village->townhalls()->add($th8);
        $home_village->townhalls()->add($th9);
        $home_village->townhalls()->add($th10);
        $home_village->townhalls()->add($th11);
        $home_village->townhalls()->add($th12);
    }
}
