 <div
      id="carouselExampleCaptions"
      class="carousel slide carousel-height"
      data-bs-ride="carousel">

      <div class="carousel-indicators">
        @for($i=0; $i < count($carousel); $i++)
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="{{$i}}"
          @if($i == 0)
          class="active"
          aria-current="true"
          @endif
          aria-label="Slide 1"></button>
        @endfor
      </div>
      <div class="carousel-inner">
        @foreach($carousel as $image)
          <div class="carousel-item {{$loop->first ? 'active' : ''}}">
            <img
              src="/assets/images/{{$image->pic}}"
              class="d-block w-100"
              alt="..."
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>{{$image->title}}</h5>
              <p>{{$image->description}}</p>
            </div>
          </div>
        @endforeach
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>