@extends('layouts.app')

@section('content')
    <div class="container">
       <h1>Search The Category</h1>
        <form method="POST" action="{{route('category.search')}}">
            @csrf

            <div class="mb-4">   <!-- Age Group Name -->
                <label for="exampleInputEmail1" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name" >
            </div>

            <div>
                <button type="search" class="btn btn-primary">Search Category</button>
            </div>
        </form>
    </div>
@endsection








