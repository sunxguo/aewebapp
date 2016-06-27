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
        <span class="select-box">
          <select id="word_discount" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择口令折扣">
            <option value="" selected>请选择口令折扣</option>
              <?php for($i=1;$i<10;$i+=0.5):?>
                 <option value="<?php echo $i;?>"><?php echo $i;?></option>
              <?php endfor;?>
          </select>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品原价</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="word_prime_cost" name="word_prime_cost" datatype="*2-16" nullmsg="商品价格
        不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品分类</label>
      <div class="formControls col-5">
        <span class="select-box">
          <select id="shopcategory" onchange="getshopcategory();" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择商品分类">
            <option value="" selected>请选择商品分类</option>
            <?php foreach($shopCategory as $category):?>
              <option value="<?php echo $category->categoryId;?>"><?php echo $category->name;?></option>
            <?php endforeach;?>
          </select>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>口令商品：</label>
        <div class="formControls col-5"> <span class="select-box">
          <select id="shopgoods" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择口令商品">
            <option value="" selected>请选择口令商品</option>
          </select>
          </span> </div>
        <div class="col-4"> </div>
      </div>

    <?php if($count == 'select'):?>
      <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>口令内容分类：</label>
        <div class="formControls col-5"> <span class="select-box">
          <select id="wordsort" onchange="getwordstor();" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择口令分类">
            <option value="" selected>请选择分类</option>
            <?php foreach($wordsort as $word):?>
              <option value="<?php echo $word->wordSortId;?>"><?php echo $word->wordSortName;?></option>
            <?php endforeach;?>
          </select>
          </span> </div>
        <div class="col-4"> </div>
      </div>
    
      <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>口令内容：</label>
        <div class="formControls col-5"> <span class="select-box" style="height:150px;">
          <select id="worditem" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择口令内容">
            <option value="" selected>请选择口令详情</option>
          </select>
          </span> </div>
        <div class="col-4"> </div>
      </div>
    <?php else:?>
      <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>口令内容：</label>
        <div class="formControls col-5"> <span class="select-box" style="height:150px;">
          <select id="worditem" class="select" size="1" name="demo1" datatype="*" nullmsg="请选择口令分类">
            <option value="" selected>请选择内容</option>
            <?php foreach($shopItem as $word):?>
              <option value="<?php echo $word->wordItemId;?>"><?php echo $word->wordItemName;?></option>
            <?php endforeach;?>
          </select>
          </span> </div>
        <div class="col-4"> </div>
      </div>
    <?php endif;?>

     <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>有效期始：</label>
      <div class="formControls col-5">
        <input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd ',minDate:'#F{$dp.$D(\'word_endtime\')}'})" id="word_begintime" class="input-text Wdate">
      </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>有效期止：</label>
      <div class="formControls col-5">
        <input type="text" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd ',minDate:'#F{$dp.$D(\'word_begintime\')}'})" id="word_endtime" class="input-text Wdate">
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