<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/4 0004
 * Time: 12:49
 */
namespace Home\Model;
use Think\Model;

class UserModel extends Model{
    //判断邮箱是否注册
    function isRegister($email){
        $data['useremail'] = $email;
        $rc = $this->where($data)->find();
        if($rc){
            return true;
        }else{
            return false;
        }
    }
    //用户注册
    function userRegister($email,$userName,$password){
        $password = sha1($password);
        $data['username'] = $userName;
        $data['useremail'] = $email;
        $data['userpwd'] = $password;
        $data['usersex'] = "保密";
        $data['usercreate'] = time();
        $data['userstatus'] = 0;                 //未激活
        $data['userpic'] = "Public/images/fly.png";
        $data['usertype'] = 0;                   //普通用户
        $rc = $this->add($data);
        return $rc;
    }

    //根据Email获取用户状态
    function getUserStatusByEmail($email){
        $data['useremail'] = $email;
        $rc = $this->where($data)->field('userstatus')->find();
        if($rc['userstatus'] == 1){
            return false;
        }else{
            return true;
        }
    }
    //用户登录
    function userLogin($email,$password,$logintype){
        if($this->getUserStatusByEmail($email)){
            $password = sha1($password);
            $data['useremail'] = $email;
            $data['userpwd'] = $password;
            $rc = $this->where($data)->find();
            $UID = $this->getUserIdByEmail($email);
            $dataSession = $this->setSession($UID);
            $dataCookie = $this->setCookie($UID,$logintype);
            if($rc && $dataSession && $dataCookie){
                return true;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }
    //获取用户信息
    function getUserInfo(){
        $data['userid'] = $this->getSession();//获取的值是否是数组
        if($data != null){
            $rc = $this->where($data)->field('username,useremail,userpic,usercreate,usersex,userstatus,usertype')->find();
            if($rc)
            {
                return $rc;
            }
            else
            {
                return false;
            }
        }else{
            return false;
        }
//        echo $this->getLastSql();
    }
    //根据UID获取用户信息
    function getUserInfoByUid($UID){
        $data['userid'] = $UID;
        if($data != null){
            $rc = $this->where($data)->field('username,useremail,userpic,usercreate,usersex,userstatus,usertype')->find();
            if($rc)
            {
                return $rc;
            }
            else
            {
                return false;
            }
        }else{
            return false;
        }
    }
    //获取用户名
    function getUserName(){
        $data['userid'] = $this->getSession();
        $rc = $this->where($data)->field('username')->find();
        if($rc)
        {
            return $rc;
        }else
        {
            return false;
        }
    }
    //确认密码
    function confirmPassword($email,$password){
        $password = sha1($password);
        $data['useremail'] = $email;
        $data['userpwd'] = $password;
        $rc = $this->where($data)->find();
        if($rc){
            return true;
        }else{
            return false;
        }
    }
    //修改密码
    function updatePassword($email,$newpwd){
        $newpwd = sha1($newpwd);
        $data['useremail'] = $email;
        $map['userpwd'] = $newpwd;
        $rc = $this->where($data)->save($map);
        if($rc !== false){
            return true;
        }else{
            return false;
        }
    }
    //用户退出
    function userExit(){
        $dataCookie = $this->delCookie();
        $dataSession = $this->delSession();
        if($dataCookie && $dataSession){
            return true;
        }else{
            return false;
        }
    }
    //根据邮箱获得UID
    function getUserIdByEmail($email){
        $data['useremail'] = $email;
        $rc = $this->where($data)->field('userid')->find(); //返回的是一个数组
        return $rc['userid'];
    }
    //设置session  UID
    function setSession($UID)
    {
        session('UID',$UID);
        return true;
    }
    //获取session
    function getSession()
    {
        $data = session('UID');
        return $data;
    }
    //销毁session
    function delSession()
    {
        session('UID',null);
        return true;
    }
    //判断session是否为空
    function isSession()
    {
        if(!session('?UID'))
        {
            //是空
            return true;
        }
    }
    //设置cookie
    function setCookie($UID,$logintype){
        if($logintype == true){
            cookie('UID',$UID,3600*24*10);//有效期1小时
            return ture;
        }else{
            cookie('UID',$UID);//有效期1小时
            return ture;
        }
    }
    //获取cookie
    function getCookie(){
        $data = cookie('UID');
        return $data;
    }
    //销毁cookie
    function delCookie(){
        cookie('UID',null);
        return true;
    }
    //生成验证码
    function authCode(){
        $Verify = new \Think\Verify();
        // 开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
        $Verify->useImgBg = false;
        // 设置验证码字符为纯数字
        // 设置验证码字符$Verify->zhSet = '们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这';
        $Verify->codeSet = '0123456789';
        $Verify->fontSize = 60;
        $Verify->length   = 4;
        //验证码噪点
        $Verify->useNoise = true;
        $Verify->entry();
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

}