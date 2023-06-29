<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Globalization;

class PaymentBidController extends Controller
{
    public function index($bid_id){
        $global = Globalization::index();
        $bid = Bid::whereId($bid_id)->get()->last();
        return view("payment-bid.index", compact("global", "bid"));
    }

    public function process(Request $request){
        $bid = Bid::whereId($request->bid_id)->get()->last();
        Order::whereId($bid->order_id)->update(["is_paid" => 1]);
        Notification::notifyPartnerThatOrderHasBeenPaid($request);
    }
}
