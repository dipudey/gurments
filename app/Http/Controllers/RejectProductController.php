<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RejectProduct;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RejectProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Reject/Index", [
            'rejects' => RejectProduct::query()->with('product')->paginate(15)
        ]);
    }

    public function paginate(Request $request)
    {
        return RejectProduct::query()
            ->with('product')
            ->when($request->search, function ($query) use ($request) {
                $query->whereHas('product', function ($query) use ($request) {
                    $query->where('fabric_type', 'like', "%{$request->search}%")
                        ->orWhere('style_ref', 'like', "%{$request->search}%")
                        ->orWhere('color', 'like', "%{$request->search}%");
                })
                    ->orWhere('date', 'like', "%{$request->search}%");
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
        return Inertia::render("Reject/Create");
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
            'date' => 'required',
            'quantity' => 'required|numeric'
        ], [
            'product_id.required' => "Select Product"
        ]);
        $reject = new RejectProduct();
        $reject->product_id = $request->product_id;
        $reject->date = $request->date;
        $reject->quantity = $request->quantity;
        $reject->save();
        return redirect()->route('reject.index')->with('success', "Product Rejected Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RejectProduct  $rejectProduct
     * @return \Illuminate\Http\Response
     */
    public function show(RejectProduct $rejectProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RejectProduct  $rejectProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rejectProduct = RejectProduct::query()->with('product')->where('id', $id)->first();

        return Inertia::render("Reject/Edit", [
            'rejectProduct' => $rejectProduct,
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
     * @param  \App\Models\RejectProduct  $rejectProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required',
            'date' => 'required',
            'quantity' => 'required|numeric'
        ], [
            'product_id.required' => "Select Product"
        ]);
        $rejectProduct = RejectProduct::findOrFail($id);
        $rejectProduct->product_id = $request->product_id;
        $rejectProduct->date = $request->date;
        $rejectProduct->quantity = $request->quantity;
        $rejectProduct->save();
        return redirect()->route('reject.index')->with('success', "Rejected Product Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RejectProduct  $rejectProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RejectProduct::query()->where('id', $id)->delete();
        return redirect()->route('reject.index')->with('success', "Rejected Product Deleted Successfully");
    }
}
