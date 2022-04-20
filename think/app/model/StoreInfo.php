<?php
namespace app\model;
use think\facade\Db;
use think\Model;
use app\lib\exception\BaseException;

class StoreInfo extends Model{
    public function add(){
        $data = request()->post();
        Db::name("store_info")->insert($data);
        return true;
    }

    public function get(){
        $res = Db::name('store_info')->select();
        return $res;
    }
}