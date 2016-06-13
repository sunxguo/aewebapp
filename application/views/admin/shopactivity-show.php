<title>商品轮播图片查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
  <dl style="margin-left:80px; color:#fff">
    <!-- <dt><span class="f-18"><?php echo $activity[0]->shop->shop_name;?>-<?php echo $activity[0]->shop->shop_branch_name;?></span></dt> -->   
  </dl>
</div>
<div class="pd-20">
  <table class="table table-border table-bordered table-hover table-bg table-sort">
      <thead>
        <tr class="text-c">
          <th width="25"><input type="checkbox" name="id" value=""></th>
          <th width="100">活动标题</th>
          <th width="80">活动关键字</th>
          <th width="80">简介图</th>
          <th width="80">内容</th>
          <th width="80">位置</th>
          <th width="80">活动开始时间</th>
          <th width="80">活动结束时间</th>
          <th width="80">添加时间</th>
          <th width="80">修改时间</th>
          <th width="50">状态</th>
          
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($activitys)):?>
            <?php foreach($activitys as $activity):?>
              <tr class="text-c">
                <td><input type="checkbox" value="<?php echo $activity->activity_id;?>" name="id"></td>
                <td>
                    <?php if(isset($activity->activity_name)):?>
                        <?php echo $activity->activity_name;?>
                    <?php endif;?>    
                </td>
                <td><?php echo $activity->activity_keyword;?></td>
                <td><img src="<?php echo $activity->thumbnail1;?>" width="100"></td>
                <td><?php echo $activity->content;?></td>
                <td><?php echo $activity->site;?></td>
                <td><?php echo $activity->activity_begintime;?></td>
                <td><?php echo $activity->activity_endtime;?></td>
                <td><?php echo $activity->addtime;?></td>
                <td><?php echo $activity->dittime;?></td>  

                <?php if($activity->status=='0'):?>
                    <td class="td-status">
                      <span class="label label-defaunt radius">待发布</span>
                    </td>
                <?php elseif($activity->status=='1'):?>
                    <td class="td-status">
                      <span class="label label-success radius">进行中</span>
                    </td>
                <?php elseif($activity->status=='2'):?>
                    <td class="td-status">
                      <span class="label label-defaunt radius">已过期</span>
                    </td>
                <?php endif;?>
               
              </tr>
            <?php endforeach;?>
      <?php else:?>
        <tr class="text-c">
          <td colspan="11">暂无活动</td>
        </tr>
      <?php endif;?>
    </tbody>
  </table>
</div>
</body>
</html>