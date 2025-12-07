<x-layout title="Register">

    <main
      class="d-flex w-100 align-items-center justify-content-center"
      style="height: 100vh">
      <form class="card p-4" method="POST" action="{{route('registerAction')}}">
        @csrf
        <h1 class="mb-4 text-center text-primary">Sign Up</h1>
        <div class="mb-3">
          <label for="exampleInputName1" class="form-label"
            >Name</label>
          <input
            type="text"
            class="form-control"
            id="exampleInputName1"
            aria-describedby="nameHelp"
            name="name"
            value="{{old('name')}}"
            required/>
          <div id="nameHelp" class="form-text">
            Use your real name.
          </div>
          @error('name')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label"
            >Email address</label
          >
          <input
            type="email"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            name="email"
            value="{{old('email')}}"
            required/>
          <div id="emailHelp" class="form-text">
            We'll never share your email with anyone else.
          </div>
          @error('email')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="exampleInputPassword1"
            name="password"
            required
          />
          @error('password')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
          @enderror
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" name="terms"/>
          <label class="form-check-label" for="exampleCheck1">
            I agree to <a href="#">terms of policy</a>
        </label>
        @error('terms')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
          @enderror
        </div>
        <h6 style="color: gray; font-size: 0.85rem">
          Have an account? <a href="{{route('register')}}"> Sign in</a>
        </h6>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </main>

</x-layout>