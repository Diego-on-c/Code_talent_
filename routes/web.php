<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::match(['get', 'post'], '/promotion', function () {
    return view('dashboardAdmin.promotions');
});


Route::resource('/candidate', 'CandidateController');
Route::resource('/promotion', 'PromotionController');
Route::resource('/courses', 'CourseController');


Route::get('/dashboard', function () {
    return view('dashboardAdmin.dashboard');
});

Route::get('/charts', function () {
    return view('dashboardAdmin.charts');
});
Route::get('/perfil', function () {
    return view('dashboardAdmin.perfil');
});
Route::get('/promotions', function () {
    return view('dashboardAdmin.promotions');
});


Route::get('/scrappy', 'ScrapingController@getData')->name('scrapy');
