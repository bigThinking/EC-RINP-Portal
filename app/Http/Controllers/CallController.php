<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Call;
use App\Models\CallSignUp;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CallController extends Controller
{
    public function callIndex(){
        $logged_in_user = Auth::user()->load('roles');
        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff') {
        $calls = Call::orderBy('closing_date')->paginate(15);
      
        return view('calls.call-index', compact('calls'));
        }
    }

    public function callIndexOrganisation(){
        $logged_in_user = Auth::user()->load('roles');
        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff') {
        $calls = Call::where('organisation_id', $logged_in_user->organisation_id)->orderBy('closing_date')->paginate(15);
       
        return view('calls.call-index', compact('calls'));
        }
    }

    public function getCall($callId)
    {
       $call = Call::find($callId);
       return $call->toJson();
    }

    public function signUp($callId, $userId)
    {
        $logged_in_user = Auth::user()->load('roles');

        if($logged_in_user.id != $userId)
        return response()->json(['message' => 'Server error'], 200);

        $callSignUp = CallSignUp::create([
            'call_id' => $callId,
            'user_id' => $userId,
            'user_organisation_id' => $logged_in_user->organisation_id,
        ]);
        $callSignUp.save();

        if($callSignUp != null)
        return response()->json(['message' => 'You have been successfully signed up for this call. You will receive an email with more information.'], 200);
    }

    public function createCall()
    {
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'Facilitator')
            return view('calls.create-call');
    }

    public function saveCall(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        $logged_in_user = Auth::user()->load('roles');

        try {
            //Check if logged in user is admin, else return 404
            if ($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'Facilitator') {
                $create_Call = Call::create(['title' => $input['project_name'],
                    'description' => $input['description'],
                    'call_type' => $logged_in_user->name,
                    'organisation_id'=>$logged_in_user->organisation_id, 
                    'closing_date'=>$input['closing_date'],
                    'start_time' => $input['start_time'],
                    'end_time' => $input['end_time']
                ]);
                $create_call->save();
            }
            DB::commit();
            return redirect()
                ->route('view-calls')
                ->withInput()
                ->with('success_message', 'Project created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    public function deleteCall($callId)
    {
        $call = Call::find('id', $callId);
        $logged_in_user = Auth::user()->load('organisation');

        if($logged_in_user->organisation[0]->id != $call->organisation_id)
        return response()->json(['message' => 'Server error'], 200);

        if ($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'Facilitator'){
        $call->forceDelete();
        return response()->json(['message' => 'Call has been deleted.'], 200);
        }
    }

    public function editCall($callId)
    {
        $call = Call::find('id', $callId);
        $logged_in_user = Auth::user()->load('roles');

        if($logged_in_user->organisation_id != $call->organisation_id)
        return response()->json(['message' => 'Server error'], 200);

        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'Facilitator')
            return view('calls.create-call');
    }

    public function updateCall(Request $request, $callId)
    {
        DB::beginTransaction();
        $input = $request->all();
        try {
             //Check if logged in user is admin, else return 404
            if ($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'Facilitator') {
                $update_Call = Call::where('id', $callId)->update(['title' => $input['project_name'],
                    'description' => $input['description'],
                    'call_type' => $logged_in_user->name,
                    'organisation_id'=>$logged_in_user->organisation_id, 
                    'closing_date'=>$input['closing_date'],
                    'start_time' => $input['start_time'],
                    'end_time' => $input['end_time']
                ]);
                $update_call->save();
            }

            DB::commit();

            return redirect()
                 ->route('view-calls')
                ->withInput()
                ->with('success_message', 'Project updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }
}