<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/6/8
 * Time: 19:10
 */

namespace app\admin\validate;
use think\Validate;

class Changepw extends Validate{

    protected $rule = [
        'admin_password' => 'require',
        'admin_new_password' => 'require',
        'admin_confirm_password' => 'require|confirm:admin_new_password'
    ];

    protected $message = [
        'admin_password.require'=>'请输入原始的密码',
        'admin_new_password.require'=>'请输入新密码',
        'admin_confirm_password.require'=>'请再次输入新密码',
        'admin_confirm_password.confirm'=>'两次新密码不一致'
    ];



}