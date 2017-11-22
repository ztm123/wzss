<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/13
 * Time: 16:34
 */
namespace Home\Controller;
use Home\Common\BaseController;
use Think\Page;
class MenuController extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $pagesize=10;
        $user=D('menu');
        $count = $user->getfrom('menu')->getNum();
        $curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况
        $url = "?page={page}";
        $page = new Page($count, $pagesize, $curpage, $url, 1);
        $state =($curpage-1)*$pagesize;
        $this->assign('page',$page->myde_write());
        $data= $user->getfrom('menu')->selectAll('1=1',$state,$pagesize,"id desc");
        $this->assign('data',$data);
        $this->display("list");
    }

    public function save_update(){

        $name = $this->cheackAccount(I("post.name",'','addslashes'),"name",false);
        if(!empty($name)){
            $this->error("该部门已存在");
        }
        $data =Array
        (
            'name' => I("post.name",'','addslashes'),
            'parent_id' => I("post.de_id",0,'addslashes')
        );

        $user=D('department');
        $id=I("post.id","",'addslashes');
        $b=  $user->getfrom('department')->update("department_id=$id",$data);
        if($b){
            $this->success('修改成功','/Admin/Department/');
        }else{
            $this->error("修改失败");
        }
    }

    public function update_show(){
        $user=D('department');
        $id = I('get.id','','addslashes');
        $de =  $user->getfrom('department')->selectAll();
        $data= $user->getfrom('department')->select_row("department_id=".$id);
        $this->assign('de',$de);
        $this->assign('data',$data);
        $this->display("update");
    }

    public function deletes(){
        $id = I("get.id",'',"addslashes");
        $user=D('department');
        $flog = $user->getfrom('department')->delete_data("department_id=$id");
        if($flog){
            $this->success('删除成功','/Admin/Department/');
        }else{
            $this->error("删除失败");
        }
    }


    public function save()
    {
        $name = $this->cheackAccount(I("post.name",'','addslashes'),"name",false);
        if(!empty($name)){
            $this->error("该菜单已存在");
        }
        $data =Array
        (
            'name' => I("post.name",'','addslashes'),
            'modular' => I("post.modular",'','addslashes'),
            'controller' => I("post.controller",'','addslashes'),
            'method' => I("post.method",'','addslashes')

        );
        $user=D('menu');
        $id = $user->save_add($data);
        if($id){
            $this->success('添加成功','/Admin/Menu/');
        }else{
            $this->error("添加失败");
        }
    }

    public function cheackAccount($pan_name="",$pan_keys="",$flag=true){
        $user=D('menu');
        $name = I("post.name",'',"addslashes");
        $key = I("post.key",'',"addslashes");
        if($name=="" || $key==""){
            $key=$pan_keys;
            $name=$pan_name;
        }
        if($name!=""){
            $count = $user->getfrom('menu')->select_row("$key='".$name."'");
            if(is_array($count)&&!empty($count)){
                if($flag){
                    $this->ajaxReturn('已存在');
                }else{
                    return $count[$key];
                }

            }else{
                if($flag){
                    $this->ajaxReturn('');
                }else{
                    return '';
                }
            }
        }else{
            if($flag){
                $this->ajaxReturn('不能为空');
            }else{
                echo  '不能为空';
            }
        }
    }

    public function showadd(){
        $this->display("add");
    }

}