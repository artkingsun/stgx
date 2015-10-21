<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/29 0029
 * Time: 15:57
 */

namespace Home\Controller;
use Think\Controller;

class FileController extends Controller{
    function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts       =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath  =      'upic/'; // 设置附件上传目录    // 上传文件
        $info   =   $upload->upload();
        if(!$info) { // 上传错误提示错误信息
            $this->error($upload->getError());
        } else {// 上传成功
            foreach($info as $file) {
                $data =  $file['savepath'].$file['savename'];
                $this->ajaxReturn($data);
            }
        }
    }

}