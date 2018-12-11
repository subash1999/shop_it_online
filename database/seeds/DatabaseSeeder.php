<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
            CurrenciesTableSeeder::class,         	
            UserTypesTableSeeder::class,
            UsersTableSeeder::class,
            UserTypeRelationsTableSeeder::class,
            CategoryTableSeeder::class,
            SellersTableSeeder::class,

         ]);
    }
}
