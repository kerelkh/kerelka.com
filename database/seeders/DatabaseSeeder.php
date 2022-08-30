<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Menu;
use App\Models\StatusPost;
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
        // \App\Models\User::factory(10)->create();
        $user = new User();
        $user->name = "Kerel Khalif Afif";
        $user->username = "kerelka";
        $user->email = "kerelkaa@gmail.com";
        $user->password = Hash::make("kmzwa88saa");
        $user->save();

        StatusPost::create([
            'status' => 'save',
        ]);

        StatusPost::create([
            'status' => 'publish',
        ]);

        StatusPost::create([
            'status' => 'deleted',
        ]);

        Category::create([
            'category_name' => 'Technology'
        ]);

        Category::create([
            'category_name' => 'Programming'
        ]);

        Category::create([
            'category_name' => 'Lifestyle'
        ]);

        Category::create([
            'category_name' => 'Business'
        ]);

        Category::create([
            'category_name' => 'Tutorial'
        ]);
    }
}
