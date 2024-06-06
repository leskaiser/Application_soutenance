<?php

namespace App\Http\Controllers;

use App\Functions\ConfigService;
use App\Models\Positions;
use App\Models\Roles;
use App\Models\Services;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    public function servicesList(Request $request)
    {
        return view('employees.services');
    }
    
    public function getServicesList(Request $request)
    {
        if($request->ajax()){
            try {
                $columns = array(
                    0 => '`wan_services`.`service_code`',
                    1 => '`wan_services`.`service_code`',
                    2 => '`wan_services`.`service_name`',
                    3 => '`wan_services`.`service_description`',
                    4 => '`wan_services`.`service_status`',
                    5 => '`wan_services`.`service_status`',
                );

                $req = "SELECT COUNT(*) AS `total` FROM `wan_services`;";
                $totalData = DB::select($req);
                $totalFiltered = count($totalData) > 0 ? $totalData[0]->total : 0;
                $limit = $request->input('length');
                $start = $request->input('start');
                $order = $columns[$request->input('order.0.column')];
                $dir = $request->input('order.0.dir');

                $sql = ConfigService::getServicesList();
                $get_search = $request->input('search.value');

                if (empty($get_search)) {
                    $sql .= ' ORDER BY ' . $order . ' ' . $dir . ' LIMIT ' . $limit . ' OFFSET  ' . $start;
                    $listServices = DB::select($sql);
                } else {
                    $sql .= ' AND (`wan_services`.`service_code` LIKE "%' . htmlspecialchars($get_search) . '%" OR `wan_services`.`service_name` LIKE "%' . htmlspecialchars($get_search) . '%" OR `wan_services`.`service_description` LIKE "%' . htmlspecialchars($get_search) . '%" OR `wan_services`.`service_status` LIKE "%' . htmlspecialchars($get_search) . '%") ';
                    $sql .= ' ORDER BY ' . $order . ' ' . $dir . ' LIMIT ' . $limit . ' OFFSET  ' . $start;
                    $listServices = DB::select($sql);
                    $totalFiltered = count($listServices);
                }

                $data = [];
                if (!empty($listServices)) {
                    $countItenms = 1;
                    foreach ($listServices as $service) {
                        $btn = $service->status == "Active" ? 'success' : (($service->status == "Inactive") ? 'warning' : 'danger');
                        $nestedData['count'] = $countItenms++;
                        $nestedData['code'] = $service->code;
                        $nestedData['name'] = $service->name;
                        $nestedData['desc'] = $service->desc == null ? "/" : $service->desc;
                        $nestedData['status'] = '<div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-dot-circle-o text-'.$btn.'"></i> '. $service->status. '
                                                    </a>
                                                    <div class="dropdown-menu">
                                                    <button class="dropdown-item" onclick="changeStatus(' . e($service->id) . ', \'Active\')"><i class="fa fa-dot-circle-o text-success"></i> Active</button>
                                                    <button class="dropdown-item" onclick="changeStatus(' . e($service->id) . ', \'Inactive\')"><i class="fa fa-dot-circle-o text-warning"></i> Inactive</button>
                                                    <button class="dropdown-item" onclick="changeStatus(' . e($service->id) . ', \'Delete\')"><i class="fa fa-dot-circle-o text-danger"></i> Delete</button>
                                                    </div>
                                                </div>';
                        $nestedData['options'] = '<div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                    <button class="dropdown-item" onclick="editService(' . e(json_encode($service)) . ')" data-toggle="modal" data-target="#edit_type"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                                    <button class="dropdown-item" onclick="deleteService(' . e($service->id) . ')" data-toggle="modal" data-target="#delete_type"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                                    </div>
                                                </div>';
                        $data[] = $nestedData;
                    }
                }
                return response()->json([
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                ]);
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }
    }

    public function changeStatusServices(Request $request)
    {
        $v = Validator::make($request->all(), [
            'serviceID' => 'required',
            'status' => 'required|in:Active,Inactive,Delete'
        ]);
        if ($v->fails()) {
            return response()->json([
                'messages' => $v->errors(),
                'error' => true
            ], 200);
        }
        $id = intval($request->serviceID);
        try {
            if ($id != 0 && $id != '') {
                $service = Services ::where('id', '=', $id)->first();
                $service->service_status = $request->status;
                $service->save();
            }
        } catch (\Exception $e) {
            return response()->json([
                'messages' => $e->getMessage(),
                'error' => true
            ], 200);
        }
        return response()->json([
            'messages' => "Services Status Change Successfully",
            'error' => false
        ], 200);
    }

    public function saveServices(Request $request)
    {
        if ($request->id != 0 && $request->id != '' && $request->id != null){
            $v = Validator::make($request->all(), [
                'id' => 'required',
                'name' => 'required',
                'status' => 'required|in:Active,Inactive,Delete'
            ]);
        }else {
            $v = Validator::make($request->all(), [
                'name' => 'required|unique:wan_services,service_name',
                'status' => 'required|in:Active,Inactive,Delete'
            ]);
        }
        if ($v->fails()) {
            return response()->json([
                'messages' => $v->errors(),
                'error' => true
            ], 200);
        }
        $id = intval($request->id);
        // dd($request->serviceID);
        try {
            if ($id != 0 && $id != '' && $id != null) {
                $service = Services::where('id', '=', $id)->first();

                $service->service_status = $request->status;
                $service->service_name = $request->name;
                $service->service_description = $request->desc;
                $service->save();
            }else{
                $service = new Services();
                $count = Services::count();
                $mat = "SVC" . date('Y') . sprintf("%06d", (intval($count) + 1));

                $service->service_code = $mat;
                $service->service_status = $request->status;
                $service->service_name = $request->name;
                $service->service_description = $request->desc;
                $service->save();
            }
        } catch (\Exception $e) {
            return response()->json([
                'messages' => $e->getMessage(),
                'error' => true
            ], 200);
        }
        return response()->json([
            'messages' => "Services Save Change Successfully",
            'error' => false
        ], 200);
    }

    public function deleteServices(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($v->fails()) {
            return response()->json([
                'messages' => $v->errors(),
                'error' => true
            ], 200);
        }

        $id = intval($request->id);
        
        try {
            $service = Services::find($id);
            if (isset($service)) {
                $service->delete();
                $message = "Service deleted successfully";
            }else{
                $message = "Service Don't exist";
            }
        } catch (\Exception $e) {
            return response()->json([
                'messages' => $e->getMessage(),
                'error' => true
            ], 200);
        }
        return response()->json([
            'messages' => $message,
            'error' => false
        ], 200);
    }



    public function profile(Request $request)
    {
        $roles = Roles::all(['id', 'role_name']);
        $positions = Positions::all(['id', 'pos_name']);
        $user = User::find(Auth::user()->id);
        return view('employees.profile', compact('user', 'positions', 'roles'));
    }

    public function profile_other($slug = null)
    {
        $roles = Roles::all(['id', 'role_name']);
        $positions = Positions::all(['id', 'pos_name']);
        $user = User::where('slug', $slug)->first();
        // dd($user);
        if (!isset($user)) {
            abort(404);
        }
        return view('employees.profile', compact('user', 'positions', 'roles'));
    }

    public function employeesCardList(Request $request)
    {
        $listUsers = DB::select(ConfigService::getUsersList().' LIMIT 12');
        $listPositions =Positions::all(['id', 'pos_name']);
        return view('employees.list-card', compact('listUsers', 'listPositions'));
    }
    
    public function employeesList(Request $request)
    {
        $listPositions =Positions::all(['id', 'pos_name']);
        $roles = Roles::all(['id', 'role_name']);
        return view('employees.list', compact('listPositions', 'roles'));
    }
    
    public function getEmployeesList(Request $request)
    {
        if ($request->ajax()) {
            try {
                $columns = array(
                    0 => '`user`.first_name',
                    1 => '`user`.matricule',
                    2 => '`user`.email',
                    3 => '`user`.phone_number',
                    4 => '`user`.created_at',
                    5 => '`user`.first_name',
                );

                $totalData = User::count();
                $totalFiltered = $totalData;
                $limit = $request->input('length');
                $start = $request->input('start');
                $order = $columns[$request->input('order.0.column')];
                $dir = $request->input('order.0.dir');

                $sql = ConfigService::getUsersList();
                $get_search = $request->input('search.value');

                if (empty($get_search)) {
                    $sql .= ' ORDER BY ' . $order . ' ' . $dir . ' LIMIT ' . $limit . ' OFFSET  ' . $start;
                    $listUser = DB::select($sql);
                } else {
                    $sql .= ' AND (`user`.`first_name` LIKE "%' . htmlspecialchars($get_search) . '%" OR `user`.`matricule` LIKE "%' . htmlspecialchars($get_search) . '%" OR `user`.`email` LIKE "%' . htmlspecialchars($get_search) . '%" OR `user`.`phone_number` LIKE "%' . htmlspecialchars($get_search) . '%" OR `role`.`role_name` LIKE "%' . htmlspecialchars($get_search) . '%" OR `user`.`username` LIKE "%' . htmlspecialchars($get_search) . '%") ';
                    $sql .= ' ORDER BY ' . $order . ' ' . $dir . ' LIMIT ' . $limit . ' OFFSET  ' . $start;
                    $listUser = DB::select($sql);
                    $totalFiltered = count($listUser);
                }

                $data = [];
                
                if (!empty($listUser)) {
                    foreach ($listUser as $service) {
                        
                        $name = $service->first_name . ' ' . $service->last_name;
                        $avatar = $service->avatar == null ? 'assets/img/default/default_profile.png' : 'assets/user/profiles/' + $service->avatar;

                        $nestedData['name'] = ' <h2 class="table-avatar">
                                                    <a href="'.route('profile_other', [$service->slug]).'" class="avatar"><img alt="" src="'.asset($avatar).'"></a>
                                                    <a href="'.route('profile_other', [$service->slug]).'">'. $name .' <span>'. $service->pos_name .'</span></a>
                                                </h2>';
                        $nestedData['code'] = $service->matricule;
                        $nestedData['email'] = $service->email;
                        $nestedData['mobile'] = $service->phone_number;
                        $nestedData['date'] = date('j M Y', strtotime($service->created_at));
                        $nestedData['options'] = '<div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button class="dropdown-item" onclick="editUser(' . e(json_encode($service)) . ')" data-toggle="modal" data-target="#edit_type"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                                        <button class="dropdown-item" onclick="deleteUser(' . e($service->slug) . ')" data-toggle="modal" data-target="#delete_type"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                                    </div>
                                                </div>';
                        $data[] = $nestedData;
                    }
                }
                return response()->json([
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                ]);

            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }
    }

    public function searchEmployees(Request $request)
    {
        $req = ConfigService::getUsersList();
        
        if (isset($request->mat)) {
            $req .= ' AND `user`.matricule LIKE "%'. e($request->mat) .'%" ';
        }
        if (isset($request->name)) {
            $req .= ' AND ( `user`.last_name LIKE "%'. e($request->name) . '%" OR `user`.first_name LIKE "%' . e($request->name) . '%" OR `user`.username LIKE "%' . e($request->name) . '%" ) ';
        }
        if (isset($request->dept)) {
            $req .= ' AND `user`.position_id = "' . e($request->dept) . '" ';
        }

        try {
            $result = DB::select($req);
        } catch (\Exception $e) {
            return response()->json([
                'messages' => $e->getMessage(),
                'error' => true
            ], 200);
        }

        return response()->json([
            'data' => $result,
            'error' => false
        ], 200);

    }

    public function addEmployees(Request $request)
    {
        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'username' => 'required|max:255',
            'dob' => 'required|date',
            'gender' => 'required|max:255',
            'id_type' => 'required|max:255',
            'id_number' => 'required|max:255',
            'id_expiry_date' => 'required|date',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'address' => 'required|max:255',
            'position' => 'required|max:255',
            'role' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $v = Validator::make($request->all(), $rules);
        if ($v->fails()) {
            return response()->json([
                'messages' => $v->errors(),
                'error' => true
            ], 200);
        }

        $mat = "MAT-" . date('Y') ."-". uniqid();

        dd($request->all());

        $user = new User();

        $user->first_name = e($request->first_name);
        $user->last_name = e($request->last_name);
        $user->username = e($request->username);
        $user->dob = e($request->dob);
        $user->gender = e($request->gender);
        $user->id_type = e($request->id_type);
        $user->id_number = e($request->id_number);
        $user->city = e($request->city);
        $user->country = e($request->country);
        $user->address = e($request->address);
        $user->position = e($request->position);
        $user->role = e($request->role);
        $user->first_name = e($request->first_name);

    }


}
