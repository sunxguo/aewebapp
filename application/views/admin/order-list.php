<title>订单管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 订单列表 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray mt-20">
	    根据状态查出订单信息
		<select id="orderstatus" onchange="getOrderBystutas()">
			<option value="">全部</option>
			<option value="-1">交易取消</option>
			<option value="1">未付款</option> 
			<option value="2">已付款</option> 
			<option value="3">已发货</option>
			<option value="4">确认收货</option>
		</select>  
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">订单号</th>
				<th width="120">店铺</th>
				<th width="50">用户</th>
				<th width="150">收货地址</th>
				<th width="50">商品</th>
				<th width="30">件数</th>
				<th width="50">运费</th>
				<th width="50">优惠价</th>
				<th width="60">关注减免</th>
				<th width="50">总价</th>
				<th width="70">实际支付</th>
				<th width="80">支付方式</th>
				<th width="150">下单时间</th>
				<th width="150">支付时间</th>
				<th width="150">取消原因</th>
				<th width="60">状态</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($orderlist as $order):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $order->id;?>" name="id"></td>
				<td><?php echo $order->orderId;?></td>
				<td>
					<?php if(isset($order->shopInfo->shopName) && isset($order->shopInfo->shopBranchName)):?>
						<?php echo $order->shopInfo->shopName;?>-<?php echo $order->shopInfo->shopBranchName;?>
					<?php endif;?>
				</td>

				<td>
					<?php if(isset($order->deliveryInfo->deliveryName)):?>
                         <?php echo $order->deliveryInfo->deliveryName;?>
					<?php endif;?>
				</td>

				<td>
					<?php if(isset($order->deliveryInfo->deliveryDetailedarea)):?>
                         <?php echo $order->deliveryInfo->deliveryDetailedarea;?>
					<?php endif;?>	
				</td>

				<td>
					<?php if(isset($order->orderItemList[0]->goodsList->name)):?>
						<?php echo $order->orderItemList[0]->goodsList->name;?>
					<?php endif;?>	
				</td>
				
				<td>
					<?php if(isset($order->orderItemList[0]->itemCount)):?>
                         <?php echo $order->orderItemList[0]->itemCount;?>
					<?php endif;?>	
				</td>

				<td>
					<?php if(isset($order->orderExpressFee)):?>
                         <?php echo '￥'.$order->orderExpressFee;?>
                    <?php else:?>   
                        ￥ 0  
					<?php endif;?>	
				</td>

				<td>
					<?php if(isset($order->orderDiscount)):?>
                         <?php echo '￥'.$order->orderDiscount;?>
                    <?php else:?>   
                        ￥ 0  
					<?php endif;?>	
				</td>

				<td>
					<?php if(isset($order->orderFollowBreaks)):?>
                         <?php echo '￥'.$order->orderFollowBreaks;?>
                    <?php else:?>   
                        ￥ 0  
					<?php endif;?>
				</td>

				<td>
					<?php if(isset($order->orderTotalprice)):?>
                         <?php echo '￥'.$order->orderTotalprice;?>
                    <?php else:?>   
                        ￥ 0  
					<?php endif;?>	
				</td>

				<td>
					<?php if(isset($order->orderActualpay)):?>
                         <?php echo '￥'.$order->orderActualpay;?>
                    <?php else:?>   
                        ￥ 0  
					<?php endif;?>	
				</td>
				

				<td>
					<?php if(!empty($order->orderPaymentmethod)):?>
                         <?php echo $order->orderPaymentmethod;?>
					<?php endif;?>	
				</td>
				
				<td>
					<?php if(isset($order->orderAddtime)):?>
                         <?php echo $order->orderAddtime;?>
					<?php endif;?>	
				</td>

				<td>
					<?php if(isset($order->orderPaymenttime)):?>
                         <?php echo $order->orderPaymenttime;?>
					<?php endif;?>	
				</td>

				<td>
					<?php if(isset($order->orderCancelreason)):?>
                         <?php echo $order->orderCancelreason;?>
					<?php endif;?>	
				</td>

				<td>
					<?php if(isset($order->orderStatus)):?>
						<?php if($order->orderStatus == -1):?>
                          	交易取消
                        <?php elseif($order->orderStatus == 1):?>
                            未付款
                        <?php elseif($order->orderStatus == 2):?>
                            已付款
                        <?php elseif($order->orderStatus == 3):?>
                            已发货
                        <?php elseif($order->orderStatus == 4):?>
                            确认收货        
                        <?php endif;?>  
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
		"aaSorting": [[ 10, "desc" ]],//默认第几个排序
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
	layer.confirm('确认要下架吗？',function(index){
		var product = new Object(); 
	    product.infoType = 'product';
	    product.id = id;
	    product.status = 1;
	    dataHandler('/common/modifyInfo',product,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="上架"><i class="Hui-iconfont">&#xe603;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
			$(obj).remove();
			layer.msg('已下架!',{icon: 5,time:1000});
		},false,false);
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		var product = new Object(); 
	    product.infoType = 'product';
	    product.id = id;
	    product.status = 0;
	    dataHandler('/common/modifyInfo',product,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已上架</span>');
			$(obj).remove();
			layer.msg('已上架!',{icon: 6,time:1000});
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
	layer.alert('为保证数据完整与安全性，暂不提供订单删除功能！');
	// layer.confirm('确认要删除吗？',function(index){
	// 	var order = new Object(); 
	//     order.infoType = 'order';
	//     order.id = id;
	// 	dataHandler('/common/deleteInfo',order,null,null,null,function(){
	// 		$(obj).parents("tr").remove();
	// 		layer.msg('已删除!',{icon:1,time:1000});
	// 	},false,false);
	// });
}
/*seller-批量删除*/
function member_del_bulk(){
	layer.alert('为保证数据完整与安全性，暂不提供订单删除功能！');
	// var memberArray = new Array();
 //    $("input[name='id']:checked").each(function(){
 //        memberArray.push($(this).val()); 
 //    });
 //    if(memberArray.length<1){
 //       layer.alert('请选择要删除的订单！');
 //        return false;
 //    }
	// layer.confirm('确认要删除这些订单吗？',function(index){
	//     var orders = new Object();
	//     orders.infoType = 'orders';
	//     orders.idArray = memberArray;
	//     dataHandler("/common/deleteBulkInfo",orders,null,null,null,function(){
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