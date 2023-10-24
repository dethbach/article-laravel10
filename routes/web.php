<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountManagementController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ArticleAdminController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ShipyardController;
use App\Http\Controllers\SitemapController;
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

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('service-center');
});

Route::get('sitemap.xml', [SitemapController::class, 'generate']);

Route::get('/customer/ask', [ShipyardController::class, 'ask'])->name('ask');

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'verified']], function () {
    Route::get('/dashboard', [ShipyardController::class, 'admin'])->name('admin.dashboard');

    Route::get('/categories', [ArticleAdminController::class, 'categories'])->name('article.categories');
    Route::get('/categories/{slug}', [ArticleAdminController::class, 'categoriesPost'])->name('article.categoriesPost');
    Route::get('/author/{id}/{name}', [ArticleAdminController::class, 'authorPost'])->name('article.authorPost');
    Route::get('/author/{id}/{name}/publish', [ArticleAdminController::class, 'authorPostPublish'])->name('article.authorPost.publish');
    Route::get('/author/{id}/{name}/draft', [ArticleAdminController::class, 'authorPostDraft'])->name('article.authorPost.draft');
    Route::post('/create-new-category', [ArticleAdminController::class, 'categoriesStore'])->name('article.categories.store');
    Route::get('/category/{id}/delete', [ArticleAdminController::class, 'categoriesDelete'])->name('article.categories.delete');

    Route::get('/write-post', [ArticleAdminController::class, 'write'])->name('article.write');
    Route::post('/post-article', [ArticleAdminController::class, 'store'])->name('article.store');
    Route::post('/update-article/{id}', [ArticleAdminController::class, 'update'])->name('article.update');
    Route::post('/update-thumbnail/{id}', [ArticleAdminController::class, 'updateThumbnail'])->name('article.updateThumbnail');

    Route::get('/posts', [ArticleAdminController::class, 'post'])->name('article.post');
    Route::get('/posts/{slug}', [ArticleAdminController::class, 'show'])->name('article.show');
    Route::get('/posts/{id}/publish', [ArticleAdminController::class, 'status'])->name('article.status');

    Route::post('/delete-article', [ArticleAdminController::class, 'destroy'])->name('article.destroy');

    Route::get('/cities', [CitiesController::class, 'index'])->name('city.index');
    Route::post('/add-new-city', [CitiesController::class, 'store'])->name('city.store');
    Route::get('/city/{id}/delete', [CitiesController::class, 'destroy'])->name('city.destroy');

    Route::get('/profile', [AccountController::class, 'index'])->name('account.index');
    Route::post('/profile/update-profpic', [AccountController::class, 'profpic'])->name('account.profpic');
    Route::get('/profile/delete-profpic', [AccountController::class, 'deleteprofpic'])->name('account.deleteprofpic');
    Route::post('/profile/update', [AccountController::class, 'update'])->name('account.update');
    Route::post('/profile/change-password', [AccountController::class, 'store'])->name('account.store');

    Route::get('/account', [AccountManagementController::class, 'index'])->name('account.management.index');
    Route::get('/account/{username}', [AccountManagementController::class, 'show'])->name('account.management.show');
    Route::post('/account/role-update', [AccountManagementController::class, 'update'])->name('account.management.update');

    Route::get('/get-sum-post/{id}', [AjaxController::class, 'categoryPost'])->name('ajax.categoryPost');
    Route::get('/get-sum-article/{id}', [AjaxController::class, 'userPost'])->name('ajax.userPost');
    Route::get('/get-sum-draft/{id}', [AjaxController::class, 'userDraft'])->name('ajax.userDraft');
});

Route::group(['prefix' => 'user', 'middleware' => ['isUser', 'auth', 'verified']], function () {
    Route::get('/dashboard', [ShipyardController::class, 'user'])->name('user.dashboard');
});

Route::get('/article', [ShipyardController::class, 'article'])->name('article');
Route::get('/{slug}', [ShipyardController::class, 'slug'])->name('slug');
