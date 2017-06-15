<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Product;
use App\Models\Catalog\Property;
/**
 * Class Category
 *
 * @package App
 * @property string $title
 * @property string $description
*/
class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description'];
    
    
      public function products()
    {
        return $this->hasMany(Product::class);
    }
      public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
    
}
