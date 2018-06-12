<?php

namespace app\admin\controller;
use app\common\model\Admin;
use think\Session;


class Index extends Common
{
    //登录
    public function index(){
        return $this->fetch();
    }

    /**
     * 修改密码
     */
    public function pass(){
        if(request()->isPost()){
            $result = (new Admin())->pass(input('post.'));
            if($result['valid']){
                //清除session中的登录信息
                session(null);
                //执行验证成功
                $this->success($result['msg'], 'admin/index/index');exit;

            }else{
                //执行失败
                $this->error($result['msg']);
            }
        }

        return $this->fetch();
    }

    //退出登录
    public function logout(){
        session(null);
        $this->success('退出成功', 'admin/index/login');
        // return $this->fetch();
    }
}