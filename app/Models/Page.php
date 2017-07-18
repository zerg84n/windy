<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Page extends Model  implements HasMedia
{
     use SoftDeletes, HasMediaTrait;

    protected $fillable = ['title', 'alias', 'full_text', 'photos'];
    
}
