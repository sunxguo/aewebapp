<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<title>商城后台管理系统</title>
</head>
<body>
<header class="Hui-header cl"> <a class="Hui-logo l" title="H-ui.admin v2.3" href="#">商城后台管理系统</a> <a class="Hui-logo-m l" href="#" title="H-ui.admin"></a> <span class="Hui-subtitle l">Beta</span>
	<nav class="mainnav cl" id="Hui-nav">
		
	</nav>
	<ul class="Hui-userbar">
		<li>商铺用户</li>
		<li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><?php echo $_SESSION['nickname'];?> <i class="Hui-iconfont">&#xe6d5;</i></a>
			<ul class="dropDown-menu radius box-shadow">
				<li><a href="/admin/login">切换账户</a></li>
				<li><a href="/adminajax/logout">退出</a></li>
			</ul>
		</li>
		
		<li id="Hui-skin" class="dropDown right dropDown_hover"><a href="javascript:;" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
			<ul class="dropDown-menu radius box-shadow">
				<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
				<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
				<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
				<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
				<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
				<li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
			</ul>
		</li>
	</ul>
	<a aria-hidden="false" class="Hui-nav-toggle" href="#"></a> </header>
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
	
	<div class="menu_dropdown bk_2">
		
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 卖家管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/getShopDataByUserId" href="javascript:void(0)">店铺管理</a></li>
					<li><a _href="/admin/getShopBasicDataByUserId" href="javascript:void(0)">店铺基本信息管理</a></li>
				
				</ul>
			</dd>
		</dl>
		
		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe620;</i> 商品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/getShopGoodsAll" href="javascript:void(0)">商品管理</a></li>
					<li><a _href="/admin/getcategorybyshopid" href="javascript:void(0)">分类管理</a></li>
					

				</ul>
			</dd>
		</dl>

		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe620;</i> 用户管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/collectAllById" href="javascript:void(0)">收藏用户</a></li>
					<li><a _href="/admin/followAllById" href="javascript:void(0)">关注用户</a></li>
					<li><a _href="/admin/getAllStickIById" href="javascript:void(0)">置顶用户</a></li>

				</ul>
			</dd>
		</dl>
		
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe687;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/getOrderByShopId" href="javascript:void(0)">订单管理</a></li>
					<!-- <li><a _href="/admin/addresslistAll" href="javascript:void(0)">收货地址管理</a></li> -->
				</ul>
			</dd>
		</dl>
	
		<dl id="menu-comments">
			<dt><i class="Hui-iconfont">&#xe6ca;</i> 插件管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/getDiscountListById" href="javascript:;">优惠券</a></li>
					<li><a _href="/admin/getWordListById" href="javascript:;">口令集</a></li>
					<li><a _href="/admin/getCustomCount" href="javascript:;">自定义口令内容</a></li>
					
				</ul>
			</dd>
		</dl>
	
		<dl id="menu-comments">
			<dt><i class="Hui-iconfont">&#xe6ca;</i> 活动管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/getActivityListById" href="javascript:void(0)">优惠活动</a></li>
				</ul>
			</dd>
			
		</dl>
	</div>
</aside>
<div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="我的桌面" data-href="/admin/welcome">我的桌面</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="/admin/welcome"></iframe>
		</div>
	</div>
</section>
<script type="text/javascript">
/*资讯-添加*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}

	$('#productajax').click(function() {
		$.ajax({
			url: '/admin/productlist',
			type:'GET',
			async:false
		});
	});
</script>
</body>
</html>