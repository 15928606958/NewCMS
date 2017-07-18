<?php



/**
 * 显示
 * @param $status
 * @param $message
 * @param array $data
 */
function show($status,$message,$data=array()){
    $result = array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
    );
    exit(json_encode($result));
}

/**
 * 获得加密密码
 * @param $password
 * @return string
 */
function getMd5Password($password){
    return md5($password.C('MD5_PRE'));
}

/**
 * 获取菜单的中文类型
 * @param $type
 * @return string
 */
function getMenuType($type){
    return $type==1?'后台菜单':'前端导航';
}

/**
 * 获取菜单的中文状态
 * @param $status
 * @return string
 */
function getMenuStatus($status){
    if($status == 0){
        $str = '关闭';
    }
    elseif($status == 1){
        $str = '正常';
    }
    elseif($status == -1){
        $str = '删除';
    }
    return $str;
}