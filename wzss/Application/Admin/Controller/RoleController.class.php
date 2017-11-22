<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/13
 * Time: 16:34
 */
namespace Admin\Controller;
use Admin\Common\BaseController;
use Think\Page;
class RoleController extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $pagesize=10;
        $user=D('role');
        $count = $user->from('role')->getNum();
        $curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况
        $url = "?page={page}";
        $page = new Page($count, $pagesize, $curpage, $url, 1);
        $state =($curpage-1)*$pagesize;
        $this->assign('page',$page->myde_write());
        $data= $user->from('role')->selectAll('1=1',$state,$pagesize,"id desc");
        $this->assign('data',$data);
        $this->display("list");
    }

    public function save_update(){
        if(!$this->checkAccess("update")){
            $this->error("你没有该权限");
        }
        $name = $this->cheackAccount(I("post.name",'','addslashes'),"name",false);
        if(!empty($name)){
            $this->error("该角色已存在");
        }
        $data =Array
        (
            'name' => I("post.name",'','addslashes')
        );

        $user=D('role');
        $id=I("post.id","",'addslashes');
        $b=  $user->from('role')->update("id=$id",$data);
        if($b){
            $this->success('修改成功','/Admin/Role/');
        }else{
            $this->error("修改失败");
        }
    }

    public function update_show(){
        $user=D('role');
        $id = I('get.id','','addslashes');
        $data= $user->from('role')->select_row("id=".$id);
        $this->assign('data',$data);
        $this->display("update");
    }

    public function deletes(){
        if(!$this->checkAccess("delete")){
            $this->error("你没有该权限");
        }
        $id = I("get.id",'',"addslashes");
        $user=D('role');
        $flog = $user->from('role')->delete_data("id=$id");
        if($flog){
            $this->success('删除成功','/Admin/Role/');
        }else{
            $this->error("删除失败");
        }
    }


    public function save()
    {
        if(!$this->checkAccess("add")){
            $this->error("你没有该权限");
        }
        $name = $this->cheackAccount(I("post.name",'','addslashes'),"name",false);
        if(!empty($name)){
            $this->error("该角色已存在");
        }

        $data =Array
        (
            'name' => I("post.name",'','addslashes')
        );
        $user=D('role');
        $id = $user->from('role')->save_add($data);
        if($id){
            $this->success('添加成功','/Admin/Role/');
        }else{
            $this->error("添加失败");
        }
    }

    public function cheackAccount($pan_name="",$pan_keys="",$flag=true){
        $user=D('role');
        $name = I("post.name",'',"addslashes");
        $key = I("post.key",'',"addslashes");
        if($name=="" || $key==""){
            $key=$pan_keys;
            $name=$pan_name;
        }
        if($name!=""){
            $count = $user->from('role')->select_row("$key='".$name."'");
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