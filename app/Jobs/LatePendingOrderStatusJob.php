<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCancelledNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class LatePendingOrderStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orders = Order::where('status', 'pending')->whereDate('created_at', '<=', Carbon::now()->subHour(1))->get();
        foreach ($orders as $order){
            $order->update([
                'status' => 'cancelled',
                'payment_status' => 'refund', //  Refund the payment process and return the money to its owner (supplement the correct process)
            ]);
            $user = User::findOrfail($order->user_id);

            Notification::send($user, new OrderCancelledNotification($order));
        }


    }
}
