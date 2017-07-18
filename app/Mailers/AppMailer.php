<?php

namespace App\Mailers;

//use Illuminate\Contracts\Mail\Mailer;
////use \Illuminate\Mail\Mailer;
use Mail;

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
    protected $from = 'windy@windy.ru';

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
            'title'  => 'На сайте windy заказан обратный звонок.',
            'text'  => "Имя: ".$name." номер: ".$phone,
           
            
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
