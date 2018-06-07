<?php

namespace app\common\model;

use think\Model;

class Admin extends Model
{
    protected $pk = 'admin_id'; //主键
    protected $table = 'blog_admin';  //完整的表名称

    /**
     * 登录
     */
    public function login($data){
        //1.执行验证
        //2.比对用户名和密码
        //3.
    }
}
