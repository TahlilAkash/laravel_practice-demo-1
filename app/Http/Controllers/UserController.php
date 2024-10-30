<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function create()
    {
        return view("registration.create");
    }
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $users = (new User)->storeUser($request);
            DB::commit();
            return redirect()->route('user.login')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function login()
    {
        return view("login.userLoginForm");
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt( $request->only('email', 'password'))) {
            $user=Auth::user();
            return view("dashboard.page",compact("user"));

        }
        else{
            return redirect()->back()->with("error","please register");
        }
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('user.login');
    }
}
