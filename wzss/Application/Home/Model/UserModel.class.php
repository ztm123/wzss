<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/10
 * Time: 11:36
 */
namespace Home\Model;
use Think\Model;

class UserModel extends Model{
    protected $tableName = 'user';
    public function findRow($username,$password=""){
        $row = $this->table($this->tableName)->where("name='".$username."' and password = '".$password."'")->select();
        return $row[0];
    }
    public function getNum($tbale,$wherer){
       $num = $this->table($tbale)->where($wherer)->count();
       return $num;
    }
    public function delete_data($tbale,$wherer){
        $id = $this->table($tbale)->where($wherer)->delete();
        return $id;
    }
    public function select_row($table_name,$where){
        $row = $this->table($table_name)->where($where)->select();
        return $row[0];
    }
    public function update($table_name,$where,$data){
        $id = $this->table($table_name)->where($where)->save($data);
        return $id;
    }
    public function save_add($table_name,$data){
        $id = $this->table($table_name)->add($data);
        return $id;
    }
    public function counts($wherer){
        $num = M('access')->where($wherer)->count();
        return $num;
    }
    public function update_access($where,$data){
        $id = M('access')->where($where)->save($data);
        return $id;
    }
    public function save_access($data){
        $id = M('access')->add($data);
        return $id;
    }
    public function selectAll($tbale,$where="",$state="",$pagesize="",$order=""){
        $data = $this->table($tbale)->where($where)->order("$order")->limit("$state,$pagesize")->select();
        return $data;
    }
}
