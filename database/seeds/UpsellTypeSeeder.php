<?php

use Carbon\Carbon;
use App\Models\UpsellType;
use Illuminate\Database\Seeder;

class UpsellTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $upsellTypes =config('upsell.strings.upsellTypes');
        foreach($upsellTypes as $upsellType):
            new UpsellType($upsellType);
        endforeach;
        // UpsellType::insert(config('upsell.strings.upsellTypes'));
    }
}
