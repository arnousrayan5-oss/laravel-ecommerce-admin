<x-layout :title="$product->name">
<main class="container my-5">
      <div class="row">
        <div class="col-md-6">
          <div class="product-img-main">
            <img
              src="/assets/uploads/{{$product->main_image}}"
              alt="Main Product Image"
              class="img-fluid mb-3 h-100"
            />
          </div>
          <div class="product-thumbnails d-flex justify-content-between">
            @foreach($product->images as $image)
            <img
              src="/assets/uploads/{{$image->image}}"
              class="img-thumbnail"
              style="width: 30%"
            />
           @endforeach
          </div>
        </div>

        <!-- Right side: Product details -->
        <div class="col-md-6">
          <h1>{{$product->name}}</h1>
          <p class="text-muted">
           {{$product->description}}
          </p>
          <h2 class="text-primary">${{$product->price}}</h2>
          <form action="{{route('cart.add', $product->id)}}" method="POST">
            @csrf
            <label class="form-label" for="quantity">Quantity</label>
            <input
              class="form-control w-50"
              type="number"
              name="quantity"
              value="1"
              required
              min="1"
              max="{{$product->quantity}}"
            />
            @can('addToCart', $product)
            @if(!isset(session('cart')[$product->id]))
            <button class="btn btn-success btn-lg my-3" type="submit">Add to Cart</button>
            @else 
              <button class="btn btn-success btn-lg my-3 disabled">Already in cart</button>
              @endif
              @endcan
          </form>
          @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')}}
            </div>
          @endif
          @if(session('success'))
              <div class="alert alert-success" role="alert">
                  {{session('success')}}
              </div>
          @endif
          <p>Additional Details:</p>
         {{$product->info}}
        </div>
      </div>
    </main>

    <section class="container mt-4">
      <h1>Similiar Products</h1>
      <div class="row">
        @foreach($similarProducts as $sm)
          <x-product-card :product="$sm"/>
        @endforeach
      </div>
    </section>
</x-layout>