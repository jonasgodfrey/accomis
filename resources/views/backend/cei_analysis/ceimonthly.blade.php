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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Month</label>
                                    <select name="month" class="form-control select2 dynamic" style="width: 100%;"
                                        id="state_id" required>
                                        <option style="display:none" value="">Selct Month</option>
                                        <option value="All Time">All Time</option>
                                        <option value="Jan">Jan</option>
                                        <option value="Feb">Feb</option>
                                        <option value="Mar">Mar</option>
                                        <option value="Apr">Apr</option>
                                        <option value="May">May</option>
                                        <option value="Jun">Jun</option>
                                        <option value="Jul">Jul</option>
                                        <option value="Aug">Aug</option>
                                        <option value="Sep">Sep</option>
                                        <option value="Oct">Oct</option>
                                        <option value="Nov">Nov</option>
                                        <option value="Dec">Dec</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select name="quarter" class="form-control" style="width: 100%;" id="quater" required>
                                        <option style="display:none" value="">Select Year</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
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
                                    <th>Month</th>
                                    <th>Year</th>
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
                                    <label>Year-Month</label>
                                    <select name="quarter" class="form-control" style="width: 100%;" id="quater" required>
                                        <option style="display:none" value="">Select Year-month</option>
                                        <option value="All time">All time</option>
                                        <option value="2022-01">2022-01</option>
                                        <option value="2022-02">2022-02</option>
                                        <option value="2022-03">2022-03</option>
                                        <option value="2022-04">2022-04</option>
                                        <option value="2022-05">2022-05</option>
                                        <option value="2022-06">2022-06</option>
                                        <option value="2022-07">2022-07</option>
                                        <option value="2022-08">2022-08</option>
                                        <option value="2022-09">2022-09</option>
                                        <option value="2022-10">2022-10</option>
                                        <option value="2022-11">2022-11</option>
                                        <option value="2022-12">2022-12</option>
                                        <option value="2023-01">2023-01</option>
                                        <option value="2023-02">2023-02</option>
                                        <option value="2023-03">2023-03</option>
                                        <option value="2023-04">2023-04</option>
                                        <option value="2023-05">2023-05</option>
                                        <option value="2023-06">2023-06</option>
                                        <option value="2023-07">2023-07</option>
                                        <option value="2023-08">2023-08</option>
                                        <option value="2023-09">2023-09</option>
                                        <option value="2023-10">2023-10</option>
                                        <option value="2023-11">2023-11</option>
                                        <option value="2023-12">2023-12</option>
                                        <option value="2024-01">2024-01</option>
                                        <option value="2024-02">2024-02</option>
                                        <option value="2024-03">2024-03</option>
                                        <option value="2024-04">2024-04</option>
                                        <option value="2024-05">2024-05</option>
                                        <option value="2024-06">2024-06</option>
                                        <option value="2024-07">2024-07</option>
                                        <option value="2024-08">2024-08</option>
                                        <option value="2024-09">2024-09</option>
                                        <option value="2024-10">2024-10</option>
                                        <option value="2024-11">2024-11</option>
                                        <option value="2024-12">2024-12</option>

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
                                    <th>Year-Month</th>
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
