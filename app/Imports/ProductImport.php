<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        dd($row["Inhouse Date"]);
        return new Product([
            'inhouse_date' => $row["Inhouse Date"],
            'style_ref' => $row["Style Ref"],
            'color' => $row["Color"],
            'fabric_type' => $row["Fabric Type"],
            'pantone_number' => $row["Pantone Number"],
            'collection_ref' => $row["Collection Ref"],
            'supplier' => $row["Supplier"],
            'gsm_weight' => $row["GSM/weight"],
            'quantity_inhouse' => $row["Quantity Inhouse"],
            'unit' => $row["Unit"]

        ]);
    }
}
