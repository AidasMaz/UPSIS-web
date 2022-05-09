@extends('layouts.app')

@section('content')
  <div class="container fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Grupės kurimo forma</h1>
      <a href="/groups" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Sugrįžti</a>
  </div>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif

    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-secondary">Užpildykite žemiau pateiktus laukus ir patvirtinkite veiksmą.</h5>
      </div>
      <div class="card-body"> 
        <form action="{{url('groups/store')}}" method="POST">
          @csrf
          <div class="form-group">
              <label for="title">Grupės pavadinimas</label>
              <input type="text" name="title" id="title" class="form-control" required>
          </div>
          <br>
          <div class="form-group">
              <label for="type">Grupės tipas</label>
              <select name="type" id="type" class="form-control" required>
                  <option value="ikimokykline">Ikimokyklinė</option>
                  <option value="priesmokykline">Priešmokyklinė</option>
                  </select>
          </div>
          <br>
          <div class="form-group">
              <label for="count">Vaikų skaičius grupėje</label>
              <input type="count" name="count" id="count" class="form-control" required min="1" max="20" step="1">
          </div>
          <br>
          <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Sukurti</button>
      </form>
      </div>
    </div>
  </div>
@endsection