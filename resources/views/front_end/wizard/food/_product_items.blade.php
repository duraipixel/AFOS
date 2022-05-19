@if( isset( $product_info ) && !empty($product_info))
    @foreach ($product_info as $item)
    <div class="col-sm-6 col-lg-6 my-2">
        <label for="food_{{ $item->id }}" class="card border-0 rounded ">
            <img class="w-100 rounded shadow-sm" src="{{ asset('products/'.$item->image) }}">
            <div class="card-body w-100 px-2">
                <div class="border-0">
                    <div>
                        <input type="checkbox" @if(isset(session()->get('order')['product_id']) && in_array($item->id, session()->get('order')['product_id']) ) checked @endif value="{{ $item->id }}" name="food[]" id="food_{{ $item->id }}" class="form-check-input me-2">
                        <strong class="food_name">{{ $item->name }}</strong>
                    </div>
                    <div class="food_price">RS. {{ $item->price }}</div>
                </div>
                <div class="food_content">{{ $item->description }}</div>
            </div>
        </label>
    </div> 
    @endforeach
@endif
