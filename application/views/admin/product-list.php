<title>商品管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 商品列表 <a class="btn btn-success radius r mr-20 btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="text-c">
	</div>
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
				<th width="100">商品名</th>
				<th width="120">商品详细名</th>
				<th width="80">商品图片</th>
				<th width="80">商品分类</th>
				<th width="80">店铺名</th>
				<th width="80">价格</th>
				<th width="80">简介</th>
				<th width="80">销量</th>
				<th width="50">状态</th>
				<th width="50">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($products as $product):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $product->goodsId;?>" name="id"/></td>
				<td><?php echo $product->name;?></td>
				<td><?php echo $product->detailedname;?></td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('商品图片信息','/admin/goodsPic','<?php echo $product->goodsId;?>','450','650')"><img src="<?php echo $product->pic1?>" width="100"></u></td>
				<td><?php if(!empty($product->goodsCategory->name)):?>
				    	<?php echo $product->goodsCategory->name;?>
				    <?php else:?>
				         暂无分类
				    <?php endif;?>     	
				</td>
				<td>
                    <?php if($product->shopInfo):?>
				    <?php echo $product->shopInfo->shopName;?>
                  
                    <?php endif;?>
                    --
                    <?php if($product->shopInfo):?>
                    <?php echo $product->shopInfo->shopBranchName;?>
                    <?php endif;?>
				</td>
				<td>￥ <?php echo $product->price;?></td>
				<td><?php echo $product->description;?></td>
				<td><?php echo $product->sales;?></td>
				<?php if($product->status=='0'):?>
					<td class="td-status"><span class="label label-success radius">已上架</span></td>
				<?php elseif($product->status=='1'):?>
					<td class="td-status"><span class="label label-defaunt radius">已下架</span></td>
				<?php elseif($product->status=='2'):?>
					<td class="td-status"><span class="label label-defaunt radius">未审核</span></td>
				<?php elseif($product->status=='3'):?>
					<td class="td-status"><span class="label label-defaunt radius">已审核</span></td>
				<?php endif;?>
                <td class="td-manage">
                <?php if($product->status=='0'):?>
					<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $product->goodsId;?>')" href="javascript:;" title="停用">
							<i class="Hui-iconfont">&#xe631;</i>
					</a> 
				<?php elseif($product->status=='1'):?>
					<a style="text-decoration:none" onClick="member_start(this,'<?php echo $product->goodsId;?>')" href="javascript:;" title="启用">
							<i class="Hui-iconfont">&#xe6e1;</i>
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
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url+'?goodsid='+id,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		var product = new Object(); 
	    product.infoType = 'product';
	    product.goodsId = id;
	    product.status = 1;
	    dataHandler('/common/modifyInfo',product,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="上架"><i class="Hui-iconfont">&#xe6e1;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
			$(obj).remove();
			layer.msg('已下架!',{icon: 5,time:1000});
		},false,false);
        location.reload();
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		var product = new Object(); 
	    product.infoType = 'product';
	    product.goodsId = id;
	    product.status = 0;
	    dataHandler('/common/modifyInfo',product,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已上架</span>');
			$(obj).remove();
			layer.msg('已上架!',{icon: 6,time:1000});
		},false,false);
        location.reload();
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
		var product = new Object(); 
	    product.infoType = 'product';
	    product.id = id;
		dataHandler('/common/updateproducts',product,null,null,null,function(){
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