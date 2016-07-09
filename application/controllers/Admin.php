<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper("base");
        $this->load->library('GetData');
        $this->load->model("Dbhandler");
    }
    public function checkAdminLogin()
    {
        if (!checkLogin()) {
            $this->load->view('admin/login', array('title' => "管理员登录"));
            return false;
        } else
            return true;
    }
    public function login()
    {
        $this->load->view('admin/login', array('title' => "管理员登录"));
    }
    public function adminCommonHandler($parameters)
    {
        if (!$this->checkAdminLogin())
            return false;
        $this->load->view('admin/_header');
        $this->load->view('admin/' . $parameters['view'], $parameters['data']);
        $this->load->view('admin/_footer');
    }
    public function index()
    {
        $parameters = array();
        if (isset($_SESSION['usertype']) && isset($_SESSION['grade'])) {
            $usertype = $_SESSION['usertype'];
            $grade = $_SESSION['grade'];
            //var_dump($usertype);
            if ($usertype == '1' && $grade == '1') {
                //等级为0  超级管理员
                $parameters = array('view' => 'index', 'data' => array('usertype' => 'admin0'));
            } elseif ($usertype == '1' && $grade == '2') {
                //等级为1 总管 负责个个模块的管理员增删改查
                $parameters = array('view' => 'index', 'data' => array('usertype' => 'admin1'));
            }
            //商铺审核管理
            if ($usertype == '7' && $grade == '2') {
                //等级为2 是该模块的审核  //店铺审核 管理
                $parameters = array('view' => 'examinant-list', 'data' => array('usertype' =>
                            'shop2'));
            } elseif ($usertype == '7' && $grade == '1') {
                //等级为1 是该模块的管理
                $parameters = array('view' => 'examinant-list', 'data' => array('usertype' =>
                            'shop1'));
            } elseif ($usertype == '7' && $grade == '3') {
                //等级为1 是该模块的管理
                $parameters = array('view' => 'examinant-list', 'data' => array('usertype' =>
                            'shop3'));
            }
            //关注审核管理
            if ($usertype == '3' && $grade == '1') {
                //关注审核管理
                //var_dump(789456);
                $parameters = array('view' => 'attention-list', 'data' => array('usertype' =>
                            'attention1'));
            } elseif ($usertype == '3' && $grade == '2') {
                $parameters = array('view' => 'attention-list', 'data' => array('usertype' =>
                            'attention2'));
            }
            //附近审核管理
            if ($usertype == '4' && $grade == '1') {
                //附近审核管理
                $parameters = array('view' => 'nearby-list', 'data' => array('usertype' =>
                            'attention1'));
            } elseif ($usertype == '4' && $grade == '2') {
                $parameters = array('view' => 'nearby-list', 'data' => array('usertype' =>
                            'attention2'));
            }
            //推荐审核管理
            if ($usertype == '5' && $grade == '1') {
                //推荐审核管理
                $parameters = array('view' => 'recommend-list', 'data' => array('usertype' =>
                            'recommend1'));
            } elseif ($usertype == '5' && $grade == '2') {
                $parameters = array('view' => 'recommend-list', 'data' => array('usertype' =>
                            'recommend2'));
            }
            //搜索审核管理
            if ($usertype == '6' && $grade == '1') {
                //搜索审核管理
                $parameters = array('view' => 'search-list', 'data' => array('usertype' =>
                            'search1'));
            } elseif ($usertype == '6' && $grade == '2') {
                $parameters = array('view' => 'search-list', 'data' => array('usertype' =>
                            'search2'));
            }
            //财务审核管理
            if ($usertype == '8' && $grade == '1') {
                //搜索审核管理
                $parameters = array('view' => 'finance-list', 'data' => array('usertype' =>
                            'finance1'));
            } elseif ($usertype == '8' && $grade == '2') {
                $parameters = array('view' => 'finance-list', 'data' => array('usertype' =>
                            'finance2'));
            }
        } else {
            $parameters = array('view' => 'shop-admin', 'data' => array());
        }
        $this->adminCommonHandler($parameters);
    }
    //管理员管理列表的数据页面 根据参数不同显示不同数据
    public function admin_all()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'AESC'));
        $amount = $this->getdata->getAdmins($bannerParameters);
        $baseUrl = '/admin/admin_all?placeholder=true';
        $selectUrl = '/admin/admin_all?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getAdmins($bannerParameters);
        $parameters = array('view' => 'admin_list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*
    *  推荐管理员权限---------------------------------------------------------------------------------------
    */
    //查出所有的推荐审核员
    public function recommendaudit()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'AESC'));
        $amount = $this->getdata->getRecommendAduits($bannerParameters);
        $baseUrl = '/admin/recommendaudit?placeholder=true';
        $selectUrl = '/admin/recommendaudit?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getRecommendAduits($bannerParameters);
        $parameters = array('view' => 'recommend_admin', 'data' => array('admins' => $admins));
        $this->adminCommonHandler($parameters);
    }
    //查出广告时间
    public function getAdtime()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('ad_addtime' =>
                    'AESC'));
        $amount = $this->getdata->getAdtimeAll($bannerParameters);
        $baseUrl = '/admin/getAdtime?placeholder=true';
        $selectUrl = '/admin/getAdtime?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getAdtimeAll($bannerParameters);
        $parameters = array('view' => 'adtime-list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出广告类型
    public function getAdcategory()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('ad_spot_type_addtime' =>
                    'AESC'));
        $amount = $this->getdata->getAdcategory($bannerParameters);
        $baseUrl = '/admin/getAdcategory?placeholder=true';
        $selectUrl = '/admin/getAdcategory?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        // $bannerParameters['limit']=$pageInfo['limit'];
        $admins = $this->getdata->getAdcategory($bannerParameters);
        $parameters = array('view' => 'adcategory-list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //广告位置
    public function getSortord()
    {
        $url = API_IP . 'AEWebApp/advertis/querySortord';
        $header = array();
        $param = array();
        $sortordJSON = httpGet($url, $header, $param);
        $sortord = json_decode($sortordJSON)->data;
        $parameters = array('view' => 'sortord-list', 'data' => array('sortord' => $sortord));
        $this->adminCommonHandler($parameters);
    }
    /******************************************************推荐管理员权限结束***********************************************************************/
    /*
    *-------------------------------------------------------搜索管理员权限------------------------------------------------------------
    */
    //查出所有搜索审核员
    public function searchadmin()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'AESC'));
        $amount = $this->getdata->getSearchadmin($bannerParameters);
        $baseUrl = '/admin/searchadmin?placeholder=true';
        $selectUrl = '/admin/searchadmin?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        //$bannerParameters['limit']=$pageInfo['limit'];
        $admins = $this->getdata->getSearchadmin($bannerParameters);
        $parameters = array('view' => 'searchadmin-list', 'data' => array('admins' => $admins));
        $this->adminCommonHandler($parameters);
    }
    //管理员管理列表的数据页面 根据参数不同显示不同数据
    public function attentionAdminAll()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'AESC'));
        $amount = $this->getdata->getAttentionAduits($bannerParameters);
        $baseUrl = '/admin/attentionAdminAll?placeholder=true';
        $selectUrl = '/admin/attentionAdminAll?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getAttentionAduits($bannerParameters);
        $parameters = array('view' => 'attention_admin', 'data' => array('admins' => $admins));
        $this->adminCommonHandler($parameters);
    }
    /*
    *   添加各个模块的审核员
    *   添加店铺审核员
    */
    public function shopAdminAdd()
    {
        $parameters = array('view' => 'shopAdmin-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    /*年费审核员*/
    public function annuityAdminAdd()
    {
        $parameters = array('view' => 'annuityAdmin-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    //添加关注审核员
    public function attentionAdminAdd()
    {
        $parameters = array('view' => 'attentionAdmin-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    //添加附近管理员
    public function nearbyadd()
    {
        $parameters = array('view' => 'nearby-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    //添加搜索管理员
    public function searchadd()
    {
        $parameters = array('view' => 'search-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    //添加推荐管理员
    public function adAdminadd()
    {
        $parameters = array('view' => 'recommend-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    /*修改管理员*/
    public function subadminedit()
    {
        if (!empty($_GET['id'])) {
            $adminid = $_GET['id'];
            //将id存在session  返回页面时会用到
            unset($_SESSION['admin_id']);
            $_SESSION['admin_id'] = $adminid;
        } else {
            $adminid = $_SESSION['admin_id'];
        }
        /*根据id查出管理员信息*/
        $parameters = array('id' => $adminid, 'result' => 'data');
        $admindata = $this->getdata->getAdminDataById($parameters);
        $parameters = array('view' => 'subadmin-edit', 'data' => array('admindata' => $admindata));
        $this->adminCommonHandler($parameters);
    }
    /*
    *  查出关注审核员的显示页面-------------------------------------------------------------------------------------------------------------
    *  
    */
    //查出关注列表
    public function getattentionAll()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('follow_addtime' =>
                    'AESC'));
        $amount = $this->getdata->getattentionAll($bannerParameters);
        $baseUrl = '/admin/getattentionAll?placeholder=true';
        $selectUrl = '/admin/getattentionAll?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getattentionAll($bannerParameters);
        $parameters = array('view' => 'follow_list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出置顶列表
    public function getAllStickI()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('follow_addtime' =>
                    'AESC'));
        $amount = $this->getdata->getAllStickI($bannerParameters);
        $baseUrl = '/admin/getAllStickI?placeholder=true';
        $selectUrl = '/admin/getAllStickI?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getAllStickI($bannerParameters);
        $parameters = array('view' => 'StickI_list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出收藏列表
    public function getCollectAll()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('collect_edittime' =>
                    'AESC'));
        $amount = $this->getdata->getCollectAll($bannerParameters);
        $baseUrl = '/admin/getCollectAll?placeholder=true';
        $selectUrl = '/admin/getCollectAll?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        // $bannerParameters['limit']=$pageInfo['limit'];
        $admins = $this->getdata->getCollectAll($bannerParameters);
        $parameters = array('view' => 'collect_list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出商铺关键词列表
    public function shopSearchlist()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('shop_addtime' =>
                    'AESC'));
        $bannerParameters['shop_audit_status'] = $_GET['audit'];
        $amount = $this->getdata->getShopSearchAll($bannerParameters);
        $baseUrl = '/admin/shopSearchlist?placeholder=true';
        $selectUrl = '/admin/shopSearchlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getShopSearchAll($bannerParameters);
        $parameters = array('view' => 'shopsearch_list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出商品关键词列表   要把审核过的和没审核的分开页面
    public function goodSearchlist()
    {
        $audit_status = $_GET['audit'];
        $bannerParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'AESC'));
        $bannerParameters['audit_status'] = $audit_status;
        $amount = $this->getdata->getGoodSearchAll($bannerParameters);
        $baseUrl = '/admin/goodSearchlist?placeholder=true';
        $selectUrl = '/admin/goodSearchlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getGoodSearchAll($bannerParameters);
        $parameters = array('view' => 'goodsearch-list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出活动关键词列表
    public function getActivityKeylist()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'AESC'));
        $bannerParameters['audit_status'] = $_GET['audit'];
        $amount = $this->getdata->getActivityKeyAll($bannerParameters);
        $baseUrl = '/admin/getActivityKeylist?placeholder=true';
        $selectUrl = '/admin/getActivityKeylist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getActivityKeyAll($bannerParameters);
        $parameters = array('view' => 'activitykey-list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出口令列表
    public function getWordlist()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('word_addtime' =>
                    'AESC'));
        $amount = $this->getdata->getWordAll($bannerParameters);
        $baseUrl = '/admin/getWordlist?placeholder=true';
        $selectUrl = '/admin/getWordlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        // $bannerParameters['limit']=$pageInfo['limit'];
        $admins = $this->getdata->getWordAll($bannerParameters);
        //var_dump($admins->worditem);
        $parameters = array('view' => 'passwordset-list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //优惠券信息
    public function getCouponlist()
    {
        $couponParameters = array('result' => 'count', 'orderBy' => array('coupon_addtime' =>
                    'DESC'));
        $amount = $this->getdata->getCoupons($couponParameters);
        $baseUrl = '/admin/couponlist?placeholder=true';
        $selectUrl = '/admin/couponlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $couponParameters['result'] = 'data';
        $coupons = $this->getdata->getCoupons($couponParameters);
        $parameters = array('view' => 'getcoupon-list', 'data' => array('coupons' => $coupons,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //今日市价
    public function todayPricelist()
    {
        /*查出今日市价*/
        $url = API_IP . 'AEWebApp/nearby/queryTodayPriceListAll';
        $header = array();
        $param = array();
        $priceJSON = httpGet($url, $header, $param);
        $todayprice = json_decode($priceJSON)->data;
        /*分页*/
        $amount = count($todayprice);
        $baseUrl = '/admin/couponlist?placeholder=true';
        $selectUrl = '/admin/couponlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $parameters = array('view' => 'todayprice-list', 'data' => array('todayprice' =>
                    $todayprice, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //今日市价
    public function todaypriceadd()
    {
        $parameters = array('view' => 'todayprice-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    //今日市价
    public function todaypriceedit()
    {
        if (isset($_GET['todayId'])) {
            $todayId = $_GET['todayId'];
            unset($_SESSION['todayId']);
            $_SESSION['todayId'] = $todayId;
        } else {
            $todayId = $_SESSION['todayId'];
        }
        $url = API_IP . 'AEWebApp/nearby/queryTodayPriceListById?todayId=' . $todayId;
        $header = array();
        $param = array();
        $priceJSON = httpGet($url, $header, $param);
        $todayprice = json_decode($priceJSON)->data;
        //var_dump($todayprice);
        $parameters = array('view' => 'todayprice-edit', 'data' => array('todayprice' =>
                    $todayprice));
        $this->adminCommonHandler($parameters);
    }
    //查出所有的附近审核员
    public function nearbyaudit()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'AESC'));
        $amount = $this->getdata->getNearbyaudit($bannerParameters);
        $baseUrl = '/admin/nearbyaudit?placeholder=true';
        $selectUrl = '/admin/nearbyaudit?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        // $bannerParameters['limit']=$pageInfo['limit'];
        $admins = $this->getdata->getNearbyaudit($bannerParameters);
        $parameters = array('view' => 'nearby_admin', 'data' => array('admins' => $admins));
        $this->adminCommonHandler($parameters);
    }
    //查出所有口令分类
    public function wordsortlist()
    {
        $url = API_IP . 'AEWebApp/userShop/getWordSort';
        $header = array();
        $param = array();
        $sortJSON = httpGet($url, $header, $param);
        $wordsort = json_decode($sortJSON)->data;
        /*分页效果*/
        $amoun = count($wordsort);
        $baseUrl = '/admin/getShopGoodsAll?placeholder=true';
        $selectUrl = '/admin/getShopGoodsAll?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amoun);
        $parameters = array('view' => 'wordsort-list', 'data' => array('wordsort' => $wordsort,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //添加口令分类
    public function wordsortadd()
    {
        $parameters = array('view' => 'wordsort-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    //修改口令分类
    public function wordsortedit()
    {
        if (isset($_GET['wordId'])) {
            $wordId = $_GET['wordId'];
            unset($_SESSION['wordId']);
            $_SESSION['wordId'] = $wordId;
        } else {
            $wordId = $_SESSION['wordId'];
        }
        $url = API_IP . 'AEWebApp/userShop/getWordSortById?wordSortId=' . $wordId;
        $header = array();
        $param = array();
        $sortJSON = httpGet($url, $header, $param);
        $wordsort = json_decode($sortJSON)->data;
        //var_dump($wordsort);
        $parameters = array('view' => 'wordsort-edit', 'data' => array('wordsort' => $wordsort));
        $this->adminCommonHandler($parameters);
    }
    //修改口令分类详情
    public function worditemedit()
    {
        if (isset($_GET['itemId'])) {
            $itemId = $_GET['itemId'];
            unset($_SESSION['itemId']);
            $_SESSION['itemId'] = $itemId;
        } else {
            $itemId = $_SESSION['itemId'];
        }
        $url = API_IP . 'AEWebApp/userShop/getWordItemById?wordItemId=' . $itemId;
        $header = array();
        $param = array();
        $sortJSON = httpGet($url, $header, $param);
        $worditem = json_decode($sortJSON)->data;
        //var_dump($wordsort);
        $parameters = array('view' => 'worditem-edit', 'data' => array('worditem' => $worditem));
        $this->adminCommonHandler($parameters);
    }
    //添加口令分类
    public function worditemadd()
    {
        if (isset($_GET['wordId'])) {
            $wordId = $_GET['wordId'];
            unset($_SESSION['wordId']);
            $_SESSION['wordId'] = $wordId;
        } else {
            $wordId = $_SESSION['wordId'];
        }
        $parameters = array('view' => 'worditem-add', 'data' => array('wordId' => $wordId));
        $this->adminCommonHandler($parameters);
    }
    //查出所有口令分类详情
    public function worditemlist()
    {
        $wordid = $_GET['wordid'];
        $url = API_IP . 'AEWebApp/userShop/getWordItem?wordItemSortId=' . $wordid;
        $header = array();
        $param = array();
        $itemJSON = httpGet($url, $header, $param);
        $worditem = json_decode($itemJSON)->data;
        /*分页效果*/
        $amoun = count($worditem);
        $baseUrl = '/admin/getShopGoodsAll?placeholder=true';
        $selectUrl = '/admin/getShopGoodsAll?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amoun);
        $parameters = array('view' => 'worditem-list', 'data' => array('worditem' => $worditem,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    public function welcome()
    {
        $parameters = array('view' => 'welcome', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    public function articlelist()
    {
        $parameters = array('view' => 'article-list', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    //获取所有的广告位申请列表
    public function recommend()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('ad_spot_addtime' =>
                    'AESC'));
        $bannerParameters['status'] = $_GET['status'];
        $amount = $this->getdata->getrecommend($bannerParameters);
        $baseUrl = '/audit/recommend?placeholder=true';
        $selectUrl = '/audit/recommend?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getrecommend($bannerParameters);
        $parameters = array('view' => 'recommend', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /* 获取所有的用户信息   管理员页面
    *
    */
    public function buyerlistAll()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('user_addtime' =>
                    'DESC'));
        $amount = $this->getdata->getBuyers($bannerParameters);
        $baseUrl = '/admin/buyerlist?placeholder=true';
        $selectUrl = '/admin/buyerlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $buyers = $this->getdata->getBuyers($bannerParameters);
        $parameters = array('view' => 'buyer-list', 'data' => array('buyers' => $buyers,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    public function buyershow()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->load->view('redirect', array('info' => '地址错误！'));
            return false;
        }
        $buyer = $this->getdata->getContent('buyer', $_GET['id']);
        $defaultSuperMarket = $this->getdata->getContent('supermarket', $buyer->
            defaultsid);
        // $this->getdata->twoDimensionCode($text,$id);
        $parameters = array('view' => 'buyer-show', 'data' => array('buyer' => $buyer,
                    'defaultSuperMarket' => $defaultSuperMarket));
        $this->adminCommonHandler($parameters);
    }
    //超市管理
    public function supermarketlistAll()
    {
        $superMarketsParameters = array('result' => 'count', 'orderBy' => array('shop_addtime' =>
                    'DESC'));
        $amount = $this->getdata->getSupermarkets($superMarketsParameters);
        $baseUrl = '/admin/supermarketlist?placeholder=true';
        $selectUrl = '/admin/supermarketlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $superMarketsParameters['result'] = 'data';
        $superMarkets = $this->getdata->getSupermarkets($superMarketsParameters);
        $parameters = array('view' => 'supermarket-list', 'data' => array('superMarkets' =>
                    $superMarkets, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*查看超市轮播图片详情*/
    public function shopPic()
    {
        /*获取商品id*/
        $goodsid = $_GET['goodsid'];
        /*查出商品的轮播图片*/
        $parameters = array('goodsid' => $goodsid, 'result' => 'data');
        $goodspic = $this->getdata->getProductsById($parameters);
        $parameters = array('view' => 'goodspic-show', 'data' => array('goodspic' => $goodspic));
        $this->adminCommonHandler($parameters);
    }
    /*查看商品图片详情*/
    public function goodsPic()
    {
        /*获取商品id*/
        $goodsid = $_GET['goodsid'];
        /*查出商品的轮播图片*/
        $parameters = array('goodsid' => $goodsid, 'result' => 'data');
        $goodspic = $this->getdata->getGoodsById($parameters);
        $parameters = array('view' => 'product-show', 'data' => array('goodspic' => $goodspic));
        //var_dump($goodspic);
        $this->adminCommonHandler($parameters);
    }
    //超市基本信息管理
    public function usershoplistAll()
    {
        $superMarketsParameters = array('result' => 'count', 'orderBy' => array('shop_addtime' =>
                    'DESC'));
        $amount = $this->getdata->getSupermarkets($superMarketsParameters);
        /*搜索条件*/
        $baseUrl = '/admin/usershoplistAll?placeholder=true';
        $selectUrl = '/admin/usershoplistAll?placeholder=true';
        /*分页*/
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $superMarketsParameters['result'] = 'data';
        $superMarkets = $this->getdata->getSupermarkets($superMarketsParameters);
        $parameters = array('view' => 'usershop-list', 'data' => array('superMarkets' =>
                    $superMarkets, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出的商品信息
    public function productlistAll()
    {
        $url = API_IP . 'AEWebApp/userShop/queryGoodsListAll';
        $header = array();
        $param = array();
        $goodsJSON = httpGet($url, $param, $header);
        $products = json_decode($goodsJSON)->data;
        /*分页开始*/
        $amount = count($products);
        $baseUrl = '/admin/productlistAll?placeholder=true';
        $selectUrl = '/admin/productlistAll?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $parameters = array('view' => 'product-list', 'data' => array('products' => $products,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*
    *   查出所有的订单信息
    *
    */
    public function getOrderAll()
    {
        if (!empty($_GET['extUrl'])) {
            $orderstatus = $_GET['extUrl'];
        }
        $url = API_IP . 'AEWebApp/userShop/getOrderAll';
        $header = array();
        $param = array();
        $orderJSON = httpGet($url, $param, $header);
        $orderall = json_decode($orderJSON)->data;
        /*根据状态查出订单信息*/
        $orderlist = array();
        if (isset($orderstatus)) {
            foreach ($orderall as $order) {
                if ($order->orderStatus == $orderstatus) {
                    $orderlist = $orderall;
                }
            }
        } else {
            $orderlist = $orderall;
        }
        /*分页开始*/
        $amount = count($orderlist);
        $baseUrl = '/admin/getOrderAll?placeholder=true';
        $selectUrl = '/admin/getOrderAll?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $parameters = array('view' => 'order-list', 'data' => array('orderlist' => $orderlist,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //优惠券信息
    public function couponlist()
    {
        $couponParameters = array('result' => 'count', 'orderBy' => array('coupon_addtime' =>
                    'DESC'));
        $amount = $this->getdata->getCoupons($couponParameters);
        $baseUrl = '/admin/couponlist?placeholder=true';
        $selectUrl = '/admin/couponlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $couponParameters['result'] = 'data';
        $coupons = $this->getdata->getCoupons($couponParameters);
        $parameters = array('view' => 'coupon-list', 'data' => array('coupons' => $coupons,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*
    *  口令集列表
    */
    public function wordlist()
    {
        $couponParameters = array('result' => 'count', 'orderBy' => array('word_addtime' =>
                    'DESC'));
        $amount = $this->getdata->getWord($couponParameters);
        $baseUrl = '/admin/wordlist?placeholder=true';
        $selectUrl = '/admin/wordlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $couponParameters['result'] = 'data';
        $words = $this->getdata->getWord($couponParameters);
        $parameters = array('view' => 'word-list', 'data' => array('words' => $words,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    // 优惠活动管理
    public function activitylist()
    {
        $couponParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'DESC'));
        $amount = $this->getdata->getActivity($couponParameters);
        $baseUrl = '/admin/activitylist?placeholder=true';
        $selectUrl = '/admin/activitylist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        //展示20条数据
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $couponParameters['result'] = 'data';
        $activity = $this->getdata->getActivity($couponParameters);
        $parameters = array('view' => 'activity-list', 'data' => array('activity' => $activity,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //添加广告时间
    public function adtimeadd()
    {
        $parameters = array('view' => 'adtime-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    //修改广告时间
    public function adtimeedit()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            unset($_SESSION['adid']);
            $_SESSION['adid'] = $id;
        } else {
            $id = $_SESSION['adid'];
        }
        $parameter = array('ad_time_id' => $id, 'result' => 'data');
        $getAdtime = $this->getdata->getAdtimeAll($parameter);
        $parameters = array('view' => 'adtime-edit', 'data' => array('getAdtime' => $getAdtime));
        //var_dump($getAdtime);
        $this->adminCommonHandler($parameters);
    }
    //修改广告类型
    public function updatAdCate()
    {
        if (isset($_GET['admin_id'])) {
            $id = $_GET['admin_id'];
            unset($_SESSION['admin_id']);
            $_SESSION['admin_id'] = $id;
        } else {
            $id = $_SESSION['admin_id'];
        }
        $parameter = array('ad_spot_type_id' => $id, 'result' => 'data');
        $getAdtime = $this->getdata->getAdcategory($parameter);
        $parameters = array('view' => 'adcategory-edit', 'data' => array('getAdtime' =>
                    $getAdtime));
        //var_dump($getAdtime);
        $this->adminCommonHandler($parameters);
    }
    //添加广告类型
    public function adcategoryadd()
    {
        $parameters = array('view' => 'adcategory-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    //添加管理员
    public function adminadd()
    {
        //$parameter=array('result'=>'count');
        $admintype = $this->getdata->getAdmintypes(false, false);
        //var_dump($admintype);
        $parameters = array('view' => 'admin-add', 'data' => array('admintype' => $admintype));
        $this->adminCommonHandler($parameters);
    }
    //修改管理员
    public function updateadmin()
    {
        $admin_id = $_GET['admin_id'];
        $admin = $this->getdata->getadminbyid('admin', $admin_id);
        $admintype = $this->getdata->getAdmintypes(false, false);
        $parameters = array('view' => 'admin-edit', 'data' => array('admin' => $admin,
                    'admintype' => $admintype));
        $this->adminCommonHandler($parameters);
    }
    //修改密码
    public function changepassword()
    {
        $parameter = array('result' => 'count');
        if (isset($_GET['admin_id'])) {
            $adminid = $_GET['admin_id'];
            unset($_SESSION['admin_id']);
            $_SESSION['admin_id'] = $adminid;
        } else {
            $adminid = $_SESSION['admin_id'];
        }
        $admin = $this->getdata->getadminbyid('admin', $adminid);
        //$admintype=$this->getdata->getAdmintypes(false,false);
        $parameters = array('view' => 'admin-password', 'data' => array('admin' => $admin));
        $this->adminCommonHandler($parameters);
    }
    /*
    *   店铺信息页面开始------------------------------------------------------------------------------------------------------------------
    *
    *
    */
    //根据session的user_id查出该店铺的信息
    public function getShopDataByUserId()
    {
        $user_id = $_SESSION['userid'];
        $url = API_IP . 'AEWebApp/userShop/getUserIsShop?userId=' . $user_id;
        $header = array();
        $param = array();
        $shopdataJSON = httpGet($url, $header, $param);
        $shopdatas = json_decode($shopdataJSON);
        $shopdata = '';
        if (!empty($shopdatas->data) && isset($shopdatas->data)) {
            $shopdata = $shopdatas->data;
        }
        $parameters = array('view' => 'usershopadmin-list', 'data' => array('shopdata' =>
                    $shopdata));
        $this->adminCommonHandler($parameters);
    }
    //根据session的user_id查出该店铺的基本信息
    public function getShopBasicDataByUserId()
    {
        $shopid = $_SESSION['userid'];
        $url = API_IP . 'AEWebApp/userShop/getUserIsShop?userId=' . $shopid;
        $header = array();
        $param = array();
        $shopdataJSON = httpGet($url, $header, $param);
        $shopdatas = json_decode($shopdataJSON);
        $shopdata = '';
        if (!empty($shopdatas->data) && isset($shopdatas->data)) {
            $shopdata = $shopdatas->data;
        }
        $shopdata = $shopdatas->data;
        $parameters = array('view' => 'userbasicshopadmin-list', 'data' => array('shopdata' =>
                    $shopdata));
        $this->adminCommonHandler($parameters);
    }
    //修改店铺的基本信息
    public function getShopDataEdit()
    {
        $shopid = $_SESSION['shopid'];
        $url = API_IP . 'AEWebApp/userShop/getShopByShopId?shopId=' . $shopid;
        $header = array();
        $param = array();
        $shopdataJSON = httpGet($url, $header, $param);
        $shopdatas = json_decode($shopdataJSON);
        $time = $shopdatas->data->shopBusinessHours;
        $hello = explode(',', $time);
        $am = array();
        $pm = array();
        if ($hello) {
            if (count($hello) > 1) {
                if ($hello[1]) {
                    $pmtime = $hello[1];
                    $pm = explode('-', $pmtime);
                }
            } else {
                if ($hello[0]) {
                    $amtime = $hello[0];
                    $am = explode('-', $amtime);
                }
            }
        }


        //var_dump($amstart);
        $shopdata = '';
        if (!empty($shopdatas->data) && isset($shopdatas->data)) {
            $shopdata = $shopdatas->data;
        }
        $parameters = array('view' => 'shopdata-edit', 'data' => array(
                'shopdata' => $shopdata,
                'am' => $am,
                'pm' => $pm));
        $this->adminCommonHandler($parameters);
    }
    //查出该店铺的所有商品
    public function getShopGoodsAll()
    {
        $shopid = $_SESSION['shopid'];
        $url = API_IP . 'AEWebApp/userShop/queryGoodsList?goodsShopId=' . $shopid;
        $header = array();
        $param = array();
        $goodsJSON = httpGet($url, $header, $param);
        $goodsdata = (object)array();
        if (json_decode($goodsJSON)) {
            $goodsdata = json_decode($goodsJSON)->data;
            $amoun = count($goodsdata);
        }
        $amoun = 0;
        /*分页效果*/
        $baseUrl = '/admin/getShopGoodsAll?placeholder=true';
        $selectUrl = '/admin/getShopGoodsAll?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amoun);
        $parameters = array('view' => 'shopgoods-list', 'data' => array('goodsdata' => $goodsdata,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //店铺添加商品
    public function shopgoodsadd()
    {
        $shopid = $_SESSION['shopid'];
        $url = API_IP . 'AEWebApp/userShop/queryShopCategoryListByShopId?categoryShopId=' .
            $shopid;
        $header = array();
        $param = array();
        $shopcateJSON = httpGet($url, $header, $param);
        $shopcate = json_decode($shopcateJSON)->data;
        //根据店铺的id查出他的店铺分类
        $shopid = $_SESSION['shopid'];
        $parameters = array('shopid' => $shopid, 'result' => 'data');
        $shopCate = $this->getdata->getShopCateById($parameters);
        $cateid = $shopCate[0]->shop_category_id;
        /*根据商铺分类id查出所属的分类特征*/
        $feaparameters = array('cateid' => $cateid, 'result' => 'data');
        $feature = $this->getdata->getFeatureByShopId($feaparameters);
        // var_dump($feature);
        $parameters = array('view' => 'shopgoods-add', 'data' => array('shopcate' => $shopcate,
                    'feature' => $feature));
        $this->adminCommonHandler($parameters);
    }
    //店铺修改商品
    public function shopgoodsedit()
    {
        //根据shopid查出他的分类
        $shopid = $_SESSION['shopid'];
        $url = API_IP . 'AEWebApp/userShop/queryShopCategoryListByShopId?categoryShopId=' .
            $shopid;
        $header = array();
        $param = array();
        $shopcateJSON = httpGet($url, $header, $param);
        $shopcate = json_decode($shopcateJSON)->data;
        //查出要修改的是商品
        $goodsid = $_GET['goodsId'];
        $goodsurl = API_IP . 'AEWebApp/userShop/queryGoodsListByGoodsid?goodsId=' . $goodsid;
        $header = array();
        $param = array();
        $goodsJSON = httpGet($goodsurl, $header, $param);
        $goods = json_decode($goodsJSON)->data;
        $parameters = array('view' => 'shopgoods-edit', 'data' => array('shopcate' => $shopcate,
                    'goods' => $goods));
        $this->adminCommonHandler($parameters);
    }
    //查出该店铺的分类特征
    public function goodsFeatureShow()
    {
        /*查出商户信息*/
        $user_id = $_SESSION['userid'];
        $url = API_IP . 'AEWebApp/userShop/getUserIsShop?userId=' . $user_id;
        $header = array();
        $param = array();
        $shopdataJSON = httpGet($url, $header, $param);
        $shopdatas = json_decode($shopdataJSON);
        $shopdata = $shopdatas->data;
        /*查出商品信息*/
        $goodsid = $_GET['id'];
        $title = $_GET['title'];
        $goodsurl = API_IP . 'AEWebApp/userShop/queryGoodsListByGoodsid?goodsId=' . $goodsid;
        $header = array();
        $param = array();
        $goodsJSON = httpGet($goodsurl, $header, $param);
        $goods = json_decode($goodsJSON)->data;
        //var_dump($goodsJSON);
        /*根据title 将数据存到不同得页面*/
        if ($title == '分类特征') {
            $parameters = array('view' => 'shopgoods-feature', 'data' => array('goods' => $goods,
                        'shopdata' => $shopdata));
        } elseif ($title == '商品图片') {
            $parameters = array('view' => 'shopgoods-pic', 'data' => array('goods' => $goods,
                        'shopdata' => $shopdata));
        }
        $this->adminCommonHandler($parameters);
    }
    //查出所有的三级分类（店铺自己添加的分类  商品分类）
    public function getcategorybyshopid()
    {
        /*调用接口查询商品分类*/
        $shopid = $_SESSION['shopid'];
        $url = API_IP . 'AEWebApp/userShop/queryShopCategoryListByShopId?shopId=' . $shopid;
        $header = array();
        $param = array();
        $shopcateJSON = httpGet($url, $header, $param);
        $shopCategory = json_decode($shopcateJSON)->data;
        /*分页效果*/
        $amount = count($shopCategory);
        $baseUrl = '/admin/getcategorybyshopid?placeholder=true';
        $selectUrl = '/admin/getcategorybyshopid?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        /*分页结束*/
        $parameters = array('view' => 'shopcateory-list', 'data' => array('shopCategory' =>
                    $shopCategory, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //添加分类
    public function shopcategoryadd()
    {
        $parameters = array('view' => 'shopcategory-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    /*修改分类*/
    public function shopcategoryedit()
    {
        $categoryId = $_GET['categoryId'];
        $url = API_IP . 'AEWebApp/userShop/queryGoodsCategoryById?categoryId=' . $categoryId;
        $header = array();
        $param = array();
        $shopcateJSON = httpGet($url, $header, $param);
        $shopCategory = json_decode($shopcateJSON)->data;
        //var_dump($shopCategory);
        $parameters = array('view' => 'shopcategory-edit', 'data' => array('shopCategory' =>
                    $shopCategory));
        $this->adminCommonHandler($parameters);
    }
    //查出收藏该店铺的用户
    public function collectAllById()
    {
        $shopid = $_SESSION['shopid'];
        $Parameters = array('result' => 'count', 'orderBy' => array('collect_addtime' =>
                    'DESC'));
        $Parameters['collect_shop_id'] = $shopid;
        /*分页效果*/
        $amount = $this->getdata->getcollectAllById($Parameters);
        $baseUrl = '/admin/collectAllById?placeholder=true';
        $selectUrl = '/admin/collectAllById?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        /*查出数据*/
        $Parameters['result'] = 'data';
        $useries = $this->getdata->getcollectAllById($Parameters);
        $parameters = array('view' => 'collectAllById-list', 'data' => array('useries' =>
                    $useries, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出关注该店铺的用户
    public function followAllById()
    {
        $shopid = $_SESSION['shopid'];
        $Parameters = array('result' => 'count', 'orderBy' => array('follow_addtime' =>
                    'DESC'));
        $Parameters['follow_shop_id'] = $shopid;
        /*分页效果*/
        $amount = $this->getdata->getfollowAllById($Parameters);
        $baseUrl = '/admin/followAllById?placeholder=true';
        $selectUrl = '/admin/followAllById?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        /*查出数据*/
        $Parameters['result'] = 'data';
        $useries = $this->getdata->getfollowAllById($Parameters);
        $parameters = array('view' => 'followAllById-list', 'data' => array('useries' =>
                    $useries, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出置顶列表根据店铺id
    public function getAllStickIById()
    {
        /*查出所有的置顶用户*/
        $shopid = $_SESSION['shopid'];
        $parameters = array(
            'result' => 'count',
            'stick_shop_id' => $shopid,
            'orderBy' => array('stick_addtime' => 'AESC'));
        $amount = $this->getdata->getAllStickIById($parameters);
        $baseUrl = '/admin/getAllStickIById?placeholder=true';
        $selectUrl = '/admin/getAllStickIById?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $parameters['result'] = 'data';
        $sticki = $this->getdata->getAllStickIById($parameters);
        $parameters = array('view' => 'sticki-list', 'data' => array('sticki' => $sticki,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*根据店铺id查出所有的活动*/
    public function getActivityListById()
    {
        $shopid = $_SESSION['shopid'];
        $url = API_IP . 'AEWebApp/userShop/queryActivityList?activityShopId=' . $shopid;
        $header = array();
        $param = array();
        $goodsJSON = httpGet($url, $header, $param);
        $getactivity = json_decode($goodsJSON)->data;
        /*分页效果*/
        $amoun = count($getactivity);
        $baseUrl = '/admin/getActivityListById?placeholder=true';
        $selectUrl = '/admin/getActivityListById?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amoun);
        $parameters = array('view' => 'getactivity-list', 'data' => array('getactivity' =>
                    $getactivity, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*添加优惠活动*/
    public function activityadd()
    {
        $parameters = array('view' => 'getactivity-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    /*编辑优惠活动*/
    public function activityedit()
    {
        $shopid = $_SESSION['shopid'];
        $activity_id = $_GET['activity_id'];
        /*根据活动id查询活动信息*/
        $activityParameters = array();
        $activityParameters = array('activity_id' => $activity_id, 'result' => 'data');
        $activity = $this->getdata->getActivityListById($activityParameters);
        //var_dump($activity);
        $parameters = array('view' => 'getactivity-edit', 'data' => array('activity' =>
                    $activity));
        $this->adminCommonHandler($parameters);
    }
    /*根据店铺id查出发布的优惠券*/
    public function getDiscountListById()
    {
        $shopid = $_SESSION['shopid'];
        $Parameters = array('result' => 'count', 'orderBy' => array('coupon_addtime' =>
                    'DESC'));
        $Parameters['coupon_shop_id'] = $shopid;
        /*分页效果*/
        $amount = $this->getdata->getdiscountList($Parameters);
        $baseUrl = '/admin/getDiscountListById?placeholder=true';
        $selectUrl = '/admin/getDiscountListById?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        /*查出数据*/
        $Parameters['result'] = 'data';
        $getdiscount = $this->getdata->getdiscountList($Parameters);
        $parameters = array('view' => 'getdiscount-list', 'data' => array('getdiscount' =>
                    $getdiscount, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*添加优惠券*/
    public function getdiscountadd()
    {
        $parameters = array('view' => 'getdiscount-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    /*根据店铺id查出发布的口令集*/
    public function getWordListById()
    {
        $shopid = $_SESSION['shopid'];
        $Parameters = array('result' => 'count', 'orderBy' => array('word_addtime' =>
                    'DESC'));
        $Parameters['word_shop_id'] = $shopid;
        /*分页效果*/
        $amount = $this->getdata->getWordListById($Parameters);
        $baseUrl = '/admin/getWordListById?placeholder=true';
        $selectUrl = '/admin/getWordListById?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        /*查出数据*/
        $Parameters['result'] = 'data';
        $getwordlist = $this->getdata->getWordListById($Parameters);
        $parameters = array('view' => 'getwordlist-list', 'data' => array('getwordlist' =>
                    $getwordlist, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*添加口令集*/
    public function getWordlistadd()
    {
        $count = $_GET['count'];
        /*查出所有的口令分类详情 */
        $url = API_IP . 'AEWebApp/userShop/getWordSort';
        $header = array();
        $param = array();
        $sortJSON = httpGet($url, $header, $param);
        $wordsort = json_decode($sortJSON)->data;
        /*查出所有的商铺分类*/
        $shopid = $_SESSION['shopid'];
        $url = API_IP . 'AEWebApp/userShop/queryShopCategoryListByShopId?shopId=' . $shopid;
        $header = array();
        $param = array();
        $shopcateJSON = httpGet($url, $header, $param);
        $shopCategory = json_decode($shopcateJSON)->data;
        /*根据商铺id查出商铺添加的口令内容*/
        $shopid = $_SESSION['shopid'];
        $url = API_IP . 'AEWebApp/userShop/getWordItemByShopId?shopId=' . $shopid;
        $header = array();
        $param = array();
        $shopitemJSON = httpGet($url, $header, $param);
        $shopItem = json_decode($shopitemJSON)->data;
        $parameters = array('view' => 'getwordlist-add', 'data' => array(
                'wordsort' => $wordsort,
                'count' => $count,
                'shopCategory' => $shopCategory,
                'shopItem' => $shopItem));
        $this->adminCommonHandler($parameters);
    }
    /*添加自定义口令内容*/
    public function getCustomCount()
    {
        /*查出所有的商铺分类*/
        $shopid = $_SESSION['shopid'];
        $url = API_IP . 'AEWebApp/userShop/getWordItemByShopId?shopId=' . $shopid;
        $header = array();
        $param = array();
        $wordItemJSON = httpGet($url, $header, $param);
        $wordItem = json_decode($wordItemJSON)->data;
        $parameters = array('view' => 'getcustom-list', 'data' => array('wordItem' => $wordItem));
        $this->adminCommonHandler($parameters);
    }
    /*添加自定义口令内容*/
    public function getcustomadd()
    {
        /*查出所有的商铺分类*/
        $parameters = array('view' => 'getcustom-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    /*根据店铺id查出订单信息*/
    public function getOrderByShopId()
    {
        $shopid = $_SESSION['shopid'];
        $url = API_IP . 'AEWebApp/user/getAllMyOrder?orderShopId=' . $shopid;
        $header = array();
        $param = array();
        $shoporder=(object)array();
        $shoporderJSON = httpGet($url, $header, $param);
        if (json_decode($shoporderJSON)) {
            $shoporder = json_decode($shoporderJSON)->data;
            $amount = count($shoporder);
        }

        /*分页效果*/
        $amount = 0;
        $baseUrl = '/admin/getOrderByShopId?placeholder=true';
        $selectUrl = '/admin/getOrderByShopId?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        //var_dump($shoporder);
        $parameters = array('view' => 'shoporder-list', 'data' => array('shoporder' => $shoporder,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*
    * 店铺管理员功能权限开始--------------------------------------------------------------------------------------------------------------------
    *
    *
    */
    //查出所有的一级分类
    public function categorylistAll()
    {
        $categoryParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'DESC'));
        $amount = $this->getdata->getCategories($categoryParameters);
        $baseUrl = '/admin/categorylist?placeholder=true';
        $selectUrl = '/admin/categorylist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $categoryParameters['result'] = 'data';
        $categories = $this->getdata->getCategories($categoryParameters);
        $parameters = array('view' => 'category-list', 'data' => array('categories' => $categories,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出所有的二级分类
    public function subcategorylist()
    {
        $categoryParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'DESC'));
        $amount = $this->getdata->getsubCategories($categoryParameters);
        $baseUrl = '/admin/categorylist?placeholder=true';
        $selectUrl = '/admin/categorylist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $categoryParameters['result'] = 'data';
        // $bannerParameters['limit']=$pageInfo['limit'];
        $categories = $this->getdata->getsubCategories($categoryParameters);
        $parameters = array('view' => 'subcategory-list', 'data' => array('categories' =>
                    $categories, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //添加一级分类
    public function categoryadd()
    {
        $parameters = array('view' => 'category-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    //修改一级分类
    public function categoryedit()
    {
        $cateid = $_GET['id'];
        $parameters = array('id' => $cateid, 'result' => 'data');
        $category = $this->getdata->getCategoriesById($parameters);
        $parameters = array('view' => 'category-edit', 'data' => array('category' => $category));
        $this->adminCommonHandler($parameters);
    }
    //修改二级分类
    public function subcategoryedit()
    {
        $cateid = $_GET['id'];
        $parameters = array('id' => $cateid, 'result' => 'data');
        $category = $this->getdata->getCategoriesById($parameters);
        $onecategory = $this->getdata->getAllCategory(false, false);
        $parameters = array('view' => 'subcategory-edit', 'data' => array('category' =>
                    $category, 'onecategory' => $onecategory));
        $this->adminCommonHandler($parameters);
    }
    //添加二级分类
    public function subcategoryadd()
    {
        $parameters = array('result' => 'count');
        $category = $this->getdata->getAllCategory(false, false);
        $parameters = array('view' => 'subcategory-add', 'data' => array('category' => $category));
        $this->adminCommonHandler($parameters);
    }
    /*查出所有商圈*/
    public function businessdistrict()
    {
        $categoryParameters = array('result' => 'count', 'orderBy' => array('business_addtime' =>
                    'DESC'));
        $amount = $this->getdata->getbusinesslist($categoryParameters);
        $baseUrl = '/admin/businessdistrict?placeholder=true';
        $selectUrl = '/admin/businessdistrict?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $categoryParameters['result'] = 'data';
        // $bannerParameters['limit']=$pageInfo['limit'];
        $businessdistrict = $this->getdata->getbusinesslist($categoryParameters);
        $parameters = array('view' => 'businessdistrict-list', 'data' => array('businessdistrict' =>
                    $businessdistrict, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*平台提示消息*/
    public function reminderlist()
    {
        $categoryParameters = array('result' => 'count', 'orderBy' => array('business_addtime' =>
                    'DESC'));
        $amount = $this->getdata->getreminder($categoryParameters);
        $baseUrl = '/admin/reminderlist?placeholder=true';
        $selectUrl = '/admin/reminderlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $categoryParameters['result'] = 'data';
        $getreminder = $this->getdata->getreminder($categoryParameters);
        //var_dump($getreminder);
        $parameters = array('view' => 'reminder-list', 'data' => array('getreminder' =>
                    $getreminder, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*平台提示消息*/
    public function addreminder()
    {
        $parameters = array('view' => 'reminder-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    /*平台提示消息*/
    public function reminderedit()
    {
        if (!empty($_GET['msg_id'])) {
            $msg_id = $_GET['msg_id'];
            //将id存在session  返回页面时会用到
            unset($_SESSION['msg_id']);
            $_SESSION['msg_id'] = $msg_id;
        } else {
            $msg_id = $_SESSION['msg_id'];
        }
        /*根据id查出平台提示信息*/
        $parameters = array('id' => $msg_id, 'result' => 'data');
        $reminder = $this->getdata->getReminderById($parameters);
        $parameters = array('view' => 'reminder-edit', 'data' => array('reminder' => $reminder));
        $this->adminCommonHandler($parameters);
    }
    /*添加商圈*/
    public function businessdistrictadd()
    {
        $parameters = array('view' => 'businessdistrict-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    /*修改商圈*/
    public function businessdistrictedit()
    {
        $businessId = $_GET['businessId'];
        $url = API_IP . 'AEWebApp/common/queryBusinessListById?businessId=' . $businessId;
        $header = array();
        $param = array();
        $businessJSON = httpGet($url, $header, $param);
        $business = json_decode($businessJSON)->data;
        $parameters = array('view' => 'businessdistrict-edit', 'data' => array('business' =>
                    $business));
        $this->adminCommonHandler($parameters);
    }
    /*查出所有分类特征*/
    public function categoryfeature()
    {
        $categoryParameters = array('result' => 'count', 'orderBy' => array('feature_addtime' =>
                    'DESC'));
        /*分页开始*/
        $amount = $this->getdata->getCateFeature($categoryParameters);
        $baseUrl = '/admin/categoryfeature?placeholder=true';
        $selectUrl = '/admin/categoryfeature?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        /*查出所有数据*/
        $categoryParameters['result'] = 'data';
        $catefeature = $this->getdata->getCateFeature($categoryParameters);
        //var_dump($catefeature);
        $parameters = array('view' => 'catefeature-list', 'data' => array('catefeature' =>
                    $catefeature, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*添加分类特征根据id*/
    public function catefeatureaddByid()
    {
        //         if(!empty($_GET['id']))
        //         {
        //         	$cateid=$_GET['id'];
        //         	//将id存在session  返回页面时会用到
        //         	unset($_SESSION['cateid']);
        //         	$_SESSION['cateid']=$cateid;
        //         }
        //         else
        //         {
        // $cateid=$_SESSION['cateid'];
        //         }
        //          $parameters=array('id'=>$cateid,'result'=>'data');
        // $category=$this->getdata->getCategoriesById($parameters);
        $parameters = array('view' => 'catefeaturebyid-add', 'data' => array('category' =>
                    $category));
        $this->adminCommonHandler($parameters);
    }
    /*添加分类特征*/
    public function catefeatureadd()
    {
        //          $parameters=array('result'=>'count');
        // $category=$this->getdata->getCategoryAlls(false,false);
        $parameters = array('view' => 'catefeature-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    /*编辑分类特征*/
    public function catefeatureedit()
    {
        $feature_id = $_GET['feature_id'];
        $categoryParameters = array('result' => 'data', 'feature_id' => $feature_id);
        $catefeature = $this->getdata->getCateFeature($categoryParameters);
        //var_dump($catefeature);
        $parameters = array('view' => 'catefeature-edit', 'data' => array('catefeature' =>
                    $catefeature));
        $this->adminCommonHandler($parameters);
    }
    /*二级分类添加分类特征根据id*/
    public function featureaddByChoice()
    {
        if (!empty($_GET['twoid'])) {
            $cateid = $_GET['twoid'];
            //将id存在session  返回页面时会用到
            unset($_SESSION['cateid']);
            $_SESSION['cateid'] = $cateid;
        } else {
            $cateid = $_SESSION['cateid'];
        }
        $id = $_GET['id'];
        $cateparameters = array('id' => $id, 'result' => 'data');
        $category = $this->getdata->getCategoriesById($cateparameters);
        $parameters = array('id' => $cateid, 'result' => 'data');
        $catefeature = $this->getdata->getCateFeatureById($parameters);
        $parameters = array('view' => 'subfeaturebyid-add', 'data' => array(
                'category' => $category,
                'catefeature' => $catefeature,
                'id' => $id));
        $this->adminCommonHandler($parameters);
    }
    /*查出所有分类特征值*/
    public function categoryeigenvalue()
    {
        $categoryParameters = array('result' => 'count', 'orderBy' => array('eigenvalue_addtime' =>
                    'DESC'));
        /*分页开始*/
        $amount = $this->getdata->getCateFeatureValue($categoryParameters);
        $baseUrl = '/admin/categoryeigenvalue?placeholder=true';
        $selectUrl = '/admin/categoryeigenvalue?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        /*查出所有数据*/
        $categoryParameters['result'] = 'data';
        $catefeature = $this->getdata->getCateFeatureValue($categoryParameters);
        //var_dump($catefeature);
        $parameters = array('view' => 'catefeaturevalue-list', 'data' => array('catefeature' =>
                    $catefeature, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*添加分类特征*/
    public function catefeaturevalueadd()
    {
        $parameters = array('result' => 'count');
        $category = $this->getdata->getCatesFeature(false, false);
        $parameters = array('view' => 'catefeaturevalue-add', 'data' => array('category' =>
                    $category));
        $this->adminCommonHandler($parameters);
    }
    /*编辑分类特征*/
    public function catevalueedit()
    {
        $parameters = array('result' => 'count');
        $category = $this->getdata->getCatesFeature(false, false);
        $eigen_id = $_GET['eigen_id'];
        $cateparameters = array('result' => 'data', 'eigen_id' => $eigen_id);
        $catefeature = $this->getdata->getCateFeatureValue($cateparameters);
        $parameters = array('view' => 'catefeaturevalue-edit', 'data' => array('category' =>
                    $category, 'catefeature' => $catefeature));
        $this->adminCommonHandler($parameters);
    }
    //查出所有的店铺审核员
    public function shopauditall()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'AESC'));
        $amount = $this->getdata->getShopaduits($bannerParameters);
        $baseUrl = '/admin/buyerlist?placeholder=true';
        $selectUrl = '/admin/buyerlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        // $bannerParameters['limit']=$pageInfo['limit'];
        $admins = $this->getdata->getShopaduits($bannerParameters);
        $parameters = array('view' => 'index-examinant', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出所有的年费审核员
    public function annuityadmin()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'AESC'));
        $amount = $this->getdata->getAnnuityAduits($bannerParameters);
        $baseUrl = '/admin/buyerlist?placeholder=true';
        $selectUrl = '/admin/buyerlist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        // $bannerParameters['limit']=$pageInfo['limit'];
        $admins = $this->getdata->getAnnuityAduits($bannerParameters);
        $parameters = array('view' => 'annuityadmin-list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //审核过的店铺
    public function Audittrue()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('shop_addtime' =>
                    'AESC'));
        $amount = $this->getdata->getAuditshop($bannerParameters);
        $baseUrl = '/audit/Audittrue?placeholder=true';
        $selectUrl = '/audit/Audittrue?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getAuditshop($bannerParameters);
        $parameters = array('view' => 'Audittrue-list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //未通过审核的店铺
    public function unapprove()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('shop_addtime' =>
                    'AESC'));
        $amount = $this->getdata->getUnAuditshop($bannerParameters);
        $baseUrl = '/audit/unapprove?placeholder=true';
        $selectUrl = '/audit/unapprove?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $admins = $this->getdata->getUnAuditshop($bannerParameters);
        $parameters = array('view' => 'unapprove-list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //被举报的店铺的店铺
    public function insertReportShop()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('report_addtime' =>
                    'AESC'));
        $amount = $this->getdata->insertReportShop($bannerParameters);
        $baseUrl = '/audit/insertReportShop?placeholder=true';
        $selectUrl = '/audit/insertReportShop?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        $report = $this->getdata->insertReportShop($bannerParameters);
        $parameters = array('view' => 'report-list', 'data' => array('report' => $report,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*查出商铺的活动*/
    public function getshopActivity()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'AESC'));
        $shopid = $_GET['shop_id'];
        $bannerParameters['shopid'] = $shopid;
        $bannerParameters['result'] = 'data';
        $activitys = $this->getdata->getactivityByshopid($bannerParameters);
        //var_dump($activitys);
        $parameters = array('view' => 'shopactivity-show', 'data' => array('activitys' =>
                    $activitys));
        $this->adminCommonHandler($parameters);
    }
    /*查出商铺的活动*/
    public function sendMessage()
    {
        $phone = $_GET['phone'];
        $parameters = array('view' => 'sendMessage-show', 'data' => array('phone' => $phone));
        $this->adminCommonHandler($parameters);
    }
    /*查出提交年费的店铺*/
    public function annualAudit()
    {
        $status = $_GET['status'];
        $parameters = array(
            'result' => 'count',
            'status' => $status,
            'orderBy' => array('annuity_addtime' => 'AESC'));
        $amount = $this->getdata->getAnnualShop($parameters);
        $baseUrl = '/audit/annualAudit?placeholder=true';
        $selectUrl = '/audit/annualAudit?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $parameters['result'] = 'data';
        $annualAudit = $this->getdata->getAnnualShop($parameters);
        $parameters = array('view' => 'annualAudit-list', 'data' => array('annualAudit' =>
                    $annualAudit, 'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*根据店铺id查出充值流水*/
    public function getShopRechargeAll()
    {
        $shopid = $_SESSION['shopid'];
        $parameters = array(
            'result' => 'count',
            'shopid' => $shopid,
            'orderBy' => array('recharge_time' => 'AESC'));
        $amount = $this->getdata->getShopRechargeAll($parameters);
        $baseUrl = '/audit/getShopRechargeAll?placeholder=true';
        $selectUrl = '/audit/getShopRechargeAll?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $parameters['result'] = 'data';
        $recharge = $this->getdata->getShopRechargeAll($parameters);
        //var_dump($recharge);
        $parameters = array('view' => 'recharge-list', 'data' => array('recharge' => $recharge,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*根据店铺id查出提现流水*/
    public function getShopCashOutAll()
    {
        $shopid = $_SESSION['shopid'];
        $parameters = array(
            'result' => 'count',
            'shopid' => $shopid,
            'orderBy' => array('cash_time' => 'AESC'));
        $amount = $this->getdata->getShopCashOutAll($parameters);
        $baseUrl = '/audit/getShopCashOutAll?placeholder=true';
        $selectUrl = '/audit/getShopCashOutAll?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $parameters['result'] = 'data';
        $cashout = $this->getdata->getShopCashOutAll($parameters);
        //var_dump($cashout);
        $parameters = array('view' => 'cashout-list', 'data' => array('cashout' => $cashout,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*根据店铺id查出提现流水*/
    public function getShopExpenseAll()
    {
        $shopid = $_SESSION['shopid'];
        $parameters = array(
            'result' => 'count',
            'shopid' => $shopid,
            'orderBy' => array('expense_time' => 'AESC'));
        $amount = $this->getdata->getShopExpenseAll($parameters);
        $baseUrl = '/audit/getShopExpenseAll?placeholder=true';
        $selectUrl = '/audit/getShopExpenseAll?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $parameters['result'] = 'data';
        $expense = $this->getdata->getShopExpenseAll($parameters);
        //var_dump($cashout);
        $parameters = array('view' => 'expense-list', 'data' => array('expense' => $expense,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    //查出店铺余额信息
    public function getCurrentMoney()
    {
        $shopid = $_SESSION['shopid'];
        $parameters = array('result' => 'count', 'shopid' => $shopid);
        $amount = $this->getdata->getCurrentMoney($parameters);
        $baseUrl = '/audit/getCurrentMoney?placeholder=true';
        $selectUrl = '/audit/getCurrentMoney?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $parameters['result'] = 'data';
        $shopdata = $this->getdata->getCurrentMoney($parameters);
        //var_dump($cashout);
        $parameters = array('view' => 'current-list', 'data' => array('shopdata' => $shopdata,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*财务管理-------------------------------------------------------------------------------------------*/
    //查出所有搜索审核员
    public function financeadmin()
    {
        $bannerParameters = array('result' => 'count', 'orderBy' => array('addtime' =>
                    'AESC'));
        $amount = $this->getdata->financeadmin($bannerParameters);
        $baseUrl = '/admin/financeadmin?placeholder=true';
        $selectUrl = '/admin/financeadmin?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        //$bannerParameters['limit']=$pageInfo['limit'];
        $admins = $this->getdata->financeadmin($bannerParameters);
        $parameters = array('view' => 'financeadmin-list', 'data' => array('admins' => $admins));
        $this->adminCommonHandler($parameters);
    }
    public function financeadd()
    {
        $parameters = array('view' => 'finance-add', 'data' => array());
        $this->adminCommonHandler($parameters);
    }
    /*提现审核*/
    public function goodFinancelist()
    {
        $status = $_GET['status'];
        $bannerParameters = array(
            'result' => 'count',
            'cash_status' => $status,
            'orderBy' => array('cash_time' => 'DESC'));
        $amount = $this->getdata->goodFinancelist($bannerParameters);
        $baseUrl = '/admin/goodFinancelist?placeholder=true';
        $selectUrl = '/admin/goodFinancelist?placeholder=true';
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
            1;
        $amountPerPage = 20;
        $pageInfo = $this->getdata->getPageLink($baseUrl, $selectUrl, $currentPage, $amountPerPage,
            $amount);
        $bannerParameters['result'] = 'data';
        //$bannerParameters['limit']=$pageInfo['limit'];
        $admins = $this->getdata->goodFinancelist($bannerParameters);
        $parameters = array('view' => 'shopfinance-list', 'data' => array('admins' => $admins,
                    'pageInfo' => $pageInfo));
        $this->adminCommonHandler($parameters);
    }
    /*根据id 获取提现信息*/
    public function getcashout()
    {
        $id = $_GET['id'];
        $bannerParameters = array('result' => 'data', 'id' => $id);
        $admins = $this->getdata->getcashout($bannerParameters);
        //var_dump($admins);
        // $parameters=array(
        // 	'view'=>'shopcashouts',
        // 	'data'=>array('admins'=>$admins)
        // );
        $admins = (array )$admins[0];
        //var_dump($admins);
        $this->load->view('batchAlipay/index', $admins);
        //$this->adminCommonHandler($parameters);
    }
    /*将支付信息传到支付页面*/
    public function cashoutsubmint()
    {
        $admins['WIDemail'] = $_POST['WIDemail'];
        $admins['WIDaccount_name'] = $_POST['WIDaccount_name'];
        $admins['WIDpay_date'] = $_POST['WIDpay_date'];
        $admins['WIDbatch_no'] = $_POST['WIDbatch_no'];
        $admins['WIDbatch_fee'] = $_POST['WIDbatch_fee'];
        $admins['WIDbatch_num'] = $_POST['WIDbatch_num'];
        $admins['WIDdetail_data'] = $_POST['WIDdetail_data'];
        //var_dump($admins);
        $this->load->view('batchAlipay/alipayapi', $admins);
    }
    /**店铺充值 支付宝sdk调用*/
    //    public function shoprecharge()
    //    {
    //        $this->load->library('alipay/aop/AopClient');
    // 	$c = new AopClient;
    // 	$c->gatewayUrl = "fd@fengdukeji.com";
    // 	$c->appId = "2088421202338058";
    // 	/*私钥*/
    // 	$c->privateKey = "MIICdQIBADANBgkqhkiG9w0BAQEFAASCAl8wggJbAgEAAoGBAL0CKL1Yln99dMVA1QHNZ/hp/BIlpB7nsPOuIDrjtiZIpKSwvCKSt26xsgpjqrqfnfKFDckBP6iEx2cjp6a8HE94oLfGip2iP4cFgXHRG5ClQldzxOpIwKFWcIRR/J6W6oh9W9izWV33WrDU6irCsQV9jlrLAGNLBTvGKWSlRIslAgMBAAECgYBni0pESMbR+ynAcj7/KMc/qNhGHMbng2hGZusTN/Ju0LcZ3hSDIDtLch+mX2mFqbH+zXN63atBJ9SRpU/QIRekZJCR8ojHpCuG/zl8WZvxyJwzbIGvrIDB3ukxFeA3Gy8XyVquYXNZaPYC7KOZkhCcuGsgSvv9K2+rX+2voBcklQJBAOdSlPRHeQF3zItnlAz6t08J/Pwuljbb+vv9juTY7YpFoEUgzMOVXjOV7RLVEvy9z5WGutmmUul6Wd8IGN8qzHcCQQDRK/pmFw/qMVsYrQ2uZJsK1qV1ditaufGSzoMXUubPJp1yqQp3gBkW5BMiqKy/3devoUkJoOjnjt6gMnnjIThDAkAPhRXjUcxHke8SR0/CkyurTONBVCrV4Wp0b62fowJE7aj0GmBCmwnn8h4mzk7o0B9WS+TLZ4JWkdPnx9ZLWsa/AkA6cHUG7M6Pebaf0EmQPZ9rici0Zo16TZUGlRfe/lRp77nxfPTlqi5YTORjvIh3Gn3WHdOQExq/BxV/4FpZcMCNAkBX2GuItGx4wSMXncpbEYLzzh2RGe1L00B96JVnbCwTSqqucOpykRWCtQjDRnhZTLPLAFzcWbLiR5w0g7vi0Ocj";
    // 	$c->format = "json";
    // 	$c->charset= "GBK";
    // 	/*公钥*/
    // 	$c->alipayPulicKey = "MIICWwIBAAKBgQC9Aii9WJZ/fXTFQNUBzWf4afwSJaQe57DzriA647YmSKSksLwikrdusbIKY6q6n53yhQ3JAT+ohMdnI6emvBxPeKC3xoqdoj+HBYFx0RuQpUJXc8TqSMChVnCEUfyeluqIfVvYs1ld91qw1OoqwrEFfY5aywBjSwU7xilkpUSLJQIDAQABAoGAZ4tKREjG0fspwHI+/yjHP6jYRhzG54NoRmbrEzfybtC3Gd4UgyA7S3Ifpl9phamx/s1zet2rQSfUkaVP0CEXpGSQkfKIx6Qrhv85fFmb8cicM2yBr6yAwd7pMRXgNxsvF8larmFzWWj2AuyjmZIQnLhrIEr7/Stvq1/tr6AXJJUCQQDnUpT0R3kBd8yLZ5QM+rdPCfz8LpY22/r7/Y7k2O2KRaBFIMzDlV4zle0S1RL8vc+VhrrZplLpelnfCBjfKsx3AkEA0Sv6ZhcP6jFbGK0NrmSbCtaldXYrWrnxks6DF1LmzyadcqkKd4AZFuQTIqisv93Xr6FJCaDo547eoDJ54yE4QwJAD4UV41HMR5HvEkdPwpMrq0zjQVQq1eFqdG+tn6MCRO2o9BpgQpsJ5/IeJs5O6NAfVkvky2eCVpHT58fWS1rGvwJAOnB1BuzOj3m2n9BJkD2fa4nItGaNek2VBpUX3v5Uae+58Xz05aouWEzkY7yIdxp91h3TkBMavwcVf+BaWXDAjQJAV9hriLRseMEjF53KWxGC884dkRntS9NAfeiVZ2wsE0qqrnDqcpEVgrUIw0Z4WUyzywBc3Fmy4kecNIO74tDnIw==";
    // 	//实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.open.public.template.message.industry.modify
    // 	$this->load->library('alipay/aop/request/AlipayOpenPublicTemplateMessageIndustryModifyRequest');
    // 	$req = new AlipayOpenPublicTemplateMessageIndustryModifyRequest();
    // 	//SDK已经封装掉了公共参数，这里只需要传入业务参数
    // 	//此次只是参数展示，未进行字符串转义，实际情况下请转义
    // 	$request->bizContent = "{
    // 	    'primary_industry_name':'IT科技/IT软件与服务',
    // 	    'primary_industry_code':'10001/20102',
    // 	    'secondary_industry_code':'10001/20102',
    // 	    'secondary_industry_name':'IT科技/IT软件与服务'
    // 	  }";
    // 	$response= $c->execute($req);
    // }
}
?>