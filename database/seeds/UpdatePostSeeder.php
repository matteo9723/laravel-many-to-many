<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;

class UpdatePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        foreach($posts as $post){
            $post->category_id = Category::inRandomOrder()->first()->id;
            $post->update();

        }
    }
}
