@extends('layouts.app')

@section('content')
    <div class="container mt-3 text-center">
        <h1>Grupių sąrašas</h1>
        <p>{{ $title }}</p>
        <table class="table">
            <thead class="table-success">
                <tr>
                    <th>Grupės pavadinimas</th>
                    <th>Grupės tipas</th>
                    <th>Vaikų skaičius</th>
                    <th>Veiksmai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gudručiai</td>
                    <td>Priešmokykinė grupė</td>
                    <td>16</td>
                    <td><button type="button" class="btn btn-link">Peržiūrėti</button></td>
                </tr>
                <tr>
                    <td>Smalsučiai</td>
                    <td>Priešmokykinė grupė</td>
                    <td>17</td>
                    <td><button type="button" class="btn btn-info">Peržiūrėti</button></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
