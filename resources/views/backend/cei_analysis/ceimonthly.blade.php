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
                    <form role="form" action="{{ route('cei_monthly.search') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
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
                                    <label>Month</label>
                                    <select name="month" class="form-control select2 dynamic" style="width: 100%;"
                                        id="state_id" required>
                                        <option style="display:none" value="">Selct Month</option>
                                        <option value="all_months">All Time</option>
                                        @forelse ($months as $month)
                                            <option value="{{ $month }}">{{ $month }}</option>
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
                                        @forelse ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @empty
                                            <p>No data found</p>
                                        @endforelse
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
                                            <td>{{ $data['state_name'] ?? session('state')}}</td>
                                            <td>{{ session('month') ?? 'no data found' }}</td>
                                            <td>{{ session('year') ?? '' }}</td>
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
                    <form role="form" action="{{ route('kobocei_monthly.search') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
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


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Month</label>
                                    <select name="month" class="form-control" style="width: 100%;" id="quater" required>
                                        <option style="display:none" value="">Select Month</option>
                                        <option value="all_months">All Months</option>
                                        @forelse ($cei_months as $month)
                                            <option value="{{ $month['month_num'] }}"> {{ $month['month_name'] }}
                                            </option>
                                        @empty
                                            <p>No data found</p>
                                        @endforelse
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
                                    <th>Month</th>
                                    <th>Number of CEIs</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>{{ session('cei_id') ?? '' }}</td>
                                    <td>{{ session('cei_state') ?? '' }}</td>
                                    <td>{{ session('cei_month') ?? '' }}</td>
                                    <td>{{ session('cei_record_count') ?? '' }}</td>
                                </tr>
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
