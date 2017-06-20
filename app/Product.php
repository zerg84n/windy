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
    
    public function setPropertyValue($property_id,$value) {
        $property = Models\Catalog\Property::find($property_id);
        $model =  $property->value_type;
        $value_model = $model::firstOrCreate([
            'property_id'=>$property_id,
            'product_id'=>  $this->id,
            'category_id'=>  $this->category->id
        ]);
        $value_model->value =  $value;
        $value_model->save();
        
    }
    
    public function getPropertyValue($property_id) {
        
        return !is_null($this->getProperty($property_id))?$this->getProperty($property_id)->value:null;
        
    }
    
      public function getProperty($property_id) {
        $property = Models\Catalog\Property::find($property_id);
        if ($property){
            $model =  $property->value_type;
            $value_model = $model::firstOrCreate([
                'property_id'=>$property_id,
                'product_id'=>  $this->id,
                'category_id'=>  $this->category->id
            ]);
            if ($value_model){
                 return $value_model;
            }else{
                return null;
            }
        } else {
             return null;
        }
      
        
    }
    


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }
    
    public function values() {
        $values = collect();
        $category = $this->category;
        $properties = $category->properties;
        if ($properties->count()>0){
            foreach($properties as $property){
                $value = $this->getProperty($property->id);
                $values->push($value);
            }
            
        }
        return $values;
    }
     public function getProperties() {
        $values = collect();
        $category = $this->category;
        $properties = $category->properties;
        
        return $properties;
    }
    
    public function getPublishedReviews(){
        return $this->hasMany(Review::class, 'product_id')->where('published','=',1)->get();
    }

        public function reviews() {
        return $this->hasMany(Review::class, 'product_id');
    }
    
    
   
    
}
