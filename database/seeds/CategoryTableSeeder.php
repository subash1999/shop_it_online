<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $categories= array(
        	"Electronics"=>null,
        	"Clothes"=>null,
        	"Mobile"=>"1",
        	"PC"=>"1",
        	"Laptop"=>"1",
        	"Men"=>"2",
        	"Women"=>"2",
        	"Dell"=>"5",
        	"Lenevo"=>"5",
        	"HP"=>"5",
        	"Acer"=>"5",
        	"Pant"=>"6",
        	"Shirt"=>"6",
        	"Kurthi"=>"7",
        	"Bags"=>"7",
        	"Bags"=>"6"
        );
        foreach ($categories as $category => $parent_category) {
        	$cate = new App\Category;
        	$cate->cate_name = $category;
        	$cate->parent_cate = $parent_category;
        	$cate->save();
        }
    }
}
