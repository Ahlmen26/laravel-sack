<?php

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

use App\Http\Controllers\ProjectsController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/project-checklist','ProjectChecklistController')->middleware('auth');

Route::get('/project-checklist/{project_checklist}/{checklisttype}/{survey_phase}/{mode}','ProjectChecklistController@show')->name('project-checklist');

Route::resource('/item-comment', 'ItemCommentsController');

Route::resource('/dashboard', 'ProjectsController');

Route::get('/manage', 'ProjectsController@show')->name('manage-project');
Route::get('/manage/{project}/edit', 'ProjectsController@edit')->name('edit-project');
Route::patch('/manage/{project}/update', 'ProjectsController@updateProject')->name('update-project');

Route::put('/project/{project}', 'ProjectsController@update');

Route::get('/result/{project}/{phase}', 'ProjectsController@ResultsView')->name('view-result');

// BEGIN Route for checklist manager
Route::resource('/checklist-manager', 'ChecklistController',[
    'names' => [
        'edit' => 'checklist-edit',
        'create' => 'checklist-create'
    ]
])->name('index','checklist-manager');

Route::resource('/surveytype', 'SurveyTypeController', [
    'names' => [
        'edit' => 'survey-type-edit',
        'create' => 'survey-type-create',
    ]
])->middleware(['auth', 'role:role_Admin']);

Route::resource('/checklisttype', 'ChecklistTypeController', [
    'names' => [
        'edit' => 'checklist-type-edit',
        'create' => 'checklist-type-create',
    ]
])->middleware(['auth', 'role:role_Admin']);

Route::resource('/checklistcategory', 'ChecklistCategoryController', [
    'names' => [
        'edit' => 'checklist-category-edit',
        'create' => 'checklist-category-create',
    ]
])->middleware(['auth','role:role_Admin']);

// END Route for checklist manager

// BEGIN Route for Jira Template
Route::resource('/jira-template', 'JiraTemplateController', [
    'names' => [
        'edit' => 'jira-template-edit',
        'create' => 'jira-template-create',
    ]
])->middleware(['auth', 'role:role_Admin']);
// END Route for Jira Template

// BEGIN Route for manage users
Route::resource('/manage-users', 'UserController')->name('index', 'manage-users');
// END Route for manage users

Auth::routes();
