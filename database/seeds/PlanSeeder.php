<?php

use Illuminate\Database\Seeder;
use Osiset\ShopifyApp\Storage\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $free = new Plan();
        // $free->name = "Free";
        // $free->type = 'RECURRING';
        // $free->price = 0.00;
        // $free->capped_amount = 100;
        // $free->terms = "Alpha Currency Free Plan Terms And Conditions.";
        // $free->trial_days = 0;
        // $free->save();

        $premium = new Plan();
        $premium->name = "Alpha Upsell Suite";
        $premium->type = 'RECURRING';
        $premium->price = 0;
        $premium->capped_amount = 349.99;
        $premium->terms = "Free Upto 50 orders per month then starts at $ 7.99";
        $premium->trial_days = 0;
        $premium->on_install = 1;
        $premium->save();
    }
}
