<?php

use Illuminate\Database\Seeder;
use App\Model;
class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = factory(App\Comment::class, 50)->create();
     
    }
}
