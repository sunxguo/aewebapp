<title>编辑审核员信息</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form action="?id=<?php echo $admindata[0]->admin_id;?>" class="form form-horizontal" id="form-member-add">
    <input id="admin_id" value="<?php echo $admindata[0]->admin_id;?>" type="hidden">
    <input id="old_username" value="<?php echo $admindata[0]->username;?>" type="hidden">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>用户名：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $admindata[0]->username;?>" placeholder="" id="username" name="username" datatype="*1-16" nullmsg="分类名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
     

     <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>是否启用：</label>
          <div class="formControls col-5 skin-minimal">
              <div class="radio-box">
                  <input type="radio" id="status-1" name="status" value="1" <?php echo $admindata[0]->status==1?'checked':''?>>
                  <label for="status-1">是</label>
              </div>

              <div class="radio-box">
                  <input type="radio" id="status-2" name="status" value="0"  <?php echo $admindata[0]->status==0?'checked':''?>>
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
      // alert('ok');
			// form[0].submit();
      editAdmindata(false,function(){
        alert('保存成功！');
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