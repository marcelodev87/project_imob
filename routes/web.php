<?php

use Illuminate\Support\Facades\Route;
use LaraDev\Http\Controllers\Admin\ContractController;

Route::group(['prefix' => 'admin' , 'namespace' => 'Admin', 'as' => 'admin.'] , function () {

    //Formulário de Login
    Route::get('/', 'AuthController@showLoginForm')->name('login');
    Route::post('login', 'AuthController@login')->name('login.do');

    //Rotas protegidas pelo login
    Route::middleware(['auth'])->group(function () {
        //Dashboard
        Route::get('home' , 'AuthController@home')->name('home');

        // Users
        Route::get('users/team','UserController@team')->name('users.team');
        Route::resource('users', 'UserController');

        //Companies
        Route::resource('companies', 'CompanyController');

        //Properties
        Route::post('properties/image-set-cover', 'PropertyController@imageSetCover')->name('properties.imageSetCover');
        Route::delete('properties/image-remove', 'PropertyController@imageRemove')->name('properties.imageRemove');
        Route::resource('properties', 'PropertyController');

       /** Contratos */
       Route::post('contracts/get-data-owner', 'ContractController@getDataOwner')->name('contracts.getDataOwner');
       Route::post('contracts/get-data-acquirer', 'ContractController@getDataAcquirer')->name('contracts.getDataAcquirer');
       Route::post('contracts/get-data-property', 'ContractController@getDataProperty')->name('contracts.getDataProperty');
       Route::resource('contracts', 'ContractController');


    });


    //Logout
    Route::get('logout' , 'AuthController@logout')->name('logout');

});
