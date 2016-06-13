<title>活动关键字管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 推荐管理 <span class="c-gray en">&gt;</span>排序管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
  <table class="table table-border table-bordered table-bg mt-20">
    <thead>
      <tr>
        <th colspan="2" scope="col">广告位排序</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th width="200">广告费启用占比</th>
        <td>如果该条件等于0 的话，证明广告费不占比例，如果等于1， 证明广告费全都参与排序，  如果等于0.5，表示广告费一半参与排序，以此类推</td>
      </tr>
      <tr>
        <td>广告费占排序百分比</td>
        <td>该条件不能等于0，如果等于1，证明广告费全都参与排序，如果等于0.5，表示该条件一半参与排序，以此类推</td>
      </tr>
      <tr>
        <td>议价启用占比</td>
        <td>如果该条件等于0 的话，证明议价不占比例，如果等于1， 证明议价全都参与排序，如果等于0.5，表示议价一半参与排序，以此类推</td>
      </tr>
      <tr>
        <td>议价占排序百分比 </td>
        <td>该条件不能等于0，如果等于1，证明议价全都参与排序，如果等于0.5，表示该条件一半参与排序，以此类推</td>
      </tr>
      <tr>
        <td>关注量启用占比 </td>
        <td>如果该条件等于0 的话，证明关注量不占比例，如果等于1， 证明关注量全都参与排序，如果等于0.5，表示关注量一半参与排序，以此类推</td>
      </tr>
      <tr>
        <td>关注量占排序百分比 </td>
        <td>该条件不能等于0，如果等于1，证明关注量全都参与排序，如果等于0.5，表示该条件一半参与排序，以此类推</td>
      </tr>
      <tr>
        <td colspan="2">
	        广告位排序 = 广告费占比	
	        <select id="price_status">
		        <?php for($i=0;$i<=100;$i++):?> 
		            <option value="<?php echo $i/100;?>" <?php echo $sortord->priceStatus==$i/100 ?'selected':'';?>><?php echo $i;?>%</option>
				<?php endfor;?> 
			</select> * 广告费占排序百分比
			<select id="price_percent">
		        <?php for($i=1;$i<=100;$i++):?>
		            <option value="<?php echo $i/100;?>" <?php echo $sortord->pricePercent==$i/100 ?'selected':'';?>><?php echo $i;?>%</option>
				<?php endfor;?> 
			</select> * 广告费 + 议价启用占比
			<select id="bargain_status">
		        <?php for($i=0;$i<=100;$i++):?>
		            <option value="<?php echo $i/100;?>" <?php echo $sortord->bargainStatus==$i/100 ?'selected':'';?>><?php echo $i;?>%</option>
				<?php endfor;?> 
			</select> * 议价占排序百分比
			<select id="bargain_percent">
		        <?php for($i=1;$i<=100;$i++):?>
		            <option value="<?php echo $i/100;?>" <?php echo $sortord->bargainPercent==$i/100 ?'selected':'';?>><?php echo $i;?>%</option>
				<?php endfor;?> 
			</select> * 议价+关注量启用占比
			<select id="care_num_status">
		        <?php for($i=0;$i<=100;$i++):?>
		            <option value="<?php echo $i/100;?>" <?php echo $sortord->careNumStatus==$i/100 ?'selected':'';?>><?php echo $i;?>%</option>
				<?php endfor;?> 
			</select> * 关注量占排序百分比
			<select id="care_num_percent">
		        <?php for($i=1;$i<=100;$i++):?>
		            <option value="<?php echo $i/100;?>" <?php echo $sortord->careNumPercent==$i/100 ?'selected':'';?>><?php echo $i;?>%</option>
				<?php endfor;?>
			</select>  *关注量 
			<a title="编辑"  onclick="updateSortord();" type="submit" style="text-align:center; margin:100px;">
            	<img src="http://127.0.0.1/assets/images/shangpintupian.png" width="70" />
          	</a>
		</td>
   	  </tr>
    </tbody>
    
  </table>
</div>
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 8, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  {"orderable":false,"aTargets":[0]}// 制定列不参与排序
		]
	});
});

/*用户-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?admin_id='+id,w,h);
}

/*修改广告排序规则*/
function updateSortord(callBack)
{
    showWait();
    var sortord = new Object(); 
    sortord.infoType = 'sortord';
    sortord.price_status = $("#price_status").val();
    sortord.price_percent = $("#price_percent").val();
    sortord.bargain_status = $("#bargain_status").val();
    sortord.bargain_percent = $("#bargain_percent").val();
    sortord.care_num_status = $("#care_num_status").val();
    sortord.care_num_percent = $("#care_num_percent").val();
    var method = 'modify';
    dataHandler('/common/'+method+'Info',sortord,null,null,null,function(){
        alert('保存成功！');
        var index = parent.layer.getFrameIndex(window.name);
        parent.window.location.reload();
        parent.layer.close(index);
      },false,false);
}

</script> 
</body>
</html>