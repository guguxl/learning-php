<?php
/**
 * Created by PhpStorm.
 * User: guxl
 * Date: 2017/1/13
 * Time: 21:44
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public static function getMemberInfo() {
        return 'Member Name is guguxl';
    }

}