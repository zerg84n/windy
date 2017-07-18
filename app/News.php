<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class News
 *
 * @package App
 * @property string $title
 * @property string $short
 * @property text $full_text
 * @property string $photos
*/
class News extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['title', 'short', 'full_text', 'photos'];
    
    
}
