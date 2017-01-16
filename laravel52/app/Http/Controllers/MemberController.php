<?php

namespace App\Http\Controllers;

use App\Model\Member;

class MemberController extends Controller
{

    public function info1(){
        //return 'Member Info1';

        return Member::getMemberInfo();
    }

    public function info2(){
        return route('member-info2');
    }

    public function info3($id){
        return '带参数的控制器，参数为：' . $id;
    }



}
