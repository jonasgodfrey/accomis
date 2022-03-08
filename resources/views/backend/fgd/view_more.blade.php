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
                        <h1>FGD Report</h1>
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

                <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Report</h3>
          
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    @foreach($fgd as $fgd)
                    
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">State</dt>
                            <dd class="col-sm-8">{{ $fgd->state }}.
                            </dd>
                            <dt class="col-sm-4">Lga:</dt>
                            <dd class="col-sm-8">{{ $fgd->lga }}.
                            </dd>
                            <dt class="col-sm-4">CBO Name:</dt>
                            <dd class="col-sm-8">{{ $fgd->cbo_name }}.
                            </dd>
                            <dt class="col-sm-4">Activity:</dt>
                            <dd class="col-sm-8">{{ $fgd->activity }}.</dd>


                            <dt class="col-sm-4">Date of Submission:</dt>
                            <dd class="col-sm-8">{{ $fgd->created_at }}.
                            </dd>
                            <br>
                            <dt class="col-sm-4">Status:</dt>
                            <dd class="col-sm-8"><a class="btn btn-success">Approved</a>
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
@endsection