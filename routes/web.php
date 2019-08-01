<?php



Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', 'Auth\LoginController@create')->name('login');
    Route::POST('/login', 'Auth\LoginController@store')->name('login');
});
Route::delete('logout', 'Auth\LoginController@logout')->name('logout');




Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'Base\IndexController@show')->name('index');
    Route::get('/index','Base\IndexController@show')->name('index');
    Route::get('/token','Base\TokenController@show')->name('token');


    Route::POST('/token/create','Base\TokenController@create')->name('token/create');
    Route::GET('/token/delect','Base\TokenController@delete')->name('token/delete');
    Route::POST('/token/update','Base\TokenController@update')->name('token/update');



    Route::group(['prefix'=>'shop','middleware'=>'throttle:4'],function(){
        Route::POST('/buy', 'Shop\ShopController@buy')->name('buy');
        Route::POST('/template/create', 'Game\TemplateController@create')->name('template/create');
    });

    Route::get('/post_pluglist', 'Plug\PlugController@pluglist')->name('Post_PlugList');


    Route::group(array('prefix'=>'game'),function()
    {

        Route::get('{game}/', function ($postId) {
            $namespace = 'App\Http\Controllers\Game\\';
            $className = $namespace . ("Game_" . $postId);
            $tempObj = new $className();
            return call_user_func(array($tempObj,'create'));
        });


        Route::get('{game}/{commentId}', function ($postId,$commentId) {
            $namespace = 'App\Http\Controllers\Game\\';
            $className = $namespace . ("Game_" . $postId);
            $tempObj = new $className();
            return call_user_func(array($tempObj,$commentId));
        })->where('commentId', '[a-z]+');

    });
    
});




