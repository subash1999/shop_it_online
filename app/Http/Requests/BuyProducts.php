<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyProducts extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string|min:1|max:150',
            'email'=>'email|min:1|max:100',
            'phone'=>'string|required|min:1|max:30',
            'bill_address'=>'required|string|min:1|max:300',
            'bill_country'=>'required|string|min:1|max:300',
            'bill_city'=>'required|string|min:1|max:300',
            'ship_address'=>'required|string|min:1|max:300',
            'ship_country'=>'required|string|min:1|max:300',
            'ship_city'=>'required|string|min:1|max:300',
            'pay_method'=>'required|string|min:1|max:200',
            'curr_id'=>'required|integer|exists:currencies,curr_id',
            'dc_id'=>'nullable|integer',
            'payable_amount'=>'required|numeric|gt:0',
            'total_price'=>'required|numeric|gt:0',
            'total_items'=>'required|integer|gt:0',
            'country_code'=>'required',
            'user_id'=>'nullable|integer',
        ];
    }
}
