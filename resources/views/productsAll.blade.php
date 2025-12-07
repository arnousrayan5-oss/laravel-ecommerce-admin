<x-layout title="Products">
<main class="container mt-4">
      <div class="row">
        <h3>All Categories</h3>
        <div class="d-flex">
          @foreach($tags as $tag)
            <a href="{{route('product.filter', $tag->id)}}" class="me-4">{{$tag->name}}</a>
          @endforeach
        </div>
      </div>

      <div class="row mt-4">
        @foreach($products as $product)
            <x-product-card :product="$product"/>
        @endforeach
        {{$products->links('pagination::bootstrap-5')}}
      </div>
    </main>
</x-layout>