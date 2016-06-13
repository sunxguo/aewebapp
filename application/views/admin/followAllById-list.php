<title>关注用户列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 关注管理 <span class="c-gray en">&gt;</span> 关注用户列表 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="text-c">
		
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<!-- <a href="javascript:;" onclick="member_del_bulk()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>  -->
			
		</span> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">用户昵称</th>
				<th width="100">关注时间</th>
				<th width="70">状态</th>
				
			</tr>
		</thead>
		<tbody>
			<?php foreach($useries as $user):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $user->follow_id;?>" name="id"></td>
				<td>
					<?php if(!empty($user->username)):?>
						<?php echo $user->username;?>
					<?php else:?>
				    	暂无用户昵称
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($user->follow_addtime)):?>
						<?php echo $user->follow_addtime;?>
				    <?php endif;?>
				</td>

				<?php if($user->follow_status=='1'):?>
				<td class="td-status"><span class="label label-success radius">关注中</span></td>
				<?php else:?>
				<td class="td-status"><span class="label label-defaunt radius">取消关注</span></td>
				<?php endif;?>
				
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
	layer.confirm('确认要取消关注吗？',function(index){
		var follow = new Object(); 
	    follow.infoType = 'follow';
	    follow.follow_id = id;
	    follow.follow_status = 0;
	    //alert(collect.collect_status);
	    dataHandler('/common/modifyInfo',follow,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="关注"><i class="Hui-iconfont">&#xe6e1;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">取消关注</span>');
			$(obj).remove();
			layer.msg('已取消关注!',{icon: 5,time:1000});
		},false,false);
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要关注吗？',function(index){
		var follow = new Object(); 
	    follow.infoType = 'follow';
	    follow.follow_id = id;
	    follow.follow_status = 1;
	    dataHandler('/common/modifyInfo',follow,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="取消关注"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已关注</span>');
			$(obj).remove();
			layer.msg('已关注!',{icon: 6,time:1000});
		},false,false);
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}
/*图片-编辑*/
function product_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var product = new Object(); 
	    product.infoType = 'product';
	    product.id = id;
		dataHandler('/common/updateproducts',product,null,null,null,function(){
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
       layer.alert('请选择要删除的商品！');
        return false;
    }
	layer.confirm('确认要删除这些商品吗？',function(index){
	    var products = new Object();
	    products.infoType = 'products';
	    products.idArray = memberArray;
	    
	    dataHandler("/common/updateBulkInfo",products,null,null,null,function(){
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