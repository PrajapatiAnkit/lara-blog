<?php

use App\Blog;
use App\User;
use Illuminate\Database\Seeder;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::insert(
            [
                [
                    'blog_title' => 'what is java',
                    'category_id' => 1,
                    'blog_description' => 'This is a java description',
                    'blog_images' => '',
                    'added_by' => 1,
                    'like_count' => 0,
                    'dislike_count' => 0,
                    'comment_count' => 0,
                    'blog_slug' => 'what-is-java',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'blog_title' => 'what is android',
                    'category_id' => 2,
                    'blog_description' => 'This is a android description',
                    'blog_images' => '',
                    'added_by' => 1,
                    'like_count' => 0,
                    'dislike_count' => 0,
                    'comment_count' => 0,
                    'blog_slug' => 'what-is-android',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'blog_title' => 'what is ionic',
                    'category_id' => 3,
                    'blog_description' => 'This is a ionic description',
                    'blog_images' => '',
                    'added_by' => 1,
                    'like_count' => 0,
                    'dislike_count' => 0,
                    'comment_count' => 0,
                    'blog_slug' => 'what-is-ionic',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'blog_title' => 'What is github',
                    'category_id' => 4,
                    'blog_description' => 'This is a github description',
                    'blog_images' => '',
                    'added_by' => 1,
                    'like_count' => 0,
                    'dislike_count' => 0,
                    'comment_count' => 0,
                    'blog_slug' => 'what-is-github',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'blog_title' => 'what is gitlab',
                    'category_id' => 5,
                    'blog_description' => 'This is a gitlab description',
                    'blog_images' => '',
                    'added_by' => 1,
                    'like_count' => 0,
                    'dislike_count' => 0,
                    'comment_count' => 0,
                    'blog_slug' => 'what-is-gitlab',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
             ]
         );
    }
}
