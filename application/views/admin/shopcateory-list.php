<title>分类管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 分类管理 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<!-- <a href="javascript:;" onclick="member_del_bulk()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>  -->
			<a href="javascript:;" onclick="member_add('添加分类','/admin/shopcategoryadd','','550')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a>
		</span> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">分类名称</th>
				<th width="150">分类描述</th>
				<th width="80">序号</th>
				<th width="100">添加时间</th>
				<th width="100">修改时间</th>
				<th width="50">状态</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($shopCategory as $cate):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $cate->categoryId;?>" name="id"></td>
				<td><?php echo $cate->name;?></td>
				<td><?php echo $cate->describeShop;?></td>
				<td><?php echo $cate->orders;?></td>
				<td><?php echo $cate->addtime;?></td>
				<td><?php echo $cate->edittime;?></td>  

				<?php if($cate->status=='0'):?>
						<td class="td-status">
							<span class="label label-success radius">已启用</span>
						</td>
				<?php else:?>
						<td class="td-status">
							<span class="label label-defaunt radius">未启用</span>
						</td>
				<?php endif;?>
				<td class="td-manage">
					<?php if($cate->status=='0'):?>
						<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $cate->categoryId;?>')" href="javascript:;" title="暂停使用">
							<i class="Hui-iconfont">&#xe631;</i>
						</a> 
					<?php elseif($cate->status=='1'):?>
						<a style="text-decoration:none" onClick="member_start(this,'<?php echo $cate->categoryId;?>')" href="javascript:;" title="已启用">
							<i class="Hui-iconfont">&#xe6e1;</i>
						</a> 
					<?php endif;?>
					<a title="编辑" href="javascript:;" onclick="member_edit('修改分类信息','/admin/shopcategoryedit','<?php echo $cate->categoryId;?>','','550')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 
					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $cate->categoryId;?>')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	</div>
</div>
<!-- <script type="text/javascript" src="/assets/lib/laypage/1.2/laypage.js"></script>   API_IP.'AEWebApp/userShop/queryGoodsList  -->
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

/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要暂停使用吗？',function(index){
		var category = new Object(); 
	    category.infoType = 'category';
	    category.categoryId = id;
	    category.status = 1;
	    dataHandler('/common/modifyInfo',category,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">未启用</span>');
			$(obj).remove();
			layer.msg('已暂停使用!',{icon: 5,time:1000});
		},false,false);
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		var category = new Object(); 
	    category.infoType = 'category';
	    category.categoryId = id;
	    category.status = 0;
	    dataHandler('/common/modifyInfo',category,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="暂停使用"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
			$(obj).remove();
			layer.msg('已启用!',{icon: 6,time:1000});
		},false,false);
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?categoryId='+id,w,h);
}

/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var category = new Object(); 
	    category.infoType = 'shopcategory';
	    category.category_id = id;
		dataHandler('/common/deleteInfo',category,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}

</script> 
</body>
</html>