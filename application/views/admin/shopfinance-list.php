<title>商铺提现审核</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 提现管理 <span class="c-gray en">&gt;</span> 商铺提现审核 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
		</span>  	
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="120">提现编号</th>
				<th width="120">店铺名称</th>
				<th width="120">提现类型</th>
				<th width="120">收款账号主人真实姓名</th>
				<th width="120">收款账号</th>
				<th width="120">提现金额</th>
				<th width="120">提现时间</th>
				<th width="120">状态</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($admins as $buyer):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $buyer->id;?>" name="id"></td>
				

				<td>
					<?php if(!empty($buyer->cash_id)):?>
						<?php echo $buyer->cash_id;?>
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($buyer->usershop->shop_name) && !empty($buyer->usershop->shop_branch_name)):?>
						<?php echo $buyer->usershop->shop_name;?> - <?php echo $buyer->usershop->shop_branch_name;?>
					<?php elseif(!empty($buyer->usershop->shop_name)):?>
						<?php echo $buyer->usershop->shop_name;?>
					<?php elseif(!empty($buyer->usershop->shop_branch_name)):?>	
						<?php echo $buyer->usershop->shop_branch_name;?>
				    <?php endif;?>
				</td>


				<td>
					<?php if(!empty($buyer->cash_type)):?>
						<?php if(($buyer->cash_type) == 1):?>
						支付宝
				        <?php else:?>
				        微信
				        <?php endif;?>
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($buyer->cash_account_owner_name)):?>
						<?php echo $buyer->cash_account_owner_name;?>
					
				    <?php endif;?>
				</td>
			
			
				<td>
					<?php if(!empty($buyer->cash_account_account)):?>
						<?php echo $buyer->cash_account_account;?>
					<?php endif;?>
				</td>
				<td>
					<?php if(!empty($buyer->cash_money)):?>
						<?php echo $buyer->cash_money;?>
				
					<?php endif;?>
				</td>
				<td>
					<?php if(!empty($buyer->cash_time)):?>
						<?php echo $buyer->cash_time;?>
				
					<?php endif;?>
				</td>
				

				<?php if($buyer->cash_status=='1'):?>
					<td class="td-status"><span class="label label-defaunt radius">审核中</span></td>
				<?php elseif($buyer->cash_status=='2'):?>
					<td class="td-status"><span class="label label-success radius">已审核</span></td>
				<?php elseif($buyer->cash_status=='3'):?>
					<td class="td-status"><span class="label label-success radius">审核失败</span></td>
				<?php elseif($buyer->cash_status=='4'):?>
					<td class="td-status"><span class="label label-success radius">付款成功</span></td>	
				<?php elseif($buyer->cash_status=='5'):?>
					<td class="td-status"><span class="label label-success radius">付款失败</span></td>			
				<?php endif;?>

				<td class="category-manage">
				<!--修改状态-->
				<?php if($buyer->cash_status=='1'):?>
					<a style="text-decoration:none" onClick="member_start(this,'<?php echo $buyer->id;?>')" href="javascript:;" title="通过审核">
						<i class="Hui-iconfont">&#xe6e1;</i>
					</a> 
					<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $buyer->id;?>')" href="javascript:;" title="不通过">
						<i class="Hui-iconfont">&#xe631;</i>
					</a> 
				<?php elseif ($buyer->cash_status=='2'): ?>		
					<a style="text-decoration:none" onClick="pay_edit('付款','/admin/getcashout','<?php echo $buyer->id;?>','800','650')" href="javascript:;" title="付款">
						<i class="Hui-iconfont">&#xe6e1;</i>
					</a> 
					<a style="text-decoration:none" onClick="pay_stop(this,'<?php echo $buyer->id;?>')" href="javascript:;" title="拒绝付款">
						<i class="Hui-iconfont">&#xe631;</i>
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
		"aaSorting": [[ 4, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0]}// 制定列不参与排序
		]
	});

});

/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认不通过审核吗？',function(index){
		var category = new Object(); 
	    category.infoType = 'finance';
	    category.id = id;
	    category.status = 3;
	    category.cash_status_desc = '审核失败';
	    dataHandler('/common/modifyInfo',category,null,null,null,function(){
			
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">审核失败</span>');
			$(obj).remove();
			layer.msg('已审核!',{icon: 5,time:1000});
		},false,false);
		 location.reload();
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认审核通过吗？',function(index){
		var category = new Object(); 
	    category.infoType = 'finance';
	    category.id = id;
	    category.status = 2;
	    category.cash_status_desc = '审核通过';
	    dataHandler('/common/modifyInfo',category,null,null,null,function(){
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">审核通过</span>');
			$(obj).remove();
			layer.msg('已审核!',{icon: 6,time:1000});
		},false,false);
		location.reload();
	});
}
/*
	对审核通过的提现申请付款
*/
// function pay_start(obj,id){
// 	layer.confirm('确认付款吗？',function(index){
// 		var category = new Object(); 
// 	    category.infoType = 'pay';
// 	    category.id = id;
// 	 //    $.post(
// 		// '/common/modifyInfo',
// 		// {
// 		// 	'data':JSON.stringify(category)
// 		// },
// 		function(data)
// 		{
// 			var result=eval("(" + data + ")");
// 			//var result=data;
			
// 			console.log(result);
// 			if(result.result=="success")
// 			{
// 				if(successMsg) showMsg(successMsg);
// 				if(callBack) callBack(result.message);
// 				if(refresh) location.reload();
// 			}
// 			else
// 			{
// 				alert(result.result);
// 			}
// 		});
// 		location.reload();
// 	});
// }

function pay_start(obj,id){
	layer.confirm('确认审核通过吗？',function(index){
		var category = new Object(); 
	    category.infoType = 'pay';
        category.id = id;
	    category.cash_status_desc = '审核通过';
	    dataHandler('/common/modifyInfo',category,null,null,null,function(){
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已付款</span>');
			$(obj).remove();
			layer.msg('已付款!',{icon: 6,time:1000});
		},false,false);
		location.reload();
	});
}
/*
	拒绝对审核通过的提现申请付款
*/
function pay_spot(obj,id){
	layer.confirm('确认拒绝付款吗？',function(index){
		var category = new Object(); 
	    category.infoType = 'finance';
	    category.id = id;
	    category.status = 5;
	    category.cash_status_desc = '付款失败';
	    dataHandler('/common/modifyInfo',category,null,null,null,function(){
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">付款失败</span>');
			$(obj).remove();
			layer.msg('已拒绝付款!',{icon: 4,time:1000});
		},false,false);
		location.reload();
	});
}
/*添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}

/*编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*添加分类特征*/
function feature_add(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*编辑*/
function pay_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
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