<title>提现流水</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 流水管理 <span class="c-gray en">&gt;</span>提现流水 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
				<th width="80">提现编号</th>
				<th width="80">收款账户</th>
				<th width="80">提现类型</th>
				<th width="80">提款账号真实姓名</th>
				<th width="100">提现金额</th>
				<th width="100">提现后账户余额</th>
				<th width="130">提现时间</th>
				<!-- <th width="130">审核状态说明</th> -->
				<th width="130">平台返回信息</th>
				<th width="70">状态</th>
				<!-- <th width="100">操作</th> -->
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($cashout as $buyer):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $buyer->id;?>" name="id"></td>
				

				<td>
					<?php if(!empty($buyer->cash_id)):?>
						<?php echo $buyer->cash_id;?>
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($buyer->cash_account_account)):?>
						<?php echo $buyer->cash_account_account;?>
					
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
					<?php if(!empty($buyer->cash_money)):?>
						<?php echo $buyer->cash_money;?>
				
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($buyer->cash_balance)):?>
						<?php echo $buyer->cash_balance;?>
					
				    <?php endif;?>
				</td>
			
			
				<td>
					<?php if(!empty($buyer->cash_time)):?>
						<?php echo $buyer->cash_time;?>
					<?php endif;?>
				</td>
				<!-- <td>
					<?php if(!empty($buyer->cash_status_desc)):?>
						<?php echo $buyer->cash_status_desc;?>
				
					<?php endif;?>
				</td> -->
				<td>
					<?php if(!empty($buyer->pay_platform_return)):?>
						<?php echo $buyer->pay_platform_return;?>
				
					<?php endif;?>
				</td>
				

				<?php if($buyer->cash_status=='1'):?>
					<td class="td-status"><span class="label label-defaunt radius">审核中</span></td>
				<?php elseif($buyer->cash_status=='2'):?>
					<td class="td-status"><span class="label label-success radius">审核通过</span></td>
				<?php elseif($buyer->cash_status=='3'):?>
					<td class="td-status"><span class="label label-defaunt radius">审核失败</span></td>	
				<?php elseif($buyer->cash_status=='4'):?>
					<td class="td-status"><span class="label label-success radius">付款成功</span></td>
				<?php elseif($buyer->cash_status=='5'):?>
					<td class="td-status"><span class="label label-defaunt radius">付款失败</span></td>			
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