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
                            <li class="breadcrumb-item active">View More</li>
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
                    @foreach($clientexit as $client)
                    
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">State</dt>
                            <dd class="col-sm-8">
                                {{ $client->state }}
                            </dd>
                            <dt class="col-sm-4">CBO Name</dt>
                            <dd class="col-sm-8">
                                {{ $client->cbo_name }}
                            </dd>
                            <dt class="col-sm-4">Quarter</dt>
                            <dd class="col-sm-8">
                                {{ $client->quarter }}
                            </dd>
                            <dt class="col-sm-4">Facility Name:</dt>
                            <dd class="col-sm-8">
                                {{ $client->health_facility_of_interview }}
                            </dd>
                            
                            <dt class="col-sm-4">Respondant Name</dt>
                            <dd class="col-sm-8">
                                {{ $client->respondant_name }}
                            </dd>
                            <dt class="col-sm-4">Respondant Occupation:
                            </dt>
                            <dd class="col-sm-8">
                                {{ $client->respondant_occupation }}
                            </dd>
                            <dt class="col-sm-4">Respondant Education:
                            </dt>
                            <dd class="col-sm-8">
                                {{ $client->respondant_education }}
                            </dd>
                            <dt class="col-sm-4">Category:</dt>
                            <dd class="col-sm-8">
                                {{ $client->respondant_category }}
                            </dd>
                            

                            <dt class="col-sm-4">Service Came For:</dt>
                            <dd class="col-sm-8">
                                {{ $client->purpose_of_comming }}
                            </dd>
                            <dt class="col-sm-4">Service Received:</dt>
                            <dd class="col-sm-8">
                                {{ $client->treatment_received }}
                            </dd>
                            <dt class="col-sm-4">Frequency of Visit:</dt>
                            <dd class="col-sm-8">
                                {{ $client->frequency_of_visit_3months }}
                            </dd>
                            <dt class="col-sm-4">Received LLIN:</dt>
                            <dd class="col-sm-8">
                                {{ $client->llin_reception }}
                            </dd>
                            <dt class="col-sm-4">Received IPT:</dt>
                            <dd class="col-sm-8">
                                {{ $client->ipt_reception }}
                            </dd>
                            <dt class="col-sm-4">Received SP?</dt>
                            <dd class="col-sm-8">
                                {{ $client->sulfadoxin_pyrimethamine_intake }}.
                            </dd>
                            <dt class="col-sm-4">Malaria Test?</dt>
                            <dd class="col-sm-8">
                                {{ $client->malaria_test }}
                            </dd>
                            
                            <dt class="col-sm-4">Service Rating:</dt>
                            <dd class="col-sm-8">
                                {{ $client->service_satisfaction_level }}.
                            </dd>
                            <dt class="col-sm-4">Attached Report:</dt>
                            <dd class="col-sm-8"><a href="{{ url('storage/attachments/'.$client->attachment)}}" target="_blank"><i class="fa fa-file-download fa-3x"></i></a>
                            </dd>
                            <!-- <dt class="col-sm-4"></dt>
                                            <dd class="col-sm-8"> <embed
                                                src="{{ url('storage/attachments/'.$client->attachment)}}"
                                                style="width:400px; height:300px;"
                                                frameborder="0"></a>
                                            </dd> -->
                            <dt class="col-sm-4">Date Submitted:</dt>
                            <dd class="col-sm-8">
                                {{ $client->day . '/' . $client->month . '/' . $client->year }}.
                            </dd>

                        </dl>
                    </div>
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
        $('.print_window').click(function(){
            window.print();
        });
    
    </script>
@endsection