<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/4 0004
 * Time: 16:07
 */

namespace Home\Controller;
use Think\Controller;

class FeedController extends Controller{
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
    //添加反馈
    function addFeed($content,$contact){
        $UID = $this->getSessionUID();
        if($UID){
            $Feed = D('Feed');
            $data = $Feed->addFeed($content,$contact,$UID);
            if($data){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->ajaxReturn(false);
        }
    }
    //删除反馈
    function delFeed($feedid){
        $UID = $this->getSessionUID();
        if($UID){
            $Feed = D('Feed');
            $data = $Feed->delFeed($feedid,$UID);
            if($data){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->ajaxReturn(false);
        }
    }
    //读取我的反馈
    function readFeedList(){
        $UID = $this->getSessionUID();
        if($UID){
            $Feed = D('Feed');
            $data = $Feed->readFeedList($UID);
            if($data){
                foreach ($data as $k=>$v) {
                    $data[$k]['feedtime'] = date('Y-m-d H:i:s',$v['feedtime']);
                }
                $this->ajaxReturn($data);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->ajaxReturn(false);
        }
    }
    //分页读取我的反馈
    function readFeedListByPage($page,$row){
        $UID = $this->getSessionUID();
        if($UID){
            $Feed = D('Feed');
            $pageAll = $Feed->allCount($UID);
            $pageAll = ceil($pageAll/$row);
            $data = $Feed->readFeedListByPage($UID,$page,$row);
            if($data){
                foreach ($data as $k=>$v)
                {
                    $data[$k]['feedtime'] = date('Y-m-d H:i:s',$v['feedtime']);
                }
                $data[]['pageall'] = $pageAll;
                $this->ajaxReturn($data);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->ajaxReturn(false);
        }
    }
}