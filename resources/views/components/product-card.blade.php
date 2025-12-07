<div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-img-top">
            <img src="/assets/uploads/{{$product->main_image}}" alt="{{$product->name}}" />
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <p class="card-text">
            {{$product->description}}
            </p>
            <p class="card-text font-weight-bold">${{$product->price}}</p>
            <div class="d-flex justify-content-between">
            <a class="btn btn-primary" href="{{route('product.show', $product->id)}}">View</a>
            <button
                class="btn btn-primary">
                Add to Cart
            </button>
            </div>
        </div>
    </div>
</div>