<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Models\Donor;

Route::namespace('Site')->group(function() {

    // HOME
    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

    // QUEM SOMOS
    Route::get('/about', array('as' => 'about', 'uses' => 'HomeController@about'));

    // PRIVACIDADE
    Route::get('/policy', array('as' => 'privacy', 'uses' => 'HomeController@privacy'));

    // CAMPANHAS
    Route::get('/campaigns', array('as' => 'campaigns-list', 'uses' => 'CampaignsController@index'));
    Route::get('/campaign/{slug}', array('as' => 'campaign-details', 'uses' => 'CampaignsController@details'));

    // DOAÇÕES
    Route::get('/donation/{slug}', array('as' => 'donation', 'uses' => 'DonationController@create'));
    Route::post('/donation/{slug}/donate-openly', array('as' => 'donation-openly', 'uses' => 'DonationController@openly'));
    Route::post('/donation/{slug}/donate-completed', array('as' => 'donation-completed', 'uses' => 'DonationController@completed'));
    Route::get('/donation/{donor}/donation-done', array('as' => 'donation-done', 'uses' => 'DonationController@done'));
    Route::post('/check-txid', array('as' => 'donation-checktxid', 'uses' => 'DonationController@checktxid'));

    // PESQUISA
    Route::post('/search/', array('as' => 'search', 'uses' => 'SiteController@search'));

    // DOADORES
    Route::get('/donors-list/', array('as' => 'donors', 'uses' => 'DonorController@donors'));


    Route::get('/dev-item', function(){

        dd(Donor::all());

    });

});
