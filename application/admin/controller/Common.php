<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{
    //登录验证
    public function __construct(Request $request = null){
        parent::__construct($request);
        if(!session('admin.admin_id')){
            $this->redirect('admin/login/login');
        }

    }
}
