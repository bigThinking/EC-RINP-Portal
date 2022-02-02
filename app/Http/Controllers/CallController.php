<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\CallSignUp;
use App\Models\CallType;
use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CallController extends Controller
{
    use Media;

    //todo test-apply,edit,delete, create call report CRUD, integrate call functionality with calendar and fix view events, enforce constraints on db
    //create project view, send email receipts and fix other emails 
    //fix organisation and user profiles, organisation logo upload, implement logging- 5hrs
    public function callIndex()
    {
        $calls = Call::orderBy('closing_date')->paginate(15);
        $calls->load('organisation');
        return view('calls.call-index', compact('calls'));
    }

    //todo only show unexpired calls.
    public function callIndexOrganisation()
    {
        $logged_in_user = Auth::user()->load('roles');

        if ($logged_in_user->roles[0]->name == config('constants.ADMINISTRATOR') or $logged_in_user->roles[0]->name == config('constants.INCUBATOR') or $logged_in_user->roles[0]->name == config('constants.FACILITATOR')) {
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
            $call = Call::find($callId)->load('callSignUp', 'organisation', 'callSignUp.user', 'callSignUp.organisation');
            return view('calls.view-call', compact('call'));
        } elseif ($logged_in_user->roles[0]->name == config('constants.INNOVATOR')) {
            $call = Call::find($callId)->load('organisation');
            $showApply = CallSignUp::where('call_id', $callId)->where('user_id', $logged_in_user->id)->first() == null;
            return view('calls.view-call', compact('call', 'showApply'));
        } elseif ($logged_in_user->roles[0]->name == config('constants.FACILITATOR')) {
            $call = Call::find($callId)->load('organisation');
            if ($logged_in_user->organisation_id == $call->organisation_id) {
                $call = Call::find($callId)->load('callSignUp', 'organisation', 'callSignUp.user', 'callSignUp.organisation');
            }
            return view('calls.view-call', compact('call'));
        } else {
            abort(401);
        }
    }

    public function signUp($callId)
    {
        $logged_in_user = Auth::user()->load('roles');

        if ($logged_in_user->roles[0]->name != config('constants.INNOVATOR')) {
            return abort(401);
        }

        if(CallSignUp::where('call_id', $callId)->where('user_id', $logged_in_user->id)->first() != null)
        return response()->json(['success_message' => 'You have previously applied for this call.'], 200);

        DB::beginTransaction();
        try {
                $callSignUp = CallSignUp::create([
                    'call_id' => $callId,
                    'user_id' => $logged_in_user->id,
                    'user_organisation_id' => $logged_in_user->organisation_id,
                ]);
                $callSignUp->save();
            DB::commit();
            return response()->json(['success_message' => 'You have been successfully applied for this call. You will receive an email receipt.'], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['errors' => config('constants.SUPPORT_MESSAGE')], 200);
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

        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'closing_date' => 'required'
        ]);

        $input = $request->all();
        $fileData = $this->uploads($input['image'],'calls/');
        DB::beginTransaction();

        try {
                $create_call = Call::create(['title' => $input['title'],
                    'description' => $input['description'],
                    'call_type' => $input['call_type'],
                    'organisation_id' => $logged_in_user->organisation_id,
                    'closing_date' => $input['closing_date'],
                    'image_url' => $fileData['fileName'], 
                    'start_time' => $input['start_time'],
                    'end_time' => $input['end_time'],
                ]);
                $create_call->save();
            
            DB::commit();
            return redirect()
                ->route('view-calls')
                ->withInput()
                ->with('success_message', 'Call created successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [config('constants.SUPPORT_MESSAGE')]);
        }
    }

    public function editCall($callId)
    {
        $call = Call::find($callId);
        $call_types = CallType::All();
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

        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'closing_date' => 'required'
        ]);

        $input = $request->all();
        $fileData = $this->uploads($input['image'],'calls/');
        DB::beginTransaction();
        
        try {
                $update_call = Call::where('id', $callId)->update(['title' => $input['title'],
                    'description' => $input['description'],
                    'call_type' => $input['call_type'],
                    'closing_date' => $input['closing_date'],
                    'image_url' => $fileData['fileName'],
                    'start_time' => $input['start_time'],
                    'end_time' => $input['end_time'],
                ]);
                $update_call->save();

            DB::commit();

            return redirect()
                ->route('view-calls')
                ->withInput()
                ->with('success_message', 'Call updated successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', config(['constants.SUPPORT_MESSAGE']));
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
        } catch (Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', config('constants.SUPPORT_MESSAGE'));
        }
    }
}
