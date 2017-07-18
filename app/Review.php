<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;
/**
 * Class Review
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property integer $score
 * @property text $text
 * @property tinyInteger $published
 * @property string $item
 * @property integer $session_id
*/
class Review extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'score', 'text', 'published', 'session_id', 'product_id'];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setScoreAttribute($input)
    {
        $this->attributes['score'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setItemIdAttribute($input)
    {
        $this->attributes['product_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setSessionIdAttribute($input)
    {
        $this->attributes['session_id'] = $input ? $input : null;
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
}