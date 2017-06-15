<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Catalog\Property;
class ValueInt extends Model
{
    protected  $guarded = [];
    const INPUT_TYPE = 'number';
    
    public function getType() {
        return self::INPUT_TYPE;
    }
     public function setValueAttribute($input)
    {
        $this->attributes['value'] = (int)$input;
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
