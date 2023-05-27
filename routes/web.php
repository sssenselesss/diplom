<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//IndexController
Route::get('/',[\App\Http\Controllers\IndexController::class,'main'])->name('main');
Route::middleware('banned')->get('/catalog',[\App\Http\Controllers\IndexController::class,'catalog'])->name('catalog');
Route::middleware(['authCustom','banned'])->get('/task/create',[\App\Http\Controllers\IndexController::class,'createTask'])->name('createTask');
Route::middleware('banned')->get('/frequent',[\App\Http\Controllers\IndexController::class,'frequent'])->name('frequent');
Route::middleware('banned')->get('/articles',[\App\Http\Controllers\IndexController::class,'articles'])->name('articles');
Route::middleware(['authCustom','admin','banned'])->get('/article/create',[\App\Http\Controllers\IndexController::class,'articleCreate'])->name('articleCreate');

Route::middleware('banned')->get('/myProfile/{user:id}',[\App\Http\Controllers\IndexController::class,'profile'])->name('profile');

Route::middleware(['authCustom','admin','banned'])->get('/users/all',[\App\Http\Controllers\IndexController::class,'adminAllUsers'])->name('adminAllUsers');
Route::middleware(['authCustom','admin','banned'])->get('/search',[\App\Http\Controllers\IndexController::class,'search'])->name('search');
Route::middleware(['authCustom','admin','banned'])->get('/article/edit/{id}',[\App\Http\Controllers\IndexController::class,'editArticle'])->name('editArticle');
Route::middleware(['authCustom','userCheck:id','banned'])->get('/task/update/{id}',[\App\Http\Controllers\IndexController::class,'updateTask'])->name('updateTask');
Route::middleware(['authCustom','banned'])->get('/becomeExecutor/',[\App\Http\Controllers\IndexController::class,'becomeExecutor'])->name('becomeExecutor');
Route::middleware('banned')->get('/catalog/search',[\App\Http\Controllers\IndexController::class,'catalogSearch'])->name('catalogSearch');
Route::middleware('banned')->get('/catalog/filter',[\App\Http\Controllers\IndexController::class,'catalogFilter'])->name('catalogFilter');
Route::middleware(['authCustom','admin','banned'])->get('/admin/allTasks',[\App\Http\Controllers\IndexController::class,'adminAllTasks'])->name('adminAllTasks');
Route::middleware(['authCustom','admin','banned'])->get('/admin/allCategories',[\App\Http\Controllers\IndexController::class,'adminAllCategories'])->name('adminAllCategories');
Route::middleware('banned')->get('/reset-password',[\App\Http\Controllers\IndexController::class,'resetPassword'])->name('resetPassword');
Route::middleware(['authCustom','admin','banned'])->get('/all-complaints',[\App\Http\Controllers\IndexController::class,'allComplaints'])->name('adminAllComplaints');

//AuthController
Route::post('/registration',[\App\Http\Controllers\AuthController::class,'signup'])->name('signup');
Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
Route::post('/login',[\App\Http\Controllers\AuthController::class,'signin'])->name('signin');

//ArticleController
Route::middleware(['authCustom','admin','banned'])->post('/article/create/post',[\App\Http\Controllers\ArticleController::class,'articleCreate'])->name('articleCreate.post');
Route::middleware('banned')->get('/article/{id}',[\App\Http\Controllers\ArticleController::class,'show'])->name('singleArticle');
Route::middleware(['authCustom','admin','banned'])->get('/article/delete/{id}',[\App\Http\Controllers\ArticleController::class,'destroy'])->name('articleDelete');
Route::middleware(['authCustom','admin','banned'])->post('/edit/article/{article:id}',[\App\Http\Controllers\ArticleController::class,'editArticle'])->name('editArticle.post');

//TaskController
Route::middleware(['authCustom','banned'])->post('/task/create',[\App\Http\Controllers\TaskController::class,'create'])->name('createTask');
Route::middleware('banned')->get('/task/{id}',[\App\Http\Controllers\TaskController::class,'singleTask'])->name('singleTask');
Route::middleware(['authCustom','banned'])->post('/update/task/{task:id}',[\App\Http\Controllers\TaskController::class,'update'])->name('update.post');
Route::middleware(['authCustom','userCheck:id','banned'])->get('/task/delete/{id}',[\App\Http\Controllers\TaskController::class,'destroy'])->name('delete.post');
Route::middleware(['authCustom','banned'])->post('/becomeExecutor/',[\App\Http\Controllers\TaskController::class,'becomeExecutor'])->name('becomeExecutor');

//UserController
Route::middleware(['authCustom','banned'])->get('/profile/edit/{user:id}',[\App\Http\Controllers\UserController::class,'editProfile'])->name('editProfile');
Route::middleware(['authCustom','banned'])->post('/update/profile/{user:id}',[\App\Http\Controllers\UserController::class,'update'])->name('updateProfile');
Route::middleware('banned')->post('/resetPassword',[\App\Http\Controllers\UserController::class,'reset'])->name('reset.post');
Route::middleware(['authCustom','admin','banned'])->get('/blockUser/{user:id}',[\App\Http\Controllers\UserController::class,'blockUser'])->name('blockUserAdmin');
Route::middleware(['authCustom','admin','banned'])->get('/unblockUser/{user:id}',[\App\Http\Controllers\UserController::class,'unblockUser'])->name('unblockUserAdmin');

//ApplicationController
Route::middleware(['authCustom','banned'])->get('/my-orders-customer',[\App\Http\Controllers\ApplicationController::class,'ordersCustomer'])->name('ordersCustomer');
Route::middleware(['authCustom','banned'])->get('/my-orders-executor',[\App\Http\Controllers\ApplicationController::class,'ordersExecutor'])->name('ordersExecutor');
Route::middleware(['authCustom','banned'])->get('/my-orders-all',[\App\Http\Controllers\ApplicationController::class,'ordersAll'])->name('ordersAll');
Route::middleware(['authCustom','banned'])->get('/my-respond-orders',[\App\Http\Controllers\ApplicationController::class,'respondOrders'])->name('respondOrders');
Route::middleware('banned')->get('/respondUsers/{task:id}',[\App\Http\Controllers\ApplicationController::class,'respondUsers'])->name('respondUsers');
Route::middleware(['authCustom','banned'])->get('/respond/{task:id}',[\App\Http\Controllers\ApplicationController::class,'respond'])->name('respond');
Route::middleware(['authCustom','banned'])->get('/respond/accept/{application:id}',[\App\Http\Controllers\ApplicationController::class,'respondAccept'])->name('respondAccept');
Route::middleware(['authCustom','banned'])->get('/respond/cancel/{id}',[\App\Http\Controllers\ApplicationController::class,'respondCancel'])->name('respondCancel');
Route::middleware(['authCustom','banned'])->get('/orders/finish/{application:id}',[\App\Http\Controllers\ApplicationController::class,'finishOrder'])->name('finishOrder');


//FeedbackController

Route::middleware(['auth','banned'])->post('/feedback/create',[\App\Http\Controllers\FeedbackController::class,'create'])->name('createFeedback');
Route::middleware(['authCustom','banned'])->get('/feedback/delete/{id}',[\App\Http\Controllers\FeedbackController::class,'destroy']) ->name('feedbackDestroy');
//CategoryController

Route::middleware(['authCustom','admin','banned'])->get('/category/delete/{id}',[\App\Http\Controllers\CategoryController::class,'destroy'])->name('deleteCategory');
Route::middleware(['authCustom','admin','banned'])->post('/create/category',[\App\Http\Controllers\CategoryController::class,'create'])->name('createCategory');

//complaintController

Route::middleware(['authCustom','banned'])->post('/send-complaint',[\App\Http\Controllers\ComplaintController::class,'sendComplaint'])->name('sendComplaint');
Route::middleware(['authCustom','admin','banned'])->get('/block-user/{complaint:id}',[\App\Http\Controllers\ComplaintController::class,'blockUser'])->name('blockUser');
Route::middleware(['authCustom','admin'])->get('/delete-task/{complaint:id}',[\App\Http\Controllers\ComplaintController::class,'deleteTask'])->name('deleteTask');
Route::middleware(['authCustom','admin','banned'])->get('/delete-complaint/{complaint:id}',[\App\Http\Controllers\ComplaintController::class,'cancelComplaint'])->name('cancelComplaint');
