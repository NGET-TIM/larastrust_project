<?php

namespace App\Http\Controllers\Users;


use DB;
use DataTables;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\StoreUserRequest;

class Users extends Controller
{
     # user list
     public function index() {
        $u_data = [];
        $u_data['url'] = 'users';
        return view('dashboard.user.index', $u_data);
    }
    public function users_list() {
        # Tip 1
        $user_list = DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'roles.id', '=', 'role_user.role_id')
                    ->select(['users.*','roles.display_name AS role_name', 'roles.name AS _name'])->orderBy('users.name', 'asc');
        # Tip 2
        $users = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->orderBy('users.name', 'asc')
                ->get(['users.*','roles.display_name AS role_name', 'roles.name AS _name']);
        return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('actions', function($data) {
                    $link_1 = '<i class="fa fa-file"></i> User Details';
                    $link_2 = '<i class="fa fa-edit"></i> Edit';
                    $link_3 = '<i class="fa fa-trash"></i> Delete';
                    $action =
                        '<div class="text-center dropdown category_actions"><div class="btn-group dropleft text-left">'
                            . '<button class="btn btn-xs btn_logo dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                            <div class="dropdown-menu pull-right" role="menu">
                                <a href="'.url('admin/user/profile/'.$data->id).'" class="dropdown-item view_user" data-id="'.$data->id.'">' . $link_1 . '</a>
                                <a href="'.url('admin/user/'.$data->id."/edit").'" class="dropdown-item edit_user" data-id="'.$data->id.'">' . $link_2 . '</a>
                                <a class="dropdown-item delete_user" data-id="'.$data->id.'">' . $link_3 . '</a>
                            </div>
                        </div>';

                    return $action;
                })
                // ->addColumn('checkbox', function($data){
                //     $checkbox_content = '<div class="checkbox icheck-info">
                //                             <input type="checkbox" name="user_id[]" value="'.$data->id.'" id="info'.$data->id.'">
                //                             <label for="info'.$data->id.'" class="check_row"></label>
                //                         </div>';
                //     return $checkbox_content;
                // })
                ->addColumn('role_label', function($data){
                    $role_label = '<div class="role_name_content"><span class="role_name_label _'.$data->_name.'">'. $data->role_name.'</span></div>';
                    return $role_label;
                })
                ->addColumn('date_time', function($data){
                    $date = '<div class="label_date">
                                    <div>'.$data->created_at->diffForHumans().'</div>
                            </div>';
                    return $date;
                })

                ->rawColumns(['actions','checkbox', 'role_label', 'date_time'])

                ->make(true);
    }
    # create user
    public function create() {
        if(Auth::user()->hasRole(['supper-admin', 'admin'])) {
            $u_data = [];
            $u_data['url'] = 'add user';
            $u_data['icon'] = 'fas fa-plus';
            $u_data['roles'] = Role::all();

            return view('dashboard.user.add', $u_data);
        } else {
            return redirect()->route('dashboard')->with('fail', 'Your access is not authorization');
        }
    }
    # store user
    public function store(Request $request) {
        $user_avatar = [];
        $path = '';
        if ($request->hasFile('user_avatar')) {
            $file = $request->file('user_avatar');
            $file_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('upload/images/user'), $file_name);
            $user_avatar = $file_name;
            $path = 'public/upload/images/user/';
        } else {
            $user_avatar = '';
        }

        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile_number'     => ['required', 'max:20','unique:users,mobile_number'],
            'user_role'         => ['required'],
        ], [
            'user_role.required' => 'User role field is required.'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $path.''.$user_avatar,
            'mobile_number' => $request->mobile_number,
        ]);
        $user->attachRole($request->user_role);
        event(new Registered($user));
        if($user){
            return back()->with('success','User added successfully');
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }


    # avatar modal
    public function avatar_modal(Request $request) {
        if(request()->ajax()) {
            $user_id = $request->user_id;
            $u_data['modal_title'] = 'Update Avatar';
            // $u_data['user'] = User::where('id','=', $user_id)->first();
            $u_data['user'] = User::findOrFail($user_id);
            $u_data['ok'] = "OK Bro";

            $modal = [
                'modal' =>  view('dashboard.user.modal_edit_avatar', $u_data)->render(),
            ];
            return response()->json($modal);
        }
    }
    # update avatar
    public function update_avatar(Request $request){
        $data_error = [];
        $validator = Validator::make($request->all(),[
            'user_image'=>'required|image'
        ],[
            'user_image.required'=>'User image is required',
            'user_image.image'=>'Avatar file must be an image',
        ]);

        if(!$validator->passes()){
            $data_error['error'] = 'fail';
            $data_error['get_error'] = $validator->errors()->toArray();
            return response()->json($data_error);
        }else{
            $data_file = [];
            $user_id = $request->post('user_id');
            $user = $user = DB::table('users')->where('id', $user_id)->first();
            if ($request->hasFile('user_image')) {
                $file = $request->file('user_image');
                $file_name = $user->name .'_'.time().'_'.$file->getClientOriginalName();
                if($user->avatar != '') {
                    unlink($user->avatar);
                }
                $file->move(public_path('upload/images/user'), $file_name);
                $data_file = $file_name;
            }

            $data = [
                'avatar' => 'upload/images/user/'.$data_file,
            ];
            if(DB::table('users')->where('id', $user_id)->update($data)) {
                $data_error['error'] = 'success';
                $data_error['get_error'] = 'User Avatar updated successfully';
                return response()->json($data_error);
            } else {
                $data_error['error'] = 'not success';
                $data_error['get_error'] = 'Something went wrong!';
                return response()->json($data_error);
            }
        }
    }

    public function after_change_avatar(Request $request) {
        if(request()->ajax()) {
            $id = $request->id;
            $user_data = [];
            $user = DB::table('users')->where('id', $id)->first();
            $user_data['user'] = 'User Avatar';
            $user_data['image'] = $user->avatar;
            return response()->json($user_data);
        }
    }

    # user profile
    // profile
    function profile(Request $request, $id){
        $d_data = [];
        $d_data['url'] = 'profile';
        $d_data['user'] = User::findOrfail($id);
        return view('dashboard.user.profile', $d_data);
    }

    # edit user
    public function edit($user_id) {
        $u_data = [];
        $u_data['url'] = 'edit user';
        $u_data['icon'] = 'fas fa-edit';
        $u_data['roles'] = Role::all();
        $u_data['user_role'] = DB::table('role_user')->where('user_id', $user_id)->first();
        $u_data['user'] = User::findOrfail($user_id);

        return view('dashboard.user.edit', $u_data);
    }
    # update user and role
    public function update(Request $request, $user_id) {
        $user = User::findOrfail($user_id);
        $user_avatar = [];
        $path = '';
        if ($request->hasFile('user_avatar')) {
            $file = $request->file('user_avatar');
            $file_name = time().'_'.$file->getClientOriginalName();
            if($user->avatar != '') {
                // unlink($user->avatar);
            }
            $file->move(public_path('upload/images/user'), $file_name);
            $user_avatar = $file_name;
            $path = 'upload/images/user/';
        } else {
            $user_avatar = '';
        }

        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile_number'     => ['required', 'max:20','unique:users,mobile_number'],
            'user_role'         => ['required'],
        ], [
            'user_role.required' => 'User role field is required.'
        ]);

        $user_data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $path.''.$user_avatar,
            'mobile_number' => $request->mobile_number,
        ];
        $user_role = [
            'role_id' => $request->user_role,
            'user_id' => $user->id,
            'user_type' => 'App\Models\User'
        ];
        if($user->update($user_data)){
            if(DB::table('role_user')->where('user_id', $user_id)->delete()) {
                DB::table('role_user')->insert($user_role);
            }
            Session::flash('success', 'User updated successfully');
            return redirect(route('user.index'));
        }else{
            return back()->with('fail','Something went wrong, try again later');
        }
    }
    # click delete user
    public function click_delete(Request $request){
        if(request()->ajax()) {
            $array_id = [];
            $id = $request->user_id;
            $user = User::findOrfail($id);
            if($user->avatar != '') {
                unlink($user->avatar);
            }
            if(User::where('id', $id)->delete()) {
                return response()->json(['icon' => 'success', 'success' => 1, 'msg' => 'User deleted successfully']);
            }
        }
    }
}


