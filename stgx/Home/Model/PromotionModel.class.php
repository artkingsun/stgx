<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/9 0009
 * Time: 14:59
 */

namespace Home\Model;
use Think\Model;


class PromotionModel extends Model{
    //添加优惠活动
    function addPromotion($title,$content,$start,$end,$place,$type,$UID){
        $data['promotiontitle'] = $title;
        $data['promotiontime'] = time();
        $data['promotionstart'] = $start;
        $data['promotionend'] = $end;
        $data['promotioncontent'] = $content;
        $data['promotionplace'] = $place;
        $data['promotiontype'] = $type;
        $data['promotionstatus'] = 1;
        $data['userid'] = $UID;
        $rc = $this->add($data);
        if($rc){
            return true;
        }else{
            return false;
        }
    }
    //删除优惠活动
    function delPromotion($promotionid,$UID){
        $data['promotionid'] = $promotionid;
        $data['userid'] = $UID;
        $rc = $this->where($data)->delete();
        if($rc){
            return true;
        }else{
            return false;
        }
    }
    //按条件获取优惠活动总数$type 0默认
    function allCount($type){
        $data['promotiontstatus'] = 1;
        if($type != "默认排序"){
            $data['promotiontype'] = $type;
        }
        $rc = $this->where($data)->count();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //按条件分页读取优惠活动信息$type 0默认
    function readPromotionListByPage($page,$row,$type){
        $data['promotiontstatus'] = 1;
        if($type != "默认排序"){
            $data['promotiontype'] = $type;
        }
        $rc = $this->where($data)->field('promotionid,promotiontitle,promotiontime,promotionstart,
        promotionend,promotioncontent,promotionplace,userid')->
        order('promotionid desc')->page("$page,$row")->select();
        //echo $this->getLastSql();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //计算搜索的总数
    function searchCount($keyword){
        $data['promotiontitle'] = array('like',"%$keyword%");
        $rc = $this->where($data)->count();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //搜索结果分页读取活动信息$keyword 活动标题关键字
    function searchPromotion($page,$row,$keyword){
        $data['promotiontstatus'] = 1;
        $data['promotiontitle'] = array('like',"%$keyword%");
        $rc = $this->where($data)->field('promotionid,promotiontitle,promotiontime,promotionstart,
        promotionend,promotioncontent,promotionplace,userid')->
        order('promotionid desc')->page("$page,$row")->select();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
}