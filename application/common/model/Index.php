<?php

namespace app\common\model;

use think\Model;

class Index extends Model
{
    protected $pk = 'arc_id'; //主键
    protected $table = 'blog_article';  //完整的表名称
    //首页数据获取
    public function getArt($is_recycle,$num){
        $data = db('article')->alias('a')
            ->join('__CATE__ c', 'a.cate_id=c.cate_id')
            ->where('is_recycle',$is_recycle)->order('createtime desc')->select();
        // 把每篇文章中的标签获取出来
        foreach($data as $k=>$v){
            $data[$k]['tags'] = db('arc_tag')->alias('z')
                ->join('__TAG__ t','z.tag_id=t.tag_id')
                ->where('z.arc_id',$v['arc_id'])
                ->field('t.tag_id,t.tag_name')
                ->select();
        }
        // $this->paginate($num);
        // halt($data);exit;

        return $data;
    }
}
