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
                    <button class="dropdown-item" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Notifikasi</button>
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

      <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasTopLabel">Notifikasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @foreach ($joinCollection as $join)
                @if ($join->status_id == "S002")
                <div class="alert alert-success" role="alert">
                  Permintaan anda pada {{ $join->created_at }} diterima oleh <b>{{ $join->pemesan }}</b> 
                </div>
                @endif
                @if ($join->status_id == "S003")
                <div class="alert alert-danger" role="alert">
                  Permintaan anda pada {{ $join->created_at }} ditolak oleh <b>{{ $join->pemesan }}</b>
                </div>
                @endif
            @endforeach
        </div>
      </div>

      <form class="mt-5 d-flex justify-content-start align-items-center" action="{{ route('booking.done')}}" method="post">
        @csrf
        @method('PUT')
        @if ($confirm == 'Ada')
        <button type="submit" class="mt-2 mx-2 btn btn-primary">Selesai Bermain</button>
        <a href="{{ route('booking.create') }}" class="mt-2 mx-2 btn btn-primary">Pesan Lapangan</a>
        @elseif($confirm == 'Tidak')
        <button disabled class="mt-2 mx-2 btn btn-disabled">Selesai Bermain</button>
        <a href="{{ route('booking.create') }}" class="mt-2 mx-2 btn btn-primary">Pesan Lapangan</a>
        @endif
      </form>
      
      
      <h2 class="mt-2 text-left mt-5">Daftar lapangan Yang Bisa Dipesan</h2>
      <table class="table table-hover mt-4">
        <thead class="bg-secondary">
          <tr>
            <th scope="col">Nama Lapangan</th>
            <th scope="col">Alamat</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($courtCollection as $lapangan)
            <tr>
              <th scope="row">{{ $lapangan->nama_lapangan }}</th>
              <td>{{ $lapangan->alamat }}</td>
            </tr>
          @endforeach
        </tbody>
      </table> 

      @if(session('success'))
        <div class="alert alert-success mt-3 mx-3">
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger mt-3 mx-3">
          {{ session('error') }}
        </div>
      @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>