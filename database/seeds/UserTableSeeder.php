<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        App\User::truncate();
        DB::table('role_user')->truncate();
        $adminRole = App\Role::where('name','admin')->first();
      
        $admin = App\User::create([
            'name'=> 'Admin User',
            'email'=>'admin@BlockchainT.com',
            'blockchain_address' =>'0xA022BCaE6F2D0f05fFBAc2ff6F7883bAf5322352', // this is a fake address
            'password' =>Hash::make('123123123')
        ]);
       
        $admin->roles()->attach($adminRole);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        
     
       
    }
}
