<title>修改口令分类</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="role" value="0" type="hidden">
    <input id="wordSortId" value="<?php echo $wordsort->wordSortId;?>" type="hidden">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>口令分类名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo $wordsort->wordSortName?>" placeholder="" id="word_sort_name" name="word_sort_name" datatype="*1-10000" nullmsg="口令分类名称不能为空">
      </div>
      <div class="col-4"> </div> 
    </div>

    <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>是否启用：</label>
          <div class="formControls col-5 skin-minimal">
              <div class="radio-box">
                  <input type="radio" id="word_sort_status-1" name="word_sort_status" value="0" datatype="*" checked="checked">
                  <label for="status-1">是</label>
              </div>

              <div class="radio-box">
                  <input type="radio" id="word_sort_status-2" name="word_sort_status" value="1">
                  <label for="status-2">否</label>
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
      // alert('ok');
      // form[0].submit();
    addwordsort(false,function(){
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