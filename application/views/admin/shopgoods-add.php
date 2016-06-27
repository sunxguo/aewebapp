<title>添加商品</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="pd-20">
  <form class="form form-horizontal" id="form-member-add">
    <input id="type" value="1" type="hidden">
    

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品名称</label>
      <div class="formControls col-5">
        <!-- <span id="supermarketname"></span> -->
        <input type="text" class="input-text" value="" placeholder="" id="name" name="name" datatype="*2-16" nullmsg="商品名称不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品详细名称</label>
      <div class="formControls col-5">
        <!--<span id="supermarketname"></span>-->
        <input type="text" class="input-text" value="" placeholder="" id="detailedname" name="detailedname" datatype="*2-16" nullmsg="详细名称不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品分类</label>
      <div class="formControls col-5"> <span class="select-box">
          <select id="category_shop_id" class="select" size="1" name="type" datatype="*" nullmsg="请选择商品分类！">
              <option value="" selected>请选择分类</option>
              <?php foreach($shopcate as $cate):?>
                 <option value="<?php echo $cate->categoryId;?>"><?php echo $cate->name;?></option>
              <?php endforeach;?>
          </select>
        </span> </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片1：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail1" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file1').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
     <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片2：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail2" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file2').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片3：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail3" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file3').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片4：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail4" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file4').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品图片5：</label>
      <div class="formControls col-5">
        <img src="" id="thumbnail5" style="max-width:90%;max-height:100px;">
        <span class="btn-upload form-group">
          <a href="javascript:$('#file5').click();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
        </span>
      </div>
      <div class="col-4"> </div>
    </div> 

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品特征：</label>
      <div class="formControls col-5">
         <?php foreach($feature as $cate):?>
            <input type="checkbox" name="category[]" id="category" value="<?php echo $cate->feature_id?>" /><?php echo $cate->feature_name?>
         <?php endforeach;?> 
      </div>
      <div class="col-4"> </div>
    </div>


    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品关键字：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="keywords" name="keywords" datatype="*1-16" nullmsg="关键字不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

     <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>单位：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="danwei" name="danwei" datatype="*1-8" nullmsg="单位不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

     <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>原价</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="original_price" name="original_price" datatype="*1-8" nullmsg="原价不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>价格</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="price" name="price" datatype="*1-8" nullmsg="价格不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>简介</label>
      <div class="formControls col-5">
        <textarea type="text" class="input-text"  placeholder="" id="description" name="description" datatype="*1-16" nullmsg="简介不能为空"></textarea>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否推荐商品：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="isrecommend-1" name="isrecommend" value="0" datatype="*" checked="checked">
          <label for="status-1">是</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="isrecommend-2" name="isrecommend" value="1">
          <label for="status-2">否</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否上架：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="status-1" name="status" value="0" datatype="*" checked="checked">
          <label for="status-1">立即上架</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="status-2" name="status" value="1">
          <label for="status-2">暂不上架</label>
        </div>
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
<form id="uploadImgThumb1" enctype="multipart/form-data">
    <input onchange="return uploadThumb1()" name="image" type="file" id="file1" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb2" enctype="multipart/form-data">
    <input onchange="return uploadThumb2()" name="image" type="file" id="file2" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb3" enctype="multipart/form-data">
    <input onchange="return uploadThumb3()" name="image" type="file" id="file3" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb4" enctype="multipart/form-data">
    <input onchange="return uploadThumb4()" name="image" type="file" id="file4" style="display:none;" accept="image/*">
</form>
<form id="uploadImgThumb5" enctype="multipart/form-data">
    <input onchange="return uploadThumb5()" name="image" type="file" id="file5" style="display:none;" accept="image/*">
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
      saveShopGoods(true,function(){
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