<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use App\User;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       
       // $roles = factory(App\Role::class, 3)->create();
       App\Role::truncate();
       App\Role::create(['name'=>'admin']);
       App\Role::create(['name'=>'author']);
       App\Role::create(['name'=>'visitor']);
       



    }
}
