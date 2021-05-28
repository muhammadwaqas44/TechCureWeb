<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserPermission;
use App\Models\Permission;
use Storage;
use Mail;
use Auth;
use URL;
use Illuminate\Http\File;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Rules\EmailMustHaveTLD;


class UserController extends Controller
{

    // show list of all users
    public function index()
    {
        $user = Auth::user();

        $users = User::where('id', '!=', $user->id)
        ->where('id', '!=', 1)
        ->orderBy('id', 'DESC')
        ->get();

        return view('admin.users.index', ['users' => $users, 'title' => 'Users']);
    }


    // create new user
    public function create()
    {
        $permissions = Permission::get();
        return view('admin.users.create', ['permissions' => $permissions, 'title' => 'Create User']);
    }


    // store new user
    public function store(Request $request)
    {
        
        $rules = [
            'name' => 'required|max:191',
            'email' => ['required', 'email', 'unique:users' , new EmailMustHaveTLD],
            'password' => 'required_with:confirm_password|same:confirm_password|min:6',
            'permissions' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ];

        $user = User::create($userData);

        $user->permissions()->sync($request->permissions);

        return redirect()->route('userList')->with('success-message', 'Record Added Successfully.');
    }


    //edit user
    public function edit($id)
    {
        $user = User::where('id', $id)->where('id', '!=', 1)->first();
        $permissions = Permission::all();
        return view('admin.users.edit', ['title' => 'Edit User', 'user' => $user, 'permissions' => $permissions]);
    }


    // udpate user
    public function update(Request $request)
    {
        $user = User::where('id', $request->user_id)
        ->first();

        $rules = [
            'name' => 'required|max:191',
            'email' => 'email',
            'permissions' => 'required',
            'status' => 'required',
        ];

        if (!empty($request->password)) {
            $rules['password'] = 'required_with:confirm_password|same:confirm_password|min:6';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $userData = [
            'name' => $request->name,
            'status' => $request->status,
        ];

        if (!empty($request->password) && !empty($request->confirm_password)) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        $user->permissions()->sync($request->permissions);

        return redirect()->route('userList')->with('success-message', 'Record Updated Successfully.');
    }

    // Change Status of the User
    public function changeUserStatus(Request $request)
    {
        $user = User::find($request->id);

        if($user == null) {
            return response()->json(['status' => 0]);
        }

        $user->update(['status' => $request->status]);

        return response()->json(['status' => 1]);
    }

    // Delete User
    public function delete(Request $request)
    {
        $user = User::find($request->id);

        if ($user == null) {
            return response()->json(['status' => 0]);
        }

        $userPermissions = UserPermission::where('user_id', $user->id)->delete();

        $user->delete();

        return response()->json(['status' => 1]);
    }

}