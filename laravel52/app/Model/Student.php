<?php
/**
 * Created by PhpStorm.
 * User: guxl
 * Date: 2017/1/16
 * Time: 08:18
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //指定该model所映射的后台数据表的名称，如果不指定，则默认为类名的复数，本例中即为students
    protected $table = 'student';

    //指定该model的主键属性，对应于后台数据表中的主键。默认情况下也使用id作为主键
    protected $primaryKey = 'id';

    //是否需要模型自动维护数据创建和修改的时间戳。
    //如果该属性为true，则模型会自动维护记录的创建和修改的时间戳，对应的数据表中需要有created_at和updated_at字段。
    //如果该属性为false，则模型不会自动维护时间戳。
    public $timestamps = true;

    //复写父类Model中的getDateFormat()方法。
    //该方法在 $timestamp=true 的情况下，指定了模型自动维护时间戳的取值方法，模型会将该方法返回的值写入到数据表中。
    //对于mysql数据库，如果不指定该方法，默认写入时间的年份信息。
    //本例中返回unix时间戳。
    protected function getDateFormat()
    {
        return time();
    }

    //复写父类Model中的asDateTime()方法。
    //该方法在 $timestamp=true 的情况下，指定了模型自动维护时间戳的格式化方法，模型使用该方法对从数据表中获取的值进行格式化。
    //如果不指定，则默认把取出的值当作unix时间戳进行格式化为年月日时分秒的字符串形式。
    //本例中直接返回unix时间戳，由后续的程序可以进行自定义的格式化输出
    protected function asDateTime($val) {
        return $val;
    }

    //定义该模型中允许批量赋值的属性列表，本例中表示 name 和 age 属性允许批量赋值。
    //protected $fillable = ['name', 'age'];

    //定义该模型中不允许批量赋值的属性列表。
    protected $guarded = [];



}