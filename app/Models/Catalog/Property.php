<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Category;

use App\Models\Catalog\ValueInt;
use App\Models\Catalog\ValueStr;
use App\Models\Catalog\ValueCheck;
use App\Models\Catalog\ValueEnum;
use App\Models\Catalog\Variant;

class Property extends Model
{
      protected $fillable = ['title', 'value_type'];
     
    const VALUE_TYPES = [
        'text'=>ValueStr::class,
        'number'=>ValueInt::class,
        'select'=>ValueEnum::class,
        'checkbox'=>ValueCheck::class
    ];  
    
      const FORM_TYPES = [
        ''=>'Укажите тип',
        'text'=>'Текстовый',
        'number'=>'Числовой',
        'select'=>'Список',
        'checkbox'=>'Галочка'
    ];  
      
   public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    
    public function getValue($product_id){
        
        $model = $this->value_type;
        
        $value = $model::find(['product_id'=>$product_id, 'property_id'=>$this->id]);
        if ($value){
            return $value->value;
        }else{
            return null;
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
