<?php

namespace app\common\model;



use think\Model;

class Category extends Model
{
    //列表数据获取
    protected $pk = 'admin_id'; //主键
    protected $table = 'blog_cate';  //完整的表名称

    public function catList(){
        $cat_list = $this->where('cate_id', '*')->select();
        // dump($cat_list);exit;
        return $cat_list;
    }

    public function catadd($data){
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

}
