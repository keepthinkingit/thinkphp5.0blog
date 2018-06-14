<?php

namespace app\common\model;



use houdunwang\arr\Arr;
use think\Model;

class Category extends Model
{
    //列表数据获取
    protected $pk = 'cate_id'; //主键
    protected $table = 'blog_cate';  //完整的表名称

    /**
     * 获取分类数据[树状结构使用]
     */
    public function getAll(){
        //hdphp.com->数组增强功能:https://www.kancloud.cn/houdunwang/hdphp3/215245  ++>>此库要求根目录为非数组内任一分类才能完成
        // $arrs = array(
        //     0=>['cate_id'=>2,'cate_name'=>'test2','cate_pid'=>1],
        //     1=>['cate_id'=>1,'cate_name'=>'root','cate_pid'=>0],
        //     2=>['cate_id'=>5,'cate_name'=>'test332','cate_pid'=>0],
        //     3=>['cate_id'=>4,'cate_name'=>'test22','cate_pid'=>0],
        //     4=>['cate_id'=>3,'cate_name'=>'test202','cate_pid'=>4]);
        // dump($arrs);
        // halt(Arr::tree($arrs,'cate_name',$fieldPri = 'cate_id', $fieldPid = 'cate_pid'));
        // halt(db('cate')->order('cate_sort desc,cate_id')->select());
        return Arr::tree(db('cate')->order('cate_sort desc,cate_id')->select(), 'cate_name', $fieldPri = 'cate_id', $fieldPid = 'cate_pid');

        // $cat_list = $this->select();
        // // halt($cat_list);exit;
        // return $cat_list;
    }

    public function catAdd($data){
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

    /**
     * @param $cate_id
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @return array array 包含子分类和自己 之外的数组
     */
    //处理所属分类,变换分类的父亲
    // 数据库手动创建顶级分类为1(PID=0)且新建分类PID默认为1
    public function getPid($cate_id){
        //1.找到所有子集
        // halt(db('cate')->select());
        $all = db('cate')->select();
        $cateList = $this->getSon($all, $cate_id);
        //2.将自己追加进去
        $cateList[] = (int)$cate_id;   //为什么传参过来判断数字和字符串都是true?
        // halt($cateList);exit;
        //3.找到除了自己之外的数据,变成树状结构
        $result = db('cate')->whereNotIn('cate_id',$cateList)->select();
        return Arr::tree($result, 'cate_name', $fieldPri = 'cate_id', $fieldPid = 'cate_pid');
    }

    /**
     *     //递归收集子集
     * @param $data
     * @param $cate_id
     * @return array
     */
    public function getSon($data, $cate_id){
        static $result = [];
        foreach($data as $k=>$v){
            if($cate_id==$v['cate_pid']){
                $result[] = $v['cate_id'];
                $this->getSon($data, $v['cate_id']);
            }
        }
        return $result;
    }

    /**
     * @param array $data post提交过来的数据
     * @return array
     */
    public function catEdit($data){
        //执行验证
        $result = $this->validate(true)->save($data,[$this->pk=>$data['cate_id']]);
        if(false === $result){
            //验证失败
            return ['valid'=>0,'msg'=>$this->getError()];
        }else{
            //验证成功后执行添加
            return ['valid'=>1, 'msg'=> '编辑成功!'];
        }
    }

}
