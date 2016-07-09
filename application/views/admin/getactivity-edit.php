<title>编辑优惠活动</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <!--<?php var_dump($activity);?>-->
  <form class="form form-horizontal" id="form-member-add">
    <input id="type" value="1" type="hidden">
    <input id="activity_id" value="<?php echo $activity[0]->activity_id?>" type="hidden" >
    
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>活动标题</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $activity[0]->activity_name;?>" placeholder="" id="activity_name" name="activity_name" datatype="*2-16" nullmsg="活动标题不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>活动关键字</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $activity[0]->activity_keyword;?>" placeholder="" id="activity_keyword" name="activity_keyword" datatype="*2-16" nullmsg="活动关键字不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>简介图：</label>
      <div class="formControls col-5">
        <img src="<?php echo $activity[0]->thumbnail1;?>" id="thumbnail" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>内容</label>
      <div class="formControls col-5">
        <textarea class="input-text" value="" placeholder="" id="content" name="content" nullmsg="内容不能为空" height="100"><?php echo $activity[0]->content;?></textarea>
      </div>
      <div class="col-4"> </div>
    </div>

     <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>有效期始：</label>
      <div class="formControls col-5"> 
        <input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'#F{\'%y-%M-%d\'}',maxDate:'#F{$dp.$D(\'coupon_endvalid\',{d:-1})}'})" id="coupon_beginvalid" class="input-text Wdate" value="<?php echo $activity[0]->activity_begintime;?>">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>有效期止：</label>
      <div class="formControls col-5">
        <input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'#F{$dp.$D(\'coupon_beginvalid\',{d:1})||\'%y-%M-#{%d+1}\'}'})" id="coupon_endvalid" class="input-text Wdate" value="<?php echo $activity[0]->activity_endtime;?>">
      </div>
    </div>

     <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否使用：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="status-1" name="status" value="1" <?php echo $activity[0]->status=='1'?'checked':''?>>
          <label for="status-1">是</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="status-2" name="status" value="0"<?php echo $activity[0]->status=='0'?'checked':''?>>
          <label for="status-2">否</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>

   
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交审核&nbsp;&nbsp;">
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
      saveActivity(false,function(){
        alert('提交成功！');
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