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

    <a href="/groups/{{$group_id}}" class="btn btn-default pull-right">Atšaukti</a>
    <h1>Vaiko pridėjimo forma</h1>
    <p>Užpildykite žemiau pateiktus laukus</p>
    
    <form action="{{url('groups/'.$group_id.'/students/store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Vaiko raidė</label>
            <select name="name" id="name" class="form-control" required>
                @foreach($names as $name)
                    <option value="{{$name}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Pridėti</button>
    </form>
@endsection