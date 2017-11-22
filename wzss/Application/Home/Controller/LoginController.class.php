<?php
/**
 * 会员登录类
 * User: 张同明
 * Date: 2017/11/8
 * Time: 13:53
 */
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $this->display("index");
    }

    public function cancel(){
        session_destroy();
        $this->redirect("/Admin/Login/",'',1,'页面跳转中。。。。。');
    }
    public function check(){
        echo "<pre>";
        print_r($_POST);
        if(IS_POST){
            $username = I('post.name','','addslashes');
            $password = I('post.password','','addslashes');
            $baocun = I('post.checkbox',0);
            $role = I('post.role',4);

            if($username==""&&$password==""){
                $this->redirect("Admin/Login/login",'',1,'页面跳转中。。。。。');
            }else{
                $password=md5($password);
                $where = "account = '$username' and `password` = '$password'";
                $user=D('user');
                switch ($role){
                    case 1:
                        break;
                    case 2:
                        break;
                    case 3:
                        break;
                    case 4:
                        $data= $user->select_row('user',$where);
                        break;
                }
                if(is_array($data)&&!empty($data)){
                    if($data['enable']==0){
                        $this->redirect("Home/Login/",'',1,'该账户已停用，请联系管理员。。。。。');
                    }
                    $s_id = session_id();
                    if($baocun=="on"){
                        setcookie("sid", $s_id, time()+3600*24*7);
                    }else{
                        setcookie("sid", '', time()-3600*7);
                    }
                    session('uid',$data['id']);
                    session('uname',$data['name']);
                    session('image',$data['photo']);
                    session('roleid',$data['roleid']);
                    $this->redirect("/Home/Index/index",'',1,'登录成功。。。。。');
                }else{
                    $this->redirect("/Home/Login/",'',1,'页面跳转中。。。。。');
                }
            }
        }else{
            $this->redirect("Home/Login/",'',1,'页面跳转中。。。。。');
        }
    }
    public function checklogin(){

    }
}