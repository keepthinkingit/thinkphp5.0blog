<?php

namespace app\common\model;

use think\Model;

class Article extends Model
{
    protected $pk = 'tag_id'; //主键
    protected $table = 'blog_tag';  //完整的表名称
    //
    public function getAll(){
        //查询blog_tag(数据库前缀设置在database.php)表中,每页显示10条数据
        $tagList = db('article')->paginate(10);

        return $tagList;
    }
    public function getCateNameList(){
        $catNameList = db('cate')->order('cate_id','asc')->select();
        return $catNameList;
    }

    public function getTagNameList(){
        $tagNameList = db('tag')->order('tag_id','asc')->select();
        return $tagNameList;
    }
}
