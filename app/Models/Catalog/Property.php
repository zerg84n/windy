<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Category;

use App\Models\Catalog\ValueInt;
use App\Models\Catalog\ValueStr;
use App\Models\Catalog\ValueCheck;
use App\Models\Catalog\ValueEnum;
use App\Models\Catalog\Variant;
use App\Models\Catalog\ValueFloat;

class Property extends Model
{
      protected $fillable = ['title', 'value_type','alias'];
     
    const VALUE_TYPES = [
        'text'=>ValueStr::class,
        'number'=>ValueInt::class,
        'float'=>ValueFloat::class,
        'select'=>ValueEnum::class,
        'checkbox'=>ValueCheck::class
    ];  
    
      const FORM_TYPES = [
        ''=>'Укажите тип',
        'text'=>'Текстовый',
        'number'=>'Числовой',
        'float'=>'Дробное',
        'select'=>'Список',
        'checkbox'=>'Галочка'
    ];  
      
   public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function getInputType() {
         $model = $this->value_type;
         return $model::INPUT_TYPE;
    }
    
    public function getValue($product_id){
        
        $model = $this->value_type;
        
        $value = $model::find(['product_id'=>$product_id, 'property_id'=>$this->id])->first();
       
        if ($value){
            return $value->value;
        }else{
            return null;
        }
        
    }
     public function getOriginalValue($product_id){
       
        $model = $this->value_type;
        
        $value = $model::where(['product_id'=>$product_id, 'property_id'=>$this->id])->first();
        
     
        if ($value){
            return $value->getOriginal('value');
        }else{
            return null;
        }
        
    }
    public function getRange($category = null) {
        if ($this->variants->count()>0){
            return $this->variants;
        } else {
             $model = $this->value_type;
             
             $values = $model::where('property_id','=',  $this->id);
             if($category){
                 $values->where('category_id','=',$category->id);
                 
             }
              $values =  $values->orderBy('value','asc')->get()->filter(function ($value, $key) {
                    return !is_null($value->value);
                  })->unique('value');
                  
             if ($values->count()>0){
                
                     if ( is_null($values->first()->value )) {
                         $values->shift();
                         
                     }
                
                
             
                return $values;
             
             } else {
                 return $values;
             }
        }
        
    }
    
    public function setValueTypeAttribute($input) {
        $types = self::VALUE_TYPES;
        if (array_key_exists($input,$types)){
             $this->attributes['value_type'] = $types[$input];
        } else {
             $this->attributes['value_type'] = $types['text'];
        }
         
        
    }
    
    public function variants() {
         return $this->hasMany(Variant::class);
    }
}
