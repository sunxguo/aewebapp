<title>添加管理员</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="type" value="1" type="hidden">
    

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>管理员id：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="username" name="username" datatype="*2-16" nullmsg="管理员id不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>密码：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="password" name="password" datatype="*2-16" nullmsg="密码不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>角色：</label>
      <div class="formControls col-5"> <span class="select-box">
          <select id="admintype" class="select" size="1" name="type" datatype="*" nullmsg="请选择商品分类！">
                  <option value="" selected>请选择角色</option>

                  <?php foreach($admintype as $type):?>
                     <option value="<?php echo $type->admintype_id?>"><?php echo $type->type_name?></option> 
          		    <?php endforeach;?>
          </select>
        </span> </div>
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
      saveAdmin(true,function(){
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