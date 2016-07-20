<title>店铺基本信息管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 卖家管理 <span class="c-gray en">&gt;</span> 店铺基本信息管理 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>、
				<th width="100">店铺名</th>
				<th width="100">分店名</th>
				<th width="60">店长姓名</th>
				<th width="100">身份证号码</th>
				<th width="60">身份证图片</th>
				<th width="60">营业执照图片</th>
				<th width="60">其他证照</th>
				<th width="50">是否开通年费</th>
				
			</tr>
		</thead>
		<tbody>
			<?php foreach($superMarkets as $superMarket):?>	
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $superMarket->shop_id;?>" name="id"></td>
				<td><?php echo $superMarket->shop_name;?></td>
				<td><?php echo $superMarket->shop_branch_name;?></td>
				<td><?php echo $superMarket->shop_buinour_name;?></td>
				<td><?php echo $superMarket->shop_identity_card;?></td>
				<td><img src="<?php echo $superMarket->shop_identity_card_pic;?>" width="100"></td>
				<td><img src="<?php echo $superMarket->shop_business_license_pic;?>" width="100"></td>
				<td><img src="<?php echo $superMarket->shop_other_license1;?>;?>" width="100"></td>
				<td><?php if($superMarket->shop_annuity == 1):?> <span class="label label-success radius">是</span> <?php else:?> <span class="label label-defaunt radius">否</span> <?php endif;?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 0, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0]}// 制定列不参与排序
		]
	});
	
});
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url+'?goodsid='+id,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		var supermarket = new Object(); 
	    supermarket.infoType = 'supermarket';
	    supermarket.id = id;
	    supermarket.status = 1;
	    dataHandler('/common/modifyInfo',supermarket,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
			$(obj).remove();
			layer.msg('已停用!',{icon: 5,time:1000});
		},false,false);
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		var supermarket = new Object(); 
	    supermarket.infoType = 'supermarket';
	    supermarket.id = id;
	    supermarket.status = 0;
	    dataHandler('/common/modifyInfo',supermarket,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
			$(obj).remove();
			layer.msg('已启用!',{icon: 6,time:1000});
		},false,false);
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var supermarket = new Object(); 
	    supermarket.infoType = 'supermarket';
	    supermarket.id = id;
		dataHandler('/common/deleteInfo',supermarket,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}
/*seller-批量删除*/
function member_del_bulk(){
	var memberArray = new Array();
    $("input[name='id']:checked").each(function(){
        memberArray.push($(this).val()); 
    });
    if(memberArray.length<1){
       layer.alert('请选择要删除的超市！');
        return false;
    }
	layer.confirm('确认要删除这些超市吗？',function(index){
	    var supermarkets = new Object();
	    supermarkets.infoType = 'supermarkets';
	    supermarkets.idArray = memberArray;
	    dataHandler("/common/deleteBulkInfo",supermarkets,null,null,null,function(){
	    	$("input[name='id']:checked").each(function(){
		        $(this).parents("tr").remove();
		    });
			layer.msg('已删除!',{icon:1,time:1000});
	    },false,false);
	});
}
</script> 
</body>
</html>