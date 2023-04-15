<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Hompage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
      <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand" href="/basketball-courts">BasketCool</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu                
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="/basketball-courts-order" class="dropdown-item">Courts Order</a>
                </li>
                <li>
                  <form action="{{ route('logoutAdmin') }}" method="POST">
                      @csrf
                      <button class="dropdown-item" type="submit">Log Out</button>
                  </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <h5 class="text-light">Hello Admin, {{ request()->cookie('username') }}</h5>
      </div>
    </nav>

      <form class="mt-5" action="{{ route('basketball-courts.update', $court->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="nama_lapangan" class="container mx-2">Nama Lapangan</label><br>
        <input type="text" class="container mx-3" name="nama_lapangan" id="nama_lapangan" value="{{ old('nama_lapangan', $court->nama_lapangan) }}">
    
        @if ($errors->has('nama_lapangan'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <p>Nama Lapangan Wajib Diisi</p>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    
        <br>
    
        <label for="alamat" class="container mx-2">Alamat Lapangan</label><br>
        <input type="text" class="container mx-3" name="alamat" id="alamat" value="{{ old('alamat', $court->alamat) }}">
    
        @if ($errors->has('alamat'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>Alamat Lapangan Wajib Diisi</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
    
        <br>
    
        <button type="submit" class="mt-2 mx-3 btn btn-primary container">Update</button>

        @if(session('success'))
          <div class="alert alert-success mt-3 mx-3">
            {{ session('success') }}
          </div>
        @endif
    </form>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>