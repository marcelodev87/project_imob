<?php

use Illuminate\Support\Facades\Route;
use LaraDev\Http\Controllers\Admin\ContractController;

Route::group(['namespace' => 'Web', 'as' => 'web.'], function(){

    // ================================= Página Inicial ===========================
    route::get('/', 'WebController@home')->name('home');

    // ================================= Página de Locação ===========================
    route::get('/quero-alugar', 'WebController@rent')->name('rent');

    // ============================ Página de Locação de um imóvel específico ==============
    route::get('/quero-alugar/{slug}', 'WebController@rentProperty')->name('rentProperty');

    // ================================= Página de Compra ===========================
    route::get('/quero-comprar', 'WebController@buy')->name('buy');

    // ================================= Página de Compra de um Imóvel ===========================
    route::get('/quero-comprar/{slug}', 'WebController@buyProperty')->name('buyProperty');

    // ================================= Página de Inicial ===========================
    route::match(['post', 'get'], '/filtro', 'WebController@filter')->name('filter');

    // ================================= Página de Experiências ===========================
    route::get('/experiencias', 'WebController@experience')->name('experience');

    // ================================= Página de Experiências de uma Categoria ===========================
    route::get('/experiencias/{slug}', 'WebController@experienceCategory')->name('experienceCategory');

    // ================================= Página de Contato ===========================
    route::get('/contact', 'WebController@contact')->name('contact');
});
//==================================== Pesquisa avançada =================================================
Route::group(['prefix' => 'component', 'namespace' => 'Web', 'as' => 'component.'], function(){
    Route::post('main-filter/search', 'FilterController@search')->name('main-filter.search');
    Route::post('main-filter/category', 'FilterController@category')->name('main-filter.category');
    Route::post('main-filter/type', 'FilterController@type')->name('main-filter.type');
    Route::post('main-filter/neighborhood', 'FilterController@neighborhood')->name('main-filter.neighborhood');
    Route::post('main-filter/bedrooms', 'FilterController@bedrooms')->name('main-filter.bedrooms');
    Route::post('main-filter/suites', 'FilterController@suites')->name('main-filter.suites');
    Route::post('main-filter/bathrooms', 'FilterController@bathrooms')->name('main-filter.bathrooms');
    Route::post('main-filter/garage', 'FilterController@garage')->name('main-filter.garage');
    Route::post('main-filter/price-base', 'FilterController@priceBase')->name('main-filter.priceBase');
    Route::post('main-filter/price-limit', 'FilterController@priceLimit')->name('main-filter.priceLimit');
});

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
