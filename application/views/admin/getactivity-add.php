<title>添加优惠活动</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="type" value="1" type="hidden">
    

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>活动标题</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="activity_name" name="activity_name" datatype="*2-16" nullmsg="活动标题不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>活动关键字</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="activity_keyword" name="activity_keyword" datatype="*2-16" nullmsg="活动关键字不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>简介图：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>内容</label>
      <div class="formControls col-5">
        <textarea class="input-text" value="" placeholder="" id="content" name="content" datatype="*2-16" nullmsg="内容不能为空" height="100" cols="20" rows="5"></textarea>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>位置</label>
      <div class="formControls col-5">
          <select id="site" class="select" size="1" name="site" datatype="*" nullmsg="请选择活动显示位置">
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
          
          </select>
      </div>
      <div class="col-4"> </div>
    </div>

     <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>有效期始：</label>
      <div class="formControls col-5"> 
        <input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',maxDate:'#F{$dp.$D(\'coupon_endvalid\')||\'%y-%M-%d\'}'})" id="coupon_beginvalid" class="input-text Wdate">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>有效期止：</label>
      <div class="formControls col-5">
        <input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'coupon_beginvalid\')}'})" id="coupon_endvalid" class="input-text Wdate">
      </div>
    </div>

     <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否使用：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="status-1" name="status" value="1" datatype="*" checked="checked">
          <label for="status-1">是</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="status-2" name="status" value="0">
          <label for="status-2">否</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>

   
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;添加&nbsp;&nbsp;">
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
      saveActivity(true,function(){
        alert('添加成功！');
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