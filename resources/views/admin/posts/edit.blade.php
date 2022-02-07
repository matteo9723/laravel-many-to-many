@extends('layouts.app')
@section('content')

<div class="container">

    <h1>modifica : {{$post->title}}</h1>

    @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach ($errors->all() as $error )
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      
    @endif

    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input type="text" value="{{ old('title', $post->title) }}" 
          class="form-control @error('title') is-invalid @enderror" 
          name="title" id="title" placeholder="Nome post">
          @error('title')
          <p class="form_errors">
              {{ $message }}
          </p>
          @enderror
      </div>
      <div class="mb-3">
          <label for="content" class="form-label">Contenuto</label>
          <textarea 
          class="form-control @error('content') is-invalid @enderror" 
          name="content" id="content" placeholder="contenuto">{{ old('content', $post->content) }}</textarea>
         
          @error('content')
          <p class="form_errors">
              {{ $message }}
          </p>
          @enderror
      </div>

      <div class="mb-3">
     
        <label class="form-label" for="category_id">inserisci una categoria</label>
        
        <select name="category_id" class="form-controll" id="category_id">
          <option value="" >Choose...</option>
          @foreach ($categories as $category )
            
            <option 
              @if($category->id == old('category_id', $post->category_id)) selected @endif 
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

                @if(!$errors->any() && $post->tags->contains($tag->id) )
                  checked
                @elseif ($errors->any() && in_array($tag->id, old('tags',[])))  
                  checked
                @endif  

            
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