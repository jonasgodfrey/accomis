@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>State Program Officer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">SPOs Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{-- Flash message --}}
                <div id="alert">
                    @include('partials.flash')
                </div>
                {{-- Flash message end --}}
                <form method="POST" action="/spo/excel" id="form1">
                    @csrf
                    <input type="button" class="input btn btn-primary" onclick="$('#form1').submit();" value="parse excel">
                </form>
                <br>
                <br>

                <form action="{{ route('spo.add') }}" method="post">
                    @csrf
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add SPO</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control select2" style="width: 100%;" name="state">
                                            <option style="display: none" selected="selected">Select State</option>
                                            @foreach ($states as $state)
                                            <option id="{{ $state->id }}" value="{{ $state->name }}">
                                                {{ $state->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="spo_name" class="form-control" placeholder="">

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="tel" name="phone" class="form-control" placeholder="">

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Physical Contact Address</label>
                                        <input type="text" name="address" class="form-control" placeholder="">

                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-primary">Add SPO</button>
                            <!-- /.row -->

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <!-- Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                the plugin. -->
                        </div>
                    </div>
                    <!-- /.card -->
                </form>

                <!-- SELECT2 EXAMPLE -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">SPOs</h3>

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
                                    <th>SPO Name</th>
                                    <th>SPO Contact</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($spos) > 0)
                                @foreach ($spos as $spo)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $spo->spo_name }}</td>
                                        <td>{{ $spo->physical_contact_address }}</td>
                                        <td>{{ $spo->state }}</td>
                                        <td><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><i
                                                    class="fa fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            @endif

                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>SPO Name</th>
                                    <th>SPO Contact</th>
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
