<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            {{-- @if (Route::has('login'))
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Prisijungti') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registruotis') }}</a>
                </li>
            @endif --}}
        @else
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-gray-800" href="#" id="navbarDarkDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end" data-toggle="modal"
                            data-target="#exampleModalCenter">
                            <li>
                                <div class="dropdown-item">{{ __('Atsijungti') }}</div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>


            <!-- Modal -->

            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Ar tikrai norite atsijungti?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{-- <div class="modal-body">
                            ...
                        </div> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                            <a type="button" class="btn btn-primary" href="{{ route('logout') }}">Atsijungti </a>
                        </div>
                    </div>
                </div>
            </div>

        @endguest
    </ul>
</nav>
