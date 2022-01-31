<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\CallSignUp;
use App\Models\CallType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CallController extends Controller
{
    //todo truncate call descriptions in indexes, upload images, do view call page, create call report view, integrate call functionality with calendar and fix view events-5hrs
    // only allow approved users to edit organisations, fix look of various forms, send email receipts and fix other emails - 3hrs
    //fix organisation and user profiles, create project view, implement logging, - 5hrs
    public function callIndex()
    {
        $calls = Call::orderBy('closing_date')->paginate(15);
        return view('calls.call-index', compact('calls'));
    }

    public function callIndexOrganisation()
    {
        $logged_in_user = Auth::user()->load('roles');

        if ($logged_in_user->roles[0]->name == config('constants.ADMINISTRATOR') or $logged_in_user->roles[0]->name == config('constants.INCUBATOR') or $logged_in_user->roles[0]->name == config('constants.constants.FACILITATOR')) {
            $calls = Call::where('organisation_id', $logged_in_user->organisation_id)->orderBy('closing_date')->paginate(15);

            return view('calls.call-index', compact('calls'));
        } else {
            abort(401);
        }

    }

    public function getCall($callId)
    {
        $call = Call::find($callId);
        return $call->toJson();
    }

    public function showCall($callId)
    {
        $logged_in_user = Auth::user()->load('roles');

        if ($logged_in_user->roles[0]->name == config('constants.ADMINISTRATOR') or $logged_in_user->roles[0]->name == config('constants.INCUBATOR')) {
            $call = Call::find($callId)->load('callSignUp', 'organisation');
            return view('calls.view-call', compact('call'));
        } elseif ($logged_in_user->roles[0]->name == config('constants.INNOVATOR')) {
            $call = Call::find($callId)->load('organisation');
            return view('calls.view-call', compact('call'));
        } elseif ($logged_in_user->roles[0]->name == config('constants.FACILITATOR')) {
            $call = Call::find($callId)->load('organisation');
            if ($logged_in_user->organisation_id == $call->organisation_id) {
                $call = Call::find($callId)->load('callSignUp', 'organisation');
            }
            return view('calls.view-call', compact('call'));
        } else {
            abort(401);
        }
    }

    public function signUp($callId, $userId)
    {
        $logged_in_user = Auth::user()->load('roles');

        if ($logged_in_user . id != $userId or $logged_in_user->roles[0]->name != config('constants.INNOVATOR')) {
            return abort(401);
        }

        DB::beginTransaction();
        try {
                $callSignUp = CallSignUp::create([
                    'call_id' => $callId,
                    'user_id' => $userId,
                    'user_organisation_id' => $logged_in_user->organisation_id,
                ]);
                $callSignUp . save();
            DB::commit();
            return redirect()
                ->route('view-calls')
                ->withInput()
                ->with('success_message', 'You have been successfully applied for this call. You will receive an email receipt.');
        } catch (\Exception$e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', config('constants.SUPPORT_MESSAGE'));
        }
    }

    public function createCall()
    {
        $logged_in_user = Auth::user()->load('roles');
        $call_types = CallType::All();

        if ($logged_in_user->roles[0]->name == config('constants.ADMINISTRATOR') or $logged_in_user->roles[0]->name == config('constants.INCUBATOR') or $logged_in_user->roles[0]->name == config('constants.FACILITATOR')) {
            return view('calls.create-call', compact('call_types'));
        } else {
            abort(401);
        }

    }

    //save function for createCall
    public function saveCall(Request $request)
    {
        $logged_in_user = Auth::user()->load('roles');

        if ($logged_in_user->roles[0]->name != config('constants.ADMINISTRATOR') and $logged_in_user->roles[0]->name != config('constants.INCUBATOR') and $logged_in_user->roles[0]->name != config('constants.FACILITATOR')) {
            abort(401);
        }

        $input = $request->all();
        DB::beginTransaction();
        try {
                $create_Call = Call::create(['title' => $input['title'],
                    'description' => $input['description'],
                    'call_type' => $input['call_type'],
                    'organisation_id' => $logged_in_user->organisation_id,
                    'closing_date' => $input['closing_date'],
                    'start_time' => $input['start_time'],
                    'end_time' => $input['end_time'],
                ]);
                $create_call->save();
            
            DB::commit();
            return redirect()
                ->route('view-calls')
                ->withInput()
                ->with('success_message', 'Call created successfully.');
        } catch (\Exception$e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', config('constants.SUPPORT_MESSAGE'));
        }
    }

    public function editCall($callId)
    {
        $call = Call::find($callId);
        $logged_in_user = Auth::user()->load('roles');

        if ($logged_in_user->organisation_id != $call->organisation_id) {
            abort(401);
        }

        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == config('constants.ADMINISTRATOR') or $logged_in_user->roles[0]->name == config('constants.INCUBATOR') or $logged_in_user->roles[0]->name == config('constants.FACILITATOR')) {
            return view('calls.create-call', compact('call', 'call_types'));
        }

    }

    //save function for editCall
    public function updateCall(Request $request, $callId)
    {
        $logged_in_user = Auth::user()->load('roles');
        if ($logged_in_user->organisation_id != $call->organisation_id or ($logged_in_user->roles[0]->name != config('constants.ADMINISTRATOR') and $logged_in_user->roles[0]->name != config('constants.INCUBATOR') and $logged_in_user->roles[0]->name == config('constants.FACILITATOR'))) {
            abort(401);
        }

        DB::beginTransaction();
        $input = $request->all();
        try {
            //Check if logged in user is admin, else return 404
                $update_Call = Call::where('id', $callId)->update(['title' => $input['title'],
                    'description' => $input['description'],
                    'call_type' => $input['call_type'],
                    'organisation_id' => $logged_in_user->organisation_id,
                    'closing_date' => $input['closing_date'],
                    'start_time' => $input['start_time'],
                    'end_time' => $input['end_time'],
                ]);
                $update_call->save();

            DB::commit();

            return redirect()
                ->route('view-calls')
                ->withInput()
                ->with('success_message', 'Call updated successfully.');
        } catch (\Exception$e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', config('constants.SUPPORT_MESSAGE'));
        }
    }

    public function deleteCall($callId)
    {
        $call = Call::find($callId);
        $logged_in_user = Auth::user()->load('organisation');

        if ($logged_in_user->organisation_id != $call->organisation_id or ($logged_in_user->roles[0]->name != config('constants.ADMINISTRATOR') and $logged_in_user->roles[0]->name != config('constants.INCUBATOR') and $logged_in_user->roles[0]->name != config('constants.FACILITATOR'))) {
            abort(401);
        }

        DB::beginTransaction();
        try {
                $call->forceDelete();
                DB::commit();
                return redirect()->route('view-calls')
                    ->withInput()
                    ->with('success_message', 'Call deleted.');
        } catch (\Exception$e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', config('constants.SUPPORT_MESSAGE'));
        }
    }
}
