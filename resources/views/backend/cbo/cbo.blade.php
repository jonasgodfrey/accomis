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
                        <h1>Community Based Organization</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">CBOs Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @can('admin_role')
                <form method="POST" action="/cbo/excel" id="form1">
                    @csrf
                    <input type="button" class="input btn btn-primary" onclick="$('#form1').submit();" value="parse excel">
                </form>
                @endcan

                <br>
                <br>

                <!-- SELECT2 EXAMPLE -->
                <div class="card card-success">

                    <div class="card-header">
                        <h3 class="card-title">CBOs / CATs</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>CBO Name</th>
                                    <th>CBO Contact</th>
                                    <th>Email</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($cbos) > 0)
                                    @foreach ($cbos as $cbo)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cbo->cbo_name }}</td>
                                            <td>{{ $cbo->contact_person }}</td>
                                            <td>{{ $cbo->email }}</td>
                                            <td>{{ $cbo->state }}</td>
                                            <td><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><i
                                                        class="fa fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>CBO Name</th>
                                    <th>CBO Contact</th>
                                    <th>Email</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->


                </div>
                <!-- /.card -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script src="dist/js/selectField.js"></script>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>
@endsection
