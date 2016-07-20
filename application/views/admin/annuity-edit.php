<title>编辑年费</title>
<link href="/assets/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/assets/css/common.css" type="text/css" media="screen" />
</head>
<body>
  <form class="form form-horizontal" id="form-member-add">
    
    <input type="hidden" id="annuity_id" value="<?php echo $admin->annuity_id;?>">
    <div class="cl">
      <label class="form-label col-3"><span class="c-red">*</span>年费内容：</label>
        <div class="formControls col-5">
          <!-- <span id="supermarketname"></span> -->
          <textarea style="height: 350px;width: 330px;" id="annuity_content" name="annuity_content" class="xheditor-simple {skin:'o2007blue'}">
          <?php echo $admin->annuity_content;?>
          </textarea>
        </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>年费：</label>
        <div class="formControls col-5 skin-minimal">
                <input type="text" id="annuity_price" name="annuity_price" value="<?php echo $admin->annuity_price;?>"/>
        </div>
    </div>

    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;修改&nbsp;&nbsp;">
      </div>
    </div>
  </form>
<script type="text/javascript" src="/assets/lib/icheck/jquery.icheck.min.js"></script>
<script charset="utf-8" src="/assets/js/jquery.form.js"></script>
<script charset="utf-8" src="/assets/js/xheditor.js"></script>
<script charset="utf-8" src="/assets/js/zh-cn.js"></script>
<script type="text/javascript">
$(function(){
	
	$("#form-member-add").Validform({
    
		tiptype:2,
		callback:function(form){
      //alert('ok');
			// form[0].submit();
      saveFee(false,function(){
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