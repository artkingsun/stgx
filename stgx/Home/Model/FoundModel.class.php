<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/8 0008
 * Time: 23:48
 */

namespace Home\Model;
use Think\Model;


class FoundModel extends Model{
    //添加失物
    function addFound($UID,$title,$content,$place,$foundtime,$contact,$picurl){
        $data['userid'] = $UID;
        $data['foundtitle'] = $title;
        $data['foundcontent'] = $content;
        $data['foundplace'] = $place;
        $data['foundtime'] = $foundtime;
        $data['foundcontact'] = $contact;
        $data['foundpic'] = $picurl;
        $data['foundpublish'] = time();
        $rc = $this->add($data);
        if($rc){
            return true;
        }else{
            return false;
        }
    }
    //删除失物
    function delFound($foundid,$UID){
        $data['foundid'] = $foundid;
        $data['userid'] = $UID;
        $rc = $this->where($data)->delete();
        if($rc !== false){
            return true;
        }else{
            return false;
        }
    }
    //标记领取失物$foundget 0 未领取 1 已领取  若未领取则改变为领取状态，只有发布者有操作权限
    function changeFoundGetStatus($foundid,$foundget,$UID){
        $data['userid'] = $UID;
        $data['foundid'] = $foundid;
        if($foundget == 0){
            $map['foundget'] = 1;
        }else{
            $map['foundget'] = 0;
        }
        $rc = $this->where($data)->save($map);
        if($rc){
            return true;
        }else{
            return false;
        }
    }
    //根据条件计算失物总数$type 1 默认 2 未领取 3 领取
    function allCount($type){
        if($type == 2){
            $data['foundget'] = 0;
        }
        if($type == 3){
            $data['foundget'] = 1;
        }
        $data['foundstatus'] = 1;
        $rc = $this->where($data)->count();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //搜索失物总数
    function searchCount($keyword){
        if($keyword != "") {
            $data['foundtitle'] = array('like',"%$keyword%");
        }
        $data['foundstatus'] = 1;
        $rc = $this->where($data)->count();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //根据条件分页读取失物信息$type 1 默认 2 未领取 3 领取
    function readFoundListByPage($page,$row,$type){
        $data['foundstatus'] = 1;
        switch($type){
            case 1:
                $rc = $this->where($data)->field('foundid,foundtitle,foundcontent,foundtime,foundpublish,foundplace,foundcontact,foundget,foundpic,userid')->order('foundid desc')->page("$page,$row")->select();
                break;
            case 2:
                $data['foundget'] = 0;
                $rc = $this->where($data)->field('foundid,foundtitle,foundcontent,foundtime,foundpublish,foundplace,foundcontact,foundget,foundpic,userid')->order('foundid desc')->page("$page,$row")->select();
                break;
            case 3:
                $data['foundget'] = 1;
                $rc = $this->where($data)->field('foundid,foundtitle,foundcontent,foundtime,foundpublish,foundplace,foundcontact,foundget,foundpic,userid')->order('foundid desc')->page("$page,$row")->select();
                break;
            default:;
                break;
        }
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //搜索失物信息
    function sesrchFound($page,$row,$keyword){
        $data['foundstatus'] = 1;
        if($keyword != "") {
            $data['foundtitle'] = array('like',"%$keyword%");
        }
        $rc = $this->where($data)->field('foundid,foundtitle,foundcontent,foundtime,foundpublish,foundplace,foundcontact,foundget,foundpic,userid')->order('foundid desc')->page("$page,$row")->select();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
}