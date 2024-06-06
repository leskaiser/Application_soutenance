@extends('layouts.template')
@section('title', __('Employees - List'))

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
        <a href="#" class="btn add-btn" id="addEmployeeButton" ><i class="fa fa-plus"></i> Add Employee</a>
        <div class="view-icons">
          <a href="{{route('employeesCardList')}}" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
          <a href="{{route('employeesList')}}" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
        </div>
      </div>
    </div>
  </div>
  <!-- /Page Header -->
					
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-striped custom-table" id="datatable">
          <thead>
            <tr>
              <th>Name</th>
              <th>Employee Code</th>
              <th>Email</th>
              <th>Mobile</th>
              <th class="text-nowrap">Join Date</th>
              <th class="text-right no-sort">Options</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <!-- Add Employee Modal -->
  <div id="add_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="profile-img-wrap edit-img">
                  <img src="{{asset('assets/img/default/default_profile.png')}}" alt="Default avatar">
                  <div class="fileupload btn">
                    <span class="btn-text">edit</span>
                    <input class="upload" type="file" id="image" accept="image/png, image/jpg">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>First Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control"" id="first_name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Last Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="last_name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Birth Date <span class="text-danger">*</span></label>
                      <div class="cal-icon">
                        <input class="form-control datetimepicker" type="text"  id="dob">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Gender <span class="text-danger">*</span></label>
                      <select class="select form-control"  id="gender">
                        <option value="male" selected>Male</option>
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
                  <input type="text" class="form-control">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>Username <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="username">
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
              <div class="col-lg-4">
                <div class="form-group">
                  <label>ID type <span class="text-danger">*</span></label>
                  <select class="select form-control" id="id_type">
                    <option value="" selected disabled>Select Identification Type</option>
                    <option value="1">PASSEPORT - (PP)</option>
                    <option value="2">IDENTITY CARD - (CI)</option>
                    <option value="7">National Register of Legal Entities (CNPJ) - (CNPJ)</option>
                    <option value="9">Citizenship card - (CC)</option>
                    <option value="10">Certificate of residence - (CR)</option>
                    <option value="13">Civil National Identity Card - (CNIC)</option>
                    <option value="15">Citizen ID - (CID)</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>ID Number <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" id="id_number">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label>ID Expiry Date <span class="text-danger">*</span></label>
                  <div class="cal-icon">
                    <input class="form-control datetimepicker" type="text" id="IDexpiryDate">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-5">
                <div class="form-group">
                  <label>Nationality <span class="text-danger">*</span></label>
                  <select class="select" name="" id="country"  id="nationality">
                    <option selected disabled>Select country</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label>City </label>
                  <input type="text" class="form-control" id="city">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Address </label>
                  <input type="text" class="form-control" id="address">
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
              <div class="col-md-4">
                <div class="form-group">
                  <label>Status <span class="text-danger">*</span></label>
                  <select class="select" id="status">
                    <option value="" selected disabled>Select Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="submit-section">
              <button class="btn btn-primary submit-btn" id="saveEmployeeButton">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /Add Employee Modal -->
@endsection

@section('scripts')
  <!-- Datetimepicker JS -->
  <script src="{{asset("assets/js/moment.min.js")}}"></script>
  <script src="{{asset("assets/js/bootstrap-datetimepicker.min.js")}}"></script>
  
  <!-- Tagsinput JS -->
  <script src="{{asset("assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js")}}"></script>
  
  <script>
    $(()=>{
      let table = $('#datatable').DataTable({
        lengthMenu:[[15, 25, 50, 100, -1], [15, 25, 50, 100, 'All']],
        scrollCollapse: true,
        processing: true,
        "order": [[ 0, "asc" ]],
        "pageLength": 15,
        locale:"{{config('app.locale')}}",
        serverSide: true,
        ajax:{
          "url": serviceBase + "admin/employees-list",
          "dataType": "json",
          "type": "POST",
          "data":{ 
            _token: csrfToken,
          }
        },
        columns: [
          { "data": "name"},
          { "data": "code"},
          { "data": "email" },
          { "data": "mobile" },
          { "data": "date" },
          { "data": "options", "searchable": false, "orderable": false },
        ],
      });

      $('#addEmployeeButton').click(function (e) { 
        e.preventDefault();
        $('#add_employee').modal({show:true, keyboard:true, backdrop:'static'});

        //Load Countries
        let Countries = `<option value="Afghanistan">Afghanistan</option><option value="Åland" islands="">Åland Islands</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American" samoa="">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua" and="" barbuda="">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivarian" republic="" of="" venezuela="">Bolivarian Republic of Venezuela</option><option value="Bolivia">Bolivia</option><option value="Bonaire," sint="" eustatius="" and="" saba="">Bonaire, Sint Eustatius and Saba</option><option value="Bosnia" and="" herzegovina="">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet" island="">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British" indian="" ocean="" territory="">British Indian Ocean Territory</option><option value="Brunei">Brunei</option><option value="Bulgaria">Bulgaria</option><option value="Burkina" faso="">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cabo" verde="">Cabo Verde</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cayman" islands="">Cayman Islands</option><option value="Central" african="" republic="">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas" island="">Christmas Island</option><option value="Cocos" (keeling)="" islands="">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Congo" (drc)="">Congo (DRC)</option><option value="Cook" islands="">Cook Islands</option><option value="Costa" rica="">Costa Rica</option><option value="Côte" d'ivoire="">Côte d'Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Curaçao">Curaçao</option><option value="Cyprus">Cyprus</option><option value="Czech" republic="">Czech Republic</option><option value="Democratic" republic="" of="" timor-leste="">Democratic Republic of Timor-Leste</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican" republic="">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El" salvador="">El Salvador</option><option value="Equatorial" guinea="">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland" islands="" (islas="" malvinas)="">Falkland Islands (Islas Malvinas)</option><option value="Faroe" islands="">Faroe Islands</option><option value="Fiji" islands="">Fiji Islands</option><option value="Finland">Finland</option><option value="France">France</option><option value="French" guiana="">French Guiana</option><option value="French" polynesia="">French Polynesia</option><option value="French" southern="" and="" antarctic="" lands="">French Southern and Antarctic Lands</option><option value="Gabon">Gabon</option><option value="Gambia," the="">Gambia, The</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guernsey">Guernsey</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard" island="" and="" mcdonald="" islands="">Heard Island and McDonald Islands</option><option value="Honduras">Honduras</option><option value="Hong" kong="" sar="">Hong Kong SAR</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Jan" mayen="">Jan Mayen</option><option value="Japan">Japan</option><option value="Jersey">Jersey</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea">Korea</option><option value="Kosovo">Kosovo</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao" sar="">Macao SAR</option><option value="Macedonia," former="" yugoslav="" republic="" of="">Macedonia, Former Yugoslav Republic of</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Man," isle="" of="">Man, Isle of</option><option value="Marshall" islands="">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="New" caledonia="">New Caledonia</option><option value="New" zealand="">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk" island="">Norfolk Island</option><option value="North" korea="">North Korea</option><option value="Northern" mariana="" islands="">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestinian" authority="">Palestinian Authority</option><option value="Panama">Panama</option><option value="Papua" new="" guinea="">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn" islands="">Pitcairn Islands</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto" rico="">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russia">Russia</option><option value="Rwanda">Rwanda</option><option value="Saint" barthélemy="">Saint Barthélemy</option><option value="Saint" helena,="" ascension="" and="" tristan="" da="" cunha="">Saint Helena, Ascension and Tristan da Cunha</option><option value="Saint" kitts="" and="" nevis="">Saint Kitts and Nevis</option><option value="Saint" lucia="">Saint Lucia</option><option value="Saint" martin="" (french="" part)="">Saint Martin (French part)</option><option value="Saint" pierre="" and="" miquelon="">Saint Pierre and Miquelon</option><option value="Saint" vincent="" and="" the="" grenadines="">Saint Vincent and the Grenadines</option><option value="Samoa">Samoa</option><option value="San" marino="">San Marino</option><option value="São" tomé="" and="" príncipe="">São Tomé and Príncipe</option><option value="Saudi" arabia="">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra" leone="">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Sint" maarten="" (dutch="" part)="">Sint Maarten (Dutch part)</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon" islands="">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South" africa="">South Africa</option><option value="South" georgia="" and="" the="" south="" sandwich="" islands="">South Georgia and the South Sandwich Islands</option><option value="South" sudan="">South Sudan</option><option value="Spain">Spain</option><option value="Sri" lanka="">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard">Svalbard</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad" and="" tobago="">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks" and="" caicos="" islands="">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="U.S." minor="" outlying="" islands="">U.S. Minor Outlying Islands</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United" arab="" emirates="">United Arab Emirates</option><option value="United" kingdom="">United Kingdom</option><option value="United" states="">United States</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Vatican" city="">Vatican City</option><option value="Vietnam">Vietnam</option><option value="Virgin" islands,="" u.s.="">Virgin Islands, U.S.</option><option value="Virgin" islands,="" british="">Virgin Islands, British</option><option value="Wallis" and="" futuna="">Wallis and Futuna</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option>`
        $('#country').append(Countries);

        //Load Positions
        let PositionsList = @json($listPositions);
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
      });

    })

    $(()=>{ 
      $('#saveEmployeeButton').click(function (e) { 
        e.preventDefault();
        // console.log($("#IDexpiryDate").val());
        
        var formData = new FormData();
        formData.append('image', $('#image')[0].files[0]);
        formData.append('first_name', $('#first_name').val());
        formData.append('last_name', $('#last_name').val());
        formData.append('username', $('#username').val());
        formData.append('dob', formatDateForLaravel($('#dob').val()));
        formData.append('gender', $('#gender').val());
        formData.append('id_type', $('#id_type').val());
        formData.append('id_number', $('#id_number').val());
        formData.append('id_expiry_date', formatDateForLaravel($('#IDexpiryDate').val()));
        formData.append('country', $('#country').val());
        formData.append('city', $('#city').val());
        formData.append('address', $('#address').val());
        formData.append('role', $('#role').val());
        formData.append('position', $('#position').val());

        // console.log(formData);

        $.ajax({
          type: "POST",
          url: serviceBase + "admin/employees/add-employees",
          data: formData,
          contentType: false,
          processData: false,
          headers: {'X-CSRF-Token':csrfToken},
          dataType: "JSON",
          success: function (data) {
            if(data.error == false){
              Swal.fire({title: 'Success !!!', text:JSON.stringify(data.messages),icon: 'success'});
              hideLoader();
            }else{
              hideLoader();
              Swal.fire({title: 'Error !!!', html:genericMessage(data.messages),icon: 'error'});
            }
          },
          error: function(error){
            hideLoader();
            Swal.fire({title: 'Error !!!', text:  JSON.stringify(error),icon: 'error'});
          },
        });
      });
    });

    $('#dob').on('dp.change', (event) => {
      const selectedDate = event.date.toDate();
      const today = new Date();
      
      const age = today.getFullYear() - selectedDate.getFullYear();
      const isBirthdayPassed = (today.getMonth() > selectedDate.getMonth()) || (today.getMonth() === selectedDate.getMonth() && today.getDate() >= selectedDate.getDate());

      if (age < 21 || (age === 21 && !isBirthdayPassed)) {
        Swal.fire({title: 'Erreur !!!', text: 'L\'utilisateur doit avoir 21 ans ou plus', icon: 'error'});
        const validDate = new Date();
        validDate.setFullYear(validDate.getFullYear() - 21);
        $('#dob').data("DateTimePicker").date(validDate);
      }
    });

    let reloadTable = ()=>{
      $('#datatable').DataTable().ajax.reload();
    }

    let formatDateForLaravel = (date) => {
      date = (date.replace('/','-')).replace('/','-');

      return date;
    }

  </script>
@endsection