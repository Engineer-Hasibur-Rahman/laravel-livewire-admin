<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@softui.com',
            'password' => Hash::make('secret')
        ]);

       // Use Faker to generate sample blog data
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            Blog::create([
                'title' => $faker->name(),
                'slug' => Str::slug($faker->text()),
                'body' => $faker->paragraph(),
            ]);
        }
        
        // Use Faker to generate sample blog data
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => $faker->name()               
            ]);
        }

    }
}
