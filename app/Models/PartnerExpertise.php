<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnerExpertise extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public static function callActivePartner($request){
        $partner_id = self::where("service_id", $request->service_id)->select("user_id")->get();
        return User::where("is_activated", 1)->where("is_avalaible", 1)->whereIn("id", $partner_id)->select(["id", "phone_number"])->get();
    }
}
