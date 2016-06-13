<title>编辑分类</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form action="?id=<?php echo $category[0]->id;?>" class="form form-horizontal" id="form-member-add">
    <input id="id" value="<?php echo $category[0]->id;?>" type="hidden">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>一级分类：</label>
      <div class="formControls col-5"> <span class="select-box">
        <select id="twoid" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择一级分类！">
          <option value="" selected>请选择一级分类</option>
          <?php foreach($onecategory as $sm):?>
            <option value="<?php echo $sm->id;?>" <?php echo $sm->id==$category[0]->twoid?'selected':'';?>><?php echo $sm->name;?></option>
          <?php endforeach;?>
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分类名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $category[0]->name;?>" placeholder="" id="name" name="name" datatype="*2-16" nullmsg="分类名称不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分类描述：</label>
      <div class="formControls col-5">
       <textarea type="text" class="input-text" placeholder="" id="describe_shop" name="describe_shop" datatype="*2-16" nullmsg="分类描述不能为空"><?php echo $category[0]->describe_shop;?></textarea>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>序号：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $category[0]->orders;?>" placeholder="" id="orders" name="orders" datatype="n" nullmsg="序号不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>是否启用：</label>
          <div class="formControls col-5 skin-minimal">
              <div class="radio-box">
                  <input type="radio" id="status-1" name="status" value="0" <?php echo $category[0]->status==0?'checked':''?>>
                  <label for="status-1">是</label>
              </div>

              <div class="radio-box">
                  <input type="radio" id="status-2" name="status" value="1"  <?php echo $category[0]->status==1?'checked':''?>>
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
      editSubCategory(false,function(){
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