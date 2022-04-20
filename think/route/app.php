<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');

//store_comment
Route::get('StoreComment/<id>', 'index/getStoreComment');
Route::post('StoreComment', 'index/addStoreComment');
//userinfo
Route::get('UserInfo', 'index/getUserInfo');
Route::post('UserInfo', 'index/addUserInfo');
//
Route::get('StoreInfo', 'index/getStoreInfo');
Route::post('StoreInfo', 'index/addStoreInfo');
//Category
Route::get('Category', 'index/getCategory');
Route::post('Category', 'index/addCategory');

//likes
Route::get('Likes', 'index/getLikes');
Route::post('Likes', 'index/addLikes');