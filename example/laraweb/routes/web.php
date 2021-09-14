<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home',
    ['title' => 'صفحه اصلی سایت من']);
});

Route::get('/news', function () {
    return 'news list page ';
});

//   Route::get('/news/{query}', function ($query) {
//        return view('home',[
//       'query' => $query ,
//         'users' => ['omid' , 'sara'] 
//     ]);
//   });

//  Route::get('/news/{id}', function ($id) {
//       return view('home'
//      ['id' => "$id" ]);
//  });
