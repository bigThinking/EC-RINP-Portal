<?php

namespace App\Http\Controllers;

use App\Models\GraduationStage;
use App\Models\Project;
use App\Models\ProjectStage;
use App\Models\Stage;
use App\Models\Task;
use App\Models\TaskReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    //Add project
    public function createProject()
    {
        $logged_in_user = Auth::user()->load('roles');

        if ($logged_in_user->roles[0]->name == 'innovator') {
            return view('roles.project.create-project');
        }else {
            return response('<img style="margin-left: 200px;margin-top: 20vh" src="images/not authorised.png">');
        }

    }

    //Store project
    public function storeProject(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        $logged_in_user = Auth::user()->load('roles','project');

        try {
            //Check if logged in user is admin, else return 404
            if ($logged_in_user->roles[0]->name == 'innovator') {
                $create_project = Project::create(['project_name' => $input['project_name'],
                    'description' => $input['description'],
                    'memberName' => $logged_in_user->name,'organisation_id'=>$logged_in_user->organisation_id
                ]);
                $create_project->save();
                $logged_in_user->update(['project_id'=>$create_project->id]);
            }
            DB::commit();
            return redirect()
                ->route('edit-user-project',$logged_in_user->id)
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

    //update users project
    public function editUserProject(User $user){
        $logged_in_user = Auth::user()->load('roles', 'organisation.project');

        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'innovator') {
            return view('roles.project.edit-project', compact('user'));
        }else {
            return response('<img style="margin-left: 200px;margin-top: 20vh" src="images/not authorised.png">');
        }
    }

    //Update project
    public function updateUserProject(Request $request, User $user)
    {
        DB::beginTransaction();
        $input = $request->all();
        try {
            $user->organisation()->project()->update(['project_name' => $input['project_name'],
                'description' => $input['description']]);

            $user->save();

            DB::commit();

            return redirect()
                ->route('edit-user-project',$user->id)
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

    //Project index
    public function projectIndex(){
        $project = Project::all();
        $project_array = [];

        foreach ($project as $projects) {
            $projects->load('stages','organisation');
            $object = (object)['project_name' => $projects->project_name,
                'description' => $projects->description,
                'memberName' => $projects->memberName,
                'organisation_name' => isset($projects->organisation) ? $projects->organisation->organisation_name: 'No organisation assigned',
                'project_closed' => isset($projects->project_closed) ? $projects->project_closed: 'No',
                'id' => $projects->id];
            array_push($project_array, $object);
        }

        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator' or $logged_in_user->roles[0]->name == 'Incubator staff') {
            return view('roles.project.project-index', compact('project','project_array'));
        }
    }

    //Add project
    public function createProjectStage()
    {
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.project-stages.create-project-stage');
        }else {
            return response('<img style="margin-left: 200px;margin-top: 20vh" src="images/not authorised.png">');
        }

    }

    //Store project
    public function storeProjectStage(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();

        try {

            $create_project = ProjectStage::create(['project_stage' => $input['project_stage']
            ]);
            $create_project->save();

            DB::commit();
            return redirect()
                ->to('project-stage-index')
                ->withInput()
                ->with('success_message', 'Project stage created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    //Project stage index
    public function projectStageIndex(){
        $project_stage = ProjectStage::all();
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.project-stages.project-stage-index', compact('project_stage'));
        }
    }

    //Delete project stage
    public function adminDeleteUser(ProjectStage $projectStage){

        try {
            DB::beginTransaction();
            $projectStage->forceDelete();
            DB::commit();

            return response()->json(['message' => 'Successfully deleted stage.'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 400);
        }

    }

    //update users project stage
    public function editProjectStage(ProjectStage $projectStage){
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.project-stages.edit-project-stage', compact('projectStage'));
        }
    }

    //Update project stage
    public function updateProjectStage(Request $request, ProjectStage $projectStage)
    {
        DB::beginTransaction();
        $input = $request->all();
        try {
            $projectStage->update(['project_stage' => $input['project_stage']]);

            $projectStage->save();

            DB::commit();

            return redirect()
                ->route('project-stage-index')
                ->withInput()
                ->with('success_message', 'Project stage updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    //incubatee staff update users project
    public function incubateeEditUserProject(Project $project){
        $project_stage = ProjectStage::all();
        $logged_in_user = Auth::user()->load('roles');
        $users = User::with('roles')->get();
        $project->load('stages','user');
        $stageProject = $project->stages;
        $stageProject->load('stageProject');

        $stages = Stage::all()->where('project_id',$project->id);;
        $project_array = [];

        foreach ($stages as $stage) {
            $stage->load('project','projectStages')->get();
            $object = (object)[
                'project_name' => isset($stage->project) ? $stage->project->project_name: 'No name',
                'memberName'=> isset($stage->project->memberName) ? $stage->project->memberName : 'No Name',
                'project_stage'=>isset($stage->projectStages->project_stage) ? $stage->projectStages->project_stage : 'None',
                'start_date' => $stage->start_date,
                'end_date' => $stage->end_date,
                'stage_description' => $stage->stage_description,
                'stageClosed' => isset($stage->stageClosed) ? $stage->stageClosed: 'No',
                'id' => $stage->id];
            array_push($project_array, $object);
        }

        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.project.incubatee-edit-project', compact('project','project_stage',
                'users','stageProject','stages','project_array'));
        }
    }

    //Incubatee Update project
    public function incubatorUpdateProject(Request $request, Project $project)
    {
        DB::beginTransaction();
        $input = $request->all();
        try {

            $project->update(['project_stage_id' => $input['project_stage_id'],'start_date'=>$input['start_date'],
                'end_date'=>$input['end_date'],'stage_description'=>$input['stage_description'],
                'progress_summary'=>$input['progress_summary'],'graduation_date'=>$input['graduation_date']]);

            $project->save();

            DB::commit();

            return redirect()
                ->route('project-index')
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

    //Stages
    public function createStages(){
        $project_stages = ProjectStage::all();
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'Incubator staff') {
            return view('roles.project-stages.create-stages',compact('project_stages'));
        }

    }

    //Store stage
    public function storeStage(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();

        try {

            $create_project = Stage::create(['start_date' => $input['start_date'],'end_date'=>$input['end_date'],
                'stage_description'=>$input['stage_description'],'project_stage_id'=>$input['project_stage_id']
            ]);
            $create_project->save();

            DB::commit();
            return redirect()
                ->to('stages-index')
                ->withInput()
                ->with('success_message', 'Project stage created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    // stage index
    public function stageIndex(){
        $stages = Stage::all();
        $stage_array = [];

        foreach ($stages as $stage) {
            $stage->load('project','projectStages')->get();
            $object = (object)[
                'project_name' => isset($stage->project) ? $stage->project->project_name: 'No name',
                'memberName'=> isset($stage->project->memberName) ? $stage->project->memberName : 'No Name',
                'project_stage'=>$stage->projectStages->project_stage,
                'start_date' => $stage->start_date,
                'end_date' => $stage->end_date,
                'stage_description' => $stage->stage_description,
                'id' => $stage->id];
            array_push($stage_array, $object);
        }
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'Incubator staff') {
            return view('roles.project-stages.stages-index', compact('stage_array'));
        }
    }

    //Edit stage
    public function editStage(Stage $stage){
        $logged_in_user = Auth::user()->load('roles');
        $stage->load('projectStages');
        $project_stage = ProjectStage::all();

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'administrator' ) {
            return view('roles.project-stages.edit-stages', compact('stage','project_stage'));
        }
    }

    //Update  stage
    public function updateStage(Request $request, Stage $stage)
    {
        DB::beginTransaction();
        $input = $request->all();
        try {
            $stage->update($request->all());


            $stage->save();

            DB::commit();

            return redirect()
                ->route('edit-stages',$stage->id)
                ->withInput()
                ->with('success_message', 'Stage updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }


    //PROJECT STAGE
    public function incubateeStoreProjectStage(Request $request, Project $project)
    {
        DB::beginTransaction();
        $input = $request->all();
        try {

            $project_stage = Stage::create(['project_id' => $project->id,
                'start_date' => $input['start_date'],'end_date' => $input['end_date'],
                'stage_description' => $input['stage_description'],'project_stage_id' => $input['project_stage_id']]);

            $project->update(['project_stage_id' => $input['project_stage_id']]);
            DB::commit();

            return redirect()
                ->route('incubatee-edit-user-project',$project->id)
                ->withInput()
                ->with('success_message', 'Project stage added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    //GRADUATION STAGE
    public function incubateeStoreGraduationStage(Request $request, Stage $stage)
    {
        DB::beginTransaction();
        $input = $request->all();
        $stage->load('project','projectStages');
        try {

            $graduation = GraduationStage::create(['previous_stage'=>$stage->projectStages->project_stage,
                'next_stage_name'=> $input['next_stage_name'],'progress_summary'=> $input['progress_summary'],
                'graduation_date'=> $input['graduation_date'],'stage_id'=>$stage->id,
                'project_stage_id'=>$stage->project_stage_id,'project_id'=>$stage->project->id,
                'project_name'=>$stage->project->project_name,'stageGraduated'=>'Yes']);

            $stage->project()->update(['graduation_id'=>$graduation->graduation_id]);
            $stage->update(['stageClosed'=>'Yes']);


            $stages = Stage::create([
                'start_date'=>$input['start_date'],
                'end_date'=>$input['end_date'],'stage_description'=>$input['stage_description']
                ,'project_stage_id' => $input['project_stage_id'],'project_id'=>$stage->project->id,
                'graduation_id'=>$graduation->id]);


            DB::commit();

            return redirect()
                ->route('graduate-stage',$stage->id)
                ->withInput()
                ->with('success_message', 'Graduation stage added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    //STAGE TASK
    public function incubateeStoreProjectStageStask(Request $request, Stage $stage)
    {
        DB::beginTransaction();
        $input = $request->all();
        $stage->load('project')->get();
        $project = $stage->project;

        $services = $request->input('user_id');



        try {
            foreach($services as $service) {
                $task = Task::create(['title' => $input['title'],
                    'description' => $input['description'], 'last_updated_date' => $input['last_updated_date'],
                    'user_id' => $service,
                    'stage_id' => $stage->id,
                    'project_stage_id' => $stage->project_stage_id, 'project_name' => $project->project_name,
                    'project_id' => $project->id, 'project_description' => $project->description]);
                $task->save();
            }

            DB::commit();

            return redirect()
                ->to('view-tasks', $stage->id)
                ->withInput()
                ->with('success_message', 'Task added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    // Graduationstage index
    public function graduationStageIndex(){
        $graduationStage = GraduationStage::all();
        $graduation_stage_array = [];

        foreach ($graduationStage as $graduationStages) {
            $graduationStages->load('projects','projectStage','stage')->get();
            $object = (object)[
                'project_name' => isset($graduationStages->projects) ? $graduationStages->projects->project_name: 'No name',
                'project_stage' => isset($graduationStages->projectStage) ? $graduationStages->projectStage->project_stage: 'No name',
                'next_stage_name' => isset($graduationStages) ? $graduationStages->next_stage_name: 'No name',
                'progress_summary'=> isset($graduationStages) ? $graduationStages->progress_summary : 'No Name',
                'graduation_date'=> isset($graduationStages) ? $graduationStages->graduation_date : 'No date',
                'id' => $graduationStages->id];
            array_push($graduation_stage_array, $object);
        }
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'Incubator staff') {
            return view('roles.project-stages.graduation-stage-index', compact('graduation_stage_array'));
        }
    }

    // Tak index
    public function projectStageTaskIndex(){
        $task = Task::all();
        $task_array = [];

        $logged_in_user = Auth::user()->load('roles','task');
        $task = $logged_in_user->task;

        foreach ($task as $tasks) {
            $tasks->load('projects','projectsStage','user')->get();
            $object = (object)[
                'title' => isset($tasks->title) ? $tasks->title: 'No title',
                'description' => isset($tasks->description) ? $tasks->description: 'No description',
                'last_updated_date' => isset($tasks) ? $tasks->last_updated_date: 'No date',
                'name' => isset($tasks->user) ? $tasks->user->name: 'No name',
                'surname' => isset($tasks->user) ? $tasks->user->surname: 'No surname',
                'project_name' => isset($tasks->project_name) ? $tasks->project_name: 'None',
                'project_stage' => isset($tasks->projectsStage) ? $tasks->projectsStage->project_stage: 'No Stage',
                'is_replied' => isset($tasks->is_replied) ? $tasks->is_replied: 'Awaiting response..',
                'isClosed' => $tasks->isClosed ? 'Yes' : 'No',
                'isDone' => $tasks->isDone ? 'Yes' : 'No',
                'id' => $tasks->id];
            array_push($task_array, $object);
        }

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == config('constants.FACILITATOR')) {
            return view('roles.project-stages.task-index', compact('task_array'));
        }
    }


    //Project is closed
    public function updateProjectStatus(Request $request,Project $project)
    {
        DB::beginTransaction();

        try {
            $project->project_closed = 'Yes';
            $project->save();

            DB::commit();

            return redirect()
                ->route('incubatee-edit-user-project', $project->id)
                ->withInput()
                ->with('success_message', 'Project closed successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    //View task
    public function viewTask(Stage $stage){

        $users = User::whereHas('roles', function($q){
            $q->where('name', 'Facilitator');
        })->get();

        $stage->load('task','project')->get();

        $task = $stage->task;

        $task_array_two = [];

        foreach ($task as $tasks) {
            $tasks->load('projectsStage','user','projects')->get();

            $object = (object)[
                'title' => isset($tasks) ? $tasks->title: 'No title',
                'description' => isset($tasks) ? $tasks->description: 'No description',
                'last_updated_date' => isset($tasks) ? $tasks->last_updated_date: 'No date',
                'name' => isset($tasks->user) ? $tasks->user->name: 'No name',
                'surname' => isset($tasks->user) ? $tasks->user->surname: 'No surname',
                'project_name' => isset($tasks) ? $tasks->project_name: 'None',
                'project_stage' => isset($tasks->projectsStage) ? $tasks->projectsStage->project_stage: 'No Stage',
                'is_replied' => isset($tasks->is_replied) ? $tasks->is_replied: 'Awaiting response..',
                'isClosed' => $tasks->isClosed ? 'Yes' : 'No',
                'closing_report' => isset($tasks->closing_report) ?  $tasks->closing_report : 'None',
                'date_closed' => isset($tasks->date_closed) ?  $tasks->date_closed : 'None',
                'id' => $tasks->id];
            array_push($task_array_two, $object);
        }

        $logged_in_user = Auth::user()->load('roles');
        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.tasks.view-tasks', compact('stage', 'users', 'task_array_two'));
        }
    }

    //GRADUATE STAGE
    public function graduateStage(Stage $stage){
        $projectStages = ProjectStage::all();
        $stage->load('project','graduation','projectStages')->get();

        $graduations = $stage->graduation;

        $graduation_stage = [];

        foreach ($graduations as $graduationStages) {
            $object = (object)[
                'project_name' => isset($graduationStages) ? $graduationStages->project_name : 'No name',
                'previous_stage' => isset($graduationStages) ? $graduationStages->previous_stage : 'No name',
                'next_stage_name' => isset($graduationStages) ? $graduationStages->next_stage_name : 'No name',
                'progress_summary' => isset($graduationStages) ? $graduationStages->progress_summary : 'No Name',
                'graduation_date' => isset($graduationStages) ? $graduationStages->graduation_date : 'No date',
                'stageGraduated' => $graduationStages->stageGraduated ? 'Yes' : 'No',
                'id' => $graduationStages->id];
            array_push($graduation_stage, $object);
        }

        $logged_in_user = Auth::user()->load('roles');
        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.tasks.graduate-stage', compact('stage', 'graduation_stage',
                'projectStages', 'graduations'));
        }
    }

    //Task replies
    public function addTaskReplies(Task $task){
        $task->load('projects','projectsStage','user','taskReply')->get();
        $userStage = $task->projectsStage;
        $userStage->load('projects');
        $userTask = $task->user;
        $userTask->load('organisation');
        $userOrganisation = $userTask->organisation;
        $taskReply = $task->taskReply;

        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if($logged_in_user->roles[0]->name == 'Facilitator') {
            return view('roles.tasks.task-replies', compact('task','userStage','userTask','taskReply','userOrganisation'));
        }
    }

    //Task reply
    //Project is closed
    public function updateTaskReply(Request $request,Task $task)
    {
        DB::beginTransaction();
        $input = $request->all();
        $task->load('projects','projectsStage','user');
        $user = $task->user;

        try {
            $taskReply = TaskReply::create(['reply'=>$input['reply'],'task_id'=>$task->id,
                'user_id'=>$user->id
                ]);
            $taskReply->save();

            $task->update(['is_replied'=>'Yes']);

            DB::commit();

            return redirect()
                ->to('task-index')
                ->withInput()
                ->with('success_message', 'Replied successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    //view task reply
    public function viewTaskReply(Task $task){
        $task->load('taskReply','stage')->get();
        $taskStage = $task->stage;
        $task_reply = $task->taskReply;

        $task_array = [];

        foreach ($task_reply as $task_replies) {
            $task_replies->load('task');
            $tasks = $task_replies->task;
            $tasks->load('projectsStage','user');

            $object = (object)[
                'reply' => isset($task_replies->reply) ? $task_replies->reply : 'No',
                'project_name' => isset($task_replies->task->project_name) ? $task_replies->task->project_name : 'No',
                'title' => isset($task_replies->task->title) ? $task_replies->task->title : 'No',
                'description' => isset($task_replies->task->description) ? $task_replies->task->description : 'No',
                'name' => isset($tasks->user->name) ? $tasks->user->name : 'No name',
                'email' => isset($tasks->user->email) ? $tasks->user->email : 'No email',
                'surname' => isset($tasks->user->surname) ? $tasks->user->surname : 'No name',
                'id' => $task_replies->id];
            array_push($task_array, $object);

        }
        $logged_in_user = Auth::user()->load('roles');
        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.tasks.view-task-reply', compact('task', 'task_array', 'taskStage'));
        }
    }

    //Closing task
    public function updateCloseTask(Request $request,Task $task)
    {
        DB::beginTransaction();
        $input = $request->all();
        try {
            $task->update(['closing_report'=>$input['closing_report'],
                'date_closed'=>$input['date_closed'],'isClosed'=>true,'isDone'=>true]);

            $task->save();

            DB::commit();

            return redirect()
                ->route('edit-close-task', $task->id)
                ->withInput()
                ->with('success_message', 'Task closed successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occured, please contact your IT Admin .');
        }
    }

    //Close task
    public  function editCloseTasks(Task $task){
        $task->load('stage','projects')->get();
        $taskStage = $task->stage;

        $logged_in_user = Auth::user()->load('roles');
        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.tasks.close-task', compact('task', 'taskStage'));
        }
    }

    //project user
  public function projectUser(Project $project){
        $logged_in_user = Auth::user()->load('roles');
        $project->load('stages','user');
        $users = $project->user;

        $user_array = [];

        foreach ($users as $user) {
            $user->load('organisation');

            $object = (object)[
                'name' => isset($user->name) ? $user->name : 'No name',
                'surname' => isset($user->surname) ? $user->surname : 'No name',
                'email' => isset($user->email) ? $user->email : 'No name',
                'address' => isset($user->address) ? $user->address : 'No name',
                'job_title' => isset($user->job_title) ? $user->job_title : 'No name',
                'contact_number' => isset($user->contact_number) ? $user->contact_number : 'No contact',
                'personal_profile' => isset($user->personal_profile) ? $user->personal_profile : 'No name',
                'organisation_name' => isset($user->organisation->organisation_name) ? $user->organisation->organisation_name : 'No name',
                'id' => $user->id];
            array_push($user_array, $object);

        }

        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.project.project-user', compact('project','user_array'));
        }
    }

    //project user organisation
    public function projectUserOrganisation(Project $project){
        $logged_in_user = Auth::user()->load('roles');
        $project->load('stages','user');
        $users = $project->user;

        $organisation_array = [];

        foreach ($users as $user) {
            $user->load('organisation');
            $organisation = $user->organisation;

            $object = (object)[
                'organisation_name' => isset($organisation->organisation_name) ? $organisation->organisation_name : 'No name',
                'description' => isset($organisation->description) ? $organisation->description : 'No name',
                'location' => isset($organisation->location) ? $organisation->location : 'No name',
                'website' => isset($organisation->website) ? $organisation->website : 'No name',

                'id' => $user->id];
            array_push($organisation_array, $object);

        }

        if ($logged_in_user->roles[0]->name == 'Incubator staff' or $logged_in_user->roles[0]->name == 'administrator') {
            return view('roles.project.project-user-organisation', compact('project','user','organisation_array'));
        }
    }

 public function taskUserOrganisation(Organisation $project){
        $logged_in_user = Auth::user()->load('roles');

        //Check if logged in user is admin, else return 404
        if ($logged_in_user->roles[0]->name == 'Facilitator') {
            return view('roles.project.task-user-organisation', compact('project'));
        }
    }

}
