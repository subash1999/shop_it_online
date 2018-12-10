<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CurrencyHelper;
use App\Mail\ConfirmPuarchase;
use App\ProductClick;
use App\SellerProduct;
use App\TransistionHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
class HomeController extends Controller
{
    private $sp_ids=[];
    private $featured_count = 0;
    private $featured_iterations = 0;
    private $featureds = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c_h = new CurrencyHelper;
        $curr_symb = $c_h->getCurrentCurrencySymbol();
        $rec_view = $this->recentlyViewed();
        // dd($rec_view);
        $banner = $this->banner();
        $deals = $this->deals();
        $deals2 = $this->deals2();
        $this->featuredProducts();
        $banner2 = $this->banner2($banner['sp_id']);
        return view('public/pages/home/home',['rec_view'=>$rec_view,'curr_symb'=>$curr_symb,'banner'=>$banner,'deals'=>$deals,'deals2'=>$deals2,'featureds'=>$this->featureds,'banner2'=>$banner2]);
    }
    public function banner2($banner_id)
    {
       $ban = [];
       $sp = SellerProduct::with('SPPhotos')->inRandomOrder()->whereNotIn('sp_id',[$banner_id])->first();
       $ban["photo"] = $sp->SPPhotos[0]->photo;
       $ban['price'] =  $sp->getCurrentCurrencyPriceOfSellerProduct();
       $ban['name'] = $sp->sp_name1;
       $ban['sp_id'] = $sp->sp_id;
       $ban['photo'] = asset('storage/uploads/'.$ban["photo"]);
       $sp = SellerProduct::with('product.categoryProductRelations.category')->find($sp->sp_id);
       array_push($this->sp_ids, $sp->sp_id);
       $ban['category'] = $sp->product->categoryProductRelations[0]->cate_name;
       return $ban;
   }

   public function recentlyViewed()
   {
    $items = [];
    $pcs = ProductClick::inRandomOrder()->with('sellerProduct.SPPhotos')->latest()->get();
    $i=0;
    foreach ($pcs as $pc) {
        if($i<6){
            $item =[];
            $item['sp_id'] = $pc->SellerProduct->sp_id;
            $item['name'] = $pc->SellerProduct->sp_name1;
            $item['price'] = $pc->SellerProduct->getCurrentCurrencyPriceOfSellerProduct();
            $item['photo'] = $pc->SellerProduct->SPPhotos[0]->photo;
            $item['photo'] = asset('storage/uploads/'.$item["photo"]);
            $item["new"] = false;
            if(Carbon::now()->diffInDays($pc->SellerProduct->created_at)<5){
                $item["new"] = true;                
            }
            array_push($items,$item);
        }

    }
    $i = 0;
    if($pcs==null||count($pcs)!=5){
        $sps = SellerProduct::with('SPPhotos')->latest()->limit(5-count($pcs)); 
        foreach ($sps as $sp) {
           if($i<6){
               $item =[];
               $item['sp_id'] = $sp->sp_id;
               $item['name'] = $sp->sp_name1;
               $item['price'] = $sp->getCurrentCurrencyPriceOfSellerProduct();
               $item['photo'] = $sp->SPPhotos[0]->photo;
               $item['photo'] = asset('storage/uploads/'.$item["photo"]);
               $item["new"] = false;
               if(Carbon::now()->diffInDays($sp->SellerProduct->created_at)<5){
                $item["new"] = true;
            }
            array_push($items,$item);
        }
    }
}
return $items;
}
public function banner()
{   $ban = [];
    $sp = SellerProduct::with('SPPhotos')->inRandomOrder()->first();
    $ban["photo"] = $sp->SPPhotos[0]->photo;
    $ban['price'] =  $sp->getCurrentCurrencyPriceOfSellerProduct();
    $ban['name'] = $sp->sp_name1;
    $ban['sp_id'] = $sp->sp_id;
    $ban['photo'] = asset('storage/uploads/'.$ban["photo"]);
    $sp = SellerProduct::with('product.categoryProductRelations.category')->find($sp->sp_id);
    array_push($this->sp_ids, $sp->sp_id);
    $ban['category'] = $sp->product->categoryProductRelations[0]->cate_name;
    return $ban;
}
public function deals()
{   $deals = [];

    $ths =TransistionHistory::select('sp_id')
    ->groupBy('sp_id')
    ->orderByRaw('COUNT(*) DESC')
    ->limit(4)
    ->get();
    $sps = null;

    if($ths==null){
        $ths = [];
    }
    foreach ($ths as $th) {
     $sp =  SellerProduct::with('SPPhotos')->where('sp_id',$th->sp_id)->first();
     $deal = [];
     $deal['name'] = $sp->sp_name1;
     $deal['sp_id'] = $sp->sp_id;
     $deal['price'] = $sp->getCurrentCurrencyPriceOfSellerProduct();
     $deal['photo'] = $sp->SPPhotos[0]->photo;
     $deal['photo'] = asset('storage/uploads/'.$deal["photo"]);
     $deal['available'] = $sp->remaining;
     $deal['sold'] = $sp->sold;
     $deal['category'] = $sp->getCategory();         
     array_push($deals, $deal);     
     array_push($this->sp_ids, $sp->sp_id);

 }
 if(count($ths)<4){
    $sps =  SellerProduct::with('SPPhotos')->inRandomOrder()->get();            
    if($sps==null){
        $sps = [];

    }
    $i = 4-count($th);
    foreach ($sps as $sp) {
        if(!$i<=4){
            break;
        }
        $deal = [];
        $deal['name'] = $sp->sp_name1;
        $deal['sp_id'] = $sp->sp_id;
        $deal['price'] = $sp->getCurrentCurrencyPriceOfSellerProduct();
        $deal['photo'] = $sp->SPPhotos[0]->photo;
        $deal['photo'] = asset('storage/uploads/'.$deal["photo"]);
        $deal['available'] = $sp->remaining;
        $deal['sold'] = $sp->sold;
        $deal['category'] = $sp->getCategory();         
        array_push($deals, $deal);     
        array_push($this->sp_ids, $sp->sp_id);


    }

}
return $deals;
}
public function deals2()
{   $deals = [];

    $ths =TransistionHistory::select('sp_id')
    ->groupBy('sp_id')
    ->orderByRaw('COUNT(*) ASC')
    ->limit(4)
    ->get();
    $sps = null;

    if($ths==null){
        $ths = [];
    }
    foreach ($ths as $th) {
     $sp =  SellerProduct::with('SPPhotos')->where('sp_id',$th->sp_id)->first();
     $deal = [];
     $deal['name'] = $sp->sp_name1;
     $deal['sp_id'] = $sp->sp_id;
     $deal['price'] = $sp->getCurrentCurrencyPriceOfSellerProduct();
     $deal['photo'] = $sp->SPPhotos[0]->photo;
     $deal['photo'] = asset('storage/uploads/'.$deal["photo"]);
     $deal['available'] = $sp->remaining;
     $deal['sold'] = $sp->sold;
     $deal['category'] = $sp->getCategory();         
     array_push($deals, $deal);     
     array_push($this->sp_ids, $sp->sp_id);

 }
 if(count($ths)<4){
    $sps =  SellerProduct::with('SPPhotos')->inRandomOrder()->get();            
    if($sps==null){
        $sps = [];

    }
    $i = 4-count($th);
    foreach ($sps as $sp) {
        if(!$i<=4){
            break;
        }
        $deal = [];
        $deal['name'] = $sp->sp_name1;
        $deal['sp_id'] = $sp->sp_id;
        $deal['price'] = $sp->getCurrentCurrencyPriceOfSellerProduct();
        $deal['photo'] = $sp->SPPhotos[0]->photo;
        $deal['photo'] = asset('storage/uploads/'.$deal["photo"]);
        $deal['available'] = $sp->remaining;
        $deal['sold'] = $sp->sold;
        $deal['category'] = $sp->getCategory();         
        array_push($deals, $deal);     
        array_push($this->sp_ids, $sp->sp_id);


    }

}
return $deals;
}
public function featuredProducts()
{
    $pcs= ProductClick::with('sellerProduct')->select('sp_id')
    ->groupBy('sp_id')
    ->orderByRaw('COUNT(*) DESC')
    ->limit(8)
    ->get();
    if($pcs==null){
        $pcs = [];
    }
    // dd($pcs);
    foreach ($pcs as $pc) {
        $sp = SellerProduct::with('SPPhotos')->find($pc->sp_id);
        $featured = [];
        $featured['name'] = $sp->sp_name1;
        $featured['sp_id'] = $sp->sp_id;
        $featured['price'] = $sp->getCurrentCurrencyPriceOfSellerProduct();
        for($i=0;;$i++){
            $photo = $sp->SPPhotos[0]->photo;
            if($sp->SPPhotos[0]->photo!=null){
                $featured['photo'] = $photo;
                break;
            }
        }        
        $featured['photo'] = asset('storage/uploads/'.$featured["photo"]);
        $featured['available'] = $sp->remaining;
        $featured['sold'] = $sp->sold;
        $featured['category'] = $sp->getCategory();  
        $featured["new"] = false;
        if(Carbon::now()->diffInDays($sp->created_at)<5){
            $featured["new"] = true;
        }
        array_push($this->featureds, $featured);
        $this->featured_count ++;
    }

    $this->featured_iterations ++;
    if($this->featured_iterations>4){
        return $this->featureds;
    }
    else if($this->featured_count<8){
        $this->featuredProducts();
    }
    else{
        return $this->featureds;
    }

}

}
