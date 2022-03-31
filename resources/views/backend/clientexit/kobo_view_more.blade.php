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
                    <h1>Client Exit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kobo Collect View More</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Client Exit Report</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                @foreach($clientexit as $kobo)

                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">CBO Email</dt>
                        <dd class="col-sm-8">
                            {{$kobo->cboemail}}.
                        </dd>
                        <dt class="col-sm-4">Respondant Name</dt>
                        <dd class="col-sm-8">
                            {{$kobo->resp_name}}.
                        </dd>
                        <dt class="col-sm-4">Child Name</dt>
                        <dd class="col-sm-8">
                            {{$kobo->child_name}}.
                        </dd>
                        <dt class="col-sm-4">Respondant Category:
                        </dt>
                        <dd class="col-sm-8">
                            {{$kobo->resp_cat}}.
                        </dd>
                        <dt class="col-sm-4">Service:
                        </dt>
                        <dd class="col-sm-8">
                            {{$kobo->service_cat}}.
                        </dd>
                        <dt class="col-sm-4">Service Received:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->serv_received}}
                        </dd>
                        <dt class="col-sm-4">Did you get LLIN:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->llin_recipient}}
                        </dd>
                        <dt class="col-sm-4">Did You Receive IPT:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->ipt_recipient}}
                        </dd>
                        <dt class="col-sm-4">Tested fo Malaria?:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->malaria}}
                        </dd>
                        <dt class="col-sm-4">Result:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->What_was_the_result}}
                        </dd>
                        <dt class="col-sm-4">When Were you Tested?:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->tested_when}}
                        </dd>
                        <dt class="col-sm-4">Given ACT?:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->act_recipient}}
                        </dd>

                        <dt class="col-sm-4">Finish the Drug?:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->act_finish}}
                        </dd>

                        <dt class="col-sm-4">Rate the Facility?:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->rating}}
                        </dd>

                        <dt class="col-sm-4">Why Dissatisfied?:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->dissatisfied}}
                        </dd>

                        <dt class="col-sm-4">Start Date:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->start}}
                        </dd>

                        <dt class="col-sm-4">End Date:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->end}}
                        </dd>

                        <dt class="col-sm-4">Date Submitted:</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->today}}
                        </dd>

                        <dt class="col-sm-4">Location (Long/Lat):</dt>
                        <dd class="col-sm-8">
                            {{ $kobo->store_gps}}
                        </dd>



                    </dl>
                </div>
                <!-- /.card-body -->
                @endforeach
                <div class='card-footer'>
                    <button class="btn btn-success print_window" style="float: right;">Print Page <i class="fa fa-print"></i></button>
                </div>

                <!-- /.card-body -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
@section('js')
<script src="dist/js/selectField.js"></script>
<script>
    $('.print_window').click(function() {
        window.print();
    });
</script>
@endsection