@extends('layouts.app')

@section('content')
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif

    <a href="/groups/{{$group->id}}" class="btn btn-default pull-right">Atšaukti</a>
    <h1>Grupės redagavimo forma</h1>
    <p>Pataisykite žemiau pateiktą informaciją</p>

    <form action="/groups/{{$group->id}}/update" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Grupės pavadinimas</label>
            <input type="text" name="title" id="title" class="form-control" value="{{$group->title}}" required>
        </div>
        <br>
        <div class="form-group"> 
            <label for="type">Grupės tipas</label>
            <select name="type" id="type" class="form-control" required>
                <option {{old('type', $group->type) == "Ikimokyklinė" ? 'selected' : ''}} value="ikimokykline">Ikimokyklinė</option>
                <option {{old('type', $group->type) == "Priešmokyklinė" ? 'selected' : ''}} value="priesmokykline">Priešmokyklinė</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Patvirtinti</button>
    </form>
@endsection