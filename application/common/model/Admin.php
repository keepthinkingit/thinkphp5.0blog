<?php

namespace app\common\model;

use houdunwang\crypt\Crypt;
use think\Loader;
use think\Model;
use think\Validate;


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

    /**
     * 修改密码
     * @param  array/bool $data  post传过来的数据
     * @return  mixed  bool/array 返回成功数据
     */
    public function pass($data){
        //1.执行验证
        $validate = Loader::validate('Changepw');
        // 验证失败
        if (!$validate->check($data)) {
             // dump($validate->getError());
            return ['valid'=>0,'msg'=>$validate->getError()];
        }
        //2.原始密码判断
        $user_info = $this->where('admin_id', session('admin.admin_id'))->where('admin_password',Crypt::encrypt($data['admin_password']))->find();
        // dump($user_info);
        if(!$user_info){
            return ['valid'=>0, 'msg'=>'原密码不正确'];
        }
        //3.正确则执行密码修改

        //save 方法第二个参数 更新数据
        $res = $this->save([
            'admin_password'=> Crypt::encrypt($data['admin_new_password']),
        ], [$this->pk => session('admin.admin_id')]);
        if($res){
            return ['valid'=>1, 'msg'=>'密码修改成功'];
        }else{
            return ['valid'=>0, 'msg' => '密码修改失败'];
        }

    }
}
