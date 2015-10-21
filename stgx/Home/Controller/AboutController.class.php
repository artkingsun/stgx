<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/28 0028
 * Time: 15:49
 */

namespace Home\Controller;
use Think\Controller;

class AboutController extends Controller{
    //获得Session UID
    function getSessionUID(){
        $User = D('User');
        $data = $User->getSession();
        if($data) {
            return $data;
        }
        else {
            return false;
        }
    }
    //添加关于
    function addAbout($title,$content,$type){
        if(strlen($title) > 0 && strlen($content) > 0){
            $UID = $this->getSessionUID();
            $About = D('About');
            $data = $About->addAbout($title,$content,$type,$UID);
            if($data){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->ajaxReturn(false);
        }
    }
    //删除关于
    function delAbout($aboutid){
        $UID = $this->getSessionUID();
        $About = D('About');
        $data = $About->delAbout($aboutid,$UID);
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //根据类型读取关于信息
    function readAboutListByType($type){
        $About = D('About');
        $data = $About->readAboutListByType($type);
        if($data){
            $this->ajaxReturn($data);
        }else{
            $this->ajaxReturn(false);
        }
    }

}