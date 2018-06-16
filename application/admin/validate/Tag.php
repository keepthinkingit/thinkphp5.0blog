<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/6/15
 * Time: 11:32
 */

namespace app\admin\validate;
use think\Validate;

class Tag extends Validate{

    protected $rule = [
        'tag_name' => 'require|chsDash|length:1,21|unique:tag',
    ];

    protected $message = [
        'tag_name.require'=>'请填写标签名称',
        'tag_name.chsDash'=>'请填写正确的标签名称.支持汉字,字母,数字和下划线及破折号',
        'tag_name.length'=>'标签名称最长21位哦~',
        'tag_name.unique'=>'标签名称重复了哦~',
    ];



}