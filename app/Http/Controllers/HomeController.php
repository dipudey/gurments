<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Product;
use App\Models\RejectProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Create a new controller i nstance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $best_sale_products = DB::table('deliveries')
            ->select('product_id', DB::raw('COUNT(product_id) as total_sale'))
            ->groupBy('product_id')
            ->whereMonth('created_at', date('m'))
            ->orderBy('total_sale', 'desc')
            ->take(10)
            ->get();

        $popular_product = [];
        foreach ($best_sale_products as $product) {
            $data = Product::findOrFail($product->product_id);
            array_push($popular_product, $data->fabric_type);
        }

        return Inertia::render("Admin/Dashboard", [
            'total_products' => Product::count(),
            'total_rejects' => RejectProduct::count(),
            'total_deliver' => Delivery::count(),
            'best_sale_product' => $best_sale_products->pluck('total_sale'),
            'best_sale_product_name' => $popular_product,
        ]);
    }
}
