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
	
	<?php if($usertype == 'shop1'):?>
	<ul class="Hui-userbar">
		<li>店铺审核员</li>
		<li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><?php echo $_SESSION['username'];?> <i class="Hui-iconfont">&#xe6d5;</i></a>
			<ul class="dropDown-menu radius box-shadow">
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
	<input runat="server" id="divScrollValue" type="hidden" value=""/>
	<div class="menu_dropdown bk_2">
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i>店铺审核管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/unapprove" href="javascript:;">未审核的店铺</a></li>
					<li><a _href="/admin/Audittrue" href="javascript:;">审核通过的店铺</a></li>
					<li><a _href="/admin/insertReportShop" href="javascript:;">举报的店铺</a></li>
                    <li><a _href="/admin/getCouponlist" href="javascript:;">优惠券</a></li>
				</ul>
			</dd>
		</dl>
	</div>

</aside>
<?php endif;?>
<?php if($usertype == 'shop2'):?>
	<ul class="Hui-userbar">
		<li>店铺管理员</li>
		<li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><?php echo $_SESSION['username'];?> <i class="Hui-iconfont">&#xe6d5;</i></a>
			<ul class="dropDown-menu radius box-shadow">
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
				<li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
			</ul> 
		</li>
	</ul>

	<a aria-hidden="false" class="Hui-nav-toggle" href="#"></a> </header>
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
	<div class="menu_dropdown bk_2">
		<!-- <dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe613;</i> Banner管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/bannerlist" href="javascript:void(0)">Banner管理</a></li>
				</ul>
			</dd>
		</dl> -->
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i>店铺管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/shopauditall" href="javascript:;">店铺审核员列表</a></li>
					<li><a _href="/admin/annuityadmin" href="javascript:;">年费审核员列表</a></li>
					<li><a _href="/admin/businessdistrict" href="javascript:;">商圈列表</a></li>
					<li><a _href="/admin/reminderlist" href="javascript:;">平台提示消息</a></li>	
					<li><a _href="/admin/categorylistAll" href="javascript:;">店铺一级分类列表</a></li>	
					<li><a _href="/admin/subcategorylist" href="javascript:;">店铺二级分类列表</a></li>
					<li><a _href="/admin/categoryfeature" href="javascript:;">分类特征列表管理</a></li>
					<li><a _href="/admin/categoryeigenvalue" href="javascript:;">分类特征值管理</a></li>
				</ul>
			</dd>
		</dl>
	</div>

</aside>
<?php endif;?>

	<?php if($usertype == 'shop3'):?>
	<ul class="Hui-userbar">
		<li>店铺审核员</li>
		<li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><?php echo $_SESSION['username'];?> <i class="Hui-iconfont">&#xe6d5;</i></a>
			<ul class="dropDown-menu radius box-shadow">
				
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
	<input runat="server" id="divScrollValue" type="hidden" value=""/>
	<div class="menu_dropdown bk_2">
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i>店铺年费审核管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/annualAudit?status=0" href="javascript:;">提交年费的店铺</a></li>
					<li><a _href="/admin/annualAudit?status=1" href="javascript:;">通过审核的店铺</a></li>
					
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