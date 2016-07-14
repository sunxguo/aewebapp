<title>商品特征查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#BB0614">
  <dl style="text-align:center; color:#fff">
    <dt><span class="f-18"><?php echo $shopdata->shopName;?>-<?php echo $shopdata->shopBranchName;?></span>
  </dl>
</div>
<div class="pd-20">
  <table class="table">
  <thead>
    <tr>
        <th>商品特征</th><th>商品特征可选值</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach($featureData as $cate):?>
      <tr>
        <td>
              <?php echo $cate['featureName'];?>
        </td>
        <td>
             <?php foreach($cate['eigenvalueList'] as $val):?>
            <input type="checkbox" name="category[]" id="category" 
            <?php foreach($checkFeatureData as $data):?>
            <?php if($goodsid==$data['goodsId']&&$data['featureId']==$cate['featureId']&&in_array($val['eigenId'],$featureValId)){?>checked="checked"<?php }?>
            <?php endforeach;?> 
            onclick="member_start(this,'<?php echo $val['eigenId']?>','<?php echo $goodsid?>','<?php echo $cate['featureId']?>')"/><?php echo $val['eigenName']?>
            <?php endforeach;?> 
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
    /*修改商品属性值*/
    function member_start(obj,eigenId,goodsid,featureId){
        var url;
		var product = new Object(); 
	    product.eigenId = eigenId;
	    product.goodsid = goodsid;
        product.featureId = featureId;
        if(obj.checked){
            product.infoType = 'feature';
        }else{
            product.infoType = 'delFeature';
        }
        $.post('/common/modifyInfo',{'data':JSON.stringify(product)},
		function(data)
		{
			var result=eval("(" + data + ")");
			//console.log(result);
			if(result.result=="success")
			{
				//if(successMsg) showMsg(successMsg);
//				if(callBack) callBack(result.message);
//				if(refresh) location.reload();
			}
			else
			{
				alert(result.message);
                console.log(result.message);
			}
		});
    }
</script>
</body>
</html>