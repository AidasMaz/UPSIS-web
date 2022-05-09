@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Instrukcijų apžvalga</h1>
        </div>

        <div class="card shadow mb-4">
            <a href="#navigation" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
                aria-controls="collapseCardExample">
                <h4 class="m-0 font-weight-bold text-primary">Navigacija</h4>
            </a>
            <div class="collapse show" id="navigation">
                <div class="card-body">
                    This is a collapsable card example using Bootstrap's built in collapse
                    functionality. <strong>Click on the card header</strong> to see the card body
                    collapse and expand!
                </div>
            </div>
        </div>


        @if (Auth::id() == 2 || Auth::id() == 3)
            <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#preparingSystem" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="collapseCardExample">
                    <h4 class="m-0 font-weight-bold text-primary">Sistemos paruošimas darbui</h4>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="preparingSystem">
                    <div class="card-body">
                        This is a collapsable card example using Bootstrap's built in collapse
                        functionality. <strong>Click on the card header</strong> to see the card body
                        collapse and expand!
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#systemFunctionsForAdmin" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="collapseCardExample">
                    <h4 class="m-0 font-weight-bold text-primary">Sistemos funkcijos administracijai</h4>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="systemFunctionsForAdmin">
                    <div class="card-body">
                        This is a collapsable card example using Bootstrap's built in collapse
                        functionality. <strong>Click on the card header</strong> to see the card body
                        collapse and expand!
                    </div>
                </div>
            </div>
        @endif

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#systemFunctions" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h4 class="m-0 font-weight-bold text-primary">Sistemos funkcijos</h4>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="systemFunctions">
                <div class="card-body">
                    This is a collapsable card example using Bootstrap's built in collapse
                    functionality. <strong>Click on the card header</strong> to see the card body
                    collapse and expand!
                </div>
            </div>
        </div>

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
@endsection
