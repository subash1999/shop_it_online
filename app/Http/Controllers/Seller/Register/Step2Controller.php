<?php

namespace App\Http\Controllers\Seller\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewSeller;
use App\Seller;
use App\User;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Storage;
class Step2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     $user = $request->user;

     return view('seller/seller_register/seller_register_pages/seller_register_step_2',compact('user'));
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
    public function store(StoreNewSeller $request)
    {

        $seller = new Seller;
        // return $request->user;
        $user = json_decode($request->user);
        $seller->user_id = $user->user_id;
        $seller->first_name = $request->first_name;
        $seller->middle_name = $request->middle_name;
        $seller->last_name = $request->last_name;
        $seller->dob = $request->dob;
        $seller->gender = $request->gender;
        $seller->company_name = $request->company_name;
        $seller->email1 = $user->email;
        $seller->add1 = $request->address;
        $seller->phone1 = $request->phone_country."-".$request->phone;
        $seller->city = $request->city;
        $seller->country = $request->country;
        $seller->postal_code = $request->postal_code;
        if($request->fax!=""){
            $seller->fax = $request->fax_country."-".$request->fax;
        }
        else{
            $seller->fax = "";
        }
        $photo_name = "Seller_". $user->user_id."_photo_"."SessionID_".session()->getId()."_".microtime().".".$request->file('your_certificate_input')->extension();
        //file storage disk configuration can be found in config/filesystems.php
        //storing the photo name in the public disk         
        Storage::disk('public_uploads')->put($photo_name,File::get($request->file('your_photo_input')));
        $seller->photo = $photo_name;
        
        $identity_name = "Seller_". $user->user_id."_identity_"."SessionID_".session()->getId()."_".microtime().".".$request->file('your_certificate_input')->extension();        
        Storage::disk('public_uploads')->put($identity_name,File::get($request->file('your_id_input')));
        $seller->identity = $identity_name;

        $cover_name = "Seller_". $user->user_id."_cover_"."SessionID_".session()->getId()."_".microtime().".".$request->file('your_certificate_input')->extension();           
        Storage::disk('public_uploads')->put($cover_name,File::get($request->file('your_cover_input')));        
        $seller->cover_photo = $cover_name;

        $certificate_name = "Seller_". $user->user_id."_certificate_"."SessionID_".session()->getId()."_".microtime().".".$request->file('your_certificate_input')->extension();
        Storage::disk('public_uploads')->put($certificate_name,File::get($request->file('your_certificate_input')));
        
        $seller->certificate = $certificate_name;
        // uncomment location only after the map is included in the form
        // $seller->location = $request->location;
        $seller->phone1_verify = "YES";
        $seller->phone2_verify = "YES";
        $seller->photo_verify = "YES";
        $seller->save();
        //user verify to NO so that the user won't be deleted in certain period
        $user = User::find($user->user_id);
        $user->user_verify = "NO";
        $user->email_verified_at = Carbon::now();
        $user->save();
        // return ($seller);
        return redirect("/");
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
