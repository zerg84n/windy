<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Catalog\Property;
use App\Models\Catalog\Variant;

class ValueEnum extends Model
{
       protected  $guarded = [];
    const INPUT_TYPE = 'select';
    
    public function getType() {
        return self::INPUT_TYPE;
    }
     public function setValueAttribute($input)
    {
        $this->attributes['value'] = (int)$input;
    }
    
      public function getValueAttribute($value)
    {
         if ($value){
             if (Variant::find($value)){
                 return Variant::find($value)->value;
             } else {
                 return null;
             }
            
         } else {
             return null;
         }
        
    }
    
       public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
    
    public function variant(){
        return $this->belongsTo(Variant::class, 'value');
    }
    
}
