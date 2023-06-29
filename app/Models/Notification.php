<?php

namespace App\Models;

use App\Models\User;
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
    }

    public static function composeMessageForNotifyPartner($request, $order_id, $user_id){
        $global = Globalization::index();
        return "Hallo Partner ".$global["app_name"].", Anda terpilih untuk melakukan penawaran kepada Customer a/n ".$request->name.". Mohon melakukan penawaran melalui link ini http://andikk.tech/Laravel-Starter/public/index.php/place-bid/".$order_id."/".$user_id;
    }

    public static function composeMessageForNotifyClient($request, $order_id){
        return "Hallo ".$request->name.", terimakasih telah menggunakan layanan kami. Anda dapat melihat tawaran untuk pesanan Anda pada link ini ".route("order-bid", $order_id);
    }

    public static function notifyPartnerThatOrderHasBeenPaid($request){
        $user_id = Bid::whereId($request->bid_id)->get()->last()->user_id;
        $phone_number = User::whereId($user_id)->get()->last()->phone_number;
        $message = self::composeMessageForNotifyPartnerThatOrderHasBeenPaid($user_id);
        $greenApi = new GreenApiClient( self::ID_INSTANCE, self::API_TOKEN_INSTANCE );
        $result = $greenApi->sending->sendMessage($phone_number."@c.us", $message);
    }

    public static function composeMessageForNotifyPartnerThatOrderHasBeenPaid($user_id){
        $name = User::whereId($user_id)->get()->last()->name;
        return "Hallo ".$name.", customer telah melakukan pembayaran. Mohon laporkan status pekerjaanmu melalui link ini.";
    }
}
