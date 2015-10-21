<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/4 0004
 * Time: 23:18
 */

namespace Home\Model;
use Think\Model;

class ExamModel extends Model{
    //添加考试资料
    function addExam($title,$content,$year,$prof,$subject,$url,$UID){
        $data['examtitle'] = $title;
        $data['examcontent'] = $content;
        $data['examyear'] = $year;
        $data['examprof'] = $prof;
        $data['examsubject'] = $subject;
        $data['examurl'] = $url;
        $data['userid'] = $UID;
        $data['examtime'] = time();
        $rc = $this->add($data);
        if($rc){
            return true;
        }else{
            return false;
        }
    }
    //删除考试资料
    function delExam($examid,$UID){
        $data['examid'] = $examid;
        $data['userid'] = $UID;
        $rc = $this->where($data)->delete();
        if($rc !== false){
            return true;
        }else{
            return false;
        }
    }
    //计算下载量
    function countDownload($examid){
        $data['examid'] = $examid;
        $rc = $this->where($data)->setInc('examdownload');
        if($rc !== false){
            return true;
        }else{
            return false;
        }
    }
    //计算好评数
    function countGood($examid){
        $data['examid'] = $examid;
        $rc = $this->where($data)->setInc('examgood');
        if($rc !== false){
            return true;
        }else{
            return false;
        }
    }
    //计算差评数
    function countBad($examid){
        $data['examid'] = $examid;
        $rc = $this->where($data)->setInc('exambad');
        if($rc !== false){
            return true;
        }else{
            return false;
        }
    }
    //计算考试资料的总条数$type 1 默认 2 下载量 3 好评量 4 差评量
    function allCount(){
        $data['examstatus'] = 1;
        $rc = $this->where($data)->count();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //计算搜索的总条数
    function searchAll($year,$prof,$subject,$keyword){
        if($year != "") {
            $map['examyear'] = $year;
        }
        if($prof != "") {
            $map['examprof'] = $prof;
        }
        if($subject != "") {
            $map['examsubject'] = $subject;
        }
        if($keyword != "") {
            $map['examtitle'] = array('like',"%$keyword%");
        }
        $data = $this->where($map)->count();
        if($data) {
            return $data;
        }
        else {
            return false;
        }
    }
    //按条件分页读取考试资料
    function readExamListByPage($page,$row,$type){
        $data['examstatus'] = 1;
        switch($type){
            case 1:
                $rc = $this->where($data)->field('examid,examtitle,examcontent,examtime,examyear,examprof,examsubject,examurl,examdownload,examgood,exambad,userid')->order('examid desc')->page("$page,$row")->select();
                break;
            case 2:
                $rc = $this->where($data)->field('examid,examtitle,examcontent,examtime,examyear,examprof,examsubject,examurl,examdownload,examgood,exambad,userid')->order('examdownload desc')->page("$page,$row")->select();
                break;
            case 3:
                $rc = $this->where($data)->field('examid,examtitle,examcontent,examtime,examyear,examprof,examsubject,examurl,examdownload,examgood,exambad,userid')->order('examgood desc')->page("$page,$row")->select();
                break;
            case 4:
                $rc = $this->where($data)->field('examid,examtitle,examcontent,examtime,examyear,examprof,examsubject,examurl,examdownload,examgood,exambad,userid')->order('exambad desc')->page("$page,$row")->select();
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
    //获得年份
    function getYear(){
        $data['examstatus'] = 1;
        $rc = $this->where($data)->field('examyear')->distinct(true)->select();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //获得专业
    function getProf(){
        $data['examstatus'] = 1;
        $rc = $this->where($data)->field('examprof')->distinct(true)->select();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //获得科目
    function getSubject(){
        $data['examstatus'] = 1;
        $rc = $this->where($data)->field('examsubject')->distinct(true)->select();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
    //搜索分页
    function searchExam($page,$row,$year,$prof,$subject,$keyword){
        $map['examstatus'] = 1;
        if($year != "") {
            $map['examyear'] = $year;
        }
        if($prof != "") {
            $map['examprof'] = $prof;
        }
        if($subject != "") {
            $map['examsubject'] = $subject;
        }
        if($keyword != "") {
            $map['examtitle'] = array('like',"%$keyword%");
        }
        $data = $this->where($map)->field('examid,examtitle,examcontent,examtime,examyear,examprof,examsubject,examurl,examdownload,examgood,exambad,userid')->order('examid desc')->page("$page,$row")->select(); // 查询一页数据
//        echo $this->getLastSql();
//        dump($data);
        if($data) {
            return $data;
        }
        else
        {
            return false;
        }
    }
}