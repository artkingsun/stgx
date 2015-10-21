<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/9 0009
 * Time: 14:58
 */

namespace Home\Controller;
use Think\Controller;


class PromotionController extends Controller{
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
    //添加优惠活动
    function addPromotion($title,$content,$start,$end,$place,$type){
        $UID = $this->getSessionUID();
        if(strlen($title) > 0 && strlen($content) > 0 && $UID){
            $Promotion = D('Promotion');
            $data = $Promotion->addPromotion($title,$content,$start,$end,$place,$type,$UID);
            if($data){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->ajaxReturn(false);
        }
    }
    //删除优惠活动
    function delPromotion($promotionid){
        $UID = $this->getSessionUID();
        if($UID){
            $Promotion = D('Promotion');
            $data = $Promotion->delPromotion($promotionid,$UID);
            if($data){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->ajaxReturn(false);
        }
    }
    //按条件分页读取优惠活动$type 0 默认
    function readPromotionListByPage($page,$row,$type){
        $Promotion = D('Promotion');
        $pageAll = $Promotion->allCount($type);
        $pageAll = ceil($pageAll/$row);
        $data = $Promotion->readPromotionListByPage($page,$row,$type);
        if($data){
            foreach ($data as $k=>$v)
            {
                $data[$k]['promotiontime'] = date('Y-m-d H:i:s',$v['promotiontime']);
                $UID = $data[$k]['userid'];
                $User = D('User');
                $userInfo = $User->getUserInfoByUid($UID);
                $data[$k]['username'] = $userInfo['username'];
                $data[$k]['userpic'] = $userInfo['userpic'];
            }
            $data[]['pageall'] = $pageAll;
            $this->ajaxReturn($data);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //搜索优惠活动
    function searchPromotion($page,$row,$keyword){
        if(strlen($keyword) > 0){
            $Promotion = D('Promotion');
            $pageAll = $Promotion->searchCount($keyword);
            $pageAll = ceil($pageAll/$row);
            $data = $Promotion->searchPromotion($page,$row,$keyword);
            if($data){
                foreach ($data as $k=>$v)
                {
                    $data[$k]['promotiontime'] = date('Y-m-d H:i:s',$v['promotiontime']);
                    $UID = $data[$k]['userid'];
                    $User = D('User');
                    $userInfo = $User->getUserInfoByUid($UID);
                    $data[$k]['username'] = $userInfo['username'];
                    $data[$k]['userpic'] = $userInfo['userpic'];
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