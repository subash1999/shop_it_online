<?php

namespace App;

use App\Http\Helpers\CategoryHelper;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\UserHelper;
use App\SPPriceHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerProduct extends Model
{
    use SoftDeletes;
    protected $primaryKey='sp_id';
    protected $dates = ['deleted_at'];
    protected $table = 'seller_products';



    public function getAvailableQuantity()
    {
        $this->remaining;
        
    }
    
    public function getPriceOfSellerProduct()
    {
        $sp_id = $this->sp_id;
        // price of the product
        $prices = SPPriceHistory::where('sp_id','=',$sp_id)->where('to_date','=',null)->orderBy('from_date','desc')->first();
        return round($prices->price,2);
    }
    public function getCurrentPriceObjectOfSellerProduct()
    {
        $sp_id = $this->sp_id;
        // price of the product
        return SPPriceHistory::where('sp_id','=',$sp_id)->where('to_date','=',null)->orderBy('from_date','desc')->first();
    }
    public function getCurrencyNameOfSellerProduct()
    {
        $sp_id = $this->sp_id;
        // price of the product
        $prices = SPPriceHistory::with('currency')->where('sp_id','=',$sp_id)->where('to_date','=',null)->orderBy('from_date','desc')->first();
        return $prices->currency->currency_name;

    }
    public function getCurrencySymbolOfSellerProduct()
    {
        $sp_id = $this->sp_id;
        // price of the product
        $prices = SPPriceHistory::with('currency')->where('sp_id','=',$sp_id)->where('to_date','=',null)->orderBy('from_date','desc')->first();
        $curr_helper = new CurrencyHelper;
        $curr_symbol = $curr_helper->getCurrencySymbol($prices->currency->curr_id);
        return $curr_symbol;

    }
    // gives the price in the current currency format
    public function getCurrentCurrencyPriceOfSellerProduct()
    {
        $sp_id = $this->sp_id;
        $user_helper = new UserHelper;
        $to_curr_id = $user_helper-> getCurrentUserChoiceCurrencyId();
        $price = $this->getPriceOfSellerProduct($sp_id);
        $from_curr_id = $this->getCurrentPriceObjectOfSellerProduct($sp_id)->curr_id;
        $currency_helper = new CurrencyHelper;
        return $currency_helper->currencyConvert($from_curr_id,$to_curr_id,$price);
    }
    public function getCategory()
    {
        return $this->Product->categoryProductRelations[0]->category->cate_name;
    }
    public function isOfPriceRange($min,$max)
    {
        $current_price = $this->getCurrentCurrencyPriceOfSellerProduct();
        if($current_price>=$min&&$current_price<=$max){
            return true;
        }
        return false;
    }
    public function CategoryListToWhichItBelong()
    {
      $c_h = new CategoryHelper;
      $cate_ids=$c_h->getCategoryIdLocationOfSellerProduct($this->sp_id);
      // dd($cate_ids);
      return $cate_ids;
    }
    
    /**
     * SellerProduct belongs to Seller.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
    	// belongsTo(RelatedModel, foreignKey = seller_id, keyOnRelatedModel = id)
    	return $this->belongsTo('App\Seller','seller_id','seller_id');
    }

    /**
     * SellerProduct belongs to Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
    	// belongsTo(RelatedModel, foreignKey = p_id, keyOnRelatedModel = id)
    	return $this->belongsTo('App\Product','p_id','p_id');
    }

    /**
     * SellerProduct has many Offers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
    	return $this->hasMany('App\Offer','sp_id','sp_id');
    }

    /**
     * SellerProduct has many SellerProductRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packageProductRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\SellerProductRelation','sp_id','sp_id');
    }



    /**
     * SellerProduct has many TransistionHistories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transistionHistories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\TransistionHistory','sp_id','sp_id');
    }

    /**
     * SellerProduct has many ProductClicks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productClicks()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\ProductClick','sp_id','sp_id');
    }

    /**
     * SellerProduct has many Feedbacks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedbacks()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\Feedback','sp_id','sp_id');
    }

    /**
     * SellerProduct has many ProductRatings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productRatings()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\ProductRating','sp_id','sp_id');
    }

    /**
     * SellerProduct has many ShoppingCarts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shoppingCarts()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\ShoppingCart','sp_id','sp_id');
    }

    /**
     * SellerProduct has one SellerStock.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sellerStock()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasOne('App\SellerStock','sp_id','sp_id');
    }

    /**
     * SellerProduct has many ProductOptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productOptions()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\ProductOption','sp_id','sp_id');
    }

    /**
     * SellerProduct has many SPPaymentRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SPPaymentRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\SPPaymentRelation','sp_id','sp_id');
    }

    /**
     * SellerProduct has many SPPhotos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SPPhotos()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\SPPhoto','sp_id','sp_id');
    }

    /**
     * SellerProduct has many PredefinedWholesaleQuantities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function predefinedWholesaleQuantities()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\PredefinedWholesaleQuantity','sp_id','sp_id');
    }

    /**
     * SellerProduct has many CustomWholesaleQuantities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customWholesaleQuantities()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\CustomWholesaleQuantity','sp_id','sp_id');
    }

    /**
     * SellerProduct has many Items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\Item','sp_id','sp_id');
    }

    /**
     * SellerProduct has many SPUniqueProperties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SPUniqueProperties()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\SPUniqueProperty','sp_id','sp_id');
    }

    /**
     * SellerProduct has one AutoProductDivision.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function autoProductDivision()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasOne('App\AutoProductDivision','sp_id','sp_id');
    }

    /**
     * SellerProduct has many SPFeatureLists.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SPFeatureLists()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\SPFeatureList','sp_id','sp_id');
    }

    /**
     * SellerProduct has many SPShippings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SPShippings()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\SPShipping','sp_id','sp_id');
    }

    /**
     * SellerProduct has many Wishlists.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlists()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany('App\Wishlists','sp_id','sp_id');
    }

    /**
     * SellerProduct has many SPOPtionRelations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SPOPtionRelations()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sp_id, localKey = sp_id)
        return $this->hasMany(SPOPtionRelation::class,'sp_id','sp_id');
    }

    /**
     * SellerProduct has many SPPriceHistory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SPPriceHistory()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = sellerProduct_id, localKey = id)
        return $this->hasMany('App\SPPriceHitory','sp_id','sp_id');
    }
}
