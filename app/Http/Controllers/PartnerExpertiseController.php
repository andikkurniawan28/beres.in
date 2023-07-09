<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Partner;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Documentation;
use App\Models\Globalization;
use App\Models\PartnerExpertise;

class PartnerExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $global = Globalization::index();
        $partner_expertise = PartnerExpertise::all();
        $menu_id = Menu::where("name", "partner_expertise")->get()->last()->id ?? NULL;
        $description = Documentation::where("menu_id", $menu_id)->get();
        return view("partner_expertise.index", compact("global", "partner_expertise", "description"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $global = Globalization::index();
        $partner = Partner::serve();
        $service = Service::all();
        return view("partner_expertise.create", compact("global", "partner", "service"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PartnerExpertise::create($request->all());
        return redirect()->back()->with("success", "Expertise has been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartnerExpertise  $partnerExpertise
     * @return \Illuminate\Http\Response
     */
    public function show(PartnerExpertise $partnerExpertise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartnerExpertise  $partnerExpertise
     * @return \Illuminate\Http\Response
     */
    public function edit(PartnerExpertise $partnerExpertise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PartnerExpertise  $partnerExpertise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PartnerExpertise $partnerExpertise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartnerExpertise  $partnerExpertise
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PartnerExpertise::whereId($id)->delete();
        return redirect()->back()->with("success", "Expertise has been deleted.");
    }
}
