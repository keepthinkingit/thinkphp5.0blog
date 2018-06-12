<?php

namespace app\admin\controller;

use think\Controller;
use app\common\model\Admin;
// use houdunwang\crypt\Crypt;

class Login extends Controller
{
    //登录页面控制器
    public function login(){
        //测试数据库连接
        // $data = db('blog_admin')->find();
        // var_dump($data);exit();

        // dump(Crypt::encrypt('admin'));  //加密结果为:  gKjd5W7T3zzGPZJBiKMv5Q==
        // dump(Crypt::decrypt('gKjd5W7T3zzGPZJBiKMv5Q==')) ;
        if(request()->isPost()){
            $res = (new Admin())->login(input('post.'));
            if($res['valid']){
                //登录成功
                $this->success($res['msg'], 'admin/index/index');exit;
            }else{
                //登录失败
                $this->error($res['msg']);
            }
        }
        return $this->fetch();
    }
}
