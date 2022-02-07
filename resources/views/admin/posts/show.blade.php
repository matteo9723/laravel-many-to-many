@extends('layouts.app')
@section('content')

<div class="container">

  <table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">titolo</th>
        <th scope="col">tags</th>
        <th scope="col">contenuto</th>
        <th scope="col">slug</th>
        <th scope="col">categoria</th>
      </tr>
    </thead>
    <tbody>
  
      <tr>
        <th scope="row">{{$post->id}}</th>
        <td>{{$post->title}}</td>
        <td> 
          @forelse ($post->tags as $tag )
            <span class="badge bg-primary">{{$tag->name}}</span>
          @empty
            -
          @endforelse
        </td>
        <td>{{$post->content}}</td>
        <td>{{$post->slug}}</td>
        @if ($post->category)
          <td>{{$post->category->name}}</td>
        @else
          <td>-</td>
        @endif

        </tr>
   
    </tbody>
  </table>
  
  <a href="{{route('admin.posts.index')}}" class="link-primary">torna indietro</a>
</div>



  
@endsection