@extends('layouts.app')
@section('content')
<div class="container">

  <form action="{{route('admin.posts.store')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="exampleFormControlInput1">Titolo</label>
      <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="inserisci qui il titolo del nuovo post">
    </div>
   
    <div class="form-group">
      <label for="exampleFormControlTextarea1">contenuto</label>
      <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="inserisci qui il contenuto del nuovo post"></textarea>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Options</label>
      </div>
      <select name="category_id" class="custom-select" id="inputGroupSelect01">
        <option selected>Choose...</option>
        <option value="1">HTML</option>
        <option value="2">PHP</option>
        <option value="3">CSS</option>
        <option value="3">Javascripts</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary" >Invia</button>
    <button type="reset" class="btn btn-secondary" >Reset</button>
  </form>
  

</div>
  
@endsection