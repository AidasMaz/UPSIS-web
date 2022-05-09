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
    <h1>Vaiko redagavimo forma</h1>
    <p>Pataisykite žemiau pateiktą informaciją</p>
    
    <form action="{{url('groups/'.$group_id.'/students/'.$student_id.'/update')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Vaiko raidė</label>
            <select name="name" id="name" class="form-control" required>
                @foreach($names as $name)
                    @if($name == $cur_name)
                        <option value="{{$name}}" selected>{{$name}}</option>
                    @else
                        <option value="{{$name}}">{{$name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Patvirtinti</button>
    </form>
@endsection