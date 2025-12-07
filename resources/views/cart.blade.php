<x-layout title="Cart">
 <main class="container">
      <div class="py-5 text-center">
        <h1>Cart</h1>
      </div>
      <table class="table table-striped border">
        <tr>
          <th>name</th>
          <th>price</th>
          <th>quantity</th>
          <th>subtotal</th>
          <th>actions</th>
        </tr>

        @foreach($cart as $item)
        <tr>
          <td>{{$item['name']}}</td>
          <td><span id="price{{$item['id']}}">{{$item['price']}}</span>$</td>
          <td id="quan{{$item['id']}}">{{$item['quantity']}}</td>
          <td><span id="sub{{$item['id']}}">{{$item['price'] * $item['quantity']}}</span>$</td>
          <td class="d-flex" style="align-self: center; justify-content: start;">
            <button class="btn btn-primary" style="margin-right: 1rem; width: 2rem; height: 2rem; padding: 0;" onclick="changeQuan({{$item['id']}}, 'decrement')">-</button>
            <button class="btn btn-primary" style="margin-right: 1rem; width: 2rem; height: 2rem; padding: 0;" onclick="changeQuan({{$item['id']}}, 'increment')">+</button>
            <button class="btn btn-danger" style="width: 2rem; height: 2rem; padding: 0;" onclick="remove({{$item['id']}})">x</button>
            </td>
        </tr>
        @endforeach
        
      </table>
        <div class="alert alert-danger" style="display: none;" role="alert" id="errMessage">
                
        </div>
        
        @auth
        <div class="d-flex w-100 justify-content-end">
          <form action="{{route('cart.order')}}" method="POST">
            @csrf
            <button class="btn btn-success" type="submit">Checkout</button>
          </form>
        </div>
        @endauth
        <script>
          function changeQuan(id, action){
            const requestHeaders = new Headers();
            requestHeaders.append('X_CSRF_TOKEN', "{{csrf_token()}}")
            const requestOptions = {
              method: "POST",
              headers: requestHeaders
            }
            
            fetch('/cart/' + action + '/' + id, requestOptions)
            .then((response) => response.json())
            .then((result) => refreshCart(result, id))
            .catch((error) => console.error(error))
          }

          function refreshCart(result, id){
            document.getElementById('errMessage').style.display = "none";
            if(result.status == "error"){
              document.getElementById('errMessage').style.display = "block";
              document.getElementById('errMessage').innerHTML = result.message;
              return;
            }

            if(result.action == "increment"){
              document.getElementById('quan' + id).innerHTML = parseInt(document.getElementById('quan' + id).innerHTML) + 1;
              document.getElementById('sub' + id).innerHTML = document.getElementById('price' + id).innerHTML * document.getElementById('quan' + id).innerHTML
            } else if (result.action == "decrement"){
              document.getElementById('quan' + id).innerHTML = document.getElementById('quan' + id).innerHTML - 1;
              document.getElementById('sub' + id).innerHTML = document.getElementById('price' + id).innerHTML * document.getElementById('quan' + id).innerHTML

            }
          }
        </script>
    </x-layout>