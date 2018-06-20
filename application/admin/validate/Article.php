<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/6/20
 * Time: 11:17
 */

namespace app\admin\validate;
use think\Validate;

class Article extends Validate{

    protected $rule = [
        'arc_title' => 'require',
        'arc_author' => 'require',
        'arc_sort' => 'require|number|between:1,999',
        'cate_id' => 'notIn:0',
        // 'arc_thumb' => 'require',
        'arc_digest' => 'require',
        'arc_content' => 'require',
    ];

    protected $message = [
        'arc_title.require'=>'请填写文章标题名称',
        'arc_author.require'=>'请填写文章作者名称',
        'arc_sort.number'=>'排序必须为数字',
        'arc_sort.require'=>'请输入文章排序',
        'arc_sort.between'=>'文章排序需要在1-999之间',
        'cate_id.notIn'=>'请选择文章分类',
        // 'arc_thumb.require'=>'请上传文章图片',
        'arc_digest.require'=>'请填写文章摘要',
        'arc_content.require'=>'请填写文章内容',
    ];



}