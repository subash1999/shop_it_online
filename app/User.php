<?php

namespace App;

use App\Admin;
use App\Currency;
use App\Customer;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\UserHelper;
use App\Notifications\MailResetPasswordNotification;
use App\Seller;
use App\UserType;
use App\UserTypeRelation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
  use Notifiable;
  use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey='user_id';
    protected $fillable = [
      'username', 'email', 'password',
    ];
    
    
    public function getRouteKeyName()
    {
      return 'user_id';
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password', 'remember_token',
    ];


    protected $dates = ['deleted_at'];
    protected $table = 'users';

    // // the notification for sending the user with the password reset message 
    // public function sendPasswordResetNotification($token)
    // {
    //   $this->notify(new MailResetPasswordNotification($token));
    // }
    // below code is for the auto hash generation donot use it if you are hasing the password yourself in registration , if you want auto hash donot hash password in anyother form
    public function setPasswordAttribute($pass){

      $this->attributes['password'] = Hash::make($pass);

    }
    public function getDiscountCoupons()
    {
      $dc =DiscountCoupon::where('user_id',$this->user_id)->get();
      return $dc;      
    }
    function getDCAmountInCurrenctCurrency($dc_id)
    {
      $c_h = new CurrencyHelper; 
      $dc = DiscountCoupon::find($dc_id);
      $amount = $dc->amount;
      $u_h = new UserHelper;
      $to_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
      $conv_amount  =  $c_h->currencyConvert($dc->curr_id,$to_curr_id,$amount);
      return $conv_amount;
    }
    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
      $user_ids = [];
      $user_types=UserType::where('type','=',$type)->get();
      if(count($user_types)>0){
        foreach ($user_types as $user_type) {
          $user_type_relations = UserTypeRelation::where('ut_id','=',$user_type->ut_id)->get();
          foreach ($user_type_relations as $user_type_relation) {
            array_push($user_ids,$user_type_relation->user_id);

          }
        }
      }
      else{
        return $query;
      }
      return $query->whereIn("user_id",$user_ids);
    }
    public function getCurrentCurrencySymbol()
    {
      $c_h = new CurrencyHelper;
      return $c_h->getCurrentCurrencySymbol();
      
    }

    public function getUserChoiceCurrencyId()
    {
      // getting the first curreny from db incase there is no user logined or no data present in session
      $currency = Currency::first();
      $curr_id = $currency->curr_id;
      // first check if the user is authenticated
      $temp_curr_id = Auth::user()->curr_id;
      if($temp_curr_id!=null){
        $curr_id = $temp_curr_id;
      }
      else if (session('curr_id')!=null){
        $curr_id = session('curr_id');
        // checking if the stored curr_id exists in db if  not set another value
        $currency = Currency::find($curr_id);
        if(count($currency)<=0){
          $currency = Currency::first();
          $curr_id = $currency->curr_id;
        }
        // save the currency id stored in the session to db if the curr_id in db is null        
        if( $this->curr_id==null){
          $user = $this;
          $user->curr_id = session('curr_id');
          $user->save();
        }
        
      }
    // checking if the stored curr_id exists in db if  not set another value
      $currency = Currency::find($curr_id);
      if(count($currency)<=0){
        $currency = Currency::first();
        $curr_id = $currency->curr_id;
      }
      return $curr_id;
    }
    public function setCurrentUserChoiceCurrencyId($curr_id)
    {
      $currency = Currency::find($curr_id);
      if(count($currency)<=0){
        abort(403,"The currency ID is not in db while assiging curreny for user");
      }
      // setting the first curreny from db incase there is no user logined or no data present in session
      session(['curr_id'=>$curr_id]);
      $user = Auth::user();
      $user->curr_id = $curr_id;
      $user->save();            
      return $curr_id;
    }
    public function isAdmin()
    {
      $is_admin = false;
      $utrs = UserTypeRelation::with('userType')->where('user_id',$this->user_id)->get();
      if ($utrs!=null) {
        foreach ($utrs as $utr) {
          $type = $utr->userType->type;
          if(strcasecmp($type,'admin')==0){
            $is_admin = true;
          }
        }
      }
      return $is_admin;
    }
    public function isSeller()
    {
      $is_admin = false;
      $utrs = UserTypeRelation::with('userType')->where('user_id',$this->user_id)->get();
      if ($utrs!=null) {
        foreach ($utrs as $utr) {
          $type = $utr->userType->type;
          if(strcasecmp($type,'seller')==0){
            $is_admin = true;
          }
        }
      }
      return $is_admin;
    }
    public function isCustomer()
    {
      $is_admin = false;
      $utrs = UserTypeRelation::with('userType')->where('user_id',$this->user_id)->get();
      if ($utrs!=null) {
        foreach ($utrs as $utr) {
          $type = $utr->userType->type;
          if(strcasecmp($type,'customer')==0){
            $is_admin = true;
          }
        }
      }
      return $is_admin;
    }
    public function getPhoto(){
      $photo = null;
      if($this->isSeller()){
        $seller = Seller::where('user_id',$this->user_id)->first();
        $photo = $seller->photo;
      }
      else if($this->isAdmin()){
        $admin = Admin::where('user_id',$this->user_id)->first();
        $photo = $admin->photo;
      }
      else if($this->isCustomer()){
        $customer = Customer::where('user_id',$this->user_id)->first();
        $photo = $customer->photo;
      }
      return $photo;

    } 
    function getPhotoUrl()
    {
      $photo = $this->getPhoto();
      if($photo!=null){
        $photo = asset('storage/uploads/'.$photo);
      }
      return $photo;
      
    }
    public function getGender(){
      $gender = null;
      if($this->isSeller()){
        $seller = Seller::where('user_id',$this->user_id)->first();
        $gender = $seller->gender;
      }
      else if($this->isAdmin()){
        $admin = Admin::where('user_id',$this->user_id)->first();
        $gender = $admin->gender;
      }
      else if($this->isCustomer()){
        $customer = Customer::where('user_id',$this->user_id)->first();
        $gender = $customer->gender;
      }
      return $gender;

    } 
    public function getFullName(){
      $name = null;
      if($this->isSeller()){
        $seller = Seller::where('user_id',$this->user_id)->first();
        $name = $seller->first_name." ". $seller->last_name;
      }
      else if($this->isAdmin()){
        $admin = Admin::where('user_id',$this->user_id)->first();
        $name = $admin->first_name." ". $admin->last_name;
      }
      else if($this->isCustomer()){
        $customer = Customer::where('user_id',$this->user_id)->first();
        $name = $customer->first_name." ". $customer->last_name;
      }

      return $name;
    } 
    public function getEmail(){

      return $this->email;
    } 
    public function getPhone(){
      $name = null;
      if($this->isSeller()){
        $seller = Seller::where('user_id',$this->user_id)->first();
        $name = $seller->phone1;
      }
      else if($this->isAdmin()){
        $admin = Admin::where('user_id',$this->user_id)->first();
        $name = $admin->phone1;
      }
      else if($this->isCustomer()){
        $customer = Customer::where('user_id',$this->user_id)->first();
        $name = $customer->phone1;
      }

      return $name;
    }
    public function getAddress(){
      $name = null;
      if($this->isSeller()){
        $seller = Seller::where('user_id',$this->user_id)->first();
        $name = $seller->add1;
      }
      else if($this->isAdmin()){
        $admin = Admin::where('user_id',$this->user_id)->first();
        $name = $admin->add1;
      }
      else if($this->isCustomer()){
        $customer = Customer::where('user_id',$this->user_id)->first();
        $name = $customer->add1;
      }

      return $name;
    } 
    public function getCity(){
      $name = null;
      if($this->isSeller()){
        $seller = Seller::where('user_id',$this->user_id)->first();
        $name = $seller->city;
      }
      else if($this->isAdmin()){
        $admin = Admin::where('user_id',$this->user_id)->first();
        $name = $admin->city;
      }
      else if($this->isCustomer()){
        $customer = Customer::where('user_id',$this->user_id)->first();
        $name = $customer->city;
      }

      return $name;
    } 
    public function getCountry(){
      $name = null;
      if($this->isSeller()){
        $seller = Seller::where('user_id',$this->user_id)->first();
        $name = $seller->country;
      }
      else if($this->isAdmin()){
        $admin = Admin::where('user_id',$this->user_id)->first();
        $name = $admin->country;
      }
      else if($this->isCustomer()){
        $customer = Customer::where('user_id',$this->user_id)->first();
        $name = $customer->country;
      }

      return $name;
    } 

    
    

    public function getType()
    {
      $user_id = $this->userr_id;
      $user = User::with('userTypeRelations.userType')->find($user_id);
      $type=[];
      foreach ($user->userTypeRelations as $user_type_relation) {
        array_push($type,$user_type_relation->userType->type);
      }
      if(count($type)==1){
        return $type[0];
      } 
        // for the multitype user with all users in a list
      else{
        return $type;
      }
    }
    public function getFullAddress(){
      $full_address = null;
      if($this->isSeller()){
        $seller = Seller::where('user_id',$this->user_id)->first();
        $full_address = $seller->add1.",".$seller->city.",".$seller->country;
      }
      else if($this->isAdmin()){
        $admin = Admin::where('user_id',$this->user_id)->first();
        $full_address = $admin->add1.",".$admin->city.",".$admin->country;
      }
      else if($this->isCustomer()){
        $customer = Customer::where('user_id',$this->user_id)->first();
        $full_address = $customer->add1.",".$customer->city.",".$customer->country;
      }
      return $full_address;

    } 
    public function getCurrentWallet(){
      $wallet = Wallet::where('user_id',$this->user_id)->orderBy('created_at', 'desc')->first();
      return $wallet;
    } 
    public function getCurrentWalletAmount()
    {
      // currency_helper 
      $currency_helper = new CurrencyHelper;
      $u_h = new UserHelper;
      $current_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
      $wallet = 0;      
      $wallet = $this->getCurrentWallet();
      if($wallet!=null){
        $wallet = $currency_helper->currencyConvert($wallet->curr_id,$current_curr_id,$wallet->amount);       
      }
      return $wallet;
    }
    public function getWalletAmountWithCurrencySymbol()
    {
    // currency_helper 
      $currency_helper = new CurrencyHelper;
      $currency_symbol =  $currency_helper->getCurrentCurrencySymbol(); 
      $u_h = new UserHelper;
      $current_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
      $wallet = 0;      
      $wallet = $this->getCurrentWallet();
      if($wallet!=null){
        $wallet = $currency_helper->currencyConvert($wallet->curr_id,$current_curr_id,$wallet->amount);       
      }

      return $currency_symbol." ".$wallet;
    }
     // for checking if the password entered matches the current users 
    public function checkPasswordAjax($password)
    {
      $pass = $password;
      $hasher = app('hash');
      if ($hasher->check($pass, $this->password)) {
        return "1";
      }
      return "0";
    }
    public function checkPassword($pass)
    {
      $hasher = app('hash');
      if ($hasher->check($pass, $this->password)) {
        return true;
      }
      return false;
    }

    /**
         * User belongs to Customer.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
    public function customer()
    {
        // belongsTo(RelatedModel, foreignKey = _id, keyOnRelatedModel = id)
      return $this->belongsTo('App\Customer','user_id','user_id');
    }
    /**
     * User belongs to Seller.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        // belongsTo(RelatedModel, foreignKey = _id, keyOnRelatedModel = id)
      return $this->belongsTo('App\Seller','user_id','user_id');
    }
    /**
        * User belongs to Admin.
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
    public function admin()
    {
        // belongsTo(RelatedModel, foreignKey = admin_id, keyOnRelatedModel = id)
      return $this->belongsTo('App\Admin','user_id','user_id');
    }
    /**
     * User has many UserTypeRelation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userTypeRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
      return $this->hasMany('App\UserTypeRelation','user_id','user_id');
    }

    public function withTrashedUserTypeRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
      return $this->hasMany('App\UserTypeRelation','user_id','user_id')->withTrashed();
    }

    public function bills()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
      return $this->hasMany('App\Bill','user_id','user_id');
    }

    /**
     * User has many ProductClicks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productClicks()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = user_id)
      return $this->hasMany('App\ProductClick','user_id','user_id');
    }

    /**
     * User has many Rewards.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rewards()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = to_user_id, localKey = user_id)
      return $this->hasMany('App\Reward','to_user_id','user_id');
    }

    /**
     * User has many Messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentMessages()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = from_user_id, localKey = user_id)
      return $this->hasMany('App\Message','from_user_id','user_id');
    }

    /**
     * User has many Messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivedMessages()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = to_user_id, localKey = user_id)
      return $this->hasMany('App\Message','to_user_id','user_id');
    }

    /**
     * User has many Feedbacks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentFeedbacks()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = from_user_id, localKey = user_id)
      return $this->hasMany('App\Feedback','from_user_id','user_id');
    }

    /**
     * User has many Feedbacks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivedFeedbacks()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = to_user_id, localKey = user_id)
      return $this->hasMany('App\Feedback','to_user_id','user_id');
    }

    /**
     * User has many ProductRatings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productRatings()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = user_id)
      return $this->hasMany('App\ProductRating','user_id','user_id');
    }

    /**
     * User has many Complains.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complains()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = user_id)
      return $this->hasMany('App\Complain','user_id','user_id');
    }

    /**
     * User has many ShoppingCarts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shoppingCarts()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = user_id)
      return $this->hasMany('App\ShoppingCart','user_id','user_id');
    }

    /**
     * User has many VerificationCodes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function verificationCodes()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = user_id)
      return $this->hasMany('App\VerificationCode','user_id','user_id');
    }

    /**
     * User has many Wishlists.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlists()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = user_id)
      return $this->hasMany('App\Wishlist','user_id','user_id');
    }

    /**
     * User has many Notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = user_id)
      return $this->hasMany('App\Notification','user_id','user_id');
    }

    /**
     * User has many Wallets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wallets()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = user_id)
      return $this->hasMany('App\Wallet','user_id','user_id');
    }

    /**
     * User has many Sessions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
      return $this->hasMany(Session::class,'user_id','user_id');
    }

    /**
     * User belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        // belongsTo(RelatedModel, foreignKey = currency_id, keyOnRelatedModel = id)
      return $this->belongsTo('App\Currency','curr_id','curr_id');
    }
     /**
     * Customer has many TransistionHistory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function transistionHistory()
     {
      // hasMany(RelatedModel, foreignKeyOnRelatedModel = cus_id, localKey = cus_id)
      return $this->hasMany('App\TransistionHitory','cus_id','cus_id');
    }
     /**
     * Customer has many DiscountCopuons.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function discountCopuons()
     {
      // hasMany(RelatedModel, foreignKeyOnRelatedModel = cus_id, localKey = cus_id)
      return $this->hasMany('App\DiscountCoupon','cus_id','cus_id');
    }

  }


