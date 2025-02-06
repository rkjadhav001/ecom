<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Model\Order;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $o_id;

    public function __construct($o_id)
    {
        $this->o_id = $o_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $o_id = $this->o_id;

        $order = Order::with('seller')->with('shipping')->where('id', $o_id)->first();
        $data["email"] = $order->customer["email"];
        $data["order"] = $order;

        return $this->view('email-templates.order-placed')->with('order', $order);
    }
}
