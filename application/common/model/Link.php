<?php

namespace app\common\model;

use think\Db;
use think\Model;

class Link extends Model
{
    protected $pk = 'link_id'; //主键
    protected $table = 'blog_link';  //完整的表名称

    public function getAll($num=15){
        if($num==0){
            $linkList = Db::paginate($num);
        }else{
            $linkList = db('link')->paginate($num);
        }
        return $linkList;
    }

    public function linkEdit($data){
        //执行验证
        $result = $this->validate(true)->save($data,[$this->pk=>$data['link_id']]);
        if(false === $result){
            //验证失败
            return ['valid'=>0,'msg'=>$this->getError()];
        }else{
            //验证成功后执行添加
            return ['valid'=>1, 'msg'=> '编辑成功!'];
        }
    }

    public function addLink($data){
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

    public function del($link_id){
        //删除当前分类
        if(!$this->db('link')->delete($link_id)){
            //删除失败
            return ['valid'=>0,'msg'=>'删除失败,请重试!'];
        }else{
            //删除成功后执行添加
            return ['valid'=>1, 'msg'=> '删除成功!'];
        }
    }
}
