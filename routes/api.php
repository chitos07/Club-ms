<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\BranchController;
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
Route::post('/users/login', [LoginController::class, 'login']);


/*
 * public Routes end
 */


Route::group(['middleware' => ['auth:api']], function () {

    /* User Routes */
    Route::group(['middleware' => ['scopes:user.restore']], function () {
        Route::get('/users/restore', [UserController::class, 'RestoreAll']);
        Route::get('/users/restore/{id}', [UserController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/users', [UserController::class, 'index'])->middleware('scopes:user.index');
    Route::post('/users', [UserController::class, 'store'])->middleware('scopes:user.create');
    Route::get('/users/{user}', [UserController::class, 'show'])->middleware('scopes:user.show');
    Route::put('/users/{user}', [UserController::class, 'update'])->middleware('scopes:user.edit');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('scopes:user.delete');
    /* End Routes */

    /* role Routes */
    Route::group(['middleware' => ['scopes:role.restore']], function () {
        Route::get('/roles/restore', [RoleController::class, 'RestoreAll']);
        Route::get('/roles/restore/{id}', [RoleController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/roles', [RoleController::class, 'index'])->middleware('scopes:role.index');
    Route::post('/roles', [RoleController::class, 'store'])->middleware('scopes:role.create');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->middleware('scopes:role.show');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->middleware('scopes:role.edit');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->middleware('scopes:role.delete');
    /* End role Routes */

    /* Currency Routes */
    Route::group(['middleware' => ['scopes:currency.restore']], function () {
        Route::get('/currencies/restore', [CurrencyController::class, 'RestoreAll']);
        Route::get('/currencies/restore/{id}', [CurrencyController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/currencies', [CurrencyController::class, 'index'])->middleware('scopes:currency.index');
    Route::post('/currencies', [CurrencyController::class, 'store'])->middleware('scopes:currency.create');
    Route::get('/currencies/{currency}', [CurrencyController::class, 'show'])->middleware('scopes:currency.show');
    Route::put('/currencies/{currency}', [CurrencyController::class, 'update'])->middleware('scopes:currency.edit');
    Route::delete('/currencies/{currency}', [CurrencyController::class, 'destroy'])->middleware('scopes:currency.delete');
    /* End Currency Routes */

    /* Branche Routes */
    Route::group(['middleware' => ['scopes:branche.restore']], function () {
        Route::get('/branches/restore', [BranchController::class, 'RestoreAll']);
        Route::get('/branches/restore/{id}', [BranchController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/branches', [BranchController::class, 'index'])->middleware('scopes:branch.index');
    Route::post('/branches', [BranchController::class, 'store'])->middleware('scopes:branch.create');
    Route::get('/branches/{branch}', [BranchController::class, 'show'])->middleware('scopes:branch.show');
    Route::put('/branches/{branch}', [BranchController::class, 'update'])->middleware('scopes:branch.edit');
    Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->middleware('scopes:branch.delete');
    /* End Branche Routes */

    /* Resoure Routes */
    Route::group(['middleware' => ['scopes:resource.restore']], function () {
        Route::get('/resources/restore', [ResourceController::class, 'RestoreAll']);
        Route::get('/resources/restore/{id}', [ResourceController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/resources', [ResourceController::class, 'index'])->middleware('scopes:resource.index');
    Route::post('/resources', [ResourceController::class, 'store'])->middleware('scopes:resource.create');
    Route::get('/resources/{resource}', [ResourceController::class, 'show'])->middleware('scopes:resource.show');
    Route::put('/resources/{resource}', [ResourceController::class, 'update'])->middleware('scopes:resource.edit');
    Route::delete('/resources/{resource}', [ResourceController::class, 'destroy'])->middleware('scopes:resource.delete');
    /* End Resoure Routes */

    /* Course-Cat Routes */
    Route::group(['middleware' => ['scopes:courseCategory.restore']], function () {
        Route::get('/coursecategories/restore', [CourseCategoryController::class, 'RestoreAll']);
        Route::get('/coursecategories/restore/{id}', [CourseCategoryController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/coursecategories', [CourseCategoryController::class,'index'])->middleware('scopes:courseCategory.index');
    Route::post('/coursecategories', [CourseCategoryController::class, 'store'])->middleware('scopes:courseCategory.create');
    Route::get('/coursecategories/{course_category}', [CourseCategoryController::class, 'show'])->middleware('scopes:courseCategory.show');
    Route::put('/coursecategories/{course_category}', [CourseCategoryController::class, 'update'])->middleware('scopes:courseCategory.edit');
    Route::delete('/coursecategories/{course_category}', [CourseCategoryController::class, 'destroy'])->middleware('scopes:courseCategory.delete');
    /* End Course-Cat Routes */

    /* CancellationPolicy Routes */
    Route::group(['middleware' => ['scopes:cancellationPolicy.restore']], function () {
        Route::get('/cancellationpolicies/restore', [CancellationPolicyController::class, 'RestoreAll']);
        Route::get('/cancellationpolicies/restore/{id}', [CancellationPolicyController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/cancellationpolicies', [CancellationPolicyController::class,'index'])->middleware('scopes:cancellationPolicy.index');
    Route::post('/cancellationpolicies', [CancellationPolicyController::class, 'store'])->middleware('scopes:cancellationPolicy.create');
    Route::get('/cancellationpolicies/{cancellation_policy}', [CancellationPolicyController::class, 'show'])->middleware('scopes:cancellationPolicy.show');
    Route::put('/cancellationpolicies/{cancellation_policy}', [CancellationPolicyController::class, 'update'])->middleware('scopes:cancellationPolicy.edit');
    Route::delete('/cancellationpolicies/{cancellation_policy}', [CancellationPolicyController::class, 'destroy'])->middleware('scopes:cancellationPolicy.delete');
    /* End CancellationPolicy Routes */

    /* courseTemplate Routes */
    Route::group(['middleware' => ['scopes:courseTemplate.restore']], function () {
        Route::get('/coursetemplates/restore', [CourseTemplateController::class, 'RestoreAll']);
        Route::get('/coursetemplates/restore/{id}', [CourseTemplateController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/coursetemplates', [CourseTemplateController::class, 'index'])->middleware('scopes:courseTemplate.index,courseTemplate.create');
    Route::post('/coursetemplates/', [CourseTemplateController::class, 'store'])->middleware('scopes:courseTemplate.s');
    Route::get('/coursetemplates/{course_template}', [CourseTemplateController::class, 'show'])->middleware('scopes:courseTemplate.create');
    Route::put('/coursetemplates/{course_template}', [CourseTemplateController::class, 'update'])->middleware('scopes:courseTemplate.edit');
    Route::delete('/coursetemplates/{course_template}', [CourseTemplateController::class, 'destroy'])->middleware('scopes:courseTemplate.delete');
    /* End courseTemplate Routes */

    /* courseElement Routes */
    Route::group(['middleware' => ['scopes:courseElement.restore']], function () {
        Route::get('/courseelements/restore', [CourseElementController::class, 'RestoreAll']);
        Route::get('/courseelements/restore/{id}', [CourseElementController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/courseelements', [CourseElementController::class, 'index'])->middleware('scopes:courseElement.index');
    Route::post('/courseelements', [CourseElementController::class, 'store'])->middleware('scopes:courseElement.create');
    Route::get('/courseelements/{course_element}', [CourseElementController::class, 'show'])->middleware('scopes:courseElement.show');
    Route::put('/courseelements/{course_element}', [CourseElementController::class, 'update'])->middleware('scopes:courseElement.edit');
    Route::delete('/courseelements/{course_element}', [CourseElementController::class, 'destroy'])->middleware('scopes:courseElement.delete');
    /* End courseElement Routes */

    /* Staff Routes */
    Route::group(['middleware' => ['scopes:staff.restore']], function () {
        Route::get('/staffs/restore', [StaffController::class, 'RestoreAll']);
        Route::get('/staffs/restore/{id}', [StaffController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/staffs', [StaffController::class, 'index'])->middleware('scopes:staff.index');
    Route::post('/staffs', [StaffController::class, 'store'])->middleware('scopes:staff.create');
    Route::get('/staffs/{staff}', [StaffController::class, 'show'])->middleware('scopes:staff.show');
    Route::put('/staffs/{staff}', [StaffController::class, 'update'])->middleware('scopes:staff.edit');
    Route::delete('/staffs/{staff}', [StaffController::class, 'destroy'])->middleware('scopes:staff.delete');
    /* End Staff Routes */

    /* Course Routes */
    Route::group(['middleware' => ['scopes:course.restore']], function () {
        Route::get('/courses/restore', [CourseController::class, 'RestoreAll']);
        Route::get('/courses/restore/{id}', [CourseController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/courses', [CourseController::class, 'index'])->middleware('scopes:course.index');
    Route::post('/courses', [CourseController::class, 'store'])->middleware('scopes:course.create');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->middleware('scopes:course.show');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware('scopes:course.edit');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->middleware('scopes:course.delete');
    /* End Course Routes */

    /* Course Routes */
    Route::group(['middleware' => ['scopes:client.restore']], function () {
        Route::get('/clients/restore', [ClientController::class, 'RestoreAll']);
        Route::get('/clients/restore/{id}', [ClientController::class, 'RestoreDeletedItemWithId']);
    });
    Route::get('/clients', [ClientController::class, 'index'])->middleware('scopes:client.index');
    Route::post('/clients', [ClientController::class, 'store'])->middleware('scopes:client.create');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->middleware('scopes:client.show');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->middleware('scopes:client.edit');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->middleware('scopes:client.delete');
    /* End Course Routes */


});
