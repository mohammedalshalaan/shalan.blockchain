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
        //$authorRole = App\Role::where('name','author')->first();
        //$visitorRole = App\Role::where('name','visitor')->first();

        $admin = App\User::create([
            'name'=> 'Admin User',
            'email'=>'admin@BlockchainT.com',
            'blockchain_address' =>'0xA022BCaE6F2D0f05fFBAc2ff6F7883bAf5322352', // this is a fake address
            'password' =>Hash::make('123123123')
        ]);
        /*
        $author = App\User::create([
            'name'=> 'Author User',
            'email'=>'author@BlockchainT.com',
            'blockchain_address' =>'0x7A1afAC0a7903a458c1F01247bFE4bb0B23cDFcD', // this is a fake address
            'password' =>Hash::make('123123123')
        ]);
        
        $visitor = App\User::create([
            'name'=> 'Visitor User',
            'email'=>'visitor@BlockchainT.com',
            'blockchain_address' =>'0x33DAbbAD7ec1d68A4A68efa99d34F1d693B3F031', // this is a fake address
            'password' =>Hash::make('123123123')
        ]);
        */
        $admin->roles()->attach($adminRole);
        //$author->roles()->attach($authorRole);
        //$visitor->roles()->attach($visitorRole);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        
     
       
    }
}
