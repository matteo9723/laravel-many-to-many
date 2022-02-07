@extends('layouts.app')
@section('content')

<div class="container">

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
          <input type="text" value="{{ old('content', $post->content) }}" 
          class="form-control @error('content') is-invalid @enderror" 
          name="content" id="content" placeholder="contenuto">
         
          @error('content')
          <p class="form_errors">
              {{ $message }}
          </p>
          @enderror
      </div>
      <button type="submit" class="btn btn-primary" >Invia</button>
      <button type="reset" class="btn btn-secondary" >Reset</button>
    </form>  
</div>
  
@endsection