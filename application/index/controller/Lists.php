<?php

namespace app\index\controller;


use think\Request;

class Lists extends Common
{

    public function index()
    {
        $cate_id = input('param.cate_id');
        $artData = db('article')->alias('a')
            ->join('__CATE__ c','a.cate_id=c.cate_id')
            ->field('a.arc_title,a.arc_id,a.arc_author,a.createtime,a.arc_thumb,a.arc_digest,c.cate_name,c.cate_id')
            ->where('a.cate_id', $cate_id)
            ->where('is_recycle',2)->select();
        foreach($artData as $k=>$v){
            $artData[$k]['tags'] = db('arc_tag')->alias('z')
                ->join('__TAG__ t','z.tag_id=t.tag_id')
                ->where('z.arc_id',$v['arc_id'])
                ->field('t.tag_id,t.tag_name')
                ->select();
        }
        // halt($artData);exit;
        $this->assign('data',$artData);
        //获取分类名称
        $cate_name = db('cate')->where('cate_id',$cate_id)->field('cate_name')->find();
        $this->assign('name',$cate_name);
        //获取该分类下所有文章统计
        $all = count(db('article')->where('cate_id',$cate_id)->where('is_recycle',2)->field('arc_id')->select());
        // halt($all);exit;
        $this->assign('all',$all);
        return $this->fetch();
    }

    /**
     *     //递归收集子集
     * @param $data
     * @param $cate_id
     * @return array
     */
    // public function getSon($data, $cate_id){
    //     static $result = [];
    //     foreach($data as $k=>$v){
    //         if($cate_id==$v['cate_pid']){
    //             $result[] = $v['cate_id'];
    //             $this->getSon($data, $v['cate_id']);
    //         }
    //     }
    //     return $result;
    // }
}
