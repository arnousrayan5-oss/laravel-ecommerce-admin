<x-layout title="Home">
   <x-carousel :carousel="$carousel"/>
    <main class="container mt-4">
      <div class="row">
        @foreach($products as $product)
          <x-product-card :product="$product"/>
        @endforeach
        {{$products->links('pagination::bootstrap-5')}}
      </div>
    </main>
</x-layout>