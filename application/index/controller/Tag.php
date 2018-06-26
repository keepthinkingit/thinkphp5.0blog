<?php

namespace app\index\controller;



class Tag extends Common
{
    public function index()
    {
        $tag_id = input('param.tag_id');
        $tagData = db('arc_tag')->where('tag_id',$tag_id)->column('arc_id');
        // dump($tagData);exit;
        $artData = db('article')->alias('a')
            ->join('__CATE__ c','a.cate_id=c.cate_id')
            ->field('a.arc_title,a.arc_id,a.arc_author,a.createtime,a.arc_thumb,a.arc_digest,c.cate_name,c.cate_id')
            ->where('a.arc_id', 'in', $tagData)
            ->where('is_recycle',2)->select();
        foreach($artData as $k=>$v){
            $artData[$k]['tags'] = db('arc_tag')->alias('z')
                ->join('__TAG__ t','z.tag_id=t.tag_id')
                ->where('z.arc_id',$v['arc_id'])
                ->field('t.tag_id,t.tag_name')
                ->select();
        }
        $this->assign('data',$artData);
        //获取标签名称
        $tag_name = db('tag')->where('tag_id',$tag_id)->field('tag_name')->find();
        $this->assign('name',$tag_name);
        //获取该标签下所有文章统计
        $all = count($artData);
        $this->assign('all',$all);
        return $this->fetch();
    }
}
