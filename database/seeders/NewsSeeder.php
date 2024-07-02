<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //use faker
        for($i = 0; $i < 100; $i++) {
            $news = new News();
            $news->title = fake()->sentence();
            $news->content = fake()->paragraph();
            $news->image = fake()->imageUrl();
            $news->user_id = 1;
            $news->status = 'published';
            $news->published_at = now();
            $news->save();
        }


    }
}
