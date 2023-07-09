<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Globalization;

class PlaceBidController extends Controller
{
    public function index($order_id, $partner_id){
        $global = Globalization::index();
        $order = Order::whereId($order_id)->get()->last();
        if($order->is_open === 1){
            $partner_name = User::whereId($partner_id)->get()->last()->name;
            return view("place-bid.index", compact("global", "order", "partner_name", "partner_id", "order_id"));
        }
        else {
            return view("place-bid.expired", compact("global"));
        }
    }

    public function process(Request $request){
        $order = Order::whereId($request->order_id)->get()->last();
        $request->request->add([
            "phone_number" => $order->phone_number,
        ]);
        $bid_id = Bid::where("user_id", $request->user_id)->where("order_id", $request->order_id)->get()->last()->id;
        Bid::whereId($bid_id)->update(["description" => $request->description, "price" => $request->price]);
        return Notification::notifyBidIsPlaced($request);
    }
}
