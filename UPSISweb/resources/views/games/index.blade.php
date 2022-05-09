@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Žaidimai</h1>
        </div>

        @if(count($games) == 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Informacijos apie žaidimus nerasta</h4>
                </div>
            </div> 
        @else
      
            @foreach ($games as $game)

            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#{{$game->title}}" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="collapseCardExample">
                    <h4 class="m-0 font-weight-bold text-primary">{{$game->title}}</h4>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="{{$game->title}}">
                    <div class="card-body">
                        <p>{{$game->description}}</p>
                        <h6 class="m-1 font-weight-bold">Kategorijos:</h6>
                        @foreach ($game->categories as $category)
                            <li>{{$category->title}}: {{$category->description}}</li>
                        @endforeach
                    </div>
                </div>
            </div>                

                {{-- <ul class="list-group">
                    <h4>{{$game->title}}</h4>
                    <p>{{$game->description}}</p>

                    @foreach ($game->categories as $category)
                        <li>{{$category->title}}: {{$category->description}}</li>
                    @endforeach
                </ul>
                <br> --}}
            @endforeach
        @endif
    </div>
@endsection