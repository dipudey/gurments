<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromView;

use Illuminate\Contracts\View\View;

class ProductExport implements FromView
{
    /**
     */
    public function view(): View
    {
        return view('export.product', [
            'products' => Product::query()
                ->with('rejectProducts', 'delivers')
                ->withSum('rejectProducts as reject_total', 'quantity')
                ->withSum('delivers as deliver_total', 'quantity')
                ->get()
        ]);
    }
}
