<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\User;
use App\ModelUser;
use Carbon\Carbon;

class AccessController extends Controller
{
    public function index()
    {
        $userLogged = Session::get('user');
        if ($userLogged == null) {
            return redirect('/login');
        }
        return view('pages.access');
    }
}
