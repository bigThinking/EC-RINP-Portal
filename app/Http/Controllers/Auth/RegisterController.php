<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use http\Client\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\ApproveUser;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'title' => $data['title'] ?? null,
            'surname' => $data['surname'],
            'contact_number' => $data['contact_number'],
            'job_title' => $data['job_title'],
            'is_innovator' => $data['is_innovator'] ?? null,
            'personal_profile' => $data['personal_profile'] ?? null,
            'race' => $data['race'] ?? null,
            'gender' => $data['gender'] ?? null,
            'disability' => $data['disability'] ?? null,
            'address' => $data['address'] ?? null,
            'organisation_id' => $data['organisation_id'] ?? null,
        ]);
        $role = Role::select('id')->where('name', config('constants.UNASSIGNED'))->first();
        $user->roles()->attach($role);

        Mail::to($user)->send(new Welcome($user));
        
        $admins = $admins = $users = User::whereHas('roles', function($q){
            $q->where('name', config('constants.ADMINISTRATOR'));
        })->get();

        $user->load('organisation');

        foreach($admins as $recipient){
            Mail::to($recipient)->send(new ApproveUser($user, $recipient));
        }
    }
}
