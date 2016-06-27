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
		<ul>
			<li class="dropDown dropDown_click"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
				<ul class="dropDown-menu radius box-shadow">
					<li><a href="javascript:;" onclick="picture_add('添加Banner','/admin/banneradd')"><i class="Hui-iconfont">&#xe613;</i> Banner</a></li>
					<li><a href="javascript:;" onclick="product_add('添加商品','/admin/productadd')"><i class="Hui-iconfont">&#xe620;</i> 商品</a></li>
					<li><a href="javascript:;" onclick="member_add('添加超市','/admin/subsupermarketadd','','510')"><i class="Hui-iconfont">&#xe60d;</i> 店铺</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<?php if($usertype == 'attention1'):?>
	<ul class="Hui-userbar">
		<li>附近审核员</li>
		<li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><?php echo $_SESSION['username'];?> <i class="Hui-iconfont">&#xe6d5;</i></a>
			<ul class="dropDown-menu radius box-shadow">
				<li><a href="#">个人信息</a></li>
				<li><a href="/admin/login">切换账户</a></li>
				<li><a href="/admin/login">退出</a></li>
			</ul>
		</li>
		<li id="Hui-msg"> 
			<a href="javascript:$('#advicelist').click();" title="消息">
				<span class="badge badge-danger"></span>
				<i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i>
			</a> 
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
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i>附近审核管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/getWordlist" href="javascript:;">口令集</a></li>
					<li><a _href="/admin/getCouponlist" href="javascript:;">优惠券</a></li>
					<li><a _href="/admin/todayPricelist" href="javascript:;">今日市价</a></li>
				</ul>
			</dd>
		</dl>
	</div>

</aside>
<?php endif;?>
<?php if($usertype == 'attention2'):?>
	<ul class="Hui-userbar">
		<li>附近管理员</li>
		<li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><?php echo $_SESSION['username'];?> <i class="Hui-iconfont">&#xe6d5;</i></a>
			<ul class="dropDown-menu radius box-shadow">
				<li><a href="#">个人信息</a></li>
				<li><a href="/admin/login">切换账户</a></li>
				<li><a href="/admin/login">退出</a></li>
			</ul>
		</li>
		<li id="Hui-msg"> 
			<a href="javascript:$('#advicelist').click();" title="消息">
				<span class="badge badge-danger"></span>
				<i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i>
			</a> 
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
		
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i>附近审核员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/nearbyaudit" href="javascript:;">附近审核员列表</a></li>
					<li><a _href="/admin/wordsortlist" href="javascript:;">口令分类</a></li>					
				</ul>
			</dd>
		</dl>
	</div>

</aside>
<?php endif;?>
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

</body>
</html>