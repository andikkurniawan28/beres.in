<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Sale;
use App\Models\User;
use App\Models\Order;
use App\Models\Partner;
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

    public function pesanan(){
        $global = Globalization::index();
        $order = Order::where("user_id", Auth()->user()->id)->orderBy("id", "desc")->limit(5)->get();
        return view("application-customer.pesanan", compact("global", "order"));
    }

    public static function pesananByOrderId($order_id){
        $global = Globalization::index();
        $order = Order::whereId($order_id)->get()->last();
        return view("application-customer.pesananByOrderId", compact("global", "order"));
    }

    public static function cekTawaran($bid_id){
        $global = Globalization::index();
        $bid = Bid::whereId($bid_id)->get()->last();
        return view("application-customer.cekTawaran", compact("global", "bid"));
    }

    public function prosesPesanan(PesanRequest $request){
        $request_validated = $request->validated();
        Order::create($request_validated);
        $order_id = Order::getID($request);
        $partner_list = PartnerExpertise::callActivePartner($request);
        foreach($partner_list as $partner_list){
            Bid::broadcast($partner_list, $order_id);
            Notification::whatsapp($partner_list->phone_number, "Ada pesanan masuk, cek aplikasi ya!");
        }
        return redirect()->route("application-customer.pesanan", $request->user_id);
    }

    public static function pesanTawaran(Request $request){
        $bid = Bid::whereId($request->bid_id)->get()->last();
        Order::diproses($bid->order_id);
        Sale::log($request, $bid->order_id);
        Notification::whatsapp($bid->user->phone_number, "Tawaran kamu sudah disetujui, kamu bisa menghubungi customer lewat sini https://wa.me/". $bid->order->phone_number);
        Notification::whatsapp($bid->order->phone_number, "Pesanan kamu sedang diproses, kamu bisa menghubungi partner lewat sini https://wa.me/". $bid->user->phone_number);
        Partner::isWorking($bid->user_id);
        return redirect()->route("application-customer.pesanan");
    }
}
