<?php



Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', 'Auth\LoginController@show')->name('user.show');
    Route::get('/register', 'Auth\RegisterController@show');


    Route::POST('/login', 'Auth\LoginController@login')->name('user.login');
    Route::POST('/register', 'Auth\RegisterController@register')->name('user.store');
});
Route::delete('logout', 'Auth\LoginController@logout')->name('logout');




Route::group(['middleware' => 'auth'], function () {

    Route::resource('users', 'Base\UsersController', ['only' => ['show', 'update', 'edit']]);


    Route::get('/', 'Base\IndexController@show')->name('index');
    Route::get('/index','Base\IndexController@show')->name('index');
    Route::get('/token','Base\TokenController@show')->name('token');


    Route::POST('/token/create','Base\TokenController@create')->name('token/create');
    Route::GET('/token/delect','Base\TokenController@delete')->name('token/delete');
    Route::POST('/token/update','Base\TokenController@update')->name('token/update');


    Route::group(['middleware'=>'throttle:10'],function(){
        Route::get('/get_show_pluglist', 'Base\TemplateController@show');
        Route::get('/get_update_pluglist', 'Base\TemplateController@update');

        Route::get('/get_templates', 'Base\TemplateController@get_templates');
        Route::get('/set_templates', 'Base\TemplateController@set_templates');
    });




    Route::group(['prefix'=>'shop','middleware'=>'throttle:10'],function(){
        Route::POST('/buy', 'Base\ShopController@buy')->name('buy');
    });








    Route::group(array('prefix'=>'game'),function()
    {

        Route::group(array('prefix'=>'{game}'),function()
        {
            Route::get('/','Game\BaseController@create')->name('game.show');

            Route::get('/template','Game\BaseController@template')->name('game.template');
            Route::get('/database','Game\BaseController@database')->name('game.database');
            Route::get('/pluglist','Game\BaseController@pluglist')->name('game.pluglist');
            Route::get('/plugshop','Game\BaseController@plugshop')->name('game.plugshop');



            Route::group(['middleware'=>'throttle:5'],function(){
                Route::GET('/template/delete', 'Base\TemplateController@delete')->name('template.delete');
                Route::POST('/template/create', 'Base\TemplateController@create')->name('template.create');

                Route::POST('/server/update', 'Game\BaseController@update')->name('server.update');
                Route::GET('/server/delete', 'Game\BaseController@delete')->name('server.delete');
            });

        });




        /*
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

        */
    });


    Route::group(array('prefix'=>'Manager'),function()
    {
        Route::get('/','Admin\AdminController@create')->middleware('can:view,App\Models\PlugShop')->name('admin.index');




        Route::group(array('prefix'=>'Game/{GameId}'),function()
        {



            Route::get('/Plug','Admin\PlugController@show')->name("admin.plug");
            Route::POST('/Plug/Updata','Admin\PlugController@updata')->name("admin.plug.updata");
            Route::POST('/Plug/Publish','Admin\PlugController@publish')->name('admin.plug.publish');

            Route::get('/Storage','Admin\StorageController@show')->name('admin.storage');
            Route::POST('/Storage/Publish','Admin\StorageController@publish')->name('admin.storage.publish');
            Route::POST('/Storage/Updata','Admin\StorageController@updata')->name('admin.storage.updata');




        });


    });







});




