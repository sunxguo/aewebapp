<title>商品图片</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
  <dl style="margin-left:80px; color:#fff">
    <!-- <dd class="pt-10 f-12" style="margin-left:0">这家伙很懒，什么也没有留下</dd> -->
    <dd class="pt-10 f-12" style="margin-left:0">店铺：<?php echo $goodspic[0]->usershop->shop_name.' - '.$goodspic[0]->usershop->shop_branch_name;?></dd>
  </dl>
</div>
<div class="pd-20">
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r">商品图片1：</th>
          <td>
            <?php if(!empty($goodspic[0]->pic1)):?>
              <img src="<?php echo $goodspic[0]->pic1;?>" width="200">
            <?php endif;?>  
          </td>
      </tr>
      <tr>
        <th class="text-r">商品图片2：</th>
        <td>
            <?php if(!empty($goodspic[0]->pic2)):?>
              <img src="<?php echo $goodspic[0]->pic2;?>" width="200">
            <?php endif;?>  
          </td>
      </tr>
      <tr>
        <th class="text-r">商品图片3：</th>
        <td>
            <?php if(!empty($goodspic[0]->pic3)):?>
              <img src="<?php echo $goodspic[0]->pic3;?>" width="200">
            <?php endif;?>  
          </td>
      </tr>
      <tr>
        <th class="text-r">商品图片4：</th>
        <td>
            <?php if(!empty($goodspic[0]->pic4)):?>
              <img src="<?php echo $goodspic[0]->pic4;?>" width="200">
            <?php endif;?>  
          </td>
      </tr>
      <tr>
        <th class="text-r">商品图片5：</th>
        <td>
            <?php if(!empty($goodspic[0]->pic5)):?>
              <img src="<?php echo $goodspic[0]->pic5;?>" width="200">
            <?php endif;?>  
          </td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>