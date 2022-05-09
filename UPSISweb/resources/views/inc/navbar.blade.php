<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
        </div>
        <div class="sidebar-brand-text mx-3">UPSIS</div>

    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li  class="nav-item">
        <a id="1" class="nav-link active" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Apžvalga</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->




    <!-- Nav Item - Pages Collapse Menu -->
    @auth
        <div class="sidebar-heading">
            Langai
        </div>

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="/groups" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>Grupės</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li> --}}
        <li class="nav-item">
            <a id="2" class="nav-link" href="/groups">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>Grupės</span></a>
        </li>
        
        <li class="nav-item">
            <a id="3" class="nav-link" href="/about">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span>Instrukcijos</span></a>
        </li>

        <li class="nav-item">
            <a id="4" class="nav-link" href="/games">
                <i class="fa fa-gamepad" aria-hidden="true"></i>
                <span>Žaidimai</span></a>
        </li>

        @if(Auth::id() == 2 || Auth::id() == 3)
            <li class="nav-item">
                <a id="5" class="nav-link" href="/settings">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span>Nustatymai</span></a>
            </li>
        @endif
        
    @endauth

    @if (Auth::guest())
        <li class="nav-item">
            <a class="nav-link collapsed" href="/login" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Prisijungti</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li>   
    @endif
    
    <!-- Divider -->
    <hr class="sidebar-divider">
</ul>
