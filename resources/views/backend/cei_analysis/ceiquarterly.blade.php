@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <div class="card-body">
                    <form role="form" action="{{ route('cei_analysis.table') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state" class="form-control" style="width: 100%;" id="state"
                                        required>
                                        <option style="display:none" value="">Select state to view</option>
                                        <option value="All States">All States</option>
                                        <option value="Adamawa">Adamawa</option>
                                        <option value="Delta">Delta</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quarter</label>
                                    <select name="quarter" class="form-control select2 dynamic" style="width: 100%;"
                                        id="quarter" required>
                                        <option style="display:none" value="">Select Quarter</option>
                                        <option value="Quarter_1_2021">Quarter_1_2021</option>
                                        <option value="Quarter_2_2022">Quarter_2_2021</option>
                                        <option value="Quarter_3_2021">Quarter_3_2021</option>
                                        <option value="Quarter_4_2021">Quarter_4_2021</option>
                                        <option value="Quarter_5_2021">Quarter_5_2021</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label> </label>
                                    <input name="submit" type="submit" class="form-control btn btn-success" value="Count">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- SELECT2 EXAMPLE -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">CEI Counts</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button type="submit" class="btn btn-danger" id="bulk-delete"
                            style="display:none; float:right">Delete</button>
                        <div class="col-sm-3">

                            {{-- @foreach ($kobos as $kobo)

                    <div class="c">
                    <button class="btn-primary btn">{{$kobo->Transaction_Type}}</button>
                </div>

                @endforeach --}}
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    @can('admin_spo_me')
                                        <th><input type="checkbox" id="selectall" class="checked" /></th>
                                    @endcan
                                    <th>id</th>
                                    <th>State</th>
                                    <th>Quarter</th>
                                    <th>Number of CEIs</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>


                    </div>



                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

       <br> <hr>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <div class="card-body">
                    <form role="form" action="{{ route('cei_analysis.table') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state" class="form-control" style="width: 100%;" id="state"
                                        required>
                                        <option style="display:none" value="">Select state to view</option>
                                        <option value="All States">All States</option>
                                        <option value="Adamawa">Adamawa</option>
                                        <option value="Delta">Delta</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quarter</label>
                                    <select name="quarter" class="form-control" style="width: 100%;" id="quater" required>
                                        <option style="display:none" value="">Select Quarter</option>
                                        <option value="All">All Time</option>
                                        <option value="q6">q6</option>
                                        <option value="q7">q7</option>
                                        <option value="q8">q8</option>
                                        <option value="q9">q9</option>
                                        <option value="q10">q10</option>
                                        <option value="q11">q11</option>
                                        <option value="q12">q12</option>
                                        <option value="q13">q13</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> </label>
                                    <input name="submit" type="submit" class="form-control btn btn-warning" value="Count">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- SELECT2 EXAMPLE -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Kobocei Counts</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button type="submit" class="btn btn-danger" id="bulk-delete"
                            style="display:none; float:right">Delete</button>
                        <div class="col-sm-3">

                            {{-- @foreach ($kobos as $kobo)

                    <div class="c">
                    <button class="btn-primary btn">{{$kobo->Transaction_Type}}</button>
                </div>

                @endforeach --}}
                        </div>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    @can('admin_spo_me')
                                        <th><input type="checkbox" id="selectall" class="checked" /></th>
                                    @endcan
                                    <th>id</th>
                                    <th>State</th>
                                    <th>Quarter</th>
                                    <th>Number of CEIs</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>


                    </div>



                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script src="/dist/js/cei_analysis.js"></script>
@endsection
