<?php
namespace app\model;
use think\facade\Db;
use think\Model;
use app\lib\exception\BaseException;

class Category extends Model{
    public function add(){
        $data = request()->post();
        Db::name("category")->insert($data);
        return true;
    }

    public function get(){
        $res = Db::name('category')->select();
        return $res;
    }
}