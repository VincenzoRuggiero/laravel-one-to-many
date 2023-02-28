<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Project;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for($i = 0; $i < 50; $i++){
            $newProject = new Project();
            $newProject->type_id = Type::inRandomOrder()->first()->id;
            $newProject->title = $faker->sentence(4);
            $newProject->description = $faker->paragraph();
            $newProject->link = $faker->unique()->url();
            $newProject->created = $faker->dateTimeThisYear();
            $newProject->slug = Str::slug($newProject->title);
            $newProject->image = 'placeholder.jpg';
            $newProject->save();
        }
    }
}
