<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdministrativeTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientBankAccountController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CustomerCaptureController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PlanAccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RealEstateAgencyController;
use App\Http\Controllers\RealEstateBranchController;
use App\Http\Controllers\RealtyController;
use App\Http\Controllers\SchedulingController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\RealtyStatusController;
use App\Http\Controllers\RealtyTypeController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\ImobiliariaController;
use App\Http\Controllers\Api\ImovelController;
use App\Http\Controllers\Api\FornecedorController;
use App\Http\Controllers\Api\ParceiroController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::resource('realestateagency', RealEstateAgencyController::class);
    Route::resource('realestatebranch', RealEstateBranchController::class);
    Route::put('realestatebranch/{id}', [RealEstateBranchController::class, 'update']);
    Route::resource('customercapture', CustomerCaptureController::class);
    Route::resource('client', ClientController::class);
    Route::resource('clientbank', ClientBankAccountController::class);
    Route::resource('owner', OwnerController::class);
    Route::resource('partner', PartnerController::class);
    Route::resource('provider', ProviderController::class);
    Route::resource('planaccount', PlanAccountController::class);
    Route::post('partner/{id}', [PartnerController::class, 'update']);
    Route::resource('user', UserController::class);
    Route::resource('realty', RealtyController::class);
    Route::put('realty/{id}', [RealtyController::class, 'update']);
    Route::resource('realtystatus', RealtyStatusController::class);
    Route::resource('realtytype', RealtyTypeController::class);
    Route::resource('scheduling', SchedulingController::class);
    Route::resource('administrativetask', AdministrativeTaskController::class);
    Route::post('administrativetask/{id}', [AdministrativeTaskController::class, 'update']);
    Route::post('address', [AddressController::class, 'getAddress']);

    Route::resource('imobiliaria', ImobiliariaController::class);
    Route::resource('imovel', ImovelController::class);
    Route::resource('fornecedor', FornecedorController::class);
    Route::resource('parceiro', ParceiroController::class);
    Route::resource('cliente', ClienteController::class);
});

Route::post('login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class,'logout']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/index', [UserController::class, 'index']);
