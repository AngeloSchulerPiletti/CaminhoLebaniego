<?php

use App\Http\Controllers\ViewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleListController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


/* +==========================+
   |     ASK FOR CONTENT      | 
   +==========================+*/
Route::get('/content/{page}', [ViewsController::class, 'getPageContent']);
Route::get('/lista-de-artigos/{keyword}/{page?}/{perpage?}/{status?}', [ArticleListController::class, 'getArticles']);
Route::get('/artigo/{url}', [ArticleController::class, 'index']);



/* +==========================+
   |      AUTHENTICATION      | 
   +==========================+*/
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);



/* +==========================+
   |       ADMIN ROUTES       | 
   +==========================+*/
Route::middleware('auth:sanctum')->post('/novo-artigo', [ArticleController::class, 'store']);



/* +==========================+
   |       ROTA DE TESTE      | 
   +==========================+*/
Route::middleware('auth:sanctum')->get('/teste', function(Request $request){
    return 'deu certo!!';
});