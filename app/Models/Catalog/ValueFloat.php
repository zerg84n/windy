<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class ValueFloat extends Model
{
     protected  $guarded = [];
    const INPUT_TYPE = 'float';
    
    public function getType() {
        return self::INPUT_TYPE;
    }
     public function setValueAttribute($input)
    {
        $this->attributes['value'] = (float)$input;
    }
    
     public function getValueAttribute($value)
    {
       return $value;
    }
    
       public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
