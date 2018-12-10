<?php

namespace App\Mail;

use App\Http\Helpers\CurrencyHelper;
use App\SPOptionRelation;
use App\SellerProduct;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ConfirmPuarchase extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $url = URL::temporarySignedRoute(
            'buy_products', now()->addMinutes(30), ['data' => json_encode($request->all())]);
        $items = $this->billData($request);
        $c_h = new CurrencyHelper;
        $curr_symbol = $c_h->getCurrentCurrencySymbol();
        // dd($url);
        // $user = User::inRandomOrder()->first();
        // dd($request->all());
        return $this->view('mails/confirm_puarchase',['bill_info'=>$request->all(),'url'=>$url,'wl_items'=>$items,'currency_symbol'=>$curr_symbol])->to($request->email);
    }

    public function billData($request)
    {
       
        $dis_fraction = ($request->total_price - $request->payable_amount)/$request->total_price;
        $items = (array) $request->items;
        if($items==null){
            $items = [];
        }
        $its = [];
        foreach ($items as $item) {
            $it = [];
            $it['sp_id'] = $item['sp_id'];
            $it['spor_id'] = $item['spor_id'];
            $it['qty'] = $item['qty'];
            $it['option']="NA";
            $sp = SellerProduct::with('SPPhotos')->find($it['sp_id']);
            $it['name'] = $sp->sp_name1;
            $it['company_name'] = $sp->company_name;
            $it['unit_price'] = $sp->getCurrentCurrencyPriceOfSellerProduct();
            $it['total_price'] = $it['unit_price'] *  $it['qty'] ;
            $it['payable_amount'] = $it['total_price'] * (1-$dis_fraction);
            $it['photo'] = $sp->SPPhotos[0]->photo;
            if($it['spor_id']!=null){
                $spor = SPOptionRelation::with('option.OptionGroup')->find($item['spor_id']);
                if($spor!=null){
                    $option_name = $spor->Option->option_name;
                    $option_g_name = $spor->Option->OptionGroup->option_g_name;
                    $it["option"] = $option_g_name. " :: ".$option_name;
                    $it['photo'] =  $spor->Option->photo;
                }
            }
            array_push($its, $it);            
        }
        return $its;
    }
}
