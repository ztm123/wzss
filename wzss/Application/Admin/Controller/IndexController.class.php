<?php
namespace Admin\Controller;
use Admin\Common\BaseController;
use Think\Page;
class IndexController extends BaseController {
    public function __construct()
    {
        $title = array(
            'title'=>'后台管理'
        );
        parent::__construct();
    }

    public function index(){

        echo  __ROOT__."<br/>" ;   // 当前网站地址
        echo  __APP__."<br/>" ;        // 当前应用地址
        echo  __MODULE__."<br/>" ;
        echo   __ACTION__."<br/>" ;     // 当前操作地址
        echo  htmlentities(__SELF__)."<br/>" ;       // 当前页面地址
        echo    __CONTROLLER__."<br/>" ;
        echo  __CONTROLLER__."<br/>" ;
        echo  __ROOT__.'/Public'."<br/>" ; // 站点公共目录
       // $this->display("index");

    }
    public function main(){
        //$this->redirect("/Home/Login/",'',1,'页面跳转中。。。。。');
        $this->display("Main/main");

    }

}