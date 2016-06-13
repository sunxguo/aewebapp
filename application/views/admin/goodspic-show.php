<title>商品轮播图片查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18"><?php echo $goodspic[0]->shop_name;?>-<?php echo $goodspic[0]->shop_branch_name;?></span></dt>   
  </dl>
</div>
<div class="pd-20">
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">图片轮播图1：</th>
        <td>
            <?php if(!empty($goodspic[0]->shop_top_pic1)):?>
              <img src="<?php echo $goodspic[0]->shop_top_pic1?>" width="200">
            <?php else:?> 
              暂无图片
            <?php endif;?> 
        </td>
      </tr>
      <tr>
        <th class="text-r">图片轮播图2：</th>
        <td>
            <?php if(!empty($goodspic[0]->shop_top_pic2)):?>
              <img src="<?php echo $goodspic[0]->shop_top_pic2?>" width="200">
            <?php else:?> 
              暂无图片
            <?php endif;?> 
        </td>
      </tr>
      <tr>
        <th class="text-r">图片轮播图3：</th>
        <td>
            <?php if(!empty($goodspic[0]->shop_top_pic3)):?>
              <img src="<?php echo $goodspic[0]->shop_top_pic3?>" width="200">
            <?php else:?> 
              暂无图片
            <?php endif;?> 
        </td>
      </tr>
      <tr>
        <th class="text-r">图片轮播图4：</th>
        <td>
            <?php if(!empty($goodspic[0]->shop_top_pic4)):?>
              <img src="<?php echo $goodspic[0]->shop_top_pic4?>" width="200">
            <?php else:?> 
              暂无图片
            <?php endif;?> 
        </td>
      </tr>
      <tr>
        <th class="text-r">图片轮播图5：</th>
        <td>
            <?php if(!empty($goodspic[0]->shop_top_pic5)):?>
              <img src="<?php echo $goodspic[0]->shop_top_pic5?>" width="200">
            <?php else:?> 
              暂无图片
            <?php endif;?> 
        </td>
      </tr>
     
    </tbody>
  </table>
</div>
</body>
</html>