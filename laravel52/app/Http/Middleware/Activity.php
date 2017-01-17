<?php
/**
 * Created by PhpStorm.
 * User: xiangligu
 * Date: 2017/1/17
 * Time: 下午10:06
 *
 * 自定义的middleware中间件。需要在\App\Http\Kernel.php中注册我们自定义的中间件后，才可以在routes.php中使用该中间件
 */

namespace App\Http\Middleware;

use Closure;

class Activity
{

    /** handle()方法是固定的名称。这里定义的为中间件的前置过滤功能。
     * 具体含义是：
     * 如果当前时间早于2017-01-10，所有经过该中间件过滤的请求都重定向至activity0页面（活动页面），
     * 否则使用 $next($request) 直接跳过处理进入实际请求。
     **/
    public function handle($request, Closure $next){
        if (time() < strtotime('2017-01-10')) {
            return redirect('activity0');
        }

        return $next($request);   //这里是实际发生的请求，中间件的处理逻辑在实际请求之前，是为"前置"
    }




    /** 后置操作功能大概逻辑示意 **/
//    public function handle($request, Closure $next){
//        $response = $next($request);    //这里是实际发生的请求，中间件的处理逻辑在实际请求之后，是为"后置"
//        //var_dump($response);
//
//        echo '这里是后置操作的逻辑。。。。' . $response;
//    }


}