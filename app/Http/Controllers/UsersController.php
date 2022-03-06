<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organisation;
use App\Models\Project;
use App\Models\ProjectStage;
use App\Models\Stage;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserApproved;
use Calender;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    //users index
    public function usersIndex(){
        $users = User::all();
        $users_array = [];

        foreach ($users as $user) {
            $user->load('organisation');
            $object = (object)['title' => $user->title,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'contact_number' => $user->contact_number,
                'job_title' => $user->job_title,
                'role' => isset($user->roles[0]) ? $user->roles[0]->name: 'No role assigned',
                'is_approved' => isset($user->is_approved) ? $user->is_approved: 'Not approved',
                'organisation_name' => isset($user->organisation) ? $user->organisation->organisation_name: 'No organisation',
                'id' => $user->id];
            array_push($users_array, $object);
        }
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator') {
            return view('users.users-index', compact('users', 'users_array'));
        }
    }

    //Approve user
    public function adminEditUser(User $user){
        $organisation = Organisation::all();
        $roles = Role::all();
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator') {
            return view('users.admin-approve-user', compact('user', 'organisation', 'roles'));
        }
    }
    //Update user approval
    public function updateUserApproval(Request $request, User $user)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            if ($request->has('role_id')) {

                $user->update(['is_approved' => $input['is_approved'],'organisation_id' => $input['organisation_id']]);

                $user->roles()->sync($input['role_id']);
                $user->save();
                DB::commit();

                if($input['is_approved'] == 'Yes')
                Mail::to($user)->send(new UserApproved($user));

                return redirect()
                    ->to('user-index')
                    ->withInput()
                    ->with('success_message', 'User Update successfully.');
            } else {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors([config(['constants.SUPPORT_MESSAGE'])]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
            ->back()
            ->withInput()
            ->withErrors([config(['constants.SUPPORT_MESSAGE'])]);
        }
    }

    //Create user roles
    public function createRole(){
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.role-crud.create-roles');
        }
    }

    //Store user roles
    public function storeUserRole(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();

        try {
            $create_role = Role::create(['name' => $input['name'], 'display_name' => $input['name'], 'guard_name' => 'web',
                'permissions' => [
                    'name-delete' => true,
                    'name-add' => true,
                    'name-update' => true,
                    'name-view' => true,
                ]]);
            $create_role->save();
            DB::commit();
            return redirect()
                ->to('user-role-index')
                ->withInput()
                ->with('success_message', 'Role added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    //User roles index
    public function userRolesIndex(){
        $roles = Role::all();
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.role-crud.user-roles-index', compact('roles'));
        }
    }

    //Edit role
    public function editUserRole(Role $role){
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.role-crud.edit-role', compact('role'));
        }
    }

    //Update user roles
    public function updateRole(Request $request, Role $role)
    {
        DB::beginTransaction();
        $input = $request->all();
        try {
            $role->update(['display_name' => $input['display_name']]);

            $role->save();

            DB::commit();

            return redirect()
                ->to('user-role-index')
                ->withInput()
                ->with('success_message', 'Role updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    //Delete Role
    public function adminDeleteUserRole(Role $role){
        $users = Auth::user()->load('roles');

            try {
                DB::beginTransaction();
                $role->forceDelete();
                DB::commit();

                return response()->json(['message' => 'Successfully deleted role.'], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
            }

    }

    //Delete Role
    public function adminDeleteUser(User $user){

            try {
                DB::beginTransaction();
                $user->forceDelete();
                DB::commit();

                return response()->json(['message' => 'Successfully deleted user.'], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
            }

    }

    //View user info
    public function viewUserInfo(User $user){
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator') {
            return view('users.view-user-info', compact('user'));
        }
    }

    //events
    public function createEvent()
    {
        $events = Event::all();

      /*  $calendar = \Calendar::addEvents($events)->setCallbacks(['eventClick' => 'function(calEvent, jsEvent, view){

        }']);*/

        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff') {
            return view('roles.events.create-events', compact('events'));
        }
    }

    //Store uevents
    public function storeEvents(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();

        try {
            $create_event = Event::create(['title' => $input['title'], 'all_day' => $input['all_day'],
                'start' => $input['start'],'end' => $input['end'],'type' => $input['type'],
                'start_time' => $input['start_time'],'end_time' => $input['end_time']]);
            $create_event->save();
            DB::commit();
            return redirect()
                ->to('get-events')
                ->withInput()
                ->with('success_message', 'Event added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    //Event index
    public function eventIndex(){
        $events = Event::all();
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff') {
            return view('roles.events.events-index', compact('events'));
        }
    }
  //Delete user
    public function destroyUserAndProject($id)
    {
        DB::beginTransaction();
        $user = User::find($id);

        try {
            $user->load('project');
            if (isset($user->project)){
                $user->project->forceDelete();
            }else {
                $user->forceDelete();
            }
            DB::commit();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User can not be deleted ' . $e->getMessage(), 'user' => $user->load('answers')], 500);
        }
    }

    //Delete event
    public function deleteEvent(Event $event){

        try {
            DB::beginTransaction();
            $event->forceDelete();
            DB::commit();

            return response()->json(['message' => 'Successfully deleted event.'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 400);
        }

    }

    //Edit event
    public function editEvent(Event $event){
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff') {
            return view('roles.events.edit-event', compact('event'));
        }
    }

    //Update event
    public function updateEvent(Request $request, Event $event)
    {
        DB::beginTransaction();
        $input = $request->all();
        try {
            $event->update(['title' => $input['title'],'all_day' => $input['all_day']
                ,'start' => $input['start'],'end' => $input['end'],'start_time' => $input['start_time']
                ,'end_time' => $input['end_time'],'type' => $input['type']]);

            $event->save();

            DB::commit();

            return redirect()
                ->to('get-events')
                ->withInput()
                ->with('success_message', 'Event updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }



}
