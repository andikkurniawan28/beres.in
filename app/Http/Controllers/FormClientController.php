<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Service;
use App\Models\ActivityLog;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Globalization;
use App\Models\PartnerExpertise;

class FormClientController extends Controller
{
    public function index(){
        $global = Globalization::index();
        $services = Service::all();
        return view("form-client.index", compact("global", "services"));
    }

    public function process(Request $request){
        $request->request->add(["phone_number" => "62".$request->phone_number]);
        Order::create($request->all());
        $order_id = Order::getOrderIdByDescription($request);
        $partner_list = PartnerExpertise::selectPartnerWhereExpertise($request);
        foreach($partner_list as $partner_list){
            Bid::insertFromPartnerList($partner_list, $order_id);
            ActivityLog::insert(["description" => "Create Bid for ".User::whereId($partner_list->user_id)->get()->last()->name."."]);
            Notification::notifyPartner($partner_list->user_id, $order_id, $request);
        }
        Notification::notifyClient($request, $order_id);
        ActivityLog::insert(["description" => $request->name." create order."]);
        return redirect()->route("order-bid", $order_id);
    }
}
