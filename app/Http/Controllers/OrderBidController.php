<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Globalization;

class OrderBidController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $is_connected = Order::whereId($id)->get()->last()->is_connected;
        if($is_connected === 0){
            $global = Globalization::index();
            $order = Order::whereId($id)->get()->last()->bid;
            return view("order-bid.index", compact("global", "order", "id"));
        }
        else {
            return "Pesanan kadaluarsa!";
        }
    }
}
