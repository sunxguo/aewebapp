<title>店铺年费管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 店铺管理 <span class="c-gray en">&gt;</span> 店铺年费管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">店铺名称</th>
				<th width="60">总额</th>
				<th width="130">开通时间</th>
				<th width="130">到期时间</th>
				<th width="70">状态</th>
				<th width="70">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($annualAudit as $shops):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $shops->annuity_id;?>" name="id"></td>

				<td>
					<?php if(!empty($shops->usershop->shop_name) && !empty($shops->usershop->shop_branch_name)):?>
						<?php echo $shops->usershop->shop_name;?> - <?php echo $shops->usershop->shop_branch_name;?>
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($shops->annuity_price)):?>
						<?php echo $shops->annuity_price;?>
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($shops->annuity_addtime)):?>
						<?php echo $shops->annuity_addtime;?>
				    <?php endif;?>
				</td>
				<td>
					<?php if(!empty($shops->annuity_endtime)):?>
						<?php echo $shops->annuity_endtime;?>
				    <?php endif;?>
				</td>

				<?php if($shops->annuity_status=='1'):?>
					<td class="td-status"><span class="label label-success radius">已审核</span></td>
				<?php elseif($shops->annuity_status=='0'):?>
					<td class="td-status"><span class="label label-defaunt radius">审核中</span></td>
				<?php endif;?>

				<td class="td-manage">
					<?php if($shops->annuity_status=='0'):?>
						<a style="text-decoration:none" onClick="member_start(this,'<?php echo $shops->annuity_id;?>')" href="javascript:;" title="通过审核">
							<i class="Hui-iconfont">&#xe6e1;</i>
						</a> 
					<?php endif;?>
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
		var shops = new Object(); 
	    shops.infoType = 'shops';
	    shops.id = id;
	    shops.status = 1;
	    dataHandler('/common/modifyInfo',shops,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
			$(obj).remove();
			layer.msg('已停用!',{icon: 5,time:1000});
		},false,false);
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认通过审核吗？',function(index){
		var shops = new Object(); 
	    shops.infoType = 'annual';
	    shops.id = id;
	    shops.annuity_status = 1;
	    dataHandler('/common/modifyInfo',shops,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已审核</span>');
			$(obj).remove();
			layer.msg('已审核!',{icon: 6,time:1000});
		},false,false);
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url,w,h);	
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var shops = new Object(); 
	    shops.infoType = 'shops';
	    shops.id = id;
		dataHandler('/common/deleteInfo',shops,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}
/*shops-批量删除*/
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
	    var shopss = new Object();
	    shopss.infoType = 'shopss';
	    shopss.idArray = memberArray;
	    dataHandler("/common/deleteBulkInfo",shopss,null,null,null,function(){
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