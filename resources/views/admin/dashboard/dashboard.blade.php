@extends('admin.index')
@section('content')
<div class="row">
    <!-- Content Column -->
    <div class="col-md-4 mb-4">
              <div class="card shadow mb-4">
                  <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Upload .csv</h6>
                  </div>
                  <div class="card-body">
                        <form class="form" id="form_data">
                            @csrf
                            <input type="hidden" name="update_id">
                            <div class="form-group">
                                <input type="file" class="form-control" name="input_file" id="input_file" >
                                <div id="input_file_invalid" class="invalid-feedback"></div>
                            </div>
                            <div class="form-group text-right">
                                <a href="{{ route('sample_file_download') }}" id="sample" class="btn btn-success">Sample Download</a>
                                <button type="submit" id="save" class="btn btn-primary ">Submit</button>
                            </div>
                            
                        </form>
                        <hr>
                        <ul class="list-group" id="report" style="visibility: hidden;">
                            <li class="list-group-item d-flex justify-content-between align-items-center  list-group-item-primary">
                                total_data
                                <span class="badge badge-primary badge-pill" id="total_data"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-success">
                                total_successful_uploaded
                                <span class="badge badge-success badge-pill" id="total_successful_uploaded"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-info">
                                total_duplicate
                                <span class="badge badge-info badge-pill" id="total_duplicate"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-warning">
                                total_incomplete
                                <span class="badge badge-warning badge-pill" id="total_incomplete"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-danger">
                                total_invalid
                                <span class="badge badge-danger badge-pill" id="total_invalid"></span>
                            </li>
                        </ul>
                  </div>
              </div>
          </div>

          <div class="col-md-8 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data list</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm table-bordered" id="datatable">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">NAME</th>
                          <th scope="col">EMAIL</th>
                          <th scope="col">PHONE</th>
                          <th scope="col">GENDER</th>
                          <th scope="col">ADDRESS</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                </div>
            </div>
          </div>
</div>





@endsection
@section('script')
<script>
    
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        searchable: true,
        bDestroy: true,
        scrollX: true,
        ajax: "{{ route('data_datatable') }}",
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'phone_number' },     
            { data: 'gender' },     
            { data: 'address' }     
                     
        ],
    });

    ajax_form_submit('form_data', "{{ route('data_form_submit') }}");

    

    </script>
@endsection