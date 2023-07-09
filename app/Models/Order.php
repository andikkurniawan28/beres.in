<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bid(){
        return $this->hasMany(Bid::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function sale(){
        return $this->hasMany(Sale::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function createThenGetOrderId($request){
        $request->request->add(["phone_number" => "62".$request->phone_number]);
        self::create($request->all());
        return self::getOrderIdByDescription($request);
    }

    public static function getOrderIdByDescription($request){
        return self::where("description", $request->description)->get()->last()->id;
    }

    public static function diproses($order_id){
        self::whereId($order_id)->update(["is_open" => 2]);
    }

    public static function close($order_id){
        self::whereId($order_id)->update(["is_open" => 0]);
    }
}
