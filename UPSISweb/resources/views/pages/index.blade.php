@extends('layouts.app')

@section('content')
    {{-- <div class="jumbotron text-center">
        <h1>Welcome To Laravel</h1>
        <p>text text text text text text text text text text text text text text text</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    </div> --}}
    <div class="container mt-3">
        <h2>Grupės "Pav" Suskaičiuok žaidimo statistika</h2>
        {{-- <p>You can use any of the contextual classes to only add a color to the table header:</p> --}}
        <h4>A</h4>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Sprendimo numeris</th>
                    <th>Sprendimo data</th>
                    <th>Kategorija</th>
                    <th>Bandymai</th>
                    <th>Teisingi sprendimai</th>
                    <th>Neteisingi sprendimai</th>
                    <th>Trukmė (procentali trukmė)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2022-04-11</td>
                    <td>Vidutinis sunkumas</td>
                    <td>14</td>
                    <td>8</td>
                    <td>6</td>
                    <td>1:27 (78%)</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2022-04-11</td>
                    <td>Vidutinis sunkumas</td>
                    <td>14</td>
                    <td>8</td>
                    <td>6</td>
                    <td>1:07 (56%)</td>
                </tr>
            </tbody>
        </table>
        <h4>B</h4>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Sprendimo numeris</th>
                    <th>Sprendimo data</th>
                    <th>Kategorija</th>
                    <th>Bandymai</th>
                    <th>Teisingi sprendimai</th>
                    <th>Neteisingi sprendimai</th>
                    <th>Trukmė (procentali trukmė)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2022-04-11</td>
                    <td>Vidutinis sunkumas</td>
                    <td>14</td>
                    <td>8</td>
                    <td>6</td>
                    <td>1:27 (56%)</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2022-04-11</td>
                    <td>Vidutinis sunkumas</td>
                    <td>14</td>
                    <td>8</td>
                    <td>6</td>
                    <td>1:07 (56%)</td>
                </tr>
            </tbody>
        </table>
        <h4>C</h4>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Sprendimo numeris</th>
                    <th>Sprendimo data</th>
                    <th>Kategorija</th>
                    <th>Bandymai</th>
                    <th>Teisingi sprendimai</th>
                    <th>Neteisingi sprendimai</th>
                    <th>Trukmė (procentali trukmė)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2022-04-11</td>
                    <td>Vidutinis sunkumas</td>
                    <td>14</td>
                    <td>8</td>
                    <td>6</td>
                    <td>1:27 (56%)</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2022-04-11</td>
                    <td>Vidutinis sunkumas</td>
                    <td>14</td>
                    <td>8</td>
                    <td>6</td>
                    <td>1:07 (56%)</td>
                </tr>
            </tbody>
        </table>
        <br><br><br><br>
        
        <br><br><br><br>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Vaiko raidė</th>
                    <th>Žaistų žaidimų kiekis</th>
                    <th>Veiksmai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>A</td>
                    <td>3</td>
                    <td>Peržiūrėti</td>
                </tr>
                <tr>
                    <td>B</td>
                    <td>4</td>
                    <td>Peržiūrėti</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
