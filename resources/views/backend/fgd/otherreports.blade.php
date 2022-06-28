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
                    <form role="form" action="{{ route('otherreportsquarterly.search') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state" class="form-control" style="width: 100%;" id="state" required>
                                        <option style="display:none" value="">Select state to view</option>
                                        <<option value="all_states">All States</option>
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
                                    <label>Quarter</label>
                                    <select name="quarter" class="form-control" style="width: 100%;" id="quater" required>
                                        <option style="display:none" value="">Select Quarter</option>
                                        <option value="Quarter_1_2021">Quarter_1_2021</option>
                                        <option value="Quarter_2_2022">Quarter_2_2021</option>
                                        <option value="Quarter_3_2021">Quarter_3_2021</option>
                                        <option value="Quarter_4_2021">Quarter_4_2021</option>
                                        <option value="Quarter_5_2022">Quarter_5_2022</option>
                                        <option value="Quarter_6_2022">Quarter_6_2022</option>
                                        <option value="Quarter_7_2022">Quarter_7_2022</option>
                                        <option value="Quarter_8_2022">Quarter_8_2022</option>
                                        <option value="Quarter_9_2023">Quarter_9_2023</option>
                                        <option value="Quarter_10_2023">Quarter_10_2023</option>
                                        <option value="Quarter_11_2023">Quarter_11_2023</option>
                                        <option value="Quarter_12_2023">Quarter_12_2023</option>
                                        <option value="Quarter_13_2024">Quarter_13_2024</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Activity</label>
                                    <select name="activity" class="form-control" style="width: 100%;" id="quater"
                                        required>
                                        <option style="display:none" value="">Select Activity</option>
                                        <option value="Entry_FGD">Entry_FGD</option>
                                        <option value="Exit_FGD">Exit_FGD</option>
                                        <option value="KII">KII</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> </label>
                                    <input name="submit" type="submit" class="form-control btn btn-info" value="Count">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- SELECT2 EXAMPLE -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">FGD & KII Counts</h3>

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
                                    <th>Activity</th>
                                    <th>Counts</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @if (session()->has('qtr_records'))
                                    @foreach (session()->get('qtr_records') as $data)
                                        @php
                                            $count++;
                                                                                       
                                        @endphp
                                        <tr>
                                            <td></td>
                                            <td>{{ $count }}</td>
                                            <td>{{ $data['state_name'] ?? session('state') }}</td>
                                            <td>{{ $data['quarter'] ?? '' }}</td>
                                            <td>{{ session('activity') ?? '' }}</td>
                                            <td>{{ $data['count'] }}</td>
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

                <div class="card-body">
                    <form role="form" action="{{ route('otherreports_yearly.search') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state" class="form-control" style="width: 100%;" id="state" required>
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


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select name="year" class="form-control" style="width: 100%;" id="quater" required>
                                        <option style="display:none" value="">Select Year</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Activity</label>
                                    <select name="activity" class="form-control" style="width: 100%;" id="quater"
                                        required>
                                        <option style="display:none" value="">Select Activity</option>
                                        <option value="Entry_FGD">Entry_FGD</option>
                                        <option value="Exit_FGD">Exit_FGD</option>
                                        <option value="KII">KII</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
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
                        <h3 class="card-title">FGD & KII Counts</h3>

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
                                    <th>Year</th>
                                    <th>Activity</th>
                                    <th>Counts</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session()->has('fgd_year_data'))
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach (session()->get('fgd_year_data') as $data)
                                        @php
                                            $count++;
                                        @endphp
                                        <tr>
                                            <td></td>
                                            <td>{{ $count }}</td>
                                            <td>{{ $data['state_name'] ?? session('state') }}</td>
                                            <td>{{ $data['year'] ?? '' }}</td>
                                            <td>{{ session('activity') ?? '' }}</td>
                                            <td>{{ $data['count'] }}</td>
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
    <script src="/dist/js/cei_analysis.js"></script>
@endsection
