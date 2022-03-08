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
                        <h1>Remedial Feedback</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">View More-</li>
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
                      <h3 class="card-title">Remedial Action Feedback Report</h3>
          
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    @foreach($remedial as $rem)
                    
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">CBO Email</dt>
                                        <dd class="col-sm-8">{{ $rem->cbo }}.
                                        </dd>
                                        <dt class="col-sm-4">CBO Name</dt>
                                        <dd class="col-sm-8">{{ $rem->cbo_name }}.
                                        </dd>
                                        <dt class="col-sm-4">State</dt>
                                        <dd class="col-sm-8">{{ $rem->state }}.
                                        </dd>
                                        <dt class="col-sm-4">Quarter</dt>
                                        <dd class="col-sm-8">{{ $rem->quarter }}.
                                        </dd>
                                        <dt class="col-sm-4">Issues Identified:</dt>
                                        <dd class="col-sm-8">{{ $rem->identified_issues }}.
                                        </dd>

                                        <dt class="col-sm-4">Root Causes:</dt>
                                        <dd class="col-sm-8">{{ $rem->root_cause }}.
                                        </dd>

                                        <dt class="col-sm-4">Action Taken:</dt>
                                        <dd class="col-sm-8">
                                        {{ $rem->action_taken_immediately}}
                                        </dd>

                                        <dt class="col-sm-4">Follow up Action:</dt>
                                        <dd class="col-sm-8">{{ $rem->follow_up_action }}.
                                        </dd>

                                        <dt class="col-sm-4">Tracker Type:</dt>
                                        <dd class="col-sm-8">{{ $rem->tracker_type }}.
                                        </dd>

                                        <dt class="col-sm-4">Status:</dt>
                                        <dd class="col-sm-8">
                                        {{ $rem->resolved}}
                                        </dd>

                                        <dt class="col-sm-4">Root Causes:</dt>
                                        <dd class="col-sm-8">
                                        {{ $rem->root_cause}}
                                        </dd>

                                        
                                        <dt class="col-sm-4">Date of Visit:</dt>
                                        <dd class="col-sm-8">{{ $rem->date_visit }}.
                                        </dd>

                                        <dt class="col-sm-4">Date of Submission:</dt>
                                        <dd class="col-sm-8">{{ $rem->created_at }}.
                                        </dd>

                                         <dt class="col-sm-4">Attachement:</dt>
                                        <dd class="col-sm-8"> <a
                                            href="{{ url('storage/remedial/'.$rem->signed_document)}}"
                                            target="_blank"><i class="fa fa-file-download fa-3x"></i></a>
                                          </dd> 

                                        <br>
    
                            
    
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