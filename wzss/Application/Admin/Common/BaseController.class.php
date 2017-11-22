<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/10
 * Time: 10:28
 */
namespace Admin\Common;
use Think\Controller;
class BaseController extends Controller{
    public $access;
    public function __construct()
    {

        parent::__construct();
        //var_dump(empty(session('uid')));
        if(session('uid')){
            $sid=cookie('sid');
            if(isset($sid)){
                session_destroy();
                session_id($sid);
                session_start();
            }

            $me = M('menu');
            $str="";
            $menu = $me->table('menu')->where("statu = 1 and parent_id = 0")->select();
            if(is_array($menu)&&!empty($menu)){
                foreach ($menu as $vo){
                    $access = M('access');
                    $where="statu = 1 and parent_id=".$vo['id'];
                    if(session('roleid') > 1){
                        $where =" and user_id = ".session('uid')." and `search`=1";
                    }
                    $this->access =  $access->table('access a')->join("menu m ON m.id = a.menu_id",'LEFT')->field("a.*,m.id as m_id,m.`name` ,m.modular,m.controller,m.method,m.parent_id,m.icons")->where($where)->select();
                    if(is_array($this->access)&&!empty($this->access)){
                        $str.="<li class=\"treeview\"><a href=\"#\"><i class=\"fa fa-pie-chart\"></i><span>".$vo['name']."</span>";
                        $str.="<span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span></a>";
                        $str.="<ul class='treeview-menu'>";
                        $str.="<li><a href='/".$vo['modular']."/".$vo['controller']."/".$vo['method']."'><i class='".$vo['icons']."'></i> ".$vo['name']."</a></li>";
                        foreach ($this->access as $v){
                            $str.="<li><a href='/".$v['modular']."/".$v['controller']."/".$v['method']."'><i class='".$v['icons']."'></i> ".$v['name']."</a></li>";
                        }
                        $str.="</ul></li>";
                    }else{
                        $str.="<li class=\"treeview\"><a href=\"#\"><i class=\"fa fa-pie-chart\"></i><span>".$vo['name']."</span></a>";
                    }
                }
            }

          $index=strrpos(__CONTROLLER__,"/")+1;
          $controller = substr(__CONTROLLER__,$index,strlen(__CONTROLLER__));
          $this->assign('controller',$controller);
          $this->assign('menu',$str);
        }else{
            $this->redirect("/Admin/Login/",'',1,'页面跳转中。。。。。');
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
       $this->view->display($templateFile,$charset,$contentType,$content,$prefix);
    }
}