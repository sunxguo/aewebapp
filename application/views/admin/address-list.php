<title>收货地址管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 收货地址管理 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="javascript:;" onclick="member_del_bulk()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
			
		</span> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">用户</th>
				<th width="100">收货人姓名</th>
				<th width="100">收货人电话</th>
				<th width="40">省份</th>
				<!-- <th width="150">二维码</th> -->
				<th width="40">市</th>
				<th width="40">区</th>
				<th width="100">详细地址</th>
				<th width="130">添加时间</th>
				<th width="130">修改时间</th>
				<th width="70">默认</th>
				<th width="100">操作</th> 
			</tr>
		</thead>
		<tbody>
			<?php foreach($addresses as $address):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $address->address_id;?>" name="id"></td>
				<td><?php echo $address->user->user_nickname;?></td>
				<td><?php echo $address->address_user_name;?></td>
				<td><?php echo $address->address_user_phone;?></td>
				<td><?php echo $address->address_user_province;?></td>
				<td><?php echo $address->address_user_city;?></td>
				<td><?php echo $address->address_user_area;?></td>
				<td><?php echo $address->address_user_detailedarea;?></td>
				<td><?php echo $address->address_addtime;?></td>
				<td><?php echo $address->address_edittime;?></td>
				<?php if($address->address_type=='1'):?>
				<td class="td-status"><span class="label label-success radius">是</span></td>
				<?php else:?>
				<td class="td-status"><span class="label label-defaunt radius">否</span></td>
				<?php endif;?>
				
				<td class="td-manage">
					<?php /*if($seller->status=='0'):?>
					<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $seller->id;?>')" href="javascript:;" title="停用">
						<i class="Hui-iconfont">&#xe631;</i>
					</a> 
					<?php else:?>
					<a style="text-decoration:none" onClick="member_start(this,'<?php echo $seller->id;?>')" href="javascript:;" title="启用">
						<i class="Hui-iconfont">&#xe6e1;</i>
					</a> 
					<?php endif;?>
					<a title="编辑" href="javascript:;" onclick="member_edit('修改物流账号信息','/admin/sellerdeliveryedit','<?php echo $seller->id;?>','','610')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 
					<a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','/admin/sellerchangepassword','<?php echo $seller->id;?>','600','270')" href="javascript:;" title="修改密码">
						<i class="Hui-iconfont">&#xe63f;</i>
					</a>*/?> 
					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $address->address_id;?>')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	</div>
</div>
<!-- <script type="text/javascript" src="/assets/lib/laypage/1.2/laypage.js"></script> -->
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 8, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0]}// 制定列不参与排序
		]
	});
	$('.table-sort tbody').on( 'click', 'tr', function () {
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});
});
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		var seller = new Object(); 
	    seller.infoType = 'seller';
	    seller.id = id;
	    seller.status = 1;
	    dataHandler('/common/modifyInfo',seller,null,null,null,function(){
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
		var seller = new Object(); 
	    seller.infoType = 'seller';
	    seller.id = id;
	    seller.status = 0;
	    dataHandler('/common/modifyInfo',seller,null,null,null,function(){
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
	layer.alert('为保证数据完整与安全性，暂不提供收货地址删除功能！');
	// layer.confirm('确认要删除吗？',function(index){
	// 	var address = new Object(); 
	//     address.infoType = 'address';
	//     address.id = id;
	// 	dataHandler('/common/deleteInfo',address,null,null,null,function(){
	// 		$(obj).parents("tr").remove();
	// 		layer.msg('已删除!',{icon:1,time:1000});
	// 	},false,false);
	// });
}
/*seller-批量删除*/
function member_del_bulk(){
	layer.alert('为保证数据完整与安全性，暂不提供收货地址删除功能！');
	// var memberArray = new Array();
 //    $("input[name='id']:checked").each(function(){
 //        memberArray.push($(this).val()); 
 //    });
 //    if(memberArray.length<1){
 //       layer.alert('请选择要删除的账号！');
 //        return false;
 //    }
	// layer.confirm('确认要删除这些账号吗？',function(index){
	//     var sellers = new Object();
	//     sellers.infoType = 'sellers';
	//     sellers.idArray = memberArray;
	//     dataHandler("/common/deleteBulkInfo",sellers,null,null,null,function(){
	//     	$("input[name='id']:checked").each(function(){
	// 	        $(this).parents("tr").remove();
	// 	    });
	// 		layer.msg('已删除!',{icon:1,time:1000});
	//     },false,false);
	// });
}
</script> 
</body>
</html>