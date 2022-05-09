@extends('layouts.app')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Grupių langas</h1>
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
                <h4 class="m-0 font-weight-bold text-primary">Darželio grupės</h4>
            </div>
            <div class="card-body">
                @auth
                    <div class="row">
                        @if (Auth::id() == 2 || Auth::id() == 3)
                            <div class="col-6">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                                    data-whatever="@getbootstrap">Sukurti grupę</button>
                                {{-- <a href="/groups/create" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Sukurti grupę</a> --}}
                            </div>
                            <div class="col-6 ">
                                <div class="float-right">
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modalDeleteAllSolutions" data-whatever="@getbootstrap">Ištrinti visus
                                        sprendimus</button>
                                    {{-- <a href="/groups/destroySolutions" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Ištrinti visus sprendimus</a> --}}
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#modalDeleteAllGroups" data-whatever="@getbootstrap">Ištrinti
                                        grupes</button>
                                    {{-- <a href="/groups/destroyAll" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Ištrinti grupes</a> --}}
                                </div>
                            </div>
                        @endif
                    </div>
                    <br>
                @endauth
                @if (count($groups) == 0)
                    <h5>Informacijos apie grupes nėra</h5>
                @else
                    {{-- <div class="card shadow mb-4">                        
                        <div class="card-body"> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-primary">
                                <tr class="text-gray-100">
                                    <th>Grupės pavadinimas</th>
                                    <th>Grupės tipas</th>
                                    <th>Vaikų skaičius</th>
                                    <th>Veiksmai</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-900">
                                @foreach ($groups as $group)
                                    <tr>
                                        <td>{{ $group->title }}</td>
                                        <td>{{ $group->type }}</td>
                                        <td>{{ $group->count }}</td>
                                        <td><a href="/groups/{{ $group->id }}"
                                                class="d-none d-sm-inline-block btn btn-primary shadow-sm">Peržiūrėti</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- </div>
                    </div> --}}
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

    {{-- <a href="#" data-toggle="modal" data-target="#
    ">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
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
    </div> --}}

    {{-- MODALAS --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Grupės kurimo forma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ url('groups/store') }}" method="POST">
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
                            <input type="number" name="count" id="count" class="form-control" required min="1" max="20"
                                step="1">
                        </div>
                        <br>
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
    <div class="modal fade" id="modalDeleteAllSolutions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ar tikrai norite ištrinti visų grupių sprendimus?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                    <a href="/groups/destroySolutions" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Ištrinti
                        visus sprendimus</a>
                </div>
            </div>
        </div>
    </div>

    {{-- MODALAS --}}
    <div class="modal fade" id="modalDeleteAllGroups" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ar tikrai norite ištrinti visas grupes?</h5>
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
                    <a href="/groups/destroyAll" class="d-none d-sm-inline-block btn btn-danger shadow-sm">Ištrinti
                        grupes</a>
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
