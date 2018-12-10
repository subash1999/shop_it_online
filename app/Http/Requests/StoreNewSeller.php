<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewSeller extends FormRequest
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
            //validation for seller's information
            'user'=>'required',
            'first_name'=>'required|max:60',
            'middle_name'=>'max:60|nullable',
            'last_name'=>'required|max:60',
            'dob'=>'required|date',
            'gender'=>'required',
            'your_photo_input'=>'required|max:1500|image',
            'your_id_input'=>'required|max:1500|image',
            'company_name'=>'required|max:500',            
            'your_cover_input'=>'max:1500|image|nullable',
            'your_certificate_input'=>'required|max:2500|image',
            'phone'=>'required|numeric',            
            'fax'=>'numeric|nullable',
            'country'=>'required',
            'city'=>'required|max:300',
            'address'=>'required|max:300',            
            'postal_code'=>'required|max:10',
        ];
    }

    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */
    public function messages()
    {
        return [
            'max'    => 'The :attribute must be less than :max KB.',
          
        ];
    }
}
