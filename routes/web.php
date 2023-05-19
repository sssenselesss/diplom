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
Route::get('/catalog',[\App\Http\Controllers\IndexController::class,'catalog'])->name('catalog');
Route::middleware(['authCustom'])->get('/task/create',[\App\Http\Controllers\IndexController::class,'createTask'])->name('createTask');
Route::get('/frequent',[\App\Http\Controllers\IndexController::class,'frequent'])->name('frequent');
Route::get('/articles',[\App\Http\Controllers\IndexController::class,'articles'])->name('articles');
Route::middleware(['authCustom','admin'])->get('/article/create',[\App\Http\Controllers\IndexController::class,'articleCreate'])->name('articleCreate');

Route::get('/myProfile/{user:id}',[\App\Http\Controllers\IndexController::class,'profile'])->name('profile');

Route::middleware(['authCustom','admin'])->get('/users/all',[\App\Http\Controllers\IndexController::class,'adminAllUsers'])->name('adminAllUsers');
Route::middleware(['authCustom','admin'])->get('/search',[\App\Http\Controllers\IndexController::class,'search'])->name('search');
Route::middleware(['authCustom','admin'])->get('/article/edit/{id}',[\App\Http\Controllers\IndexController::class,'editArticle'])->name('editArticle');
Route::middleware(['authCustom','userCheck:id'])->get('/task/update/{id}',[\App\Http\Controllers\IndexController::class,'updateTask'])->name('updateTask');
Route::middleware(['authCustom'])->get('/becomeExecutor/',[\App\Http\Controllers\IndexController::class,'becomeExecutor'])->name('becomeExecutor');
Route::get('/catalog/search',[\App\Http\Controllers\IndexController::class,'catalogSearch'])->name('catalogSearch');
Route::get('/catalog/filter',[\App\Http\Controllers\IndexController::class,'catalogFilter'])->name('catalogFilter');
Route::middleware(['authCustom','admin'])->get('/admin/allTasks',[\App\Http\Controllers\IndexController::class,'adminAllTasks'])->name('adminAllTasks');
Route::middleware(['authCustom','admin'])->get('/admin/allCategories',[\App\Http\Controllers\IndexController::class,'adminAllCategories'])->name('adminAllCategories');
Route::get('/reset-password',[\App\Http\Controllers\IndexController::class,'resetPassword'])->name('resetPassword');
Route::middleware(['authCustom','admin'])->get('/all-complaints',[\App\Http\Controllers\IndexController::class,'allComplaints'])->name('adminAllComplaints');

//AuthController
Route::post('/registration',[\App\Http\Controllers\AuthController::class,'signup'])->name('signup');
Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
Route::post('/login',[\App\Http\Controllers\AuthController::class,'signin'])->name('signin');

//ArticleController
Route::middleware(['authCustom','admin'])->post('/article/create/post',[\App\Http\Controllers\ArticleController::class,'articleCreate'])->name('articleCreate.post');
Route::get('/article/{id}',[\App\Http\Controllers\ArticleController::class,'show'])->name('singleArticle');
Route::middleware(['authCustom','admin'])->get('/article/delete/{id}',[\App\Http\Controllers\ArticleController::class,'destroy'])->name('articleDelete');
Route::middleware(['authCustom','admin'])->post('/edit/article/{article:id}',[\App\Http\Controllers\ArticleController::class,'editArticle'])->name('editArticle.post');

//TaskController
Route::middleware(['authCustom'])->post('/task/create',[\App\Http\Controllers\TaskController::class,'create'])->name('createTask');
Route::get('/task/{id}',[\App\Http\Controllers\TaskController::class,'singleTask'])->name('singleTask');
Route::middleware(['authCustom','userCheck:id'])->post('update/task/{task:id}',[\App\Http\Controllers\TaskController::class,'update'])->name('update.post');
Route::middleware(['authCustom','userCheck:id'])->get('/task/delete/{id}',[\App\Http\Controllers\TaskController::class,'destroy'])->name('delete.post');
Route::middleware(['authCustom'])->post('/becomeExecutor/',[\App\Http\Controllers\TaskController::class,'becomeExecutor'])->name('becomeExecutor');

//UserController
Route::middleware(['authCustom'])->get('/profile/edit/{user:id}',[\App\Http\Controllers\UserController::class,'editProfile'])->name('editProfile');
Route::middleware(['authCustom'])->post('/update/profile/{user:id}',[\App\Http\Controllers\UserController::class,'update'])->name('updateProfile');
Route::post('/resetPassword',[\App\Http\Controllers\UserController::class,'reset'])->name('reset.post');
//ApplicationController
Route::middleware(['authCustom'])->get('/my-orders-customer',[\App\Http\Controllers\ApplicationController::class,'ordersCustomer'])->name('ordersCustomer');
Route::middleware(['authCustom'])->get('/my-orders-executor',[\App\Http\Controllers\ApplicationController::class,'ordersExecutor'])->name('ordersExecutor');
Route::middleware(['authCustom'])->get('/my-orders-all',[\App\Http\Controllers\ApplicationController::class,'ordersAll'])->name('ordersAll');
Route::get('/respondUsers/{task:id}',[\App\Http\Controllers\ApplicationController::class,'respondUsers'])->name('respondUsers');
Route::middleware(['authCustom'])->get('/respond/{task:id}',[\App\Http\Controllers\ApplicationController::class,'respond'])->name('respond');
Route::middleware(['authCustom'])->get('/respond/accept/{application:id}',[\App\Http\Controllers\ApplicationController::class,'respondAccept'])->name('respondAccept');
Route::middleware(['authCustom'])->get('/respond/cancel/{id}',[\App\Http\Controllers\ApplicationController::class,'respondCancel'])->name('respondCancel');
Route::middleware(['authCustom'])->get('/orders/finish/{application:id}',[\App\Http\Controllers\ApplicationController::class,'finishOrder'])->name('finishOrder');

//FeedbackController

Route::middleware(['auth'])->post('/feedback/create',[\App\Http\Controllers\FeedbackController::class,'create'])->name('createFeedback');
Route::middleware(['authCustom'])->get('/feedback/delete/{id}',[\App\Http\Controllers\FeedbackController::class,'destroy']) ->name('feedbackDestroy');
//CategoryController

Route::middleware(['authCustom','admin'])->get('/category/delete/{id}',[\App\Http\Controllers\CategoryController::class,'destroy'])->name('deleteCategory');
Route::middleware(['authCustom','admin'])->post('/create/category',[\App\Http\Controllers\CategoryController::class,'create'])->name('createCategory');

//complaintController

Route::middleware(['authCustom'])->post('/send-complaint',[\App\Http\Controllers\ComplaintController::class,'sendComplaint'])->name('sendComplaint');
Route::middleware(['authCustom','admin'])->get('/block-user/{complaint:id}',[\App\Http\Controllers\ComplaintController::class,'blockUser'])->name('blockUser');
Route::middleware(['authCustom','admin'])->get('/delete-task/{complaint:id}',[\App\Http\Controllers\ComplaintController::class,'deleteTask'])->name('deleteTask');
Route::middleware(['authCustom','admin'])->get('/delete-complaint/{complaint:id}',[\App\Http\Controllers\ComplaintController::class,'cancelComplaint'])->name('cancelComplaint');
