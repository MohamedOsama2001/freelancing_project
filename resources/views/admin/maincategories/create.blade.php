@extends('admin.layouts.app')
@section('title')
   Add Main Categories
@endsection
@section('content')
<main>
    <div class="content" id="mainContent">
        <div class="container">
            <h2>Add Categories</h2>
            @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
            @endif
            <form action="{{route('admin.maincategories.store')}}" method="post">
                @csrf
                <div class="mb-3 mt-3">
                  <label for="name" class="form-label">Name: </label>
                  <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Image: </label>
                  <input type="file" class="form-control" id="image" placeholder="Enter password" name="image">
                </div>
                <button type="submit" class="btn">Add</button>
            </form>
        </div>

    </div>
</main>
@endsection