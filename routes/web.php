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

use App\Http\Middleware\Admin;
use App\User;
use Illuminate\Support\Facades\Hash;

/*******************************  Login Page  ***********************************/
Route::group(['middleware' => 'guest'], function() {
    Route::get('/',  array('as' => 'loginPage', 'uses' => 'AdminController@index'));
    Route::get('/admin/dologin',  array('as' => 'login', 'uses' => 'AdminController@login'));
    Route::get('/admin/register',  array('as' => 'register', 'uses' => 'AdminController@register'));
    Route::get('admin/forgotpassword',  array('as' => 'forgotPass', 'uses' => 'AdminController@forgotPassword'));
});

Auth::routes();

Route::get('admin/freelancers/getAllSkills', function() {
    return response()->json(['success' => true]);
});

Route::get('kandidaten/join/{code}', 'PublicKandidatenController@join')->name('candidate.public_form');
Route::post('kandidaten/join/{code}', 'PublicKandidatenController@postJoin')->name('candidate.post_join');
Route::get('kandidaten/join-success', 'PublicKandidatenController@joinSuccess');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function() {
        return redirect('/admin/kandidaten');
    });

    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/updateInfo',  array('as' => 'index', 'uses' => 'DashboardController@updateInfo'));
        Route::post('/profile/update',  array('as' => 'updateProfile', 'uses' => 'DashboardController@profileUpdate'));
    });

    Route::group(array('namespace'=>'Admin'), function() {
        Route::get('/admin/kandidaten', array('uses' => 'KandidateController@index'))->name('candidates.index');
        Route::get('admin/kandidaten/getAllFestanstellung', array('as' => 'index', 'uses' => 'KandidateController@getAllFestanstellung'));
        Route::get('admin/kandidaten/add_user', array('as' => 'add', 'uses' => 'KandidateController@addKandidateview'));
        Route::post('admin/kandidaten/add', array('uses' => 'KandidateController@addKandidate'))->name('candidates.add');
        Route::get('admin/kandidaten/{id}', array('uses' => 'KandidateController@show'))->name('candidates.view');
        Route::get('admin/kandidaten/{id}/edit', array('uses' => 'KandidateController@editKandidate'))->name('candidates.edit');
        Route::post('admin/kandidaten/{id}', array('uses' => 'KandidateController@update'))->name('candidates.update');
        Route::post('admin/update_experience/{id}', array('uses' => 'KandidateController@update_experience'))->name('candidates.update_experience');
        Route::post('admin/delete_experience/{id}', array('uses' => 'KandidateController@delete_experience'))->name('candidates.delete_experience');
        Route::post('admin/add_experience/{id}', array('uses' => 'KandidateController@add_experience'))->name('candidates.add_experience');

        Route::post('admin/update_education/{id}', array('uses' => 'KandidateController@update_education'))->name('candidates.update_education');
        Route::post('admin/delete_education/{id}', array('uses' => 'KandidateController@delete_education'))->name('candidates.delete_education');
        Route::post('admin/add_education/{id}', array('uses' => 'KandidateController@add_education'))->name('candidates.add_education');
        
        Route::get('admin/kandidaten/delete/{id}', array('as' => 'delete', 'uses' => 'KandidateController@delete'));

        Route::group(['prefix' => 'admin'], function() {
            Route::get('kandidaten-invite', 'KandidateController@invite')->name('candidate.invite');
            Route::post('kandidaten-invite', 'KandidateController@sendInvite')->name('candidate.sendInvite');

            Route::group(['prefix' => 'kandidaten'], function() {
                Route::get('{id}/activate', 'KandidateController@activate')->name('candidate.activate');
                Route::get('{id}/deactivate', 'KandidateController@deactivate')->name('candidate.deactivate');
            });
        });


        Route::get('admin/kandidaten/edit/{id}/{list}', array('as' => 'edit', 'uses' => 'KandidateController@editFestanstellung'));

        Route::post('admin/Festanstellung/sendMail', array('as' => 'index', 'uses' => 'KandidateController@openMailPanel'));

        Route::post('admin/Festanstellung/send', array('as' => 'index', 'uses' => 'KandidateController@sendMail'));

        Route::group(['middleware' => [Admin::class]], function() {
            Route::resource('admin/skills', 'SkillsController');
            Route::get('admin/skills/{skill}/delete', 'SkillsController@destroy');
        });
        Route::post('/admin/password-change',  'KandidateController@passwordChange')
            ->name('admin.changePassword');
    });
});

