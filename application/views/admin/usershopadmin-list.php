<title>店铺信息</title>
</head>
<body>
<div class="pd-20" style="padding-top:20px;">
  <p class="f-20 text-success">店铺信息管理<span class="f-14"></span></p>
  
  <table class="table table-border table-bordered table-bg mt-20">
    <thead>
      <tr>
        <th colspan="2" scope="col" >店铺信息</th>
      </tr>
    </thead>
    <tbody>
     
      <tr>
        <th width="400">店铺名称</th>
        <td><?php echo $shopdata->shopName?> - <?php echo $shopdata->shopBranchName?></td>
      </tr>
       <tr>
        <td style="font-size:bold;">店铺logo图</td>
        <td><img src="<?php echo $shopdata->shopLogo?>" width="100"></td>
      </tr>
      <tr>
        <td>头部轮播图1</td>
        <td><img src="<?php echo $shopdata->shopTopPic1?>" width="200"></td>
      </tr>
      <tr>
        <td>头部轮播图2</td>
        <td><img src="<?php echo $shopdata->shopTopPic2?>" width="200"></td>
      </tr>
      <tr>
        <td>头部轮播图3</td>
        <td><img src="<?php echo $shopdata->shopTopPic3?>" width="200"></td>
      </tr>
      <tr>
        <td>头部轮播图4</td>
        <td><img src="<?php echo $shopdata->shopTopPic4?>" width="200"></td>
      </tr>
      <tr>
      
        <td>头部轮播图5</td>
        <td><img src="<?php echo $shopdata->shopTopPic5?>" width="200"></td>
      </tr>

       <tr>
        <td>门店座机号码 </td>
        <td><?php echo $shopdata->shopTel?></td>
      </tr>
      <tr>
        <td>店长手机号 </td>
        <td><?php echo $shopdata->shopBuinourPhone?></td>
      </tr>
      <tr>
        <td>店铺关键字</td>
        <td><?php echo $shopdata->shopKeywords?></td>
      </tr>
      <tr>
        <td>店铺二维码 </td>
        <td><img src="<?php echo base64_decode($shopdata->shopQrcode)?>" width="200"></td>
      </tr>
      <tr>
        <td>营业时间 </td>
        <td><?php echo $shopdata->shopBusinessHours?></td>
      </tr>
      <tr>
        <td>省 </td>
        <td><?php echo $shopdata->shopProvince?></td>
      </tr>
      <tr>
        <td>市 </td>
        <td><?php echo $shopdata->shopCity?></td>
      </tr>
      <tr>
        <td>区 </td>
        <td><?php echo $shopdata->shopArea?></td>
      </tr>
      <tr>
        <td>详细地址 </td>
        <td><?php echo $shopdata->shopDetailAddress?></td>
      </tr>
      <tr>
        <td>经度 </td>
        <td><?php echo $shopdata->shopLng?></td>
      </tr>
       <tr>
        <td>纬度 </td>
        <td><?php echo $shopdata->shopLat?></td>
      </tr>
     
      <tr>
        <td>wifi账号 </td>
        <td><?php echo $shopdata->shopWifiUsername?></td>
      </tr>
      <tr>
        <td>wifi密码 </td>
        <td><?php echo $shopdata->shopWifiPassword?></td>
      </tr> 
       <tr>
        <td>店铺添加时间</td>
        <td>
            <?php if(!empty($shopdata->shopAddtime)):?>
        		<?php echo $shopdata->shopAddtime?>
        	<?php endif;?>	
        </td>
      </tr>
      <tr>
        <td>编辑时间</td>
        <td>
            <?php if(!empty($shopdata->edittime)):?>
        		  <?php echo $shopdata->edittime?>
        	  <?php endif;?>
        </td>
      </tr>

      <tr>
        <td colspan='2'>
          <a title="编辑" href="javascript:;" onclick="member_edit('修改店铺信息','/admin/getShopDataEdit','','','550')" style="text-align:center;">
            <div style="text-align:center;"><img src="http://shop.fengdukeji.com/assets/images/shangpintupian.png" width="80" /></div>
          </a>
        </td>   
      </tr>

    </tbody>

  </table>
</div>
<script type="text/javascript">
  /*用户-编辑*/
  function member_edit(title,url,id,w,h){
    layer_show(title,url,w,h);
  }
</script>
</body>
</html>