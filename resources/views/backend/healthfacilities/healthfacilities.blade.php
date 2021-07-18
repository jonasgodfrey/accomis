@extends('layouts.app')

@section('content')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Health Facilities</h1>  
        
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
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
{{-- Flash message end --}}
<!-- SELECT2 EXAMPLE -->
<form method="POST" action="/healthfacility/excel" id="form1">
    @csrf
    <input type="button" class="input btn btn-primary" onclick="$('#form1').submit();" value="parse excel">
</form>
<br>
<br>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Add Health Facility</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                    class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                    class="fas fa-times"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <form action="/healthfacilities" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control select2 dynamic" name="state" style="width: 100%;"
                            id="state_id">
                            <option style="display: none" value="">Select State</option>
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
                        <select class="form-control select2 dynamic2" name="lga" style="width: 100%;"
                            id="lga">
                            <option style="display: none" selected="selected">Select LGA</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Ward</label>
                        <select class="form-control select2" name="ward" style="width: 100%;" id="ward">
                            <option style="display: none" selected="selected">Select Ward</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Facility:</label>
                        <input class="form-control" name="facility" placeholder="">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>CBO</label>
                        <select class="form-control select2 dynamic4" name="cbo_name" style="width: 100%;"
                            id="cbo1">
                            <option style="display: none" value="">select CBO</option>
                        </select>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>CBO Email</label>
                        <input type="email" name="cbo_email" class="form-control" id="cbo_email"
                            placeholder="" readonly>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>SPO</label>
                        <input type="text" name="spo_name" class="form-control" id="spo_name" placeholder=""
                            readonly>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>SPO Email</label>
                        <input type="email" name="spo_email" class="form-control" id="spo_email"
                            placeholder="" readonly>

                    </div>
                </div>

            </div>


            <button class="btn btn-primary">Add Health Facility</button>
            <!-- /.row -->
        </form>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <!-- Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
        the plugin. -->
    </div>
</div>
<!-- /.card -->



<!-- SELECT2 EXAMPLE -->
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Health Facilities</h3>

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
                    <th>Health Facility</th>
                    <th>Attached CBO</th>
                    <th>LGA</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>
            </thead>
<tbody>
    @if (count($health_facilities) > 0)

        @foreach ($health_facilities as $health_facility)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $health_facility->Facility }}</td>
                <td>{{ $health_facility->CBO }}</td>
                <td>{{ $health_facility->LGA }}</td>
                <td>{{ $health_facility->State }}</td>
                <td><a href="#" data-toggle="modal" data-target="{{ '#Modal' . $health_facility->id }}" ><i
                            class="fa fa-eye"></i></a>

                    <div class="modal fade" id="{{ 'Modal' . $health_facility->id }}" tabindex="-1"
                        role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel">Health Facility view
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
                                                <dt class="col-sm-4">State</dt>
                                                <dd class="col-sm-8">{{ $health_facility->State }}.
                                                </dd>
                                                <dt class="col-sm-4">Lga:</dt>
                                                <dd class="col-sm-8">{{ $health_facility->LGA }}.
                                                </dd>
                                                <dt class="col-sm-4">Ward Name:</dt>
                                                <dd class="col-sm-8">{{ $health_facility->Ward }}.
                                                </dd>
                                                <dt class="col-sm-4">Facility Name:</dt>
                                                <dd class="col-sm-8">{{ $health_facility->Facility }}.
                                                </dd>
                                                <dt class="col-sm-4">Cbo Name:</dt>
                                                <dd class="col-sm-8">{{ $health_facility->CBO }}.
                                                </dd>
                                                <dt class="col-sm-4">Cbo Email:</dt>
                                                <dd class="col-sm-8">{{ $health_facility->CBO_Email }}.
                                                </dd>
                                                <dt class="col-sm-4">Spo Name:</dt>
                                                <dd class="col-sm-8">{{ $health_facility->SPO }}.
                                                </dd>
                                                <dt class="col-sm-4">Spo Email:</dt>
                                                <dd class="col-sm-8">{{ $health_facility->SPO_Email }}.
                                                </dd>
                                                <dt class="col-sm-4">Status of Facility:</dt>
                                                <dd class="col-sm-8">{{ $health_facility->status }}.
                                                </dd>
                                                <dt class="col-sm-4">Date of addition:</dt>
                                                <dd class="col-sm-8">{{ $health_facility->day."/".$health_facility->month."/".$health_facility->year }}.
                                                </dd>

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
        <th>Health Facility</th>
        <th>LGA</th>
        <th>CBO</th>
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
@section('js')
<script src="dist/js/healthfacility.js"></script>
<script>
$(document).ready(function() {
$('#example1').DataTable();
});

</script>
@endsection
