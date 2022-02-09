<table class="table table-bordered table-responsive">
    <thead>
        <tr>
            <th>{{ __('lang.product_code_name') }}</th>
        </tr>
    </thead>
    <tbody>
        @if($products)
            @foreach($products as $product)
            <tr>
                <td class="text-danger">{{ $product->code . ' - '. $product->name  }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
    