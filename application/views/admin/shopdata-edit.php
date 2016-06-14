<title>编辑店铺信息</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">

  <form class="form form-horizontal" id="form-member-add">
    <input id="type" value="1" type="hidden">
    <input id="shopId" value="<?php echo $shopdata->shopId?>" type="hidden" >
    
   
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>店铺关键字</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $shopdata->shopKeywords;?>" placeholder="" id="shopKeywords" name="shopKeywords" datatype="*1-100" nullmsg="活动关键字不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>店铺logo图：</label>
      <div class="formControls col-5">
        <img src="<?php echo $shopdata->shopLogo;?>" id="thumbnail" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>头部轮播图1：</label>
      <div class="formControls col-5">
        <img src="<?php echo $shopdata->shopTopPic1;?>" id="thumbnail1" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file1').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>头部轮播图2：</label>
      <div class="formControls col-5">
        <img src="<?php echo $shopdata->shopTopPic2;?>" id="thumbnail2" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file2').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>头部轮播图3：</label>
      <div class="formControls col-5">
        <img src="<?php echo $shopdata->shopTopPic3;?>" id="thumbnail3" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file3').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>头部轮播图4：</label>
      <div class="formControls col-5">
        <img src="<?php echo $shopdata->shopTopPic4;?>" id="thumbnail4" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file4').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>头部轮播图5：</label>
      <div class="formControls col-5">
        <img src="<?php echo $shopdata->shopTopPic5;?>" id="thumbnail5" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file5').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

   
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>wifi账号</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $shopdata->shopWifiUsername;?>" placeholder="" id="shopWifiUsername" name="shopWifiUsername">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>wifi密码</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $shopdata->shopWifiPassword;?>" placeholder="" id="shopWifiPassword" name="shopWifiPassword">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>营业时间开始：</label>
      <div class="formControls col-5"> 
        <input type="text" onfocus="WdatePicker({dateFmt:' HH:mm',maxDate:'#F{$dp.$D(\'coupon_endvalid\')||\'%y-%M-%d\'}'})" id="coupon_beginvalid" class="input-text Wdate" value="">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">

      <label class="form-label col-3"><span class="c-red">*</span>营业时间结束：</label>
      <div class="formControls col-5">
        <input type="text" onfocus="WdatePicker({dateFmt:' HH:mm',minDate:'#F{$dp.$D(\'coupon_beginvalid\')}'})" id="coupon_endvalid" class="input-text Wdate" value="">
      </div>
    </div> 
  
   
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;保存&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>
<form id="uploadImgThumb1" enctype="multipart/form-data">
    <input onchange="return uploadThumb1()" name="image" type="file" id="file1" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb2" enctype="multipart/form-data">
    <input onchange="return uploadThumb2()" name="image" type="file" id="file2" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb3" enctype="multipart/form-data">
    <input onchange="return uploadThumb3()" name="image" type="file" id="file3" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb4" enctype="multipart/form-data">
    <input onchange="return uploadThumb4()" name="image" type="file" id="file4" style="display:none;" accept="image/*">
</form>

<form id="uploadImgThumb5" enctype="multipart/form-data">
    <input onchange="return uploadThumb5()" name="image" type="file" id="file5" style="display:none;" accept="image/*">
</form>
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
			//form[0].submit();
      saveShopData(function(){
        alert('保存成功！');
        /*这个是修改之后直接退出*/
        // parent.window.location.replace('/adminajax/logout');
        // parent.window.location.href="/adminajax/logout";
        // window.history.go(-1);
        // var index = parent.layer.getFrameIndex(window.name);
        // parent.window.location.reload(); 
        // parent.layer.close(index);

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