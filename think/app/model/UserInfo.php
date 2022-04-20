<?php
namespace app\model;
use think\facade\Db;
use think\Model;
use app\lib\exception\BaseException;

class UserInfo extends Model{
    public function add(){
        $data = request()->post();
        Db::name("user_info")->insert($data);
        return true;
    }

    public function get(){
        $res = Db::name('user_info')->select();
        return $res;
    }
}