@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Nustatymai</h1>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <p><strong>Upps... Kažkas atsitiko</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Bendros paskyros nustatymai</h4>
            </div>

            <div class="card-body">
                <p>Prisijungimo vardas: {{ $general_user->username }}</p>
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditGeneralUser"
                        data-whatever="@getbootstrap">Keisti</button>
                </div>
            </div>

        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Administracijos paskyros nustatymai</h4>
            </div>

            <div class="card-body">
                <p>Prisijungimo vardas: {{ $administration_user->username }}</p>
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditAdminUser"
                        data-whatever="@getbootstrap">Keisti</button>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="modalEditGeneralUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bendros paskyros redagavimo forma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="/settings/update" method="POST">
                        @csrf
                        <input hidden type="text" class="form-control" id="id" value="{{ $general_user->id }}" name="id"
                            required>
                        <div class="form-group">
                            <label for="name">Vardas:</label>
                            <input type="text" class="form-control" id="name" value="{{ $general_user->username }}"
                                name="name" required>

                        </div>
                        <div class="form-group">
                            <label for="password">Naujas slaptažodis</label>
                            <input class="form-control" name="password" type="password" required />
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                    <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Atnaujinti</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEditAdminUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Administratoriaus paskyros redagavimo forma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="/settings/update" method="POST">
                        @csrf
                        <input hidden type="text" class="form-control" id="id" value="{{ $administration_user->id }}"
                            name="id" required>
                        <div class="form-group">
                            <label for="name">Vardas:</label>
                            <input type="text" class="form-control" id="name"
                                value="{{ $administration_user->username }}" name="name" required>

                        </div>
                        <div class="form-group">
                            <label for="password">Naujas slaptažodis</label>
                            <input class="form-control" name="password" type="password" required />
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                    <button type="submit" class="d-none d-sm-inline-block btn btn-primary shadow-sm">Atnaujinti</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
