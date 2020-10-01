<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\User;
use App\ModelUser;
use Carbon\Carbon;

class UserController extends Controller
{
    //load page with $id
    public function getLogin()
    {
        if(session('user'))
        {
//            return redirect()->back();
            if(session('permission') == 0){
                return redirect('/ung-vien');
            }
            return redirect('interview-management');
        }
        else{
            return view("pages.login");
        }
    }

    public function postLogin(Request $req)
    {

        // validate
        $req->validate([
            'u_user'   => 'required',
            'u_pw'    => 'required|min:4|max:100',
        ], [
            'u_user.required'  => 'User name is required.',
            'u_pw.required'   => '',
            'u_pw.max'   => 'Password must has max 100 letters',
            'u_pw.min'   => 'Password must has min 6 letters',
        ]);

        // check user and pass
        $user = User::where('u_user',$req->u_user)
                    ->where('u_pw', $req->u_pw)->first();
            
        if (isset($user)) {
            session()->regenerate();
            session(['user' => $user]);
            session(['permission' => $user->is_admin]);
           // var_dump(session::get('permission'));die;
            if($user->is_admin == 0){
                //session(['permission' => $user->is_admin]);
                return redirect()->route('userHome');
            }
            return redirect('interview-management');
        }
        else {
            return redirect()->back()->with('danger', 'Login unsuccessfully');
        }
    }

    public function logout()
    {
        Session::forget('user');
        Session::forget('permission');
        Session::forget('key');
        if(session('user'))
        {
            return redirect()->back();
        }
        else{
            return Redirect('login');
        }
    }


    public function getChangePassword($username, $password)
    {
        if($username != null && $password != null)
        {
            $user = User::where('u_user',$username)
                    ->where('u_pw', $password)->first();

            if (isset($user)) {
                return view('pages.changepassword', compact('user'));
            }
            else{
                return redirect()->back()->with('danger', 'Please check the Username - Password');
            }
        }
        else{
            return redirect()->back()->with('danger', 'Please check the Username - Password');
        }
    }

    public function changePassword(Request $req)
    {
        // validate
        $req->validate([
            'u_user'   => 'required',
            'u_pw'    => 'required|min:4|max:8',
        ], [
            'u_user.required'  => 'User name is required.',
            'u_pw.required'   => '',
            'u_pw.max'   => 'Password must has max 8 letters',
            'u_pw.min'   => 'Password must has min 6 letters',
        ]);

        $user = User::where('u_user',$req->u_user)
                    ->where('u_pw', $req->u_pw)->first();
    
        if (isset($user)) {
            if($req->pass_new != null && $req->pass_confirm != null)
            {
                if($req->pass_new == $req->pass_confirm){

                    $sql = User::where('u_id', $user->u_id)->first();
    
                    $sql->u_pw = $req->pass_confirm;
                    $sql->save();
                    return redirect('login');
                }
                
                else{
                    return redirect()->back()->with('danger', 'Change unsuccessfully...Please check password new - password confirm');
                }
            }
            else{
                return redirect()->back()->with('danger', 'Change unsuccessfully...Please input password new - password confirm');
            }
        }
        else {
            return redirect()->back()->with('danger', 'Change unsuccessfully...Please check username - password');
        }
    }

}
