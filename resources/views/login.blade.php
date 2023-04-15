<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-sm mt-5">
      <h4 class="text-center fw-bolder">Login</h4>
      <h2 class="text-center text-primary fw-bold fst-italic">Basket<span class="text-danger">Cool</span></h2>
      <form action="{{ route('login.authenticate') }}" method="post">
        @csrf
        <div class="form-outline mb-4">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" autofocus required value="{{ old('email') }}">
        </div>

        <div class="form-outline mb-4">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required> 
        </div>
        <button type="submit" class="btn btn-primary btn-block mb-4 container">Sign in</button>
      </form>
    </div>
   
        @if (session('error'))
            <div class="alert alert-danger mt-2 container-sm">
                {{ session('error') }}
            </div>
        @endif  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>