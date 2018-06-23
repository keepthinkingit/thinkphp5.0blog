<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/6/15
 * Time: 11:32
 */

namespace app\admin\validate;
use think\Validate;

class Webset extends Validate{

    protected $rule = [
        'webset_name' => 'require',
        'webset_value' => 'require',
    ];

    protected $message = [
        'webset_name.require'=>'请填写配置名称',
        'webset_value.require'=>'请填写配置值',
    ];



}