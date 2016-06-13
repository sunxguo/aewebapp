<title>编辑管理员</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    
    <input type="hidden" id="admin_id" value="<?php echo $admin->admin_id;?>">
    <input type="hidden" id="old_username" value="<?php echo $admin->username;?>">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>用户名：</label>
        <div class="formControls col-5">
          <!-- <span id="supermarketname"></span> -->
          <input type="text" class="input-text" value="<?php echo $admin->username;?>" placeholder="" id="username" name="username" datatype="*2-16" nullmsg="">
        </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>角色：</label>
      <div class="formControls col-5">
        <span class="select-box">
            <select id="admintype" class="select" size="1" name="admintype" datatype="*" nullmsg="请选择商品分类！">
                <?php foreach($admintype as $type):?>
                   <option value="<?php echo $type->admintype_id?>" <?php echo $admin->type == $type->admintype_id?'selected':'';?>><?php echo $type->type_name?>
                   </option>
        		    <?php endforeach;?>
            </select>
        </span> 
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>状态：</label>
        <div class="formControls col-5 skin-minimal">
            <div class="radio-box">
                <input type="radio" id="status-1" name="status" value="1"<?php echo $admin->status=='1'?'checked':'';?>>
                <label for="isedit-1">启用</label>
                 
            </div>
            <div class="radio-box">
                <input type="radio" id="status-2" name="status" value="0" <?php echo $admin->status=='0'?'checked':'';?>>
                <label for="isedit-2">禁用</label>
            </div>
        </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;修改&nbsp;&nbsp;">
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
      saveAdmin(false,function(){
        alert('修改成功！');
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