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


Route::get('/test', function () {
   $institution = App\Institution::find(1);
   return new App\Mail\InstitutionInvite($institution, "My Password");
});

Route::get('get-started-admin', function () {
    return view('administrators.start');
});

Route::middleware(['auth'])->group(function () {

    Route::redirect('/home', '/', 301);

    Route::get('/', 'HomeController@index')->name('home');
    
    Route::resource('institutions', 'InstitutionsController');

    Route::resource('schools', 'SchoolsController');

    Route::resource('systems', 'SystemsController');

    Route::get('years/create/{id?}', 'YearsController@create');

    Route::resource('years', 'YearsController');

    Route::get('terms/create/{id?}', 'TermsController@create');

    Route::resource('terms', 'TermsController');

    Route::resource('departments', 'DepartmentsController');

    Route::get('ajax/schools/{id}', 'AjaxController@school');

    Route::resource('subjects', 'SubjectsController');

    Route::get('ajax/departments/{id}', 'AjaxController@department');

    Route::resource('topics', 'TopicsController');

    Route::get('ajax/allsubjects/{id}', 'AjaxController@subject');

    Route::get('ajax/subjecti/{id}', 'AjaxController@subjectInstitution');

    Route::get('ajax/subjects/{id}', 'AjaxController@subjectSchool');

    Route::get('ajax/subjectd/{id}', 'AjaxController@subjectDepartment');

    Route::get('objectives/setup', 'ObjectivesController@setup');

    Route::get('objectives/create/{id}', 'ObjectivesController@create');

    Route::resource('objectives', 'ObjectivesController');

    Route::get('ajax/topics/{id}', 'AjaxController@topic');

    Route::get('ajax/topics/{id}/{de}/{fe}', 'AjaxController@specifictopic');

    Route::get('ajax/user/{id}', 'AjaxController@user');

    Route::get('ajax/user2/{id}', 'AjaxController@user2');

    Route::get('ajax/lecturer/{id}', 'AjaxController@lecturer');

    Route::get('ajax/years/{id}', 'AjaxController@year');

    Route::get('ajax/semesters/{id}', 'AjaxController@semester');

    Route::get('ajax/yeari/{id}', 'AjaxController@yearI');

    Route::get('ajax/semesteri/{id}', 'AjaxController@semesterI');

    Route::get('theories/setup', 'TheoriesController@setup');

    Route::get('theories/create/{id}', 'TheoriesController@create');

    Route::resource('theories', 'TheoriesController');

    Route::resource('administrators', 'AdministratorsController');

    Route::resource('users', 'UsersController');

    Route::get('assignment/institution', 'AssignmentController@institution');

    Route::get('assignment/institution2', 'AssignmentController@institution2');

    Route::post('assignment', 'AssignmentController@storeInstitution');

    Route::post('assignment2', 'AssignmentController@storeSubject');

    Route::delete('assignment/{id}', 'AssignmentController@destroyInstitution');

    Route::delete('assignment2/{id}', 'AssignmentController@destroySubject');

    Route::get('assignment/subject', 'AssignmentController@subject');

    Route::get('assignment/subjects', 'AssignmentController@subject2');

    Route::get('exam/setup', 'ExamController@setup');

    Route::get('exam/examination', 'ExamController@examination');

    Route::post('exam/store', 'ExamController@store');

    Route::get('exam/show/{id}', 'ExamController@show')->name('exam.show');

    Route::get('exam/write/{id}', 'ExamController@write')->name('exam.write');

    Route::post('exam/submit_question', 'ExamController@submit_question')->name('exam.submit_question');

    Route::get('exam/scheme/{id}', 'ExamController@scheme')->name('exam.scheme');

    Route::get('exam', 'ExamController@index')->name('exam');

    Route::delete('exam/{id}', 'ExamController@destroy')->name('exam.destroy');

    
    Route::get('exams/setup', 'InstitutionExamController@setup');

    Route::get('exams/examination', 'InstitutionExamController@examination');

    Route::post('exams/store', 'InstitutionExamController@store');

    Route::get('exams/show/{id}', 'InstitutionExamController@show')->name('institutionexam.show');

    Route::get('exams/scheme/{id}', 'InstitutionExamController@scheme')->name('institutionexam.scheme');

    Route::get('exams', 'InstitutionExamController@index')->name('institutionexam');

    Route::delete('exams/{id}', 'InstitutionExamController@destroy')->name('institutionexam.destroy');

    Route::resource('system-subjects', 'SystemSubjectController');

    Route::resource('subject', 'InstitutionSubjectController');

    Route::resource('topic', 'InstitutionTopicController');

    Route::get('objective/setup', 'InstitutionObjectiveController@setup');

    Route::get('objective/create/{id}', 'InstitutionObjectiveController@create');

    Route::resource('objective', 'InstitutionObjectiveController');

    Route::get('theory/setup', 'InstitutionTheoryController@setup');

    Route::get('theory/create/{id}', 'InstitutionTheoryController@create');

    Route::resource('theory', 'InstitutionTheoryController');

    Route::resource('image', 'ImagesController');

    Route::get('userprofile', 'ProfileController@index')->name('profile.index');

    Route::post('userprofile/savepass', 'ProfileController@savepass')->name('profile.savepass');

});

Auth::routes();
