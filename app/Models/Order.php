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

    public static function getOrderIdByDescription($request){
        return self::where("description", $request->description)->get()->last()->id;
    }
}
