<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
| ---------------------------------------------------------------------------
| 在这里注册用到的所有的路由，非常简单，只要指定路由的url和用来响应该路由的控制器方法即可。
|
*/

Route::get('/', function () {
    return view('welcome');
});


//get
Route::get('basic1', function () {
    return 'Basic 1';
});


//post
Route::post('basic2', function () {
    return 'Basic 2';
});


//多请求，使用match或any
Route::match(['get', 'post'], 'multi1', function () {
    return 'Multi Method Response';
});

Route::any('multi2', function () {
    return 'Any Request Respones';
});


// 带路径变量的请求
//Route::get('user/{id}', function ($id) {
//    return 'user id: ' . $id;
//});


// 带路径变量的请求，指定默认值，注意URL中变量名称后面需要带"?"才能指定默认值
//Route::get('user/{name?}', function ($name = 'guguxl') {
//    return 'user name: ' . $name;
//}) -> where('name','[a-zA-Z]+');    // 还可以使用正则表达式限制变量的形式，


//带多变量的路径，正则表达式的where函数中接收一个数组限定对于变量的正则表达式
Route::get('user/{id}/{name?}', function ($id, $name = 'guguxl') {
    return 'user id: ' . $id .
        '<br> user name: ' . $name;
}) -> where([
    'id' => '[0-9]+',
    'name' => '[a-zA-Z]+'
]);    // 还可以使用正则表达式限制变量的形式，


//路由别名：可以为某个URL指定一个别名，后续在程序代码中可以使用route()方法获取到别名所对应的真正的URL。
//取了别名之后的URL，如果以后需要修改为其他的，则始终可以根据域名获取到最新的URL。
Route::get('route/samplexxx', [
    'as' => 'sample-alias',
    function () {
        return route('sample-alias');
    }
]);


//路由群组，第一个参数使用prefix来指定路由群组的URL前缀，该群组内的所有URL请求都要带上该前缀才能访问到
Route::group(['prefix' => 'top'], function() {

    //这里写群组内的第一个请求，组合后的完整URL为：top/sub1
    Route::get('sub1', function () {
        return 'the url is: top/sub1';
    });

    //这里写群组内的第二个请求，组合后的完整URL为：top/sub2
    Route::get('sub2', [
        'as' => 'sub2-alias',
        function () {
            return route('sub2-alias');
        }
    ]);

});


//路由中输出视图，默认的视图存放根路径为 resources/views，
//可以在该根路径下建立子目录，则view方法的视图名中应该带上该子目录
//视图文件名的命名规则为：{视图名}.blade.php
//  使用view("${视图名}")来输出对应的视图
Route::get('home', function () {
    return view('home');
});




//和控制器相关的路由
//方法一：直接写控制器的类名和方法名
Route::get('member/info1', 'MemberController@info1');
//方法二：使用数组指定控制器的相关信息，有更多选择
Route::get('member/info2', [
    'uses' => 'MemberController@info2',
    'as' => 'member-info2'
]);
//带参数的控制器
Route::get('member/{id}', 'MemberController@info3')
    ->where('id', '[0-9]+');    //使用正则表达式限制id的形式



//输出视图，并向视图传递变量
//在视图模版文件中使用{{$varname}}来获取变量的值。
//注意，视图文件的名称一定要为 *.blade.php 形式
Route::get('member/view/1st', function () {
   return view('member/1st', [
       'name' => '顾祥利',
       'age' => 18
   ]);
});



//测试数据库操作StudentController
Route::get('student/facade', 'StudentController@facadeCurd');
Route::get('student/query-builder', 'StudentController@queryBuilderCurd');
Route::get('student/eloquent-model', 'StudentController@eloquentModelCurd');



//测试request, response, session等相关web功能支持
//将需要测试session功能的请求放在一个route组中，该组启用web中间件，该中间件将会启用session功能
Route::group(['middleware' => ['web']], function () {
    Route::get('web/request1', [
        'as' => 'alias-request1',
        'uses' => 'RequestController@request1'
    ]);
    Route::get('web/session1', 'RequestController@session1');
    Route::get('web/session2', 'RequestController@session2');
    Route::get('web/response1', 'RequestController@response1');
});




//中间件功能测试相关路由
//activity0宣传页面不用经过中间件activity验证处理
Route::get('activity0', 'MiddlewareController@activity0');
//只有宣传页面activity1，activity2才需要经过中间件验证处理
Route::group(['middleware' => ['activity']], function () {
    Route::get('activity1', 'MiddlewareController@activity1');
    Route::get('activity2', 'MiddlewareController@activity2');
});






/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|--------------------------------------------------------------------------
| 使用group方法的"middleware"关键字指定该路由群组内所有路由需要使用的中间件。
| 这里使用web中间件，该中间件定义在http内核中，包含了session状态管理、csrf攻击防护等等功能。
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
