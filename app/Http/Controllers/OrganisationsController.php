<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganisationsController extends Controller
{
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
        $input = $request->all();
        DB::beginTransaction();
        $logged_in_user = Auth::user()->load('roles');
        try {
            $create_organisation = Organisation::create(['organisation_name' => $input['organisation_name'],
                'description' => $input['description'],
                'reg_no' => $input['reg_no'],
                'location' => $input['location'],
                'email' => $input['email'],
                'website' => $input['website'],
                'contact_number' => $input['contact_number']]);
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
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    //Admin Store Organisation
    public function adminStoreOrganisation(Request $request)
    {
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
                ->with('error', 'An error occured, please contact your IT Admin .');
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
        DB::beginTransaction();
        $input = $request->all();
        try {
            $organisation->update(['organisation_name' => $input['organisation_name'],
                'description' => $input['description'],
                'reg_no' => $input['reg_no'],
                'location' => $input['location']]);

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
                ->with('error', config('constants.SUPPORT_MESSAGE'));
        }
    }

    //Delete Role
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
        DB::beginTransaction();
        $input = $request->all();
        try {
                $user->organisation()->update(['organisation_name' => $input['organisation_name'],
                    'description' => $input['description'],
                    'reg_no' => $input['reg_no'],
                    'location' => $input['location'],
                    'email' => $input['email'],
                    'website' => $input['website'],
                    'contact_number' => $input['contact_number']]);

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
                ->with('error', 'An error occured, please contact your IT Admin .');
        }

    }

}
