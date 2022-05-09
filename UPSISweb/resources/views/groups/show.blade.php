@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Grupės langas</h1>
            <a href="/groups" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Grįžti</a>
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

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">{{ $group->type }} grupė „{{ $group->title }}“</h4>
            </div>

            <div class="card-body">
                @auth
                    <div class="row">
                        @if (Auth::id() == 2 || Auth::id() == 3)
                            <div class="col-6">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditGroup"
                                    data-whatever="@getbootstrap">Redaguoti grupę</button>
                                {{-- <a href="/groups/{{ $group->id }}/edit" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Redaguoti</a> --}}
                            </div>
                            <div class="col-6 ">
                                <div class="float-right">
                                    {{-- <form action="/groups/{{ $group->id }}/destroy" method="POST">
                                        @csrf
                                        <button type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Trinti grupę</button>
                                    </form> --}}
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modalDeleteGroup" data-whatever="@getbootstrap">Trinti grupę</button>
                                </div>
                            </div>
                        @endif
                    </div>
                @endauth
            </div>
        </div>
        {{-- <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Žaidimų ataskaitos</h4>
            </div>
            <div class="card-body">
                @foreach ($games as $game) --}}
                    {{-- <a href="/groups/{{ $group->id }}/edit"
                        class="d-none d-sm-inline-block btn btn-primary shadow-sm">{{ $game->title }}</a> --}}
                    {{-- <h5>{{ $game->title }} apibendrinti duomenys</h5> --}}
                    {{-- @if (count($students) > 0) --}}
                    {{-- <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-primary">
                                <tr class="text-gray-100">
                                    <th>Kategorija</th>
                                    <th>Bendras sprendimų skaičius</th>
                                    <th>Vidutinis sprendimų skaičius</th>
                                    <th>Vidutinis teisingų atsakymų skaičius</th>
                                    <th>Vidutinis neteisingų atsakymų skaičius</th>
                                    <th>Vidutinis laiku neatsakytų atsakymų skaičius</th>
                                    <th>Vidutinė trukmė</th>
                                    <th>Vidutinis nutraukimo procentas</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="text-gray-900"> --}}
                                {{-- @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->solution_count }}</td>
                                        <td>{{ $student->last_solution_date }}</td>
                                        <td><a href="/groups/{{ $group->id }}/students/{{ $student->id }}"
                                                class="d-none d-sm-inline-block btn btn-primary shadow-sm">Peržiūrėti</a>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            {{-- </tbody>
                        </table>
                        <br>
                    </div>
                @endforeach --}}
                {{-- @else
                    <p>Grupėje vaikų nėra</p>
                @endif --}}
            {{-- </div>
        </div> --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Grupės vaikai</h4>
            </div>
            <div class="card-body">
                @auth
                    <div class="row">
                        @if (Auth::id() == 2 || Auth::id() == 3)
                            <div class="col-6">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddStudent"
                                    data-whatever="@getbootstrap">Pridėti vaiką</button>
                                {{-- <a href="/groups/{{ $group->id }}/students/create" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Pridėti vaiką</a> --}}
                            </div>
                            <div class="col-6 ">
                                <div class="float-right">
                                    {{-- <a href="/groups/{{ $group->id }}/students/destroySolutions"
                                        class="d-none d-sm-inline-block btn btn-primary shadow-sm">istrinti </a> --}}
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modalDeleteGroupSolutions" data-whatever="@getbootstrap">Trinti vaikų
                                        sprendimus</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modalDeleteGroupStudents" data-whatever="@getbootstrap">Trinti
                                        vaikus</button>
                                    {{-- <form action="/groups/{{ $group->id }}/students/destroySolutions" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Ištrinti vaikų
                                            sprendimus</button>
                                        </form>
                                        <form action="/groups/{{ $group->id }}/students/destroyAll" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Ištrinti vaikus</button>
                                        </form> --}}
                                </div>
                            </div>
                        @endif
                    </div>
                    <br>
                @endauth
                @if (count($students) > 0)
                    {{-- <div class="card shadow mb-4">
                        <div class="card-body"> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-primary">
                                <tr class="text-gray-100">
                                    <th>Vaiko raidė</th>
                                    <th>Suskaičiuok pažanga</th>
                                    <th>Atrink pažanga</th>
                                    <th>Bendras sprendimų skaičius</th>
                                    <th>Paskutinio sprendimo data</th>
                                    <th>Veiksmai</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-900">
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        @foreach ($student->progresions as $progression)
                                            <td>
                                                @foreach ($progression as $line)
                                                    {{ $line }} <br>
                                                @endforeach
                                            </td>
                                        @endforeach
                                        <td>{{ $student->solution_count }}</td>
                                        <td>{{ $student->last_solution_date }}</td>
                                        <td><a href="/groups/{{ $group->id }}/students/{{ $student->id }}"
                                                class="d-none d-sm-inline-block btn btn-primary shadow-sm">Peržiūrėti</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- </div>
                    </div> --}}
                @else
                    <p>Grupėje vaikų nėra</p>
                @endif

            </div>
        </div>

        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
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
    <div class="modal fade" id="modalEditGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Grupės redagavimo forma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="/groups/{{ $group->id }}/update" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Grupės pavadinimas</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $group->title }}"
                                required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="type">Grupės tipas</label>
                            <select name="type" id="type" class="form-control" required>
                                <option {{ old('type', $group->type) == 'Ikimokyklinė' ? 'selected' : '' }}
                                    value="ikimokykline">Ikimokyklinė</option>
                                <option {{ old('type', $group->type) == 'Priešmokyklinė' ? 'selected' : '' }}
                                    value="priesmokykline">Priešmokyklinė</option>
                            </select>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                    <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Sukurti</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODALAS --}}
    <div class="modal fade" id="modalDeleteGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ar tikrai norite ištrinti grupę
                        „{{ $group->title }}“?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    {{-- <form action="{{url('/groups/destroyAll')}}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                        <button type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Ištrinti</button>
                    </form> --}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                    <form action="/groups/{{ $group->id }}/destroy" method="POST">
                        @csrf
                        <button type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Trinti
                            grupę</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODALAS --}}
    <div class="modal fade" id="modalAddStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vaiko pridėjimo forma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if (count($students) < 20)
                    <div class="modal-body">
                        <form action="{{ url('groups/' . $group->id . '/students/store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Vaiko raidė</label>
                                <select name="name" id="name" class="form-control" required>
                                    @foreach ($names as $name)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                        <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Pridėti</button>
                    </div>
                    </form>
                @else
                    <div class="modal-body">
                        <p>Grupėje yra maksimalus vaikų skaičius, todėl pridėti daugiau vaikų negalima.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- MODALAS --}}
    <div class="modal fade" id="modalDeleteGroupSolutions" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ar tikrai norite ištrinti grupės vaikų sprendimus?
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                    <form action="/groups/{{ $group->id }}/students/destroySolutions" method="POST"
                        style="display: inline;">
                        @csrf
                        <button type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm">
                            Ištrinti vaikų sprendimus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODALAS --}}
    <div class="modal fade" id="modalDeleteGroupStudents" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ar tikrai norite ištrinti grupės vaikus?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                    <form action="/groups/{{ $group->id }}/students/destroyAll" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="d-none d-sm-inline-block btn btn-danger shadow-sm">
                            Ištrinti vaikus
                        </button>
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
