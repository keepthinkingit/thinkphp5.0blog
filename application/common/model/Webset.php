<?php

namespace app\common\model;

use think\Model;

class Webset extends Model
{
    protected $pk = 'webset_id'; //主键
    protected $table = 'blog_webset';  //完整的表名称
    //
    public function getAll($num=10){
        //查询blog_webset(数据库前缀设置在database.php)表中,每页显示10条数据
        if($num==0){
            $websetList = db('webset')->select();
        }else{
            $websetList = db('webset')->paginate($num);
        }
        return $websetList;
    }

    public function edit($data){
        //执行验证
        $result = $this->validate(true)->save($data,[$this->pk=>$data['webset_id']]);
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

    public function del($webset_id){
        //删除当前分类
        if(!$this->db('webset')->delete($webset_id)){
            //删除失败
            return ['valid'=>0,'msg'=>'删除失败,请重试!'];
        }else{
            //删除成功后执行添加
            return ['valid'=>1, 'msg'=> '删除成功!'];
        }
    }
}
