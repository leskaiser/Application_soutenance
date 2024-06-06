@extends('layouts.template')
@section('title', __('Profile') )

@section('css')
  <!-- Datetimepicker CSS -->
  <link rel="stylesheet" href="{{asset("assets/css/bootstrap-datetimepicker.min.css")}}">
  <!-- Tagsinput CSS -->
  <link rel="stylesheet" href="{{asset("assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}">
@endsection

@section('content')
<div class="content container-fluid">

  <!-- Page Header -->
  <div class="page-header">
    <div class="row">
      <div class="col-sm-12">
        <h3 class="page-title">Profile</h3>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- /Page Header -->

  <div class="card mb-0">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="profile-view">
            <div class="profile-img-wrap">
              <div class="profile-img">
                <a href="#"><img alt="" src="{{asset("assets/img/default/default_profile.png")}}"></a>
              </div>
            </div>
            <div class="profile-basic">
              <div class="row">
                <div class="col-md-5">
                  <div class="profile-info-left">
                    <h3 class="user-name m-t-0 mb-0">{{$user->first_name}} {{$user->last_name}}</h3>
                    <h6 class="text-muted">{{$user->position->service->service_name}}</h6>
                    <small class="text-muted">{{$user->position->pos_name}}</small>
                    <div class="staff-id">Employee ID : {{$user->matricule}}</div>
                    <div class="small doj text-muted">Date of Join : {{date('j M Y', strtotime($user->created_at))}}</div>
                    <div class="staff-msg"><a class="btn btn-custom" href="chat.html">{{__("View More")}}</a></div>
                  </div>
                </div>
                <div class="col-md-7">
                  <ul class="personal-info">
                    <li>
                      <div class="title">Phone:</div>
                      <div class="text"><a href="tel:{{$user->phone_number}}">{{$user->phone_number}}</a></div>
                    </li>
                    <li>
                      <div class="title">Email:</div>
                      <div class="text"><a href="mailto:{{$user->email}}">{{$user->email}}</a></div>
                    </li>
                    <li>
                      <div class="title">Birthday:</div>
                      <div class="text">{{date('d-m-Y',strtotime($user->date_of_birth))}}</div>
                    </li>
                    <li>
                      <div class="title">Address:</div>
                      <div class="text">{{$user->ville}}, {{$user->address}}</div>
                    </li>
                    <li>
                      <div class="title">Gender:</div>
                      <div class="text">{{$user->sexe}}</div>
                    </li>
                    <li>
                      <div class="title">Parent:</div>
                      @if ($user->parent_id == null || $user->parent_id == '' || $user->parent_id == 'null')
                        <div class="text">
                          N/A
                        </div>
                      @else
                        <div class="text">
                          <div class="avatar-box">
                            <div class="avatar avatar-xs">
                              @if ($user->parent->avatar == null || $user->parent->avatar == '' || $user->parent->avatar == 'null')
                              <img src="{{asset('assets/img/default/default_profile.png')}}" alt="Default avatar">
                              @else
                              <img src="{{asset('assets/user/profiles/'.$user->parent->avatar)}}" alt="{{$user->parent->first_name}} {{$user->parent->last_name}}">
                              @endif
                            </div>
                          </div>
                          <a href="profile.html">
                            {{$user->parent->first_name}} {{$user->parent->last_name}}
                          </a>
                        </div>
                      @endif
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="pro-edit" id="edit_profile_button"><a class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card tab-box">
    <div class="row user-tabs">
      <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
        <ul class="nav nav-tabs nav-tabs-bottom">
          <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
          <li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Projects</a></li>
          <li class="nav-item"><a href="#update_password" data-toggle="tab" class="nav-link">Change Password</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="tab-content">

    <!-- Profile Info Tab -->
    <div id="emp_profile" class="pro-overview tab-pane fade show active">
      <div class="row">
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Personal Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a></h3>
              <ul class="personal-info">
                <li>
                  <div class="title">Passport No.</div>
                  <div class="text">9876543210</div>
                </li>
                <li>
                  <div class="title">Passport Exp Date.</div>
                  <div class="text">9876543210</div>
                </li>
                <li>
                  <div class="title">Tel</div>
                  <div class="text"><a href="">9876543210</a></div>
                </li>
                <li>
                  <div class="title">Nationality</div>
                  <div class="text">Indian</div>
                </li>
                <li>
                  <div class="title">Religion</div>
                  <div class="text">Christian</div>
                </li>
                <li>
                  <div class="title">Marital status</div>
                  <div class="text">Married</div>
                </li>
                <li>
                  <div class="title">Employment of spouse</div>
                  <div class="text">No</div>
                </li>
                <li>
                  <div class="title">No. of children</div>
                  <div class="text">2</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Emergency Contact <a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a></h3>
              <h5 class="section-title">Primary</h5>
              <ul class="personal-info">
                <li>
                  <div class="title">Name</div>
                  <div class="text">John Doe</div>
                </li>
                <li>
                  <div class="title">Relationship</div>
                  <div class="text">Father</div>
                </li>
                <li>
                  <div class="title">Phone </div>
                  <div class="text">9876543210, 9876543210</div>
                </li>
              </ul>
              <hr>
              <h5 class="section-title">Secondary</h5>
              <ul class="personal-info">
                <li>
                  <div class="title">Name</div>
                  <div class="text">Karen Wills</div>
                </li>
                <li>
                  <div class="title">Relationship</div>
                  <div class="text">Brother</div>
                </li>
                <li>
                  <div class="title">Phone </div>
                  <div class="text">9876543210, 9876543210</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Bank information</h3>
              <ul class="personal-info">
                <li>
                  <div class="title">Bank name</div>
                  <div class="text">ICICI Bank</div>
                </li>
                <li>
                  <div class="title">Bank account No.</div>
                  <div class="text">159843014641</div>
                </li>
                <li>
                  <div class="title">IFSC Code</div>
                  <div class="text">ICI24504</div>
                </li>
                <li>
                  <div class="title">PAN No</div>
                  <div class="text">TC000Y56</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Family Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#family_info_modal"><i class="fa fa-pencil"></i></a></h3>
              <div class="table-responsive">
                <table class="table table-nowrap">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Relationship</th>
                      <th>Date of Birth</th>
                      <th>Phone</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Leo</td>
                      <td>Brother</td>
                      <td>Feb 16th, 2019</td>
                      <td>9876543210</td>
                      <td class="text-right">
                        <div class="dropdown dropdown-action">
                          <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <a href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Education Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#education_info"><i class="fa fa-pencil"></i></a></h3>
              <div class="experience-box">
                <ul class="experience-list">
                  <li>
                    <div class="experience-user">
                      <div class="before-circle"></div>
                    </div>
                    <div class="experience-content">
                      <div class="timeline-content">
                        <a href="#/" class="name">International College of Arts and Science (UG)</a>
                        <div>Bsc Computer Science</div>
                        <span class="time">2000 - 2003</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="experience-user">
                      <div class="before-circle"></div>
                    </div>
                    <div class="experience-content">
                      <div class="timeline-content">
                        <a href="#/" class="name">International College of Arts and Science (PG)</a>
                        <div>Msc Computer Science</div>
                        <span class="time">2000 - 2003</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 d-flex">
          <div class="card profile-box flex-fill">
            <div class="card-body">
              <h3 class="card-title">Experience <a href="#" class="edit-icon" data-toggle="modal" data-target="#experience_info"><i class="fa fa-pencil"></i></a></h3>
              <div class="experience-box">
                <ul class="experience-list">
                  <li>
                    <div class="experience-user">
                      <div class="before-circle"></div>
                    </div>
                    <div class="experience-content">
                      <div class="timeline-content">
                        <a href="#/" class="name">Web Designer at Zen Corporation</a>
                        <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="experience-user">
                      <div class="before-circle"></div>
                    </div>
                    <div class="experience-content">
                      <div class="timeline-content">
                        <a href="#/" class="name">Web Designer at Ron-tech</a>
                        <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="experience-user">
                      <div class="before-circle"></div>
                    </div>
                    <div class="experience-content">
                      <div class="timeline-content">
                        <a href="#/" class="name">Web Designer at Dalt Technology</a>
                        <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Profile Info Tab -->

    <!-- Projects Tab -->
    <div class="tab-pane fade" id="emp_projects">
      <div class="row">
        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="dropdown profile-action">
                <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                  <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
              </div>
              <h4 class="project-title"><a href="project-view.html">Office Management</a></h4>
              <small class="block text-ellipsis m-b-15">
                <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
              </small>
              <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. When an unknown printer took a galley of type and
                scrambled it...
              </p>
              <div class="pro-deadline m-b-15">
                <div class="sub-title">
                  Deadline:
                </div>
                <div class="text-muted">
                  17 Apr 2019
                </div>
              </div>
              <div class="project-members m-b-15">
                <div>Project Leader :</div>
                <ul class="team-members">
                  <li>
                    <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="{{asset("assets/img/profiles/avatar-16.jpg")}}"></a>
                  </li>
                </ul>
              </div>
              <div class="project-members m-b-15">
                <div>Team :</div>
                <ul class="team-members">
                  <li>
                    <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="{{asset("assets/img/profiles/avatar-02.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="{{asset("assets/img/profiles/avatar-09.jp")}}g"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="{{asset("assets/img/profiles/avatar-10.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="{{asset("assets/img/profiles/avatar-05.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" class="all-users">+15</a>
                  </li>
                </ul>
              </div>
              <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
              <div class="progress progress-xs mb-0">
                <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="dropdown profile-action">
                <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                  <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
              </div>
              <h4 class="project-title"><a href="project-view.html">Office Management</a></h4>
              <small class="block text-ellipsis m-b-15">
                <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
              </small>
              <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. When an unknown printer took a galley of type and
                scrambled it...
              </p>
              <div class="pro-deadline m-b-15">
                <div class="sub-title">
                  Deadline:
                </div>
                <div class="text-muted">
                  17 Apr 2019
                </div>
              </div>
              <div class="project-members m-b-15">
                <div>Project Leader :</div>
                <ul class="team-members">
                  <li>
                    <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="{{asset("assets/img/profiles/avatar-16.jpg")}}"></a>
                  </li>
                </ul>
              </div>
              <div class="project-members m-b-15">
                <div>Team :</div>
                <ul class="team-members">
                  <li>
                    <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="{{asset("assets/img/profiles/avatar-02.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="{{asset("assets/img/profiles/avatar-09.jp")}}g"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="{{asset("assets/img/profiles/avatar-10.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="{{asset("assets/img/profiles/avatar-05.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" class="all-users">+15</a>
                  </li>
                </ul>
              </div>
              <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
              <div class="progress progress-xs mb-0">
                <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="dropdown profile-action">
                <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                  <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
              </div>
              <h4 class="project-title"><a href="project-view.html">Office Management</a></h4>
              <small class="block text-ellipsis m-b-15">
                <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
              </small>
              <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. When an unknown printer took a galley of type and
                scrambled it...
              </p>
              <div class="pro-deadline m-b-15">
                <div class="sub-title">
                  Deadline:
                </div>
                <div class="text-muted">
                  17 Apr 2019
                </div>
              </div>
              <div class="project-members m-b-15">
                <div>Project Leader :</div>
                <ul class="team-members">
                  <li>
                    <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="{{asset("assets/img/profiles/avatar-16.jpg")}}"></a>
                  </li>
                </ul>
              </div>
              <div class="project-members m-b-15">
                <div>Team :</div>
                <ul class="team-members">
                  <li>
                    <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="{{asset("assets/img/profiles/avatar-02.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="{{asset("assets/img/profiles/avatar-09.jp")}}g"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="{{asset("assets/img/profiles/avatar-10.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="{{asset("assets/img/profiles/avatar-05.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" class="all-users">+15</a>
                  </li>
                </ul>
              </div>
              <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
              <div class="progress progress-xs mb-0">
                <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="dropdown profile-action">
                <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                  <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
              </div>
              <h4 class="project-title"><a href="project-view.html">Office Management</a></h4>
              <small class="block text-ellipsis m-b-15">
                <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
              </small>
              <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. When an unknown printer took a galley of type and
                scrambled it...
              </p>
              <div class="pro-deadline m-b-15">
                <div class="sub-title">
                  Deadline:
                </div>
                <div class="text-muted">
                  17 Apr 2019
                </div>
              </div>
              <div class="project-members m-b-15">
                <div>Project Leader :</div>
                <ul class="team-members">
                  <li>
                    <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="{{asset("assets/img/profiles/avatar-16.jpg")}}"></a>
                  </li>
                </ul>
              </div>
              <div class="project-members m-b-15">
                <div>Team :</div>
                <ul class="team-members">
                  <li>
                    <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="{{asset("assets/img/profiles/avatar-02.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="{{asset("assets/img/profiles/avatar-09.jp")}}g"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="{{asset("assets/img/profiles/avatar-10.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="{{asset("assets/img/profiles/avatar-05.jpg")}}"></a>
                  </li>
                  <li>
                    <a href="#" class="all-users">+15</a>
                  </li>
                </ul>
              </div>
              <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
              <div class="progress progress-xs mb-0">
                <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Projects Tab -->

    <!-- Bank Statutory Tab -->
    <div class="tab-pane fade" id="update_password">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title"> Update Password</h3>
          <form>
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="old_password">Old Password</label>
                  <input type="password" class="form-control" name="old_password" id="old_password" aria-describedby="helpId" placeholder="********">
                  {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="new_password">New Password</label>
                  <input type="password" class="form-control" name="new_password" id="new_password" aria-describedby="helpId" placeholder="********">
                  {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="helpId" placeholder="********">
                  {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                </div>
              </div>
            </div>
            <div class="submit-section text-right">
              <button class="btn btn-primary submit-btn" type="submit">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /Bank Statutory Tab -->

  </div>
</div>

<!-- Profile  Modal -->
<div id="profile_info_modal" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Profile Information's</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form >
          <div class="row">
            <div class="col-md-12">
              <div class="profile-img-wrap edit-img">
                @if ($user->avatar == null || $user->avatar == '' || $user->avatar == 'null')
                <img src="{{asset('assets/img/default/default_profile.png')}}" alt="Default avatar">
                @else
                <img src="{{asset('assets/user/profiles/'.$user->avatar)}}" alt="{{$user->first_name}} {{$user->last_name}}">
                @endif
                <div class="fileupload btn">
                  <span class="btn-text">edit</span>
                  <input class="upload" type="file"  accept="image/png, image/jpg">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" value="{{$user->first_name}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" value="{{$user->last_name}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Birth Date <span class="text-danger">*</span></label>
                    <div class="cal-icon">
                      <input class="form-control datetimepicker" type="text" value="{{str_replace('-', '/', date('d-m-Y',strtotime($user->date_of_birth)))}}">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Gender <span class="text-danger">*</span></label>
                    <select class="select form-control">
                      <option value="male selected">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label>Phone Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="{{$user->phone_number}}">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label>Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="{{$user->username}}">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label>PIN Code <span class="text-danger">*</span></label>
                <input class="form-control" type="text" value="123456" readonly disabled>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-5">
              <div class="form-group">
                <label>Nationality <span class="text-danger">*</span></label>
                <select class="select" name="" id="country">
                  <option value="" selected disabled>Select country</option>
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label>City </label>
                <input type="text" class="form-control" value="{{$user->ville}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Address </label>
                <input type="text" class="form-control" value="{{$user->address}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Role <span class="text-danger">*</span></label>
                <select class="select" id="role">
                  <option selected value="" disabled>Select Role</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Position <span class="text-danger">*</span></label>
                <select class="select" id="position">
                  <option value="" selected disabled>Select Position</option>
                </select>
              </div>
            </div>
          </div>
          <div class="submit-section">
            <button class="btn btn-primary submit-btn">save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Profile Modal -->
@endsection

@section('scripts')
  <!-- Datetimepicker JS -->
  <script src="{{asset("assets/js/moment.min.js")}}"></script>
  <script src="{{asset("assets/js/bootstrap-datetimepicker.min.js")}}"></script>

  <!-- Tagsinput JS -->
  <script src="{{asset("assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js")}}"></script>

  <script>
    $(()=>{

      let user = @json($user);
      // console.log(user);

      //Load Countries
      let Countries = `<option value="Afghanistan">Afghanistan</option><option value="Åland" islands="">Åland Islands</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American" samoa="">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua" and="" barbuda="">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivarian" republic="" of="" venezuela="">Bolivarian Republic of Venezuela</option><option value="Bolivia">Bolivia</option><option value="Bonaire," sint="" eustatius="" and="" saba="">Bonaire, Sint Eustatius and Saba</option><option value="Bosnia" and="" herzegovina="">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet" island="">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British" indian="" ocean="" territory="">British Indian Ocean Territory</option><option value="Brunei">Brunei</option><option value="Bulgaria">Bulgaria</option><option value="Burkina" faso="">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cabo" verde="">Cabo Verde</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cayman" islands="">Cayman Islands</option><option value="Central" african="" republic="">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas" island="">Christmas Island</option><option value="Cocos" (keeling)="" islands="">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Congo" (drc)="">Congo (DRC)</option><option value="Cook" islands="">Cook Islands</option><option value="Costa" rica="">Costa Rica</option><option value="Côte" d'ivoire="">Côte d'Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Curaçao">Curaçao</option><option value="Cyprus">Cyprus</option><option value="Czech" republic="">Czech Republic</option><option value="Democratic" republic="" of="" timor-leste="">Democratic Republic of Timor-Leste</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican" republic="">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El" salvador="">El Salvador</option><option value="Equatorial" guinea="">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland" islands="" (islas="" malvinas)="">Falkland Islands (Islas Malvinas)</option><option value="Faroe" islands="">Faroe Islands</option><option value="Fiji" islands="">Fiji Islands</option><option value="Finland">Finland</option><option value="France">France</option><option value="French" guiana="">French Guiana</option><option value="French" polynesia="">French Polynesia</option><option value="French" southern="" and="" antarctic="" lands="">French Southern and Antarctic Lands</option><option value="Gabon">Gabon</option><option value="Gambia," the="">Gambia, The</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guernsey">Guernsey</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard" island="" and="" mcdonald="" islands="">Heard Island and McDonald Islands</option><option value="Honduras">Honduras</option><option value="Hong" kong="" sar="">Hong Kong SAR</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Jan" mayen="">Jan Mayen</option><option value="Japan">Japan</option><option value="Jersey">Jersey</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea">Korea</option><option value="Kosovo">Kosovo</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao" sar="">Macao SAR</option><option value="Macedonia," former="" yugoslav="" republic="" of="">Macedonia, Former Yugoslav Republic of</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Man," isle="" of="">Man, Isle of</option><option value="Marshall" islands="">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="New" caledonia="">New Caledonia</option><option value="New" zealand="">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk" island="">Norfolk Island</option><option value="North" korea="">North Korea</option><option value="Northern" mariana="" islands="">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestinian" authority="">Palestinian Authority</option><option value="Panama">Panama</option><option value="Papua" new="" guinea="">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn" islands="">Pitcairn Islands</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto" rico="">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russia">Russia</option><option value="Rwanda">Rwanda</option><option value="Saint" barthélemy="">Saint Barthélemy</option><option value="Saint" helena,="" ascension="" and="" tristan="" da="" cunha="">Saint Helena, Ascension and Tristan da Cunha</option><option value="Saint" kitts="" and="" nevis="">Saint Kitts and Nevis</option><option value="Saint" lucia="">Saint Lucia</option><option value="Saint" martin="" (french="" part)="">Saint Martin (French part)</option><option value="Saint" pierre="" and="" miquelon="">Saint Pierre and Miquelon</option><option value="Saint" vincent="" and="" the="" grenadines="">Saint Vincent and the Grenadines</option><option value="Samoa">Samoa</option><option value="San" marino="">San Marino</option><option value="São" tomé="" and="" príncipe="">São Tomé and Príncipe</option><option value="Saudi" arabia="">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra" leone="">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Sint" maarten="" (dutch="" part)="">Sint Maarten (Dutch part)</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon" islands="">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South" africa="">South Africa</option><option value="South" georgia="" and="" the="" south="" sandwich="" islands="">South Georgia and the South Sandwich Islands</option><option value="South" sudan="">South Sudan</option><option value="Spain">Spain</option><option value="Sri" lanka="">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard">Svalbard</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad" and="" tobago="">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks" and="" caicos="" islands="">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="U.S." minor="" outlying="" islands="">U.S. Minor Outlying Islands</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United" arab="" emirates="">United Arab Emirates</option><option value="United" kingdom="">United Kingdom</option><option value="United" states="">United States</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Vatican" city="">Vatican City</option><option value="Vietnam">Vietnam</option><option value="Virgin" islands,="" u.s.="">Virgin Islands, U.S.</option><option value="Virgin" islands,="" british="">Virgin Islands, British</option><option value="Wallis" and="" futuna="">Wallis and Futuna</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option>`
      $('#country').append(Countries);

      //Load Positions
      let PositionsList = @json($positions);
      let options = '';
      PositionsList.forEach((position) => {
        options += `<option value="${position.id}">${position.pos_name}</option>`;
      });
      $("#position").append(options);

      //Load Roles
      let RolesList = @json($roles);
      options = '';
      RolesList.forEach((role) => {
        options += `<option value="${role.id}">${role.role_name}</option>`;
      });
      $("#role").append(options);

      //Edit profile Modal
      $('#edit_profile_button').click(function (e) {
        e.preventDefault();
        $("#profile_info_modal").modal({show:true, keyboard:true, backdrop:'static'});
      });
    })
  </script>
@endsection
