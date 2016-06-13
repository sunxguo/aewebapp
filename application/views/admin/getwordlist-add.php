<title>添加口令集</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="type" value="1" type="hidden">
    

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>口令集折扣</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -->
        <input type="text" class="input-text" value="" placeholder="" id="word_discount" name="word_discount" datatype="*2-16" nullmsg="优惠券面值不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品原价</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -->
        <input type="text" class="input-text" value="" placeholder="" id="word_prime_cost" name="word_prime_cost" datatype="*2-16" nullmsg="使用价格
        不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>口令商品</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -->
        <input type="text" class="input-text" value="" placeholder="" id="word_good" name="word_good" datatype="*2-16" nullmsg="使用价格
        不能为空">
      </div>
      <div class="col-4"> </div>
    </div>


    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>口令内容</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -->
        <input type="text" class="input-text" value="" placeholder="" id="word_content" name="word_content" datatype="*2-16" nullmsg="使用价格
        不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

     <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>有效期始：</label>
      <div class="formControls col-5">
        <input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'word_endtime\')}'})" id="word_begintime" class="input-text Wdate">
      </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>有效期止：</label>
      <div class="formControls col-5">
        <input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'#F{$dp.$D(\'word_begintime\')}'})" id="word_endtime" class="input-text Wdate">
      </div>
    </div>

   
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;添加&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>
<form id="uploadImgThumb1" enctype="multipart/form-data">
    <input onchange="return uploadThumb1()" name="image" type="file" id="file1" style="display:none;" accept="image/*">
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
      //alert('ok');
			// form[0].submit();
      saveWord(true,function(){
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