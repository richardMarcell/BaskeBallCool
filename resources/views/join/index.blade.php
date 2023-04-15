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
    
      <h1 class="mt-2 text-center">Daftar Lapangan Yang Sudah Dipesan</h1>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Nama Lapangan</th>
            <th scope="col">Alamat</th>
            <th scope="col">Pemesan</th>
            <th scope="col">Waktu</th>
            <th scope="col">Pemain</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Join</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orderCollection as $pesanan)
            <tr>
              <th scope="row">{{ $pesanan->court->nama_lapangan }}</th>
              <td>{{ $pesanan->court->alamat}}</td>
              <td>{{ $pesanan->pemesan }}</td>
              <td>{{ $pesanan->waktu_mulai }} s/d {{ $pesanan->waktu_selesai }}</td>
              <td>
                @if ($pesanan->jumlah_pemain == $pesanan->jumlah_pemain_max)
                <div class="alert alert-danger">
                    Lapangan Sudah Penuh
                </div>
                @elseif($pesanan->jumlah_pemain <= $pesanan->jumlah_pemain_max)
                 {{ $pesanan->jumlah_pemain }} Orang / {{ $pesanan->jumlah_pemain_max }} Orang
                @endif
              </td>
              <td>{{ $pesanan->status }}</td>
              <td>
                @if ($pesanan->jumlah_pemain == $pesanan->jumlah_pemain_max)
                  <button disabled class="btn btn-disabled container mt-3">Join</button>               
                @elseif($pesanan->jumlah_pemain <= $pesanan->jumlah_pemain_max)
                  <a href="{{route('join.create', ['order' => $pesanan->id]) }}" class="btn btn-primary container">Join</a>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>