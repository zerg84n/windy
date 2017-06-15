<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class ValueStr extends Model
{
     const INPUT_TYPE = 'text';
      protected  $guarded = [];
      
    public function getType() {
        return self::INPUT_TYPE;
    }
  
   
     public function setValueAttribute($input)
    {
        $this->attributes['value'] = (string)$input;
    }
    
       public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
