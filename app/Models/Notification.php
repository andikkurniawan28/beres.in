<?php

namespace App\Models;

use App\Models\Bid;
use App\Models\Sale;
use App\Models\User;
use App\Models\Order;
use GreenApi\RestApi\GreenApiClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected const ID_INSTANCE = "7103835455";

    protected const API_TOKEN_INSTANCE = "9a8f9ac2f4b948fea0800829452628a635af9f523b984d3687";

    public static function notifyPartner($user_id, $order_id, $request){
        $phone_number = User::whereId($user_id)->get()->last()->phone_number;
        $message = self::composeMessageForNotifyPartner($request, $order_id, $user_id);
        $greenApi = new GreenApiClient( self::ID_INSTANCE, self::API_TOKEN_INSTANCE );
        $result = $greenApi->sending->sendMessage($phone_number."@c.us", $message);
    }

    public static function notifyClient($request, $order_id){
        $message = self::composeMessageForNotifyClient($request, $order_id);
        $greenApi = new GreenApiClient( self::ID_INSTANCE, self::API_TOKEN_INSTANCE );
        $result = $greenApi->sending->sendMessage($request->phone_number."@c.us", $message);
        ActivityLog::insert(["description" => $request->name." create order."]);
    }

    public static function notifyPartnerThatCustomerIsDeal($request){
        $bid = Bid::whereId($request->bid_id)->get()->last();
        $partner = User::whereId($bid->user_id)->get()->last();
        $order = Order::whereId($bid->order_id)->get()->last();
        $sale = Sale::where("order_id", $order->id)->where("bid_id", $request->bid_id)->get()->last();
        $message_partner = "Hallo ".$partner->name.", penawaran kamu sudah diterima. Segera menuju lokasi ya. Kamu bisa WA customernya lewat sini https://wa.me/".$order->phone_number;
        $message_customer = "Hallo, Partner kami a/n ".$partner->name." sedang menuju lokasi. Cek whatsapp terus ya.";
        $greenApi = new GreenApiClient( self::ID_INSTANCE, self::API_TOKEN_INSTANCE );
        $greenApi->sending->sendMessage($partner->phone_number."@c.us", $message_partner);
        $greenApi->sending->sendMessage($order->phone_number."@c.us", $message_customer);
    }

    public static function composeMessageForNotifyPartner($request, $order_id, $user_id){
        $global = Globalization::index();
        $partner = User::whereId($user_id)->get()->last()->name;
        return "Hallo ".$partner.". Ada pesanan nih dari Customer a/n ".$request->name.". Cek disini aplikasi ya.";
    }

    public static function composeMessageForNotifyClient($request, $order_id){
        $global = Globalization::index();
        return "Hallo ".$request->name.", terimakasih telah menggunakan layanan ".$global["app_name"].". Cek daftar tawaran kamu disini ya ".route("order-bid", $order_id);
    }

    public static function notifyBidIsPlaced($request){
        $customer_number = $request->phone_number;
        $phone_number = User::whereId($request->user_id)->get()->last()->phone_number;
        $partner_name = User::whereId($request->user_id)->get()->last()->name;
        $greenApi = new GreenApiClient( self::ID_INSTANCE, self::API_TOKEN_INSTANCE );
        $greenApi->sending->sendMessage($phone_number."@c.us", "Hallo ".$partner_name." tawaran sudah diajukan ke Customer. Cek WA terus ya");
        $greenApi->sending->sendMessage($customer_number."@c.us", "Hallo, ada tawaran masuk dari ".$partner_name.". Cek aplikasi ya.");
        return redirect("https://wa.me/6285733465399");
    }

    public static function notifyOrderIsClosed($sale){
        $bid = Bid::whereId($sale->bid_id)->get()->last();
        $greenApi = new GreenApiClient( self::ID_INSTANCE, self::API_TOKEN_INSTANCE );
        $greenApi->sending->sendMessage($bid->user->phone_number."@c.us", "Selamat kamu telah menyelesaikan tugas. Terima kasih atas bantuannya.");
    }
}
