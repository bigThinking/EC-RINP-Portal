<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organisation;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use LaravelFullCalendar\Facades\Calendar;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = count(User::all());
        $organisations = count(Organisation::all());
        $events = count(Event::all());


        return view('dashboard',compact('users','organisations','events'));
    }

    public function viewAllUsers(){
        $users = User::with('organisation')->get();
        $logged_in_user = Auth::user()->load('roles');
        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'administrator') {
            return view('users.view-all-users', compact('users'));
        }
    }

    public function viewUserProfile(User $user){
        $logged_in_user = Auth::user()->load('roles');
        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'administrator') {
            return view('users.view-user-profile', compact('user'));
        }
    }

    public function viewAllOrganisations(){
        $organisation = Organisation::all();
        $organisation->load('user');

        return view('roles.organisations.view-organisations',compact('organisation'));
    }

    //View events
    public function viewEvents()
    {

        $events = Event::all();


     $calendar = Calendar::addEvents($events)->setOptions([
            'editable'    => true,
            'selectable'  => true,
            'minTime' => '05:00:00',
            'maxTime' => '22:00:00',
            'displayEventTime' => true,
        ])->setCallbacks([]);


        return view('roles.events.view-events', compact('calendar'));
    }

    public function organisationUsers(Organisation $organisation){
        $organisation->load('user');
        return view('roles.organisations.view-user-organisations',compact('organisation'));
    }

}
