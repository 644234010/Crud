<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <title>@yield('title')</title>
    <style>
      html, body {
          height: 100%;
          margin: 0;
      }
      body {
          display: flex;
          flex-direction: column;
      }
      #app {
          flex: 1;
          display: flex;
          flex-direction: column;
      }
      footer {
          background-color: #343a40;
          color: white;
          text-align: center;
          padding: 1rem 0;
      }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="/home">KITTIPAT</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/create">Add information</a>
              </li>
              <form class="d-flex" role="search" method="POST" action="{{ route('search') }}" onsubmit="return false;">
                @csrf
                <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search" id="search-input">
                <button class="btn btn-outline-success" type="submit" id="search-button">Search</button>
              </form>
            </ul>
            <div class="d-flex align-items-center">
              <span class="navbar-text me-3 p-2 border border-primary rounded">
                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
              </span>
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success ms-3">Logout</button>
              </form>
            </div>
          </div>
        </div>
      </nav>
      <div id="app">
        <div class="container">
          @yield('content')
        </div>
      </div>
      <footer>
        <p>&copy; 2024 KITTIPAT_CAR. All Rights Reserved.</p>
      </footer>

      
</body>
</html>
