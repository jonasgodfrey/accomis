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
                    <h1>CBO Monthly Report</h1>
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
                  <h3 class="card-title">CBO Monthly Report</h3>
      
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                @foreach($cbo_monthly as $cbo_monthly)
                
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">State</dt>
                        <dd class="col-sm-8">{{ $cbo_monthly->state }}.
                        </dd>
                        <dt class="col-sm-4">Lga:</dt>
                        <dd class="col-sm-8">{{ $cbo_monthly->lga }}.
                        </dd>
                        <dt class="col-sm-4">CBO Name:</dt>
                        <dd class="col-sm-8">{{ $cbo_monthly->cbo_name }}.
                        </dd>
                      
                        <dt class="col-sm-4">Quarter:</dt>
                        <dd class="col-sm-8">{{ $cbo_monthly->quarter }}.
                        </dd>


                        <dt class="col-sm-4">Date of Submission:</dt>
                        <dd class="col-sm-8">{{ $cbo_monthly->created_at }}.
                        </dd>

                        <dt class="col-sm-4">Date of Meeting:</dt>
                        <dd class="col-sm-8">{{ $cbo_monthly->date_of_meeting }}.
                        </dd>

                        <dt class="col-sm-4">Attached Report:</dt>
                        <dd class="col-sm-8"><a href="{{ url('storage/attachments/'.$cbo_monthly->attachment)}}" target="_blank"><i class="fa fa-file-download fa-3x"></i></a>
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
    <!-- /.content -->
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