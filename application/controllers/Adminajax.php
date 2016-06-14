<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Adminajax extends CI_Controller {
	private $_data;//获取到的数据
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->library('GetData');
		$this->load->model("Dbhandler");
		if(isset($_POST['data'])){
			$this->_data=json_decode($_POST['data']);
		}else{
			echo json_encode(array("result"=>"failed","message"=>"没有得到数据!"));
		}
	}
	public function login(){
        
		if(!property_exists($this->_data, "username") || !property_exists($this->_data, "password")){
			echo json_encode(array("result"=>"failed","message"=>"请输入用户名和密码!"));
			return false;
		}
		if(!property_exists($this->_data, "verificationCode")){
			echo json_encode(array("result"=>"failed","message"=>"请输入验证码!"));
			return false;
		}
		if(!$this->getdata->checkCode($this->_data->verificationCode)){
			echo json_encode(array("result"=>"failed","message"=>"验证码错误!"));
			return false;
		}

		$username=$this->_data->username;
		$password=$this->_data->password;
		$info=$this->getdata->getContentAdvance('admin',array('username'=>$username));

		//如果admin表中有数据  则进行判断是否为管理审核员

		if(!empty($info->username) && isset($info->username))
		{
            if(!property_exists($info,'username')){
				echo json_encode(array("result"=>"failed","message"=>"用户名不存在!"));
				return false;
			}
			$post_pwd=MD5($password);
			$db_pwd=$info->password;
			if($post_pwd!=$db_pwd){
				echo json_encode(array("result"=>"failed","message"=>"密码错误!"));
				return false;
			}

			$status=$info->status;
			if($status != '1')
			{
				echo json_encode(array("result"=>"failed","message"=>"该管理员禁止访问!"));
				return false;
			}

			$_SESSION=array();
			$_SESSION['username']=$info->username;
			$_SESSION['userid']=$info->admin_id;
			$_SESSION['usertype']=$info->type;
			$_SESSION['grade']=$info->grade;
		}
		else
		{	
            $admin=$this->getdata->getContentAdvance('user',array('user_name'=>$username));
            if(!empty($admin->user_name) && isset($admin->user_name))
            {
				if(!property_exists($admin,'user_name')){
					echo json_encode(array("result"=>"failed","message"=>"用户不存在!"));
					return false;
				}
            }
            else
            {

				$admin=$this->getdata->getContentAdvance('user',array('user_phone'=>$username));

				if(!property_exists($admin,'user_phone')){
					echo json_encode(array("result"=>"failed","message"=>"用户不存在123!"));
					return false;
				}
            }
        	
			$post_pwd=MD5($password.'63');
			$db_pwd=$admin->user_password;
			if($post_pwd!=$db_pwd){
				echo json_encode(array("result"=>"failed","message"=>"密码错误!"));
				return false;
			}
			//通过user_id判断是否开通店铺  若未开通 则无法进入后台
			$shop=$this->getdata->getContentAdvance('usershop',array('shop_user_id'=>$admin->user_id));
            if(!empty($shop->shop_id) && $shop->shop_status == 0 && $shop->shop_audit_status == 1)
            {
            	$_SESSION=array();
            	$_SESSION['nickname']=$admin->user_nickname;
            	$_SESSION['username']=$admin->user_name;
				$_SESSION['userid']=$admin->user_id;
				$_SESSION['shopid']=$shop->shop_id;
            }
            else
            {
            	echo json_encode(array("result"=>"failed","message"=>"您暂未申请店铺或店铺未通过审核!"));
				return false;
            }
			
		}
	
		echo json_encode(array("result"=>"success","message"=>"登录成功!"));
	}
	public function logout(){
		// unset($_SESSION["username"]);
		// unset($_SESSION["userid"]);
		// unset($_SESSION["usertype"]);
		$_SESSION=array();
		$this->load->view('redirect',array("url"=>"/admin/login"));
	}
}