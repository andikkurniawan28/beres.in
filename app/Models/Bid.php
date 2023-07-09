<?php

namespace App\Models;

use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bid extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function sale(){
        return $this->hasMany(Sale::class);
    }

    public static function insertFromPartnerList($partner_list, $order_id, $request){
        self::insert(["user_id" => $partner_list->id,"order_id" => $order_id]);
        ActivityLog::insert(["description" => "Create Bid for ".User::whereId($partner_list->id)->get()->last()->name."."]);
        Notification::notifyPartner($partner_list->id, $order_id, $request);
    }
}
