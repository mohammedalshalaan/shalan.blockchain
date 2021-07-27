<?php

use Illuminate\Database\Seeder;
use App\Model;
class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area = factory(App\Area::class, 5)->create();
    }
}
