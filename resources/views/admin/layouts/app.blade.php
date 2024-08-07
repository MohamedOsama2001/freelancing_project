<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
            <div class="container">
              <!-- Logo on the left -->
              <a class="navbar-brand" href="#">
                <img src="" alt="Logo" style="height: 40px;">
              </a>
        
              <!-- Toggler button for small screens -->
              <button class="navbar-toggler bg-light"type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
        
              <!-- Navbar content -->
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <span class="navbar-text d-inline-block me-3 text-white">Username</span>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="#">Logout</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <aside>
        <div class="sidebar" id="sidebar">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="/admin" id="tab1">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.maincategories.index')}}" id="tab2">Main Categories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="tab3">Subcategories</a>
              </li>
            </ul>
          </div>
    </aside>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>    