@if($products)
    @foreach($products as $key => $product)
        <div class="col-2">
            <div class="card">
                <div class="card_popup">{{ $product->code }} - {{ $product->name }}</div>
                <div class="card-body"><img src="{{ url('') .'/'.$product->image }}" class="rounded img-responsive" alt="Cinque Terre"></div>
            </div>
        </div>
    @endforeach
@endif