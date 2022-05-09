@extends('layouts.app')

@section('content')
    <div class="container mt-3 text-center">
        <h1>Grupė {X} ({tipas})</h1>
        <p>{{ $title }}</p>
        <table class="table">
            <thead class="table-success">
                <tr>
                    <th>Vaiko raidė</th>
                    <th>Žaistų žaidimų kiekis</th>
                    <th>Paskutinio sprendimo data</th>
                    <th>Veiksmai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>A</td>
                    <td>3</td>
                    <td>2022-04-15 10:46</td>
                    <td><button type="button" class="btn btn-link">Peržiūrėti</button></td>
                </tr>
                <tr>
                    <td>B</td>
                    <td>4</td>
                    <td>2022-04-15 10:46</td>
                    <td><button type="button" class="btn btn-info">Peržiūrėti</button></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
