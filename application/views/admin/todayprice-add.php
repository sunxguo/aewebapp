<title>添加今日市价</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="role" value="0" type="hidden">
    
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="today_goods_name" name="today_goods_name" datatype="*1-16" nullmsg="商品名称不能为空">
      </div>
      <div class="col-4"> </div> 
    </div>

     <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>今日最低价：</label>
            <div class="formControls col-5">
              <textarea type="text" class="input-text" placeholder="" id="today_min_price" name="today_min_price" datatype="*" nullmsg="今日最低价不能为空"></textarea>
            </div>
        <div class="col-4"> </div>
    </div>

    <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>今日最高价：</label>
            <div class="formControls col-5">
              <textarea type="text" class="input-text" placeholder="" id="today_max_price" name="today_max_price" datatype="*" nullmsg="今日最高价不能为空"></textarea>
            </div>
        <div class="col-4"> </div>
    </div>

    <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>排序：</label>
            <div class="formControls col-5">
              <textarea type="text" class="input-text" placeholder="" id="today_orders" name="today_orders" datatype="*" ></textarea>
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
    addTodayprice(true,function(){
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