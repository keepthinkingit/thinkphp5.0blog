<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/6/15
 * Time: 11:32
 */

namespace app\admin\validate;
use think\Validate;

class Link extends Validate{

    protected $rule = [
        'link_name' => 'require|chsDash|length:1,21|unique:link',
        'link_url' => 'require|url',
        'link_sort' => 'require|number|between:1,999',
    ];

    protected $message = [
        'link_name.require'=>'请填写友链名称',
        'link_name.chsDash'=>'请填写正确的友链名称.支持汉字,字母,数字和下划线及破折号',
        'link_name.length'=>'友链名称最长21位哦~',
        'link_name.unique'=>'友链名称重复了哦~',
        'link_url.require'=>'请填写友链地址',
        'link_url.url'=>'请填写正确的url地址',
        'link_sort.number'=>'排序必须为数字',
        'link_sort.require'=>'请输入友链排序',
        'link_sort.between'=>'友链排序需要在1-999之间',
    ];



}