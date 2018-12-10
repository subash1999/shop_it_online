<?php

namespace App\Http\Controllers\Customer;

use App\Bill;
use App\Http\Controllers\Controller;
use App\Http\Helpers\CurrencyHelper;
use App\Mail\BillMail;
use App\SPOptionRelation;
use App\SPPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BillController extends Controller
{
	public function index(Request $request)
	{		
		$bill = Bill::find($request->bill_id);
		$c_h = new CurrencyHelper;
        // dd($request->all());
		$currency_symbol = $c_h->getCurrencySymbol(Bill::with('currency')->find($request->bill_id)->Currency->curr_id);
		$wl_items = $this->getItems($request->bill_id);
		return view('mails.bill_mail',['bill'=>$bill,'wl_items'=>$wl_items,'currency_symbol'=>$currency_symbol]);
	}
	function sendBillByEmail(Request $request)
	{
		Mail::send(new BillMail($request->bill_id,$request->email));
		return response()->json(['bill_sending_success'=>'Your bill was sent to you at the email you provided']);
	}
	public function getItems($bill_id)
	{
		$items = [];
		$bill = Bill::with('billTransistionRelations.transistionHistory.sellerProduct.seller')->find($bill_id);
        // dd($bill);
		if($bill==null){
			return  $items;
		}
		foreach ($bill->billTransistionRelations as $bill_relation) {
			$item = [];
			$tran = $bill_relation->transistionHistory;
			$item['photo'] = SPPhoto::where('sp_id',$tran->SellerProduct->sp_id)->first()->photo;
			$item['sp_id'] = $tran->sp_id;
			$item['name'] = $tran->SellerProduct->sp_name1;
			$item['company_name'] = $tran->SellerProduct->seller->company_name;
			$item['option'] = '';
			if($tran->spor_id!=null){
				$spor = SPOptionRelation::with('option.optionGroup')->find($tran->spor_id);
				if($spor!=null){
					$item['option'] = $spor->Option->OptionGroup->option_g_name . ' :: '.$spor->Option->option_name;
					$item['photo'] = $spor->Option->photo; 
				}
			}
			$item['qty'] = $tran->quantity;
			$item['unit_price'] = $tran->unit_price;
			$item['total_price'] = $tran->unit_price * $tran->quantity;
			$item['payable_amount'] = $tran->final_unit_price;
			array_push($items, $item);

		}
		return $items;
	}
}
