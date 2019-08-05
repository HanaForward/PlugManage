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


    Route::group(['middleware'=>'throttle:10'],function(){
        Route::get('/get_show_pluglist', 'Plug\PlugController@show');
        Route::get('/get_update_pluglist', 'Plug\PlugController@update');
        Route::get('/get_templates', 'Plug\PlugController@get_templates');
        Route::get('/set_templates', 'Plug\PlugController@set_templates');
    });





    Route::group(['prefix'=>'shop','middleware'=>'throttle:10'],function(){
        Route::POST('/buy', 'Shop\ShopController@buy')->name('buy');

    });


    Route::group(['middleware'=>'throttle:5'],function(){
        Route::GET('/template/delete', 'Game\TemplateController@delete')->name('template/delete');
        Route::POST('/template/create', 'Game\TemplateController@create')->name('template/create');
        Route::POST('/server/update', 'Game\Game_304930@update')->name('server/update');
        Route::GET('/server/delete', 'Game\Game_304930@delete')->name('server/delete');
    });





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




