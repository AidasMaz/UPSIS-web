@extends('layouts.app')

@section('content')
    {{-- <h1>{{$title}}</h1>
    @if(count($services) > 0)
        <ul class="list-group">
            @foreach ($services as $service)
                <li class="list_group-item">{{$service}}</li>
            @endforeach
        </ul>
       
    @endif --}}
    <h1>Prisijungimo langas</h1>
    <form class="form-horizontal" action="/action_page.php">
      <div class="form-group">
        <label class="control-label col-sm-2" for="email">El. paštas:</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" placeholder="Įveskite el. paštą">
        </div>
      </div>
      <br>
      <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Slaptažodis:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="pwd" placeholder="Įveskite slaptažodį">
        </div>
      </div>
      {{--<div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label><input type="checkbox">Prisiminti mane</label>
          </div>
        </div>
      </div>--}}
      <br>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Prisijungti</button>
        </div>
      </div>
    </form>
@endsection
