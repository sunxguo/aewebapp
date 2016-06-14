<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class GetData{
	var $CI;
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model("dbHandler");
		$this->CI->load->helper("qrcode");
	}
	/**
	 * 获取网站配置信息
	 * return array or string
	 */
	public function getWebsiteConfig($info="ALLINFO"){
		$condition=array(
			'table'=>'websiteconfig',
			'result'=>'data'
		);
		if($info!="ALLINFO") $condition['where']=array('key_websiteconfig'=>$info);
		$result=$this->CI->dbHandler->selectData($condition);
		if($info!="ALLINFO") return $result[0]->value_websiteconfig;
		else {
			$newArray=array();
			foreach($result as $value){
				$newArray[$value->key_websiteconfig]=$value->value_websiteconfig;	
			}
			return $newArray;
		}
	}
	// public function getAbout(){
	// 	$condition=array(
	// 		'table'=>'about',
	// 		'where'=>array('id'=>84),
	// 		'result'=>'data'
	// 	);
	// 	return $result=$this->CI->dbHandler->selectData($condition);
	// }
	public function language($type='home'){
		$this->CI->load->helper('language');
		if(isset($_SESSION['language'])){
			if($_SESSION['language']=="english"){
				$this->CI->config->set_item('language', 'english');
				$this->CI->load->language($type,'english');
				return true;
			}elseif($_SESSION['language']=="tw_cn"){
				$this->CI->config->set_item('language', 'tw_cn');
				$this->CI->load->language($type,'tw_cn');
				return true;
			}else{
				$this->CI->config->set_item('language', 'zh_cn');
				$this->CI->load->language($type,'zh_cn');
				return true;
			}
		}
		//判断浏览器语言
		$default_lang_arr = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$strarr = explode(",",$default_lang_arr);
		$default_lang = $strarr[0];
//		echo '1'.$default_lang;
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4); //只取前4位，这样只判断最优先的语言。如果取前5位，可能出现en,zh的情况，影响判断。  
		if (preg_match("/en/i", $lang)){ 
			$this->CI->config->set_item('language', 'english');
			// 根据设置的语言类型加载语言包
			$this->CI->load->language($type,'english');
			$_SESSION['language']='english';
		}
		elseif (preg_match("/zh-c/i", $lang)){
			$this->CI->config->set_item('language', 'zh_cn');
			$this->CI->load->language($type,'zh_cn');
			$_SESSION['language']='zh_cn';
		}
		elseif (preg_match("/zh/i", $lang)){ 
			$this->CI->config->set_item('language', 'tw_cn');
			$this->CI->load->language($type,'tw_cn');
			$_SESSION['language']='tw_cn';
		}else{
			$this->CI->config->set_item('language', 'zh_cn');
			$this->CI->load->language($type,'zh_cn');
			$_SESSION['language']='zh_cn';
		}
/*		// 根据浏览器类型设置语言
		if($default_lang == 'en-us' || $default_lang == 'en'){
			$this->CI->config->set_item('language', 'english');
			// 根据设置的语言类型加载语言包
			$this->CI->load->language('cms','english');
		}elseif( $default_lang == 'en-us' || $default_lang=='zh-CN'){
			$this->CI->config->set_item('language', 'zh_cn');
			$this->CI->load->language('cms','zh_cn');
		}
		// 当前语言
		echo $this->CI->config->item('language');*/
	}
	/**
	 * 获取一条信息
	 * return object
	 */
	public function getOneData($condition){
		$data=$this->CI->dbHandler->selectData($condition);
		if(sizeof($data)>0)
			return $data[0];
		else{
			$returnData= new stdClass();
			return $returnData;
		}
	}

    //查出商品信息
    public function getGoods($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('goods_id'=>$contentId)
		);
		return $this->getOneData($condition);
	}
    
    //查出广告类型
	 public function getAdCategoryById($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('ad_spot_type_id'=>$contentId)
		);
		return $this->getOneData($condition);
	}

	//查出广告类型
	 public function getCateFeatures($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('feature_id'=>$contentId)
		);
		return $this->getOneData($condition);
	}

	 //查出商品活动信息
	 public function getActivityById($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('activity_id'=>$contentId)
		);
		return $this->getOneData($condition);
	}

    //查出商铺信息
	public function getContent($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('shop_id'=>$contentId)

		);
		return $this->getOneData($condition);
	}

    //根据id查出管理员信息
    public function getadminbyid($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('admin_id'=>$contentId)

		);
		return $this->getOneData($condition);
	}

	public function getUser($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('user_id'=>$contentId)

		);
		return $this->getOneData($condition);
	}
    
    //查出店铺类型
	public function getshopcategory($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('type_id'=>$contentId)

		);
		return $this->getOneData($condition);
	}

	public function getUseraddress($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('address_id'=>$contentId)

		);
		return $this->getOneData($condition);
	}
	public function getCopon($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('coupon_id'=>$contentId)

		);
		return $this->getOneData($condition);
	}
	public function getAdmintype($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('admintype_id'=>$contentId)

		);
		return $this->getOneData($condition);
	}
    //查出一级分类
	public function getCategory($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('id'=>$contentId)

		);
		return $this->getOneData($condition);
	}
    
    //根据shop_id查出商店信息
	public function getusershop($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('shop_id'=>$contentId)

		);
		return $this->getOneData($condition);
	}

    //根据分类id查出商品分类
	public function getgoodscategory($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('user_id'=>$contentId)

		);
		return $this->getOneData($condition);
	}

	//根据订单id查出订单详情
	public function getorderdetails($type,$contentId){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>array('item_order_id'=>$contentId)

		);
		return $this->getOneData($condition);
	}
	public function getContentAdvance($type,$where){
		$condition=array(
			'table'=>$type,
			'result'=>'data',
			'where'=>$where
		);
		return $this->getOneData($condition);
	}
	public function getData($condition){
		return $this->CI->dbHandler->selectData($condition);
	}
	public function getPageLink($baseUrl,$selectUrl,$currentPage,$amountPerPage,$amount){
		$pageAmount=ceil($amount/$amountPerPage);
		$page=array(
			'firstPage'=>($currentPage!=1)?$baseUrl.'&page=1':'no',
			'lastPage'=>($currentPage!=$pageAmount && $pageAmount!=0)?$baseUrl.'&page='.$pageAmount:'no',
			'prevPage'=>($currentPage>1)?$baseUrl.'&page='.($currentPage-1):'no',
			'nextPage'=>($currentPage<$pageAmount)?$baseUrl.'&page='.($currentPage+1):'no',
			'jumpPage'=>$baseUrl.'&page=',
			'selectPage'=>$selectUrl,
			'currentPage'=>$currentPage,
			'pageAmount'=>$pageAmount,
			'amount'=>$amount,
			'limit'=>array('offset'=>$amountPerPage*($currentPage-1),'limit'=>$amountPerPage)
		);
		return $page;
	}


/*
 * 后台超管页面--------------------------------------------------------------------------------------------------------
*/	
	
	//根据店铺id获取用户信息
	public function getBuyers($parameters){
		$condition=array(
			'table'=>'user',
			'result'=>$parameters['result']
		);
		if(isset($parameters['gender'])){
			$condition['where']['gender']=$parameters['gender']=="NULL"?NULL:$parameters['gender'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['alias']=$parameters['keywords'];
			$condition['or_like_bracket']['phone']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['user_addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['user_addtime <=']=$parameters['time']['end'];
			}
		}
		$buyers=$this->getData($condition);
		return $buyers;
	}


	//查出所有的商品信息
	public function getProductsAll($parameters){
		$condition=array(
			'table'=>'goods',
			'result'=>$parameters['result']
		);
		if(isset($parameters['gender'])){
			$condition['where']['gender']=$parameters['gender']=="NULL"?NULL:$parameters['gender'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['alias']=$parameters['keywords'];
			$condition['or_like_bracket']['phone']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
	
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				$value->shopname=$this->getusershop('usershop',$value->shop_id);
				$value->category=$this->getgoodscategory('category',$value->category_shop_id);
			}


		}
		return $buyers;
	}


	  /*查出优惠券信息*/
	public function getCoupons($parameters){
		$condition=array(
			'table'=>'coupon',
			'result'=>$parameters['result']
		);
		
		$coupons=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($coupons as $key => $value) {
				$value->usershop=$this->getContent('usershop',$value->coupon_shop_id);
				// $value->buyer=$this->getContent('buyer',$value->buyerid);
			}
		}
		return $coupons;
	}
    
    //获取所有口令集
    public function getWord($parameters){
		$condition=array(
			'table'=>'wordlist',
			'result'=>$parameters['result']
		);
		if(isset($parameters['sid'])){
			$condition['where']['sid']=$parameters['sid'];
		}
		if(isset($parameters['buyerid'])){
			$condition['where']['buyerid']=$parameters['buyerid'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		// if(isset($parameters['keywords'])){
		// 	$condition['or_like_bracket']['orderno']=$parameters['keywords'];
		// 	$condition['or_like_bracket']['content']=$parameters['keywords'];
		// }
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['word_addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['word_addtime <=']=$parameters['time']['end'];
			}
		}
		$coupons=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($coupons as $key => $value) {
				$value->usershop=$this->getContent('usershop',$value->word_shop_id);
				// $value->buyer=$this->getContent('buyer',$value->buyerid);
			}
		}
		return $coupons;
	}
	


/*
 * 各个模块的管理员管理-----------------------------------------------------------------------------------------------
*/	

    //获取管理员信息
	public function getAdmins($parameters){
		$condition=array(
			'table'=>'admin',
			'result'=>$parameters['result']
		);
		if(isset($parameters['gender'])){
			$condition['where']['gender']=$parameters['gender']=="NULL"?NULL:$parameters['gender'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['alias']=$parameters['keywords'];
			$condition['or_like_bracket']['phone']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['user_addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['user_addtime <=']=$parameters['time']['end'];
			}
		}
		$condition['where']['grade']='2';
		$condition['where']['type >='] ='2';
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				$value->typename=$this->getAdmintype('admintype',$value->type);
			}
		}
		return $buyers;
	}


	//查出所有的管理员分类
	public function getAllAdmintype($parameters)
	{
		$condition=array(
			'table'=>'admintype',
			'result'=>$parameters['result']
		);
		if(isset($parameters['sid'])){
			$condition['where']['sid']=$parameters['sid'];
		}
		if(isset($parameters['categoryid'])){
			$condition['where']['categoryid']=$parameters['categoryid'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['name']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['addtime <=']=$parameters['time']['end'];
			}
		}
        $condition['where']['grade']='2';
		$admintype=$this->getData($condition);
		//var_dump($admintype);
		return $admintype;
	}	

	public function getAdmintypes($withSub=false,$asArray=false){
		$parameters=array(
			'result'=>'data'
		);
		$admintype=$this->getAllAdmintype($parameters);
		return $admintype;
	}

	


	

    /*广告管理员权限-------------------------------------------------------------------------------------*/

	//查出所有的广告时间
	public function getAdtimeAll($parameters){
		$condition=array(
			'table'=>'adtime',
			'result'=>$parameters['result']
		);
		if(isset($parameters['gender'])){
			$condition['where']['gender']=$parameters['gender']=="NULL"?NULL:$parameters['gender'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['alias']=$parameters['keywords'];
			$condition['or_like_bracket']['phone']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}

		if(isset($parameters['ad_time_id'])){
			$condition['where']['ad_time_id']=$parameters['ad_time_id'];
		}
		
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['ad_addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['ad_addtime <=']=$parameters['time']['end'];
			}
		}
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				$value->admin=$this->getadminbyid('admin',$value->ad_time_admin_id);
			}
		}
		return $buyers;
	}

	



	//查出所有的广告类型
	public function getAdcategory($parameters){
		$condition=array(
			'table'=>'adspottype',
			'result'=>$parameters['result']
		);
		if(isset($parameters['gender'])){
			$condition['where']['gender']=$parameters['gender']=="NULL"?NULL:$parameters['gender'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['alias']=$parameters['keywords'];
			$condition['or_like_bracket']['phone']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['ad_spot_type_addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['ad_spot_type_addtime <=']=$parameters['time']['end'];
			}
		}
		if(isset($parameters['ad_spot_type_id'])){
			$condition['where']['ad_spot_type_id']=$parameters['ad_spot_type_id'];
		}
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				$value->admin=$this->getadminbyid('admin',$value->ad_spot_type_admin_id);
			}
		}
		return $buyers;
	}

    /*店铺管理员权限-------------------------------------------------------------------------------------------------*/

	//查出所有的审核店铺
	public function getAuditshop($parameters){
		$condition=array(
			'table'=>'usershop',
			'result'=>$parameters['result']
		);
		if(isset($parameters['gender'])){
			$condition['where']['gender']=$parameters['gender']=="NULL"?NULL:$parameters['gender'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['alias']=$parameters['keywords'];
			$condition['or_like_bracket']['phone']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['shop_addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['shop_addtime <=']=$parameters['time']['end'];
			}
		}
		$condition['where']['shop_apply']='0';
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				$value->category=$this->getshopcategory('shoptype',$value->shop_type_id);
			}


		}
		return $buyers;
	}

	//查出所有未审核的店铺信息
	public function getUnAuditshop($parameters){
		$condition=array(
			'table'=>'usershop',
			'result'=>$parameters['result']
		);
		if(isset($parameters['gender'])){
			$condition['where']['gender']=$parameters['gender']=="NULL"?NULL:$parameters['gender'];
		}
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['keywords'])){
			$condition['or_like_bracket']['alias']=$parameters['keywords'];
			$condition['or_like_bracket']['phone']=$parameters['keywords'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		if(isset($parameters['time'])){
			if(isset($parameters['time']['begin'])){
				$condition['where']['shop_addtime >=']=$parameters['time']['begin'];
			}
			if(isset($parameters['time']['end'])){
				$condition['where']['shop_addtime <=']=$parameters['time']['end'];
			}
		}
		$condition['where']['shop_apply']='1';
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				// $value->shopname=$this->getusershop('usershop',$value->shop_id);
				$value->category=$this->getshopcategory('shoptype',$value->shop_type_id);
			}


		}
		return $buyers;
	}

	/*根据店铺查出店铺活动*/
	public function getactivityByshopid($parameters){
		$condition=array(
			'table'=>'activity',
			'result'=>$parameters['result']
		);
		$condition['where']['activity_shop_id']=$parameters['shopid'];
		$buyers=$this->getData($condition);
  
		return $buyers;
	}

	//查出所有的商铺审核员
	public function getShopaduits($parameters){
		$condition=array(
			'table'=>'admin',
			'result'=>$parameters['result']
		);
		$condition['where']['grade'] = '1';
		$condition['where']['type']  = '7';
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				$value->typename=$this->getAdmintype('admintype',$value->type);
			}
		}
		return $buyers;
	}


	   //查出所有的商铺管理员
	public function getRecommendAduits($parameters){
		$condition=array(
			'table'=>'admin',
			'result'=>$parameters['result']
		);
		
		$condition['where']['grade'] = '1';
		$condition['where']['type']  = '5';
		$buyers=$this->getData($condition);
        //if($parameters['result']=='data'){
		// 	foreach ($buyers as $key => $value) {
		// 		$value->typename=$this->getAdmintype('admintype',$value->type);
		// 	}
		// }
		return $buyers;
	}


	 //查出所有商圈
	public function getbusinesslist($parameters){
		$condition=array(
			'table'=>'businessdistrict',
			'result'=>$parameters['result']
		);
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		if(isset($parameters['limit'])){
			$condition['limit']=$parameters['limit'];
		}
		$business=$this->getData($condition);  
		return $business;
	}

	//查出所有的一级分类
	public function getCategories($parameters){
		$condition=array(
			'table'=>'category',
			'result'=>$parameters['result']
			
		);
		
		$condition['where']['twoid']= '1';

		$categories=$this->getData($condition);
		return $categories;
	}

	//查出分类根据id
	public function getCategoriesById($parameters){
		$condition=array(
			'table'=>'category',
			'result'=>$parameters['result']
			
		);
		$condition['where']['id']= $parameters['id'];

		$categories=$this->getData($condition);
		return $categories;
	}


	//查出所有的二级分类
	public function getsubCategories($parameters){
		$condition=array(
			'table'=>'category',
			'result'=>$parameters['result']
		);
		
		
		$condition['where']['twoid !=']= '1';
		$categories=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($categories as $key => $value) {
				$value->category=$this->getCategory('category',$value->twoid);
			}
		}
		return $categories;
	}

    //查出一级分类
	public function getAllCategory($withSub=false,$asArray=false){
		$parameters=array(
			'result'=>'data',
			'orderBy'=>array('addtime'=>'ASC')
		);
		$category=$this->getCategories($parameters);
		
		return $category;
	}

	//查出分类
	public function getCategoryAlls($withSub=false,$asArray=false){
		$parameters=array(
			'result'=>'data',
			'orderBy'=>array('addtime'=>'ASC')
		);
		$category=$this->getCategoriesAll($parameters);
		
		return $category;
	}

	//查出所有分类
	public function getCategoriesAll($parameters){
		$condition=array(
			'table'=>'category',
			'result'=>$parameters['result']
		);

		$categories=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($categories as $key => $value) {
				$value->category=$this->getCategory('category',$value->twoid);
			}
		}
		return $categories;
	}

	//查出所有的分类特征
	public function getCateFeature($parameters){
		$condition=array(
			'table'=>'categoryfeature',
			'result'=>$parameters['result']
			
		);
		
		if(isset($parameters['cateid'])){
			$condition['where']['feature_category_id']=$parameters['cateid'];
		}
		$catefeature=$this->getData($condition);

        /*遍历分类Id 查出是哪个分类下的特征*/
		if($parameters['result']=='data'){
			foreach ($catefeature as $key => $value) {
				$catename=$this->getCategory('category',$value->feature_category_id);
				if(isset($catename)){
						$value->category=$catename;
				}
				
			}
		}
		return $catefeature;
	}

	

	//查出所有的分类特征值
	public function getCateFeatureValue($parameters){
		$condition=array(
			'table'=>'categoryeigenvalue',
			'result'=>$parameters['result']
			
		);
		
		
		$catefeature=$this->getData($condition);
        //var_dump($catefeature);
        /*遍历分类Id 查出是哪个分类下的特征*/
		if($parameters['result']=='data'){
			foreach ($catefeature as $key => $value) {
				$value->category=$this->getCateFeatures('categoryfeature',$value->eigen_feature_id)->feature_name;
			}
		}
		return $catefeature;
	}

/*
 *商铺管理员结束---------------------------------------------------------------------------------------------------------------
*/

	/*搜索管理员权限----------------------------------------------------------------------------------------------*/

    //查出所有的搜索审核员
	public function getSearchadmin($parameters){
		$condition=array(
			'table'=>'admin',
			'result'=>$parameters['result']
		);
		
		
		$condition['where']['grade'] = '1';
		$condition['where']['type']  = '6';
		$buyers=$this->getData($condition);
		return $buyers;
	}


	//查出所有的商铺关键字
	public function getShopSearchAll($parameters){
		$condition=array(
			'table'=>'usershop',
			'result'=>$parameters['result']
		);
		
		if(isset($parameters['shop_audit_status'])){
			$condition['where']['shop_audit_status']=$parameters['shop_audit_status'];
		}
		$buyers=$this->getData($condition);
         if($parameters['result']=='data'){
			foreach ($buyers as $key => $value){
				$value->username=$this->getUser('user',$value->shop_user_id);
			}
		}
		return $buyers;
	}

	//查出所有的商品关键字
	public function getGoodSearchAll($parameters){

		$condition=array(
			'table'=>'goods',
			'result'=>$parameters['result']
		);
		if(isset($parameters['audit_status']))
		{
			$condition['where']['audit_status']= $parameters['audit_status'];
		}
		
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				$value->shopname=$this->getContent('usershop',$value->goods_shop_id);
			}
		}
		
		return $buyers;
	}

	//查出所有的商品关键字
	public function getActivityKeyAll($parameters){
		
		$condition=array(
			'table'=>'activity',
			'result'=>$parameters['result']
		);
		if(isset($parameters['audit_status']))
		{
			$condition['where']['audit_status']=$parameters['audit_status'];
		}
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value){
				$value->shopname=$this->getContent('usershop',$value->activity_shop_id);
			}
		}
		
		return $buyers;
	}


/*关注管理员权限------------------------------------------------------------------------------------------------------------*/

	//查出所有的关注审核员
	public function getAttentionAduits($parameters){
		$condition=array(
			'table'=>'admin',
			'result'=>$parameters['result']
		);
		
		$condition['where']['grade'] = '1';
		$condition['where']['type']  = '3';
		$buyers=$this->getData($condition);
		return $buyers;
	}

	//关注信息列表
	public function getattentionAll($parameters){
		$condition=array(
			'table'=>'followshop',
			'result'=>$parameters['result']
		);
		
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				$value->shopname=$this->getusershop('usershop',$value->follow_shop_id);
                $value->username=$this->getUser('user',$value->follow_user_id);
			}
		}
		return $buyers;
	}

	//收藏信息列表
	public function getCollectAll($parameters){
		$condition=array(
			'table'=>'collectshop',
			'result'=>$parameters['result']
		);
		
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				$value->shopname=$this->getusershop('usershop',$value->collect_shop_id);
                $value->username=$this->getUser('user',$value->collect_user_id);
			}
		}
		return $buyers;
	}

	//口令信息列表
	public function getWordAll($parameters){
		$condition=array(
			'table'=>'wordlist',
			'result'=>$parameters['result']
		);
		
		$buyers=$this->getData($condition);
        if($parameters['result']=='data'){
			foreach ($buyers as $key => $value) {
				$value->shopname=$this->getusershop('usershop',$value->word_shop_id);
			}
		}
		return $buyers;
	}
	

/*
 * 广告管理员权限------------------------------------------------------------------------------------------------------------------------
*/
	
	//查出所有的附近审核员
	public function getNearbyaudit($parameters){
		$condition=array(
			'table'=>'admin',
			'result'=>$parameters['result']
		);
		$condition['where']['grade'] = '1';
		$condition['where']['type']  = '4';
		$buyers=$this->getData($condition);
		return $buyers;
	}

	//查询广告位的审核
	public function getrecommend($parameters){
		$condition=array(
			'table'=>'adspot',
			'result'=>$parameters['result']
		);
		$condition['where']['ad_spot_status']=$parameters['status'];
		$products=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($products as $key => $value){
				$value->admin=$this->getadminbyid('admin',$value->ad_spot_admin_id);
				$value->shopname=$this->getContent('usershop',$value->ad_spot_shop_id);
				$value->goods=$this->getGoods('goods',$value->ad_spot_goods_id,'goods_id');
				$value->category=$this->getAdCategoryById('adspottype',$value->ad_spot_type_id,'ad_spot_type_id');	
				$value->activity=$this->getActivityById('activity',$value->ad_spot_activity_id,'activity_id');	
			}
		}
		return $products;
	}

/*
*---广告管理员结束-------------------------------------------------------------------------------------------------------- 
*/


/*
 * 商铺后台页面功能--------------------------------------------------------------------------------------------------------
*/

	
	//查出店铺信息根据店铺id
	public function getProductsById($parameters){
		$condition=array(
			'table'=>'usershop',
			'result'=>$parameters['result']
		);
        $condition['where']['shop_id']=$parameters['goodsid'];
		$buyers=$this->getData($condition);
		return $buyers;
	}

	//查出商品信息根据商品id
	public function getGoodsById($parameters){
		$condition=array(
			'table'=>'goods',
			'result'=>$parameters['result']
		);
        $condition['where']['goods_id']=$parameters['goodsid'];
        $buyers=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($buyers as $key => $value){
				$value->usershop=$this->getContent('usershop',$value->goods_shop_id);
			}
		}
		
		return $buyers;
	}

	//查出优惠活动数据
	public function getActivity($parameters){
		$condition=array(
			'table'=>'activity',
			'result'=>$parameters['result']
		);
		$activity=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($activity as $key => $value){
				$value->usershop=$this->getContent('usershop',$value->activity_shop_id);
			}
		}
		return $activity;
	}


	//查出关注店铺的所有用户  根据店铺id
    public function getcollectAllById($parameters)
    {
    	$condition=array(
			'table'=>'collectshop',
			'result'=>$parameters['result']
		);

		$condition['where']['collect_shop_id']= $parameters['collect_shop_id'];
		$collectUser=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($collectUser as $key => $value) {
				$value->username=$this->getUser('user',$value->collect_user_id);
			}
		}
		return $collectUser;
    }

     //查出店铺发布的所有优惠券  根据店铺id
    public function getdiscountList($parameters)
    {
    	$condition=array(
			'table'=>'coupon',
			'result'=>$parameters['result']
		);
		$condition['where']['coupon_shop_id']= $parameters['coupon_shop_id'];
		$collectUser=$this->getData($condition);
		return $collectUser;
    }

    //查出店铺发布的所有口令集  根据店铺id
    public function getWordListById($parameters)
    {
    	$condition=array(
			'table'=>'wordlist',
			'result'=>$parameters['result']
		);
		
		$condition['where']['word_shop_id']= $parameters['word_shop_id'];
		$collectUser=$this->getData($condition);
		return $collectUser;
    }
    
    
    //查出活动信息  根据活动id
    public function getActivityListById($parameters)
    {
    	$condition=array(
			'table'=>'activity',
			'result'=>$parameters['result']
		);
		$condition['where']['activity_id']= $parameters['activity_id'];
		$collectUser=$this->getData($condition);
		return $collectUser;
    }


    //查出分类特征
	public function getCatesFeature($withSub=false,$asArray=false){
		$parameters=array(
			'result'=>'data',
			'orderBy'=>array('feature_addtime'=>'ASC')
		);
		$category=$this->getCateFeature($parameters);
		
		return $category;
	}

	//查出分类特征根据  feature_category_id
	public function getCateFeatureById($parameters){
		$condition=array(
			'table'=>'categoryfeature',
			'result'=>$parameters['result']
			
		);

	    $condition['where']['feature_category_id']=$parameters['id'];

		$catefeature=$this->getData($condition);
		return $catefeature;
	}

	//根据商铺的id 查出店铺分类
	public function getShopCateById($parameters){
		$condition=array(
			'table'=>'usershop',
			'result'=>$parameters['result']	
		);

	    $condition['where']['shop_id']=$parameters['shopid'];

		$catefeature=$this->getData($condition);
		return $catefeature;
	}

	//根据商铺的分类id 查出分类特征
	public function getFeatureByShopId($parameters){
		$condition=array(
			'table'=>'categoryfeature',
			'result'=>$parameters['result']	
		);

	    $condition['where']['feature_category_id']=$parameters['cateid'];

		$catefeature=$this->getData($condition);
		return $catefeature;
	}

	 //查出关注店铺的所有用户  根据店铺id
    public function getfollowAllById($parameters)
    {
    	$condition=array(
			'table'=>'followshop',
			'result'=>$parameters['result']
		);
		
		$condition['where']['follow_shop_id']= $parameters['follow_shop_id'];
		$collectUser=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($collectUser as $key => $value) {
				$value->username=$this->getUser('user',$value->follow_user_id)->user_nickname;
			}
		}
		return $collectUser;
    }



    /*查询订单信息*/
	public function getOrders($parameters){
		$condition=array(
			'table'=>'userorder',
			'result'=>$parameters['result']
		);
		
		$orders=$this->getData($condition);
		/*根据状态数据  确定订单状态
		$status=$this->getOrderStatus();*/
		if($parameters['result']=='data')
		{
			foreach ($orders as $key => $value)
			{	
				$value->usershop=$this->getContent('usershop',$value->order_shops_id);
				$value->user=$this->getUser('user',$value->order_user_id);
				$value->address=$this->getUseraddress('useraddress',$value->order_user_address_id);
				$value->copon=$this->getCopon('coupon',$value->order_couponid);
				$value->orderdetails=$this->getorderdetails('orderitem',$value->order_id);
			}
		}
		return $orders;
	}





/*
 * ------------------------------------------------------------------------------------------------------------------------------
*/
	
	

	/*查出所有的收货地址*/
	public function getAddressesAll($parameters){
		$condition=array(
			'table'=>'useraddress',
			'result'=>$parameters['result']
		);
		$addresses=$this->getData($condition);
		if($parameters['result']=='data'){
			foreach ($addresses as $key => $value) {
				$value->user=$this->getUser('user',$value->address_user_id);
			}
		}
		return $addresses;
	}
	

  
/*
* 
*/	
    /*订单状态*/
	public function getOrderStatus()
	{
		$status=array
		(
			'0'=>'未完成扫描',
			'1'=>'待付款',
			'2'=>'未指派/未指派',
			'3'=>'待发货',
			'4'=>'运输中',
			'5'=>'交易完成(未评价)',
			'6'=>'交易完成(已评价)',
			'-1'=>'交易关闭',
			'7'=>'自提',
			'8'=>'已送达',
			'9'=>'已取消',
			'10'=>'拣货员已完成/待发货',
			'11'=>'待处理(抢单成功)',
			'12'=>'待抢单'

			
		);
		return $status;
	}
	public function getOrderDetail($orderno){
		$parameters=array(
						'table'=>'orderitem',
						'result'=>'data',
						'where'=>array('orderno'=>$orderno)
						);
		$details=$this->getData($parameters);
		foreach ($details as $key => $value) {
			$value->product=$this->getContent('goods',$value->goodsid);
		}
		return $details;
	}
	
	/*超市基本信息管理*/
	public function getSupermarkets($parameters){
		$condition=array(
			'table'=>'usershop',
			'result'=>$parameters['result']
		);
		if(isset($parameters['orderBy'])){
			$condition['order_by']=$parameters['orderBy'];
		}
		$supermarkets=$this->getData($condition);
		return $supermarkets;
	}


	public function checkCode($code){
		if(strcasecmp($code,$_SESSION['authcode'])==0){
			return true;
		}else{
			return false;
		}
	}
	public function isExist($table,$where){
		$condition=array(
			'table'=>$table,
			'where'=>$where,
			'result'=>'count'
		);
		$number=$this->getData($condition);
		if($number<1){
			return false;
		}else{
			return true;
		}
	}
	public function isModifyExist($table,$id,$where){
		$condition=array(
			'table'=>$table,
			'where'=>$where,
			'result'=>'data'
		);
		$data=$this->getOneData($condition);
		if(isset($data->id) && $data->id!=$id){
			return true;
		}else{
			return false;
		}
	}
	public function twoDimensionCode($text,$id){
		$value = $text; //二维码内容   
		$errorCorrectionLevel = 'H';//容错级别   
		$matrixPointSize = 10;//生成图片大小    
		$QR = $_SERVER['DOCUMENT_ROOT'].'/uploads/2dcode/'.$id.'qrcode.png';//已经生成的原始二维码图    
		
		//生成二维码图片
		QRcode::png($value,$QR, $errorCorrectionLevel, $matrixPointSize, 2);
		return  $QR;
	}
	public function twoDimensionCodeWithLogo($text,$appid,$logoSrc)
	{
		$value = $text; //二维码内容   
		$errorCorrectionLevel = 'H';//容错级别   
		$matrixPointSize = 10;//生成图片大小    
		//$QR = $_SERVER['DOCUMENT_ROOT'].'/uploads/2dcode/'.$appid.'qrcode.png';//已经生成的原始二维码图    
		$QR = $_SERVER['DOCUMENT_ROOT'].'/uploads/2dcode/'.$appid.'qrcode.png';
		//生成二维码图片
		QRcode::png($value,$QR, $errorCorrectionLevel, $matrixPointSize, 2);
		$logo = $_SERVER['DOCUMENT_ROOT'].$logoSrc;//准备好的logo图片 
		if ($logo !== FALSE)
		{
			$QR = imagecreatefromstring(file_get_contents($QR));   
			$logo = imagecreatefromstring(file_get_contents($logo));   
			$QR_width = imagesx($QR);//二维码图片宽度   
			$QR_height = imagesy($QR);//二维码图片高度   
			$logo_width = imagesx($logo);//logo图片宽度   
			$logo_height = imagesy($logo);//logo图片高度   
			$logo_qr_width = $QR_width / 4;
			$scale = $logo_width/$logo_qr_width;
			$logo_qr_height = $logo_height/$scale;
			$from_width = ($QR_width - $logo_qr_width) / 2;
			//重新组合图片并调整大小   
			imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,   
			$logo_qr_height, $logo_width, $logo_height);   
		}   
		//输出图片地址
		$dstLocation='/uploads/2dcode/'.$appid.'withlogo.png';
		//输出图片   
		imagepng($QR,$_SERVER['DOCUMENT_ROOT'].$dstLocation);   
		return  $dstLocation; 
	}


	
	
	//查出管理员信息根据id
	public function getAdminDataById($parameters){
		$condition=array(
			'table'=>'admin',
			'result'=>$parameters['result']	
		);

	    $condition['where']['admin_id']=$parameters['id'];
		$admindata=$this->getData($condition);
		return $admindata;
	}


}

?>
