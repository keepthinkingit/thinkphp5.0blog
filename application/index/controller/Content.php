<?php

namespace app\index\controller;


use think\Request;

class Content extends Common
{

    public function index()
    {
        $arc_id = input('param.arc_id');
        //自动点击数+1
        db('article')->where('arc_id',$arc_id)->setInc('arc_click',1);
        $artData = db('article')->alias('a')
            ->join('__CATE__ c','a.cate_id=c.cate_id')
            ->field('a.arc_title,a.arc_id,a.arc_author,a.arc_content,a.createtime,a.arc_thumb,c.cate_name,c.cate_id')
            ->where('a.arc_id',$arc_id)
            // ->where('is_recycle',2)
            ->find();
        foreach($artData as $k=>$v){
            $artData['tags'] = db('arc_tag')->alias('z')
                ->join('__TAG__ t','z.tag_id=t.tag_id')
                ->where('z.arc_id',$artData['arc_id'])
                ->field('t.tag_id,t.tag_name')
                ->select();
        }
        //填充head title
        $headName = $this->loadWebSet()['title'] . '--' . $artData['arc_title'];
        $this->assign('headName',$headName);
        $this->assign('artData',$artData);
        return $this->fetch();
    }

}
