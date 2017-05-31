<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Product
 *
 * @package App
 * @property string $title
 * @property string $description
 * @property decimal $price_original
 * @property decimal $price_sale
 * @property string $category
 * @property integer $status
 * @property integer $amount
 * @property tinyInteger $popular
 * @property string $photos
*/
class Product extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['title', 'description', 'price_original', 'price_sale', 'status', 'amount', 'popular', 'photos', 'category_id'];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPriceOriginalAttribute($input)
    {
        $this->attributes['price_original'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPriceSaleAttribute($input)
    {
        $this->attributes['price_sale'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCategoryIdAttribute($input)
    {
        $this->attributes['category_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setStatusAttribute($input)
    {
        $this->attributes['status'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setAmountAttribute($input)
    {
        $this->attributes['amount'] = $input ? $input : null;
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }
    
    public function specifications()
    {
        return $this->belongsToMany(Specification::class, 'product_specification')->withTrashed();
    }
    
}
