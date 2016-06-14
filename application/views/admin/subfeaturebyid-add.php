<title>添加分类特征</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="role" value="0" type="hidden">
    <input id="feature_category_id" value="<?php echo $id?>" type="hidden">
    <div class="row cl">
    
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分类名称：</label>
        <div class="formControls col-5">
          <input type="text" class="input-text" value="<?php echo $category[0]->name?>" id="feature_name" name="feature_name" disabled="disabled ">
        </div>
      <div class="col-4"> </div>
    </div>  


    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>选择分类特征：</label>
         <?php foreach($catefeature as $cate):?>
            <p style="padding-left:200px;"><input type="checkbox" name="category[]" id="category" value="<?php echo $cate->feature_name?>" /><?php echo $cate->feature_name?> </p> 
         <?php endforeach;?> 
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
      // alert('ok');
      // form[0].submit();
      saveSubCateFeature(true,function(){
        alert('添加成功！');
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