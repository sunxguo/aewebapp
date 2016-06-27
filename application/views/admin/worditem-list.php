<title>商品轮播图片查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
  <dl style="margin-left:80px; color:#fff">
    <!-- <dt><span class="f-18"><?php echo $activity[0]->shop->shop_name;?>-<?php echo $activity[0]->shop->shop_branch_name;?></span></dt> -->   
  </dl>
</div>
<div class="pd-20">
  <table class="table table-border table-bordered table-hover table-bg table-sort">
      <thead>
        <tr class="text-c">
          <th width="25"><input type="checkbox" name="id" value=""></th>
          <th width="80">口令分类详情内容</th>
          <th width="80">添加时间</th>
          <th width="80">修改时间</th>  
          <th width="100">操作</th>

        </tr>
    </thead>
    <tbody>
        <?php if(!empty($worditem)):?>
            <?php foreach($worditem as $word):?>
              <tr class="text-c">
                <td><input type="checkbox" value="<?php echo $word->wordItemId;?>" name="id"></td>
                <td><?php echo $word->wordItemName;?></td>
                <td><?php echo $word->wordItemAddtime;?></td>
                <td><?php echo $word->wordItemEdittime;?></td>
                <td>
	                <a title="编辑" href="javascript:;" onclick="member_edit('修改口令分类','/admin/worditemedit','<?php echo $word->wordItemId;?>','','550')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a> 

					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $word->wordItemId;?>')" class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>	
              </tr>
            <?php endforeach;?>
      <?php else:?>
        <tr class="text-c">
          <td colspan="11">暂无分类详情</td>
        </tr>
      <?php endif;?>
    </tbody>
  </table>
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
});



/*用户-编辑*/
function member_edit(title,url,id,w,h){
	//alert(id);
	layer_show(title,url+'?itemId='+id,w,h);
}

/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var item = new Object(); 
	    item.infoType = 'worditem';
	    item.id = id;
		dataHandler('/common/deleteInfo',item,null,null,null,function(){
			$(obj).parents("tr").remove();
			layer.msg('已删除!',{icon:1,time:1000});
		},false,false);
	});
}

</script> 
</body>
</html>