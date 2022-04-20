<?php
namespace app\controller;

use app\BaseController;

use app\model\StoreComment as CommentModel;
use app\model\UserInfo as UserInfoModel;
use app\model\StoreInfo as StoreInfoModel;
use app\model\Category as CategoryModel;
use app\model\Likes as LikesModel;

class Index extends BaseController
{
    public function index()
    {
        return '<h1>welcome</h1>';
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }

    // get all comments
    public function getStoreComment($id){
        $Info = (new CommentModel())->where('store_id', $id)->select();
        return json($Info);
    }

    // add new comments
    public function addStoreComment(){
        $Info = (new CommentModel())->add();
        return json($Info);
    }

    public function getUserInfo(){
        $Info = (new UserInfoModel())->get();
        return json($Info);
    }

    public function addUserInfo(){
        $Info = (new UserInfoModel())->add();
        return json($Info);
    }

    public function getStoreInfo(){
        $Info = (new StoreInfoModel())->get();
        return json($Info);
    }

    public function addStoreInfo(){
        $Info = (new StoreInfoModel())->add();
        return json($Info);
    }

    public function getCategory(){
        $Info = (new CategoryModel())->get();
        return json($Info);
    }

    public function addCategory(){
        $Info = (new CategoryModel())->add();
        return json($Info);
    }

    public function login(){
        $Info = (new UserInfoModel())->get();
        return json($Info);
    }

    public function getLikes(){
        $Info = (new LikesModel())->get();
        return json($Info);
    }

    public function addLikes(){
        $Info = (new LikesModel())->add();
        return json($Info);
    }
}
