<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Player Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid d-flex">
          <a class="navbar-brand" href="/booking">BasketCool</a>
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
                    <a class="dropdown-item" aria-current="page" href="/booking">Courts List</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="/join">Join</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="/join-req">Join Request</a>
                  </li>
                  <li>
                    <form action="{{ route('logoutPlayer') }}" method="POST">
                      @csrf
                      <button class="dropdown-item" type="submit">Log Out</button>
                    </form>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <h5 class="text-light">Hello Player, {{ request()->cookie('username') }}</h5>
        </div>
      </nav>

      <form action="{{ route('join.store') }}" method="POST">
        @csrf
        <label for="nama_pemain" class="container mx-2">Nama</label><br>
        <input type="text" class="container mx-3" name="nama_pemain" id="nama_pemain" value="{{ request()->cookie('username') }}">

        <br>

        <input type="hidden" name="pemesan" value="{{ $order->pemesan }}">    

        <label for="alamat" class="container mx-2">Posisi</label><br>
        <select name="posisi" id="posisi" class="container mx-3">
            <option value="Center">Center</option>
            <option value="Small Forward">Small Forward</option>
            <option value="Power Forward">Power Forward</option>
            <option value="Shooting Guard">Shooting Guard</option>
            <option value="Point Guard">Point Guard</option>
        </select>

        <br>

        <label for="pesan" class="container mx-2">Pesan</label><br>
        <input type="text" class="container mx-3" name="pesan" id="pesan">

        <br>

        <input type="hidden" name="status" value="belum_dikonfirmasi">

        <button type="submit" class="btn btn-primary container mx-3 mt-3">Kirim</button>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
         @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

      </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>