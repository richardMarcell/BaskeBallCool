<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Field Page</title>
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


      <form class="mt-5" action="{{ route('booking.store') }}" method="post">
        @csrf

        <label for="lapangan_id" class="container mx-2">Lapangan</label><br>
        <select name="lapangan_id" id="lapangan_id" class="container mx-3">
          @foreach ($courtCollection as $court)
              <option value="{{ $court->id }}">
                {{ $court->nama_lapangan }}, <b>{{ $court->alamat }}</b>
              </option>
          @endforeach
        </select>


        <label for="pemesan" class="container mx-2">Pemesan</label><br>
        <input type="text" class="container mx-3" name="pemesan" id="pemesan" value="{{ request()->cookie('username') }}">
        @if ($errors->has('pemesan'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>Nama Pemesan Wajib Diisi</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <br>

        <label for="email" class="container mx-2">Email</label><br>
        <input type="email" class="container mx-3" name="email" id="email" value="{{ request()->cookie('email') }}">
        @if ($errors->has('email'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>Email Wajib Diisi</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <br>

        <label for="tanggal" class="container mx-2">Tanggal</label><br>
        <input type="date" class="container mx-3" name="tanggal" id="tanggal" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+5 days')) }}" value="{{ old('tanggal') }}">
        @if ($errors->has('tanggal'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>Tanggal Wajib Diisi</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <br>

        <p class="mx-3 mt-4">Waktu Bermain</p>
        <div class="form-check d-flex mx-3">
            @php 
            $jam_mulai = strtotime("16:00"); 
            $jam_selesai = strtotime("22:00"); 
            $jam = $jam_mulai; 
            @endphp 
            @while($jam <= $jam_selesai)
                <input class="form-check-input mx-3" type="checkbox" name="jam[]" value="{{ date('H:i', $jam) }}">
                <label class="form-check-label" for="{{ date('H:i', $jam) }}">
                    {{ date('H:i', $jam) }}
                </label>
                @php $jam = strtotime('+1 hour', $jam); @endphp
            @endwhile
        </div>
        @if ($errors->has('jam'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>Waktu Bermain Wajib Diisi</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <br>

        <label for="jumlah_pemain" class="container mx-2">Jumlah Pemain</label><br>
        <input type="number" class="container mx-3" name="jumlah_pemain" value="{{ old('jumlah_pemain') }}" id="jumlah_pemain">
        @if ($errors->has('jumlah_pemain'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <p>Jumlah Pemain Wajib Diisi</p>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <br>

        <label for="jumlah_pemain_max" class="container mx-2">Pemain Max</label><br>
        <input type="number" class="container mx-3" value="{{ old("jumlah_pemain_max") }}" name="jumlah_pemain_max" id="jumlah_pemain_max">
        @if ($errors->has('jumlah_pemain_max'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>Pemain Max Wajib Diisi</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <br>

        <label for="deskripsi" class="container mx-2">Deskripsi</label><br>
        <input type="text" class="container mx-3" value="{{ old('deskripsi') }}" name="deskripsi" id="deskripsi">
        @if ($errors->has('deskripsi'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>Deskripsi Lapangan Wajib Diisi</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <br>

        <label for="izin_join" class="container mx-2">Izin Gabung</label><br>
        <select name="izin_join" id="izin_join"class="container mx-3">
            <option value="ya">Ya</option>
            <option value="tidak">Tidak</option>
        </select>
        @if ($errors->has('izin_join'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>Izin Bermain Lapangan Wajib Diisi</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <br>

        <button type="submit" class="mt-2 mx-3 btn btn-primary container">Order</button>
      </form>
      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>    
  </body>
</html>