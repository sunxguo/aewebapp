<title>店铺管理</title>
<script type="text/javascript" src="/assets/js/jquery.qrcode.min.js"></script>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 店铺管理 <span class="c-gray en">&gt;</span> 审核店铺列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 	
		<span class="r">共有数据：<strong><?php echo $pageInfo['amount'];?></strong> 条</span> 
	</div>

	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="4%"><input type="checkbox" name="id" value=""></th>
				<th width="10%">店铺名称</th>
                <th width="10%">分店名称</th>
				<th width="10%">店铺类型</th>
                <th width="10%">详细地址</th>
                <th width="8%">身份证号</th>
                <th width="10%">商户图片</th> 
                <th>店铺二维码</th> 
                <th width="10%">查看店铺活动</th>
                <th width="10%">店铺详情</th>
				<!-- <th width="130">发送审核消息</th> -->
				<th>操作</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($admins as $shop):?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $shop->shop_id;?>" id="shop_id" name="id"></td>


				<td>
					<?php if(!empty($shop->shop_name)):?>
						<?php echo $shop->shop_name;?>
					<?php else:?>
				    	暂无店名
				    <?php endif;?>
				</td>
                <td>
					<?php if(!empty($shop->shop_branch_name)):?>
						<?php echo $shop->shop_name;?>
					<?php else:?>
				    	暂无分店名
				    <?php endif;?>
				</td>
				<td>
					<?php if(!empty($shop->category->type_name)):?>
						<?php echo $shop->category->type_name;?>
					<?php else:?>
				    	暂无店铺类型
				    <?php endif;?>
				</td>	

			
				<td>
					<?php if(!empty($shop->shop_buinour_name)):?>
						<?php echo $shop->shop_buinour_name;?>
					<?php else:?>
				    	暂无店长姓名
				    <?php endif;?>
				</td>
				<td>
					<?php if(!empty($shop->shop_identity_card)):?>
						<?php echo $shop->shop_identity_card;?>
					<?php else:?>
				    	暂无身份证号码
				    <?php endif;?>
				</td>

				<td>
					<?php if(!empty($shop->shop_identity_card_pic)):?>
						<img src="<?php echo $shop->shop_logo;?>" width="50">
					<?php else:?>
				    	暂无商户图片
				    <?php endif;?>
				</td>
                <td width="15%">
					<?php if(!empty($shop->shop_qrcode)):?>
                    <div class="qrContent" onclick="qrcodeCreate(this)"><?php echo $shop->shop_qrcode;?></div>
					<?php else:?>
				    	暂无商户二维码图片
				    <?php endif;?>
				</td>
				<td>
                	<u style="cursor:pointer" class="text-primary" onclick="member_show('商铺活动信息','/admin/getshopActivity','<?php echo $shop->shop_id;?>','1500','700')">查看商铺活动</u>
                </td>
               

                <td>
                    <u style="cursor:pointer" class="text-primary" onclick="member_show('商铺详情','/admin/getshopDetail','<?php echo $shop->shop_id;?>','350','500')">查看商铺详情</u>
                </td>    
				<!-- <td>
					<u style="cursor:pointer" class="text-primary" onclick="member_show('发送审核消息','/admin/sendMessage','<?$shop->shop_buinour_phone;?>','800','500')">发送审核消息</u>
				</td>
 -->
				<td class="td-manage">
					<?php if($shop->shop_apply=='2'):?>
						<a style="text-decoration:none" onClick="member_start(this,'<?php echo $shop->shop_id;?>')" href="javascript:;" title="通过审核">
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

<script type="text/javascript">
$(function(){
    $('.qrContent').click();
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
function qrcodeCreate(obj){
    //alert($(obj).text());
    var con = $(obj).text();
    $(obj).text('');
    $(obj).qrcode({width:100,height:100,text:utf16to8(con)});
    
}
 function utf16to8(str) {  
    var out, i, len, c;  
    out = "";  
    len = str.length;  
    for(i = 0; i < len; i++) {  
    c = str.charCodeAt(i);  
    if ((c >= 0x0001) && (c <= 0x007F)) {  
        out += str.charAt(i);  
    } else if (c > 0x07FF) {  
        out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));  
        out += String.fromCharCode(0x80 | ((c >>  6) & 0x3F));  
        out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));  
    } else {  
        out += String.fromCharCode(0xC0 | ((c >>  6) & 0x1F));  
        out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));  
    }  
    }  
    return out;  
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,shop_id,w,h){

	layer_show(title,url+'?phone='+shop_id,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		var shop = new Object(); 
	    shop.infoType = 'shop';
	    shop.id = id;
	    shop.status = 1;
	    dataHandler('/common/modifyInfo',shop,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,'+id+')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
			$(obj).remove();
			layer.msg('已停用!',{icon: 5,time:1000});
		},false,false);
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要通过审核吗？',function(index){
		var shop = new Object(); 
	    shop.infoType = 'shop';
	    shop.shopid = id;
	    shop.shopApply = 1;
        shop.shop_audit_status = 1;
	    dataHandler('/common/modifyInfo',shop,null,null,null,function(){
			$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
			$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已审核</span>');
			$(obj).remove();
			layer.msg('已审核!',{icon: 6,time:1000});
		},false,false);
		location.reload();
	});
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
	//alert(id);
	layer_show(title,url+'?shop_id='+id,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
	layer_show(title,url+'?shop_id='+id,w,h);	
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