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
                <form role="form" action="{{ route('kobo_analysis.table') }}" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>State</label>



                                <select name="state" class="form-control select2 dynamic" style="width: 100%;"
                                    id="state_id" required>
                                    <option style="display:none" value="">Select State</option>

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
                                    <option value="q6">Quarter 6 2022</option>
                                    <option value="q7">Quarter 7 2022</option>
                                    <option value="q8">Quarter 8 2022</option>
                                    <option value="q9">Quarter 9 2023</option>
                                    <option value="q10">Quarter 10 2023</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label> </label>
                                <input name="submit" type="submit" class="form-control btn btn-warning" value="Submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- SELECT2 EXAMPLE -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Kobo Cei Analysis Reports</h3>

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

                        {{-- @foreach ($ceis as $kobo)

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
                                        <td>{{ $client->today }}.</td>
                                        <td>{{ $client->hf }}</td>
                                        <td>{{ $client->resp_name }}</td>
                                        <td>{{ $client->cbo }}</td>
                                        <td>{{ $client->state }}</td>
                                        <td>{{ $client->qtr }}</td>
                                        <td><a href="#" data-toggle="modal" data-target="{{ '#Modal' . $client->_id }}"><i class="fa fa-eye"></i></a>

                                            <div class="modal fade" id="{{ 'Modal' . $client->_id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ModalLabel">CEI KoboCollect
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">
                                                                        <i class="fas fa-text-width"></i>

                                                                    </h3>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">
                                                                    <dl class="row">
                                                                        <dt class="col-sm-4">CBO Email</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{$client->cboemail}}.
                                                                        </dd>
                                                                        <dt class="col-sm-4">Respondant Name</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{$client->resp_name}}.
                                                                        </dd>
                                                                        <dt class="col-sm-4">Respondant Category:
                                                                        </dt>
                                                                        <dd class="col-sm-8">
                                                                            {{$client->resp_cat}}.
                                                                        </dd>
                                                                        <dt class="col-sm-4">Service:
                                                                        </dt>
                                                                        <dd class="col-sm-8">
                                                                            {{$client->service_cat}}.
                                                                        </dd>
                                                                        <dt class="col-sm-4">Service Received:</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ $client->serv_received}}
                                                                        </dd>
                                                                        <dt class="col-sm-4">Did you get LLIN:</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ $client->llin_recipient}}
                                                                        </dd>
                                                                        <dt class="col-sm-4">Did You Receive IPT:</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ $client->ipt_recipient}}
                                                                        </dd>
                                                                        <dt class="col-sm-4">Tested fo Malaria?:</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ $client->malaria}}
                                                                        </dd>
                                                                        {{-- <dt class="col-sm-4">Result:</dt>
                                                                                <dd class="col-sm-8">
                                                                                    {{ $client->What_was_the_result}}
                                                                        </dd> --}}
                                                                        {{-- <dt class="col-sm-4">When Were you Tested?:</dt>
                                                                                <dd class="col-sm-8">
                                                                                    {{ $client->tested_when}}
                                                                        </dd> --}}
                                                                        <dt class="col-sm-4">Given ACT?:</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ $client->act_recipient}}
                                                                        </dd>

                                                                        {{-- <dt class="col-sm-4">Finish the Drug?:</dt>
                                                                                <dd class="col-sm-8">
                                                                                    {{ $client->act_finish}}
                                                                        </dd> --}}

                                                                        <dt class="col-sm-4">Rate the Facility?:</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ $client->rating}}
                                                                        </dd>

                                                                        <dt class="col-sm-4">Start Date:</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ $client->start}}
                                                                        </dd>

                                                                        <dt class="col-sm-4">End Date:</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ $client->end}}
                                                                        </dd>

                                                                        <dt class="col-sm-4">Date Submitted:</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ $client->today}}
                                                                        </dd>

                                                                        <dt class="col-sm-4">Location (Long/Lat):</dt>
                                                                        <dd class="col-sm-8">
                                                                            {{ $client->store_gps}}
                                                                        </dd>

                                                                        {{-- <dt class="col-sm-4">Rate the Facility?:</dt>
                                                                        <dd class="col-sm-8">
                                                                            @foreach ($client->_attachments as $item)
                                                                            <a href="{{$item->download_url}}" target="_blank">evidence</a>

                                                                            @endforeach

                                                                        </dd> --}}



                                                                    </dl>
                                                                </div>
                                                                <!-- /.card-body -->
                                                            </div>
                                                            <!-- /.card -->

                                                            <div class="modal-footer">
                                                                <p>
                                                                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
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
    <script src="/dist/js/kobo_analysis.js"></script>
@endsection
