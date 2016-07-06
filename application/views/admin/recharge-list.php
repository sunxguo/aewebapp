<title>充值流水</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 流水管理 <span class="c-gray en">&gt;</span>充值流水 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
		</span>  
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">充值编号</th>
				<th width="80">充值账户</th>
				<th width="100">充值金额</th>
				<th width="100">充值后账户余额</th>
				<th width="130">充值时间</th>
				<th width="130">平台返回信息</th>
				<th width="70">状态</th>
				<!-- <th width="100">操作</th> -->
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($recharge as $buyer):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $buyer->id;?>" name="id"></td>
				

				<td>
					<?php if(!empty($buyer->recharge_id)):?>
						<?php echo $buyer->recharge_id;?>
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($buyer->recharge_account_id)):?>
						<?php echo $buyer->recharge_account_id;?>
					
				    <?php endif;?>
				</td>


				<td>
					<?php if(!empty($buyer->recharge_money)):?>
						<?php echo $buyer->recharge_money;?>
				
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($buyer->recharge_balance)):?>
						<?php echo $buyer->recharge_balance;?>
					
				    <?php endif;?>
				</td>
			
			
				<td>
					<?php if(!empty($buyer->recharge_time)):?>
						<?php echo $buyer->recharge_time;?>
					<?php endif;?>
				</td>
				<td>
					<?php if(!empty($buyer->pay_platform_return)):?>
						<?php echo $buyer->pay_platform_return;?>
				
					<?php endif;?>
				</td>
				

				<?php if($buyer->recharge_status=='0'):?>
					<td class="td-status"><span class="label label-defaunt radius">未完成</span></td>
				<?php else:?>
					<td class="td-status"><span class="label label-success radius">已完成</span></td>
				<?php endif;?>
				
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	</div>
</div>
<!-- <script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script> -->
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

</script> 
</body>
</html>