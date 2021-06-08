<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Delivery/Index", [
            'deliveries' => Delivery::query()->with('product')->paginate(15)
        ]);
    }

    public function paginate(Request $request)
    {
        return Delivery::query()
            ->with('product')
            ->when($request->search, function ($query) use ($request) {
                $query->whereHas('product', function ($query) use ($request) {
                    $query->where('fabric_type', 'like', "%{$request->search}%")
                        ->orWhere('style_ref', 'like', "%{$request->search}%")
                        ->orWhere('color', 'like', "%{$request->search}%");
                })
                    ->orWhere('date', 'like', "%{$request->search}%")
                    ->orWhere('section', 'like', "%{$request->search}%");
            })
            ->paginate(15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Delivery/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'section' => 'required',
            'date' => 'required',
            'quantity' => 'required|numeric'
        ], [
            'product_id.required' => "Select Product"
        ]);

        $delivery = new Delivery();
        $delivery->product_id = $request->product_id;
        $delivery->section = $request->section;
        $delivery->date = $request->date;
        $delivery->quantity = $request->quantity;
        $delivery->save();
        return redirect()->route('delivery.index')->with('success', "Delivery Successfull");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        $delivery->load('product');
        return Inertia::render("Delivery/Edit", [
            'delivery' => $delivery,
            'products' => Product::get()->map(function ($item) {
                $item->label = $item->fabric_type;
                $item->value = $item->id;
                return $item;
            }),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery)
    {
        $delivery->product_id = $request->product_id;
        $delivery->section = $request->section;
        $delivery->date = $request->date;
        $delivery->quantity = $request->quantity;
        $delivery->save();
        return redirect()->route('delivery.index')->with('success', "Delivery Updated Successfull");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return redirect()->route('delivery.index')->with('success', "Delivery Deleted Successfull");
    }
}
