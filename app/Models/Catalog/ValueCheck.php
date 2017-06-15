<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class ValueCheck extends Model
{
      protected  $guarded = [];
    const INPUT_TYPE = 'checkbox';
    
    public function getType() {
        return self::INPUT_TYPE;
    }
     public function setValueAttribute($input)
    {
       
        $this->attributes['value'] = (int)$input;
        $this->save();
    }
       public function getValueAttribute($value)
    {
       return (int) $value;
    }
    
       public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
