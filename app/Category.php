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

    protected $fillable = ['title', 'description','slug','menu_id','articul_code'];
    public $timestamps = false;
    
    public function getBrands(){
        $brand_ids = Product::where('category_id',  $this->id)->get()->pluck('brand_id')->toArray();
        $brands = Brand::whereIn('id',$brand_ids)->get();
        return $brands;
    }
        public function getHitFirst()
    {
        return $this->hasMany(Product::class)->orderBy('popular','desc');
    }
    
    public function getArticulCodeAttribute($value){
        
        if($value){
            return $value;
        }
        
        if ($this->id<10){
            return '00';
        } else {
            return $this->id;
        }
       
        
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
      public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
    
       public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    
}
