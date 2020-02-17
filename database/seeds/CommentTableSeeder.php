<?php

use Illuminate\Database\Seeder;
use App\Comment;
class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::insert(
            [
                [
                    'blog_id' => 1,
                    'comment' => 'this is a comment 14',
                    'userId' => 5,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'blog_id' => 2,
                    'comment' => 'this is a comment 15',
                    'userId' => 5,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),

                ],
                [
                    'blog_id' => 3,
                    'comment' => 'this is a comment 16',
                    'userId' => 5,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'blog_id' => 4,
                    'comment' => 'this is a comment 17',
                    'userId' => 5,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'blog_id' => 5,
                    'comment' => 'this is a comment 18',
                    'userId' => 5,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
             ]
        );
    }
}
