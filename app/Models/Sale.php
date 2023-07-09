<?php

namespace App\Models;

use App\Models\Bid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function bid(){
        return $this->belongsTo(Bid::class);
    }

    public static function log($request, $order_id){
        self::insert([
            "order_id" => $order_id,
            "bid_id" => $request->bid_id,
        ]);
    }
}
