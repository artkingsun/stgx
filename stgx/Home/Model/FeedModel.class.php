<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/4 0004
 * Time: 16:08
 */

namespace Home\Model;
use Think\Model;

class FeedModel extends Model{
    //添加反馈
    function addFeed($content,$contact,$UID){
        $data['feedcontent'] = $content;
        $data['feedcontact'] = $contact;
        $data['feedtime'] = time();
        $data['userid'] = $UID;
        $rc = $this->add($data);
        if($rc){
            return true;
        }else{
            return false;
        }
    }
    //删除反馈
    function delFeed($feedid,$UID){
        $data['feedid'] = $feedid;
        $data['userid'] = $UID;
        $rc = $this->where($data)->delete();
        if($rc !== false){
            return true;
        }else{
            return false;
        }
    }
    //计算我的反馈的总条数
    function allCount($UID){
        $data['userid'] = $UID;
        $rc = $this->where($data)->count();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //分页读取我的反馈
    function readFeedListByPage($UID,$page,$row){
        $data['userid'] = $UID;
        $rc = $this->where($data)->field('feedid,feedcontent,feedtime')->order('feedid desc')->page("$page,$row")->select();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //读取我的反馈
    function readFeedList($UID){
        $data['userid'] = $UID;
        $rc = $this->where($data)->field('feedid,feedcontent,feedtime')->order('feedid desc')->select();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
}