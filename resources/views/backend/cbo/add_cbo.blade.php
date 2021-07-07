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
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add CBOs</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form role="form" action="{{ route('cbo.add') }}" enctype="multipart/form-data" method="POST">
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
                                        <select name="lga" class="form-control select2 dynamic2" style="width: 100%;"
                                            id="lga" required>
                                            <option style="display:none" value="">Select Lga</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Community Based Organization</label>
                                        <input type="text" name="cbo_name" class="form-control" placeholder="Cbo Name">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contact Person</label>
                                        <input type="text" name="contact_person" class="form-control" required
                                            placeholder="">

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required placeholder="">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="tel" name="phone" class="form-control" required placeholder="">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Engagement on Project</label>
                                        <input type="date" name="engage_date" class="form-control" required placeholder="">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Establishment of CAT</label>
                                        <input type="date" name="establish_date" class="form-control" required
                                            placeholder="">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Physical Contact Address</label>
                                        <input type="text" name="contact_address" class="form-control" required
                                            placeholder="">

                                    </div>
                                </div>
                            </div>
                            <p class="url" id="/cbo/fetch" style="display: none"></p>
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary" name="add_cbo">Add CBO</button>
                            <!-- /.row -->

                        </div>
                    </form>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>
                <!-- /.card -->

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add CAT Members</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form role="form" action="{{ route('cat.add') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state" class="form-control select2 dynamic2" style="width: 100%;"
                                        id="state_id" required>
                                        <option style="display:none" value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option id="{{$state->id}}" value="{{ $state->name }}">
                                                {{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>L.G.A</label>
                                    <select class="form-control select2 dynamic3" name="lga" style="width: 100%;" id="lga2">
                                        <option style="display: none" selected="selected">Select LGA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Community Based Organization</label>
                                    <select name="cbo_name" class="form-control select2" style="width: 100%;" id="cbo1" required>
                                        <option style="display:none">Select Cbo</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="tel" name="tel" class="form-control" placeholder="">

                                </div>
                            </div>

                        </div>


                        <button class="btn btn-primary">Add CAT</button>
                        <!-- /.row -->
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script src="dist/js/selectField.js"></script>
@endsection
