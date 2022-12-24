@extends('layouts.master')
@section('content')

<div class="container">
  <h2>Edit Blood Request</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif


  <form method="POST" action="{{route('posts.update',$post->id)}}" >
      {{@csrf_field()}}
  
      @method('PUT')
  

    <div class="form-group">
      <label for="title">Title:</label>
      <input type='text' class="form-control" id="title" value="{{$post->title}}" name="title"/>
    </div>

    <div class="form-group">
      <label for="short_description">Short Description:</label>
      <textarea class="form-control" id="short_description" name="short_description">{{$post->short_description}}</textarea>
    </div>

    <div class="form-group">
      <label for="status">Status:</label>
      <select class="form-control" aria-label="status" name="status">
        
        @foreach($status_array as $key => $value)
        <option value="{{$key}}" @if($key==$post->status)selected @endif >{{$value}}</option>

        @endforeach
       

       

      </select>
    </div>


  <div class="form-group">
       
      <input type="submit" class="btn btn-secondary" value="Update" name="update">
  </div>

  </form>

</div>



@endsection