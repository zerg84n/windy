<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;
/**
 * Class Menu
 *
 * @package App
 * @property string $title
*/
class Menu extends Model
{
    protected $fillable = ['title', 'text'];
    
      public function items()
    {
        return $this->belongsToMany(Item::class, 'menu_item');
    }
}
