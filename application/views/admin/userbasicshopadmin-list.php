<title>店铺信息</title>
</head>
<body>
<div class="pd-20" style="padding-top:20px;">
  <p class="f-20 text-success">店铺基本信息管理<span class="f-14"></span></p>

  <table class="table table-border table-bordered table-bg mt-20">
    <thead>
      <tr>
        <th colspan="2" scope="col" >店铺基本信息</th>
      </tr>
    </thead>
    <tbody>
      
      <tr>
          <th width="400">店铺名称</th>
          <td><?php echo $shopdata->shopName?> - <?php echo $shopdata->shopBranchName?></td>
      </tr>

      <tr>
          <td>店长姓名</td>
          <td><?php echo $shopdata->shopBuinourName?></td>
      </tr>

      <tr>
        <td>营业执照</td>
        <td><img src="<?php echo $shopdata->shopBusinessLicensePic?>" width="200"></td>
      </tr>

      <tr>
        <td>其他证件照</td>
        <td><img src="<?php echo $shopdata->shopOtherLicense1?>" width="200"></td>
      </tr>

     
    </tbody>
  </table>
</div>
</body>
</html>