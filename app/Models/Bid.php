<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function insertFromPartnerList($partner_list, $order_id){
        self::insert(["user_id" => $partner_list->user_id,"order_id" => $order_id]);
    }
}
