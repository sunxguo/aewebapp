<title>商品图片查看</title>
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
        <th class="text-r" width="80">商品图片1：</th>
        <td>
            <?php if(!empty($goods->pic1)):?>
              <img src="<?php echo $goods->pic1;?>" width="100">
            <?php else:?>
              暂无商品图片
            <?php endif;?>  
        </td>
      </tr>
       <tr>
        <th class="text-r" width="80">商品图片2：</th>
        <td>
            <?php if(!empty($goods->pic2)):?>
              <img src="<?php echo $goods->pic2;?>" width="100">
            <?php else:?>
              暂无商品图片
            <?php endif;?>
        </td>
      </tr>
       <tr>
        <th class="text-r" width="80">商品图片3：</th>
        <td> 
            <?php if(!empty($goods->pic3)):?>
              <img src="<?php echo $goods->pic3;?>" width="100">
            <?php else:?>
              暂无商品图片
            <?php endif;?>
        </td>
      </tr>
       <tr>
        <th class="text-r" width="80">商品图片4：</th>
        <td> 
            <?php if(!empty($goods->pic4)):?>
              <img src="<?php echo $goods->pic4;?>" width="100">
            <?php else:?>
              暂无商品图片
            <?php endif;?>
        </td>
      </tr>
       <tr>
        <th class="text-r" width="80">商品图片5：</th>
        <td>
           <?php if(!empty($goods->pic5)):?>
              <img src="<?php echo $goods->pic5;?>" width="100">
            <?php else:?>
              暂无商品图片
            <?php endif;?>
        </td>
      </tr>
    
    </tbody>
  </table>
</div>
</body>
</html>