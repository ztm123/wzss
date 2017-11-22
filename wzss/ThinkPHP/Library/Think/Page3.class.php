<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 9:39
 */
namespace Think;
class Page{
    public $page;//当前第几页
    public $totle;//一共有多少条记录
    public $pageSize;//每页显示多少条
    public $str='';//存储分页html字符串
    public $maxPage;//最大页数
    public function __construct($totle,$pageSize=10)
    {
        $this->totle=$totle;
        $this->pageSize=$pageSize;
        //获取当前页
        if(isset($_GET['page'])){
            $this->page = $_GET['page'];
        }
        else{
            $this->page = 1;
        }

    }
    //定义上一页的按钮
    //当当前页已经是第一页的时候  不能点击上一页
    public function start(){
        $this->str='<nav aria-label="Page navigation"><ul class="pagination">';
        if($this->page>1){
            $this->str.='<li><a href="?f=lists&page='.($this->page-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        else{
            $this->str.='<li class=\'disabled\'><a href="javascript:void(0)" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        }

    }
    //定义页码
    public function number(){
        //总共页数
        $this->maxPage = ceil($this->totle/$this->pageSize);
        //当总共的页数小于10页的时候 页码就是1开始到最大页【最大页是小于10的】
        if($this->maxPage<=10){
            $forStart=1;
            $forEnd=$this->maxPage;
        }
        else{

            //当总共页数大于10的时候  而且当前页小于等于6页的时候  一样是显示1-10页
            if($this->page<=6){
                $forStart=1;
                $forEnd=10;
            }
            else{
                // 总共页大于10  当前页大于6  如果当前页+4 仍然比最大页小 那么就显示 当前页-5 到当前页+4
                if($this->page+4<=$this->maxPage){
                    $forStart=$this->page-5;
                    $forEnd=$this->page+4;
                }
                else{
                    //当前页大于6  但是当前页+4大于最大页 最后一页就是最大页  开始页就是最大页-9
                    $forStart=$this->maxPage-9;
                    $forEnd=$this->maxPage;
                }
            }
        }
        //循环生成页码
        for ($i=$forStart;$i<=$forEnd;$i++){
            if($i == $this->page){
                $this->str.='<li class="active"><a href="?f=lists&page='.$i.'">' .$i. '</a></li>';
            }
            else{
                $this->str.='<li><a href="?f=lists&page='.$i.'">' .$i. '</a></li>';
            }
        }


    }
    //定义下一页
    //当当前页是最大页的时候  下一页不能点击
    public function end(){
        if($this->page>=$this->maxPage){
            $this->str.="<li class='disabled'><a href=\"javascript:void(0)\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li></ul></nav>";
        }
        else{
            $pas = $this->page+1;
            $this->str.="<li><a href=\"?f=lists&page=$pas\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li></ul></nav>";
        }
    }


    public function create(){
        $this->start();
        $this->number();
        $this->end();
        return $this->str;
    }


}