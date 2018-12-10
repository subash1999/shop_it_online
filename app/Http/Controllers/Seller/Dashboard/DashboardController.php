<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Http\Controllers\Controller;
use App\Seller;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->getProductVisits();
        $max = $result['max'];
        $visits = $result['data'];
        $status =$this->productStatus();
        // dd($status);
        return view('seller/seller_dashboard/seller_dashboard_pages/seller_dashboard/seller_dashboard',['max_visits'=>$max,'visits'=>$visits,'status'=>$status]);
    }
    public function getProductVisits()
    {
        $max = 0;
        $seller = Seller::with('sellerProducts.productClicks')->where('user_id',Auth::id())->first();
        $data = [];
        for ($i = 0; $i <7 ; $i++) {
            $data[$i]['date'] = Carbon::today()->subDays($i)->toFormattedDateString();  
            $data[$i]['clicks'] = 0;
            foreach ($seller->sellerProducts as $sp) {
                foreach ($sp->productClicks as $pc) {
                    if(Carbon::today()->diffInDays($pc->created_at)==$i){
                        $data[$i]['clicks']+=1;
                    }
                }
                
            }
            if($data[$i]['clicks']>$max){
                $max = $data[$i]['clicks'];
            }
        }
        $result['max']=$max;
        $result['data'] = $data;
        return $result;
    }
    public function productStatus()
    {
       $av = 0;
       $sold =0;
       $seller = Seller::with('sellerProducts')->where('user_id',Auth::id())->first();
       foreach ($seller->SellerProducts as $sp) {
           $av += $sp->remaining;
           $sold+=$sp->sold; 
       }
       return(['available'=>$av,'sold'=>$sold]);

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
    public function store(Request $request)
    {
        //
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
