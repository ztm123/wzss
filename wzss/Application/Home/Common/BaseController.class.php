<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/10
 * Time: 10:28
 */
namespace Home\Common;
use Think\Controller;
class BaseController extends Controller{
    public $access;
    public function __construct()
    {

        parent::__construct();
        if(session('uid')){
            $sid=cookie('sid');
            if(isset($sid)){
                session_destroy();
                session_id($sid);
                session_start();
            }

            $access = M('access');
            $str="";
            $where="statu = 1";
            if(session('roleid') > 1){
                $where =" and user_id = ".session('uid')." and `search`=1";
            }
            $this->access =  $access->table('access a')->join("menu m ON m.id = a.menu_id",'LEFT')->field("a.*,m.id as m_id,m.`name` ,m.modular,m.controller,m.method")->where($where)->select();

            if(is_array($this->access)&&!empty($this->access)){
                foreach ($this->access as $vo){
                    $str.="<li><a href='/".$vo['modular']."/".$vo['controller']."/".$vo['method']."'>".$vo['name']."</a></li>";
                }
            }

            $index=strrpos(__CONTROLLER__,"/")+1;
            $controller = substr(__CONTROLLER__,$index,strlen(__CONTROLLER__));
            $this->assign('controller',$controller);
            $this->assign('menudata',$this->access);
            $this->assign('menu',$str);
        }else{
            $this->redirect("/Home/Login/",'',1,'页面跳转中。。。。。');
        }
    }

    //权限严重请求
    public function checkAccess($methods=""){
        $index=strrpos(__CONTROLLER__,"/")+1;
        $controller = substr(__CONTROLLER__,$index,strlen(__CONTROLLER__));
        $method = I("post.method","");
        if($method==""){
            $method=$methods;
        }
        $data = ['access'=>0,'message'=>''] ;
        foreach ($this->access as $vo){
            if($vo['controller']==$controller){
                if($method=="delete"){
                    $data['message']="delete";
                }
                $data['access']=$vo[$method];
            }
        }
        if($methods==""){
            $this->ajaxReturn($data);
        }else{
            if($data['access']){
                return true;
            }else{
                return false;
            }
        }
    }
    protected function display($templateFile='',$charset='',$contentType='',$content='',$prefix='') {
        parent::display("./top");
        $this->view->display($templateFile,$charset,$contentType,$content,$prefix);
    }
}