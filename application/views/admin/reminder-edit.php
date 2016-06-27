<title>编辑平台提示</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="type" value="1" type="hidden">
    <input id="msg_id" value="<?php echo $reminder[0]->msg_id;?>" type="hidden">

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>提示内容：</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -->
        <input type="text" class="input-text" value="<?php echo $reminder[0]->msg_content;?>" placeholder="" id="msg_content" name="msg_content" datatype="*2-100000" nullmsg="提示内容不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否显示：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="msg_status-1" name="msg_status" value="0" datatype="*" <?php echo $reminder[0]->msg_status=='0'?'checked':'';?>>
          <label for="status-1">不显示</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="msg_status-2" name="msg_status" value="1" <?php echo $reminder[0]->msg_status=='1'?'checked':'';?>>
          <label for="status-2">显示中</label>
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
      editReminder(true,function(){
        alert('修改成功！');
        var index = parent.layer.getFrameIndex(window.name);
        // parent.$('.btn-refresh').click();
        parent.window.location.reload();
        parent.layer.close(index);
      });
		}
	});
});
</script>
</body>
</html>