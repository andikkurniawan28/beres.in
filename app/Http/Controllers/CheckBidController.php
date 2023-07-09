<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Notification;
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
        $customer_number = Sale::createSalesThenGetCustomerNumber($request);
        Bid::getPartnerIdThenNotifyPartner($request, $customer_number);
        return redirect("https://wa.me/6285733465399");
    }
}
