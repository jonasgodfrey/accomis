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
                        <h1>SPO Monthly</h1>
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
                      <h3 class="card-title">SPO Monthly Report</h3>
          
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    @foreach($spo as $spo)
                    
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">State</dt>
                            <dd class="col-sm-8">{{ $spo->state }} State
                            </dd>

                            <dt class="col-sm-4">Spo Name:</dt>
                            <dd class="col-sm-8">{{ $spo->name }}.
                            </dd>   
                            
                            <dt class="col-sm-4">Quarter:</dt>
                            <dd class="col-sm-8">{{ $spo->quarter }}.
                            </dd>  
                            
                            
                            <dt class="col-sm-4">Date of Submission:</dt>
                            <dd class="col-sm-8">{{ $spo->created_at }}.
                            </dd>
                            <br>
                            <dt class="col-sm-4">Attached Report:</dt>
                            <dd class="col-sm-8"><a href="{{ url('storage/attachments/'.$spo->attachment)}}" target="_blank"><i class="fa fa-file-download fa-3x"></i></a>
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