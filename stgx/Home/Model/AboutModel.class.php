<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/28 0028
 * Time: 15:50
 */

namespace Home\Model;
use Think\Model;

class AboutModel extends Model{
    //添加关于
    function addAbout($title,$content,$type,$UID){
        $data['abouttitle'] = $title;
        $data['aboutcontent'] = $content;
        $data['abouttype'] = $type;
        $data['userid'] = $UID;
        $data['abouttime'] = time();
        $data['aboutstatus'] = 1;
        $rc = $this->add($data);
        if($rc){
            return true;
        }else{
            return false;
        }
    }
    //删除关于
    function delAbout($aboutid,$UID){
        $data['aboutid'] = $aboutid;
        $data['userid'] = $UID;
        $rc = $this->where($data)->delete();
        if($rc !== false){
            return true;
        }else{
            return false;
        }
    }
    //根据类型读取关于信息
    function readAboutListByType($type){
        $data['aboutstatus'] = 1;
        if($type != "所有信息"){
            $data['abouttype'] = $type;
        }
        $rc = $this->where($data)->field('aboutid,abouttitle,aboutcontent,userid')->order('aboutid desc')->select();
        if($rc){
            return $rc;
        }else{
            return false;
        }
    }
}