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
use App\Http\Requests\PesanRequest;
use Illuminate\Support\Facades\Auth;

class ApplicationCustomerController extends Controller
{
    public function index(){
        $global = Globalization::index();
        $service = Service::all();
        return view("application-customer.index", compact("global", "service"));
    }

    public function pesan($service_id){
        $global = Globalization::index();
        $service = Service::all();
        return view("application-customer.pesan", compact("global", "service", "service_id"));
    }

    public function pesanan($user_id){
        $global = Globalization::index();
        $order = Order::where("user_id", $user_id)->orderBy("id", "desc")->limit(5)->get();
        return view("application-customer.pesanan", compact("global", "order"));
    }

    public static function pesananByOrderId($order_id){
        $global = Globalization::index();
        $order = Order::whereId($order_id)->get()->last();
        return view("application-customer.pesananByOrderId", compact("global", "order"));
    }

    public function prosesPesanan(PesanRequest $request){
        $request_validated = $request->validated();
        Order::create($request_validated);
        $order_id = Order::where("description", $request->description)->get()->last()->id;
        foreach(PartnerExpertise::callActivePartner($request) as $partner_list){
            Bid::insertFromPartnerList($partner_list, $order_id, $request);
        }
        return redirect()->route("application-customer.pesanan", $request->user_id);
    }

    public static function cekTawaran($bid_id){
        $global = Globalization::index();
        $bid = Bid::whereId($bid_id)->get()->last();
        return view("application-customer.cekTawaran", compact("global", "bid"));
    }

    public static function pesanTawaran(Request $request){
        $bid = Bid::whereId($request->bid_id)->get()->last();
        Order::diproses($bid->order_id);
        Sale::log($request, $bid->order_id);
        Notification::notifyPartnerThatCustomerIsDeal($request);
        User::partnerIsWorking($bid->user_id);
        return redirect()->route("application-customer.pesanan", Auth::user()->id);
    }
}
