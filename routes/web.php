<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditUsersController;
use App\Http\Controllers\EditVideoController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\MembershipsController;
use App\Http\Controllers\PublicVideosController;
use App\Http\Controllers\UploadVideosController;
use App\Http\Controllers\EditCategorieController;
use App\Http\Controllers\UploadImagenesController;
use App\Http\Controllers\EditMembershipsController;
use App\Http\Controllers\CategorieImagenescontroller;
use App\Http\Controllers\PublicCategoriesController;
use App\Http\Controllers\PublicMembershipsController;
use App\Http\Middleware\CheckRol;

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

Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('CheckRol');

Route::get('/memberships', [PublicMembershipsController::class, 'index'])->name('memberships.index');

Route::get('/pagos/respuesta', [PublicMembershipsController::class, 'boldCallback'])->name('memberships.bold');

// Rutas para crear y mostrar todo lo que tiene que ver con Users
Route::middleware('CheckRol')->prefix('/dashboard/users')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('dashboard.users.index');
    Route::post('/', [UsersController::class, 'search'])->name('dashboard.users.search');
    Route::delete('/{user}', [UsersController::class, 'destroy'])->name('dashboard.users.destroy');
    Route::get('/edit/{user}', [EditUsersController::class, 'index'])->name('dashboard.editUsers.index');
    Route::post('/edit/{user}', [EditUsersController::class, 'store'])->name('dashboard.editUsers.store');
});

// Rutas para crear y mostrar todo lo que tiene que ver con videos
Route::middleware('CheckRol')->prefix('/dashboard/videos')->group(function () {
    Route::get('/', [VideoController::class, 'index'])->name('dashboard.videos.index');
    Route::get('/create', [VideoController::class, 'create'])->name('dashboard.videos.create');
    Route::post('/store', [VideoController::class, 'store'])->name('dashboard.videos.store');
    Route::delete('/{video}', [VideoController::class, 'destroy'])->name('dashboard.videos.destroy');
    Route::get('/edit/{video}', [EditVideoController::class, 'index'])->name('dashboard.editVideo.index');
    Route::post('/edit/{video}', [EditVideoController::class, 'store'])->name('dashboard.editVideo.store');
});

Route::get('/videos', [PublicVideosController::class, 'index'])->name('videos.index');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('video.show');
Route::post('/videos/{video}', [CommentController::class, 'store'])->name('comments.store');

Route::post('/videos/{video}/likes', [LikeController::class, 'store'])->name('videos.likes.store');
Route::delete('/videos/{video}/likes', [LikeController::class, 'destroy'])->name('videos.likes.destroy');

// Rutas para crear y mostrar todo lo que tiene que ver con categories
Route::middleware('CheckRol')->prefix('/dashboard/categories')->group(function () {
    Route::get('/', [CategorieController::class, 'index'])->name('dashboard.categories.index');
    Route::get('/create', [CategorieController::class, 'create'])->name('dashboard.categories.create');
    Route::post('/store', [CategorieController::class, 'store'])->name('dashboard.categories.store');
    Route::delete('/{categorie}', [CategorieController::class, 'destroy'])->name('dashboard.categories.destroy');
    Route::get('/edit/{categorie}', [EditCategorieController::class, 'index'])->name('dashboard.editCategorie.index');
    Route::post('/edit/{categorie}', [EditCategorieController::class, 'store'])->name('dashboard.editCategorie.store');
})->withoutMiddleware([CheckRol::class]);

Route::get('/video-categories', [PublicCategoriesController::class, 'index'])->name('categories.index');
Route::get('/video-categories/{category:title}', [PublicCategoriesController::class, 'show'])->name('categories.show');

// Rutas para crear y mostrar todo lo que tiene que ver con Memberships
Route::middleware('CheckRol')->prefix('/dashboard/memberships')->group(function () {
    Route::get('/', [MembershipsController::class, 'index'])->name('dashboard.memberships.index');
    Route::get('/create', [MembershipsController::class, 'create'])->name('dashboard.memberships.create');
    Route::post('/create', [MembershipsController::class, 'store'])->name('dashboard.memberships.store');
    Route::delete('/{membership}', [MembershipsController::class, 'destroy'])->name('dashboard.memberships.destroy');
    Route::get('/edit/{membership}', [EditMembershipsController::class, 'index'])->name('dashboard.editMemberships.index');
    Route::post('/edit/{membership}', [EditMembershipsController::class, 'store'])->name('dashboard.editMemberships.store');
});

// Almacenar Videos e Imagenes
Route::post('/categories/imagenes', [CategorieImagenescontroller::class, 'store'])->name('categories.imagenes.store');
Route::post('/uploads/imagenes', [UploadImagenesController::class, 'store'])->name('imagenes.store');
Route::post('/uploads/videos', [UploadVideosController::class, 'store'])->name('videos.store');

// Rutas del perfil
Route::get('/edit-profile', [EditProfileController::class, 'index'])->name('editProfile.index');
Route::post('/edit-profile', [EditProfileController::class, 'store'])->name('editProfile.store');
Route::get('/{user:username}', [ProfileController::class, 'index'])->name('profile.index');
