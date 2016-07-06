<title>财务审核员管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 财务审核员管理 <span class="c-gray en">&gt;</span> 财务审核员管理列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="javascript:;" onclick="member_add('添加管理员','/admin/financeadd','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加财务审核员</a>
		</span>  
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">审核员id</th>
				<th width="100">昵称</th>
				<th width="40">等级</th>
				<th width="90">角色</th>
				<th width="130">注册时间</th>
				<th width="130">更新时间</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($admins as $buyer):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $buyer->admin_id;?>" name="id"></td>
				<td><?php echo $buyer->admin_id;?></td>

				<td>
					<?php if(!empty($buyer->username)):?>
						<?php echo $buyer->username;?>
					
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($buyer->grade)):?>
						<?php echo $buyer->grade;?>
					
				    <?php endif;?>
				</td>
				<td>
					搜索审核员		
				</td>
				
				<td>
					<?php if(!empty($buyer->addtime)):?>
						<?php echo $buyer->addtime;?>
					

					<?php endif;?>
				</td>
				<td>
					<?php if(!empty($buyer->edittime)):?>
						<?php echo $buyer->edittime;?>
					
					<?php endif;?>
				</td>

				<?php if($buyer->status=='1'):?>
				<td class="td-status"><span class="label label-success radius">已启用</span></td>
				<?php else:?>
				<td class="td-status"><span class="label label-defaunt radius">已停用</span></td>
				<?php endif;?>
				
				<td class="td-manage">
					<?php if($buyer->status=='1'):?>
					<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $buyer->admin_id;?>')" href="javascript:;" title="停用">
						<i class="Hui-iconfont">&#xe631;</i>
					</a> 
					<?php else:?>
					<a style="text-decoration:none" onClick="member_start(this,'<?php echo $buyer->admin_id;?>')" href="javascript:;" title="启用">
						<i class="Hui-iconfont">&#xe6e1;</i>
					</a> 
					<?php endif;?>
					<a title="编辑" href="javascript:;" onclick="member_edit('修改信息','/admin/subadminedit','<?php echo $buyer->admin_id;?>','','510')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 
					<a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','/admin/changepassword','<?php echo $buyer->admin_id;?>','600','270')" href="javascript:;" title="修改密码">
						<i class="Hui-iconfont">&#xe63f;</i>
					</a>  
					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $buyer->admin_id;?>')" class="ml-5" style="text-decoration:none">
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
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		var buyer = new Object(); 
	    buyer.infoType = 'buyer';
	    buyer.id = id;
	    buyer.status = 1;
	    dataHandler('/common/modifyInfo',buyer,null,null,null,function(){
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
		var buyer = new Object(); 
	    buyer.infoType = 'buyer';
	    buyer.id = id;
	    buyer.status = 0;
	    dataHandler('/common/modifyInfo',buyer,null,null,null,function(){
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
	layer_show(title,url+'?admin_id='+id,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var buyer = new Object(); 
	    buyer.infoType = 'shopadmin';
	    buyer.id = id;
		dataHandler('/common/deleteInfo',buyer,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}
/*buyer-批量删除*/
function member_del_bulk(){
	var memberArray = new Array();
    $("input[name='id']:checked").each(function(){
        memberArray.push($(this).val()); 
    });
    if(memberArray.length<1){
       layer.alert('请选择要删除的用户！');
        return false;
    }
	layer.confirm('确认要删除这些用户吗？',function(index){
	    var buyers = new Object();
	    buyers.infoType = 'buyers';
	    buyers.idArray = memberArray;
	    dataHandler("/common/deleteBulkInfo",buyers,null,null,null,function(){
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