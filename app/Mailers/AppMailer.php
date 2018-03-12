<?php

namespace App\Mailers;

//use Illuminate\Contracts\Mail\Mailer;
////use \Illuminate\Mail\Mailer;
use Mail;
use App\Order;
class AppMailer
{

    /**
     * The Laravel Mailer instance.
     *
     * @var Mailer
     */
    protected $mailer;

    /**
     * The sender of the email.
     *
     * @var string
     */
    protected $from = 'info@windytech.ru';

    /**
     * The recipient of the email.
     *
     * @var string
     */
    protected $to;

    /**
     * The view for the email.
     *
     * @var string
     */
    protected $view;

    /**
     * The data associated with the view for the email.
     *
     * @var array
     */
  
    protected $data;
    protected $subject;
    /**
     * Create a new app mailer instance.
     *
     * @param Mailer $mailer
     */
   

    /**
     * Deliver the email confirmation.
     *
     * @param  User $user
     * @return void
     */

    
    
    
public  function orderCall($name, $phone)
    {
        $this->to = 'info@windytech.ru';  
        $this->view = 'emails.call_order';
      
        $this->subject = 'Заказан обратный звонок.';
      
        
         $this->data = [
            'title'  => 'На сайте windytech заказан обратный звонок.',
            'text'  => "Имя: ".$name." номер: ".$phone,
           
            
        ];
        
        $this->deliver();
    }
    
    public  function existCall($name, $phone,$email,$product)
    {
        $this->to = 'info@windytech.ru';  
       
        $this->view = 'emails.exist_order';
      
        $this->subject = 'Запрос на уточнение наличия товара.';
      
        
         $this->data = [
            'title'  => "Запрос на уточнение наличия товара",
            'phone'  =>  $phone,
             'email'=>$email,
             'name'=>$name,
             'product'=>$product
           
            
        ];
        
        $this->deliver();
    }
      public  function exist_clientNotify($name,$email,$product)
    {
        $this->to = $email; 
       
        $this->view = 'emails.exist_notify';
      
        $this->subject = 'Запрос на уточнение наличия товара.';
      
        
         $this->data = [
            'text'  => "Запрос на уточнение наличия товара",
            'name'=>$name,
            'product'=>$product
           
            
        ];
        
        $this->deliver();
    }
    
    
    
      public function newOrderNotifyAdmin(Order $order) {
        
        $this->to = 'info@windytech.ru';  
        $this->view = 'emails.new_order';
      
        $this->subject = 'На сайте windytech новый заказ №'.$order->id;
      
        
         $this->data = [
            'title'  => 'На сайте windytech новый заказ №'.$order->id,
            'order'  => $order,
           
            
        ];
         
       
        $this->deliver();
        
    }
       
      public function newOrderNotifyClient(Order $order) {
        
        $this->to = $order->email?$order->email:'info@windytech.ru';  
        $this->view = 'emails.client_order';
      
        $this->subject = 'Ваш заказ №. '.$order->id;
      
        
         $this->data = [
            'title'  => 'Ваш заказ №'.$order->id.' поступил в обработку, в ближайшее время
 с вами свяжутся для уточнения деталей.',
            'order'  => $order,
           
            
        ];
         
       
        $this->deliver();
        
    }
    
        public function payedOrderNotifyAdmin(Order $order) {
        
        $this->to = 'info@windytech.ru';  
        $this->view = 'emails.payed_order';
      
        $this->subject = 'Поступила оплата заказа'.$order->id;
      
        
         $this->data = [
            'title'  => 'Заказ оплачен.',
            'order'  => $order,
           
            
        ];
         
       
        $this->deliver();
        
    }
       public function failOrderNotifyAdmin(Order $order) {
        
        $this->to = 'info@windytech.ru';  
        $this->view = 'emails.payed_order';
      
        $this->subject = 'Внимание! Не завершенный заказ'.$order->id;
      
        
         $this->data = [
            'title'  => 'Заказ не завершен.',
            'order'  => $order,
           
            
        ];
         
       
        $this->deliver();
        
    }
    
    
      public function payProccessNotifyAdmin(Order $order) {
        
        $this->to = 'info@windytech.ru';  
        $this->view = 'emails.new_order';
      
        $this->subject = 'Внимание! Пользователь перешел к оплате заказа '.$order->id;
      
        
         $this->data = [
            'title'  => 'Заказ в процессе оплаты.',
            'order'  => $order,
           
            
        ];
         
       
        $this->deliver();
        
    }

    /**
     * Deliver the email.
     *
     * @return void
     */
    public function deliver()
    { 
        Mail::send($this->view, $this->data, function ($message) {
            $message->from($this->from, 'Windy')
                    ->to($this->to)
                    ->subject($this->subject);
        });
        
       /* $mailer->send('emails.auth.verify', $data, function($message) {
            $message->to($this->user->email, $this->user->username)
                    ->subject(trans('front/verify.email-title'));
        });*/
    }
}
