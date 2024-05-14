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
                    <form role="form" action="{{ route('cei_quarterly.search') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state" class="form-control" style="width: 100%;" id="state"
                                        required>
                                        <option style="display:none" value="">Select state to view</option>
                                        <option value="all_states">All States</option>
                                        @forelse ($states as $state)
                                            <option value="{{ $state->name }}">{{ $state->name }}</option>
                                        @empty
                                            <p>No data found</p>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quarter</label>
                                    <select name="quarter" class="form-control select2 dynamic" style="width: 100%;"
                                        id="quarter" required>
                                        <option style="display:none" value="">Select Quarter</option>
                                        <option value="q1">Quarter_1_2024</option>
                                        <option value="q2">Quarter_2_2024</option>
                                        <option value="q3">Quarter_3_2024</option>
                                        <option value="q4">Quarter_4_2024</option>
                                        <option value="q5">Quarter_5_2024</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label> </label>
                                    <input name="submit" type="submit" class="form-control btn btn-success"
                                        value="Count">
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
                                    <th>Achievements</th>
                                    <th>Target</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session()->has('states_data'))
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach (session()->get('states_data') as $data)
                                        @php
                                            $count++;
                                        @endphp
                                        <tr>
                                            <td></td>
                                            <td>{{ $count }}</td>
                                            <td>{{ $data['state_name'] ?? session('state') }}</td>
                                            <td>{{ $data['quarter'] ?? session('quarter') }}</td>
                                            <td>{{ $data['count'] }}</td>
                                            <td>384</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>


                    </div>



                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <br>
        <hr>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                {{-- <div class="card-body">
                    <form role="form" action="{{ route('kobocei_quarterly.search') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state" class="form-control" style="width: 100%;" id="state"
                                        required>
                                        <option style="display:none" value="">Select state to view</option>
                                        <option value="all_states">All States</option>
                                        @forelse ($states as $state)
                                            <option value="{{ $state->name }}">{{ $state->name }}</option>
                                        @empty
                                            <p>No data found</p>
                                        @endforelse
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quarter</label>
                                    <select name="quarter" class="form-control" style="width: 100%;" id="quater"
                                        required>
                                        <option style="display:none" value="">Select Quarter</option>
                                        <option value="all_quarter">All Time</option>
                                        <option value="q1">q1</option>
                                        <option value="q2">q2</option>
                                        <option value="q3">q3</option>
                                        <option value="q4">q4</option>
                                        <option value="q5">q5</option>
                                        <option value="q6">q6</option>
                                        <option value="q7">q7</option>
                                        <option value="q8">q8</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> </label>
                                    <input name="submit" type="submit" class="form-control btn btn-warning"
                                        value="Count">
                                </div>
                            </div>
                        </div>
                    </form>
                </div> --}}

                <!-- SELECT2 EXAMPLE -->
                <div class="card card-warning">
                    {{-- <div class="card-header">
                        <h3 class="card-title">Kobocei Quarterly Entries</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div> --}}
                    <!-- /.card-header -->
                    {{-- <div class="card-body">
                        <button type="submit" class="btn btn-danger" id="bulk-delete"
                            style="display:none; float:right">Delete</button>
                        <div class="col-sm-3"> --}}

                            {{-- @foreach ($kobos as $kobo)

                    <div class="c">
                    <button class="btn-primary btn">{{$kobo->Transaction_Type}}</button>--}}
                {{-- </div> --}}

                {{-- @endforeach --}}
                        {{-- </div> --}}
                        {{-- <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    @can('admin_spo_me')
                                        <th><input type="checkbox" id="selectall" class="checked" /></th>
                                    @endcan
                                    <th>id</th>
                                    <th>State</th>
                                    <th>Quarter</th>
                                    <th>Achievements</th>
                                    <th>Target</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session()->has('cei_states_data'))
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach (session()->get('cei_states_data') as $data)
                                        @php
                                            $count++;
                                        @endphp
                                        <tr>
                                            <td></td>
                                            <td>{{ $count }}</td>
                                            <td>{{ $data['state_name'] ?? session('cei_state') }}</td>
                                            <td>{{ session('cei_quarter') ?? '' }}</td>
                                            <td>{{ $data['count'] }}</td>
                                            <td>384</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table> --}}


                    </div>



                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <div class="card-body">
                    <form role="form" action="{{ route('kobocei_quarterly.analysis') }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state" class="form-control select2 dynamic" style="width: 100%;"
                                        id="state_id" required>
                                        <option style="display:none" value="">Select state to view</option>
                                        @forelse ($states as $state)
                                            <option value="{{ $state->name }}">{{ $state->name }}</option>
                                        @empty
                                            <p>No data found</p>
                                        @endforelse
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>CBO</label>
                                    <select name="cbo" class="form-control" style="width: 100%" id="cbo">
                                        required>
                                        <option value="all_cbo">All CBOS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Quarter</label>
                                    <select name="quarter" class="form-control" style="width: 100%;" id="quater"
                                        required>
                                        <option style="display:none" value="">Select Quarter</option>
                                        <option value="all_quarter">All Time</option>
                                        <option value="q1">q1</option>
                                        <option value="q2">q2</option>
                                        <option value="q3">q3</option>
                                        <option value="q4">q4</option>
                                        <option value="q5">q5</option>
                                        <option value="q6">q6</option>
                                        <option value="q7">q7</option>
                                        <option value="q8">q8</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> </label>
                                    <input name="submit" type="submit" class="form-control btn btn-warning"
                                        value="Count">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- SELECT2 EXAMPLE -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Quarterly Kobocei CBO Breakdown</h3>

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
                        <table id="example3" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    @can('admin_spo_me')
                                        <th><input type="checkbox" id="selectall" class="checked" /></th>
                                    @endcan
                                    <th>id</th>
                                    <th>State</th>
                                    <th>CBOs</th>
                                    <th>Quarter</th>
                                    <th>Quarterly Achievements</th>
                                    <th>Target</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session()->has('kobo_cei_analysis'))
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach (session()->get('kobo_cei_analysis') as $data)
                                        @php
                                            $count++;
                                        @endphp
                                        <tr>
                                            <td></td>
                                            <td>{{ $count }}</td>
                                            <td>{{ $data['state_name'] ?? session('cei_state') }}</td>
                                            <td>{{ $data['cbo_name'] }}</td>
                                            <td>{{ session('cei_quarter') ?? '' }}</td>
                                            <td>{{ $data['count'] }}</td>
                                            <td>24</td>
                                        </tr>
                                    @endforeach
                                @endif
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
<script>
    $(function () {
      $("#example3").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        buttons: ["csv", "excel","print", "colvis"]
      }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

      $("#example2").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        buttons: ["csv", "excel","print", "colvis"]
      }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
