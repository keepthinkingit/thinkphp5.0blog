<?php

namespace app\system\controller;

use think\Controller;

class Component extends Controller
{
    //上传图片 此功能有问题,暂时不知道原因,待后期排查.==>>>原因可能是使用了两个版本的hdjs库,导致冲突
    public function uploader(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');  //request()->file()获取_FILES 变量获得的文件信息
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public/'  . 'uploads');
        if($info){
            $data = [
                'name' => input('post.name'),
                'filename' => $info->getFilename(),
                'path' =>  'uploads/'  . $info->getSaveName(),
                'extension' => $info->getExtension(),
                'createtime' => time(),
                'size' => $info->getSize(),
            ];
            db('attachment')->insert($data);
            // halt(HD_ROOT . $data['path']);exit;
            echo json_encode(['valid' => 1, 'message' => HD_ROOT . $data['path']]);
        }else {
            //失败时返回数据 message 为失败原因
            echo  json_encode(['valid' => 0, 'message' => $file->getError()]);
        }
    }

    public function fileLists(){
        $db= db('attachment')->whereIn('extension', explode(',', strtolower(input("post.extensions"))))->order('id desc');
        $result = $db->paginate(2);
        $data = [];
        if($result->toArray()){
            // dump($result->toArray());die;
            foreach($result as $k=>$v){
                $data[$k]['createtime'] = date('Y/m/d', $v['createtime']);
                $data[$k]['size'] = $v['size'];
                $data[$k]['url'] =  HD_ROOT . $v['path'];
                $data[$k]['path'] = HD_ROOT . $v['path'];
                $data[$k]['name'] = $v['name'];
            }
        }
        echo  json_encode(['data' => $data, 'page' => $result->render() ?  :'']);

    }

}
