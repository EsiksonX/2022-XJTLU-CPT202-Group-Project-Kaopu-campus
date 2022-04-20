<?php
namespace app\model;
use think\facade\Db;
use think\Model;
use app\lib\exception\BaseException;

class Likes extends Model{
    public function add(){
        $data = request()->post();
        Db::name("likes")->insert($data);
        return true;
    }

    public function get(){
        $res = Db::name('likes')->select();
        return $res;
    }
}