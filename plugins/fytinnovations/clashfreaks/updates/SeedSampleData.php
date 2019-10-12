<?php

namespace Fytinnovations\ClashFreaks\Updates;

use Seeder;
use Fytinnovations\ClashFreaks\Models\BaseDesign;
use Faker;
use Auth;
use System\Models\File;

class SeedSampleData extends Seeder
{
    public function run()
    {

        try {
            $user = Auth::register([
                'name' => 'Aniket',
                'email' => 'aniketmagadum@fytinnovations.com',
                'password' => 'Aniket@123',
                'password_confirmation' => 'Aniket@123',
            ]);
        } catch (\Throwable $th) {
            echo "Reused earlier user\n";
        }
        for ($i = 0; $i < 10; $i++) {
            $faker = Faker\Factory::create();
            $base_design = BaseDesign::create([
                'name' => $faker->name,
                'slug' => $faker->slug,
                'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'url' => $faker->url,
                'is_active' => $faker->boolean($chanceOfGettingTrue = 50),
                'town_hall_id' => $faker->numberBetween($min = 1, $max = 3)
            ]);

            $file = new File;
            $file->fromUrl('https://picsum.photos/640/360');
            $base_design->images()->add($file);
            $base_design->ratings()->create([
                'user_id' => 1,
                'ratings' => $faker->numberBetween($min = 1, $max = 5)
            ]);
            $base_design->ratings()->create([
                'user_id' => 1,
                'ratings' => $faker->numberBetween($min = 1, $max = 5)
            ]);
        }
    }
}