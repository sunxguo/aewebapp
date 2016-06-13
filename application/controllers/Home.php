<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->library('GetData');
		$this->load->model("Dbhandler");
	}
	public function checkAdminLogin(){
		if (!checkLogin()) {
			$this->load->view('redirect',array("fartherurl"=>"/admin/login","info"=>"请先登录管理员账号"));
			return false;
		}else 

		return true;
	}
	public function login(){
		$this->load->view('admin/login',array('title'=>"管理员登录"));
	}

	public function adminCommonHandler($parameters){
		if(!$this->checkAdminLogin()) return false;
		$this->load->view('admin/_header');
		$this->load->view('admin/'.$parameters['view'],$parameters['data']);
		$this->load->view('admin/_footer');
	}
	public function index(){
		$parameters=array();
		if(isset($_SESSION['usertype']) && isset($_SESSION['grade']))
		{

			$usertype=$_SESSION['usertype'];
			$grade=$_SESSION['grade'];
			//var_dump($usertype);
			if($usertype == '1' && $grade == '1')
			{
				//等级为0  超级管理员 
				$parameters=array(
				'view'=>'index',
				'data'=>array('usertype'=>'admin0')
				);
			}
		    elseif($usertype == '1' && $grade == '2')
		    {
		    	//等级为1 总管 负责个个模块的管理员增删改查
		    	$parameters=array(
				'view'=>'index',
				'data'=>array('usertype'=>'admin1')
				);
		    }
		     //商铺审核管理
			if($usertype == '7' && $grade == '2')
			{
				//等级为2 是该模块的审核  //店铺审核 管理
	            $parameters=array(
				'view'=>'examinant-list',
				'data'=>array('usertype'=>'shop2')
				);
			}
			elseif($usertype == '7' && $grade == '1')
			{
				//等级为1 是该模块的管理
				$parameters=array(
				'view'=>'examinant-list',
				'data'=>array('usertype'=>'shop1')
				);
			}
	        //关注审核管理
			if($usertype == '3' && $grade == '1')
			{
				//关注审核管理
				//var_dump(789456);
				$parameters=array(
				'view'=>'attention-list',
				'data'=>array('usertype'=>'attention1')
				);
			}
			elseif($usertype == '3' && $grade == '2')
			{
				$parameters=array(
				'view'=>'attention-list',
				'data'=>array('usertype'=>'attention2')
				);
			}
			 //附近审核管理
			if($usertype == '4' && $grade == '1')
			{
				//附近审核管理
				$parameters=array(
				'view'=>'nearby-list',
				'data'=>array('usertype'=>'attention1')
				);
			}
			elseif($usertype == '4' && $grade == '2')
			{

				$parameters=array(
				'view'=>'nearby-list',
				'data'=>array('usertype'=>'attention2')
				);
			}


			 //推荐审核管理
			if($usertype == '5' && $grade == '1')
			{
				//推荐审核管理
				$parameters=array(
				'view'=>'recommend-list',
				'data'=>array('usertype'=>'recommend1')
				);
			}
			elseif($usertype == '5' && $grade == '2')
			{

				$parameters=array(
				'view'=>'recommend-list',
				'data'=>array('usertype'=>'recommend2')
				);
			}	
            
            
			//搜索审核管理
			if($usertype == '6' && $grade == '1')
			{
				//搜索审核管理
				$parameters=array(
				'view'=>'search-list',
				'data'=>array('usertype'=>'search1')
				);
			}
			elseif($usertype == '6' && $grade == '2')
			{

				$parameters=array(
				'view'=>'search-list',
				'data'=>array('usertype'=>'search2')
				);
			}
			
		}
		else
		{
			$parameters=array(
			'view'=>'shop-admin',
			'data'=>array()
			);
		}
		$this->adminCommonHandler($parameters);
	}

}
