@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                {{-- Flash message --}}
                <div id="alert">
                    @include('partials.flash')
                </div>
                {{-- Flash message end --}}
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1>Remedial Feedback</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">View More-</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        </div>
@endsection
@section('js')
    <script src="dist/js/selectField.js"></script>
@endsection