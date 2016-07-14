<title>优惠券管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 优惠券管理 <span class="c-gray en">&gt;</span> 优惠券列表 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div> 
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">店铺</th>
				<th width="40">面值</th>
				<th width="50">使用条件</th>
				<th width="80">有效期始</th>
				<th width="80">有效期止</th>
				<th width="130">发布状态</th>
				<th width="50">状态</th>
				<th width="80">操作</th>
				
			</tr>
		</thead>
		<tbody>
			<?php foreach($coupons as $coupon):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $coupon->coupon_id;?>" name="id"></td>
				<td><?php echo $coupon->usershop->shop_name.' - '.$coupon->usershop->shop_branch_name;?></td>
				<td><?php echo '￥'.$coupon->coupon_facevalue;?></td>
				<td><?php echo '满￥'.$coupon->coupon_useprice;?></td>
				<td><?php echo $coupon->coupon_beginvalid;?></td>
				<td><?php echo $coupon->coupon_endvalid;?></td>
				<?php if($coupon->coupon_status=='0'):?>
				<td class="td-status"><span class="label label-success radius">待发布</span></td>
				<?php elseif($coupon->coupon_status=='1'):?>
				<td class="td-status"><span class="label label-defaunt radius">发布中</span></td>
                <?php elseif($coupon->coupon_status=='2'):?>
				<td class="td-status"><span class="label label-defaunt radius">已过期</span></td>
                <?php elseif($coupon->coupon_status=='3'):?>
				<td class="td-status"><span class="label label-defaunt radius">审核中</span></td>
				<?php endif;?>
				<?php if($coupon->audit_status=='1'):?>
				<td class="td-status"><span class="label label-success radius">已审核</span></td>
				<?php else:?>
				<td class="td-status"><span class="label label-defaunt radius">审核中</span></td>
				<?php endif;?>
				<td class="td-manage">
					<?php if($coupon->audit_status=='0'):?>
						<a style="text-decoration:none" onClick="member_start(this,'<?php echo $coupon->coupon_id;?>')" href="javascript:;" title="通过审核">
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
		var coupon = new Object(); 
	    coupon.infoType = 'coupon';
	    coupon.id = id;
	    coupon.status = 0;
	    dataHandler('/common/modifyInfo',coupon,null,null,null,function(){
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
	    seller.infoType = 'coupon';
	    seller.id = id;
	    seller.status = 1;
	    dataHandler('/common/modifyInfo',seller,null,null,null,function(){
			//$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
			$(obj).remove();
			layer.msg('已启用!',{icon: 6,time:1000});
		},false,false);
        //location.reload();
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
		var coupon = new Object(); 
	    coupon.infoType = 'coupon';
	    coupon.id = id;
		dataHandler('/common/deleteInfo',coupon,null,null,null,function(){
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
       layer.alert('请选择要删除的优惠券！');
        return false;
    }
	layer.confirm('确认要删除这些优惠券吗？',function(index){
	    var coupons = new Object();
	    coupons.infoType = 'coupons';
	    coupons.idArray = memberArray;
	    dataHandler("/common/deleteBulkInfo",coupons,null,null,null,function(){
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