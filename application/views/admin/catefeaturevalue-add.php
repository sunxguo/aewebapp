<title>添加分类特征</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="role" value="0" type="hidden">
    <div class="row cl">
    
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>选择分类特征：</label>
      <div class="formControls col-5">
        <span class="select-box">
          <select id="feature_id" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择分类！">
              <option value="" selected>请选择分类特征</option>
              <?php foreach($category as $cate):?>
                 <option value="<?php echo $cate->feature_id;?>"><?php echo $cate->feature_name ;?></option>
              <?php endforeach;?>
          </select>
        </span> 
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分类特征值：</label>
        <div class="formControls col-5">
          <input type="text" class="input-text" value="" placeholder="" id="eigenvalue_name" name="eigenvalue_name" datatype="*1-16" nullmsg="分类特征不能为空">
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
      // alert('ok');
      // form[0].submit();
      saveCateFeatureVal(true,function(){
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