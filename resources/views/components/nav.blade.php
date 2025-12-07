<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">YouBee Shop</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/"
                >Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('product.all')}}">Products</a>
            </li>
          </ul>
          <div class="d-flex justify-content-between w-100">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
                id="keyword"
              />
              <button class="btn btn-outline-success" type="button" onclick="search()">
                Search
              </button>
            </form>
            <a class="btn btn-primary me-2" href="{{route('cart.all')}}">Cart</a>
            <div class="d-flex align-items-center justify-content-between">
            @guest
              <a class="btn btn-primary me-2" href="{{route('login')}}">Login</a>
              <a href="{{route('register')}}" class="btn btn-primary"> Register </a>
            @endguest
            @auth
                <a class="btn btn-primary me-2" href="{{route('logout')}}">Logout</a>
                <a href="#" class="btn btn-primary"> Cart </a>
            @endauth
            </div>
          </div>
        </div>
      </div>
    </nav>

    <script>
      function search(){
        const keyword = document.getElementById('keyword').value;
        if(!keyword){
          return;
        }

        window.location.href = "/products/search/" + keyword;
      }
    </script>