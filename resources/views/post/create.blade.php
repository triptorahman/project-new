@extends('layouts.master')
@section('content')

<div class="container">
  <h2>Create Post</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif


  <form method="POST" action="{{route('posts.store')}}" >
    {{@csrf_field()}}
    <div class="form-group">
      <label for="Title">Title:</label>
      <input type="text" class="form-control" id="title" name="title"/>
    </div>

    

    <div class="form-group">
      <label for="short_description">Short Description:</label>
      <textarea class="form-control" id="short_description" name="short_description"></textarea>
    </div>

    <div class="form-group">
      <label for="status">Status:</label>
      <select class="form-control" aria-label="status" name="status">
        
        @foreach($status_array as $key => $value)
        

       
        
        <option value="{{$key}}">{{$value}}</option>

        @endforeach

      </select>
    </div>

    <div class="form-group">
        
        <input type="submit" class="btn btn-secondary" value="Post" name="Add">
    </div>

  </form>

</div>



@endsection