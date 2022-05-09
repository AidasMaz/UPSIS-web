@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Vaiko langas</h1>
            <a href="/groups/{{ $group->id }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Grįžti</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Vaikas {{ $student->name }} iš grupės „{{ $group->title }}“
                </h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditStudent"
                            data-whatever="@getbootstrap">Redaguoti</button>
                        {{-- <a href="/groups/{{ $group->id }}/students/{{ $student->id }}/edit" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Redaguoti</a> --}}
                    </div>
                    <div class="col-6 ">
                        @auth
                            <div class="float-right">
                                @if (Auth::id() == 2 || Auth::id() == 3)
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modalDeleteStudentSolutions" data-whatever="@getbootstrap">Trinti vaiko
                                        sprendimus</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modalDeleteStudentt" data-whatever="@getbootstrap">Trinti vaiką</button>
                                    {{-- <form action="/groups/{{ $group->id }}/students/{{ $student->id }}/destroySolutions" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Trinti vaiko
                                            sprendimus</button>
                                    </form>
                                    <form action="/groups/{{ $group->id }}/students/{{ $student->id }}/destroy" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Trinti
                                            vaiką</button>
                                    </form> --}}
                                @endif
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>


        @foreach ($games as $game)
            <div class="card shadow mb-4">
                <a href="#collapseCardExample{{$game->title}}" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="collapseCardExample">
                    <h4 class="m-0 font-weight-bold text-primary">Žaidimo „{{$game->title}}“ lentelė</h4>
                </a>
                <div class="collapse show" id="collapseCardExample{{$game->title}}">
                    <div class="card-body">
                        @if (count($game->solutions) > 0)
                            <div class="row">
                                <div class="col-6 buttons">
                                    <button type="button" class="btn btn-primary" onclick="testDisplay('{{$game->title}}','all')">Visos kategorijos</button>

                                    {{-- <button type="button" class="btn btn-primary"  onclick="testDisplay('{{$game->title}}','Lengva')">Lengva</button>
                                    <button type="button" class="btn btn-primary"  onclick="testDisplay('{{$game->title}}','Vidutinė')">Vidutinė</button>
                                    <button type="button" class="btn btn-primary"  onclick="testDisplay('{{$game->title}}','Pažengusi')">Pažengusi</button>
                                     --}}
                                    @foreach ($game->categories as $category)
                                        <button type="button" class="btn btn-primary"  onclick="testDisplay('{{$game->title}}','{{$category->title}}')">{{$category->title}}</button>
                                    @endforeach

                                    {{-- <a href="/groups/create" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Sukurti grupę</a> --}}
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table id="{{$game->title}}" class="table table-bordered" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead class="bg-primary">
                                        <tr class="text-gray-100">
                                            <th>Sprendimo numeris</th>
                                            <th>Sprendimo data</th>
                                            <th>Kategorija</th>
                                            <th>Ar nutrauktas</th>
                                            <th>Teisingi sprendimai</th>
                                            <th>Neteisingi sprendimai</th>
                                            <th>Nespėti atsakyti sprendimai</th>
                                            <th>Trukmė</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-900">
                                        @foreach ($game->solutions as $solution)
                                            <tr  class="{{ $solution->category }}" 
                                                @if ($solution->was_canceled=="Taip")
                                                style="background-color:#d1d3e2"
                                                @endif
                                                >
                                                <td>{{ count($game->solutions) + 1 - $loop->iteration }} -as</td>
                                                <td>{{ $solution->play_date }}</td>
                                                <td>{{ $solution->category }}</td>
                                                <td>{{ $solution->was_canceled }}</td>
                                                @if ($solution->was_canceled=="Taip")
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                @else
                                                <td>{{ $solution->correct_answer_count }}</td>
                                                <td>{{ $solution->incorrect_answer_count }}</td>
                                                <td>{{ $solution->timed_out_answer_count }}</td>
                                                <td>{{ gmdate('i:s', $solution->duration) }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Nėra sprendimų duomenų</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    {{-- MODALAS --}}
    <div class="modal fade" id="modalEditStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vaiko redagavimo forma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if (count($names) > 0)
                    <div class="modal-body">

                        <form action="{{ url('groups/' . $group->id . '/students/' . $student->id . '/update') }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Vaiko raidė</label>
                                <select name="name" id="name" class="form-control" required>
                                    @foreach ($names as $name)
                                        @if ($name == $student->name)
                                            <option value="{{ $name }}" selected>{{ $name }}</option>
                                        @else
                                            <option value="{{ $name }}">{{ $name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                                <button type="submit"
                                    class="d-none d-sm-inline-block btn btn-primary shadow-sm">Redaguoti</button>
                        </form>
                    </div>
            </div>
        @else
            <div class="modal-body">
                <p>Grupėje nėra laisvų raidžių, todėl pakeisti vaiko raidės negalima.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
            </div>
            @endif
        </div>
    </div>
    </div>

    {{-- MODALAS --}}
    <div class="modal fade" id="modalDeleteStudentt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ar tikrai norite ištrinti vaiką
                        {{ $student->name }}?
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                    <form action="/groups/{{ $group->id }}/students/{{ $student->id }}/destroy" method="POST"
                        style="display: inline;">
                        @csrf
                        <button type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Trinti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODALAS --}}
    <div class="modal fade" id="modalDeleteStudentSolutions" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ar tikrai norite ištrinti vaiko
                        {{ $student->name }}
                        sprendimus?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                    <form action="/groups/{{ $group->id }}/students/{{ $student->id }}/destroySolutions"
                        method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Trinti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    </body>
@endsection
