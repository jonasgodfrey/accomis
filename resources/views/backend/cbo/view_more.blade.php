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
                    <h1>Community Based Organization</h1>
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

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-text-width"></i>

                    </h3>
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
                      

                        <dt class="col-sm-4">Attached Report:</dt>
                        <dd class="col-sm-8"><a href="{{ url('storage/attachments/'.$cbo_monthly->attachment)}}" target="_blank"><i class="fa fa-file-download"></i></a>
                        </dd> 

                        <dt class="col-sm-4">Date of Submission:</dt>
                        <dd class="col-sm-8">{{ $cbo_monthly->created_at }}.
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