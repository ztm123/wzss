<?php
namespace Home\Controller;
use Home\Common\BaseController;
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
        //$this->redirect("/Home/Login/",'',1,'页面跳转中。。。。。');
        $this->display();

    }
}