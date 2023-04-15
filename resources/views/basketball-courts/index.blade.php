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



      <h1 class="mt-2 text-center">Daftar Lapangan</h1>
      <table class="table table-hover text-center">
        <a class="btn btn-primary mx-3 mb-3" href="/basketball-courts/create">Add Field</a>
        <thead>
          <tr>
            <th scope="col">Nama Lapangan</th>
            <th scope="col">Alamat</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($courtCollection as $lapangan)
            <tr>
              <td>{{ $lapangan->nama_lapangan }}</td>
              <td>{{ $lapangan->alamat }}</td>
              <td>{{ $lapangan->pesanan }}</td>
              <td><a href="{{ route('basketball-courts.edit', ['court' => $lapangan->id]) }}" class="btn btn-primary container">Edit</a></td>
              <td>
                <form action="{{ route('basketball-courts.destroy', $lapangan->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                    <button type="submit" class="btn btn-danger container">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      @if(session('error'))
      <div class="alert alert-danger mt-3 mx-3">
        {{ session('error') }}
      </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success mt-3 mx-3">
      {{ session('success') }}
    </div>
  @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>