<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\User;
use App\Models\Call;
use App\Models\Timeline;
use App\Models\ProjectStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\Media;
use Illuminate\Support\Facades\Log;

class OrganisationsController extends Controller
{
    use Media;

    //Add organisation
    public function createOrganisation()
    {
        return view('roles.organisations.create-organizations');
    }

    //Admin Add organisation
    public function adminCreateOrganisation()
    {
        return view('roles.organisations.admin-create-organisation');
    }

    //Store Organisation
    public function storeOrganisation(Request $request)
    {
        $request->validate([
            'organisation_name' => 'required|min:3|max:50',
            'description' => 'required|min:10|max:500',
            'organisation_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|max:14',
        ]);

        $input = $request->all();
        $fileData = $this->uploads($input['organisation_logo'],'org_logos/');
        DB::beginTransaction();
        $logged_in_user = Auth::user()->load('roles');
        try {
            $create_organisation = Organisation::create(['organisation_name' => $input['organisation_name'],
                'description' => $input['description'],
                'reg_no' => $input['reg_no'],
                'location' => $input['location'],
                'email' => $input['email'],
                'website' => $input['website'],
                'contact_number' => $input['contact_number'],
                'logo_url' => $fileData['fileName']]);
            $create_organisation->save();
            $logged_in_user->update(['organisation_id' => $create_organisation->id]);
            DB::commit();
            return redirect()
                ->to('create-organisation')
                ->withInput()
                ->with('success_message', 'Organisation added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([config('constants.SUPPORT_MESSAGE')]);
        }
    }

    //Admin Store Organisation
    public function adminStoreOrganisation(Request $request)
    {
        $request->validate([
            'organisation_name' => 'required|min:3|max:50',
            'description' => 'required|min:10|max:500',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|max:14',
        ]);

        $input = $request->all();
        DB::beginTransaction();
        try {
            $create_organisation = Organisation::create(['organisation_name' => $input['organisation_name'],
                'description' => $input['description'],
                'reg_no' => $input['reg_no'],
                'location' => $input['location'],
                'email' => $input['email'],
                'website' => $input['website'],
                'contact_number' => $input['contact_number']]);
            $create_organisation->save();
            DB::commit();
            return redirect()
                ->to('organisation-index')
                ->withInput()
                ->with('success_message', 'Organisation added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([config('constants.SUPPORT_MESSAGE')]);
        }
    }

    //Organisation index
    public function organisationIndex()
    {
        $organisation = Organisation::all();
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.organisations.organisation-index', compact('organisation'));
        }
    }

    //Edit organisation
    public function editOrganisation(Organisation $organisation)
    {
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.organisations.edit-organisation', compact('organisation'));
        }
    }

    //Update organisation
    public function updateOrganisation(Request $request, Organisation $organisation)
    {
        // Log::info($request);
        $request->validate([
            'organisation_name' => 'required|min:3|max:50',
            'description' => 'required|min:10|max:500',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|max:14',
            'organisation_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        $fileData = null;
        if(isset($input['organisation_logo']))
        $fileData = $this->uploads($input['organisation_logo'],'org_logos/');

        DB::beginTransaction();

        try {
            $organisation->update(['organisation_name' => $input['organisation_name'],
            'description' => $input['description'],
            'reg_no' => $input['reg_no'],
            'location' => $input['location'],
            'email' => $input['email'],
            'website' => $input['website'],
            'contact_number' => $input['contact_number'],
            'logo_url' =>  $fileData != null ? $fileData['fileName'] : '']);

            $organisation->save();
            DB::commit();

            return redirect()
                ->to('organisation-index')
                ->withInput()
                ->with('success_message', 'Organisation updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([config('constants.SUPPORT_MESSAGE')]);
        }
    }

    //Delete Organisation
    public function adminDeleteOrganisation(Organisation $organisation)
    {
        try {
            DB::beginTransaction();
            $organisation->forceDelete();
            DB::commit();

            return response()->json(['message' => 'Successfully deleted organisation.'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    //update users organisation
    public function editUserOrganisation(User $user)
    {
        $user->load('organisation');

        return view('roles.organisations.edit-user-organisation', compact('user'));
    }

    //Update organisation
    public function updateUserOrganisation(Request $request, User $user)
    {
        // Log::info($request);
        $request->validate([
            'organisation_name' => 'required|min:3|max:50',
            'description' => 'required|min:10|max:500',
            'organisation_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|max:14',
        ]);

        $input = $request->all();

        $fileData = null;
        if(isset($input['organisation_logo']))
        $fileData = $this->uploads($input['organisation_logo'],'org_logos/');

        DB::beginTransaction();

        try {
                $user->organisation()->update(['organisation_name' => $input['organisation_name'],
                    'description' => $input['description'],
                    'reg_no' => $input['reg_no'],
                    'location' => $input['location'],
                    'email' => $input['email'],
                    'website' => $input['website'],
                    'contact_number' => $input['contact_number'],
                    'logo_url' =>  $fileData != null ? $fileData['fileName'] : '']);

            DB::commit();

            return redirect()
                ->route('editUserOrganisation',$user->id)
                ->withInput()
                ->with('success_message', 'Organisation updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([config('constants.SUPPORT_MESSAGE')]);
        }

    }

    public function getOrganisationProfile(Organisation $organisation)
    {
        $organisation->load('user', 'project');

        return view('roles.organisations.organisation-profile', compact('organisation'));
    }

    public function getProjectTimeline(Organisation $organisation)
    {
        $organisation->load('user', 'project', 'project.projectstages', 'project.projectstages.task', 'project.projectstages.task.taskReply',  'project.projectstages.graduation','callSignUp', 'callSignUp.callSignUpReport');
        
        $users = $organisation->user;
        $project = $organisation->project;
        $projectStages = $organisation->project->projectStages->sortBy('creation_date');
        $callSignUps = $organisation->callSignUp->groupBy('call_id')->sortBy('creation_date');
        $calls = Call::All()->whereIn('id', $callSignUps->keys());
        $stages= ProjectStage::All();

        $timeline = array();
       
        foreach($projectStages as $stage)
        {
          $timeline[] = Timeline::makeStage($stage);

          if($stage->graduate != null)
          $timeline[] = Timeline::makeGraduation($stage->graduate);

          $tasks = $stage->task->sortBy('creation_date');
          foreach($tasks as $task)
          {
            $timeline[] = Timeline::makeTask($task);
          }
        }       

        foreach($callSignUps as $call)
        {
          $timeline[] = Timeline::makeCall($call);
        }

        $timeline = collect($timeline)->sortBy(function ($temp, $key) {
            return $temp->top_date->getTimestamp();
        });

        Log::info($timeline);
        return view('roles.project.project-timeline', compact('organisation', 'users', 'project', 'calls', 'timeline', 'stages'));
    }

}
