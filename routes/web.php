<?php

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/edit', 'UserController@index')->name('users.name_change');
    Route::post('/edit', 'UserController@edit');

    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');

    Route::group(['middleware' => 'can:view,folder'], function() {
        Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');

        Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

        Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
        Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');

        Route::get('/folders/{folder}/tasks/{task}/url', 'TaskController@showUrlShareForm')->name('tasks.url');
        
    });
});

Route::get('/folders/tasks/share/{share_url}', 'TaskController@showShareForm')->name('tasks.share');

Auth::routes();
