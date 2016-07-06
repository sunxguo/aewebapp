<title>店铺信息</title>
</head>
<body>
<div class="pd-20" style="padding-top:20px;">
  <p class="f-20 text-success">店铺余额信息<span class="f-14"></span></p>

  <table class="table table-border table-bordered table-bg mt-20">
    <thead>
      <tr>
        <th colspan="2" scope="col" >店铺余额信息</th>
      </tr>
    </thead>
    <tbody>
      
      <tr>
          <th width="400">绑定的支付宝账户</th>
          <td><?php echo $shopdata[0]->alipay_account?></td>
      </tr>

      <tr>
          <td>店铺绑定的支付宝帐户姓名</td>
          <td><?php echo $shopdata[0]->alipay_account_name?></td>
      </tr>

       <tr>
          <th width="400">店铺绑定的微信帐户</th>
          <td><?php echo $shopdata[0]->weixi_account?></td>
      </tr>

      <tr>
          <td>店铺绑定的微信帐户姓名</td>
          <td><?php echo $shopdata[0]->weixi_account_name?></td>
      </tr>

       <tr>
          <td>店铺余额</td>
          <td><?php echo $shopdata[0]->account_money?></td>
      </tr>
      
       <tr>
        <td colspan='2'>
          <a title="充值" href="/admin/shoprecharge">
            <div style="text-align:center;"><img src="http://shop.fengdukeji.com/assets/images/shangpintupian.png" width="80" /></div>
          </a>

           <a title="提现" href="javascript:;" onclick="member_edit('提现','/admin/cashoutadd','','','550')" style="">
            <div style="text-align:center;"><img src="http://shop.fengdukeji.com/assets/images/shangpintupian.png" width="80" /></div>
          </a>
        </td>   
      </tr>
     
    </tbody>
  </table>
</div>
<script type="text/javascript">
  /*用户-编辑*/
  function member_add(title,url,id,w,h){
    layer_show(title,url,w,h);
  }
  function member_edit(title,url,id,w,h){
    layer_show(title,url,w,h);
  }
</script>
</body>
</html>