<title>编辑商圈</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="type" value="1" type="hidden">
    <input id="businessId" value="<?php echo $business->businessId?>" type="hidden">

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>省</label>
      <div class="formControls col-5">
        
        <input type="text" class="input-text" value="<?php echo $business->businessProvince?>" placeholder="" id="business_province" name="business_province" datatype="*2-16" nullmsg="身份不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>市</label>
      <div class="formControls col-5">
      
        <input type="text" class="input-text" value="<?php echo $business->businessCity?>" placeholder="" id="business_city" name="business_city" datatype="*2-16" nullmsg="市区不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>区</label>
      <div class="formControls col-5">
        
        <input type="text" class="input-text" value="<?php echo $business->businessArea?>" placeholder="" id="business_area" name="business_area" datatype="*2-16" nullmsg="地区不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商圈名称</label>
      <div class="formControls col-5">
       
        <input type="text" class="input-text" value="<?php echo $business->businessName?>" placeholder="" id="business_name" name="business_name" datatype="*2-16" nullmsg="商圈名称不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>地址</label>
      <div class="formControls col-5">
       
        <input type="text" class="input-text" value="<?php echo $business->businessAddress?>" placeholder="" id="business_address" name="business_address" datatype="*2-16" nullmsg="地址不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>简介图：</label>
      <div class="formControls col-5">
        <img src="<?php echo $business->businessLogo?>" id="thumbnail" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商场点评</label>
      <div class="formControls col-5">
       
        <textarea class="input-text" value="" placeholder="" id="business_comments" name="business_comments" datatype="*2-16" nullmsg="商场点评不能为空" height="100" cols="20" rows="5"><?php echo $business->businessComments?></textarea>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商业中心</label>
      <div class="formControls col-5">
        
        <input class="input-text" value="<?php echo $business->businessMart?>" placeholder="" id="business_mart" name="business_mart" datatype="*2-16" nullmsg="商业中心不能为空" />
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商业街</label>
      <div class="formControls col-5">
        
        <input class="input-text" value="<?php echo $business->businessStreet?>" placeholder="" id="business_street" name="business_street" datatype="*2-16" nullmsg="商业街不能为空" />
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>经度</label>
      <div class="formControls col-5">
        
        <input class="input-text" value="<?php echo $business->businessLng?>" placeholder="" id="business_lng" name="business_lng"/>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>纬度</label>
      <div class="formControls col-5">
        
        <input class="input-text" value="<?php echo $business->businessLat?>" placeholder="" id="business_lat" name="business_lat"/>
      </div>
      <div class="col-4"> </div>
    </div>

  
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否使用：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="status-1" name="business_status" value="0" datatype="*" <?php echo $business->businessStatus=='0'?'checked':'';?>>
          <label for="status-1">是</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="status-2" name="business_status" value="1" <?php echo $business->businessStatus=='1'?'checked':'';?>>
          <label for="status-2">否</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>

   
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;保存&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>
<form id="uploadImgThumb" enctype="multipart/form-data">
    <input onchange="return uploadThumb()" name="image" type="file" id="file" style="display:none;" accept="image/*">
</form>
<script type="text/javascript" src="/assets/lib/icheck/jquery.icheck.min.js"></script>
<script charset="utf-8" src="/assets/js/jquery.form.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").Validform({
    
		tiptype:2,
		callback:function(form){
      //alert('ok');
			// form[0].submit();
      saveBusinessdistrict(false,function(){
        alert('保存成功！');
        var index = parent.layer.getFrameIndex(window.name);
        parent.window.location.reload();
        parent.layer.close(index);
      });
		}
	});
});
</script>
</body>
</html>