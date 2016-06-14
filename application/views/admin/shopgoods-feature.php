<title>商品特征查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#BB0614">
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18"><?php echo $shopdata->shopName;?>-<?php echo $shopdata->shopBranchName;?></span>
  </dl>
</div>
<div class="pd-20">
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">分类特征1：</th>
        <td>
            <?php if(!empty($goods->featureName1)):?>
              <?php echo $goods->featureName1;?>
            <?php else:?>
              暂无分类特征
            <?php endif;?>  
        </td>
      </tr>
       <tr>
        <th class="text-r" width="80">分类特征2：</th>
        <td>
            <?php if(!empty($goods->featureName2)):?>
              <?php echo $goods->featureName2;?>
            <?php else:?>
              暂无分类特征
            <?php endif;?>
        </td>
      </tr>
       <tr>
        <th class="text-r" width="80">分类特征3：</th>
        <td> 
            <?php if(!empty($goods->featureName3)):?>
              <?php echo $goods->featureName3;?>
            <?php else:?>
              暂无分类特征
            <?php endif;?>
        </td>
      </tr>
       <tr>
        <th class="text-r" width="80">分类特征4：</th>
        <td> 
            <?php if(!empty($goods->featureName4)):?>
              <?php echo $goods->featureName4;?>
            <?php else:?>
              暂无分类特征
            <?php endif;?>
        </td>
      </tr>
       <tr>
        <th class="text-r" width="80">分类特征5：</th>
        <td>
           <?php if(!empty($goods->featureName5)):?>
              <?php echo $goods->featureName5;?>
            <?php else:?>
              暂无分类特征
            <?php endif;?>
        </td>
      </tr>
      
    </tbody>
  </table>
</div>
</body>
</html>