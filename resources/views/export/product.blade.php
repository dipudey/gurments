<table>
    <tr>
        <td scope="col">Sl</td>
        <td scope="col">Inhouse Date</td>
        <td scope="col">Style Ref</td>
        <td scope="col">Color</td>
        <td scope="col">Fabric Type</td>
        <td scope="col">Pantone Number</td>
        <td scope="col">Collection Ref</td>
        <td scope="col">Supplier</td>
        <td scope="col">GSM/weight</td>
        <td scope="col">Unit</td>
        <td scope="col">Quantity Inhouse</td>
        <td scope="col">Reject Quantity</td>
        <td scope="col">Deliver Quantity</td>
        <td scope="col">Current Stock</td>
    </tr> 
    @foreach ($products as $product)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $product->inhouse_date }}</td>
            <td>{{ $product->style_ref }}</td>
            <td>{{ $product->color }}</td>
            <td>{{ $product->fabric_type }}</td>
            <td>{{ $product->pantone_number }}</td>
            <td>{{ $product->collection_ref }}</td>
            <td>{{ $product->supplier }}</td>
            <td>{{ $product->gsm_weight }}</td>
            <td>{{ $product->unit }}</td>
            <td>{{ $product->quantity_inhouse }}</td>
            <td>{{ $product->reject_total }}</td>
            <td>{{ $product->deliver_total }}</td>
            <td>
                {{ $product->quantity_inhouse - $product->reject_total - $product->deliver_total }}
            </td>
        </tr>
    @endforeach
</table>