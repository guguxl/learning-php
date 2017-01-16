<?php
/**
 * Created by PhpStorm.
 * User: guxl
 * Date: 2017/1/13
 * Time: 22:19
 */

namespace App\Http\Controllers;


use App\Model\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    //使用facade方式进行增删改查
    public function facadeCurd(){
        //插入
//        $bool = DB::insert('insert into student(name, age) values(?,?)',['liulp', 37]);
//        var_dump($bool);

        //修改
//        $count = DB::update('update student set age=? where name=?', [38,'liulp']);
//        var_dump($count);

        //查询
//        $students = DB::select('select name, age from student where id>=?', [1]);
//        var_dump($students);

        //删除
        $count = DB::delete('delete from student where name=?', ['liulp']);
        var_dump($count);

    }


    //使用查询构造器方式进行增删改查
    public function queryBuilderCurd () {
        //插入单条记录
//        $bool = DB::table('student')->insert(
//            ['name'=>'guguguxl', 'age'=>35]
//        );
//        var_dump($bool);


        //插入多条记录
//        $bool = DB::table('student')->insert([
//            ['name'=>'name1', 'age'=>15],
//            ['name'=>'name2', 'age'=>16],
//            ['name'=>'name3', 'age'=>17],
//            ['name'=>'name4', 'age'=>18],
//            ['name'=>'name5', 'age'=>19],
//            ['name'=>'name6', 'age'=>20],
//            ['name'=>'name7', 'age'=>21],
//            ['name'=>'name8', 'age'=>22],
//        ]);
//        var_dump($bool);


        //插入记录并获取插入记录的id
//        $lastInsertId = DB::table('student')->insertGetId(
//            ['name'=>'whoami', 'age'=>100, 'sex'=>'female']
//        );
//        var_dump($lastInsertId);


        //修改一条记录，千万记住where方法一定要放在update方法之前
//        $count = DB::table('student')
//            ->where('id', 3)
//            ->update(['name'=>'dashabi']);
//        var_dump($count);


        //修改一条记录，自增或自减某个字段值，可以使用increment, decrement方法。
        //这两个方法不给第二个参数，默认增减幅度为1，如果给第二个参数，则第二个参数表示增减的幅度。
        //如果有三个参数，则第三个参数表示在自增或自减的同时需要修改的其他字段信息。
//        $count = DB::table('student')->where('id', 5)->decrement('age');
//        $count = DB::table('student')->where('id', 6)->increment('age',5);
//        $count = DB::table('student')->where('id', 8)->increment('age',5, ['name'=>'guguxl']);
//        var_dump($count);


        //删除表记录或 清空表
        //$count = DB::table('student')->where('id', 6)->delete();
        //$count = DB::table('student')->where('id', '>=', 10)->delete();
//        $count = DB::table('student')->truncate();
//        var_dump($count);


        //查询相关方法
        //1、get方法
//        $students = DB::table('student')->where('id', '>=', 5)->get();

        //2、first方法
//        $students = DB::table('student')->orderBy('id','desc')->first();

        //3、多条件的whereRaw方法
//        $students = DB::table('student')->whereRaw('id>=? and age>=?', [4, 20])->get();

        //4、pluck方法：指定返回表中的某个字段，本例中为name字段
//        $students = DB::table('student')->whereRaw('id>=? and age>=?', [4, 20])->pluck('name');

        //5、lists方法：指定返回表中的某个字段，同时可以指定另外一个字段作为数组的索引。本例中返回name字段，用age字段作为数组索引
//        $students = DB::table('student')->whereRaw('id>=? and age>=?', [4, 20])->lists('name','age');

        //6、select方法：在get或first方法前使用，用于限定返回哪些字段
//        $students = DB::table('student')
//            ->whereRaw('id>=? and age>=?', [4, 20])
//            ->select('id', 'name','age')
//            ->get();

        //7、chunk方法：当要查询的记录数很多时，需要使用该方法分批返回
        //   该方法第一个参数为每次分批返回的记录数，第二个参数为一个函数，函数参数为该批次返回的记录数据，可以在函数中处理记录。
        //   在第二个参数的函数体中，可以设置某些情况下返回false，则后续批次不会被自动返回。
//        echo '<pre>';
//        DB::table('student')->chunk(2, function ($student) {
//            var_dump($student);
//
//            return false;
//        });


        //聚合函数相关方法：count, max, min, avg, sum等
        $count = DB::table('student')->count();
        var_dump($count);
        $max = DB::table('student')->max('age');
        var_dump($max);
        $min = DB::table('student')->min('age');
        var_dump($min);
        $avg = DB::table('student')->avg('age');
        var_dump($avg);
        $sum = DB::table('student')->sum('age');
        var_dump($sum);
    }


    //使用 Eloquent Orm方法进行增删改查
    public function eloquentModelCurd() {

        /******************************** 查询相关的方法 **********************************/
        //类的all方法：查询所有记录
//        $students = Student::all();
//        var_dump($students);

        //类的find方法：根据主键id查询单条记录
//        $student = Student::find(3);
//        var_dump($student);

        //类的findOrFail方法：根据主键id查询单条记录，如果找不到则抛出异常终止程序
        //与类的find方法不同之处：find方法如果根据主键id找不到记录，则返回null，不会抛出异常
//        $student = Student::findOrFail(200);
//        var_dump($student);

        //查询构造器的get方法，同上面的all方法
//        $students = Student::get();
//        var_dump($students);

        //组合使用查询构造器的where, orderBy, first, count等等方法
//        $student = Student::where('id','>=', 3)
//            ->orderBy('age', 'desc')
//            ->first();
//        var_dump($student);

        //查询构造器的chunk方法
//        echo '<pre>';
//        Student::chunk(2, function ($students) {
//            var_dump($students);
//            //同样的，必要情况下，该匿名函数返回false，表示不再继续提取后续数据
//        });

        //查询构造器的聚合函数
//        $count = Student::count();
//        $maxAge = Student::where('id', '>=', 3)->max('age');
//        $minAge = Student::where('id', '>=', 3)->min('age');
//        $avgAge = Student::where('id', '>=', 3)->avg('age');
//        var_dump($count . ', '. $maxAge . ', '. $minAge . ', ' . $avgAge);


        /******************************** 新增相关的方法 **********************************/
        //使用模型新增数据
//        $student = new Student();
//        $student->name = 'guguxl';
//        $student->age = 36;
//        $bool = $student->save();
//        var_dump($bool);

//        $student = Student::find(11);
//        date_default_timezone_set('prc');
//        echo $student->created_at;

        //直接使用模型类的create()方法新增数据，传入参数为数组。
        //如果要使用该方法，则需要在模型类的定义中设置 $fillable 属性，该属性指定了该模型允许批量赋值的属性列表。
//        $student = Student::create(
//            ['name'=>'guguguguxl', 'age'=> 39]
//        );
//        var_dump($student);

        //使用模型类的firstOrCreate() 或 firstOrNew() 方法查找数据，如果查找不到则添加或新建一个对象。
        //两者的区别：
        //firstOrCreate()方法直接插入数据到后台表中。
        //firstOrNew()方法则是新建一个对象，但不写入数据表，如果需要写入数据表，需要显式地调用save()方法。
//        $student = Student::firstOrCreate(
//            ['name'=>'asdjfaosdfja']
//        );
//        $student = Student::firstOrNew(
//            ['name'=>'hdaodfaso']
//        );
//        $student->age = 45;
//        $student->sex = 'female';
//        $student->save();
//        var_dump($student);


        /******************************** 修改相关的方法 **********************************/
        //方法1：查出，设值，再保存
//        $student = Student::find(13);
//        $student->name='whoami';
//        $student->age=55;
//        $bool = $student->save();
//        var_dump($bool);

        //方法2：通过where条件查询出，再批量更新
//        $count = Student::where('id','>=', 13)->update(['name'=>'wwwwhoami', 'age'=>24]);
//        var_dump($count);


        /******************************** 删除相关的方法 **********************************/
        //方法1
//        $bool = Student::find(14)->delete();
//        var_dump($bool);

        //方法2
//        $count = Student::where('id', '>=', 10)->delete();
//        var_dump($count);

        //方法3
//        $count1 = Student::destroy(1);            //删除一个ID的记录
//        $count2 = Student::destroy(2,3);          //删除多个id的记录
//        $count3 = Student::destroy([3,4,5]);      //删除多个id的记录
//        var_dump($count1 . '<br> ' . $count2 . '<br> ' . $count3);

    }



}