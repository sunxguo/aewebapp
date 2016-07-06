<title>消费流水</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 流水管理 <span class="c-gray en">&gt;</span>消费流水 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
				<th width="80">店铺名称</th>
				<th width="80">消费类型</th>
				<th width="80">消费类型名称</th>
				<th width="80">消费金额</th>
				<th width="80">+或-</th>
				<th width="130">消费时间</th>
			
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($expense as $buyer):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $buyer->id;?>" name="id"></td>
				
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
					<?php if(!empty($buyer->expense_type)):?>
						<?php echo $buyer->expense_type;?>
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($buyer->expense_name)):?>
						<?php echo $buyer->expense_name;?>
					
				    <?php endif;?>
				</td>

				
				<td>
					<?php if(!empty($buyer->expense_money)):?>
						<?php echo $buyer->expense_money;?>
				
				    <?php endif;?>
				</td>


				<td>
					<?php if(!empty($buyer->expense_modified)):?>
						<?php echo $buyer->expense_modified;?>
				
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($buyer->expense_time)):?>
						<?php echo $buyer->expense_time;?>
					
				    <?php endif;?>
				</td>
				
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