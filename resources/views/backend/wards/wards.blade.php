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
                        <h1>Wards</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Wards Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add Wards</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form role="form" action="{{ route('wards.add') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select name="state" class="form-control select2 dynamic" style="width: 100%;"
                                            id="state_id" required>
                                            <option style="display:none" value="">Select State</option>
                                            @foreach ($states as $state)
                                                <option id="{{ $state->id }}" value="{{ $state->name }}">
                                                    {{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>L.G.A</label>
                                        <select name="lga" class="form-control select2" style="width: 100%;"
                                            id="lga" required>
                                            <option style="display:none" value="">Select Lga</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ward</label>
                                        <input type="text" name="ward_name" class="form-control" placeholder="Ward Name">
                                    </div>
                                </div>


                            </div>
                            <p class="url" id="/cbo/fetch" style="display: none"></p>
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary" name="add_cbo">Add Ward</button>
                            <!-- /.row -->

                        </div>
                    </form>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>
                <!-- /.card -->



                <!-- SELECT2 EXAMPLE -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Wards</h3>

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
                                    <th>Ward</th>
                                    <th>LGA</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($wards) > 0)
                                    @foreach ($wards as $ward)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ward->ward_name }}</td>
                                            <td>{{ $ward->lga }}</td>
                                            <td>{{ $ward->state }}</td>
                                            <td><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><i
                                                        class="fa fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>Ward</th>
                                    <th>LGA</th>
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
    <script src="dist/js/wards.js"></script>

    <script>
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>
@endsection
