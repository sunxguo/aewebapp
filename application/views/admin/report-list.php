<title>举报的店铺</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 店铺管理 <span class="c-gray en">&gt;</span> 举报的店铺 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">举报用户</th>
				<th width="150">举报的店铺</th>	
				<th width="100">举报次数</th>
				
			</tr>
		</thead>
		<tbody>
			<?php foreach($report as $buyer):?>
				
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $buyer->report_id;?>" name="id"></td>

				<td>
					<?php if(!empty($buyer->user->user_name)):?>
						<?php echo $buyer->user->user_name;?>
				    <?php endif;?>
				</td>
                
				<td>
	                
                    <u style="cursor:pointer" class="text-primary" 
                    onclick="member_show('商铺举报信息','/admin/getReportDetail','<?php echo $buyer->report_shop_id;?>','1300','700')">
                    <?php if(!empty($buyer->usershop->shop_name) && !empty($buyer->usershop->shop_branch_name)):?>
						<?php echo $buyer->usershop->shop_name;?> - <?php echo $buyer->usershop->shop_branch_name;?>
				    <?php elseif(!empty($buyer->usershop->shop_name)):?>
				    	<?php echo $buyer->usershop->shop_name;?>
				    <?php elseif(!empty($buyer->usershop->shop_branch_name)):?>
				    	<?php echo $buyer->usershop->shop_branch_name;?>	
				    <?php endif;?>
                    </u>
			    </td>

				<td>
					<?php if(!empty($buyer->sumcount)):?>
						<?php echo $buyer->sumcount;?>
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
		"aaSorting": [[ 0, "desc" ]],//默认第几个排序
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
/*查看举报详情*/
function member_show(title,url,shop_id,w,h){

	layer_show(title,url+'?phone='+shop_id,w,h);
}
</script> 
</body>
</html>