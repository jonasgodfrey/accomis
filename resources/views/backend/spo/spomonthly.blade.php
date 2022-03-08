@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <p class="page_name" style="display: none">/spo_monthly/delete</p>

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
          <h1>SPO Monthly Reports</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">SPO Report Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- SELECT2 EXAMPLE -->

      @can('spo_role')
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">SPO Monthly Report</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- /.card-header -->
        <form role="form" action="{{ route('spo.add_monthly') }}" enctype="multipart/form-data" method="POST">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>State</label>

                  <input type="text" name="state" class="form-control select2" style="width: 100%;" id="state" value="{{$states}}" readonly>


                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group" id="quarter">
                  <label>Select Quarter</label>
                  <select class="form-control quarter select2" style="width: 100%;" name="quarter">
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

              <div class="col-md-6">
                <div class="form-group">
                  <label>Date</label>
                  <input type="date" name="meeting_date" class="form-control" placeholder="">

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputFile">Attach Signed Copy</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="attachment">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div>
                  </div>
                </div>
              </div>


            </div>
            <label>Enter Reports (optional)</label>
            <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px;
            font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="minutes"></textarea>



            <button class="btn btn-primary">Submit Report</button>
            <!-- /.row -->

          </div>
        </form>
        <!-- /.card-body -->
        <div class="card-footer">
          <!-- Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin. -->
        </div>
      </div>
      <!-- /.card -->
    </div>
    @endcan
    <!-- SELECT2 EXAMPLE -->
    @can('admin_spo_me')
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Monthly Reports</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      <button type="submit" class="btn btn-danger" id="bulk-delete" style="display:none; float:right">Delete 😳</button>

        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
            @can("admin_spo_me")
                  <th><input type="checkbox" id="selectall" class="checked"/></th>
                 @endcan
              <th>id</th>
              <th>Date</th>
              <th>State</th>
              <th>Quarter</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            @if (count($spos)>0)
            @foreach ($spos as $spo)
            <tr>
            @can("admin_spo_me")
                    <td><input type="checkbox" name="ids" class="checkBoxClass check-all" value="{{$spo->id}}"  /></td>
                    @endcan
              <td>{{ $loop->iteration }}</td>
              <td>{{ $spo->date_of_meeting }}</td>

              <td>{{ $spo->state }}</td>
              <td>{{ $spo->quarter }}</td>
              <td>
                <div class="row">
                  <div class="col-md-6">

                    <a href="{{ '/spo_monthly/view_more/'.$spo->id }}"><i class="fa fa-eye"></i></a>


                  </div>
                  <!--modal begin-->
                  @can("admin_role")

                  <div class="col-md-6">
                    <button class="fa fa-trash btn-sm btn-danger " style="outline: none" data-toggle="modal" data-target="{{'#exampleModal'. $spo->id}}"></button>


                    {{-- <div class="modal fade" id="{{'exampleModal' . $spo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure??</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Delete spo monthly report of {{$spo->name}}.
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="{{'/spo_monthly/delete/'. $spo->id}}" method="post">
                              @method('post')
                              @csrf
                              <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                  </div>
                  @endcan
                </div>


                {{-- <div class="modal fade" id="{{ 'Modal' . $spo->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">SPO Monthly Report
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                              <dd class="col-sm-8">{{ $spo->state }}.
                              </dd>

                              <dt class="col-sm-4">Spo Name:</dt>
                              <dd class="col-sm-8">{{ $spo->name }}.
                              </dd>
                              <!-- <dt class="col-sm-4">Report:</dt>
                                          <dd class="col-sm-8">
                                            {!! $spo->minutes_of_meeting !!}
 

                              <dt class="col-sm-4">Attached Report:</dt>
                              <dd class="col-sm-8"><a href="{{ url('storage/attachments/'.$spo->attachment)}}" target="_blank"><i class="fa fa-file-download"></i></a>
                              </dd>
                              <!-- <dt class="col-sm-4"></dt>
                                          <dd class="col-sm-8"> <embed
                                            src="{{ url('storage/attachments/'.$spo->attachment)}}"
                                            style="width:400px; height:300px;"
                                            frameborder="0"></a>
                                          </dd> -->

                              <dt class="col-sm-4">Date of Submission:</dt>
                              <dd class="col-sm-8">{{ $spo->created_at }}.
                              </dd>
                              <br>
                              <dt class="col-sm-4">State:</dt>
                              <dd class="col-sm-8">{{ $spo->state }}.</dd>

                            </dl>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="modal-footer">
                          <p>
                            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> --}}
              </td>

            </tr>
            @endforeach
            @endif
          <tfoot>
            <tr>
            @can("admin_spo_me")
                  <th><input type="checkbox" id="selectall" class="checked"/></th>
                 @endcan
              <th>id</th>
              <th>Meeting Date</th>
              <th>State</th>
              <th>Quarter</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
      @endcan

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