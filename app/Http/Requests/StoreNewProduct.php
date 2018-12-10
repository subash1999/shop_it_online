<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreNewProduct extends FormRequest
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
        // dd($this->request->all());
        $rules = $this->custom_rules();
        return $rules;
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

    public $validator = null;
    public function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
    public function withValidator(Validator $validator) : void
    {
        $validator->after(function (Validator $validator){
            $total_number_of_options = 0;
        // finding the total number of options
            foreach ($this->option_group as $og_key => $option_group) {
                foreach ($option_group as $o_key => $option) {
                    if ($o_key!="option_group_name" && $option_group["option_group_name"]!="") {
                        $total_number_of_options+=$option["number_of_items"];
                    }
                }
            }
              //check if the option available doesnot exceed the total number of the products entered
            if($this->quantity<$total_number_of_options){
                $validator->errors()->add("quantity",'The total number of items in produt\'s options exceed the number of total quantity of product'); 
            }

        });   
    }
    public function custom_rules()
    {
        $rules = [
            'selected_category'=>'required|exists:categories,cate_name',
            'product_name'=>'required|max:255',
            'description'=>'required|max:2000',
            'quantity'=>'required|integer',
            'unit_price'=>'required|numeric',
            'main_product_image_input'=>'required|image|mimes:jpeg,bmp,png|max:1500',
            'product_image_input.*'=>'nullable|image|max:1500'
        ];
        // dd($rules);
        // for options
        $option_groups = $this->option_group;
        foreach ($option_groups as $og_key=>$option_group) {
            $options = $option_group;
            if($option_group['option_group_name']!=null || $option_group['option_group_name']!=""){

                $option_group_name = [
                    "option_group".$og_key.".option_group_name"=>'required|max:255',
                ];
                array_merge($rules,$option_group_name);
                foreach ($options as $o_key => $option) {
                    if($o_key!='option_group_name'){

                        $name = "option_group.".$og_key.".".$o_key.".option_name";
                        $number_of_items = "option_group.".$og_key.".".$o_key.".number_of_items";
                        $image = "option_group.".$og_key.".".$o_key.".option_image";
                        $rules_sub_array = [
                            $name=>'required|max:255',
                            $number_of_items => 'required|integer|min:0',
                            $image=>'required|max:1500|image',
                        ];
                        $rules = array_merge($rules,$rules_sub_array);

                    }
                }
            }
            else{
                $option_group_name = [
                    "option_group".$og_key.".option_group_name"=>'nullable|max:255',
                ];
                foreach ($options as $o_key => $option) {
                    if($o_key!='option_group_name'){
                        $name = "option_group.".$og_key.".".$o_key.".option_name";
                        $number_of_items = "option_group.".$og_key.".".$o_key.".number_of_items";
                        $image = "option_group.{$og_key}.{$o_key}.option_image";
                        $rules_sub_array = [
                            $name=>'nullable|max:255',
                            $number_of_items => 'nullable|integer|min:0',
                            $image=>'nullable|max:1500|image',
                        ];
                        $rules = array_merge($rules,$rules_sub_array);
                    }     
                }
            }
        }
    // for features
        $features = $this->feature;

        foreach ($features as $key => $feature) {
            $name = "feature.".$key.".name";                
            $value = "feature.".$key.".value";
            if($feature['name']!=null || $feature['name']!="" || $feature['value']!=null || $feature['value']!=""){             
                $rules_sub_array = [
                    $name=>'required|max:255',
                    $value=>'required|max:255',
                ];
                $rules = array_merge($rules,$rules_sub_array);
            }
            else{
                $rules_sub_array = [
                    $name=>'nullable|max:255',
                    $value=>'nullable|max:255',
                ];
                $rules = array_merge($rules,$rules_sub_array);
            }
        }
        $additional_rules=[
            'sp_name2'=>'nullable|max:255',
            'sp_name3'=>'nullable|max:255',
            'sp_name4'=>'nullable|max:255',
            'sp_name5'=>'nullable|max:255',
        ];

        $rules = array_merge($rules,$additional_rules);      


        return $rules;
    }

}

