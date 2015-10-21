<?php
/**
 * Created by PhpStorm.
 * User: zhangke
 * Date: 2015/9/4 0004
 * Time: 12:48
 */

namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{
    //判断邮箱是否注册
    function isRegister($email){
        $User = D('User');
        $data = $User->isRegister($email);
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //用户注册
    function userRegister($email,$userName,$password,$pwd){
        if (strlen($email) > 0 && strlen($userName) > 0 
            && strlen($password) > 0 && ($password == $pwd)) {
            $User = D('User');
            if($User->isRegister($email)){
                $this->ajaxReturn(false);
            }else{
                $data = $User->userRegister($email,$userName,$password);
                if ($data) {
                    $this->ajaxReturn(true);
                }else{
                    $this->ajaxReturn(false);
                }
            }       
        }else{
            $this->ajaxReturn(false);
        }
        
    }
    //用户登录
    function userLogin($email,$password,$logintype){
        if(strlen($email) > 0 && strlen($password) > 0){
            $User = D('User');
            $data = $User->userLogin($email,$password,$logintype);
            if($data){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->ajaxReturn(false);
        } 
    }
    //修改密码
    function updatePassword($email,$password,$newpwd){
        if(strlen($email) > 0 && strlen($password) > 0 && strlen($newpwd) > 0){
            $User = D('User');
            if($User->confirmPassword($email,$password)){
                $data = $User->updatePassword($email,$newpwd);
                if($data){
                    $this->ajaxReturn(true);
                }else{
                    $this->ajaxReturn(false);
                }
            }else{
                $this->ajaxReturn(false);
            }

        }
    }
    //用户退出
    function userExit(){
        $User = D('User');
        $data = $User->userExit();
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }

    //设置session
    function setSession($UID)
    {
        $User = D('User');
        $data = $User->setSession($UID);
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }

    //判断session是否为空
    function isSession()
    {
        $User = D('User');
        $data = $User->isSession();
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }

    //销毁session
    function delSession()
    {
        $User = D('User');
        $data = $User->delSession();
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }

    //获取session值
    function getSession()
    {
        $User = D('User');
        $data = $User->getSession();
        if($data) {
            $this->ajaxReturn($data);
        }
        else {
            $this->ajaxReturn(false);
        }
    }
    //设置cookie
    function setCookie($UID,$logintype){
        $User = D('User');
        $data = $User->setCookie($UID,$logintype);
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //获取cookie
    function getCookie(){
        $User = D('User');
        $data = $User->getCookie();
        if($data){
            $this->ajaxReturn($data);
        }
        else{
            $this->ajaxReturn(false);
        }
    }
    //销毁cookie
    function delCookie(){
        $User = D('User');
        $data = $User->delCookie();
        if($data){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    //获取用户信息
    function getUserInfo(){
        $User = D('User');
        $data = $User->getUserInfo();
        if($data) {
            $data['usercreate'] = date('Y-m-d H:i:s',$data['usercreate']);
            $this->ajaxReturn($data);
        }
        else {
            $this->ajaxReturn(false);
        }
    }
    //获取用户名
    function getUserName(){
        $User = D('User');
        $data = $User->getUserName();
        if($data) {
            $this->ajaxReturn($data);
        }
        else {
            $this->ajaxReturn(false);
        }
    }
    //生成验证码
    function authCode()
    {
        $User = D("User");
        $User->authCode();
    }

    // 检测的验证码是否正确，$code为用户输入的验证码字符串
    function checkVerify($code, $id = '')
    {
        $User = D("User");
        if($User->check_verify($code, $id = ''))
        {
            $this->ajaxReturn(true);
        }
        else
        {
            $this->ajaxReturn(false);
        }
    }
    
}