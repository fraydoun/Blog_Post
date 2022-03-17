<?php

use Illuminate\http\Request;


Route::prefix('admin')->group(function(){
    // Route::Group(['namespace' => 'Fraidoon\Blog\Http\Livewire'], function(){
    //     // Route::get('postCreate', PostCreate::class)->name('postCreate');
    // });
    
    Route::Group(['namespace' => 'Fraidoon\Blog\Http\Controllers'], function(){
        Route::group(['middleware' => ['web']], function () {
            
            Route::get('home',function(){
                return "home";
            })->name('home');
    
            Route::get('category', 'BlogCategoryController@index')->name('category');
            
            Route::get('post', 'BlogPostController@index')->name('post');
            Route::get('postCreate', 'BlogPostController@createIndex')->name('postCreate');
            Route::post('poststore', 'BlogPostController@store')->name('poststore');            
            Route::get('postsedit/{id}', 'BlogPostController@edit')->name('postsedit');
            Route::put('postsupdate/{id}', 'BlogPostController@update')->name('postsupdate');

            Route::get('comment', 'BlogCommentController@index')->name('comment');
        });
    });
});
