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
                <h1>Remidial Feedback</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Remidial Feedback Page</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        @can('cbo_role')
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Remedial Feedback</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <form role="form" class="myform" action="{{route('add_remidial')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" name="state" class="form-control select2 dynamic" style="width: 100%;"
                                    id="state" data-dependent="lga" value="{{$cbo_state}}" readonly>
                                <!-- <select name="state" class="form-control select2 dynamic" style="width: 100%;"
                                    id="state" data-dependent="lga" required>
                                    <option selected="selected">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->name }}">{{ $state->name }}</option>
                                    @endforeach
                                </select> -->
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>LGA</label>
                                <input type="text" name="lga" class="form-control select2" style="width: 100%;" id="lga" value="{{$cbo_lga}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ward</label>
                                <select name="ward" class="form-control select2" style="width: 100%;"
                                    id="state_id" >
                                    <option style="display:none" value="">Select Ward</option>
                                    @foreach ($wards as $ward)
                                        <option id="{{ $ward->id }}" value="{{ $ward->ward_name }}">
                                            {{ $ward->ward_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date Visit</label>
                                <input type="date" name="date_visit" class="form-control" placeholder="" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                                    <div class="form-group" id="quarter">
                                        <label>Select Quarter</label>
                                        <select class="form-control quarter select2" style="width: 100%;"
                                            name="quarter" required>
                                            <option value="">Select Quarter</option>
                                            <option value="Quarter_1_2021">Quarter 1 2021</option>
                                            <option value="Quarter_2_2021">Quarter 2 2021</option>
                                            <option value="Quarter_3_2021">Quarter 3 2021</option>
                                            <!--<option value="Quarter_4_2021">Quarter 4 2021</option> -->
                                        </select>
                                    </div>
                        </div>

                        <div class="col-md-3">
                            <label>Activity</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="tracker_type"
                                        value="Focus Group Discussion" required>
                                    <label for="radioPrimary2">
                                        Entry FGD
                                    </label>

                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="icheck-success d-inline">
                                    <input type="radio" id="radiosuccess5" name="tracker_type" value="Exit FGD"
                                        required>
                                    <label for="radiosuccess5">
                                        Exit FGD
                                    </label>
                                </div>

                            </div>
                            <div class="form-group clearfix">
                                <div class="icheck-info d-inline">
                                    <input type="radio" id="radioinfo3" name="tracker_type" value="Client Exit"
                                        required>
                                    <label for="radioinfo3">
                                        Client Exit
                                    </label>
                                </div>

                            </div>
                            <div class="form-group clearfix">
                                <div class="icheck-secondary d-inline">
                                    <input type="radio" id="radiosecondary4" name="tracker_type" value="KII"
                                        required>
                                    <label for="radiosecondary4">
                                        Key Informants Interview
                                    </label>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

            <div class="form-group">
                <label>Key Findings/Identified Issues</label>

<div class="custom-control custom-checkbox">
    <input class="custom-control-input" name="key_findings[]" type="checkbox" id="customCheckbox1"
    value="Commodities Stockout">
    <label for="customCheckbox1" class="custom-control-label">Commodities Stockout</label>
</div>
<div class="custom-control custom-checkbox">
    <input class="custom-control-input" name="key_findings[]" type="checkbox" id="customCheckbox2"
    value="Poor Infrastructure">
    <label for="customCheckbox2" class="custom-control-label">Poor Infrastructure</label>
</div>
<div class="custom-control custom-checkbox">
    <input class="custom-control-input" name="key_findings[]" type="checkbox" id="customCheckbox3"
    value="Inadequate Manpower">
    <label for="customCheckbox3" class="custom-control-label">Inadequate Manpower</label>
</div>
<div class="custom-control custom-checkbox">
    <input class="custom-control-input" name="key_findings[]" type="checkbox" id="customCheckbox5"
    value="Low Patronage">
    <label for="customCheckbox5" class="custom-control-label">Low Patronage</label>
</div>
<div class="custom-control custom-checkbox">
    <input class="custom-control-input keyfindings_check"  type="checkbox" id="customCheckbox4" value="">
    <label for="customCheckbox4" class="custom-control-label">Others</label>
</div>
<div class="form-group">
    <input type="text" name="key_findings[]" class="form-control keyfindings_check_others" placeholder="" required>
</div>
            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Root Cause</label>
                                <input type="text" name="root_cause" class="form-control" placeholder="" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Action Taken Immediately</label>
                                <input type="text" name="taken_action" class="form-control" placeholder="" required>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Resolved</label>
                                <select name="resolved_value" id="" class="form-control" required>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Follow Up Action</label>
                                <input type="text" name="follow_action" class="form-control" placeholder=""
                                    required>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Responsibile Person</label>
                                <input type="text" name="responsibility" class="form-control" placeholder=""
                                    required>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Timeline</label>
                                <input type="date" name="timeline" class="form-control" placeholder="" required>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputFile">Attach Signed Copy</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile"
                                            name="signed_doc" required>
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary remedial" type="submit" name="remedial">Submit Remedial Report</button>
                    <!-- /.row -->

                </div>
                <!-- /.card-body -->
            </form>
            <div class="card-footer">
                <!-- Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                the plugin. -->
            </div>
        </div>
        <!-- /.card -->
        @endcan

        @can('admin_me')
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-success">


            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Remedial Feedbacks</h3>

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
                                <th>Date</th>
                                <th>Key Findings/Issues</th>
                                <th>CBO Name</th>
                                <th>State</th>
                                <th>Activity</th>
                                <th>Quarter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($rems) > 0)

                                @foreach ($rems as $rem)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rem->date_visit }}</td>
                                        <td>{{ $rem->identified_issues }}</td>
                                        <td>{{$rem->cbo_name}}</td>
                                        <td>{{ $rem->state }}</td>
                                        <td>{{ $rem->tracker_type }}</td>
                                        <td>{{ $rem->quarter }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <a href="#" data-toggle="modal" data-target="{{ '#Modal' . $rem->id }}" ><i
                                                        class="fa fa-eye"></i></a>
                                                </div>
                                                <!--modal begin-->
                                            @can("admin_me")

                                                <div class="col-md-6">
                                                    <button class="fas fa-trash btn-sm btn-danger " data-toggle="modal" data-target="{{'#exampleModal'. $rem->id}}"></button>

                                            
                                                    <div class="modal fade" id="{{'exampleModal' . $rem->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure??</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Delete remidial report of  {{$rem->cbo_name}}.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <form action="{{'/remidialfeedback/delete/'. $rem->id}}" method="post" >
                                                                        @method('post')
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endcan
                                            </div>


                    <div class="modal fade" id="{{ 'Modal' . $rem->id }}" tabindex="-1"
                role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Remedial Action Feedback
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
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
                                        <dt class="col-sm-4">CBO Email:</dt>
                                        <dd class="col-sm-8">{{ $rem->cbo }}.
                                        </dd>
                                        <dt class="col-sm-4">State:</dt>
                                        <dd class="col-sm-8">{{ $rem->state }}.
                                        </dd>
                                        <dt class="col-sm-4">Ward:</dt>
                                        <dd class="col-sm-8">{{ $rem->ward }}.
                                        </dd>
                                        <dt class="col-sm-4">Issues Identified:</dt>
                                        <dd class="col-sm-8">{{ $rem->identified_issues }}.
                                        </dd>

                                        <dt class="col-sm-4">Action Taken:</dt>
                                        <dd class="col-sm-8">
                                        {{ $rem->action_taken_immediately }}
                                        </dd>

                                        <dt class="col-sm-4">Resolved?:</dt>
                                        <dd class="col-sm-8">
                                        {{ $rem->resolved}}
                                        </dd>

                                        <dt class="col-sm-4">Root Causes:</dt>
                                        <dd class="col-sm-8">
                                        {{ $rem->root_cause}}
                                        </dd>

                                        <dt class="col-sm-4">Attached Report:</dt>
                                                <dd class="col-sm-8"><a href="{{ url('storage/remedial/'.$rem->signed_document)}}"
                                                target="_blank"><i class="fa fa-file-download"></i></a>
                                                </dd>

                                        <!-- <dt class="col-sm-4">Attached Report:</dt>
                                        <dd class="col-sm-8"> <embed
                                            src="{{ url('storage/remedial/'.$rem->signed_document)}}"
                                            style="width:400px; height:300px;"
                                            frameborder="0"></a>
                                        </dd> -->

                                        <dt class="col-sm-4">Date of Visit:</dt>
                                        <dd class="col-sm-8">{{ $rem->date_visit }}.
                                        </dd>
                                        <br>


                                    </dl>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <div class="modal-footer">
                                <p>
                                    <button type="button" class="btn btn-info"
                                        data-dismiss="modal">Close</button>
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

                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Date</th>
                                <th>Attachment</th>
                                <th>CBO Name</th>
                                <th>State</th>
                                <th>Activity</th>
                                <th>Quater</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>


        </div><!-- /.container-fluid -->
        @endcan

        @can('spo_cbo')

        <div class="card card-success">


            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">CBO Remedial Feedback View</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Date</th>
                                <th>Attachment</th>
                                <th>CBO Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($rems) > 0)

                                @foreach ($rems as $rem)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rem->date_visit }}</td>
                                        <td><a href="{{ url('storage/remedial/'.$rem->signed_document)}}" target="_blank"><i class="fa fa-file-download"></i></a></td>
                                        <td>{{ $rem->cbo_name }}</td>


                                        <td><a href="#" data-toggle="modal" data-target="{{ '#Modal' . $rem->id }}" ><i
                    class="fa fa-eye"></i></a>

                    <div class="modal fade" id="{{ 'Modal' . $rem->id }}" tabindex="-1"
                role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Remedial Action Feedback
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
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
                                        <dd class="col-sm-8">{{ $rem->cbo }}.
                                        </dd>
                                        <dt class="col-sm-4">CBO Name</dt>
                                        <dd class="col-sm-8">{{ $rem->cbo_name }}.
                                        </dd>
                                        <dt class="col-sm-4">Issues Identified:</dt>
                                        <dd class="col-sm-8">{{ $rem->identified_issues }}.
                                        </dd>

                                        <dt class="col-sm-4">Action Taken:</dt>
                                        <dd class="col-sm-8">
                                        {{ $rem->action_taken_immediately}}
                                        </dd>

                                        <dt class="col-sm-4">Resolved?:</dt>
                                        <dd class="col-sm-8">
                                        {{ $rem->resolved}}
                                        </dd>

                                        <dt class="col-sm-4">Root Causes:</dt>
                                        <dd class="col-sm-8">
                                        {{ $rem->root_cause}}
                                        </dd>

                                        <!-- <dt class="col-sm-4">Attached Report:</dt>
                                        <dd class="col-sm-8"> <embed
                                            src="{{ url('storage/remedial/'.$rem->signed_document)}}"
                                            style="width:400px; height:300px;"
                                            frameborder="0"></a>
                                          </dd> -->

                                        <dt class="col-sm-4">Date of Visit:</dt>
                                        <dd class="col-sm-8">{{ $rem->date_visit }}.
                                        </dd>
                                        <br>


                                    </dl>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <div class="modal-footer">
                                <p>
                                    <button type="button" class="btn btn-info"
                                        data-dismiss="modal">Close</button>
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

                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Date</th>
                                <th>Attachment</th>
                                <th>CBO Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>


        </div>
        @endcan
</section>
<!-- /.content -->
</div>
@endsection
@section('js');
<script src="dist/js/datatables/datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('#example2').DataTable();
        });

    </script>
<script>
$(document).ready(function() {
   $('.remedial').click(function(){
    $('.myform').submit();
   });
});
</script>
<script src="dist/js/remedial.js"></script>
@endsection
