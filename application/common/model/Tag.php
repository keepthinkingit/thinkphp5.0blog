<?php

namespace app\common\model;

use think\Model;

class Tag extends Model
{
    protected $pk = 'tag_id'; //主键
    protected $table = 'blog_tag';  //完整的表名称
    //
    public function getAll(){
        //查询blog_tag(数据库前缀设置在database.php)表中,每页显示10条数据
        $tagList = db('tag')->paginate(10);

        return $tagList;
    }

    public function tagEdit($data){
        //执行验证
        $result = $this->validate(true)->save($data,[$this->pk=>$data['tag_id']]);
        if(false === $result){
            //验证失败
            return ['valid'=>0,'msg'=>$this->getError()];
        }else{
            //验证成功后执行添加
            return ['valid'=>1, 'msg'=> '编辑成功!'];
        }
    }

    public function addTag($data){
        //执行验证
        $result = $this->validate(true)->save($data);
        if(false === $result){
            //验证失败
            return ['valid'=>0,'msg'=>$this->getError()];
        }else{
            //验证成功后执行添加
            return ['valid'=>1, 'msg'=> '添加成功!'];
        }
    }

    public function del($tag_id){
        //删除当前分类
        if(!$this->db('tag')->delete($tag_id)){
            //删除失败
            return ['valid'=>0,'msg'=>'删除失败,请重试!'];
        }else{
            //删除成功后执行添加
            return ['valid'=>1, 'msg'=> '删除成功!'];
        }
    }
}
