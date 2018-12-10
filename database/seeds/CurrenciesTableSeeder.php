<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = ["Nepal","USA","India",'Japan'];
        $curr_name = ["Neplease Rupee","Dollar","Indian Rupee","Yuan"];
        $rate= ['110','1','65.2','107'];
        foreach ($country as  $id => $value) {
        	$curr = new App\Currency;
        	$curr->country = $value;
        	$curr->currency_name = $curr_name[$id];
        	$curr->per_usd_value = $rate[$id];
        	$curr->save();
        }
    }
}
