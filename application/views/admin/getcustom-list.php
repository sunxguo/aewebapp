<title>自定义口令内容</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 插件管理 <span class="c-gray en">&gt;</span> 自定义口令内容 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="javascript:;" onclick="member_add('添加自定义口令内容','/admin/getcustomadd','','550')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加口令内容</a>
		</span> 
		<!-- <span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span>  -->
	</div>
	<div class="mt-20">
	
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">口令内容</th>
				<th width="100">添加时间</th>
				<th width="100">修改时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(isset($wordItem) && !empty($wordItem)):?>
			<?php foreach($wordItem as $cate):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $cate->wordItemId;?>" name="id"></td>
				<td><?php echo $cate->wordItemName;?></td>
				<td><?php echo $cate->wordItemAddtime;?></td>
				<td><?php echo $cate->wordItemEdittime;?></td>  
				<td class="td-manage">
					<a title="编辑" href="javascript:;" onclick="member_edit('修改口令内容','/admin/shopcategoryedit','<?php echo $cate->wordItemId;?>','','550')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 
					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $cate->wordItemId;?>')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>
			</tr>
			<?php endforeach;?>
		<?php else:?>
		    暂无数据	
		<?php endif;?>	
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

});
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
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