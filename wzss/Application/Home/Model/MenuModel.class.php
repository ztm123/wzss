<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/13
 * Time: 16:41
 */
namespace Home\Model;
use Think\Model;

class MenuModel extends Model{
    protected $tableName = 'menu';

    public function __construct()
    {
        parent::__construct();
    }

    public function getfrom($tbale){
        $this->tableName=$tbale;
        return $this;
    }

    public function getNum($wherer=""){
        $num = $this->table($this->tableName)->where($wherer)->count();
        return $num;
    }
    public function select_row($where){
        $row = $this->table($this->tableName)->where($where)->select();
        return $row[0];
    }

    public function save_add($data){
        $id = $this->table($this->tableName)->add($data);
        return $id;
    }

    public function update($where,$data){
        $id = $this->table($this->tableName)->where($where)->save($data);
        return $id;
    }

    public function delete_data($wherer){
        $id = $this->table($this->tableName)->where($wherer)->delete();
        return $id;
    }

    public function selectAll($where="",$state="",$pagesize="",$order=""){
        $data = $this->table($this->tableName)->where($where)->order("$order")->limit("$state,$pagesize")->select();
        return $data;
    }

}