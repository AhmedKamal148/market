{{--Products Related With Orders--}}

<div class="show_products">
    <table class="table table-striped">
        {{--THead--}}
        <thead>
        <tr class="bg-dark">
            <th colspan="4">Products</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        </thead>
        {{--TBody--}}
        <tbody id="showProductsTbody">
        @foreach($products as $product)
            <tr class="product_print_details">
                <td>{{$product->name}}</td>
                <td>{{$product->pivot->quantity}}</td>
                <td>{{$product->sale_price * $product->pivot->quantity}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">
                <button class="btn btn-block btn-dark font-weight-bold printInvoice"> Print <i class="fas fa-print"></i>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</div>

