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
        {{-- Flash message end--}}
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1>CBO Monthly Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">CBOs Page</li>
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
            <h3 class="card-title">CBO Monthly Report</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          @can('cbo_role')
        <form role="form" action="{{ route('cbo.add_monthly') }}" enctype="multipart/form-data" method="POST">
             @csrf
          <div class="card-body">
            <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                  <label>State</label>
                  <input type="text" name="state" class="form-control select2" style="width: 100%;" id="state" value={{$cbo_state}} readonly>

                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>L.G.A</label>
                  <input type="text" name="lga" class="form-control select2" style="width: 100%;" id="lga" value="{{$cbo_lga}}" readonly>


                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Community Based Organization</label>
                  <input type="text" name="cbo_name" class="form-control select2" style="width: 100%;" value="{{$cbo_name}}" readonly>

                </div>
              </div>

              <div class="col-md-4">
                                    <div class="form-group" id="quarter">
                                        <label>Select Quarter</label>
                                        <select class="form-control quarter select2" style="width: 100%;"
                                            name="quarter" required>
                                            <option value="">Select Quarter</option>
                                            <option value="Quarter_1_2021">Quarter 1 2021</option>
                                            <option value="Quarter_2_2021">Quarter 2 2021</option>
                                          <option value="Quarter_3_2021">Quarter 3 2021</option>
                                             <!-- <option value="Quarter_4_2021">Quarter 4 2021</option> -->
                                        </select>
                                    </div>
                        </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Date</label>
                  <input type="date" name="meeting_date" class="form-control" placeholder="" required>

                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputFile">Attach Signed Copy</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="attachment" id="exampleInputFile" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
              </div>


            </div>
            <label>Report</label>
            <textarea name="minutes" class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>



            <button type="submit" class="btn btn-primary">Submit Report</button>
            <!-- /.row -->

          </div>
          <!-- /.card-body -->
        </form>

        @endcan
          <div class="card-footer">

          </div>
      </div>
      @endcan
        <!-- /.card -->

        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">CBO Monthly Reports</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Date</th>
                  <th>Attached Report</th>
                  <th>CBO Name</th>
                  <th>State</th>
                  <th>Quarter</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if (count($cbos)>0)
                    @foreach ($cbos as $cbo)
                    <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cbo->date_of_meeting }}</td>
                    <td><a href="{{ url('storage/attachments/'.$cbo->attachment)}}" target="_blank"><i class="fa fa-file-download"></i></a></td>
                    <td>{{$cbo->cbo_name}}</td>
                    <td>{{$cbo->state}}</td>
                    <td>{{ $cbo->quarter }}</td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">

                                <a href="#" data-toggle="modal" data-target="{{ '#Modal' . $cbo->id }}" ><i
                                    class="fa fa-eye"></i></a>
                            </div>
                            <!--modal begin-->
                            @can("admin_spo_me")
                            <div class="col-md-6">
                                <button class="fa fa-trash btn-sm btn-danger " style="outline: none" data-toggle="modal" data-target="{{'#exampleModal'. $cbo->id}}"></button>


                                <div class="modal fade" id="{{'exampleModal' . $cbo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure??</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Delete cbo monthly report of  {{$cbo->cbo_name}}.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{'/cbo_monthly/delete/'. $cbo->id}}" method="post" >
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

                            <div class="modal fade" id="{{ 'Modal' . $cbo->id }}" tabindex="-1"
                        role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel">CBO Monthly Report
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
                                                <dd class="col-sm-8">{{ $cbo->state }}.
                                                </dd>
                                                <dt class="col-sm-4">Lga:</dt>
                                                <dd class="col-sm-8">{{ $cbo->lga }}.
                                                </dd>
                                                <dt class="col-sm-4">CBO Name:</dt>
                                                <dd class="col-sm-8">{{ $cbo->cbo_name }}.
                                                </dd>
                                                <!-- <dt class="col-sm-4">Report:</dt>
                                                <dd class="col-sm-8">
                                                <textarea name="minutes" class="textarea"
                                                placeholder="Place some text here"
                                                style="width: 100%; height: 200px; font-size: 14px;`
                                                line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                readonly>{{ $cbo->minutes_of_meeting}}</textarea>
                                                </dd> -->

                                                <dt class="col-sm-4">Attached Report:</dt>
                                                <dd class="col-sm-8"><a href="{{ url('storage/attachments/'.$cbo->attachment)}}" target="_blank"><i class="fa fa-file-download"></i></a>
                                                </dd>
                                                <!-- <dt class="col-sm-4"></dt>
                                                <dd class="col-sm-8"> <embed
                                                  src="{{ url('storage/attachments/'.$cbo->attachment)}}"
                                                  style="width:400px; height:300px;"
                                                  frameborder="0"></a>
                                                </dd> -->

                                                <dt class="col-sm-4">Date of Submission:</dt>
                                                <dd class="col-sm-8">{{ $cbo->created_at }}.
                                                </dd>
                                                <br>
                                                <dt class="col-sm-4">Status:</dt>
                                                <dd class="col-sm-8"><a class="btn btn-success">Approved</a>
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
                                        @can('admin_spo')
                                        <p>
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Delete</button>
                                        </p>
                                        @endcan
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
                      <th>Attached Report</th>
                      <th>CBO Name</th>
                      <th>State</th>
                      <th>Quarter</th>
                      <th>Action</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->

          </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>
@endsection
