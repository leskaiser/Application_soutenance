@extends('layouts.template')
@section('title', __('Employees'))

@section('css')
  <!-- Datetimepicker CSS -->
  <link rel="stylesheet" href="{{asset("assets/css/bootstrap-datetimepicker.min.css")}}">
@endsection

@section('content')
  <!-- Page Header -->
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="page-title">Employee</h3>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active">Employee</li>
        </ul>
      </div>
      <div class="col-auto float-right ml-auto">
        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
        <div class="view-icons">
          <a href="{{route('employeesCardList')}}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
          <a href="{{route('employeesList')}}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
        </div>
      </div>
    </div>
  </div>
  <!-- /Page Header -->

  <!-- Search Filter -->
  <div class="row filter-row">
    <div class="col-sm-6 col-md-3">
      <div class="form-group form-focus">
        <input type="text" class="form-control floating" id="empID">
        <label class="focus-label">Employee Code</label>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="form-group form-focus">
        <input type="text" class="form-control floating" id="empName">
        <label class="focus-label">Employee Name</label>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="form-group form-focus select-focus">
        <select class="select floating" id="empDepartment">
          <option value selected>Select Department</option>
        </select>
        <label class="focus-label">Designation</label>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <button class="btn btn-success btn-block" id="searchEmployeeButton"> Search </button>
    </div>
  </div>
  <!-- Search Filter -->

  <div class="row staff-grid-row" id="employees-list-card">
  </div>

@endsection

@section('scripts')
<!-- Datetimepicker JS -->
<script src="{{asset("assets/js/moment.min.js")}}"></script>
<script src="{{asset("assets/js/bootstrap-datetimepicker.min.js")}}"></script>
<script>
  $(()=>{

    //Load Positions
      let PositionsList = @json($listPositions);
      let options = '';
      PositionsList.forEach((position) => {
        options += `<option value="${position.id}">${position.pos_name}</option>`;
      });
      $("#empDepartment").append(options);



    //liste employés
    let employeesList = @json($listUsers);
    buildEmployeesCards(employeesList);

    $('#searchEmployeeButton').click(function (e) {
      e.preventDefault();
      let mat = $('#empID').val();
      // console.log('Lesage');
      let name = $('#empName').val();
      let dept = $('#empDepartment').val();

      showLoader();
      $.ajax({
        type: "POST",
        url: serviceBase + "admin/employees/search-employees",
        data: {
          mat:mat,
          name:name,
          dept:dept,
        },
        headers: {'X-CSRF-Token':csrfToken},
        dataType: "JSON",
        success: function (data) {
          if(data.error == false){
            hideLoader();
            buildEmployeesCards(data.data);
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
    });


  })

  let buildEmployeesCards = (employeesList)=>{
    showLoader();
    let assetURL = $('meta[name="asset-url"]').attr('content');
    let content = '';
    if (employeesList.length >= 1) {
      employeesList.forEach(employee => {
        content += `
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
          <div class="profile-widget">
            <div class="profile-img">
              <a href="${serviceBase}admin/user/profile/${employee.slug}" class="avatar"><img src="${assetURL}assets/img/default/default_profile.png" alt=""></a>
            </div>
            <div class="dropdown profile-action">
              <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
              </div>
            </div>
            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="${serviceBase}admin/user/profile/${employee.slug}">${employee.first_name + ' ' + employee.last_name}</a></h4>
            <div class="small text-muted">${employee.pos_name}</div>
          </div>
        </div>`;
      });
    }else{
      content = `
      <div class="col text-center mt-4">
        <h5 class='text-center'>No Records Found, Please Try again</h5>
      </div>`
    }
    $('#employees-list-card').html(content);
    hideLoader();
  }

</script>
@endsection
