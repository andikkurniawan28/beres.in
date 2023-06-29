<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Documentation;
use App\Models\Globalization;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $global = Globalization::index();
        $service = Service::all();
        $menu_id = Menu::where("name", "service")->get()->last()->id ?? NULL;
        $description = Documentation::where("menu_id", $menu_id)->get();
        return view("service.index", compact("global", "service", "description"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $global = Globalization::index();
        return view("service.create", compact("global"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|unique:services",
        ]);
        Service::create($validated);
        return redirect()->route("service.index")->with("success", "Service has been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $global = Globalization::index();
        $service = Service::whereId($id)->get()->last();
        return view("service.edit", compact("global", "service"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Service::whereId($id)->update([
            "name" => $request->name,
        ]);
        return redirect()->route("service.index")->with("success", "Service has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::whereId($id)->delete();
        return redirect()->route("service.index")->with("success", "Service has been deleted.");
    }
}
