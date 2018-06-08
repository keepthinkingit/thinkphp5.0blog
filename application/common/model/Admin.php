<?php

namespace app\common\model;

use houdunwang\crypt\Crypt;
use think\Loader;
use think\Model;


class Admin extends Model
{
    protected $pk = 'admin_id'; //主键
    protected $table = 'blog_admin';  //完整的表名称

    /**
     * 登录
     */
    public function login($data){
        // dump($this->where('admin_username'), $data['admin_username']);exit();

        //1.执行验证
        $validate = Loader::validate('Admin');
        //验证不通过
        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
            // dump($validate->getError());
        }

        //2.比对用户名和密码
        $userVali = $this->where('admin_username', $data['admin_username'])->where('admin_password', Crypt::encrypt($data['admin_password']))->find();
        // halt($userVali);
        if(!$userVali){
            return ['valid'=>0,'msg'=>'用户名或密码不正确!'];
        }

        //3.将用户信息存入session中
        session('admin.admin_id',$userVali['admin_id']);
        session('admin.admin_username', $userVali['admin_username']);
        return ['valid'=>1, 'msg'=> '登录成功!'];
    }

}
