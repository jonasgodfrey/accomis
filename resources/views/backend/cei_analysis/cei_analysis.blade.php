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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>State</label>



                                    <select name="state" class="form-control select2 dynamic" style="width: 100%;"
                                        id="state_id" required>
                                        <option style="display:none" value="">Selct State</option>

                                        @if (count($state) != 0)
                                            @foreach ($state as $state)
                                                <option id="{{ $state->id }}" value="{{ $state->name }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        @endif

                                        @if (count($states) != 0)
                                            @foreach ($states as $state)
                                                <option id="{{ $state->id }}" value="{{ $state->name }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>


                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CBO</label>
                                    <select name="cbo" class="form-control" style="width: 100%;" id="cbo" disabled
                                        required>
                                        <option style="display:none" value="">Select state to view</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Quarter</label>
                                    <select name="quarter" class="form-control" style="width: 100%;" id="quater" required>
                                        <option style="display:none" value="">Select Quarter</option>
                                        <option value="Quarter_1_2021">Quarter 1 2021</option>
                                        <option value="Quarter_2_2021">Quarter 2 2021</option>
                                        <option value="Quarter_3_2021">Quarter 3 2021</option>
                                        <option value="Quarter_4_2021">Quarter 4 2021</option>
                                        <option value="Quarter_5_2022">Quarter 5 2022</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label> </label>
                                    <input name="submit" type="submit" class="form-control btn btn-success" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- SELECT2 EXAMPLE -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Client Exit Reports</h3>

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
                                    <th>Date</th>
                                    <th>Health Facility</th>
                                    <!-- <th>attachment</th> -->
                                    <th>Respondant</th>
                                    <th>CBO Name</th>
                                    <th>State</th>
                                    <th>Quarter</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($ceis) > 0)
                                    @foreach ($ceis as $client)
                                        <tr id="sid{{ $client->id }}">
                                            @can('admin_spo_me')
                                                <td><input type="checkbox" name="ids" class="checkBoxClass check-all"
                                                        value="{{ $client->id }}" /></td>
                                            @endcan
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $client->day }}.</td>
                                            <td>{{ $client->health_facility_of_interview }}</td>
                                            <!-- <td><a href="{{ url('storage/attachments/' . $client->attachment) }}" target="_blank"><i class="fa fa-file-download"></i></a></td> -->
                                            <td>{{ $client->respondant_name }}</td>
                                            <td>{{ $client->cbo_name }}</td>
                                            <td>{{ $client->state }}</td>
                                            <td>{{ $client->quarter }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="{{ '/clientexit/view_more/' . $client->id }}"><i
                                                                class="fa fa-eye"></i></a>

                                                    </div>

                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    @can('admin_spo_me')
                                        <th></th>
                                    @endcan
                                    <th>id</th>
                                    <th>Date</th>
                                    <th>Health Facility</th>
                                    <!-- <th>attachment</th> -->
                                    <th>Respondant</th>
                                    <th>CBO Name</th>
                                    <th>State</th>
                                    <th>Quarter</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
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
