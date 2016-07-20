<title>优惠活动</title>
<style>
.p1{
text-align: center;
text-overflow: -o-ellipsis-lastline;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;
}
</style>
</head>
<body>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i>
      首页 <span class="c-gray en">&gt;</span> 
      优惠活动 <span class="c-gray en">&gt;</span> 
      活动列表 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
    <i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="text-c">
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="80">店铺</th>
				<th width="10%">活动标题</th>
				<th width="60">活动简介图</th>
				<th width="60">活动关键字</th>
				<th width="20%">内容</th>
				<th width="80">有效期始</th>
				<th width="80">有效期止</th>
				<th width="5%">状态</th>
				<th width="5%">关键字审核状态</th>
				
			</tr>
		</thead>
		<tbody>

			<?php foreach($activity as $coupon):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $coupon->activity_id;?>" name="id"></td>
				<td><?php if(!empty($coupon->usershop->shop_name) && !empty($coupon->usershop->shop_name)):?>
				 		<?php echo $coupon->usershop->shop_name.' - '.$coupon->usershop->shop_branch_name;?>
                    <?php else:?>
                    	暂无店铺数据
                    <?php endif;?>	
				</td>
				
				<td><?php echo $coupon->activity_name;?></td>
				<td><img src="<?php echo $coupon->thumbnail1;?>" width="50"></td>
				<td><?php echo $coupon->activity_keyword;?></td>
				<td><div class="p1"style="height:34px;" title="<?php echo $coupon->content;?>"><?php echo $coupon->content;?></div></td>
				<td><?php echo $coupon->addtime;?></td>
				<td><?php echo $coupon->dittime;?></td>
                
				<?php if($coupon->status=='0'):?>
					<td class="td-status"><span class="label label-defaunt radius">待发布</span></td>
				<?php elseif($coupon->status=='1'):?>
					<td class="td-status"><span class="label label-success radius">进行中</span></td>
				<?php elseif($coupon->status=='2'):?>
					<td class="td-status"><span class="label label-defaunt radius">已过期</span></td>
                <?php else:?>
                    <td class="td-status"><span class="label label-defaunt radius">关键字审核中</span></td>
				<?php endif;?>
				<?php if($coupon->audit_status=='0'):?>
					<td class="td-status"><span class="label label-defaunt radius">审核中</span></td>
				<?php else:?>
					<td class="td-status"><span class="label label-success radius">已审核</span></td>	
				<?php endif;?>
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
	$('.table-sort tbody').on( 'click', 'tr', function (){
		if ( $(this).hasClass('selected') ) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});
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
	    coupon.status = 1;
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
	    seller.infoType = 'seller';
	    seller.id = id;
	    seller.status = 0;
	    dataHandler('/common/modifyInfo',seller,null,null,null,function(){
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
	layer_show(title,url+'?id='+id,w,h);	
}
/*优惠活动-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var activity = new Object(); 
	    activity.infoType = 'activity';
	    activity.id = id;
		dataHandler('/common/deleteInfo',activity,null,null,null,function(){
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
       layer.alert('请选择要删除的优惠活动！');
        return false;
    }
	layer.confirm('确认要删除这些优惠活动吗？',function(index){
	    var activity = new Object();
	    activity.infoType = 'activity';
	    activity.idArray = memberArray;
	    dataHandler("/common/deleteBulkInfo",activity,null,null,null,function(){
	    	$("input[name='id']:checked").each(function(){
		        $(this).parents("tr").remove();
		    });
			layer.msg('已删除!',{icon:1,time:1000});
	    },false,false);
	});
}
//custom_query
//修改活动状态
function updatestatus(obj,id,status,sid)
{
	// alert(status);
     layer.confirm('确认要修改状态吗？',function(index)
     {

        var activity =new Object();
        activity.infoType = 'activity';
        activity.id = id;
        activity.status = status;
        activity.sid = sid;
        dataHandler("/common/updatestatu",activity,null,null,null,function(){
	    	$("input[name='id']:checked").each(function(){
		        $(this).parents("tr").remove();
		    });
			layer.msg('已修改!',{icon:1,time:1000});
	    },false,false);
	    location.reload();
     });
}



</script> 
</body>
</html>