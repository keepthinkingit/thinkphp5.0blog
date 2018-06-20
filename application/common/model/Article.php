<?php

namespace app\common\model;

use think\Model;

class Article extends Model
{
    protected $pk = 'arc_id'; //主键
    protected $table = 'blog_article';  //完整的表名称
    protected $auto = ['admin_id'];  //数据完成功能,无需手动复制,自动写入数据库,  此处为
    protected $insert = ['createtime'];
    protected $update = ['updatetime'];
    //
    protected function setAdminIdAttr($value){
        return session('admin.admin_id');
    }

    protected function setCreateTimeAttr($value){
        return time();
    }

    protected function setUpdateTimeAttr($value){
        return time();
    }

    public function getAll(){
        //查询blog_tag(数据库前缀设置在database.php)表中,每页显示10条数据
        // $tagList = db('article')->paginate(10);
        $data = db('article')->alias('a')->join('__CATE__ c', 'a.cate_id=c.cate_id')
            ->field('a.arc_id,a.arc_title,a.createtime,a.arc_author,c.cate_name,a.arc_sort')
            ->order('a.arc_sort desc,a.createtime,a.arc_id desc')
            ->where('a.is_recycle',2)->paginate(3);
        // halt($data);

        return $data;
    }
    public function getCateNameList(){
        $catNameList = db('cate')->order('cate_id','asc')->select();
        return $catNameList;
    }

    public function getTagNameList(){
        $tagNameList = db('tag')->order('tag_id','asc')->select();
        return $tagNameList;
    }

    public function addArt($post){
        //必须选择标签才能通过
        // halt($post);
        if(!isset($post['tag'])){
            return ['valid' => 0, 'msg' => '请选择标签'];
        }
        $result = $this->validate(true)->allowField(true)->save($post);
        if($result){
            foreach($post['tag'] as $v){
                $arcTagData = [
                    'arc_id' => $this->arc_id,
                    'tag_id' => $v,
                ];
                (new ArcTag() )->save( $arcTagData );
            }
            return ['valid'=>1, 'msg'=> '添加成功!'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }
}
