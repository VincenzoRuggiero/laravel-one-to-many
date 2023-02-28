<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = ['HTML', 'CSS', 'Javascript', 'Bootstrap', 'VueJS', 'PHP', 'Laravel'];

        foreach ($types as $typeName){
            $type = new Type();
            $type->name = $typeName;
            $type->save();
        }
    }
}
