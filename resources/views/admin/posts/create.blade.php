@extends('layouts.app')
@section('content')
<div class="container">

  <h1>nuovo post</h1>

  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach ($errors->all() as $error )
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    
  @endif

  <form action="{{route('admin.posts.store')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="exampleFormControlInput1">Titolo</label>
      <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="exampleFormControlInput1" placeholder="inserisci qui il titolo del nuovo post">
      @error('title')
      <p class="form_errors">
          {{ $message }}
      </p>
      @enderror
    </div>
   
    <div class="form-group">
      <label for="exampleFormControlTextarea1">contenuto</label>
      <textarea name="content" class="form-control @error('title') is-invalid @enderror"  id="exampleFormControlTextarea1" rows="3" placeholder="inserisci qui il contenuto del nuovo post"></textarea>
    </div>
    <div class="mb-3">
     
      <label class="form-label" for="category_id">inserisci una categoria</label>
      
      <select name="category_id" class="form-controll" id="category_id">
        <option value="" selected>Choose...</option>
        @foreach ($categories as $category )
          
          <option 
            @if($category->id == old('category_id')) selected @endif 
            value="{{$category->id}}">{{$category->name}}</option>

        @endforeach
       
      </select>
    </div>
    <div class="mb-3">
      <h5>Tag</h5>
      @foreach ($tags as $tag )
        <span class="d-line-block mr-3" >
          <input type="checkbox"
            name="tags[]"
            value="{{$tag->id}}"
            id="tag{{$loop->iteration}}"
            @if (in_array($tag->id, old('tags',[]))) checked @endif
          >
          <label for="tag{{$loop->iteration}}">{{$tag->name}}</label>

        </span>
        
      @endforeach
    </div>
    <button type="submit" class="btn btn-primary" >Invia</button>
    <button type="reset" class="btn btn-secondary" >Reset</button>
  </form>
  

</div>
  
@endsection