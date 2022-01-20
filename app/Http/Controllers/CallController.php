<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Call;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CallController extends Controller
{
    public function callIndex(){
        $calls = Call::all();
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff') {
            return view('calls.call-index', compact('calls'));
        }
    }

}