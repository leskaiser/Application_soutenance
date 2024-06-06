@extends('layouts.template')

@section('content')
  <!-- Page Header -->
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="page-title">{{__("Settings")}}</h3>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">{{__("Dashboard")}}</a></li>
          <li class="breadcrumb-item active">{{__("Add Services")}}</li>
        </ul>
      </div>
      <div class="col-auto float-right ml-auto">
        <button href="#" class="btn add-btn" id="addServices"><i class="fa fa-plus"></i> {{__("Add New Services")}}</button>
      </div>
    </div>
  </div>
  <!-- /Page Header -->

  <!-- Add Goal Modal -->
    <div id="addServicesModal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{__("Add New Services")}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              @csrf
              <input type="hidden" id="id" value="0" autocomplete="false">
              <div class="form-group">
                <label>Services Name <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="name" required>
              </div>
              <div class="form-group">
                <label>Description </label>
                <textarea class="form-control" rows="4" id="desc" required></textarea>
              </div>
              <div class="form-group">
                <label class="col-form-label">Status</label>
                <select class="select" id="status" required>
                  <option disabled>Select a status</option>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                  <option value="Delete">Delete</option>
                </select>
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn" id="saveService">{{__("Save")}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  <!-- /Add Goal Modal -->

  <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped custom-table mb-0" id="datatable">
            <thead>
              <tr>
                <th style="width: 30px;">#</th>
                <th>Code </th>
                <th>Service Name </th>
                <th>Description </th>
                <th>Status </th>
                <th style="width: 20px;">Action</th>
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

@section('scripts')
  <script>
    $(()=>{

      let table = $('#datatable').DataTable({
        lengthMenu:[[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
        scrollCollapse: true,
        processing: true,
        "order": [[ 1, "asc" ]],
        "columnDefs": [{
          "targets": 3,
          "render": function(data, type, row) {
            if (data.length > 25) {
              return data.substring(0, 25) + '...';
            } else {
              return data;
            }
          }
        }],
        "pageLength": 10,
        locale:"{{config('app.locale')}}",
        serverSide: true,
        ajax:{
            "url": serviceBase + "admin/user/get-list-services",
            "dataType": "json",
            "type": "POST",
            "data":{ 
                _token: csrfToken,
            }
        },
        columns: [
            { "data": "count", "orderable": false },
            { "data": "code" },
            { "data": "name" },
            { "data": "desc" },
            { "data": "status", "searchable": false, "orderable": false },
            { "data": "options", "searchable": false, "orderable": false },
        ],
      });

      $('#addServices').click(function (e) { 
        e.preventDefault();
        $("#name, #desc, #status, #id").val('');
        $("#addServicesModal").modal({show:true, keyboard:true, backdrop:'static'});
      });
      
      $('#saveService').click(function (e) { 
        e.preventDefault();
        showLoader();
        name = $("#name").val();
        desc = $("#desc").val();
        status = $("#status").val();
        id = $("#id").val();

        $.ajax({
          type: "POST",
          url: serviceBase + "admin/user/save-services",
          data: {
            name:name,
            desc:desc,
            status:status,
            id:id,
          },
          headers: {'X-CSRF-Token':csrfToken},
          dataType: "JSON",
          success: function (data) {
            if(data.error == false){
              hideLoader();
              Swal.fire({title: 'Success !!!', text:data.messages,icon: 'success'});
              $('#addServicesModal').modal('hide');
              reload();
            }else{
              Swal.fire({title: 'Error !!!', text:JSON.stringify(data.messages),icon: 'error'});
              hideLoader();
            }
          },
          error:function(error){
            Swal.fire({title: 'Error !!!', text:  JSON.stringify(error),icon: 'error'});
            hideLoader();
          },
        });
      });

    });

    let reload = ()=>{
      $('#datatable').DataTable().ajax.reload();
    }

    let editService = (service)=>{
      $("#name").val(service.name);
      $("#desc").val(service.desc);
      $("#status").val(service.status);
      $("#id").val(service.id);

      $("#addServicesModal").modal({show:true, keyboard:true, backdrop:'static'});
    }

    let changeStatus = (idService, status) =>{
      showLoader();
      $.ajax({
        type: "POST",
        url: serviceBase + "admin/user/change-status-services",
        data: {
          serviceID:idService,
          status:status,
        },
        headers: {'X-CSRF-Token':csrfToken},
        dataType: "JSON",
        success: function (data) {
          if(data.error == false){
            hideLoader();
            Swal.fire({title: 'Success !!!', text:data.messages,icon: 'success'});
            reload();
          }else{
            Swal.fire({title: 'Error !!!', text:JSON.stringify(data.messages),icon: 'error'});
            hideLoader();
          }
        },
        error:function(error){
          Swal.fire({title: 'Error !!!', text:  JSON.stringify(error),icon: 'error'});
          hideLoader();

        }
      });
    };

    let deleteService = (idService) =>{
      console.log(idService);

      $.ajax({
        type: "POST",
        url: serviceBase + "admin/user/delete-services",
        data: {
          id:idService,
        },
        headers: {'X-CSRF-Token':csrfToken},
        dataType: "JSON",
        success: function (data) {
          if(data.error == false){
            hideLoader();
            reload();
            Swal.fire({title: 'Success !!!', text:data.messages,icon: 'success'});
          }else{
            hideLoader();
            Swal.fire({title: 'Error !!!', text:JSON.stringify(data.messages),icon: 'error'});
          }
        },
        error: function(error){
          hideLoader();
          Swal.fire({title: 'Error !!!', text:  JSON.stringify(error),icon: 'error'});
        },
      });
    };
  </script>
@endsection