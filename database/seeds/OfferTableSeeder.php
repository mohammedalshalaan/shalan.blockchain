<?php

use Illuminate\Database\Seeder;
use App\Model;
class OfferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offer = factory(App\Offer::class, 5)->create();
    }
}
