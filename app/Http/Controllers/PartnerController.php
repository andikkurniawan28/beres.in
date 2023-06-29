<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Partner;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Documentation;
use App\Models\Globalization;
use App\Models\PartnerExpertise;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $global = Globalization::index();
        $partner = Partner::serve();
        $menu_id = Menu::where("name", "partner")->get()->last()->id ?? NULL;
        $description = Documentation::where("menu_id", $menu_id)->get();
        return view("partner.index", compact("global", "partner", "description"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $global = Globalization::index();
        $service = Service::all();
        return view("partner.create", compact("global", "service"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::insert([
            "role_id" => $request->role_id,
            "name" => $request->name,
            "username" => $request->username,
            "password" => User::hashPassword($request),
            "phone_number" => $request->phone_number,
        ]);
        $user_id = User::where("name", $request->name)->get()->last()->id;
        PartnerExpertise::insert(["user_id" => $user_id, "service_id" => $service]);
        return redirect()->back()->with("success", "Partner has been stored.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $global = Globalization::index();
        $partner = User::whereId($id)->get()->last();
        $service = Service::all();
        return view("partner.edit", compact("global", "partner", "service"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::whereId($id)->update([
            "role_id" => $request->role_id,
            "name" => $request->name,
            "username" => $request->username,
        ]);
        if($request->has("service_id")){
            PartnerExpertise::where("user_id", $id)->delete();
            foreach($request->service_id as $service){
                PartnerExpertise::insert(["user_id" => $id, "service_id" => $service]);
            }
        }
        return redirect()->back()->with("success", "Partner has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Partner::destroyPartner($id);
    }
}
