<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Sale;
use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Globalization;
use App\Models\PartnerExpertise;
use Illuminate\Support\Facades\Auth;

class ApplicationPartnerController extends Controller
{
    public function index(){
        $global = Globalization::index();
        $expertise = PartnerExpertise::where("user_id", Auth()->user()->id)->get();
        return view("application-partner.index", compact("global", "expertise"));
    }

    public function avalaible(){
        User::whereId(Auth()->user()->id)->update(["is_avalaible" => 1]);
        return redirect()->route("application-partner.index");
    }

    public function rest(){
        User::whereId(Auth()->user()->id)->update(["is_avalaible" => 0]);
        return redirect()->route("application-partner.index");
    }

    public function pesanan(){
        $global = Globalization::index();
        $bid = Bid::where("user_id", Auth()->user()->id)->orderBy("id", "desc")->get();
        return view("application-partner.pesanan", compact("global", "bid"));
    }

    public function pesananByBidId($bid_id){
        $global = Globalization::index();
        $bid = Bid::whereId($bid_id)->get()->last();
        return view("application-partner.pesananByBidId", compact("global", "bid"));
    }

    public function tawar(Request $request){
        $bid_id = Bid::where("user_id", $request->user_id)->where("order_id", $request->order_id)->get()->last()->id;
        Bid::whereId($bid_id)->update(["description" => $request->description, "price" => $request->price]);
        return redirect()->route("application-partner.pesananByBidId", $bid_id);
    }

    public static function selesai($order_id){
        $sale = Sale::where("order_id", $order_id)->get()->last();
        Order::close($sale->order_id);
        Notification::notifyOrderIsClosed($sale);
        User::partnerIsAvalaible($sale->bid->user_id);
        return redirect()->route("application-partner.pesanan");
    }

    public static function tambahLayanan(){
        $global = Globalization::index();
        $service = Service::all();
        return view("application-partner.tambahLayanan", compact("global", "service"));
    }

    public static function tambahLayananProses(Request $request){
        PartnerExpertise::updateOrCreate([
            "service_id" => $request->service_id,
            "user_id" => $request->user_id,
        ]);
        return redirect()->route("application-partner.index");
    }
}
