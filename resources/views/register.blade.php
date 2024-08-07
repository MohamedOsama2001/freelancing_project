<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: gray">
    <header>
        <nav class="navbar navbar-expand-sm bg-danger navbar-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="{{route('welcome')}}">
              <img src="" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
            </a>
          </div>
        </nav>
    </header>
    <main>
        <div class="main-form">
            <form action="{{route('register')}}" method="POST">
                @csrf
                <div class="form-title text-center text-danger">
                    <h3>Register Now</h3>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
                </div>
                @endif
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div>
                <div class="mb-3 mt-3">
                  <label for="email" class="form-label">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3">
                  <label for="pwd" class="form-label">Password:</label>
                  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                </div>
                <button type="submit" class="btn btn-danger">Register</button>
                <p class="mt-3 ">Have an account?<a href="{{route('login')}}"> Login</a></p>
              </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>