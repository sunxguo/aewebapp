<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Common extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->helper("upload");
		$this->load->library('GetData');
        //$this->load->library('PHPExcel');
//		$this->load->library('PHPExcel');
		$this->load->model("dbHandler");
	}
	public function addInfo(){
		$table="";

		$data=json_decode($_POST['data']);

		$info=array();
		switch($data->infoType){
			case "banner":
				$table="banner";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"title"=>$data->title,
					"introduction"=>$data->introduction,
					"addtime"=>$time,
					"edittime"=>$time,
					"content"=>$data->content,
					"thumbnail"=>strstr($data->thumbnail,'http')?$data->thumbnail:SERVER_IP.($data->thumbnail),
					"order"=>is_numeric($data->order)?$data->order : 0,
					"draft"=>$data->draft
				);
				$result=$this->dbHandler->insertData($table,$info);
			break;
			case "admin":
				$table="admin";
				$time=date("Y-m-d H:i:s");
				if($this->getdata->isExist('admin',array('username'=>$data->username))){
					echo json_encode(array("result"=>"failed","message"=>"该用户名已存在！"));
					return false;
				}
				$info=array(
					"username"=>$data->username,
					"password"=>MD5($data->password),
					"type"=>$data->type,
					"grade"=> '2',
					"addtime"=>$time,
					"edittime"=>$time,
					"status"=> '1'
				);
				$result=$this->dbHandler->insertData($table,$info);
			break;
			case "adtime":
				$table="adtime";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"ad_time"=>$data->ad_time,
					"ad_addtime"=>$time,
					"ad_edittime"=>$time,
					"ad_time_status"=>'1'
				);
				$result=$this->dbHandler->insertData($table,$info);
			break;
			case "adcatetype":
				$table="adspottype";
				$time=date("Y-m-d H:i:s");
				$info=array(
					"ad_spot_type_name"=>$data->ad_name,
					"ad_spot_type_unit_price"=>$data->ad_price,
					"ad_spot_type_addtime"=>$time,
					"ad_spot_type_edittime"=>$time,
					"ad_spot_type_status"=>'1'
				);
				$result=$this->dbHandler->insertData($table,$info);
			break;
			case "product":

						if(!empty($data->pic1))
						{
							$pic1=strstr($data->pic1,'http')?$data->pic1:SERVER_IP.($data->pic1);
						}
						else
						{
							$pic1='';
						}
						if(!empty($data->pic2))
						{
							$pic2=strstr($data->pic2,'http')?$data->pic2:SERVER_IP.($data->pic2);
						}
						else
						{
							$pic2='';
						}
						if(!empty($data->pic3))
						{
							$pic3=strstr($data->pic3,'http')?$data->pic3:SERVER_IP.($data->pic3);
						}
						else
						{
							$pic3='';
						}
						if(!empty($data->pic4))
						{
							$pic4=strstr($data->pic4,'http')?$data->pic4:SERVER_IP.($data->pic4);
						}
						else
						{
							$pic4='';
						}
						if(!empty($data->pic5))
						{
							$pic5=strstr($data->pic5,'http')?$data->pic5:SERVER_IP.($data->pic5);
						}
						else
						{
							$pic5='';
						}

						$goods_feature_id=$data->goods_feature_id;
                        $string=implode(',',$goods_feature_id);
							
						$info['goods']=array();
						$info['goods']=array(	

								"goodsShopId"=>$_SESSION['shopid'],
								"categoryShopId"=>$data->category_shop_id,
								"detailedname"=>$data->detailedname,
								"name"=>$data->name,
								"price"=>$data->price,
								"originalPrice"=>$data->original_price,
								"pic1"=>$pic1,
								"pic2"=>$pic2,
								"pic3"=>$pic3,
								"pic4"=>$pic4,
								"pic5"=>$pic5,
								"danwei"=>$data->danwei,
								"keywords"=>$data->keywords,	
								"goodsFeature"=>$string,					
								"description"=>$data->description,
								"isrecommend"=>$data->isrecommend,
								"status"=>$data->status
						);
						$goods=json_encode($info);
						$url=API_IP.'AEWebApp/userShop/addGoods';
			            $partam='goods='.$goods;
			            $header = array();
						$coupon = httpPost($url,$partam,$header);
						$results = json_decode($coupon);
						$result=$results->data;
				       // var_dump($result);    
			           
			break;
		    
            case "businessdistrict":
				    $table="businessdistrict"; 
					
					$object['business']=array();
					$object['business']=array(
						"businessProvince"=>$data->business_province,
						"businessCity"=>$data->business_city,
						"businessArea"=>$data->business_area,
						"businessName"=>$data->business_name,
						"businessAddress"=>$data->business_address,
						"businessComments"=>$data->business_comments,
						"businessStreet"=>$data->business_street,
						"businessLogo"=>strstr($data->thumbnail,'http')?$data->thumbnail:SERVER_IP.($data->thumbnail),
						"businessMart"=>$data->business_mart,
						"businessLng"=>$data->business_lng,
						"businessLat"=>$data->business_lat,
						"businessStatus"=>$data->business_status
						);
					
					$business=json_encode($object);
					$url=API_IP.'AEWebApp/common/addBusiness';
	                $partam='business='.$business;

	                $header = array();
					$coupon = httpPost($url,$partam,$header);
					$results = json_decode($coupon);
					$result=$results->data;
			break;
            
            /*口令分类*/
			case "wordsort":
					
					$object['wordSort']=array();
					$object['wordSort']=array(
						"wordSortName"=>$data->word_sort_name	
					);
					
					$wordsort=json_encode($object);
					$url=API_IP.'AEWebApp/userShop/insertWordSort';
	                $partam='wordSort='.$wordsort;
	                $header = array();
					$coupon = httpPost($url,$partam,$header);
					$results = json_decode($coupon);
					$result=$results->data;
			break;

			 /*今日市价*/
			case "todayprice":
					
					$object['todayPrice']=array();
					$object['todayPrice']=array(
						"todayGoodsName"=>$data->today_goods_name,
						"todayMinPrice"=>$data->today_min_price,
						"todayMaxPrice"=>$data->today_max_price,
						"todayOrders"=>$data->today_orders
					);
					
					$todayPrice=json_encode($object);
					$url=API_IP.'AEWebApp/nearby/addTodayPrice';
	                $partam='todayPrice='.$todayPrice;
	                //var_dump($partam);
	                $header = array();
					$coupon = httpPost($url,$partam,$header);
					$results = json_decode($coupon);
					$result=$results->data;
			break;
            /*口令分类详情*/
			case "worditem":
					
					$object['wordItem']=array();
					$object['wordItem']=array(
						"wordItemSortId"=>$data->word_item_sort_id,
						"wordItemName"=>$data->word_item_name
					);
					
					$wordItem=json_encode($object);
					$url=API_IP.'AEWebApp/userShop/insertWordItem';
	                $partam='wordItem='.$wordItem;
	                $header = array();
					$coupon = httpPost($url,$partam,$header);
					$results = json_decode($coupon);
					$result=$results->data;
			break;

			 /*口令分类详情*/
			case "worditemadd":
					
					$object['wordItem']=array();
					$object['wordItem']=array(
						"wordItemShopId"=>$_SESSION['shopid'],
						"wordItemName"=>$data->word_item_name
					);
					
					$wordItem=json_encode($object);
					$url=API_IP.'AEWebApp/userShop/insertWordItem';
	                $partam='wordItem='.$wordItem;
	                $header = array();
					$coupon = httpPost($url,$partam,$header);
					$results = json_decode($coupon);
					$result=$results->data;
			break;
            /*添加商品分类*/
			case "category":
				    $table="goodscategory"; 

					if($this->getdata->isExist('goodscategory',array('name'=>$data->name))){
						echo json_encode(array("result"=>"failed","message"=>"该分类名已存在！"));

						return false;
					}

					$object['goodsCategory']=array();
					$object['goodsCategory']=array(
						"categoryShopId"=>$_SESSION['shopid'],
						"name"=>$data->name,
						"describeShop"=>$data->describe_shop,
						"status"=>$data->status
						);
					
					$goodsCategory=json_encode($object);
					$url=API_IP.'AEWebApp/userShop/addGoodsCategory';
	                $partam='goodsCategory='.$goodsCategory;
	                $header = array();
					$coupon = httpPost($url,$partam,$header);
					$results = json_decode($coupon);
					//var_dump($results);
					$result=$results->data;
			break;

			
            /*添加分类特征*/
			case "catefeature":
				    $table="categoryfeature"; 
                    $time=date("Y-m-d H:i:s");
                    /*根据分类id查出分类下的所有分类特征*/
                    // $cateid=$data->feature_category_id;
                    // $parameters=array(
                    //     'cateid'=>$cateid,
                    //     'result'=>'count'
                    // 	);
                    // $feature=$this->getdata->getCateFeature($parameters);

                    // if($feature >= 5)
                    // {
                    // 	echo json_encode(array("result"=>"failed","message"=>"该分类下的分类特征已经达到上限！,请重新添加"));
                    // 	return false;
                    // }
                    /*判断添加的分类特征是否存在*/ 
					if($this->getdata->isExist('categoryfeature',array('feature_name'=>$data->feature_name))){
						echo json_encode(array("result"=>"failed","message"=>"该分类特征已存在！"));
						return false;
					}

					$object=array();
					$object=array(
						"feature_name"=>$data->feature_name,
						"feature_addtime"=>$time
						);

					$result=$this->dbHandler->insertData($table,$object);

			break;

			/*添加二级分类特征*/
			case "subcatefeature":
				    $table="categoryfeature"; 
                    $time=date("Y-m-d H:i:s");
                    $name=$data->feature_name;
                    for($i=0;$i<count($name);$i++)
                    {
						$object=array(
							"feature_category_id"=>$data->feature_category_id,
							"feature_name"=>$name[$i],
							"feature_addtime"=>$time 
							);

						$result=$this->dbHandler->insertData($table,$object);
                    }
					

			break;

			/*添加分类特征值*/
			case "catefeatureval":
				    $table="categoryeigenvalue"; 
                    $time=date("Y-m-d H:i:s");
					if($this->getdata->isExist('categoryeigenvalue',array('eigen_name'=>$data->eigenvalue_name))){
						echo json_encode(array("result"=>"failed","message"=>"该分类特征值已存在！"));
						return false;
					}

					$object=array();
					$object=array(
						"eigen_feature_id"=>$data->feature_id,
						"eigen_name"=>$data->eigenvalue_name,
						"eigen_addtime"=>$time,
						"eigen_eidttime"=>$time
						);

					$result=$this->dbHandler->insertData($table,$object);

			break;

			/*添加平台提示信息*/
			case "reminder":
				    
                    $time=date("Y-m-d H:i:s");

					$object['reminder']=array();
					$object['reminder']=array(
						"msgContent"=>$data->msg_content,
						"msgStatus"=>$data->msg_status
						
						);
                    $reminder=json_encode($object);
					$url=API_IP.'AEWebApp/common/insertReminder';
	                $partam='reminder='.$reminder;
	                $header = array();
					$reminderJSON = httpPost($url,$partam,$header);
					$results = json_decode($reminderJSON);
					$result=$results->data;

			break;
			
			case "activity":
				    $table="activity"; 
					$time=date("Y-m-d H:i:s");
					/*根据店铺id查出优惠活动的数量*/
					$shopid=$_SESSION['shopid'];
			        $url=API_IP.'AEWebApp/userShop/queryActivityList?activityShopId='.$shopid;
			        $header=array();
			        $param=array();
			        $goodsJSON=httpGet($url,$header,$param);
				    $getactivity = json_decode($goodsJSON)->data;
				    $countact=count($getactivity);
				    if($countact >= 3)
				    {
				    	echo json_encode(array("result"=>"failed","message"=>"该商店的优惠活动已经到达上限"));
						return false;
				    }

					/*添加数据*/
					$object['activity']=array();
					$object['activity']=array(
						"activityShopId"=>$_SESSION['shopid'],
						"activityName"=>$data->activity_name,
						"content"=>$data->content,
						"thumbnail1"=>strstr($data->thumbnail1,'http')?$data->thumbnail1:SERVER_IP.($data->thumbnail1),
						"activityKeyword"=>$data->activity_keyword,
						"activityBegintime"=>$data->activity_begintime,
						"activityEndtime"=>$data->activity_endtime,
						"status"=>$data->status
						);
					
					$activity=json_encode($object);
					$url=API_IP.'AEWebApp/userShop/insertActivityInfo';
	                $partam='activity='.$activity;
	                $header = array();
					$coupon = httpPost($url,$partam,$header);
					$results = json_decode($coupon);
					$result=$results->data;
			break;
	
		}

		

		if($result==1)echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息写入失败"));exit;
	}

	//添加管理审核员
	public function addAdminInfo(){
		$table="";
		$data=json_decode($_POST['data']);

		$info=array();
		switch($data->infoType){
			case "shopadmin":
				$table="admin";
				$time=date("Y-m-d H:i:s");
				if($this->getdata->isExist('admin',array('username'=>$data->username))){
					echo json_encode(array("result"=>"failed","message"=>"该用户名已存在！"));
					return false;
				}
				$info=array(
					"username"=>$data->username,
					"password"=>MD5($data->password),
					"type"=>$data->type,
				    "grade"=>$data->grade,
					"addtime"=>$time,
					"edittime"=>$time,
					"status"=>$data->status	
				);
			break;
			case "admin":
				$table="admin";
				$time=date("Y-m-d H:i:s");
				if($this->getdata->isExist('admin',array('username'=>$data->username))){
					echo json_encode(array("result"=>"failed","message"=>"该用户名已存在！"));
					return false;
				}
				$info=array(
					"username"=>$data->username,
					"password"=>MD5($data->password),
					"type"=>$data->type,
					"grade"=> '2',
					"addtime"=>$time,
					"edittime"=>$time,
					"status"=> '1'
				);
			break;
		}	
			
		$result=$this->dbHandler->insertData($table,$info);
		
		//var_dump($result);
		if($result==1)echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息写入失败"));
	}
	public function addBulkInfo(){
		//var_dump($_POST['data']);
		$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		switch($data->infoType){
			case "coupons": 
				$table="coupon";
				$time=date("Y-m-d H:i:s");
				$objects['coupon']=array();
				$objects['coupon']=array(
					"couponShopId"=>$_SESSION['shopid'],
					"couponFacevalue"=>$data->coupon_facevalue,
					"couponUseprice"=>$data->coupon_useprice,
					"couponBeginvalid"=>$data->coupon_beginvalid,
					"couponEndvalid"=>$data->coupon_endvalid
					
					
				);
				$coupon=json_encode($objects);
				$url=API_IP.'AEWebApp/userShop/insertCoupon';
                $partam='coupon='.$coupon;
                

			break;

			case "word":
				$table="wordlist";
				$time=date("Y-m-d H:i:s");
				$objects['word']=array();
				$objects['word']=array(
					"wordShopId"=>$_SESSION['shopid'],
					"wordDiscount"=>$data->word_discount,
					"wordGood"=>$data->word_good,
					"wordPrimeCost"=>$data->word_prime_cost,
					"wordContentItemId"=>$data->word_content,
					"wordBegintime"=>$data->word_begintime,
					"wordEndtime"=>$data->word_endtime
	
				);
				$word=json_encode($objects);
				$url=API_IP.'AEWebApp/userShop/insertWord';
                $partam='word='.$word;

			break;
		}

		$header = array();
		$coupon = httpPost($url,$partam,$header);
		$results = json_decode($coupon);
		//var_dump($results);
		$result=$results->data;
		if($result==1)echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息写入失败"));exit;
	}
	public function modifyInfo(){

		$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		$where=array();
		switch($data->infoType){
			
			case "admin":
				$table="admin";
                
				$where=array('admin_id'=>$data->admin_id);
				if($data->old_usename != $data->username) 
				{
					if($this->getdata->isExist('admin',array('username'=>$data->username)))
					{
						echo json_encode(array("result"=>"failed","message"=>"该用户名已存在！"));
						return false;
					}
				}
			 
                $info=array('edittime'=>date("Y-m-d H:i:s"));
					
					if(isset($data->username)){
						$info['username']=$data->username;
					}
					if(isset($data->type)){
						$info['type']=$data->type;
					}
					
					if(isset($data->status)){
						$info['status']=$data->status;
					}
					
				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));

                //var_dump($result); 
			break;

			case "admindata":
				$table="admin";      
				$where=array('admin_id'=>$data->admin_id);
				if(isset($data->old_username))
				{
					if($data->old_username != $data->username) 
					{
						if($this->getdata->isExist('admin',array('username'=>$data->username)))
						{
							echo json_encode(array("result"=>"failed","message"=>"该用户名已存在！"));
							return false;
						}
					}
				}
				
				
     
				$info=array('edittime'=>date("Y-m-d H:i:s"));
					
					if(isset($data->username)){
						$info['username']=$data->username;
					}
					
					if(isset($data->status)){
						$info['status']=$data->status;
					}
					
				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));

			break;


			case "password":
				$table="admin";
				$where=array('admin_id'=>$data->id);
				$info=$this->getdata->getContentAdvance('admin',array('username'=>$data->username));
				$password=$info->password;
				
				if($password != MD5($data->old_password))
				{
					echo json_encode(array("result"=>"failed","message"=>"旧密码错误"));
					return false;
				}
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				
				if(isset($data->password)){
					$info['password']=MD5($data->password);
				}
				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
				
			break;

			case "collect":
				$table="collectshop";
				$where=array('collect_id'=>$data->collect_id);
				$info=array('collect_addtime'=>date("Y-m-d H:i:s"));
				$info['collect_status']=$data->collect_status;
				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
			break;

			case "follow":
				$table="followshop";
				$where=array('follow_id'=>$data->follow_id);
				$info=array('follow_addtime'=>date("Y-m-d H:i:s"));
				$info['follow_status']=$data->follow_status;
				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
			break;

			case "annual":
				$table="annuityshop";
				$where=array('annuity_id'=>$data->id);
				$info=array('annuity_endtime'=>date("Y-m-d H:i:s"));
				$info['annuity_status']=$data->annuity_status;
				/*查出店铺余额*/
				$shopid=$data->shopid;
                $Parameters=array(
					'result'=>'data'	
				);
				$Parameters['account_shop_id']=$shopid;
				$account_money=$this->getdata->getAccountMoneyByShopId($Parameters);
				if(!empty($account_money))
				{
					$shopMoney=$account_money[0]->account_money;
					$account_id=$account_money[0]->account_id;
				}
				else
				{
					echo json_encode(array("result"=>"failed","message"=>"请申请店铺账户！"));
					return false;
				}
				/*获取申请的年费金额*/
				$annuity_price=$data->annuity_price;
				/*判断余额和年费金额大小*/
				if(bccomp($shopMoney , $annuity_price)== -1)
				{
					echo json_encode(array("result"=>"failed","message"=>"店铺账户余额不足，请充值！"));
					return false;
				}
				else
				{
					/*金额减去年费金额*/
					$money=bcsub($shopMoney,$annuity_price,2);
				}
                /*修改店铺余额*/
                $monrytable='shopaccount';
				$money=array('account_money'=>$money);
				//var_dump($money);
				$monrywhere=array('account_id'=>$account_id);
                $moneyresult=$this->dbHandler->updateData(array('table'=>$monrytable,'where'=>$monrywhere,'data'=>$money));
                if($moneyresult == 1)
                {
                	/*添加店铺的消费记录*/
                	$expensetable="shopexpense"; 
                    $time=date("Y-m-d H:i:s");
                    /*判断添加的分类特征是否存在*/ 

					$object=array();
					$object=array(
						"expense_shop_id"=>$shopid,
						"expense_type"=>'2',
						"expense_name"=>'年费',
						"expense_money"=>$annuity_price,
						"expense_modified"=>'-',
						"expense_time"=>$time
						);

					$expenseresult=$this->dbHandler->insertData($expensetable,$object);
					if($expenseresult == 1)
					{
						$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
					}
					else
					{
						echo json_encode(array("result"=>"failed","message"=>"信息修改失败"));
						return false;
					}

                }
                else
                {
                	echo json_encode(array("result"=>"failed","message"=>"信息修改失败"));
                	return false;
                }

                
				
			break;

			case "adtime":
				$table="adtime";
				$time=date("Y-m-d H:i:s");
				$where=array('ad_time_id'=>$data->ad_time_id);
				$info=array('ad_edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->ad_time))
				{
					$info['ad_time']=$data->ad_time;
				}

				if(isset($data->ad_time_admin_id))
				{
					$info['ad_time_admin_id']=$data->ad_time_admin_id;
				}
				if(isset($data->ad_time_status))
				{
					$info['ad_time_status']=$data->ad_time_status;
					$info['ad_time_admin_id']=$_SESSION['userid'];
				}
				else
				{
					$info['ad_time_status']='1';
				}

				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
			break;
  
            /*修改广告类型*/
			case "adcatetype":
				$table="adspottype";
				$time=date("Y-m-d H:i:s");
				$where=array('ad_spot_type_id'=>$data->ad_spot_type_id);
				$info=array('ad_spot_type_edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->ad_name))
				{
					$info['ad_spot_type_name']=$data->ad_name;
				}
				if(isset($data->ad_price))
				{
					$info['ad_spot_type_unit_price']=$data->ad_price;
				}
				if(isset($data->ad_name))
				{
					$info['ad_spot_type_name']=$data->ad_name;
				}
				if(isset($data->status))
				{
					$info['ad_spot_type_status']=$data->status;
					$info['ad_spot_type_admin_id']=$_SESSION['userid'];
				}
				else
				{
					$info['ad_spot_type_status']='1';
				}
				
				
				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
			break;
			
			case "buyer":
				$table="buyer";
				$where=array('id'=>$data->id);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->alias)){
					$info['alias']=$data->alias;
				}
				if(isset($data->gender)){
					$info['gender']=$data->gender;
				}
				if(isset($data->photo)){
					$info['photo']=strstr($data->photo,'http')?$data->photo:SERVER_IP.($data->photo);
				}
				if(isset($data->birthdate)){
					$info['birthdate']=$data->birthdate;
				}
				if(isset($data->phone)){
					$info['phone']=$data->phone;
				}
				if(isset($data->status)){
					$info['status']=$data->status;
				}
                
                $result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
			break;

			case "activity":
				$table="activity";
				$where=array('activity_id'=>$data->activity_id);
				$info=array('dittime'=>date("Y-m-d H:i:s"));
				if(isset($data->activity_name)){
					$info['activity_name']=$data->activity_name;
				}
				if(isset($data->activity_keyword)){
					$info['activity_keyword']=$data->activity_keyword;
				}
				if(isset($data->thumbnail1)){
					$info['thumbnail1']=strstr($data->thumbnail1,'http')?$data->thumbnail1:SERVER_IP.($data->thumbnail1);
				}
				if(isset($data->content)){
					$info['content']=$data->content;
				}
				if(isset($data->activity_begintime)){
					$info['activity_begintime']=$data->activity_begintime;
				}
				if(isset($data->activity_endtime)){
					$info['activity_endtime']=$data->activity_endtime;
				}
				if(isset($data->status)){ 
					$info['status']=$data->status;
				}
                $info['audit_status']='0';
                $result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
               
			break;

			case "reminder":
				$table="reminder";
				$where=array('msg_id'=>$data->msg_id);
				$info=array('msg_edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->msg_content)){ 
					$info['msg_content']=$data->msg_content;
				}
				if(isset($data->msg_status)){
					$info['msg_status']=$data->msg_status; 
				}
                $result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
               
			break;

			case "onecategory":
				$table="category";
				$where=array('id'=>$data->id);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->name)){
					$info['name']=$data->name;
				}

                if(isset($data->twoid)){ 
					$info['twoid']=$data->twoid;
				}
				else
				{
					$info['twoid']='1';
				}	
				
				if(isset($data->describe_shop)){
					$info['describe_shop']=$data->describe_shop;
				}
				if(isset($data->orders)){
					$info['orders']=$data->orders;
				}
				if(isset($data->status)){
					$info['status']=$data->status;
				}
                
                $result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
               
			break;
			
			case "product":
				
				
				$info=array('goodsId'=>$data->goodsId);
				if(isset($data->name)){
					$info['name']=$data->name;
				}
				if(isset($data->detailedname)){
					$info['detailedname']=$data->detailedname;
				}
				if(isset($data->barcode)){
					$info['barcode']=$data->barcode;
				}
				if(isset($data->keywords)){
					$info['keywords']=$data->keywords;
				}

				if(isset($data->originalPrice)){
					$info['originalPrice']=$data->originalPrice;
				}
				if(isset($data->price)){
					$info['price']=$data->price;
				}
				if(isset($data->description)){
					$info['description']=$data->description;
				}

				if(!empty($data->pic1)){

					$info['pic1']=strstr($data->pic1,'http')?$data->pic1:SERVER_IP.($data->pic1);
				}
				else
				{
					$info['pic1']='';
				}
				
				if(isset($data->category_shop_id)){
					$info['categoryShopId']=$data->category_shop_id;
				}
				if(isset($data->status)){
					$info['status']=$data->status;
				}

				$goods=new stdClass;
				$goods->goods=$info;
				$url=API_IP."AEWebApp/userShop/modifyGoods";
				$partam='goods='.json_encode($goods);
				$header = array();
				$marquee = httpPost($url,$partam,$header);
				$results = json_decode($marquee);
				$result=$results->data;

			break;
			case "goodskeyword":
				
				$table='goods';
				$where=array('goods_id'=>$data->goodsId);
				$info=array('edittime'=>date("Y-m-d H:i:s"));
				//var_dump($data->audit_status);
				if(isset($data->audit_status)){
					$info['audit_status']=$data->audit_status;
				}

				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));

			break;

			case "finance":
				
				$table='shopcashout';
				$where=array('id'=>$data->id);
				$info=array();
				//var_dump($data->audit_status);
				if(isset($data->status)){
					$info['cash_status']=$data->status;
				}
				if(isset($data->cash_status_desc)){
					$info['cash_status_desc']=$data->cash_status_desc;
				}

				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));

			break;

			case "pay":
			
				$table='shopcashout';
				$where=array('id'=>$data->id);
				$condition=array(
					'table'=>'shopcashout',
					'where'=>array('id'=>$data->id)
				);
				$result=$this->CI->dbHandler->selectData($condition);
				echo json_encode(array('result'=>$data->id));return false;
				/*
				$request_data = array();
				$request_data['service'] = 'batch_trans_notify';
				$request_data['partner'] = '2088421202338058';
				$request_data['_input_charset'] = 'utf-8';
				$request_data['sign_type'] = 'md5';
				$request_data['sign'] = '';
				$request_data['notify_url'] = $lang['java_url'] .
            '/travel/sharersCashOut/alipayNotify';
				$request_data['account_name'] = '太原市风度科技有限公司';
        
				for ($j = 0; $j < count($result); $j++) {
					$detail_data .= $result[$j][0]['no'] . '^' . $result[$j][0]['accountAccount'] .
						'^' . $result[$j][0]['accountOwnerName'] . '^' . $result[$j][0]['money'] .
						'^nihao|';
					$countFee += $result[$j][0]['money'];
				}
				$request_data['detail_data'] = substr($detail_data, 0, -1); 
        
				$request_data['batch_no'] = date('YmdHis');
				$request_data['batch_num'] = count($result);
				$request_data['batch_fee'] = $countFee;
				$request_data['email'] = 'fd@fengdukeji.com';
				$request_data['pay_date'] = date('Ymd');
				$request_data = encode_json($request_data); 
				redirect("batchAlipay/index.php?payresult=" . $result);
				*/
			break;
			case "shopkeyword":
				
				$table='usershop';
				$where=array('shop_id'=>$data->shop_id);
				$info=array('shop_edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->shop_audit_status)){
					$info['shop_audit_status']=$data->shop_audit_status;
				}

				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));

			break;
			case "activitykeyword":
				
				$table='activity';
				$where=array('activity_id'=>$data->activity_id);
				$info=array('dittime'=>date("Y-m-d H:i:s"));
				if(isset($data->audit_status)){
					$info['audit_status']=$data->audit_status;
				}
				
				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));

			break;

			case "catefeature":
				
				$table='categoryfeature';
				$where=array('feature_id'=>$data->feature_id);
				$info=array('feature_edittime'=>date("Y-m-d H:i:s"));
				if(isset($data->feature_name)){
					$info['feature_name']=$data->feature_name;
				}
				
				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));

			break;

			case "catefeatureval":
				
				$table='categoryeigenvalue';
				$where=array('eigen_id'=>$data->eigen_id);
				$info=array('eigen_eidttime'=>date("Y-m-d H:i:s"));
				if(isset($data->eigenvalue_name)){
					$info['eigen_name']=$data->eigenvalue_name;
				}

				if(isset($data->feature_id)){
					$info['eigen_feature_id']=$data->feature_id;
				}
				
				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));

			break;
			case "stick":
				
				$table='stickshop';
				$where=array('stick_id'=>$data->stick_id);
				$info=array('stick_edittime'=>date("Y-m-d H:i:s"));
				

				if(isset($data->stick_status)){
					$info['stick_status']=$data->stick_status;
				}
				
				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));

			break;

			case "category":
				$table="category";
				$info=array('categoryId'=>$data->categoryId);
				if(isset($data->name)){
					$info['name']=$data->name;
				}
				if(isset($data->describe_shop)){
					$info['describeShop']=$data->describe_shop;
				}
				if(isset($data->order)){
					$info['order']=$data->order;
				}
				if(isset($data->status)){
					$info['status']=$data->status;
				}
                
				$goodsCategory=new stdClass;
                $goodsCategory->goodsCategory=$info;
				$url=API_IP."AEWebApp/userShop/modifyGoodsCategory";
 				$partam='goodsCategory='.json_encode($goodsCategory);
 				$header = array();
				$marquee = httpPost($url,$partam,$header);
				$results = json_decode($marquee);
				//var_dump($results);
				$result=$results->data;

			break;

			case "todayprice":
				$info=array('todayId'=>$data->todayId);
				if(isset($data->today_goods_name)){
					$info['todayGoodsName']=$data->today_goods_name;
				}
				if(isset($data->today_min_price)){
					$info['todayMinPrice']=$data->today_min_price;
				}
				if(isset($data->today_max_price)){
					$info['todayMaxPrice']=$data->today_max_price;
				}
				if(isset($data->today_orders)){
					$info['todayOrders']=$data->today_orders;
				}
                
				$todayPrice =new stdClass;
                $todayPrice ->todayPrice =$info;
				$url=API_IP."AEWebApp/nearby/modifyTodayPrice";
 				$partam='todayPrice='.json_encode($todayPrice);
 				$header = array();
				$todayPriceJSON = httpPost($url,$partam,$header);
				//var_dump($todayPriceJSON);
				$results = json_decode($todayPriceJSON);
				$result=$results->data;

			break;

			case "wordsort":
				
				$info=array('wordSortId'=>$data->wordSortId);
				if(isset($data->word_sort_name)){
					$info['wordSortName']=$data->word_sort_name;
				}
				if(isset($data->word_sort_status)){
					$info['wordSortStatus']=$data->word_sort_status;
				}
                
				$wordSort=new stdClass;
                $wordSort->wordSort=$info;
				$url=API_IP."AEWebApp/userShop/modifyWordSort";
 				$partam='wordSort='.json_encode($wordSort);
 				$header = array();
				$marquee = httpPost($url,$partam,$header);
				$results = json_decode($marquee);
				$result=$results->data;

			break;

			case "worditem":
				
				$info=array('wordItemId'=>$data->word_item_id);
				if(isset($data->word_item_name)){
					$info['wordItemName']=$data->word_item_name;
				}
				
                
				$wordItem=new stdClass;
                $wordItem->wordItem=$info;
				$url=API_IP."AEWebApp/userShop/modifyWordItem";
 				$partam='wordItem='.json_encode($wordItem);
 				$header = array();
				$marquee = httpPost($url,$partam,$header);
				$results = json_decode($marquee);
				$result=$results->data;

			break;

            /*通过广告审核并把它放到排期表内*/
			case "adstop":

				$info=array('adSpotId'=>$data->adSpotId);
				
				$info['adSpotStatus']=$data->adSpotStatus;
				$info['adSpotAdminId']=$_SESSION['userid'];
				
                
				$adSpot=new stdClass;
                $adSpot->adSpot=$info;
				$url=API_IP."AEWebApp/advertis/modifyAdSpot";
 				$partam='adSpot='.json_encode($adSpot);
 				$header = array();
				$marquee = httpPost($url,$partam,$header);
				$results = json_decode($marquee);
				$result=$results->data;

			break;

			case "adstop":

				$info=array('adSpotId'=>$data->adSpotId);
				
				$info['adSpotStatus']=$data->adSpotStatus;
				$info['adSpotAdminId']=$_SESSION['userid'];
				
                
				$adSpot=new stdClass;
                $adSpot->adSpot=$info;
				$url=API_IP."AEWebApp/advertis/modifyAdSpot";
 				$partam='adSpot='.json_encode($adSpot);
 				$header = array();
				$marquee = httpPost($url,$partam,$header);
				$results = json_decode($marquee);
				$result=$results->data;

			break;

			case "businessdistrict":
				$table="businessdistrict";
				$info=array('businessId'=>$data->businessId);
				if(isset($data->business_province)){
					$info['businessProvince']=$data->business_province;
				}
				if(isset($data->business_city)){
					$info['businessCity']=$data->business_city;
				}
				if(isset($data->business_area)){
					$info['businessArea']=$data->business_area;
				}
				if(isset($data->business_address)){
					$info['businessAddress']=$data->business_address;
				}
				if(isset($data->business_name)){
					$info['businessName']=$data->business_name;
				}
				if(isset($data->thumbnail1)){
					$info['businessLogo']=strstr($data->thumbnail1,'http')?$data->thumbnail1:SERVER_IP.($data->thumbnail1);
				}

				if(isset($data->business_comments)){
					$info['businessComments']=$data->business_comments;
				}
				if(isset($data->business_mart)){
					$info['businessMart']=$data->business_mart;
				}

				if(isset($data->business_street)){
					$info['businessStreet']=$data->business_street;
				}
				if(isset($data->business_lng)){
					$info['businessLng']=$data->business_lng;
				}

				if(isset($data->business_lat)){
					$info['businessLat']=$data->business_lat;
				}
				if(isset($data->business_status)){
					$info['businessStatus']=$data->business_status;
				}

				$business=new stdClass;
                $business->business=$info;
				$url=API_IP."AEWebApp/common/modifyBusiness";
 				$partam='business='.json_encode($business);

 				$header = array();
				$marquee = httpPost($url,$partam,$header);
				$results = json_decode($marquee);
				//var_dump($results);
				$result=$results->data;

			break;

			case "usershop":
				$info=array('shopId'=>$_SESSION['shopid']);
				if(isset($data->shopName)){
					$info['shopName']=$data->shopName;
				}
				if(isset($data->shopBranchName)){
					$info['shopBranchName']=$data->shopBranchName;
				}
				if(isset($data->shopKeywords)){
					$info['shopKeywords']=$data->shopKeywords;
				}
				if(isset($data->shopBuinourPhone)){
					$info['shopBuinourPhone']=$data->shopBuinourPhone;
				}
				if(isset($data->shopQrcode)){
					$info['shopQrcode']=$data->shopQrcode;
				}
				if(isset($data->thumbnail)){
					$info['shopLogo']=strstr($data->thumbnail,'http')?$data->thumbnail:SERVER_IP.($data->thumbnail);
				}

				if(isset($data->thumbnail1)){
					$info['shopTopPic1']=strstr($data->thumbnail1,'http')?$data->thumbnail1:SERVER_IP.($data->thumbnail1);
				}

				if(isset($data->thumbnail2)){
					$info['shopTopPic2']=strstr($data->thumbnail2,'http')?$data->thumbnail2:SERVER_IP.($data->thumbnail2);
				}

				if(isset($data->thumbnail3)){
					$info['shopTopPic3']=strstr($data->thumbnail3,'http')?$data->thumbnail3:SERVER_IP.($data->thumbnail3);
				}

				if(isset($data->thumbnail4)){
					$info['shopTopPic4']=strstr($data->thumbnail4,'http')?$data->thumbnail4:SERVER_IP.($data->thumbnail4);
				}

				if(isset($data->thumbnail5)){
					$info['shopTopPic5']=strstr($data->thumbnail5,'http')?$data->thumbnail5:SERVER_IP.($data->thumbnail5);
				}

				if(isset($data->shopProvince)){
					$info['shopProvince']=$data->shopProvince;
				}
				if(isset($data->shopCity)){
					$info['shopCity']=$data->shopCity;
				}

				if(isset($data->shopArea)){
					$info['shopArea']=$data->shopArea;
				}
				if(isset($data->shopDetailAddress)){
					$info['shopDetailAddress']=$data->shopDetailAddress;
				}

				if(isset($data->shopWifiStatus)){
					$info['shopWifiStatus']=$data->shopWifiStatus;
				}

				if(isset($data->shopWifiUsername)){
					$info['shopWifiUsername']=$data->shopWifiUsername;
				}
				if(isset($data->shopWifiPassword)){
					$info['shopWifiPassword']=$data->shopWifiPassword;
				}
				if(isset($data->shopTel)){	
					$info['shopTel']=$data->shopTel;
				}
				if(!empty($data->amstart) && !empty($data->amstop)){
					$shopBusinessHours=$data->amstart.'-'.$data->amstop;
				}
				
				if(!empty($data->pmstart) && !empty($data->pmstop)){
					$shopBusinessHour=$data->pmstart.'-'.$data->pmstop;
				}
				if(!empty($shopBusinessHours) && !empty($shopBusinessHour)){
					$info['shopBusinessHours']=$shopBusinessHours.','.$shopBusinessHour;
				}
				elseif(!empty($shopBusinessHours))
				{
					$info['shopBusinessHours']=$shopBusinessHours;
				}
				elseif(!empty($shopBusinessHour))
				{
					$info['shopBusinessHour']=$shopBusinessHour;
				}
				
				if(isset($data->shopLng)){
					$info['shopLng']=$data->shopLng;
				}
				if(isset($data->shopLat)){
					$info['shopLat']=$data->shopLat;
				}

				$usershop=new stdClass;
                $usershop->shop=$info;
				$url=API_IP."AEWebApp/userShop/modifyShop";
 				$partam='shop='.json_encode($usershop);
 				$header = array();
				$marquee = httpPost($url,$partam,$header);
				$results = json_decode($marquee);
				$result=$results->data;
                
			break;

            case "shop":
				$info=array('shopId'=>$data->shopid);
				if(isset($data->shopApply)){
					$info['shopApply']=$data->shopApply;
				}
				
				$usershop=new stdClass;
                $usershop->shop=$info;
				$url=API_IP."AEWebApp/userShop/modifyShop";
 				$partam='shop='.json_encode($usershop);
 				$header = array();
				$marquee = httpPost($url,$partam,$header);
				$results = json_decode($marquee);
				$result=$results->data;
                
			break;

			case "sortord":
				$info=array();
				if(isset($data->price_status)){
					$info['priceStatus']=$data->price_status;
				}
				if(isset($data->price_percent)){
					$info['pricePercent']=$data->price_percent;
				}
				if(isset($data->bargain_status)){
					$info['bargainStatus']=$data->bargain_status;
				}
				if(isset($data->bargain_percent)){
					$info['bargainPercent']=$data->bargain_percent;
				}
				if(isset($data->care_num_status)){
					$info['careNumStatus']=$data->care_num_status;
				}
				if(isset($data->care_num_percent)){
					$info['careNumPercent']=$data->care_num_percent;
				}	
				$sortord=new stdClass;
                $sortord->sortord=$info;
				$url=API_IP."AEWebApp/advertis/modifySortord";
 				$partam='sortord='.json_encode($sortord);
 				$header = array();
				$marquee = httpPost($url,$partam,$header);
				$results = json_decode($marquee);
				$result=$results->data;
                
			break;
			
		}
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息修改成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息修改失败"));
	}

    public function updatestatu()
    {
        $table="";
		$data=json_decode($_POST['data']);
		$info=array();
		$where=array();
		switch($data->infoType)
		{
			case "activity":
				$table="activity";
				$where=array('id'=>$data->id);
				$info=array();
				if($data->status == 1)
				{
					$info['status']= 0;
				}
				else
				{
					$wheres = array('sid'=>$data->sid);
					$infos=array
					(
                       "status"=> '0' 
				    );
					$update=$this->dbHandler->updateData(array('table'=>$table,'where'=>$wheres,'data'=>$infos));
					$info['status']= 1;
				}
			break;
		
    	}
    	$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息修改成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息修改失败"));	
	}

	public function updateproducts()
    {
        $table="";
		$data=json_decode($_POST['data']);
		$info=array();
		$where=array();
		switch($data->infoType)
		{
			case "product":
				$table="goods";
				$where=array('id'=>$data->id);
				$info=array();
				$info['status']= 2;
				$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>$where,'data'=>$info));
			break;
		
    	}
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息修改成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息修改失败"));	
	}

	public function deleteInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		switch($data->infoType){
			case 'shopadmin':
				$condition['table']="admin";
				$condition['where']=array("admin_id"=>$data->id);
			break;
			case 'admin':
				$condition['table']="admin";
				$condition['where']=array("admin_id"=>$data->id); 
			break;
			case 'adtime':
				$condition['table']="adtime";
				$condition['where']=array("ad_time_id"=>$data->id);
			break;
			case 'adspottype':
				$condition['table']="adspottype";
				$condition['where']=array("ad_spot_type_id"=>$data->id);
			break;
			case 'business':
				$condition['table']="businessdistrict";
				$condition['where']=array("business_id"=>$data->business_id);
			break;
			case 'activity':
				$condition['table']="activity";
				$condition['where']=array("activity_id"=>$data->activity_id);
			break;
			case 'product':
				$condition['table']="goods";
				$condition['where']=array("goods_id"=>$data->goods_id);
			break;
			case 'shopcategory':
				$condition['table']="goodscategory";
				$condition['where']=array("category_id"=>$data->category_id);
			break;
			case 'category':
				$condition['table']="category";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'order':
				$condition['table']="order";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'address':
				$condition['table']="address";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'comment':
				$condition['table']="comment";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'coupon':
				$condition['table']="coupon";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'advice':
				$condition['table']="advice";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'aboutus':
				$condition['table']="aboutus";
				$condition['where']=array("id"=>$data->id);
			break;
            case 'activity':
				$condition['table']="activity";
				$condition['where']=array("id"=>$data->id);
			break;
			case 'worditem':
				$condition['table']="worditem";
				$condition['where']=array("word_item_id"=>$data->id);
			break;
			case 'todayprice':
				$condition['table']="todayprice";
				$condition['where']=array("today_id"=>$data->today_id);
			break;
			case 'reminder':
				$condition['table']="reminder";
				$condition['where']=array("msg_id"=>$data->id);
			break;
			case 'stick':
				$condition['table']="stickshop";
				$condition['where']=array("stick_id"=>$data->id);
			break;
			// case 'photo':
			// 	$condition['table']="goods";
			// 	$condition['where']=array("id"=>$data->id);
			// break;
			
			// case 'essay':
			// 	$condition['table']="essay";
			// 	$condition['where']=array("id"=>$data->id);
			// break;
		}
		$result=$this->dbHandler->deleteData($condition);
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息删除成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息删除失败"));
	}
	public function deleteBulkInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		switch($data->infoType){
			case 'banners':
				$table="banner";
				$where="id";
			break;
			case 'buyers':
				$table="buyer";
				$where="id";
			break;
			case 'sellers':
				$table="seller";
				$where="id";
			break;
			case 'supermarkets':
				$table="supermarket";
				$where="id";
			break;
			case 'products':
				$table="goods";
				$where="id";
			break;
			case 'categories':
				$table="category";
				$where="id";
			break;
			case 'orders':
				$table="order";
				$where="id";
			break;
			case 'addresses':
				$table="address";
				$where="id";
			break;
			case 'comments':
				$table="comment";
				$where="id";
			break;
			case 'coupons':
				$table="coupon";
				$where="id";
			break;
			case 'advices':
				$table="advice";
				$where="id";
			break;
			case 'aboutuss':
				$table="aboutus";
				$where="id";
			break;
			case 'activity':
				$table="activity";
				$where="id";
			break;
		}
		foreach ($data->idArray as $value){
			$result=$this->dbHandler->deleteData(array('table'=>$table,'where'=>array($where=>$value)));
		}
		echo json_encode(array("result"=>"success","message"=>"信息删除成功"));
	}

	public function updateBulkInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		switch($data->infoType)
		{
			case 'products':
					$table="goods";
					$where="id";
					$info=array();
					$info['status']= 2;		
			break;
		}
		foreach ($data->idArray as $value){
			$result=$this->dbHandler->updateData(array('table'=>$table,'where'=>array($where=>$value),'data'=>$info));
		}
		echo json_encode(array("result"=>"success","message"=>"信息删除成功"));
	}

    //添加一级分类
    public function addCategory()
    {
    	$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		switch($data->infoType)
		{
	    	case "category":
	    	        if($this->getdata->isExist('category',array('name'=>$data->name,'twoid'=>'1')))
	    	        {
						echo json_encode(array("result"=>"failed","message"=>"该一级分类已经存在，请更换！"));
						return false;
					}
					$table="category";
					$time=date("Y-m-d H:i:s");
					$info=array
					(	
						"name"=>$data->name,
						"status"=>$data->status,
						"twoid"=> '1' ,
						"describe_shop"=>$data->describe_shop,
						"addtime"=>$time,
						"edittime"=>$time
					);
			break;
		}
		$result=$this->dbHandler->insertData($table,$info);
		if($result==1)echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息写入失败"));
	}

	//添加二级分类
    public function addSubCategory()
    {
    	$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		switch($data->infoType)
		{
	    	case "subcategory":
	    	        if($this->getdata->isExist('category',array('name'=>$data->name)))
	    	        {
						echo json_encode(array("result"=>"failed","message"=>"该分类名已经存在，请更换！"));
						return false;
					}
					$table="category";
					$time=date("Y-m-d H:i:s");
					$info=array
					(	
						"describe_shop"=>$data->describe_shop,
						"name"=>$data->name,
						"status"=>$data->status,
						"twoid"=>$data->twoid,
						"addtime"=>$time,
						"edittime"=>$time
					);
			break;
		}
		$result=$this->dbHandler->insertData($table,$info);
		if($result==1)echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息写入失败"));
	}




	public function getInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		$result=array();
		switch($data->infoType){
			
			case 'logout':
				unset($_SESSION["useremail"]);
				unset($_SESSION["userid"]);
				unset($_SESSION["usertype"]);
				$result='成功退出！';
			break;
			case 'wordsort':
			    $wordid=$data->id;
				$url=API_IP.'AEWebApp/userShop/getWordItem?wordItemSortId='.$wordid;
		        $header=array();
		        $param=array();
		        $itemJSON=httpGet($url,$header,$param);
		        $result = json_decode($itemJSON)->data;
			break;
			case 'shopcategory':
			    $categoryid=$data->id;
				$url=API_IP.'AEWebApp/userShop/queryGoodsListByCategoryId?categoryShopId='.$categoryid;
		        $header=array();
		        $param=array();
		        $shopJSON=httpGet($url,$header,$param);
		        $result = json_decode($shopJSON)->data;
			break;
			case 'supermarket':
				$result=$this->getdata->getContent('supermarket',$data->id);
			break;
			case 'categories':
				$result=$this->getdata->getCategory(
					array(
						'result'=>'data',
						'sid'=>$data->id		
					)
				);
			break;

			case 'supcategories':
				$result=$this->getdata->getSupCategory(
					array(
						'result'=>'data',
						'sid'=>$data->id
					)
				);
			break;
		}
		echo json_encode(array("result"=>"success","message"=>$result));
	}
	public function uploadImage(){
		$result=upload("image");
		echo json_encode($result);

	}
	public function setLanguage(){
		$_SESSION['language']=$_POST['language'];
	}
	public function createVeriCode(){
		veri_code();
	}
	/*
	public function checkMobileCode(){
		if(isset($_POST['code']) && strcasecmp($_POST['code'],$_SESSION['mobilecode'])==0){
			echo json_encode(array("result"=>"success","message"=>"Right Security code!"));
		}else{
			echo json_encode(array("result"=>"failed","message"=>"Wrong Security code!"));
		}
	}
	public function checkEmail(){
		if(!$this->commongetdata->checkUniqueAdvance("user",array("user_email"=>$_POST['email']))){
			echo json_encode(array("result"=>"notunique","message"=>"The email already exists!"));
			return false;
		}else{
			echo json_encode(array("result"=>"failed","message"=>"验证码输入错误！"));
		}
	}
	public function checkUsername(){
		if(!$this->commongetdata->checkUniqueAdvance("user",array("user_username"=>$_POST['username']))){
			echo json_encode(array("result"=>"notunique","message"=>"The username already exists!"));
			return false;
		}else{
			echo json_encode(array("result"=>"success","message"=>"Success!"));
		}
	}
	public function checkEmailExist(){
		if(!$this->commongetdata->checkUniqueAdvance("user",array("user_email"=>$_POST['email']))){
			echo json_encode(array("result"=>"notunique","message"=>"The email already exists!"));
			return false;
		}else{
			echo json_encode(array("result"=>"failed","message"=>"验证码输入错误！"));
		}
	}
	public function exportExcel($title,$subject,$description,$header,$data){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("AiiMai");
		$objPHPExcel->getProperties()->setLastModifiedBy("AiiMai");
		$objPHPExcel->getProperties()->setTitle($title);
		$objPHPExcel->getProperties()->setSubject($subject);
		$objPHPExcel->getProperties()->setDescription($description);
		$objPHPExcel->setActiveSheetIndex(0);
		//设值
		$letterArray=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		foreach($header as $index=>$field){
			$objPHPExcel->getActiveSheet()->setCellValue($letterArray[$index].'1',$field);
		}
		foreach($data as $key=>$value){
			foreach($value as $k=>$v){
				$objPHPExcel->getActiveSheet()->setCellValue($letterArray[$k].($key+2),$v);
			}
		}
		// Save Excel 2007 file
		//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		$fileName='uploads/'.$title.date("Ymd").'.xls';
		$objWriter->save($fileName);
//		$this->load->view('redirect',array("url"=>"/uploads/".$title.date("Ymd").".xls"));
		return '/'.$fileName;
	}*/
}