<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function index(Request $request)
    {
        // dd("ram nam satya hai ");
    	dd($request->all());
    	foreach ($request->option_group as $id => $value) {
    		echo($value["name"]) ;
    		// echo $value;
    	}
    	
    	
    }
}
