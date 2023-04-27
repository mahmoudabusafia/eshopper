<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Routing\Route;

class OrderCancelledNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Cancelled!')
            ->from('eshopper@support.com', 'Eshopper')
            ->greeting('Sorry to cancel your order!') // mail رسالة ترحيبية في بداية
            ->line('Your order has been canceled because more than an hour has passed on your order and there is no delivery service to accept it. Please re-order again.')
            ->action('View Order', route('viewOrder',$this->order->id)) // عبارة عن زر لما اضغط عليه يوديني على الرابط
            ->line('Thanks for your cooperation!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Order Cancelled!',
            'body' => 'Your order has been canceled because more than an hour has passed on your order and there is no delivery service to accept it. Please re-order again.',
            'url' => route('viewOrder',$this->order->id),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
