<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Partner extends Model
{
    use HasFactory;

    protected const _role_id = 2;

    public static function serve(){
        return User::where("role_id", self::_role_id)->get();
    }

    public static function destroyPartner($id){
        User::whereId($id)->delete();
        return redirect()->route("partner.index")->with("success", "Partner has been deleted.");
    }
}
