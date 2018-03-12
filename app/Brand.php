<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Brand
 *
 * @package App
 * @property string $title
 * @property string $slug
*/
class Brand extends Model
{
    protected $fillable = ['title', 'slug'];
    
    
}
