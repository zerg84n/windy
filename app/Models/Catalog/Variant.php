<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = ['value', 'property_id'];
}
