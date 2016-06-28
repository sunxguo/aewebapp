<title>编辑商品</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form action="?id=<?php echo $admin->admin_id;?>" class="form form-horizontal" id="form-member-add">
    <input id="id" value="<?php echo $admin->admin_id;?>" type="hidden">
   
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>管理员用户名：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $admin->username;?>" placeholder="" id="username" name="username" disabled="disabled ">
      </div>
      <div class="col-4"> </div>
    </div>
    
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>管理员旧密码：</label>
      <div class="formControls col-5">
        <input type="password" class="input-text" value="" placeholder="" id="old_password" name="old_password" datatype="*2-16" nullmsg="管理员密码不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

     <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>管理员新密码：</label>
      <div class="formControls col-5">
        <input type="password" class="input-text" value="" placeholder="" id="password" name="password" datatype="*2-16" nullmsg="新密码不能为空">
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
      savePassword(false,function(){
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