<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\BiGGAuthController;

use App\Http\Controllers\BiGG\BiGGController;
use App\Http\Controllers\BiGG\TeachersController;
use App\Http\Controllers\BiGG\StudentsController;
use App\Http\Controllers\BiGG\AngiController;
use App\Http\Controllers\BiGG\HicheelController;
use App\Http\Controllers\BiGG\HuvaariController;
use App\Http\Controllers\BiGG\MergejilController;
use App\Http\Controllers\BiGG\MergejilBagshController;
use App\Http\Controllers\BiGG\TenhimController;
use App\Http\Controllers\BiGG\ShalgaltController;
use App\Http\Controllers\BiGG\EventController;
use App\Http\Controllers\BiGG\SettingsController;
use App\Http\Controllers\BiGG\NewsController;
use App\Http\Controllers\BiGG\UploadsController;

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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/****************************************************************************/
/***********************************  BIGG  *********************************/
/****************************************************************************/

// Bigg Login
Route::get('bigg', [BiGGAuthController::class, 'biggGet'])->name('biggLogin');
Route::get('bigg/login', [BiGGAuthController::class, 'biggGetLogin'])->name('biggLogin');
Route::post('bigg/login', [BiGGAuthController::class, 'biggLogin'])->name('biggLoginPost');
Route::get('bigg/logout', [BiGGAuthController::class, 'biggLogout'])->name('logout');

Route::group(['prefix' => 'bigg','middleware' => 'biggauth'], function () {
	// Bigg Dashboard
	Route::get('dashboard',[BiGGController::class, 'dashboard'])->name('bigg-dashboard');	
	
	// Teacher
	Route::get('teachers',[TeachersController::class, 'index'])->name('bigg-teachers');
	Route::get('teachers/add',[TeachersController::class, 'add'])->name('bigg-teachers-add');
	Route::get('teachers/edit/{id}',[TeachersController::class, 'edit'])->name('teachers-edit');
	Route::get('teachers/fond',[TeachersController::class, 'fond'])->name('bigg-teachers-fond');
	Route::get('teachers/fond_list/{id}',[TeachersController::class, 'fond_list'])->name('bigg-teachers-fond-list');

	Route::post('teachers/add',[TeachersController::class, 'store'])->name('bigg-teachers-save');
	Route::post('teachers/edit/{id}',[TeachersController::class, 'update'])->name('bigg-teachers-edit');
	Route::post('teachers/delete/',[TeachersController::class, 'delete'])->name('bigg-teachers-delete-ajax');
	Route::post('teachers/fond_add',[TeachersController::class, 'fond_store'])->name('bigg-teachers-fond-save');
	Route::post('teachers/fond_delete/',[TeachersController::class, 'fond_delete'])->name('bigg-teachers-fond-delete-ajax');

	Route::delete('teachers/delete/{id}',[TeachersController::class, 'destroy'])->name('bigg-teachers-delete');

	// Angi
	Route::get('angi',[AngiController::class, 'index'])->name('bigg-angi');
	Route::get('angi/add',[AngiController::class, 'add'])->name('bigg-angi-add');
	Route::get('angi/edit/{id}',[AngiController::class, 'edit'])->name('angi-edit');

	Route::post('angi/add',[AngiController::class, 'store'])->name('bigg-angi-save');
	Route::post('angi/edit/{id}',[AngiController::class, 'update'])->name('bigg-angi-edit');
	Route::post('angi/delete/',[AngiController::class, 'delete'])->name('bigg-angi-delete-ajax');

	Route::delete('angi/delete/{id}',[AngiController::class, 'destroy'])->name('bigg-angi-delete');

	// Mergejil
	Route::get('mergejil',[MergejilController::class, 'index'])->name('bigg-mergejil');
	Route::get('mergejil/add',[MergejilController::class, 'add'])->name('bigg-mergejil-add');
	Route::get('mergejil/edit/{id}',[MergejilController::class, 'edit'])->name('mergejil-edit');

	Route::post('mergejil/add',[MergejilController::class, 'store'])->name('bigg-mergejil-save');
	Route::post('mergejil/edit/{id}',[MergejilController::class, 'update'])->name('bigg-mergejil-edit');
	Route::post('mergejil/delete/',[MergejilController::class, 'delete'])->name('bigg-mergejil-delete-ajax');

	Route::delete('mergejil/delete/{id}',[MergejilController::class, 'destroy'])->name('bigg-mergejil-delete');

	// Mergejil Bagsh
	Route::get('mergejil_bagsh',[MergejilBagshController::class, 'index'])->name('bigg-mergejil_bagsh');
	Route::get('mergejil_bagsh/add',[MergejilBagshController::class, 'add'])->name('bigg-mergejil_bagsh-add');
	Route::get('mergejil_bagsh/edit/{id}',[MergejilBagshController::class, 'edit'])->name('mergejil_bagsh-edit');

	Route::post('mergejil_bagsh/add',[MergejilBagshController::class, 'store'])->name('bigg-mergejil_bagsh-save');
	Route::post('mergejil_bagsh/edit/{id}',[MergejilBagshController::class, 'update'])->name('bigg-mergejil_bagsh-edit');
	Route::post('mergejil_bagsh/delete/',[MergejilBagshController::class, 'delete'])->name('bigg-mergejil_bagsh-delete-ajax');

	Route::delete('mergejil_bagsh/delete/{id}',[MergejilBagshController::class, 'destroy'])->name('bigg-mergejil_bagsh-delete');

	// Tenhim
	Route::get('tenhim',[TenhimController::class, 'index'])->name('bigg-tenhim');
	Route::get('tenhim/add',[TenhimController::class, 'add'])->name('bigg-tenhim-add');
	Route::get('tenhim/edit/{id}',[TenhimController::class, 'edit'])->name('tenhim-edit');

	Route::post('tenhim/add',[TenhimController::class, 'store'])->name('bigg-tenhim-save');
	Route::post('tenhim/edit/{id}',[TenhimController::class, 'update'])->name('bigg-tenhim-edit');
	Route::post('tenhim/delete/',[TenhimController::class, 'delete'])->name('bigg-tenhim-delete-ajax');

	Route::delete('tenhim/delete/{id}',[TenhimController::class, 'destroy'])->name('bigg-tenhim-delete');

	// Hicheel
	Route::get('hicheel',[HicheelController::class, 'index'])->name('bigg-hicheel');
	Route::get('hicheel/edit/{id}',[HicheelController::class, 'edit'])->name('hicheel-edit');

	Route::post('hicheel/add',[HicheelController::class, 'store'])->name('bigg-hicheel-save');
	Route::post('hicheel/edit/{id}',[HicheelController::class, 'update'])->name('bigg-hicheel-edit');
	Route::post('hicheel/delete/',[HicheelController::class, 'delete'])->name('bigg-hicheel-delete-ajax');

	Route::delete('hicheel/delete/{id}',[HicheelController::class, 'destroy'])->name('bigg-hicheel-delete');

	// Huvaari
	Route::get('huvaari',[HuvaariController::class, 'index'])->name('bigg-huvaari');
	Route::get('huvaari/angi',[HuvaariController::class, 'angi'])->name('bigg-huvaari-angi');
	Route::get('huvaari/shalgalt',[HuvaariController::class, 'shalgalt'])->name('bigg-huvaari-shalgalt');
	Route::get('huvaari/bagsh/{bagshId}',[HuvaariController::class, 'bagsh'])->name('bigg-huvaari-bagsh');

	Route::post('huvaari/add',[HuvaariController::class, 'store'])->name('bigg-huvaari-save');

	// Students
	Route::get('students',[StudentsController::class, 'index'])->name('bigg-students');
	Route::get('students/add',[StudentsController::class, 'add'])->name('bigg-students-add');
	Route::get('students/edit/{id}',[StudentsController::class, 'edit'])->name('students-edit');

	Route::post('students/add',[StudentsController::class, 'store'])->name('bigg-students-save');
	Route::post('students/edit/{id}',[StudentsController::class, 'update'])->name('bigg-students-edit');
	Route::post('students/delete/',[StudentsController::class, 'delete'])->name('bigg-students-delete-ajax');

	// Shalgalt
	Route::get('shalgalt',[ShalgaltController::class, 'index'])->name('bigg-shalgalt');
	Route::get('shalgalt/add',[ShalgaltController::class, 'add'])->name('bigg-shalgalt-add');
	Route::get('shalgalt/asuult/{id}',[ShalgaltController::class, 'asuult'])->name('bigg-shalgalt-asuult');
	Route::get('shalgalt/asuult/{id}/add',[ShalgaltController::class, 'asuult_add'])->name('bigg-shalgalt-asuult-add');

	Route::post('shalgalt/shalgalt/delete/',[ShalgaltController::class, 'shalgalt_delete'])->name('bigg-shalgalt-delete-ajax');
	Route::post('shalgalt/add',[ShalgaltController::class, 'store'])->name('bigg-shalgalt-save');
	Route::post('shalgalt/asuult/{id}/add',[ShalgaltController::class, 'asuult_store'])->name('bigg-shalgalt-asuult-save');
	Route::post('shalgalt/asuult/delete/',[ShalgaltController::class, 'asuult_delete'])->name('bigg-shalgalt-asuult-delete-ajax');

	// News
	Route::get('news',[NewsController::class, 'index'])->name('bigg-news');
	Route::get('news/add',[NewsController::class, 'add'])->name('bigg-news-add');
	Route::get('news/edit/{id}',[NewsController::class, 'edit'])->name('news-edit');

	Route::post('news/add',[NewsController::class, 'store'])->name('bigg-news-save');
	Route::post('news/edit/{id}',[NewsController::class, 'update'])->name('bigg-news-edit');
	Route::post('news/delete/',[NewsController::class, 'delete'])->name('bigg-news-delete-ajax');

	Route::delete('news/delete/{id}',[NewsController::class, 'destroy'])->name('bigg-news-delete');

	// Event
	Route::get('events',[EventController::class, 'index'])->name('bigg-events');

	// Settings
	Route::get('settings',[SettingsController::class, 'index'])->name('bigg-settings');
	Route::get('settings/password',[SettingsController::class, 'password'])->name('bigg-settings-password');
	Route::get('settings/huvaari',[SettingsController::class, 'huvaari'])->name('bigg-settings-huvaari');

	Route::post('/uplods/upload_ckeditor', [UploadsController::class, 'upload_ckeditor'])->name('bigg-uploads');

	// Ajax
	Route::get('shalgalt/ajax_hariult',[ShalgaltController::class, 'ajax_hariult'])->name('bigg-shalgalt-ajax_hariult');
	Route::get('shalgalt/ajax_hariult_add',[ShalgaltController::class, 'ajax_hariult_add'])->name('bigg-shalgalt-ajax_hariult_add');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
