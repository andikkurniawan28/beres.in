<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\Globalization;
use App\Models\PartnerExpertise;

class FormPartnerController extends Controller
{
    public function index(){
        $global = Globalization::index();
        $service = Service::all();
        return view("form-partner.index", compact("global", "service"));
    }

    public function process(Request $request){
        User::insert([
            "role_id" => $request->role_id,
            "name" => $request->name,
            "username" => $request->username,
            "phone_number" => "62".$request->phone_number,
            "password" => User::hashPassword($request),
        ]);
        $user_id = User::where("name", $request->name)->get()->last()->id;
        PartnerExpertise::insert(["user_id" => $user_id, "service_id" => $service]);
        ActivityLog::insert(["description" => $request->name." register as Partner."]);
        return redirect()->back()->with("success", "Partner has been created.");
    }
}
