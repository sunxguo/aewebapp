<title>编辑店铺信息</title>
<link href="/assets/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

  <form class="form-horizontal" role="form" >
    
   <?php foreach($activitys as $activitys):?>
    <div class="form-group">
      <label class="col-sm-1 control-label">店铺名称：</label>
      <div class="col-sm-5">
        <?php if(!empty($activitys->shop_name)):?>
						<?php echo $activitys->shop_name;?>
					<?php else:?>
				    	暂无店名
				    <?php endif;?>
      </div>
      
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">店铺名称：</label>
      <div class="col-sm-10">
                    <?php if(!empty($activitys->shop_name)):?>
						<?php echo $activitys->shop_name;?>
					<?php else:?>
				    	暂无店名
				    <?php endif;?>
      </div>
   </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">分店名称：</label>
      <div class="col-sm-10">
            	<?php if(!empty($activitys->shop_branch_name)):?>
						<?php echo $activitys->shop_branch_name;?>
					<?php else:?>
				    	暂无分店名
				    <?php endif;?>
      </div>
      
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">店铺类型：</label>
      <div class="col-sm-10">
                <?php if(!empty($activitys->category->type_name)):?>
						<?php echo $activitys->category->type_name;?>
					<?php else:?>
				    	暂无店铺类型
				    <?php endif;?>
      </div>
      
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">门店座机电话：</label>
      <div class="col-sm-10">
                	<?php if(!empty($activitys->shop_tel)):?>
						<?php echo $activitys->shop_tel;?>
					<?php else:?>
				    	暂无座机号码
				    <?php endif;?>
      </div>
      
    </div>

    

    <div class="form-group">
      <label class="col-sm-2 control-label">店长手机号：</label>
      <div class="col-sm-10">
                <?php if(!empty($activitys->shop_buinour_phone)):?>
						<?php echo $activitys->shop_buinour_phone;?>
					<?php else:?>
				    	暂无手机号码
				    <?php endif;?>
      </div>
      
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">省：</label>
      <div class="col-sm-10">
                <?php if(!empty($activitys->shop_province)):?>
						<?php echo $activitys->shop_province;?>
					<?php else:?>
				    	暂无省份
				    <?php endif;?>
      </div>
      
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">市：</label>
      <div class="col-sm-10">
                <?php if(!empty($activitys->shop_city)):?>
						<?php echo $activitys->shop_city;?>
					<?php else:?>
				    	暂无市名
				    <?php endif;?>
      </div>
      
    </div>
    
    <div class="form-group">
      <label class="col-sm-2 control-label">区：</label>
      <div class="col-sm-10 skin-minimal">
                <?php if(!empty($activitys->shop_area)):?>
						<?php echo $activitys->shop_area;?>
					<?php else:?>
				    	暂无市区
				    <?php endif;?>
      </div>
      
    </div>
   
    <div class="form-group">
      <label class="col-sm-2 control-label">详细地址：</label>
      <div class="col-sm-10">
                <?php if(!empty($activitys->shop_detail_address)):?>
						<?php echo $activitys->shop_detail_address;?>
					<?php else:?>
				    	暂无详细地址
				    <?php endif;?>
      </div>
      
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">营业时间：</label>
      <div class="col-sm-10">
                <?php if(!empty($activitys->shop_business_hours)):?>
						<?php echo $activitys->shop_business_hours;?>
					<?php else:?>
				    	暂无营业时间
				    <?php endif;?>
      </div>
      
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">店长姓名：</label>
      <div class="col-sm-10"> 
                <?php if(!empty($activitys->shop_buinour_name)):?>
						<?php echo $activitys->shop_buinour_name;?>
					<?php else:?>
				    	暂无店长姓名
				    <?php endif;?>
      </div>
      
    </div>

    <div class="form-group">

      <label class="col-sm-2 control-label">身份证号：</label>
      <div class="col-sm-10">
                <?php if(!empty($activitys->shop_identity_card)):?>
						<?php echo $activitys->shop_identity_card;?>
					<?php else:?>
				    	暂无身份证号码
				    <?php endif;?>
      </div>
    </div> 

    <div class="form-group">
      <label class="col-sm-2 control-label">身份证图片：</label>
      <div class="col-sm-10"> 
                <?php if(!empty($activitys->shop_identity_card_pic)):?>
						<img src="<?php echo $activitys->shop_identity_card_pic;?>" width="50">
					<?php else:?>
				    	暂无身份证图片
				    <?php endif;?>
      </div>
      
    </div>

    <div class="form-group">

      <label class="col-sm-2 control-label">营业执照：</label>
      <div class="col-sm-10">
                <?php if(!empty($activitys->shop_business_license_pic)):?>
						<img src="<?php echo $activitys->shop_business_license_pic;?>" width="50">
					<?php else:?>
				    	暂无营业执照
				    <?php endif;?>
      </div>
    </div> 
     
     <div class="form-group">

      <label class="col-sm-2 control-label">其他证件照：</label>
      <div class="col-sm-10">
                <?php if(!empty($activitys->shop_other_license1)):?>
						<img src="<?php echo $activitys->shop_other_license1;?>" width="50">
					<?php else:?>
				    	暂无其他证件照
				    <?php endif;?>
      </div>
    </div> 
    
    <?php endforeach;?>
     
  </form>


</body>
</html>