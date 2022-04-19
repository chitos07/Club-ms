<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\BrancheController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CancellationPolicyController;
use App\Http\Controllers\CourseTemplateController;
use App\Http\Controllers\CourseElementController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
 * public Routes
 */

//Route::get('documentation',function (){
//    return view('vendor.l5-swagger.index');
//});
Route::post('/user/login', [LoginController::class,'login']);


/*
 * public Routes end
 */




Route::group(['middleware' => ['auth:api']],function (){


    /* User Routes */
    Route::group(['middleware' => ['scopes:user.restore']],function (){
        Route::get('/user/restore',[UserController::class,'RestoreAll']);
        Route::get('/user/restore/{id}',[UserController::class,'RestoreDeletedItemWithId']);
    });

      Route::resource('/user',UserController::class)
          ->middleware('scopes:user.index,user.create,user.edit,user.show,user.delete');
    /* End Routes */

    /* role Routes */
    Route::group(['middleware' => ['scopes:role.restore']],function (){
        Route::get('/role/restore',[RoleController::class,'RestoreAll']);
        Route::get('/role/restore/{id}',[RoleController::class,'RestoreDeletedItemWithId']);
    });

    Route::resource('/role',RoleController::class)
        ->middleware('scopes:role.index,role.create,role.edit,role.show,role.delete');
    /* End role Routes */

    /* Currency Routes */

    Route::group(['middleware' => ['scopes:currency.restore']],function (){
        Route::get('/currency/restore',[CurrencyController::class,'RestoreAll']);
        Route::get('/currency/restore/{id}',[CurrencyController::class,'RestoreDeletedItemWithId']);
    });

    Route::resource('/currency',CurrencyController::class)
        ->middleware('scopes:currency.index,currency.create,currency.edit,currency.show,currency.delete');
    /* End Currency Routes */

    /* Branche Routes */
    Route::group(['middleware' => ['scopes:branche.restore']],function (){
        Route::get('/branche/restore',[BrancheController::class,'RestoreAll']);
        Route::get('/branche/restore/{id}',[BrancheController::class,'RestoreDeletedItemWithId']);
    });

    Route::resource('/branche',BrancheController::class)->middleware('scopes:branche.index,branche.create,branche.edit,branche.show,branche.delete');
    /* End Branche Routes */

    /* Resoure Routes */
    Route::group(['middleware' => ['scopes:resource.restore']],function (){
        Route::get('/resource/restore',[ResourceController::class,'RestoreAll']);
        Route::get('/resource/restore/{id}',[ResourceController::class,'RestoreDeletedItemWithId']);
    });
    Route::resource('/resource',ResourceController::class)->middleware('scopes:resource.index,resource.create,resource.edit,resource.show,resource.delete');
    /* End Resoure Routes */

    /* Course-Cat Routes */
    Route::group(['middleware' => ['scopes:courseCategory.restore']],function (){
        Route::get('/coursecategory/restore',[CourseCategoryController::class,'RestoreAll']);
        Route::get('/coursecategory/restore/{id}',[CourseCategoryController::class,'RestoreDeletedItemWithId']);
    });

        Route::resource('/coursecategory',CourseCategoryController::class)->except('show','update','destroy')->middleware('scopes:courseCategory.index,courseCategory.create');
        Route::get('/coursecategory/{course_category}',[CourseCategoryController::class,'show'])->middleware('scopes:courseCategory.show');
        Route::put('/coursecategory/{course_category}',[CourseCategoryController::class,'update'])->middleware('scopes:courseCategory.edit');
        Route::delete('/coursecategory/{course_category}',[CourseCategoryController::class,'destroy'])->middleware('scopes:courseCategory.delete');

    /* End Course-Cat Routes */

    /* CancellationPolicy Routes */
    Route::group(['middleware' => ['scopes:cancellationPolicy.restore']],function (){
        Route::get('/cancellationpolicy/restore',[CancellationPolicyController::class,'RestoreAll']);
        Route::get('/cancellationpolicy/restore/{id}',[CancellationPolicyController::class,'RestoreDeletedItemWithId']);
    });

    Route::resource('/cancellationpolicy', CancellationPolicyController::class)->except('show', 'update', 'destroy')->middleware('scopes:cancellationPolicy.index');
    Route::get('/cancellationpolicy/{cancellation_policy}', [CancellationPolicyController::class, 'show'])->middleware('scopes:cancellationPolicy.show');
    Route::put('/cancellationpolicy/{cancellation_policy}', [CancellationPolicyController::class, 'update'])->middleware('scopes:cancellationPolicy.edit');
    Route::delete('/cancellationpolicy/{cancellation_policy}', [CancellationPolicyController::class, 'destroy'])->middleware('scopes:cancellationPolicy.delete');
    /* End CancellationPolicy Routes */

    /* courseTemplate Routes */
    Route::group(['middleware' => ['scopes:courseTemplate.restore']],function (){
        Route::get('/coursetemplate/restore',[CourseTemplateController::class,'RestoreAll']);
        Route::get('/coursetemplate/restore/{id}',[CourseTemplateController::class,'RestoreDeletedItemWithId']);
    });



        Route::resource('/coursetemplate', CourseTemplateController::class)->except('show', 'update', 'destroy')->middleware('scopes:courseTemplate.index,courseTemplate.create');
        Route::get('/coursetemplate/{course_template}', [CourseTemplateController::class, 'show'])->middleware('scopes:cancellationPolicy.show');
        Route::put('/coursetemplate/{course_template}', [CourseTemplateController::class, 'update'])->middleware('scopes:cancellationPolicy.edit');
        Route::delete('/coursetemplate/{course_template}', [CourseTemplateController::class, 'destroy'])->middleware('scopes:cancellationPolicy.delete');


    /* End courseTemplate Routes */

    /* courseElement Routes */
    Route::group(['middleware' => ['scopes:courseElement.restore']],function (){
        Route::get('/courseelement/restore',[CourseElementController::class,'RestoreAll']);
        Route::get('/courseelement/restore/{id}',[CourseElementController::class,'RestoreDeletedItemWithId']);
    });

        Route::resource('/courseelement', CourseElementController::class)->except('show', 'update', 'destroy')->middleware('scopes:courseElement.index,courseElement.create');;
        Route::get('/courseelement/{course_element}', [CourseElementController::class, 'show'])->middleware('scopes:courseElement.show');
        Route::put('/courseelement/{course_element}', [CourseElementController::class, 'update'])->middleware('scopes:courseElement.edit');
        Route::delete('/courseelement/{course_element}', [CourseElementController::class, 'destroy'])->middleware('scopes:courseElement.delete');

    /* End courseElement Routes */

    /* Staff Routes */
    Route::group(['middleware' => ['scopes:staff.restore']],function (){
        Route::get('/staff/restore',[StaffController::class,'RestoreAll']);
        Route::get('/staff/restore/{id}',[StaffController::class,'RestoreDeletedItemWithId']);
    });
    Route::resource('/staff',StaffController::class)->middleware('scopes:staff.index,staff.create,staff.edit,staff.show,staff.delete');
    /* End Staff Routes */

    /* Course Routes */
    Route::group(['middleware' => ['scopes:course.restore']],function (){
        Route::get('/course/restore',[CourseController::class,'RestoreAll']);
        Route::get('/course/restore/{id}',[CourseController::class,'RestoreDeletedItemWithId']);
    });
    Route::resource('/course',CourseController::class)->middleware('scopes:course.index,course.create,course.edit,course.show,course.delete');
    /* End Course Routes */


    /* Course Routes */
    Route::group(['middleware' => ['scopes:client.restore']],function (){
        Route::get('/client/restore',[ClientController::class,'RestoreAll']);
        Route::get('/client/restore/{id}',[ClientController::class,'RestoreDeletedItemWithId']);
    });
    Route::resource('/client',ClientController::class)->middleware('scopes:client.index,client.create,client.edit,client.show,client.delete');
    /* End Course Routes */

});

