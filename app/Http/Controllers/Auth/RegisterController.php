<?php

namespace App\Http\Controllers\Auth;

use App\Currency;
use App\Customer;
use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\UserTypeRelation;
use App\Wallet;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'gender'=>['required','string'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => 'required|string|max:30',
            'country'=>'required|string',
            'city'=>'required|string|max:150',
            'address'=>'required|string|max:200',
            'username'=>'required|string|max:50|unique:users,username',            
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // dd($data);
        $user = new User;
        $user->username = $data['username'];
        $user->email = $data['email'];
        // automatically hashes the password form the user model
        $user->password = $data['password'];
        $saved = $user->save();
        if(!$saved){
            abort(403,'Error while saving user in register controller create function');
        }
        switch (strtolower($data['user_type'])) {
            case "customer":
            $user_type = UserType::where('type','customer')->first();
            if($user_type==null){
                $user->forceDelete();
                abort(403,'Matching user type customer not found in user_types table in db ');
            }
            $utr = new UserTypeRelation;
            $utr->ut_id = $user_type->ut_id;
            $utr->user_id = $user->user_id;
            if(!$utr->save()){
                $user->forceDelete();
                abort(403,'User Type Relation Could not be saved in user_types table in db ');
            }

            // we have to input the information for the new customer also
            $customer = new Customer;
            $customer->user_id = $user->user_id;
            $customer->first_name = $data['first_name'];
            $customer->last_name = $data['last_name'];
            $customer->gender = $data['gender'];        
            $customer->email1 = $data['email'];
            $customer->add1 = $data['address'];
            $customer->phone1 = $data['phone'];
            $customer->city = $data['city'];
            $customer->country = $data['country'];
            $cus_save = $customer->save();
            if(!$cus_save){
                            // deleting the user form db because same email can be used to create the another account if unsuccessful
                $user->forceDelete();
                abort(403,'Error while creating a new customer in register Controller create function');
            }
            $wallet = new Wallet;
            $wallet->user_id = $user->user_id;
            $wallet->credit = 0;
            $wallet->debit = 0;
            $wallet->amount = 0;
            $currency = Currency::first();
            $wallet->curr_id = $currency->curr_id;
            $wallet->description = "Creation of account";
            if(!$wallet->save()){
                $user->forceDelete();
                $utr->forceDelete();
                $customer->forceDelete();
                abort(403,'Wallet not saved in customer registration');
            };
            break;
            default:
            $user->forceDelete();
            abort(403,'No user type matched the user type in registration ');
            break;
        }

        return $user;
    }
}
