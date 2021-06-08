<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Excel;
use PDF;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->with('rejectProducts', 'delivers')
            ->withSum('rejectProducts as reject_total', 'quantity')
            ->withSum('delivers as deliver_total', 'quantity')
            ->paginate(15);
        return Inertia::render("Stock/Index", [
            'products' => $products
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

    public function pdf()
    {
        $products = Product::query()
            ->with('rejectProducts', 'delivers')
            ->withSum('rejectProducts as reject_total', 'quantity')
            ->withSum('delivers as deliver_total', 'quantity')
            ->get();
        $pdf = PDF::loadView('export.productPdf', compact('products'));
        return $pdf->download('document.pdf');
    }

    public function excel()
    {
        return Excel::download(new ProductExport, 'bills.xlsx');
    }
}
