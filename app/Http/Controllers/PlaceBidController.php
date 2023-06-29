<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Globalization;

class PlaceBidController extends Controller
{
    public function index($order_id, $partner_id){
        $global = Globalization::index();
        $order = Order::whereId($order_id)->get()->last();
        $partner_name = User::whereId($partner_id)->get()->last()->name;
        return view("place-bid.index", compact("global", "order", "partner_name", "partner_id", "order_id"));
    }

    public function process(Request $request){
        $bid_id = Bid::where("user_id", $request->user_id)
            ->where("order_id", $request->order_id)
            ->get()->last()->id;
        Bid::whereId($bid_id)->update([
            "description" => $request->description,
            "price" => $request->price,
        ]);
        return "Tawaran sudah sampai ke Customer, kalau Customer OK kita akan hubungi lagi. Mohon ditunggu ya :)";
        // return $request->all();
    }
}
