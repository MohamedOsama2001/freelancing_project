@extends('admin.layouts.app')
@section('title')
    Main Categories
@endsection
@section('content')
<main>
    <div class="content" id="mainContent">
        <div class="container">
            <h2>Main Categories</h2>
            <a href="{{route('admin.maincategories.create')}}" class="btn mb-3 mt-5">Add Category</a>
            <table class="table table-dark table-striped">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                  <tr>
                    <td>{{$category->name}}</td>
                    <td>
                      <ul class="actions">
                        <li><a href=""><i class="far fa-eye"></i></a></li>
                        <li><a href=""><i class="fas fa-pen"></i></a></li>
                        <li><a href=""><i class="fas fa-trash-alt"></i></a></li>
                      </ul>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>

    </div>
</main>
@endsection