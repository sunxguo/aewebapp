<title>收藏用户列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 关注管理 <span class="c-gray en">&gt;</span> 收藏用户列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	 
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
			<span class="r">共有数据�?strong><?php echo $pageInfo['amount'];?></strong> �?/span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">用户昵称</th>
				<th width="100">收藏时间</th>
				<th width="100">取消时间</th>
				<th width="70">状�?/th>
				
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($useries as $user):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $user->collect_id;?>" name="id"></td>

				<td>
					<?php if(!empty($user->username->user_nickname)):?>
						<?php echo $user->username->user_nickname;?>
					<?php else:?>
				    	暂无用户昵称
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($user->collect_addtime)):?>
						<?php echo $user->collect_addtime;?>
				    <?php endif;?>
				</td>
			
			
				<td>
					<?php if(!empty($user->collect_edittime)):?>
						<?php echo $user->collect_edittime;?>
					<?php endif;?>
				</td>
			
				<?php if($user->collect_status=='1'):?>
				<td class="td-status"><span class="label label-success radius">已收�?/span></td>
				<?php else:?>
				<td class="td-status"><span class="label label-defaunt radius">取消收藏</span></td>
				<?php endif;?>
				
				
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	</div>
</div>
<script type="text/javascript" src="/assets/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 8, "desc" ]],//默认第几个排�?
		"bStateSave": true,//状态保�?
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

/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要取消收藏吗�?,function(index){
		var collect = new Object(); 
	    collect.infoType = 'collect';
	    collect.collect_id = id;
	    collect.collect_status = 0;
	    //alert(collect.collect_status);
	    dataHandler('/common/modifyInfo',collect,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="收藏"><i class="Hui-iconfont">&#xe6e1;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">取消收藏</span>');
			$(obj).remove();
			layer.msg('已取消收�?',{icon: 5,time:1000});
		},false,false);
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要收藏吗�?,function(index){
		var collect = new Object(); 
	    collect.infoType = 'collect';
	    collect.collect_id = id;
	    collect.collect_status = 1;
	    dataHandler('/common/modifyInfo',collect,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="取消收藏"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已收�?/span>');
			$(obj).remove();
			layer.msg('已收�?',{icon: 6,time:1000});
		},false,false);
	});
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗�?,function(index){
		var user = new Object(); 
	    user.infoType = 'shopadmin';
	    user.id = id;
		dataHandler('/common/deleteInfo',user,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删�?',{icon:1,time:1000});
		},false,false);
	});
}
/*user-批量删除*/
function member_del_bulk(){
	var memberArray = new Array();
    $("input[name='id']:checked").each(function(){
        memberArray.push($(this).val()); 
    });
    if(memberArray.length<1){
       layer.alert('请选择要删除的用户�?);
        return false;
    }
	layer.confirm('确认要删除这些用户吗�?,function(index){
	    var buyers = new Object();
	    buyers.infoType = 'buyers';
	    buyers.idArray = memberArray;
	    dataHandler("/common/deleteBulkInfo",buyers,null,null,null,function(){
	    	$("input[name='id']:checked").each(function(){
		        $(this).parents("tr").remove();
		    });
			layer.msg('已删�?',{icon:1,time:1000});
	    },false,false);
	});
}
</script> 
</body>
</html>