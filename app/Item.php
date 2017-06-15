<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @package App
 * @property string $title
 * @property string $url
*/
class Item extends Model
{
    protected $fillable = ['title', 'text' ,'url'];
    
    
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'item_menu');
    }
     public function parents()
    {
        return $this->belongsToMany(Menu::class, 'menu_item');
    }
    public function getFirstMenu()
    {
        if ($this->menus){
            return $this->parents->first();
        } else {
            return null;
        }
        
    }
}
