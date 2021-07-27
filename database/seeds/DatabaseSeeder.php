<?php

use Illuminate\Database\Seeder;

use App\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       

        $this->call(RoleTableSeeder::class);

        $this->call(UserTableSeeder::class);

        $this->call(AreaTableSeeder::class);

        //$this->call(OfferTableSeeder::class);

       // $this->call(CommentTableSeeder::class);
        

       
       
    }
}
