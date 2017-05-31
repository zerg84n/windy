<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Specification
 *
 * @package App
 * @property string $title
 * @property string $value_text
 * @property integer $value_number
*/
class Specification extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'value_text', 'value_number'];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setValueNumberAttribute($input)
    {
        $this->attributes['value_number'] = $input ? $input : null;
    }
    
}
