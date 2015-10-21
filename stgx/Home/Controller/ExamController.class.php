<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/4 0004
 * Time: 23:17
 */

namespace Home\Controller;
use Think\Controller;

class ExamController extends Controller{
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
    //添加考试资料
    function addExam($title,$content,$year,$prof,$subject,$url){
        if(strlen($title) > 0 && strlen($content) > 0){
            $UID = $this->getSessionUID();
            $Exam = D('Exam');
            $data = $Exam->addExam($title,$content,$year,$prof,$subject,$url,$UID);
            if($data){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->ajaxReturn(false);
        }
    }
    //删除考试资料
    function delExam($examid){
        $UID = $this->getSessionUID();
        $Exam = D('Exam');
        $data = $Exam->delExam($examid,$UID);
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //计算下载量  下载一次累加一次(目前只实现计数)
    function countDownload($examid){
        //$UID = $this->getSessionUID();
        $Exam = D('Exam');
        $data = $Exam->countDownload($examid);
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //计算好评数量  如果该用户已经评价了就取消  不能好评和差评同时
    function countGood($examid){
        //$UID = $this->getSessionUID();
        $Exam = D('Exam');
        $data = $Exam->countGood($examid);
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //计算差评数量
    function countBad($examid){
        //$UID = $this->getSessionUID();
        $Exam = D('Exam');
        $data = $Exam->countBad($examid);
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //按条件分页读取考试资料$type 1 默认 2 下载量 3 好评量 4 差评量
    function readExamListByPage($page,$row,$type){
        $User = D("User");
        $Exam = D('Exam');
        $pageAll = $Exam->allCount($type);
        $pageAll = ceil($pageAll/$row);
        $data = $Exam->readExamListByPage($page,$row,$type);
        if($data){
            foreach ($data as $k=>$v)
            {
                $data[$k]['examtime'] = date('Y-m-d H:i:s',$v['examtime']);
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
    //获得年份
    function getYear(){
        $Exam = D('Exam');
        $data = $Exam->getYear();
        if($data){
            $this->ajaxReturn($data);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //获得专业
    function getProf(){
        $Exam = D('Exam');
        $data = $Exam->getProf();
        if($data){
            $this->ajaxReturn($data);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //获得科目
    function getSubject(){
        $Exam = D('Exam');
        $data = $Exam->getSubject();
        if($data){
            $this->ajaxReturn($data);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //搜索考试资料
    function searchExam($page,$row,$year,$prof,$subject,$keyword){
        $User = D("User");
        $Exam = D("Exam");
        $data = $Exam->searchExam($page,$row,$year,$prof,$subject,$keyword);
        if($data)
        {
            foreach ($data as $k=>$v)
            {
                $data[$k]['examtime'] = date('Y-m-d H:i:s',$v['examtime']);
                $rc = $User->getUserInfoByUid($data[$k]['userid']);
                //$rc为一个一维数组，find()方法取得的数据均为一维数组，若$rc为二维数组，则使用$rc[0]['name']取得值
                $data[$k]['username'] = $rc['username'];
                $data[$k]['userpic'] = $rc['userpic'];
            }
            $pageAll = $Exam->searchAll($year,$prof,$subject,$keyword);
            if($pageAll == false) {
                $data[]['pageall'] = 0;
            } else {
                $pageAll = ceil($pageAll/$row);
                $data[]['pageall'] = $pageAll;
            }
            $this->ajaxReturn($data);
        }
        else
        {
            $this->ajaxReturn(false);
        }
    }



}