<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Service;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\Documentation;
use App\Models\Globalization;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $global = Globalization::index();
        $order = Order::all();
        $menu_id = Menu::where("name", "order")->get()->last()->id ?? NULL;
        $description = Documentation::where("menu_id", $menu_id)->get();
        return view("order.index", compact("global", "order", "description"));
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
        return view("order.create", compact("global", "service"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Order::create($request->all());
        ActivityLog::insert(["description" => Auth()->user()->name." create order."]);
        return redirect()->back()->with("success", "Order has been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $global = Globalization::index();
        $service = Service::all();
        $order = Order::whereId($id)->get()->last();
        return view("order.edit", compact("global", "service", "order"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Order::whereId($id)->update([
            "service_id" => $request->service_id,
            "description" => $request->description,
            "address" => $request->address,
            "phone_number" => $request->phone_number,
            "name" => $request->name,
        ]);
        ActivityLog::insert(["description" => Auth()->user()->name." update order."]);
        return redirect()->back()->with("success", "Order has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::whereId($id)->delete();
        ActivityLog::insert(["description" => Auth()->user()->name." delete order."]);
        return redirect()->back()->with("success", "Order has been deleted.");
    }
}
