<?php

namespace app\admin\controller;

use think\Controller;

class Category extends Controller
{
    //栏目列表控制器
    public function index(){

        return $this->fetch();
    }
}
