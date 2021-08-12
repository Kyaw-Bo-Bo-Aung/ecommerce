<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('backend.admin.dashboard');
    }
    public function login()
    {
        return view('backend.admin.login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
    }
    public function passwordSetting()
    {
        return view('backend.admin.password-setting');
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        if (!Hash::check($request->cpassword, auth('admin')->user()->password)) {
            return back()->withErrors(['fail' => 'Wrong password']);
        }
            $id = auth('admin')->id();
            $admin = Admin::findOrFail($id);
            $admin->password = bcrypt($request->npassword);
            $admin->update();
            return redirect()->route('admin.dashboard')->with('status', 'Password updated successfully.');
    }
    public function profileSetting(){
        return view('backend.admin.profile-setting');
    }
    public function updateProfile(UpdateProfileRequest $request){
        return $request->all();
        $id = auth('admin')->id();
        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->mobile = $request->mobile;

        $admin->update();
        return redirect()->route('admin.dashboard')->with('status', 'Password updated successfully.');

    }
}
