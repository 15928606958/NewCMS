<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller {

    /**
     * 登录页面
     */
    public function index(){

        //如果session存在 直接跳转到仪表盘
        if(session('adminUser')){
            $this->redirect('/index.php?m=admin&c=index&a=index');
        }
    	return $this->display();
    }

    /**
     * 验证后台登录
     */
    public function check()
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if(!$username)
        {
            return show(0,'用户名不能为空');
        }
        if(!$password)
        {
            return show(0,'密码不能为空');
        }
        $ret = D('Admin')->getAdminByUsername($username);
        if(!$ret){
            return show(0,'用户不存在');
        }
        if(getMd5Password($password) != $ret['password'])
        {
            return show(0,'密码错误');
        }
        session('adminUser',$ret);
        return show(1,'登录成功');
    }

    /**
     * 退出登录
     */
    public function loginout(){
        session('adminUser',null);
        $this->redirect('/index.php?m=admin&c=login&a=index');
    }

}