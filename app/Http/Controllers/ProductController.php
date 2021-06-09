<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' => Product::query()->paginate(15),
        ]);
    }


    public function paginate(Request $request)
    {
        return Product::query()
            ->when($request->search, function ($query) use ($request) {
                $query->orWhere('style_ref', 'like', "%{$request->search}%");
                $query->orWhere('inhouse_date', 'like', "%{$request->search}%");
                $query->orWhere('color', 'like', "%{$request->search}%");
                $query->orWhere('fabric_type', 'like', "%{$request->search}%");
                $query->orWhere('pantone_number', 'like', "%{$request->search}%");
                $query->orWhere('collection_ref', 'like', "%{$request->search}%");
                $query->orWhere('supplier', 'like', "%{$request->search}%");
                $query->orWhere('unit', 'like', "%{$request->search}%");
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
        return Inertia::render('Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->inhouse_date = $request->inhouse_date;
        $product->style_ref = $request->style_ref;
        $product->color = $request->color;
        $product->fabric_type = $request->fabric_type;
        $product->pantone_number = $request->pantone_number;
        $product->collection_ref = $request->collection_ref;
        $product->supplier = $request->supplier;
        $product->gsm_weight = $request->gsm_weight;
        $product->quantity_inhouse = $request->quantity_inhouse;
        $product->unit = $request->unit;
        $product->save();
        return redirect()->route('product.index')->with('success', "New Product Added Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render("Product/Edit", [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->inhouse_date = $request->inhouse_date;
        $product->style_ref = $request->style_ref;
        $product->color = $request->color;
        $product->fabric_type = $request->fabric_type;
        $product->pantone_number = $request->pantone_number;
        $product->collection_ref = $request->collection_ref;
        $product->supplier = $request->supplier;
        $product->gsm_weight = $request->gsm_weight;
        $product->quantity_inhouse = $request->quantity_inhouse;
        $product->unit = $request->unit;
        $product->save();
        return redirect()->route('product.index')->with('success', "Product Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', "Product Deleted Successfully");
    }

    public function productAlljson(Request $request)
    {
        $products = Product::query()
            ->where('fabric_type', 'like', '%' . $request->q . '%')
            ->select('id', "fabric_type as text", 'color')
            ->skip(($request->page - 1) * 5)
            ->limit(5)
            ->get()->map(function ($item) {
                $item->text = $item->text . "({$item->color})";
                return $item;
            });
        $product_count = Product::query()
            ->where('fabric_type', 'like', '%' . $request->q . '%')
            ->skip(($request->page) * 5)
            ->limit(1)
            ->get()
            ->count();

        return response()->json([
            'items' => $products,
            'pagination' => ['more' => $product_count > 0]
        ]);
    }


    public function import(Request $request)
    {
        $request->validate([
            // 'csv' => 'mimes:csv'
        ]);

        $fix = [];

        $arr = array_map('str_getcsv', file($request->csv->getPathName()));
        $csv = collect($arr)->skip(1)
            ->reduce(function ($arr, $row) {
                $arr[] = [
                    'inhouse_date' => $row[1],
                    'style_ref' => $row[2],
                    'color' => $row[3],
                    'fabric_type' => $row[4],
                    'pantone_number' => $row[5],
                    'collection_ref' => $row[6],
                    'supplier' => $row[7],
                    'gsm_weight' => $row[8],
                    'unit' => $row[9],
                    'quantity_inhouse' => $row[10],
                ];

                return $arr;
            }, []);
        Product::query()->insert($csv);
        return redirect()->route('product.index')->with('success', "product imported successfully");
    }
}
