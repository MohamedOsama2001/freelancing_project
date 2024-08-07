<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #B43F3F">
  <header>
    <nav class="navbar navbar-expand-sm navbar-light" style="background-color:white">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{route('welcome')}}">
          <img src="{{asset('images/logo2.png')}}" alt="Avatar Logo" style="width:80px;"> 
        </a>
      </div>
    </nav>
  </header>
    <main>
        <div class="main-form">
            <form action="{{route('login')}}" method="POST">
              @csrf
                <div class="form-title text-center text-danger">
                    <h3>Login Now</h3>
                </div>
                @if (Session::has('message'))
                <div class="alert alert-danger" role="alert">
                  {{Session::get('message')}}
                </div>
                @endif
                <div class="mb-3 mt-3">
                  <label for="email" class="form-label">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3">
                  <label for="pwd" class="form-label">Password:</label>
                  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                </div>
                <div class="form-check mb-3">
                  <label class="form-check-label">
                    <input class="form-check-input border border-dark" type="checkbox" name="remember"> Remember me
                  </label>
                </div>
                <button type="submit" class="btn btn-danger">Login</button>
                <p class="mt-3 ">Don't have an account?<a href="{{route('register')}}"> Register</a></p>
              </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>