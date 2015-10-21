<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/8 0008
 * Time: 23:46
 */

namespace Home\Controller;
use Think\Controller;


class FoundController extends Controller{
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
    //添加失物
    function addFound($title,$content,$place,$foundtime,$contact,$picurl){
//        $title = "书包";
//        $content  = "书包丢啦";
//        $place = "东2";
//        $foundtime = "周一";
//        $contact = "QQ123";
//        $picurl = "/Public";
        if(strlen($title) > 0 && strlen($content) > 0){
            $UID = $this->getSessionUID();
            $Found = D('Found');
            $data = $Found->addFound($UID,$title,$content,$place,$foundtime,$contact,$picurl);
            if($data){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->ajaxReturn(false);
        }
    }
    //删除失物
    function delFound($foundid){
        $UID = $this->getSessionUID();
        if($UID){
            $Found = D('Found');
            $data = $Found->delFound($foundid,$UID);
            if($data){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->ajaxReturn(false);
        }

    }
    //标记领取失物$foundget 0 未领取 1 已领取  若未领取则改变为领取状态，只有发布者有操作权限
    function changeFoundGetStatus($foundid,$foundget){
        $UID = $this->getSessionUID();
        $Found = D('Found');
        $data = $Found->changeFoundGetStatus($foundid,$foundget,$UID);
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //按条件分页读取失物$type 1 默认 2 未领取 3 领取
    function readFoundListByPage($page,$row,$type){
        $User = D("User");
        $Found = D('Found');
        $pageAll = $Found->allCount($type);
        $pageAll = ceil($pageAll/$row);
        $data = $Found->readFoundListByPage($page,$row,$type);
        if($data){
            foreach ($data as $k=>$v) {
                $data[$k]['foundpublish'] = date('Y-m-d H:i:s',$v['foundpublish']);
                $rc = $User->getUserInfoByUid($data[$k]['userid']);
                //$rc为一个一维数组，find()方法取得的数据均为一维数组，若$rc为二维数组，则使用$rc[0]['name']取得值
                $data[$k]['username'] = $rc['username'];
                $data[$k]['userpic'] = $rc['userpic'];
            }
            $data[]['pageall'] = $pageAll;
            $this->ajaxReturn($data);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //搜索失物
    function sesrchFound($page,$row,$keyword){
        $User = D("User");
        $Found = D('Found');
        $pageAll = $Found->searchCount($keyword);
        $pageAll = ceil($pageAll/$row);
        $data = $Found->sesrchFound($page,$row,$keyword);
        if($data){
            foreach ($data as $k=>$v) {
                $data[$k]['foundpublish'] = date('Y-m-d H:i:s',$v['foundpublish']);
                $rc = $User->getUserInfoByUid($data[$k]['userid']);
                //$rc为一个一维数组，find()方法取得的数据均为一维数组，若$rc为二维数组，则使用$rc[0]['name']取得值
                $data[$k]['username'] = $rc['username'];
                $data[$k]['userpic'] = $rc['userpic'];
            }
            $data[]['pageall'] = $pageAll;
            $this->ajaxReturn($data);
        }else{
            $this->ajaxReturn(false);
        }
    }
}