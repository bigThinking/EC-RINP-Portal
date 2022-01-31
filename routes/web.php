<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('users',[App\Http\Controllers\HomeController::class,'viewAllUsers']);
Route::get('/user-profile/{user}',[App\Http\Controllers\HomeController::class, 'viewUserProfile']);
Route::get('organisations',[App\Http\Controllers\HomeController::class,'viewAllOrganisations']);
Route::get('/view-organisation-users/{organisation}',[App\Http\Controllers\HomeController::class,'organisationUsers'])->name('view-organisation-users');

Route::post('register',[App\Http\Controllers\Auth\RegisterController::class,'registerUser'])->name('register');

//ROLES CRUD
Route::get('create-role', [App\Http\Controllers\UsersController::class, 'createRole'])->name('create-role');
Route::post('store-user-role', [App\Http\Controllers\UsersController::class, 'storeUserRole'])->name('store-user-role');
Route::get('user-role-index',[App\Http\Controllers\UsersController::class, 'userRolesIndex'])->name('user-role-index');
Route::get('get-user-roles',[App\Http\Controllers\UsersController::class, 'getAllUsersRoles'])->name('get-user-roles');
Route::get('edit-role/{role}',[App\Http\Controllers\UsersController::class, 'editUserRole'])->name('edit-role');
Route::put('/update-role/{role}',[App\Http\Controllers\UsersController::class, 'updateRole'])->name('update-role');
Route::get('delete-role/{role}',[App\Http\Controllers\UsersController::class, 'adminDeleteUserRole']);

//ORGANISATIONS
Route::get('admin-create-organisation',[App\Http\Controllers\OrganisationsController::class, 'adminCreateOrganisation']);
Route::post('admin-store-organisation',[App\Http\Controllers\OrganisationsController::class, 'adminStoreOrganisation']);

Route::get('create-organisation',[App\Http\Controllers\OrganisationsController::class, 'createOrganisation']);
Route::post('store-organisation',[App\Http\Controllers\OrganisationsController::class, 'storeOrganisation']);
Route::get('organisation-index',[App\Http\Controllers\OrganisationsController::class, 'organisationIndex'])->name('organisation-index');
Route::get('edit-organisation/{organisation}',[App\Http\Controllers\OrganisationsController::class, 'editOrganisation'])->name('edit-organisation');
Route::put('/update-organisation/{organisation}',[App\Http\Controllers\OrganisationsController::class, 'updateOrganisation'])->name('update-organisation');
Route::get('delete-organisation/{organisation}',[App\Http\Controllers\OrganisationsController::class, 'adminDeleteOrganisation']);

//USERS
Route::get('user-index',[App\Http\Controllers\UsersController::class, 'usersIndex'])->name('user-index');
Route::get('admin-approve-user/{user}',[App\Http\Controllers\UsersController::class,'adminEditUser']);
Route::put('/user-approved/{user}',[App\Http\Controllers\UsersController::class, 'updateUserApproval'])->name('user-approved');
Route::post('admin-delete-user/{user}',[App\Http\Controllers\UsersController::class, 'adminDeleteUser']);
Route::get('view-user-info/{user}',[App\Http\Controllers\UsersController::class,'viewUserInfo'])->name('view-user-info');
Route::get('/delete-user-and-project/{id}',[App\Http\Controllers\UsersController::class, 'destroyUserAndProject']);

//EDIT USER ORGANISATION
Route::get('/edit-user-organisation/{user}',[App\Http\Controllers\OrganisationsController::class, 'editUserOrganisation'])->name('edit-user-organisation');
Route::put('/update-user-organisation/{user}',[App\Http\Controllers\OrganisationsController::class, 'updateUserOrganisation'])->name('update-user-organisation');

//PROJECT
Route::get('create-project',[App\Http\Controllers\ProjectController::class, 'createProject'])->name('create-project');
Route::post('store-project',[App\Http\Controllers\ProjectController::class, 'storeProject'])->name('store-project');
Route::get('/edit-user-project/{user}',[App\Http\Controllers\ProjectController::class, 'editUserProject'])->name('edit-user-project');
Route::put('/update-user-project/{user}',[App\Http\Controllers\ProjectController::class, 'updateUserProject'])->name('update-user-project');
Route::get('project-index',[App\Http\Controllers\ProjectController::class, 'projectIndex'])->name('project-index');

//PROJECT STAGE
Route::get('create-project-stage',[App\Http\Controllers\ProjectController::class, 'createProjectStage'])->name('create-project-stage');
Route::post('store-project-stage',[App\Http\Controllers\ProjectController::class, 'storeProjectStage'])->name('store-project-stage');
Route::get('project-stage-index',[App\Http\Controllers\ProjectController::class, 'projectStageIndex'])->name('project-stage-index');
Route::get('/delete-project-stage/{projectStage}',[App\Http\Controllers\ProjectController::class, 'adminDeleteUser']);
Route::get('/edit-project-stage/{projectStage}',[App\Http\Controllers\ProjectController::class, 'editProjectStage'])->name('edit-project-stage');
Route::put('/update-project-stage/{projectStage}',[App\Http\Controllers\ProjectController::class, 'updateProjectStage'])->name('update-project-stage');
Route::put('/incubator-update-project/{project}',[App\Http\Controllers\ProjectController::class, 'incubatorUpdateProject'])->name('incubator-update-project');
Route::get('/project-user/{project}',[App\Http\Controllers\ProjectController::class, 'projectUser'])->name('/portal/project-user');
Route::get('/project-user-organisation/{project}',[App\Http\Controllers\ProjectController::class, 'projectUserOrganisation'])->name('/portal/project-user-organisation');
Route::get('/task-user-organisation/{project}',[App\Http\Controllers\ProjectController::class, 'taskUserOrganisation'])->name('/portal/task-user-organisation');


Route::get('incubatee-edit-user-project/{project}',[App\Http\Controllers\ProjectController::class, 'incubateeEditUserProject'])->name('incubatee-edit-user-project');

//EVENTS
Route::get('create-events',[App\Http\Controllers\UsersController::class, 'createEvent'])->name('create-events');
Route::post('store-event',[App\Http\Controllers\UsersController::class,'storeEvents'])->name('store-event');
Route::get('get-events',[App\Http\Controllers\UsersController::class, 'eventIndex'])->name('get-events');
Route::get('delete-event/{event}',[App\Http\Controllers\UsersController::class, 'deleteEvent']);
Route::get('edit-event/{event}',[App\Http\Controllers\UsersController::class, 'editEvent'])->name('edit-event');
Route::put('/update-event/{event}',[App\Http\Controllers\UsersController::class, 'updateEvent'])->name('update-event');
Route::get('/view-events',[App\Http\Controllers\HomeController::class, 'viewEvents'])->name('view-events');

//CallS
Route::get('create-call',[App\Http\Controllers\CallController::class, 'createCall'])->name('create-call');
Route::post('save-call',[App\Http\Controllers\CallController::class,'saveCall'])->name('save-call');
Route::get('delete-call/{call}',[App\Http\Controllers\CallController::class, 'deleteCall'])->name('delete-call');
Route::get('edit-call/{call}',[App\Http\Controllers\CallController::class, 'editCall'])->name('edit-call');
Route::put('/update-call/{call}',[App\Http\Controllers\CallController::class, 'updateCall'])->name('update-call');
Route::get('view-calls',[App\Http\Controllers\CallController::class, 'callIndex'])->name('view-calls');
Route::get('view-calls/organisation',[App\Http\Controllers\CallController::class, 'callIndexOrganisation'])->name('view-calls-organisation');
Route::get('get-call/{call}',[App\Http\Controllers\CallController::class,'getCall'])->name('get-call');
Route::get('show-call/{call}',[App\Http\Controllers\CallController::class,'showCall'])->name('show-call');
Route::get('signup/{call}',[App\Http\Controllers\CallController::class,'signUp'])->name('call-signup');

//STAGES
Route::get('create-stages',[App\Http\Controllers\ProjectController::class, 'createStages'])->name('create-stages');
Route::post('store-stage',[App\Http\Controllers\ProjectController::class,'storeStage'])->name('store-stage');
Route::get('stages-index',[App\Http\Controllers\ProjectController::class,'stageIndex'])->name('stages-index');
Route::get('/edit-stages/{stage}',[App\Http\Controllers\ProjectController::class, 'editStage'])->name('edit-stages');
Route::put('/update-stage/{stage}',[App\Http\Controllers\ProjectController::class,'updateStage'])->name('update-stage');

//INCUBATEE ASIGN STAGE TO PROJECT
Route::put('/assign-stage-to-project/{project}',[App\Http\Controllers\ProjectController::class, 'incubateeStoreProjectStage'])->name('assign-stage-to-project');
Route::put('/assign-graduation-stage-to-project/{stage}',[App\Http\Controllers\ProjectController::class, 'incubateeStoreGraduationStage'])->name('assign-graduation-stage-to-project');
Route::put('/assign-task-to-project-stage/{stage}',[App\Http\Controllers\ProjectController::class, 'incubateeStoreProjectStageStask'])->name('assign-task-to-project-stage');
Route::get('graduation-index',[App\Http\Controllers\ProjectController::class, 'graduationStageIndex'])->name('graduation-index');
Route::get('task-index',[App\Http\Controllers\ProjectController::class, 'projectStageTaskIndex'])->name('task-index');

//TASKS
Route::get('view-tasks/{stage}',[App\Http\Controllers\ProjectController::class, 'viewTask'])->name('view-tasks');
Route::get('add-task-replies/{task}',[App\Http\Controllers\ProjectController::class,'addTaskReplies'])->name('add-task-replies');
Route::put('/update-task-reply/{task}',[App\Http\Controllers\ProjectController::class,'updateTaskReply'])->name('update-task-reply');
Route::get('view-task-reply/{task}',[App\Http\Controllers\ProjectController::class, 'viewTaskReply'])->name('view-task-reply');
Route::put('/close-task/{task}',[App\Http\Controllers\ProjectController::class,'updateCloseTask'])->name('close-task');
Route::get('edit-close-task/{task}',[App\Http\Controllers\ProjectController::class, 'editCloseTasks'])->name('edit-close-task');

//PROJECT CLOSED
Route::put('/close-project/{project}',[App\Http\Controllers\ProjectController::class, 'updateProjectStatus'])->name('close-project');
Route::get('graduate-stage/{stage}',[App\Http\Controllers\ProjectController::class, 'graduateStage'])->name('graduate-stage');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

