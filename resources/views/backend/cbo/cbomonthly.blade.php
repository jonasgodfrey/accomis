@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
            {{-- Flash message --}}
                <div id="alert">
                @include('partials.flash')
                @include('partials.modal')

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
                                             <option value="Quarter_4_2021">Quarter 4 2021</option>
                                             <option value="Quarter_5_2022">Quarter 5 2022</option>
                                             <option value="Quarter_6_2022">Quarter 6 2022</option>
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

        <p class="page_name" style="display: none;">/cbo_monthly/delete</p>

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
            <button type="submit" class="btn btn-danger" id="bulk-delete" style="display:none; float:right">Delete</button>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                @can("admin_spo_me")
                  <th><input type="checkbox" id="selectall" class="checked"/></th>
                 @endcan 
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
                    <tr id="sid{{$cbo->id}}">
                    @can("admin_spo_me")
                    <td><input type="checkbox" name="ids" class="checkBoxClass check-all" value="{{$cbo->id}}"  /></td>
                    @endcan
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cbo->date_of_meeting }}</td>
                    <td><a href="{{ url('/storage/attachments/'.$cbo->attachment)}}" target="_blank"><i class="fa fa-file-download"></i></a></td>
                    <td>{{$cbo->cbo_name}}</td>
                    <td>{{$cbo->state}}</td>
                    <td>{{ $cbo->quarter }}</td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">

                                <a href="{{ '/cbo_monthly/view_more/'.$cbo->id }}" ><i
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

                    </td>
                    </tr>
              @endforeach
              @endif
              <tfoot>
                  <tr>
                  @can("admin_spo_me")
                    <th></th>
                    @endcan
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
