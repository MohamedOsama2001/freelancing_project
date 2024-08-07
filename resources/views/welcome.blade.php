<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
              <!-- Logo on the left -->
              <a class="navbar-brand" href="#">
                <img src="{{asset('images/logo2.png')}}" alt="Logo" style=" width:100px;">
              </a>
        
              <!-- Toggler button for small screens -->
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
        
              <!-- Collapsible content -->
              <div class="collapse navbar-collapse" id="navbarContent">
                <div class="d-flex flex-column flex-lg-row w-100 align-items-lg-center justify-content-lg-between">
                  <!-- Centered search input and button -->
                  <div class="navbar-center d-flex justify-content-center my-2 my-lg-0 ms-lg-5">
                    <form class="d-flex w-100 w-lg-50 ms-lg-5">
                      <input class="form-control me-2 ms-lg-5" style="width:400px" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-danger" type="submit">Search</button>
                    </form>
                  </div>
        
                  <!-- Login and Register on the right -->
                  @guest
                  <div class="d-flex  ms-lg-auto">
                    <a class="btn btn-outline-danger me-2 mb-lg-0" href="{{route('login')}}">Login</a>
                    <a class="btn btn-danger" href="{{route('register')}}">Register</a>
                  </div>
                  @else
                  <div class="user-actions d-flex  ms-lg-auto">
                    <span class="mt-1"><i class="fas fa-user-tie"></i> <a href="" class="user-name">name</a></span>
                    <i class="fas fa-cart-plus ms-3 mt-1"></i>
                    <i class="fas fa-heart ms-3 me-3 mt-1"></i>
                    <a class="btn btn-primary me-3" href="#">Sell</a>
                    <a href="" class="btn btn-outline-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="" method="POST" style="display: none;">
                    @csrf
                    </form>
                  </div>
                  @endguest
                  
                </div>
              </div>
            </div>
          </nav>       
    </header>
    <main>
        <div id="demo" class="carousel slide" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
              <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
              <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>
          
            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{asset('images/1.jpg')}}" alt="Los Angeles" class="d-block">
              </div>
              <div class="carousel-item">
                <img src="{{asset('images/2.jpg')}}" alt="Chicago" class="d-block">
              </div>
              <div class="carousel-item">
                <img src="{{asset('images/3.jpg')}}" alt="New York" class="d-block">
              </div>
            </div>
          </div>
    </main>
    <section>
      <div class="categories">
        <div class="container">
          <div class="categories-head">
            <h2>Categories</h2>
            <div class="line"></div>
          </div>
        <div class="categories-content mt-5">
          <div class="row">
            @foreach ($categories as $category)
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="category-image">
                <img src={{$category->image}} alt="" draggable="none">
                <div class="image-overlay">
                  <h4>{{$category->name}}</h4>
                  <a href="">View</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      </div>
    </section>
    <footer class="footer">
        <div class="container">
          <div class="row align-items-center">
            <!-- Logo on the left -->
            <div class="col-12 col-md-4 text-center text-md-start footer-logo">
              <a href="">
                <img src="" alt="Logo">
              </a>
            </div>
            
            <!-- Site description in the center -->
            <div class="descrp col-12 col-md-4 text-center mb-3 mb-md-0">
              <p class="mb-0">Welcome to our website. We provide high-quality products and services to meet your needs. Stay connected with us to know more about our offerings.</p>
            </div>
            
            <!-- Social media icons on the right -->
            <div class="col-12 col-md-4 text-center text-md-end footer-social-icons">
              <a href="#" class="fs-4"><i class="fab fa-facebook"></i></a>
              <a href="#" class="fs-4"><i class="fab fa-twitter"></i></a>
              <a href="#" class="fs-4"><i class="fab fa-instagram"></i></a>
              <a href="#" class="fs-4"><i class="fab fa-whatsapp"></i></a>
              <a href="#" class="fs-4"><i class="fas fa-envelope"></i></a>
            </div>
          </div>
        </div>
      </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>