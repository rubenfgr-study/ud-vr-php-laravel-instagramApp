<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user = User::factory()->create(['nick' => 'admin', 'password' => Hash::make('admin'), 'email' => 'admin@gmail.com']);

        $images = Image::factory(5)->for($user)->create();

        foreach ($images as $image) {
            Comment::factory(10)->for($user)->for($image)->create();
            Like::factory(10)->for($user)->for($image)->create();
        }


        for ($i = 0; $i < 10; $i++) {
            $user = User::factory()->create();

            $images = Image::factory(5)->for($user)->create();

            foreach ($images as $image) {
                Comment::factory(10)->for($user)->for($image)->create();
                Like::factory(10)->for($user)->for($image)->create();
            }
        }
    }
}
