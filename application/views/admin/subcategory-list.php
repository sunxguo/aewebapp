<title>店铺分类管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 店铺管理 <span class="c-gray en">&gt;</span> 二级分类分类管理 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<a href="javascript:;" onclick="member_add('添加管理员','/admin/subcategoryAdd','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加二级分类</a>
		</span>  
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<!--<?php var_dump($categories);?>-->
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="120">二级分类</th>
				<th width="120">所属一级分类</th>
				<th width="120">分类描述</th>
                <!-- <th width="100">添加分类特征</th> -->
				<th width="120">状态</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($categories as $category):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $category->id;?>" name="id"></td>
				<td><?php echo $category->name;?></td>
				<td><?php echo $category->category->name;?></td>
				<td><?php echo $category->describe_shop;?></td>
				<!-- <td>
					<a href="javascript:;" onclick="feature_add('添加分类特征','/admin/featureaddByChoice','<?php echo $category->twoid;?>','800','500','<?php echo $category->id;?>')" class="ml-5" style="text-decoration:none">
					    <span class="label label-success radius">
					    	添加
					    </span>
					</a>    
				</td> -->
				<?php if($category->status=='0'):?>
					<td class="td-status"><span class="label label-success radius">已启用</span></td>
				<?php else:?>
					<td class="td-status"><span class="label label-defaunt radius">已停用</span></td>
				<?php endif;?>
				<td class="td-manage">
				<?php if($category->status=='0'):?>
					<!--修改状态-->
					<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $category->id;?>')" href="javascript:;" title="停用">
						<i class="Hui-iconfont">&#xe631;</i>
					</a> 
					<?php else:?>
					<a style="text-decoration:none" onClick="member_start(this,'<?php echo $category->id;?>')" href="javascript:;" title="启用">
						<i class="Hui-iconfont">&#xe6e1;</i>
					</a> 
				<?php endif;?>
					<a title="编辑" href="javascript:;" onclick="member_edit('修改分类信息','/admin/subcategoryedit','<?php echo $category->id;?>','500','300')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 
					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $category->id;?>')" class="ml-5" style="text-decoration:none">
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
		"aaSorting": [[ 4, "desc" ]],//默认第几个排序
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
/*添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*停用*/

function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		var category = new Object(); 
	    category.infoType = 'onecategory';
	    category.id = id;
	    category.status = 1;
	    dataHandler('/common/modifyInfo',category,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
			$(obj).remove();
			layer.msg('已停用!',{icon: 5,time:1000});
		},false,false);
	});
}

/*启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		var category = new Object(); 
	    category.infoType = 'onecategory';
	    category.id = id;
	    category.status = 0;
	    dataHandler('/common/modifyInfo',category,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
			$(obj).remove();
			layer.msg('已启用!',{icon: 6,time:1000});
		},false,false);
	});
}


/*编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*添加分类特征*/
function feature_add(title,url,twoid,w,h,id){
	layer_show(title,url+'?twoid='+twoid+'&id='+id,w,h);
}

/*删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var category = new Object(); 
	    category.infoType = 'category';
	    category.id = id;
		dataHandler('/common/deleteInfo',category,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}
/*seller-批量删除*/
// function member_del_bulk(){
// 	var memberArray = new Array();
//     $("input[name='id']:checked").each(function(){
//         memberArray.push($(this).val()); 
//     });
//     if(memberArray.length<1){
//        layer.alert('请选择要删除的分类！');
//         return false;
//     }
// 	layer.confirm('确认要删除这些分类吗？',function(index){
// 	    var categories = new Object();
// 	    categories.infoType = 'categories';
// 	    categories.idArray = memberArray;
// 	    dataHandler("/common/deleteBulkInfo",categories,null,null,null,function(){
// 	    	$("input[name='id']:checked").each(function(){
// 		        $(this).parents("tr").remove();
// 		    });
// 			layer.msg('已删除!',{icon:1,time:1000});
// 	    },false,false);
// 	});
// }
</script> 
</body>
</html>