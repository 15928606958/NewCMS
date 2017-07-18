<?php
namespace Common\Model;
use Think\Model;
class MenuModel extends Model{
    private $_db = '';

    public function __construct()
    {
        $this->_db = M('menu');
    }

    //插入数据
    public function insert($data = array()){
        if(!$data || !is_array($data))
        {
            return 0;
        }
        return $this->_db->add($data);
    }

    /**
     * 获取菜单
     * @param $data
     * @param $page
     * @param int $pageSize
     * @return mixed
     */
    public function getMenus($data,$page,$pageSize=10){
        $data['status'] = array('neq',-1);  //不显示删除的数据
        $offset = ($page-1)*$pageSize;  //起始位置
        $list = $this->_db->where($data)->order('menu_id desc')->limit($offset,$pageSize)->select();
        return $list;
    }

    /**
     *
     */
    public function getMenusCount($data=array()){
        $data['status'] = array('neq',-1);  //不显示删除的数据
        return $this->_db->where($data)->count();
    }

    public function find($id){
        if(!$id || !is_numeric($id)){
            return array();
        }
        return $this->_db->where(['menu_id' => $id])->find();
    }

    //根据菜单id更新数据
    public function updateMenuById($id,$data=[])
    {
        if(!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }
        if(!$data || !is_array($data)){
            throw_exception('更新的数据不合法');
        }
        return $this->_db->where(['menu_id' => $id])->save($data);
    }
    //根据菜单id修改菜单状态
    public function updateStatusById($id,$status)
    {
        if(!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }
        if(!$status || !is_numeric($status)){
            throw_exception('更新的数据不合法');
        }
        $data['status'] = $status;
        return $this->_db->where(['menu_id' => $id])->save($data);
    }
}