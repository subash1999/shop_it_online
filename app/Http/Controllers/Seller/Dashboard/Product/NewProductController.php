<?php

namespace App\Http\Controllers\Seller\Dashboard\Product;

use App\Category;
use App\CategoryProductRelation;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Seller\SellerHelper;
use App\Http\Requests\StoreNewProduct;
use App\Option;
use App\OptionGroup;
use App\Product;
use App\SPFeatureList;
use App\SPOptionRelation;
use App\SPPhoto;
use App\SPPriceHistory;
use App\SellerProduct;
use File;
use Illuminate\Http\Request;
use Storage;

class NewProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $categories = Category::where('parent_cate','=',null)->get();
        $currencies = Currency::all();
        return view('seller/seller_dashboard/seller_dashboard_pages/seller_dashboard_product/seller_dashboard_new_product',compact(['categories','currencies']));
    }
    /*getting sub category of product*/
    public function getSubCategory($id)
    {
        $category = Category::find($id); 
        if($this->hasSubCategory($category->cate_id)){    
            $sub_categories = Category::where('parent_cate','=',$category->cate_id)->get();
            foreach ($sub_categories as $key => $sub_category) {
                echo nl2br ("\n \t\tSub Category : " .$sub_category->cate_name.PHP_EOL);
                $this->getSubCategory($sub_category->cate_id);        
            }       
        }
    }
    public function hasSubCategory($id)
    {
        $category = Category::where('parent_cate','=',$id)->count();
        if($category>0){
            return true;
        }        
        else{
            return false;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewProduct $request)
    {
        if(isset($request->validator)&& $request->validator->fails()){
            // dd( $request->validator->errors()->all());
            return response()->json(['errors'=>$request->validator->errors()->all()], 200);
            
        }
          // category product relation
        $cate_name = $request->selected_category;
        $category = Category::where('cate_name','=',$cate_name)->first();
        if($category==null){
            return response()->json(['errors'=>"Selected category of product is not present in the website"], 200);
        }
        $cate_id = $category->cate_id;

        // product name and some field for the seller product
        $product_name = $request->product_name;
        $description = $request->description;
        $photo1_name = "";
        $photo2_name = "";
        $photo3_name = "";
        if(isset($request['main_product_image_input'])){
            $photo1_input = $request->main_product_image_input;
            $photo1_name = "Product_photo1_"."SessionID_".session()->getId()."_".microtime().".".$photo1_input->getClientOriginalExtension();

        //file storage disk configuration can be found in config/filesystems.php
        //storing the photo name in the public disk         
            Storage::disk('public_uploads')->put($photo1_name,File::get($photo1_input));
        }
        if(isset($request['product_image_input'][1])){
            $photo2_input = $request->product_image_input[1];
            $photo2_name = "Product_photo2_"."SessionID_".session()->getId()."_".microtime().".".$photo2_input->getClientOriginalExtension();
        //file storage disk configuration can be found in config/filesystems.php
        //storing the photo name in the public disk         
            Storage::disk('public_uploads')->put($photo2_name,File::get($photo2_input));
        }
        if(isset($request['product_image_input'][2])){                
            $photo3_input = $request->product_image_input[2];
            $photo3_name = "Product_photo3_"."SessionID_".session()->getId()."_".microtime().".".$photo3_input->getClientOriginalExtension();
        //file storage disk configuration can be found in config/filesystems.php
        //storing the photo name in the public disk         
            Storage::disk('public_uploads')->put($photo3_name,File::get($photo3_input));
        }
        // Storing the new product into the database
        
        $product = new Product;
        $product->product_name = $product_name;
        $product->description = $description;
        $product->photo1 = $photo1_name;
        $product->photo2 = $photo2_name;
        $product->photo3 = $photo3_name;
        $product->save();

         // storing the new product category relation
        $cate_product_reln = new CategoryProductRelation;
        $cate_product_reln->cate_id = $cate_id;
        $cate_product_reln->p_id = $product->p_id;
        $cate_product_reln->save();


        // for the new seller product              
        $sp_name1 = $request->product_name;
        $sp_name2 = $request->sp_name2;
        $sp_name3 = $request->sp_name3;
        $sp_name4 = $request->sp_name4;
        $sp_name5 = $request->sp_name5;
        $qty = $request->quantity; 
        $sold = 0;
        $remaining = $qty - $sold;
        $seller_product = new SellerProduct;
        $seller_helper = new SellerHelper;
        $logined_seller = $seller_helper->getLoginedSeller();
        $seller_product->seller_id = $logined_seller['seller_id'];
        $seller_product->p_id = $product->p_id;
        $seller_product->description = $description;
        $seller_product->qty = $qty;
        $seller_product->sold = $sold;
        $seller_product->remaining = $remaining;
        $seller_product->sp_name1 = $sp_name1;
        $seller_product->sp_name2 = $sp_name2;
        $seller_product->sp_name3 = $sp_name3;
        $seller_product->sp_name4 = $sp_name4;
        $seller_product->sp_name5 = $sp_name5;
        $seller_product->save();
        // entering the price of the seller product
        $price_history = new SPPriceHistory;
        $price_history->sp_id = $seller_product->sp_id;
        $price_history->price = $request->unit_price;
        $price_history->curr_id = $request->curr_id;
        $price_history->from_date = date('Y-m-d H:i:s');
        $price_history->save();
        // photo of the seller product
        $sp_photo_input =  $request->main_product_image_input;
        $sp_photo_name = "sp_photo_main_"."SessionID_".session()->getId()."_".microtime().".".$sp_photo_input->getClientOriginalExtension();
        //file storage disk configuration can be found in config/filesystems.php
        //storing the photo name in the public disk         
        Storage::disk('public_uploads')->put($sp_photo_name,File::get($sp_photo_input));
        $s_p_photo = new SPPhoto;
        $s_p_photo->sp_id = $seller_product->sp_id;
        $s_p_photo->photo = $sp_photo_name;
        $s_p_photo->save();
        if(isset($request['product_image_input'])){
            foreach ($request->product_image_input as $key => $sp_photo_input) {
                if(isset($request['product_image_input'][$key])){
                    $sp_photo_name = "sp_photo{$key}_"."SessionID_".session()->getId()."_".microtime().".".$sp_photo_input->getClientOriginalExtension();
            //file storage disk configuration can be found in config/filesystems.php
            //storing the photo name in the public disk         
                    Storage::disk('public_uploads')->put($sp_photo_name,File::get($sp_photo_input));
                    $s_p_photo = new SPPhoto;
                    $s_p_photo->sp_id = $seller_product->sp_id;
                    $s_p_photo->photo = $sp_photo_name;
                    $s_p_photo->save();
                }
            }
        }

        // option group and option
        $option_groups = $request->option_group;
        foreach ($option_groups as $og_key=>$options) {
            $og_name = $options['option_group_name'];
            if($options["option_group_name"]!="" || $options["option_group_name"]!=null){
                // creating a new option group
                $option_group = new OptionGroup;
                $option_group->option_g_name = $og_name;
                $option_group->save();
                foreach ($options as $o_key => $option) { 
                    if($o_key!='option_group_name'){
                    // creating a new option
                        $new_option = new Option;
                        $new_option->option_g_id = $option_group->option_g_id;
                        $new_option->option_name = $option["option_name"];
                        $option_photo = $option["option_image"];
                        $option_photo_name= "option_photo_"."SessionID_".session()->getId()."_".microtime().".".$option_photo->getClientOriginalExtension();
                    //file storage disk configuration can be found in config/filesystems.php
                    //storing the photo name in the public disk         
                        Storage::disk('public_uploads')->put($option_photo_name,File::get($option_photo));
                        $new_option->photo = $option_photo_name;
                        $new_option->save();   
                    // assigning the option to the seller product in the seller product option group relation table
                        $s_p_option_relation = new SPOptionRelation;
                        $s_p_option_relation->option_id = $new_option->option_id;
                        $s_p_option_relation->sp_id = $seller_product->sp_id;
                        $s_p_option_relation->number_of_items = $option["number_of_items"];
                        $s_p_option_relation->save();
                    }
                }
            }
        }

        // features
        
        foreach ($request->feature as $key => $single_feature) {
            if($single_feature["name"]!=null&& $single_feature["value"]!=null){
                $sp_feature = new SPFeatureList;
                $sp_feature->sp_id = $seller_product->sp_id;
                $sp_feature->feature = $single_feature["name"];
                $sp_feature->value = $single_feature["value"];
                $sp_feature->save();
            }       
        }
        
        //returning the success response
        return response()->json(['success'=>['New Product is added'],'sp_id' => $seller_product->sp_id,'errors'=>'']);      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
