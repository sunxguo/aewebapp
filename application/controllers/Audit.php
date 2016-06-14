<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audit extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->library('GetData');
		$this->load->model("Dbhandler");
	}
    public function adminCommonHandler($parameters){
		if(!$this->checkAdminLogin()) return false;
		$this->load->view('Audit/_header');
		$this->load->view('Audit/'.$parameters['view'],$parameters['data']);
		$this->load->view('Audit/_footer');
	}

	public function Audittrue()
	{
		$bannerParameters=array(
			'result'=>'count',
			'orderBy'=>array('addtime'=>'AESC')
		);
		
		if(isset($_GET['startTime'])){
			$bannerParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$bannerParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$bannerParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getAuditshop($bannerParameters);
		$baseUrl='/audit/Audittrue?placeholder=true';
		$selectUrl='/audit/Audittrue?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$bannerParameters['result']='data';
		$admins=$this->getdata->getAuditshop($bannerParameters);
		$parameters=array(
			'view'=>'Audittrue-list',
			'data'=>array('admins'=>$admins,'pageInfo'=>$pageInfo)
		);

		$this->adminCommonHandler($parameters);
	}

	public function unapprove()
	{
		$bannerParameters=array(
			'result'=>'count',
			'orderBy'=>array('shop_addtime'=>'AESC')
		);
		
		if(isset($_GET['startTime'])){
			$bannerParameters['time']['begin']=$_GET['startTime'].' 00:00:00';
		}
		if(isset($_GET['endTime'])){
			$bannerParameters['time']['end']=$_GET['endTime'].' 23:59:59';
		}
		if(isset($_GET['keywords'])){
			$bannerParameters['keywords']=$_GET['keywords'];
		}
		$amount=$this->getdata->getUnAuditshop($bannerParameters);
		$baseUrl='/audit/unapprove?placeholder=true';
		$selectUrl='/audit/unapprove?placeholder=true';
		$currentPage=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$amountPerPage=20;
		$pageInfo=$this->getdata->getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount);
		$bannerParameters['result']='data';
		$admins=$this->getdata->getUnAuditshop($bannerParameters);

		$parameters=array(
			'view'=>'unapprove-list',
			'data'=>array('admins'=>$admins,'pageInfo'=>$pageInfo)
		);

		$this->adminCommonHandler($parameters);
	}



}	