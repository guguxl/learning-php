<?php
/**
 * Created by PhpStorm.
 * User: guxl
 * Date: 2017/1/17
 * Time: 09:54
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RequestController extends Controller
{
    public function request1 (Request $request) {

        //取请求参数的值，假设参数名称为name，如果无该参数，则返回默认值
        echo $request->input('name','默认等名称');
        echo '<br>';

        //判断是否有对应的参数
        if($request->has('name')){
            echo '参数name的值：' . $request->input('name');
        }else{
            echo '无名称为name的请求参数';
        }
        echo '<br>';

        //获取所有的请求参数
        var_dump($request->all());
        echo '<br>';

        //获取请求的方式：post or get
        echo $request->method();
        echo '<br>';

        //判断请求类型
        if($request->isMethod('get')){
            echo '这是一个get请求';
        }else{
            echo 'not a get request';
        }

        //判断是否ajax请求
        if($request->ajax()){
            echo '<br>这是一个ajax请求';
        }else{
            echo '<br>这不是ajax请求';
        }

        //判断请求是否符合url规则
        if($request->is('web/*')){
            echo '<br>这是一个web路径的请求';
        }else{
            echo '<br>这不是web路径的请求';
        }

        //获取请求的完整url
        echo '<br>' . $request->url();


        echo '<br><br>' . Session::get('flash-msg', '访问不到flash-msg');

    }



    public function session1(Request $request){
        //清空session
        Session::flush();

        /** 存储数据到session的三种方式 **/

        //1、http request session()
        $request->session()->put('key1', 'value1');

        //2、session()
        session()->put('key2', 'value2');

        //3、Session类
        Session::put('key3', 'value3');

        //4、Session类：数组形式填充值
        Session::put(['key4'=>'value4', 'key5'=>'value5']);

        //5、数据存放在session中
        Session::push('student', 'guguxl');
        Session::push('student', 'liulp');
        Session::push('student', 'hejb');

        //6、flash()：暂存某个属性，用该方法保存的属性只能被读取一次
        Session::flash('key-flash', 'value-flash');
    }

    public function session2(Request $request){
        /** 同session1()方法对应，从session获取数据的三种方式 **/

        echo '<br>方式1获取的key1值：' . $request->session()->get('key1');
        echo '<br>方式2获取的key2值：' . session()->get('key2');
        echo '<br>方式3获取的key3值：' . Session::get('key3');

        echo '<br>方式3获取的key4值，取不到情况下指定的默认值：' . Session::get('key4', 'key4的默认值');
        echo '<br>key5的值：'. Session::get('key5');

        $arr1 = Session::get('student', 'default-student');
        echo '<pre>';
        var_dump($arr1);

        //判断session中是否存在某个属性
        if(Session::has('key4')){
            echo '<br> key4属性存在';
        }else{
            echo '<br> key4属性不存在';
        }

        //取出session中所有的值
        echo '<pre>';
        var_dump(Session::all());

        //forget()方法：删除session中某个属性
        Session::forget('key4');

        //pull()方法：取完session值之后，删除该session。即该方法只能正确地取出一次某个session的属性
        $arr2 = Session::pull('student', 'default-student');
        echo '<pre>';
        var_dump($arr2);

    }


    public function response1() {
        // 返回json格式串，调用respons()的 json()方法
//        $data = array(
//            'errCode' => 0,
//            'errMsg' => 'success',
//            'data' => 'my name is guguxl',
//        );
//        return response()->json($data);


        // 重定向方法1。
        //如有必要，使用with()方法带上跳转时需要传递的数据，该数据通过session机制暂存，跳转后的页面中
        //可以通过session访问到。
//        return redirect('web/request1')
//            ->with('flash-msg', '我是暂存数据，存放在session中，只可以访问到一次！');


        // 重定向方法2。使用action()函数指定要跳转到的action（概念见route）
//        return redirect()->action('RequestController@request1')
//            ->with('flash-msg', '我是暂存数据，存放在session中，只可以访问到一次！');

        // 同理，如果被跳转的路由有别名，也可以使用route('路由别名') 进行跳转
//        return redirect()->route('alias-request1')
//            ->with('flash-msg', '我是暂存数据，存放在session中，只可以访问到一次！');;


        // 重定向（返回）到上一个页面
        return redirect()->back();


    }


}