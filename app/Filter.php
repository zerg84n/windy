<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Filter
 *
 * @package App
 * @property string $query
 * @property string $slug
*/
class Filter extends Model
{
    protected $fillable = ['query', 'slug'];
    
    
  
    
    
}
