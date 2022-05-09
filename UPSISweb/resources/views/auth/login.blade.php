@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container-fluid h-custom ">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <br><br><br>
                    {{-- <div class="card shadow" style="width: 500px">
                    <div class="card-body"> --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <img style="width: 60%; height: auto;" src="{{ asset('css/logoimage2.png') }}"
                                class="rounded mx-auto d-block" alt="Sample image">
                        </div>
                        <div class="row mb-3 ">
                            <label class="col-form-label col-form-label-lg" for="form3Example3"> Prisijungimo vardas</label>
                            <div class="form-outline mb-4">

                                <input id="username" type="text"
                                    class="form-control form-control-lg @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" required autofocus>
                            </div>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="row mb-3">

                            <div class="form-outline mb-3">
                                <label class="col-form-label col-form-label-lg" for="form3Example4">Slaptažodis</label>
                                <input id="password" type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }} />
                                <label class="form-check-label" for="remember">
                                    {{-- {{ __('Remember Me') }} --}}
                                    Įsiminti prisijungimo
                                </label>
                            </div>

                        </div>

                        <br><br>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{-- {{ __('Login') }} --}}
                                    Prisijungti
                                </button>

                                {{-- @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif --}}
                            </div>
                        </div>
                    </form>
                    {{-- </div>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
