<?php
/**
 * Created by PhpStorm.
 * User: guxl
 * Date: 2017/1/17
 * Time: 17:11
 */

namespace App\Http\Controllers;


class MiddlewareController extends Controller
{
    //定义宣传页面
    public function activity0 () {
        return '活动快要开始了，敬请期待。。。';
    }

    //活动一页面
    public function activity1 () {
        return '活动一进行中，谢谢参与！';
    }

    //活动二页面
    public function activity2 () {
        return '活动二进行中，谢谢参与！';
    }

}