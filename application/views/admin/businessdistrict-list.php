<title>商圈列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 店铺管理 <span class="c-gray en">&gt;</span> 商圈列表 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="javascript:;" onclick="member_add('添加商圈','/admin/businessdistrictadd','','550')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加商圈</a>
		</span> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">省</th>
				<th width="80">市</th>
				<th width="80">区</th>
				<th width="80">商圈名称</th>
				<th width="80">地址</th>
				<th width="80">商圈logo</th>
				<th width="80">商场点评</th>
				<th width="80">商业中心</th>
				<th width="80">商业街</th>
				<th width="80">经度</th>
				<th width="80">纬度</th>
				<th width="50">状态</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($businessdistrict as $data):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $data->business_id;?>" name="id"></td>
				<td><?php echo $data->business_province;?></td>
				<td><?php echo $data->business_city;?></td>
				<td><?php echo $data->business_area;?></td>
				<td><?php echo $data->business_name;?></td>
				<td><?php echo $data->business_address;?></td>
				<td><img src="<?php echo $data->business_logo;?>" width="100"></td>
				<td><?php echo $data->business_comments;?></td>
				<td><?php echo $data->business_mart;?></td>
				<td><?php echo $data->business_street;?></td>
				<td><?php echo $data->business_lng;?></td>
				<td><?php echo $data->business_lat;?></td>

				<?php if($data->business_status=='0'):?>
						<td class="td-status">
							<span class="label label-success radius">已启用</span>
						</td>
				<?php else:?>
						<td class="td-status">
							<span class="label label-defaunt radius">未启用</span>
						</td>
				<?php endif;?>
				<td class="td-manage">
					<?php if($data->business_status=='0'):?>
						<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $data->business_id;?>')" href="javascript:;" title="暂停使用">
							<i class="Hui-iconfont">&#xe631;</i>
						</a> 
					<?php elseif($data->business_status=='1'):?>
						<a style="text-decoration:none" onClick="member_start(this,'<?php echo $data->business_id;?>')" href="javascript:;" title="启用">
							<i class="Hui-iconfont">&#xe6e1;</i>
						</a> 
					<?php endif;?>

					<a title="编辑" href="javascript:;" onclick="member_edit('修改商圈信息','/admin/businessdistrictedit','<?php echo $data->business_id;?>','','550')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 

					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $data->business_id;?>')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 8, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  {"orderable":false,"aTargets":[0]}// 制定列不参与排序
		]
	});
	// $('.table-sort tbody').on( 'click', 'tr', function () {
	// 	if ( $(this).hasClass('selected') ) {
	// 		$(this).removeClass('selected');
	// 	}
	// 	else {
	// 		table.$('tr.selected').removeClass('selected');
	// 		$(this).addClass('selected');
	// 	}
	// });
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
	layer.confirm('确认要暂停使用吗？',function(index){
		var business = new Object(); 
	    business.infoType = 'businessdistrict';
	    business.businessId = id;
	    business.business_status = 1;
	    dataHandler('/common/modifyInfo',business,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="上架"><i class="Hui-iconfont">&#xe6e1;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">未启用</span>');
			$(obj).remove();
			layer.msg('已暂停使用!',{icon: 5,time:1000});
		},false,false);
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		var business = new Object(); 
	    business.infoType = 'businessdistrict';
	    business.businessId = id;
	    business.business_status = 0;
	    dataHandler('/common/modifyInfo',business,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,'+id+')" href="javascript:;" title="暂停使用"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
			$(obj).remove();
			layer.msg('已启用!',{icon: 6,time:1000});
		},false,false);
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?businessId='+id,w,h);
}


/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var product = new Object(); 
	    product.infoType = 'business';
	    product.business_id = id;
		dataHandler('/common/deleteInfo',product,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}

</script> 
</body>
</html>