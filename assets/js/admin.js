$(document).ready(function(){
    $(".checkall").click(function(){
        var result=$(this).prop('checked');
        $(".check").prop("checked",result);
        checkListStyle();
    });
    $(".check").click(function(){
        checkListStyle();
    });
});
function adminLogin () {
    if($("#username").val()==''){
        showAlert('danger','用户名不能为空！','');
        return false;
    }
    if($("#password").val()==''){
        showAlert('danger','密码不能为空！','');
        return false;
    }
	
    if($("#verificationCode").val()==''){
        showAlert('danger','验证码不能为空！','');
        return false;
    }
	
    var admin = new Object();   
    admin.username = $("#username").val();
    admin.password = $("#password").val();
    admin.verificationCode = $("#verificationCode").val();
    dataHandler('/adminajax/login',admin,null,null,null,adminLoginSuccess,false,false);
}
function adminLoginSuccess(){
    location.href='/admin/index';
}
function reload(){
    location.reload();
}
function checkListStyle(){
    var allChecked=true;
    $(".data-item").each(function(index){
        var result=$(this).find('.checker span input').prop('checked');
        if(result){
            $(this).addClass('checked');
        }else{
            allChecked=false;
            $(this).removeClass('checked');
        }
    });
    $(".checkall").prop('checked',allChecked);
}

function uploadThumb(){
    uploadImage("#uploadImgThumb",beforeUpload,successHandler);

}
function beforeUpload(){
    $("#thumbnail").attr('src','/assets/images/loading.gif');
}
function successHandler(src){
    $("#thumbnail").attr('src',src);
}

//上传第一张图片
function uploadThumb1(){
    uploadImage("#uploadImgThumb1",beforeUpload1,successHandler1);
    // console.log();
}
function beforeUpload1(){
    $("#thumbnail1").attr('src','/assets/images/loading.gif');
}
function successHandler1(src){
    $("#thumbnail1").attr('src',src);
}
//上传第二张
function uploadThumb2(){
    uploadImage("#uploadImgThumb2",beforeUpload2,successHandler2);
    // console.log();
}
function beforeUpload2(){
    $("#thumbnail2").attr('src','/assets/images/loading.gif');
}
function successHandler2(src){
    $("#thumbnail2").attr('src',src);
}
//第三章
function uploadThumb3(){
    uploadImage("#uploadImgThumb3",beforeUpload3,successHandler3);
    // console.log();
}
function beforeUpload3(){
    $("#thumbnail3").attr('src','/assets/images/loading.gif');
}
function successHandler3(src){
    $("#thumbnail3").attr('src',src);
}
//上传第四张
function uploadThumb4(){
    uploadImage("#uploadImgThumb4",beforeUpload4,successHandler4);
    // console.log();
}
function beforeUpload4(){
    $("#thumbnail4").attr('src','/assets/images/loading.gif');
}
function successHandler4(src){
    $("#thumbnail4").attr('src',src);
}
//上传第五张
function uploadThumb5(){
    uploadImage("#uploadImgThumb5",beforeUpload5,successHandler5);
    // console.log();
}
function beforeUpload5(){
    $("#thumbnail5").attr('src','/assets/images/loading.gif');
}
function successHandler5(src){
    $("#thumbnail5").attr('src',src);
}

function searchBanner(){
    var extUrl='?placeholder=true';
    if($("#logmin").val()!=''){
        extUrl+='&startTime='+$("#logmin").val();
    }
    if($("#logmax").val()!=''){
        extUrl+='&endTime='+$("#logmax").val();
    }
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/bannerlist"+extUrl;
}
function searchBuyer(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#gender").val()!=-1) {
         extUrl+='&gender='+$("#gender").val();
    };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/buyerlist"+extUrl;
}
function searchSellerMarket(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    // if ($("#gender").val()!=-1) {
    //      extUrl+='&gender='+$("#gender").val();
    // };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    
    location.href="/admin/sellermarketlist"+extUrl;
}
function searchSellerDelivery(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    // if ($("#gender").val()!=-1) {
    //      extUrl+='&gender='+$("#gender").val();
    // };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/sellerdeliverylist"+extUrl;
}
function searchSellerPick(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    // if ($("#gender").val()!=-1) {
    //      extUrl+='&gender='+$("#gender").val();
    // };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/sellerpicklist"+extUrl;
}
function searchSuperMarket(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#type").val()!=-1) {
         extUrl+='&type='+$("#type").val();
    };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/supermarketlist"+extUrl;
}
function searchProduct(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#supermarket").val()!=-1) {
         extUrl+='&sid='+$("#supermarket").val();
    };
    if ($("#category").val()!=-1) {
         extUrl+='&categoryid='+$("#category").val();
    };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
     extUrl+='&isattend=0';
    location.href="/admin/productlist"+extUrl;
}
//按条件查询参加活动的商品
function searchActivitygoods(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#supermarket").val()!=-1) {
         extUrl+='&sid='+$("#supermarket").val();
    };
    if ($("#category").val()!=-1) {
         extUrl+='&categoryid='+$("#category").val();
    };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    extUrl+='&isattend='+ 1 ;
    location.href="/admin/activityarealist"+extUrl;
}

function searchOrder(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#supermarket").val()!=-1) {
         extUrl+='&sid='+$("#supermarket").val();
    };
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/orderlist"+extUrl;
}
function searchComment(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/commentlist"+extUrl;
}
function searchAddress(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/addresslist"+extUrl;
}
function searchCoupon(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#supermarket").val()!=-1) {
         extUrl+='&sid='+$("#supermarket").val();
    };
    // if($("#keywords").val()!=''){
    //     extUrl+='&keywords='+$("#keywords").val();
    // }
    location.href="/admin/couponlist"+extUrl;
}
//搜索优惠活动
function searchActivity(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if ($("#supermarket").val()!=-1) {
         extUrl+='&sid='+$("#supermarket").val();
    };
    // if($("#keywords").val()!=''){
    //     extUrl+='&keywords='+$("#keywords").val();
    // }
    location.href="/admin/activitylist"+extUrl;
}

function searchAdvice(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/advicelist"+extUrl;
}
function searchCategory(){
    var extUrl='?placeholder=true';
    if($("#datemin").val()!=''){
        extUrl+='&startTime='+$("#datemin").val();
    }
    if($("#datemax").val()!=''){
        extUrl+='&endTime='+$("#datemax").val();
    }
    if($("#keywords").val()!=''){
        extUrl+='&keywords='+$("#keywords").val();
    }
    location.href="/admin/getcategorybyshopid"+extUrl;
}

//操作管理员
function saveAdmin(isNew,callBack){
    //alert(87643);
    showWait();
    var admin = new Object();
    admin.infoType = 'admin';
    admin.username = $("#username").val();
    admin.password = $("#password").val();
    admin.type = $("#admintype").val();

    //alert(admin.type);
    var method='add';
    if(!isNew){
        admin.old_usename=$("#old_username").val();
        admin.admin_id = $("#admin_id").val();
        admin.status = $("input[name='status']:checked").val();
        method = 'modify';
        ///alert(method);
    }
    dataHandler('/common/'+method+'Info',admin,null,null,null,callBack,false,false);
    
}
//操作年费信息
function saveFee(isNew,callBack){
    //alert(87643);
    showWait();
    var admin = new Object();
    admin.infoType = 'fee';
    admin.username = $("#annuity_content").val();
    admin.password = $("#annuity_price").val();

    //alert(admin.type);
    var method='add';
    if(!isNew){
        admin.old_usename=$("#annuity_content").val();
        admin.admin_id = $("#annuity_id").val();
        admin.status = $("#annuity_price").val();
        method = 'modify';
        ///alert(method);
    }
    dataHandler('/common/'+method+'Info',admin,null,null,null,callBack,false,false);
    
}

//修改管理员密码
function savePassword(isNew,callBack){

    showWait();
    var admin = new Object(); 
    admin.infoType = 'password';
    admin.username = $("#username").val();
    admin.old_password=$("#old_password").val();
    admin.password = $("#password").val();
    admin.id = $("#id").val();
    //alert(admin.password);
    var method='modify';
    dataHandler('/common/'+method+'Info',admin,null,null,null,callBack,true,false);
    
}

/*
*
* 操作审核员  添加 修改
*
*/
//操作店铺审核员
function saveShopAdmin(isNew,callBack){

    showWait();
    var admin = new Object(); 
    admin.infoType = 'shopadmin';
    admin.username = $("#username").val();
    admin.password = $("#password").val();
    admin.type = 7;
    admin.grade=1;
    admin.status=1;
    //alert(admin.status);
    var method='add';
    if(!isNew){
        admin.old_usename=$("#old_username").val();
        admin.id = $("#id").val();
        admin.status = $("input[name='status']:checked").val();
        method = 'modify';

    }
    dataHandler('/common/'+method+'AdminInfo',admin,null,null,null,callBack,false,false);
    
}

//操作年费审核员
function saveAnnuityAdmin(isNew,callBack){

    showWait();
    var admin = new Object(); 
    admin.infoType = 'shopadmin';
    admin.username = $("#username").val();
    admin.password = $("#password").val();
    admin.type = 7;
    admin.grade=3;
    admin.status=1;
    var method='add';
    if(!isNew){
        admin.old_usename=$("#old_username").val();
        admin.id = $("#id").val();
        admin.status = $("input[name='status']:checked").val();
        method = 'modify';

    }
    dataHandler('/common/'+method+'AdminInfo',admin,null,null,null,callBack,false,false);
    
}


//操作关注审核员
function saveAttentionAdmin(isNew,callBack){

    showWait();
    var admin = new Object(); 
    admin.infoType = 'shopadmin';
    admin.username = $("#username").val();
    admin.password = $("#password").val();
    admin.type = 3;
    admin.grade=1;
    admin.status=1;
    //alert(admin.status);
    var method='add';
    if(!isNew){
        admin.old_usename=$("#old_username").val();
        admin.id = $("#id").val();
        admin.status = $("input[name='status']:checked").val();
        method = 'modify';

    }
    dataHandler('/common/'+method+'AdminInfo',admin,null,null,null,callBack,false,false);
    
}

//操作附近审核员
function saveNearbyAdmin(isNew,callBack){

    showWait();
    var admin = new Object(); 
    admin.infoType = 'shopadmin';
    admin.username = $("#username").val();
    admin.password = $("#password").val();
    admin.type = 4;
    admin.grade=1;
    admin.status=1;
    //alert(admin.status);
    var method='add';
    if(!isNew){
        admin.old_usename=$("#old_username").val();
        admin.id = $("#id").val();
        admin.status = $("input[name='status']:checked").val();
        method = 'modify';

    }
    dataHandler('/common/'+method+'AdminInfo',admin,null,null,null,callBack,false,false);
    
}

//操作附近审核员
function saveSearchAdmin(isNew,callBack){

    showWait();
    var admin = new Object(); 
    admin.infoType = 'shopadmin';
    admin.username = $("#username").val();
    admin.password = $("#password").val();
    admin.type = 6;
    admin.grade=1;
    admin.status=1;
    //alert(admin.status);
    var method='add';
    if(!isNew){
        admin.old_usename=$("#old_username").val();
        admin.id = $("#id").val();
        admin.status = $("input[name='status']:checked").val();
        method = 'modify';

    }
    dataHandler('/common/'+method+'AdminInfo',admin,null,null,null,callBack,false,false);
    
}


//操作推荐审核员
function saveAdAdmin(isNew,callBack){

    showWait();
    var admin = new Object(); 
    admin.infoType = 'shopadmin';
    admin.username = $("#username").val();
    admin.password = $("#password").val();
    admin.type = 5;
    admin.grade=1;
    admin.status=1;
    //alert(admin.status);
    var method='add';
    if(!isNew){
        admin.old_usename=$("#old_username").val();
        admin.id = $("#id").val();
        admin.status = $("input[name='status']:checked").val();
        method = 'modify';

    }
    dataHandler('/common/'+method+'AdminInfo',admin,null,null,null,callBack,false,false);
    
}

//操作广告时间
function saveAdtime(isNew,callBack){
    showWait();
    var adtime = new Object(); 
    adtime.infoType = 'adtime';
    adtime.ad_time = $("#ad_time").val();
    if(isNaN(adtime.ad_time))
    {
        $("#returned").text('请输入正确的数值');return;
    }
    //alert(adtime.ad_time);
    var method='add';
    if(!isNew){
        adtime.ad_time_id = $("#ad_time_id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',adtime,null,null,null,callBack,false,false);
    
}


//操作广告类型
function saveadcategory(isNew,callBack){
    showWait();
    var adcatetype = new Object(); 
    adcatetype.infoType = 'adcatetype';
    adcatetype.ad_name = $("#ad_spot_type_name").val();
    adcatetype.ad_price = $("#ad_spot_type_unit_price").val();
    var method='add';
    if(!isNew){
        adcatetype.ad_spot_type_id = $("#ad_spot_type_id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',adcatetype,null,null,null,callBack,false,false);
    
}

//修改审核员信息
function editAdmindata(isNew,callBack){
    showWait();
    var admindata = new Object(); 
    admindata.infoType = 'admindata';
    admindata.old_username = $("#old_username").val();
    admindata.username = $("#username").val();
    admindata.status= $("input[name='status']:checked").val();
    admindata.admin_id = $("#admin_id").val();
    var method = 'modify';
   
    dataHandler('/common/'+method+'Info',admindata,null,null,null,callBack,false,false);
    
}


function addBannerSuccessHandler(){
    $("#waitDiv").hide(100);
    showAlert('success','保存成功！正在刷新...','');
    setTimeout(function(){
        location.reload();
    },2000);
}
function saveAboutus(isNew){
    if($("#role").val()==''){
        alert('请选择客户端！');
        $("#role").focus();
        return false;
    }
    if($("#version").val()==''){
        alert('请输入版本号！');
        $("#version").focus();
        return false;
    }
    if($("#thumbnail").attr('src')==''){
        alert('请选择Logo！');
        return false;
    }
    if($("#appname").val()==''){
        alert('请输入App名称！');
        $("#appname").focus();
        return false;
    }
    showWait();
    var aboutus = new Object(); 
    aboutus.infoType = 'aboutus';
    aboutus.role = $("#role").val();
    aboutus.version = $("#version").val();
    aboutus.appname = $("#appname").val();
    aboutus.logo = $("#thumbnail").attr('src');
    aboutus.content = contentEditor.html();
    var method='add';
    if(!isNew){
        aboutus.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',aboutus,null,null,null,addBannerSuccessHandler,false,false);
}
function saveSeller(isNew,callBack){
    showWait();
    var seller = new Object(); 
    seller.infoType = 'seller';
    seller.role = $("#role").val();
    seller.sid = $("#subsupermarket").val();
    seller.workno = $("#workno").val();
    seller.name = $("#name").val();
    seller.gender = $("input[name='gender']:checked").val();
    seller.phone = $("#phone").val();
    if($("#password").length > 0){
        seller.password = $("#password").val();
    }
    seller.status = $("input[name='status']:checked").val();
    seller.photo = $("#thumbnail").attr('src');
    var method='add';
    if(!isNew){
        seller.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',seller,null,null,null,callBack,false,false);
}

//操作优惠券
function saveCoupon(isNew,callBack){
    var coupon_facevalue = $("#coupon_facevalue").val();
    var coupon_useprice = $("#coupon_useprice").val();
    var coupon_beginvalid = $("#coupon_beginvalid").val();
    var coupon_endvalid = $("#coupon_endvalid").val();
    value='';
    if(coupon_beginvalid == value) 
    {
        alert('优惠券起始时间必须添加');
        return false;
    }
    if(coupon_endvalid == value) 
    {
        alert('优惠券截止时间必须添加');
        return false;
    }
    if( parseInt(coupon_useprice) < parseInt(coupon_facevalue))
    {
        alert('使用条件不能小于面值！');
        return false;
    }
    showWait();
    var coupon = new Object(); 
    coupon.infoType = 'coupons';
    coupon.coupon_facevalue = $("#coupon_facevalue").val();
    coupon.coupon_useprice = $("#coupon_useprice").val();
    coupon.coupon_beginvalid = $("#coupon_beginvalid").val();
    coupon.coupon_endvalid = $("#coupon_endvalid").val();
    var method='add';
    if(!isNew){
        coupon.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'BulkInfo',coupon,null,null,null,callBack,false,false);
}

function getOrderBystutas()
{
    //alert($("#orderstatus").val());
    if($("#orderstatus").val()!=''){
       extUrl = $("#orderstatus").val();
    }
    location.href="/admin/getOrderAll?extUrl="+extUrl;
}

//操作口令集
function saveWord(isNew,callBack){
    var word_begintime = $("#word_begintime").val();
    var word_endtime = $("#word_endtime").val();
    value='';
    if(word_begintime == value) 
    {
        alert('口令集起始时间必须添加');
        return false;
    }
    if(word_endtime == value)
    {
        alert('口令集截止时间必须添加');
        return false;
    }


    showWait();
    var word = new Object(); 
    word.infoType = 'word';
    word.word_discount = $("#word_discount").val();
    word.word_good = $("#shopgoods").val();
    word.word_prime_cost = $("#word_prime_cost").val();
    word.word_content = $("#worditem").val();
    word.word_begintime = $("#word_begintime").val();
    word.word_endtime = $("#word_endtime").val();
  
    var method='add';
    if(!isNew){
        word.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'BulkInfo',word,null,null,null,callBack,false,false);
}
function saveSubSuperMarket(isNew,callBack){
    showWait();
    var subsupermarket = new Object(); 
    subsupermarket.infoType = 'subsupermarket';
    subsupermarket.supermarket = $("#supermarket").val();
    subsupermarket.sno = $("#sno").val();
    subsupermarket.sname = $("#sname").val();
    subsupermarket.province = $("#province").val();
    subsupermarket.city = $("#city").val();
    subsupermarket.area = $("#area").val();
    subsupermarket.parentid = $("#supermarket").val();
    subsupermarket.detailedarea = $("#detailedarea").val();
    subsupermarket.logo = $("#thumbnail").attr('src');
    subsupermarket.lng = $("#lng").val();
    subsupermarket.lat = $("#lat").val();
    subsupermarket.status = $("input[name='status']:checked").val();
    var method='add';
    if(!isNew){
        subsupermarket.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',subsupermarket,null,null,null,callBack,false,false);
}
function updateSubSuperMarket(isNew,callBack){
    showWait();
    var subsupermarket = new Object(); 
    subsupermarket.infoType = 'supermarket';
    subsupermarket.supermarket = $("#supermarket").val();
    subsupermarket.sno = $("#sno").val();
    subsupermarket.sname = $("#sname").val();
    subsupermarket.province = $("#province").val();
    subsupermarket.city = $("#city").val();
    subsupermarket.area = $("#area").val();
    subsupermarket.parentid = $("#supermarket").val();
    subsupermarket.detailedarea = $("#detailedarea").val();
    subsupermarket.logo = $("#thumbnail").attr('src');
    subsupermarket.lng = $("#lng").val();
    subsupermarket.lat = $("#lat").val();
    subsupermarket.status = $("input[name='status']:checked").val();
    var method='';
    if(!isNew){
        subsupermarket.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',subsupermarket,null,null,null,callBack,false,false);
}

function saveSuperMarket(isNew,callBack){
    showWait();
    var supermarket = new Object(); 
    supermarket.infoType = 'supermarket';
    supermarket.no = $("#no").val();
    supermarket.sno = $("#sno").val();
    supermarket.name = $("#name").val();
    supermarket.logo = $("#thumbnail").attr('src');
    supermarket.status = $("input[name='status']:checked").val();
    var method='add';
    if(!isNew){
        supermarket.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',supermarket,null,null,null,callBack,false,false);
}
//添加商品

function saveProduct(isNew,callBack){
    showWait();
    var product = new Object(); 
    //alert(product);
    product.infoType = 'product';
    product.sid = $("#supermarket").val();
    product.categoryid = $("#category").val();
    product.name = $("#name").val();
    product.detailedname = $("#detailedname").val();
    product.barcode = $("#barcode").val();
    product.price = $("#price").val();
    product.actualprice = $("#actualprice").val();
    product.count = $("#count").val();
    product.description = $("#description").val();
    product.expressfee = $("#expressfee").val();
    product.photo1 = $("#thumbnail1").attr('src');
    product.photo2 = $("#thumbnail2").attr('src');
    product.photo3 = $("#thumbnail3").attr('src');
    product.photo4 = $("#thumbnail4").attr('src');
    product.photo5 = $("#thumbnail5").attr('src');
    product.isattend = $("input[name='isattend']:checked").val();
    product.isrecommend = $("input[name='isrecommend']:checked").val();
    product.detailedname = $("#detailedname").val();
    product.barcode = $("#barcode").val();
    product.price = $("#price").val();
    product.photo = $("#thumbnail").attr('src');
    product.status = $("input[name='status']:checked").val();
    var method='add';
    if(!isNew){
        product.id = $("#id").val();
        method = 'modify';
    }
    //alert('123456');
    dataHandler('/common/'+method+'Info',product,null,null,null,callBack,false,false);
}
//修改商品
function updateProduct(isNew,callBack){
    showWait();
    var product = new Object(); 
    //alert(product);
    product.infoType = 'product';
    product.sid = $("#supermarket").val();
    product.categoryid = $("#category").val();
    product.name = $("#name").val();
    product.detailedname = $("#detailedname").val();
    product.barcode = $("#barcode").val();
    product.price = $("#price").val();
    product.actualprice = $("#actualprice").val();
    product.count = $("#count").val();
    product.description = $("#description").val();
    product.expressfee = $("#expressfee").val();
    product.photo1 = $("#thumbnail1").attr('src');
    product.photo2 = $("#thumbnail2").attr('src');
    product.photo3 = $("#thumbnail3").attr('src');
    product.photo4 = $("#thumbnail4").attr('src');
    product.photo5 = $("#thumbnail5").attr('src');
    // product.isedit = $("input[name='isedit']:checked").val();
    product.isattend = $("input[name='isattend']:checked").val();
    product.isrecommend = $("input[name='isrecommend']:checked").val();
    product.status = $("input[name='status']:checked").val();
    var method='';
    if(!isNew){
        product.id = $("#id").val();
        method = 'modify';
    }
    //alert('123456');
    dataHandler('/common/'+method+'Info',product,null,null,null,callBack,false,false);
}

function saveCategory(isNew,callBack)
{
    showWait();
    var category = new Object(); 
    category.infoType = 'category';
    category.sid = $("#supermarket").val();
    //category.order = $("#order").val();
    category.supername = $("#supername").val();
    var method='add';
    if(!isNew)
    {
        category.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',category,null,null,null,callBack,false,false);
}
//修改分类
function updateCategory(isNew,callBack)
{
    showWait();
    var category = new Object(); 
    category.infoType = 'category';
    category.order = $("#order").val();
    category.name = $("#name").val();
    category.supername = $("#supername").val();
    var method='';
    if(!isNew)
    {
        category.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',category,null,null,null,callBack,false,false);
}


//添加一级分类
function addCategory(isNew,callBack)
{
    showWait(); 
    var category = new Object(); 
    category.infoType = 'category';
    category.name = $("#name").val();
    category.describe_shop = $("#describe_shop").val();
    category.orders = $("#orders").val();
    category.status = $("input[name='status']:checked").val();
    var method='add';
    dataHandler('/common/'+method+'Category',category,null,null,null,callBack,false,false);
}

//修改一级分类
function editCategory(isNew,callBack)
{
    showWait(); 
    var category = new Object(); 
    category.infoType = 'onecategory';
    category.name = $("#name").val();
    category.describe_shop = $("#describe_shop").val();
    category.orders = $("#orders").val();
    category.status = $("input[name='status']:checked").val();
    var method='add';
    if(!isNew)
    {
        category.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',category,null,null,null,callBack,false,false);
}

//修改二级分类
function editSubCategory(isNew,callBack)
{
    showWait(); 
    var category = new Object(); 
    category.infoType = 'onecategory';
    category.twoid = $("#twoid").val();
    category.name = $("#name").val();
    category.describe_shop = $("#describe_shop").val();
    category.orders = $("#orders").val();
    category.status = $("input[name='status']:checked").val();
    var method='add';
    if(!isNew)
    {
        category.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',category,null,null,null,callBack,false,false);
}


//添加二级分类
function saveSubCategory(isNew,callBack)
{
    showWait();
    var subcategory = new Object(); 
    subcategory.infoType = 'subcategory';
    subcategory.twoid = $("#category").val();
    subcategory.name = $("#name").val();
    subcategory.describe_shop = $("#describe_shop").val();
    // subcategory.orders = $("#orders").val();
    subcategory.status = $("input[name='status']:checked").val();
    //alert(subcategory.twoid);
    var method='add';
    if(!isNew)
    {
        subcategory.id = $("#id").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'SubCategory',subcategory,null,null,null,callBack,false,false);
}


function saveSellerPassword(callBack){
    showWait();
    var seller = new Object(); 
    seller.infoType = 'seller';
    seller.id = $("#id").val();
    seller.password = $("#new-password").val();
    dataHandler('/common/modifyInfo',seller,null,null,null,callBack,false,false);
}
function getSubSupermarkets(){
    showWait();
    var supermarket = new Object(); 
    supermarket.infoType = 'subSupermarkets';
    supermarket.id = $("#supermarket").val();
    dataHandler('/common/getInfo',supermarket,null,null,null,getSubSupermarketsSuccess,false,false);
}
function getSubSupermarketsSuccess(subSupermarkets){
    var htmlOption='<option value="" selected>请选择具体超市</option>';
    for (var i = 0; i < subSupermarkets.length; i++) {
        htmlOption+='<option value="'+subSupermarkets[i].id+'">'+subSupermarkets[i].sname+'</option>'
    };
    $("#subsupermarket").html(htmlOption);
    closeWait();
}
//////
// function getCategories(){
//     showWait();
//     var supermarket = new Object(); 
//     supermarket.infoType = 'categories';
//     supermarket.id = $("#supermarket").val();
//     dataHandler('/common/getInfo',supermarket,null,null,null,getCategoriesSuccess,false,false);
// }
// function getCategoriesSuccess(categories){
//     var htmlOption='<option value="" selected>请选择分类</option>';
//     for (var i = 0; i < categories.length; i++) {
//         htmlOption+='<option value="'+categories[i].id+'">'+categories[i].name+'</option>'
//     };
//     $("#category").html(htmlOption);
//     closeWait();
// }

function getCategories(){
    showWait();
    var supermarket = new Object(); 
    supermarket.infoType = 'supcategories';
    supermarket.id = $("#supermarket").val();
    dataHandler('/common/getInfo',supermarket,null,null,null,getCategoriesSuccess,false,false);
}
function getCategoriesSuccess(categories){
    var htmlOption='<option value="" selected>请选择分类</option>';
    for (var i = 0; i < categories.length; i++) {
        htmlOption+='<option value="'+categories[i].id+'">'+categories[i].name+'</option>'
    };
    $("#category").html(htmlOption);
    closeWait();
}
//添加二级分类选择超市
function getSubCategories(){
    showWait();
    var supermarket = new Object(); 
    supermarket.infoType = 'categories';
    supermarket.id = $("#supermarket").val();
    dataHandler('/common/getInfo',supermarket,null,null,null,getsSubCategoriesSuccess,false,false);
}
//添加二级分类 根据超市获取对应的一级分类
function getsSubCategoriesSuccess(categories){
    var htmlOption='<option value="" selected>请选择分类</option>';
    for (var i = 0; i < categories.length; i++) {
        htmlOption+='<option value="'+categories[i].superid+'">'+categories[i].supername+'</option>'
    };
    $("#category").html(htmlOption);
    closeWait();
}
function getSelectCategories()
{
    showWait();
    var supermarket = new Object(); 
    supermarket.infoType = 'supcategories';
    supermarket.id = $("#supermarket").val();
    dataHandler('/common/getInfo',supermarket,null,null,null,getSelectCategoriesSuccess,false,false);
}
function getSelectCategoriesSuccess(categories){
    var htmlOption='<option value="-1" selected>所有</option>';
    for (var i = 0; i < categories.length; i++)
    {
        htmlOption+='<option value="'+categories[i].id+'">'+categories[i].name+'</option>'
    };
    $("#category").html(htmlOption);
    closeWait();
}
function setSupermarketLogo(){
  if($("#supermarket").val()!=''){
    showWait();
    var supermarket = new Object(); 
    supermarket.infoType = 'supermarket';
    supermarket.id = $("#supermarket").val();
    dataHandler('/common/getInfo',supermarket,null,null,null,getSupermarketSuccess,false,false);
    
  }
}

//添加二级分类
// function setSupermarketLogo()
// {
//   if($("#category").val()!='')
//   {
//     showWait();
//     var category = new Object(); 
//     category.infoType = 'category';
//     category.id = $("#category").val();
//     dataHandler('/common/getInfo',categories,null,null,null,getCategorySuccess,false,false);
    
//   }
// }

/*查出口令分类*/
function getwordstor(){
    showWait();
    var word = new Object(); 
    word.infoType = 'wordsort';
    word.id = $("#wordsort").val();
    dataHandler('/common/getInfo',word,null,null,null,getworditem,false,false);
}

/*查出对应的详情*/
function getworditem(worditem){
    var htmlOption='<option value="" selected>请选择口令分类</option>';
    for (var i = 0; i < worditem.length; i++) {
        htmlOption+='<option value="'+worditem[i].wordItemId+'">'+worditem[i].wordItemName+'</option>'
    };
    $("#worditem").html(htmlOption);
    closeWait();
}

/*查出商品分类*/
function getshopcategory(){
    showWait();
    var word = new Object(); 
    word.infoType = 'shopcategory';
    word.id = $("#shopcategory").val();
    dataHandler('/common/getInfo',word,null,null,null,getshopgoods,false,false);
}

/*添加今日市价*/
function addTodayprice(isNew,callBack){

    var exp=/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/;
    var today_min_price=$("#today_min_price").val();
    var today_max_price=$("#today_max_price").val();
    var today_orders=$("#today_orders").val();
    if(!exp.test(today_min_price))
    {
        alert('今日最低价必须为非负数');
    }
    if(!exp.test(today_max_price))
    {
        alert('今日最高价必须为非负数');
    } 

    if(isNaN(today_orders))
    {
        alert('序号必须为正整数');
    }
    showWait();
    var todayprice = new Object(); 
    todayprice.infoType = 'todayprice';
    todayprice.today_goods_name = $("#today_goods_name").val();
    todayprice.today_min_price = $("#today_min_price").val();
    todayprice.today_max_price = $("#today_max_price").val();
    todayprice.today_orders = $("#today_orders").val();
    method = 'add';
    if(!isNew){
        todayprice.todayId=$("#todayId").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',todayprice,null,null,null,callBack,false,false);
}

/*查出对应的商品*/
function getshopgoods(shopgoods){
    var htmlOption='<option value="" selected>请选择口令商品</option>';
    for (var i = 0; i < shopgoods.length; i++){
        htmlOption+='<option value="'+shopgoods[i].detailedname+'">'+shopgoods[i].detailedname+'</option>'
    };
    $("#shopgoods").html(htmlOption);
    closeWait();
}

//操作口令分类
function addwordsort(isNew,callBack){

    showWait();
    var word = new Object(); 
    word.infoType = 'wordsort';
    word.word_sort_name = $("#word_sort_name").val();
    var method='add';
    if(!isNew){
        word.wordSortId=$("#wordSortId").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',word,null,null,null,callBack,false,false);
    
}

//操作口令分类详情
function addworditem(isNew,callBack){

    showWait();
    var word = new Object(); 
    word.infoType = 'worditem';
    word.word_item_sort_id = $("#wordid").val();
    word.word_item_name = $("#word_item_name").val();
    var method='add';
    if(!isNew){
        word.word_item_id=$("#itemid").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',word,null,null,null,callBack,false,false);
    
}

//操作口令分类详情
function addworditemshop(isNew,callBack){

    showWait();
    var word = new Object(); 
    word.infoType = 'worditemadd';
    word.word_item_name = $("#word_item_name").val();
    var method='add';
    if(!isNew){
        word.word_item_id=$("#itemid").val();
        method = 'modify';
    }
    dataHandler('/common/'+method+'Info',word,null,null,null,callBack,false,false);
    
}


//操作口令分类详情
function editworditem(isNew,callBack){

    showWait();
    var word = new Object(); 
    word.infoType = 'worditem';
    word.word_item_id = $("#itemid").val();
    word.word_item_name = $("#word_item_name").val();
    var method='modify';
    dataHandler('/common/'+method+'Info',word,null,null,null,callBack,false,false);
    
}


function getSupermarketSuccess(supermarket){
    $("#thumbnail").attr('src',supermarket.logo);
    closeWait();
}
//添加优惠活动
function saveActivity(isNew,callBack)
{
    
    var value="";
    var thumbnail1=$("#thumbnail1").attr('src');
    var activity_begintime = $("#coupon_beginvalid").val();
    var activity_endtime = $("#coupon_endvalid").val();
    if(thumbnail1 == value)
    {
        alert('简介图必须添加');
        return false;
    }
   
    if(activity_begintime == value) 
    {
        alert('优惠活动起始时间必须添加');
        return false;
    }
    if(activity_endtime == value) 
    {
        alert('优惠活动结束时间必须添加');
        return false;
    }

    showWait();
    var activity = new Object();
    activity.infoType = 'activity';
    activity.activity_id = $("#activity_id").val();
    activity.activity_name = $("#activity_name").val();
    activity.activity_keyword = $("#activity_keyword").val();
    activity.content = $("#content").val();
    activity.thumbnail1 = $("#thumbnail").attr('src');
    activity.activity_begintime = $("#coupon_beginvalid").val();
    activity.activity_endtime = $("#coupon_endvalid").val();
    activity.status = $("input[name='status']:checked").val();
    
    var method='add';
    if(!isNew){
        activity.activity_id = $("#activity_id").val();
        method = 'modify';
    }

    dataHandler('/common/'+method+'Info',activity,null,null,null,callBack,false,false);
}

//添加商品分类
function saveShopCategory(isNew,callBack)
{
    showWait();
    var category = new Object(); 
    category.infoType = 'category';
    category.name = $("#name").val();
    category.describe_shop = $("#describe_shop").val();
    category.status = $("input[name='status']:checked").val();
    // category.orders = $("#orders").val();

    var method='add';
    if(!isNew){

        /*判断序号是否为正整数*/
        var value="";
        var orders=$("#orders").val();
        if(isNaN(orders))
        {
            alert('序号必须为正整数');
        }

        category.categoryId = $("#categoryId").val();
        method = 'modify';

    }

    dataHandler('/common/'+method+'Info',category,null,null,null,callBack,false,false);
}

//添加商品
function saveShopGoods(isNew,callBack)
{
    showWait();
    /*获取多选框选中的值*/
    var str=document.getElementsByName("category[]");
        //alert(str);
        var objarray=str.length;
        var chestr=new Array();
        for (i=0;i<objarray;i++)
        {
          if(str[i].checked == true)
          {
           chestr.push(str[i].value);
          }
        }
    var exp=/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/;
    var original_price=$("#original_price").val();
    var price=$("#price").val();
    if(!exp.test(original_price))
    {
        alert('原价必须为非负数');
    }
    if(!exp.test(price))
    {
        alert('价格必须为非负数');
    }
    var product = new Object(); 
    product.infoType = 'product';
    product.name = $("#name").val();
    product.detailedname = $("#detailedname").val();
    product.category_shop_id = $("#category_shop_id").val();
    product.keywords = $("#keywords").val();
    product.original_price = $("#original_price").val();
    product.description = $("#description").val();
    product.danwei = $("#danwei").val();
    product.price = $("#price").val();
    product.goods_feature_id = chestr;
    product.pic1 = $("#thumbnail1").attr('src');
    product.pic2 = $("#thumbnail2").attr('src');
    product.pic3 = $("#thumbnail3").attr('src');
    product.pic4 = $("#thumbnail4").attr('src');
    product.pic5 = $("#thumbnail5").attr('src');
    product.isrecommend = $("input[name='isrecommend']:checked").val();
    product.status = $("input[name='status']:checked").val();
    var method='add';
    if(!isNew){
        product.goodsId = $("#goodsId").val();
        method = 'modify';

    }

    dataHandler('/common/'+method+'Info',product,null,null,null,callBack,false,false);
}



//添加商圈
function saveBusinessdistrict(isNew,callBack)
{
    
    var value="";
    var thumbnail1=$("#thumbnail").attr('src');
    //alert($("#thumbnail").attr('src'));
    //经度纬度
    // var business_lng=$("#business_lng").attr('src');
    // var business_lat=$("#business_lat").attr('src');

    if(thumbnail1 == value)
    {
        alert('logo图必须添加');
        return false;
    }
    showWait();
    var businessdistrict = new Object(); 
    businessdistrict.infoType = 'businessdistrict';
    businessdistrict.business_province = $("#cmbProvince").val();
    businessdistrict.business_city = $("#cmbCity").val();
    businessdistrict.business_area = $("#cmbArea").val();
    businessdistrict.business_logo = $("#thumbnail").attr('src');
    businessdistrict.business_address = $("#business_address").val();
    businessdistrict.business_name = $("#business_name").val();
    businessdistrict.business_comments = $("#business_comments").val();
    businessdistrict.business_mart = $("#business_mart").val();
    businessdistrict.business_street = $("#business_street").val();
    businessdistrict.business_lng = $("#business_lng").val();
    businessdistrict.business_lat = $("#business_lat").val();
    businessdistrict.business_status = $("input[name='business_status']:checked").val();
    
    var method='add';
    if(!isNew){
        businessdistrict.businessId = $("#businessId").val();
        method = 'modify';
    }

    dataHandler('/common/'+method+'Info',businessdistrict,null,null,null,callBack,false,false);
}

    //添加分类特征
    function saveCateFeature(isNew,callBack)
    {

        showWait();
        var catefeature = new Object(); 
        catefeature.infoType = 'catefeature';
        // catefeature.feature_category_id = $("#feature_category_id").val();
        catefeature.feature_name = $("#feature_name").val();     
        var method='add';
        if(!isNew){
            catefeature.feature_id = $("#feature_id").val();
            method = 'modify';
        }

        dataHandler('/common/'+method+'Info',catefeature,null,null,null,callBack,false,false);
    }

    //添加二级分类特征
    function saveSubCateFeature(isNew,callBack)
    {

        showWait();
        var str=document.getElementsByName("category[]");
        //alert(str);
        var objarray=str.length;
        var chestr=new Array();
        for (i=0;i<objarray;i++)
        {
          if(str[i].checked == true)
          {
           chestr.push(str[i].value);
          }
        }
        //alert(chestr);
        
        var catefeature = new Object();
        catefeature.infoType = 'subcatefeature';
        catefeature.feature_category_id = $("#feature_category_id").val();
        catefeature.feature_name = chestr;
        //alert(catefeature.feature_name);
        var method='add';
        if(!isNew){
            catefeature.feature_id = $("#feature_id").val();
            method = 'modify';
        }

        dataHandler('/common/'+method+'Info',catefeature,null,null,null,callBack,false,false);
    }

    //添加分类特征值
    function saveCateFeatureVal(isNew,callBack)
    {

        showWait();
        var catefeature = new Object(); 
        catefeature.infoType = 'catefeatureval';
        catefeature.feature_id = $("#feature_id").val();
        catefeature.eigenvalue_name = $("#eigenvalue_name").val();     
        var method='add';
        if(!isNew){
            catefeature.eigen_id = $("#eigenvalue_id").val();
            catefeature.feature_id = $("#feature_id").val();
            method = 'modify';
        }

        dataHandler('/common/'+method+'Info',catefeature,null,null,null,callBack,false,false);
    }


//修改店铺信息

function saveShopData(callBack)
{
   
    var value="";
    var thumbnail=$("#thumbnail").attr('src');
    //经度纬度

    if(thumbnail == value)
    {
        alert('logo图必须添加');
        return false;
    }

    if(thumbnail1 == value)
    {
        alert('头部轮播图必须全部添加');
        return false;
    }
    if(thumbnail2 == value)
    {
        alert('头部轮播图必须全部添加');
        return false;
    }
    if(thumbnail3 == value)
    {
        alert('头部轮播图必须全部添加');
        return false;
    }
    if(thumbnail4 == value)
    {
        alert('头部轮播图必须全部添加');
        return false;
    }

    if(thumbnail5 == value)
    {
        alert('头部轮播图必须全部添加');
        return false;
    }

    showWait();
    var usershop = new Object(); 
    usershop.infoType = 'usershop';
    usershop.shopName = $("#shopName").val();
    usershop.shopBranchName = $("#shopBranchName").val();
    usershop.shopKeywords = $("#shopKeywords").val();
    usershop.thumbnail = $("#thumbnail").attr('src');
    usershop.thumbnail1 = $("#thumbnail1").attr('src');
    usershop.thumbnail2 = $("#thumbnail2").attr('src');
    usershop.thumbnail3 = $("#thumbnail3").attr('src');
    usershop.thumbnail4 = $("#thumbnail4").attr('src');
    usershop.thumbnail5 = $("#thumbnail5").attr('src');
    usershop.shopBuinourPhone = $("#shopBuinourPhone").val();
    usershop.shopQrcode = $("#shopQrcode").val();
    usershop.shopProvince = $("#shopProvince").val();
    usershop.shopCity = $("#shopCity").val();
    usershop.shopArea = $("#shopArea").val();
    usershop.shopDetailAddress = $("#shopDetailAddress").val();
    usershop.shopWifiStatus = $("input[name='shopWifiStatus']:checked").val();
    usershop.shopWifiUsername = $("#shopWifiUsername").val();
    usershop.shopWifiPassword = $("#shopWifiPassword").val();
    usershop.amstart = $("#amstart").val();
    usershop.amstop = $("#amstop").val();
    usershop.pmstart = $("#pmstart").val();
    usershop.pmstop = $("#pmstop").val();
    usershop.shopTel = $("#shopTel").val();
    usershop.shopLng = $("#shopLng").val();
    usershop.shopLat = $("#shopLat").val();
    var method = 'modify';
   

    dataHandler('/common/'+method+'Info',usershop,null,null,null,callBack,false,false);
}


//添加平台信息
    function saveReminder(isNew,callBack)
    {

        showWait();
        var reminder = new Object();
        reminder.infoType = 'reminder';
        reminder.msg_content = $("#msg_content").val();
        reminder.msg_status = $("input[name='msg_status']:checked").val();
        var method='add';
        
        dataHandler('/common/'+method+'Info',reminder,null,null,null,callBack,false,false);
    }
//添加平台信息
    function editReminder(isNew,callBack)
    {

        showWait();
        var reminder = new Object();
        reminder.infoType = 'reminder';
        reminder.msg_content = $("#msg_content").val();
        reminder.msg_status = $("input[name='msg_status']:checked").val();
        reminder.msg_id = $("#msg_id").val();
        var method='modify';
        
        dataHandler('/common/'+method+'Info',reminder,null,null,null,callBack,false,false);
    }




// function uploadThumb1(){
//     uploadImageAdvance("#uploadImgThumb1",beforeUpload1,successHandler1);
// }
// function beforeUpload1(){
//     $("#thumbnail1").attr('src','/assets/images/cms/loading.gif');
// }
// function successHandler1(src){
//     $("#thumbnail1").attr('src',src);
// }
// function uploadThumb2(){
//     uploadImageAdvance("#uploadImgThumb2",beforeUpload2,successHandler2);
// }
// function beforeUpload2(){
//     $("#thumbnail2").attr('src','/assets/images/cms/loading.gif');
// }
// function successHandler2(src){
//     $("#thumbnail2").attr('src',src);
// }
// function uploadThumb3(){
//     uploadImageAdvance("#uploadImgThumb3",beforeUpload3,successHandler3);
// }
// function beforeUpload3(){
//     $("#thumbnail3").attr('src','/assets/images/cms/loading.gif');
// }
// function successHandler3(src){
//     $("#thumbnail3").attr('src',src);
// }
// function showAddEssayDiv(){
//     setDivCenter('#addEssayDiv',true);
// }
// function addEssay(){
//     if($("#title").val()==''){
//         alert('标题不能为空！');
//         $("#title").focus();
//         return false;
//     }
//     $("#addEssayDiv").hide(100);
//     showWait();
//     var essay = new Object(); 
//     essay.infoType = 'essay';
//     essay.column = $("#column").val();
//     essay.title = $("#title").val();
//     essay.islink = $("#islink").val();
//     essay.link = $("#link").val();
//     essay.summary = $("#summary").val();
//     essay.thumbnail = $("#thumbnail").attr('src');
//     essay.content = contentEditor.html();
//     if($("#author").length > 0){
//         essay.author = $("#author").val();
//     }
//     if($("#thumbnail2").length > 0){
//         essay.avatar = $("#thumbnail2").attr('src');
//     }
//     dataHandler('/common/addInfo',essay,null,null,null,addEssaySuccessHandler,false,false);
    
// }
// function saveEssay(){
//     if($("#title1").val()==''){
//         alert('标题不能为空！');
//         $("#title").focus();
//         return false;
//     }
//     $("#editEssayDiv").hide();
//     showWait();
//     var essay = new Object();
//     essay.infoType = 'essay';
//     essay.id = currentEssayId;
//     essay.column = $("#column1").val();
//     essay.title = $("#title1").val();
//     essay.islink = $("#islink1").val();
//     essay.link = $("#link1").val();
//     essay.summary = $("#summary1").val();
//     essay.thumbnail = $("#thumbnail1").attr('src');
//     essay.content = contentEditor1.html();
//     if($("#author1").length > 0){
//         essay.author = $("#author1").val();
//     }
//     if($("#thumbnail3").length > 0){
//         essay.avatar = $("#thumbnail3").attr('src');
//     }
//     dataHandler('/common/modifyInfo',essay,null,null,null,saveEssaySuccessHandler,false,false);
    
// }
// function saveEssaySuccessHandler(){
//     $("#waitDiv").hide(100);
//     showAlert('success','修改成功！','');
//     reload();
// }
// var currentEssayId=0;
// function editEssay(id){
//     showWait();
//     currentEssayId=id;
//     var essay = new Object(); 
//     essay.infoType = 'essay';
//     essay.id = id;
//     dataHandler('/common/getInfo',essay,null,null,null,getEssaySuccessHandler,false,false);
// }
// function getEssaySuccessHandler(essay){
//     $("#title1").val(essay.title);
//     $("#summary1").val(essay.summary);
//     $("#islink1").val(essay.islink);
//     if(essay.islink==1){
//         $("#link1").show();
//     }else{
//         $("#link1").hide();
//     }
//     if($("#author1").length > 0){
//         $("#author1").val(essay.author);
//     }
//     if($("#thumbnail3").length > 0){
//         $("#thumbnail3").attr('src',essay.authorAvatar);
//     }
//     $("#link1").val(essay.link);
//     $("#column1").val(essay.column);
//     contentEditor1.html(essay.content);
//     $("#thumbnail1").attr('src',essay.thumbnail);
//     $("#waitDiv").hide(100);
//     setDivCenter('#editEssayDiv',true);
// }
// function deleteEssay(id){
//     var essay = new Object(); 
//     essay.infoType = 'essay';
//     essay.id = id;
//     dataHandler('/common/deleteInfo',essay,'确定删除？',null,null,deleteEssaySuccessHandler,false,false);
// }
// function deleteEssaySuccessHandler(){
//     showAlert('success','删除成功！','正在刷新...');
//     reload();
// }
// function selectEssay(baseUrl){
//     var extUrl="";
//     if($("#searchColumn").val()!=0) extUrl+="&column="+$("#searchColumn").val();
//     if($("#keywords").val()!="") extUrl+="&keywords="+$("#keywords").val();
//     location.href=baseUrl+extUrl;
// }


//操作店铺审核员
function saveFinance(isNew,callBack){

    showWait();
    var admin = new Object(); 
    admin.infoType = 'shopadmin';
    admin.username = $("#username").val();
    admin.password = $("#password").val();
    admin.type = 8;
    admin.grade=1;
    admin.status=1;
    //alert(admin.status);
    var method='add';
    if(!isNew){
        admin.old_usename=$("#old_username").val();
        admin.id = $("#id").val();
        admin.status = $("input[name='status']:checked").val();
        method = 'modify';

    }
    dataHandler('/common/'+method+'AdminInfo',admin,null,null,null,callBack,false,false);
    
}
