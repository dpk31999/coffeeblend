<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\Role;

class SettingController extends Controller
{
    public function index()
    {   
        $admins = Admin::all();
        $roles = Role::where('name','!=','superadmin')->get();
        return view('admin.setting', compact('admins','roles'));
    }

    public function addAdmin(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            'username' => 'required|string|max:255|unique:admins',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'selectrole' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if($validator->passes())
        {
            $admin = Admin::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            $superAdmin = Role::where('name',$request->selectrole)->first();
    
            $admin->role()->attach($superAdmin);
    
            return response()->json([
                'admin' => $admin,
                'role' => $request->selectrole
            ], 200);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function deleteAdmin(Request $request)
    {
        $admin_id = $request->admin_id;

        DB::table('admins')->where('id', $admin_id)->delete();
    }

    public function getAdmin(Admin $admin)
    {   
        $role = $admin->role[0]->name;
        return response()->json([
            'admin' => $admin,
            'role' => $role
        ], 200);
    }

    public function editAdmin(Request $request,Admin $admin)
    {   
        $validator = Validator::make($request->all(),[
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'selectrole' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if($validator->passes())
        {
            $admin->username = $request->username;
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);

            $admin->save();

            if($admin->get_role()->name != $request->selectrole)
            {
                $role = Role::where('name',$admin->get_role()->name)->first();
                $admin->role()->detach($role);

                $roleEdit = Role::where('name',$request->selectrole)->first();
                $admin->role()->attach($roleEdit);
            }

            return response()->json([
                'admin' => $admin,
                'role' => $request->selectrole
            ], 200);
        }

        return \response()->json(['error'=>$validator->error()->all()]);
    }
}
