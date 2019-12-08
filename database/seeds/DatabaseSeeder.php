<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function ($user){
                    for ($i=0; $i < 3; $i++) { 
                    $user->posts()->save(factory(App\Post::class)->make());
                    $user->comments()->save(factory(App\Comment::class)->make());
                }
                });
    
    }
}
