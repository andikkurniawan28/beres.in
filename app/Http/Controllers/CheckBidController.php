<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Globalization;

class CheckBidController extends Controller
{
    public function index($order_id, $partner_id){
        $global = Globalization::index();
        $bid = Bid::where("order_id", $order_id)->where("user_id", $partner_id)->get()->last();
        return view("check-bid.index", compact("global", "bid"));
    }

    public function process(Request $request){
        Bid::whereId($request->bit_id)->update(["is_accepted" => 1]);
        $order_id = Bid::whereId($request->bid_id)->get()->last()->id;
        Order::whereId($order_id)->update(["is_connected" => 1]);
        return "Silahkan melakukan pembayaran";
    }
}
