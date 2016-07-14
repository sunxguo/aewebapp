<title>口令集</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 插件管理 <span class="c-gray en">&gt;</span> 口令集 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">

	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="javascript:;" onclick="member_add('添加口令集','/admin/getWordlistadd?count=add','','550')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i>自定义发布</a>
			<a href="javascript:;" onclick="member_add('添加口令集','/admin/getWordlistadd?count=select','','550')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i>用平台口令发布</a>
		</span> 
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>
	<div class="mt-20">
	
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="id" value=""></th>
				<th width="100">口令集id</th>
				<th width="120">口令折扣</th>
				<th width="80">口令商品</th>
				<th width="80">商品原价</th>
				<th width="80">口令内容</th>
				<th width="80">有效期始</th>
				<th width="80">有效期止</th>
				<th width="80">添加时间</th>
				<th width="80">修改时间</th>
				<th width="50">审核状态</th>
				<th width="50">状态</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($getwordlist as $word):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $word->word_id;?>" name="id"></td>
				<td><?php echo $word->word_id;?></td>
				<td><?php echo $word->word_discount;?></td>
				<td><?php echo $word->word_good;?></td>
				<td><?php echo $word->word_prime_cost;?></td>
				<td><?php echo $word->count->word_item_name;?></td>
				<td><?php echo $word->word_begintime;?></td>
				<td><?php echo $word->word_endtime;?></td>
				<td><?php echo $word->word_addtime;?></td>
				<td><?php echo $word->word_eidttime;?></td>

				<?php if($word->audit_status=='0'):?>
				<td class="td-status"><span class="label label-defaunt radius">审核中</span></td>
				<?php else:?>
				<td class="td-status"><span class="label label-success radius">已审核</span></td>
				<?php endif;?>

				<?php if($word->word_status=='0'):?>
				<td class="td-status"><span class="label label-defaunt radius">待发布</span></td>
				<?php elseif($word->word_status=='1'):?>
				<td class="td-status"><span class="label label-success radius">已发布</span></td>
				<?php elseif($word->word_status=='2'):?>
				<td class="td-status"><span class="label label-defaunt radius">已过期</span></td>
				<?php endif;?>
				<td class="td-manage">
				    
					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $word->word_id;?>')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
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
	layer_show(title,url,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		var word = new Object(); 
	    word.infoType = 'word';
	    word.id = id;
	    word.status = 1;
	    dataHandler('/common/modifyInfo',word,null,null,null,function(){
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
		var word = new Object(); 
	    word.infoType = 'word';
	    word.id = id;
	    word.status = 0;
	    dataHandler('/common/modifyInfo',word,null,null,null,function(){
			//$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
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
	layer.confirm('确认要删除吗？',function(index){
		var word = new Object(); 
	    word.infoType = 'word';
	    word.id = id;
		dataHandler('/common/updateproducts',word,null,null,null,function(){
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
       layer.alert('请选择要删除的商品！');
        return false;
    }
	layer.confirm('确认要删除这些商品吗？',function(index){
	    var products = new Object();
	    products.infoType = 'products';
	    products.idArray = memberArray;
	    
	    dataHandler("/common/updateBulkInfo",products,null,null,null,function(){
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