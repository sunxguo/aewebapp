<title>口令分类</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 附近管理 <span class="c-gray en">&gt;</span> 口令分类 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	    <span class="l">
			<a href="javascript:;" onclick="member_add('添加口令分类','/admin/wordsortadd','','550')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a>
		</span> 	
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>

	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="5%"><input type="checkbox" name="id" value=""></th>
				<th>口令分类名称</th>
				<th width="10%">查看分类详情</th>
				<th width="10%">状态</th>
				<th width="10%">操作</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($wordsort as $shop):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $shop->wordSortId;?>" id="wordSortId" name="id"></td>

				<td>
					<?php if(!empty($shop->wordSortName)):?>
						<?php echo $shop->wordSortName;?>
				    <?php endif;?>
				</td>

				<td>
                	<u style="cursor:pointer" class="text-primary" onclick="member_show('商铺活动信息','/admin/worditemlist','<?php echo $shop->wordSortId;?>','1200','500')">查看分类详情</u>
                </td>
				
				
				<?php if($shop->wordSortStatus=='0'):?>
						<td class="td-status">
							<span class="label label-success radius">已启用</span>
						</td>
				<?php else:?>
						<td class="td-status">
							<span class="label label-defaunt radius">未启用</span>
						</td>
				<?php endif;?>
                
				<td class="td-manage">
				        <?php if($shop->wordSortStatus=='0'):?>
							<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $shop->wordSortId;?>')" href="javascript:;" title="停用">
								<i class="Hui-iconfont">&#xe631;</i>
							</a> 
						<?php else:?>
							<a style="text-decoration:none" onClick="member_start(this,'<?php echo $shop->wordSortId;?>')" href="javascript:;" title="启用">
								<i class="Hui-iconfont">&#xe6e1;</i>
							</a> 
						<?php endif;?>
					    <a title="添加口令详情" href="javascript:;" onclick="member_add('添加口令详情','/admin/worditemadd','<?php echo $shop->wordSortId;?>','','550')" class="ml-5" style="text-decoration:none">
							<i class="Hui-iconfont">&#xe603;</i>
						</a> 

						<a title="编辑" href="javascript:;" onclick="member_edit('修改口令分类','/admin/wordsortedit','<?php echo $shop->wordSortId;?>','','550')" class="ml-5" style="text-decoration:none">
							<i class="Hui-iconfont">&#xe6df;</i>
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
		"aaSorting": [[ 0, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0]}// 制定列不参与排序
		]
	});
});
/*用户-添加*/
function member_add(title,url,stor_id,w,h){
	layer_show(title,url+'?wordId='+stor_id,w,h);
}
/*用户-查看*/
function member_show(title,url,stor_id,w,h){

	layer_show(title,url+'?wordid='+stor_id,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		var word = new Object(); 
	    word.infoType = 'wordsort';
	    word.wordSortId = id;
	    word.word_sort_status = 1;
	    dataHandler('/common/modifyInfo',word,null,null,null,function(){
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
		var word = new Object(); 
	    word.infoType = 'wordsort';
	    word.wordSortId = id;
	    word.word_sort_status = 0;
	    dataHandler('/common/modifyInfo',word,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
			$(obj).remove();
			layer.msg('已启用!',{icon: 6,time:1000});
		},false,false);
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	//alert(id);
	layer_show(title,url+'?wordId='+id,w,h);
}

/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var shop = new Object(); 
	    shop.infoType = 'admin';
	    shop.id = id;
		dataHandler('/common/deleteInfo',shop,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}
/*shop-批量删除*/
function member_del_bulk(){
	var memberArray = new Array();
    $("input[name='id']:checked").each(function(){
        memberArray.push($(this).val()); 
    });
    if(memberArray.length<1){
       layer.alert('请选择要删除的用户！');
        return false;
    }
	layer.confirm('确认要删除这些用户吗？',function(index){
	    var buyers = new Object();
	    buyers.infoType = 'buyers';
	    buyers.idArray = memberArray;
	    dataHandler("/common/deleteBulkInfo",buyers,null,null,null,function(){
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