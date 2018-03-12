<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;
use Config;

/**
 * Class Order
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $delivery
 * @property string $address
 * @property time $time
 * @property string $payment_type
 * @property tinyInteger $is_ur
 * @property string $attachment
 * @property string $ur_name
 * @property string $ur_inn
 * @property string $ur_nls
 * @property enum $status
*/
class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'delivery', 'address', 'time', 'payment_type', 'is_ur', 'attachment', 'ur_name', 'ur_inn', 'ur_nls', 'comment', 'status'];
    

    public static $enum_status = ["waiting" => "Ожидание оплаты", "success" => "Оплачен", "failed" => "Не оплачен"];

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['time'] = Carbon::createFromFormat('H:i', $input)->format('H:i');
        } else {
            $this->attributes['time'] = null;
        }
    }
    
    public function setSuccessStatus(){
        $this->status = 'success';
        $this->save();
    }
    
    
    public function setFailStatus() {
        $this->status = 'failed';
        $this->save();
    }

    public function isSuccess(){
        return $this->getOriginal('status') == "success";
    }
    public function getFullSum() {
        $total = 0;
         foreach($this->products as $product)
         {
          $total += $product->pivot->count*$product->getCurrentPrice();
        }
        if ($total < Config::get('site.free_delivery_sum')&&$this->delivery==1){
            $total+=Config::get('site.delivery_price');
        }
        return $total;
        
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            return Carbon::createFromFormat('H:i:s', $input)->format('H:i');
        } else {
            return '';
        }
    }
    
    public function getCreatedAtAttribute($input) {
       
         if ($input != null && $input != '') {
            return Carbon::createFromTimestamp(strtotime($input))->addHour(3);
        } else {
            return '';
        }
    }
    public function getStatusAttribute($input)
    {
        switch ($input) {
                case 'waiting':
                    return 'Ожидание оплаты';
                case 'success':
                    return 'Оплачен';
                case 'failed':
                    return 'Ошибка оплаты';
                  
                default:
                  return 'неизвестный';   
            }
    }
    
     public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product','order_id','product_id')->withPivot('count');
    }
}
