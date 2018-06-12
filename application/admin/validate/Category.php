<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/6/12
 * Time: 15:06
 */
namespace app\admin\validate;
use think\Validate;

class Category extends Validate{

    protected $rule = [
        'cate_name' => 'require|chsDash',
        'cate_sort' => 'require|number|between:1,999',
    ];

    protected $message = [
        'cate_name.require'=>'请填写分类名称',
        'cate_name.chsDash'=>'请填写正确的分类名称.支持汉字,字母,数字和下划线及破折号',
        'cate_sort.number'=>'排序必须为数字',
        'cate_sort.require'=>'请输入排序',
        'cate_sort.between'=>'排序需要在1-999之间'
    ];



}