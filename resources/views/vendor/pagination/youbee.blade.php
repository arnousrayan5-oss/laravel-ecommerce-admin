@if ($paginator->hasPages())

<section style="display:flex; justify-content: space-between; border: 1px solid black">
    <div style="border: 1px solid blue">
        @if ($paginator->onFirstPage())
            <p><- Prev</p>
        @else 
            <a href="{{ $paginator->previousPageUrl() }}"><- Prev</a>
        @endif
    </div>
    <div>
        {{ $paginator->total() }} items total
    </div>
    <div style="border: 1px solid blue">
         @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">Next -></a>
         @else 
            <p> Next -> </p>
         @endif
    </div>
</section>

@endif
