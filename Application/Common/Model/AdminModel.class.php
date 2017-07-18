<?php
namespace Common\Model;
use Think\Model;
class AdminModel extends Model{

    private $_db = '';
    public function __construct(){
        $this->_db = M('admin');
    }

    //通过用户名获取后台登录用户的相关信息
    public function getAdminByUsername($username){
        $ret = $this->_db->where(array('username'=>$username))->find();
        return $ret;
    }
}
