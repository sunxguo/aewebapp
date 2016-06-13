<title>编辑分类</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="type" value="1" type="hidden">
    <input id="categoryId" value="<?php echo $shopCategory->categoryId?>" type="hidden">

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分类名称</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -->
        <input type="text" class="input-text" value="<?php echo $shopCategory->name?>" placeholder="" id="name" name="name" datatype="*2-16" nullmsg="分类名称不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分类描述</label>
      <div class="formControls col-5">
        <textarea type="text" class="input-text" value="<?php echo $shopCategory->describeShop?>" placeholder="" id="describe_shop" name="describe_shop" datatype="*2-16" nullmsg="分类描述不能为空"></textarea>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>序号</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -->
        <input type="text" class="input-text" value="<?php echo $shopCategory->orders?>" placeholder="" id="orders" name="orders" datatype="*1-3" nullmsg="序号不能为空">
        <div style="color:#ff0000">*序号只能添加正整数 数值越大APP排序越靠前</div>
      </div>
      <div class="col-4"> </div>
    </div>


    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否使用：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="status-1" name="status" value="0" datatype="*" <?php echo $shopCategory->status=='0'?'checked':'';?>>
          <label for="status-1">是</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="status-2" name="status" value="1" <?php echo $shopCategory->status=='1'?'checked':'';?>>
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
      saveShopCategory(false,function(){
        alert('保存成功！');
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