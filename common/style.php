<style type="text/css">
#mc_container{font-family: "黑体", "Hiragino Sans GB", "Hei";}

body{background-color: #fff;}
sup { font-size: 12px; line-height: 12px; vertical-align: text-top; }
#mc_container .banner h1 sup{line-height: 38px; font-size: 18px;}
.clear{clear: both; height: 1px;}
.pager{clear: both;}
#mc_container .disclaimer{width: 960px;margin: 0 auto; padding-top: 30px;}
#mc_container .disclaimer .title{height: 33px;padding-left: 22px; line-height: 33px; font-size: 14px;color: #fff; position: relative;background: #0171c5;font-weight: normal; }
#mc_container .disclaimer .title a{display: inline-block;position: absolute;width: 33px; height: 33px;top: 0px; right: 12px;background: url("<?=!empty($isRoot) ? '' : '../';?>common/resource/images/disclaimer-open.png") no-repeat;}
#mc_container .close .title a{background: url("<?=!empty($isRoot) ? '' : '../';?>common/resource/images/disclaimer-close.png") no-repeat;}
#mc_container .disclaimer .content{display: block; padding: 22px;font-size: 14px;color: #999;border: 1px solid #ccc; border-top: none;height: 65px;}
#mc_container .close .content{display: none;}
#mc_container .main .filter-box .lev-2 ul li{padding-right: 30px;}
#mc_container .main .product-box ul.product-list li .infobox p.intro{height: 20px;}
#mc_container .main .hot .items-list ul li .product .info-box h3{height: 54px;overflow: hidden;}

/*share css*/
#mc_container .main .product-box ul.product-list li .cover .options {padding: 10px 0px 0px 20px;position: relative;}
#mc_container .main .product-box ul.product-list li .cover .options p{float: left;margin-right: 10px;border: 1px solid #fdb810;height: 20px;}
#mc_container .main .product-box ul.product-list li .cover .options ul{display: none; z-index: 999; position: absolute; background: #fff; left: 132px;top: 30px; margin: 0px; padding: 0px 0px 5px 0px; width: 119px;border-left: 1px solid #fdb810;border-right: 1px solid #fdb810;border-bottom: 1px solid #fdb810;}
#mc_container .main .product-box ul.product-list li .cover .options ul li{ display: block;clear: both; margin: 0px; padding: 0px; width: auto;height: 24px;line-height: 26px;border: none;overflow: hidden;}
#mc_container .main .product-box ul.product-list li .cover .options ul li.top_line{margin-bottom: 5px; width: 119px; background: url(../common/resource/images/share_box_top.png) no-repeat; background-color: #fdb810; height: 1px;}
#mc_container .main .product-box ul.product-list li .cover .options ul li a{color: #0071c5; display: inline-block; padding-left: 48px;}
#mc_container .main .product-box ul.product-list li .cover .options ul li.sina{background: url(../common/resource/images/share_icon_sina.png) no-repeat 16px center;}
#mc_container .main .product-box ul.product-list li .cover .options ul li.sohu{background: url(../common/resource/images/share_icon_sohu.png) no-repeat 16px center;}
#mc_container .main .product-box ul.product-list li .cover .options ul li.qzone{background: url(../common/resource/images/share_icon_qzone.png) no-repeat 16px center;}
#mc_container .main .product-box ul.product-list li .cover .options ul li.kaixin{background: url(../common/resource/images/share_icon_kaixin.png) no-repeat 16px center;}
#mc_container .main .product-box ul.product-list li .cover .options ul li.renren{background: url(../common/resource/images/share_icon_renren.png) no-repeat 16px center;}
/*最右侧分享框不被截取*/
#mc_container .main .product-box ul.product-list{overflow: visible;}

#mc_container .main .product-box ul.product-list li .logo{position: relative;}
#mc_container .main .product-box ul.product-list li .logo p.add-cmp{position: absolute; left: 110px; top: 7px; z-index: 99; padding-left: 5px; height: 20px;border-left: 1px solid #ccc;}

#mc_container .ws_box {width: 960px;margin: 30px auto 0px auto; padding: 0px; position: fixed; bottom: 0px;left: 0px;right: 0px;background: #fff;z-index: 9999;}
#mc_container .ws_box .tabs{border: 2px solid #0873c9; border-bottom: none;height: 39px;}
#mc_container .ws_box .tabs ul li{width: 477px; height: 37px; line-height: 37px;position: relative; border-bottom: 2px solid #f2f2f2;}
#mc_container .ws_box .tabs ul li span {padding-left: 50px;}
#mc_container .ws_box .tabs ul li em {position: absolute; top: 0px; right: 0px; display: inline-block;width: 50px; height: 39px;cursor: pointer;}
#mc_container .ws_box .tabs ul li.cmp{float: left; background: url(../common/resource/images/cmp_box_icon_b.jpg) no-repeat left center #f9f9f9; cursor: pointer;}
#mc_container .ws_box .tabs ul li.wishing{float: right; background: #f2f2f2; cursor: pointer;}

#mc_container .ws_box .tab_contents {border: 2px solid #0873c9; border-top: none; clear:both; padding: 0px;}
#mc_container .ws_box .tab_contents .cmp {display: none;}
#mc_container .ws_box .tab_contents .cmp ul {position: relative; padding: 20px;}
#mc_container .ws_box .tab_contents .cmp ul li{display: inline-block;position: relative; padding-left: 90px; line-height: 20px;font-size: 12px;}
#mc_container .ws_box .tab_contents .cmp ul li.item p.image-box{position: absolute; left: 5px; top: 0px;width: 80px;}
#mc_container .ws_box .tab_contents .cmp ul li.item p{color: #0071c5;}
#mc_container .ws_box .tab_contents .cmp ul li.item p.title{width: 100px; height: 20px; overflow: hidden;}
#mc_container .ws_box .tab_contents .cmp ul li.item p.price{color: #69d6ff; }
#mc_container .ws_box .tab_contents .cmp ul li.item p.buy_btn a{line-height: 18px;height: 18px; display: inline-block;width: 60px;background: #0873c9;color: white;text-align: center;}
#mc_container .ws_box .tab_contents .cmp ul li.item p.btn_delete{position: absolute;top:0px;right: 0px;background: red;width: 20px;height: 20px;background: url(../common/resource/images/btn_delete.jpg) no-repeat right top;cursor: pointer;}
#mc_container .ws_box .tab_contents .cmp ul li.add{padding: 0px; width: 190px; height: 80px; background: url(../common/resource/images/cmp_add_bg.jpg) no-repeat center center;cursor: pointer;}
#mc_container .ws_box .tab_contents .cmp ul li.options{padding: 0px; vertical-align:top; height: 80px; width: 120px;position: absolute;top: 10px;right: 0px;}
#mc_container .ws_box .tab_contents .cmp ul li.options a.btn_cmp{display: block;margin-top: 15px;width: 90px;height: 26px;line-height: 26px; background: #0873c9; color: #fff;text-align: center;font-size: 12px;}
#mc_container .ws_box .tab_contents .cmp ul li.options a.clear_all{display: block; margin-top: 5px; text-decoration: underline; color: #0071c5;width: 90px;line-height: 26px;text-align: center; font-size: 12px;}

#mc_container .ws_box .tab_contents .wishing{position: relative; display: none;}
#mc_container .ws_box .tab_contents .wishing ul{padding: 10px; height: 185px; overflow:auto;}
#mc_container .ws_box .tab_contents .wishing ul li {position: relative; display: inline-block; width: 178px; height: 178px; overflow: hidden; margin: 0px 0px 15px 0px;padding: 0px;}
#mc_container .ws_box .tab_contents .wishing ul li p.image-box{padding-top: 10px; text-align: center;height: 75px;overflow: hidden;}
#mc_container .ws_box .tab_contents .wishing ul li p.title{ padding-top:10px; line-height: 20px;height: 20px;width: 170px; overflow: hidden;color: #0071c5; text-align: center;}
#mc_container .ws_box .tab_contents .wishing ul li p.price{line-height: 20px;height: 20px;width: 170px; overflow: hidden;color: #69d6ff; text-align: center;}
#mc_container .ws_box .tab_contents .wishing ul li p.buy_btn{height:30px; text-align: center; padding-top: 5px;}
#mc_container .ws_box .tab_contents .wishing ul li p.buy_btn a{line-height: 30px;height: 30px; display: inline-block;width: 112px;background: #0873c9;color: white;text-align: center;}
#mc_container .ws_box .tab_contents .wishing ul li p.btn_delete{position: absolute;top:0px;right: 0px;width: 20px;height: 20px;background: url(../common/resource/images/btn_delete.jpg) no-repeat right top;cursor: pointer;}
#mc_container .ws_box .tab_contents .wishing .share_btn{width: 37px; height: 37px;background: url(../common/resource/images/b_box_share_icon.jpg) no-repeat;position: absolute;top:10px; right: -39px;}
#mc_container .ws_box .tab_contents .wishing .share_box{display: none; border: 1px solid #00aeef; width: 112px; overflow: hidden; position: absolute;top: 47px;right: -115px; background: #fff;}
#mc_container .ws_box .tab_contents .wishing .share_box ul{overflow: hidden; padding: 0px; margin: 0px; height: auto; padding-bottom: 10px;}
#mc_container .ws_box .tab_contents .wishing .share_box ul li{display: block; height: 22px; line-height: 22px; padding: 0px;margin: 0px;}
#mc_container .ws_box .tab_contents .wishing .share_box ul li.title{padding-left: 5px;background: #0071c5; color: #fff; height: 28px; line-height: 28px; margin-bottom: 10px;}
#mc_container .ws_box .tab_contents .wishing .share_box ul li a{color: #0071c5; display: inline-block; padding-left: 42px;}
#mc_container .ws_box .tab_contents .wishing .share_box ul li.sina{background: url(../common/resource/images/share_icon_sina.png) no-repeat 13px center;}
#mc_container .ws_box .tab_contents .wishing .share_box ul li.sohu{background: url(../common/resource/images/share_icon_sohu.png) no-repeat 13px center;}
#mc_container .ws_box .tab_contents .wishing .share_box ul li.qzone{background: url(../common/resource/images/share_icon_qzone.png) no-repeat 13px center;}
#mc_container .ws_box .tab_contents .wishing .share_box ul li.kaixin{background: url(../common/resource/images/share_icon_kaixin.png) no-repeat 13px center;}
#mc_container .ws_box .tab_contents .wishing .share_box ul li.renren{background: url(../common/resource/images/share_icon_renren.png) no-repeat 13px center;}

#mc_container .ws_box.hide{display: none;}
#mc_container .ws_box .tabs ul li.cmp{background: url(../common/resource/images/cmp_box_icon_g.jpg) no-repeat 5px center #f2f2f2; color: #8b8b8b; border-right: 2px solid #0873c9;}
#mc_container .ws_box .tabs ul li.wishing{background: url(../common/resource/images/wishing_box_icon.jpg) no-repeat 5px center #f2f2f2; color: #8b8b8b; border-left:none;}
#mc_container .ws_box .tabs ul li.cmp em{background: url(../common/resource/images/b_box_arrow_blue.jpg) no-repeat;display: none;}
#mc_container .ws_box .tabs ul li.wishing em{background: url(../common/resource/images/cw_box_open.png) center center;}


#mc_container .ws_box.tab_cmp .tabs ul li.cmp{background: url(../common/resource/images/cmp_box_icon_b.jpg) no-repeat 5px center #fff; color: #0873c9; border-bottom: 2px solid white;}
#mc_container .ws_box.tab_cmp .tabs ul li.wishing{border-bottom: 2px solid #0873c9;}
#mc_container .ws_box.tab_cmp .tab_contents .wishing{display: none;}
#mc_container .ws_box.tab_cmp .tab_contents .cmp{display: block;}
#mc_container .ws_box.tab_cmp .tabs ul li.cmp em{background: url(../common/resource/images/b_box_arrow_white.jpg) no-repeat;display: none;}
#mc_container .ws_box.tab_cmp .tabs ul li.wishing em{background: url(../common/resource/images/cw_box_close.png) center center;}


#mc_container .ws_box.tab_wishing .tabs ul li.cmp{border-bottom: 2px solid #0873c9;border-right: none;}
#mc_container .ws_box.tab_wishing .tabs ul li.wishing{background: url(../common/resource/images/wishing_box_icon_b.jpg) no-repeat 5px center #fff; border-bottom: 2px solid white; color: #0873c9; border-left:2px solid #0873c9;}
#mc_container .ws_box.tab_wishing .tab_contents .cmp{display: none;}
#mc_container .ws_box.tab_wishing .tab_contents .wishing{display: block;}
#mc_container .ws_box.tab_wishing .tabs ul li.cmp em{background: url(../common/resource/images/b_box_arrow_gray.jpg) no-repeat;display: none;}
#mc_container .ws_box.tab_wishing .tabs ul li.wishing em{background: url(../common/resource/images/cw_box_close.png) center center;}

.tip_box_bg{
    background: url(../common/resource/images/transplant.png);
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 9999;
    display: none;
}
.tip_box_bg.open{
    display: block;
}
.tip_box{
    width: 300PX;
    position: fixed;
    top: 40%;
    left: 0px;
    right: 0px;
    margin: 0px auto;
}
.tip_top{
    background: url(../common/resource/images/tip_box_top.png);
    height: 98px;
}
.tip_top img{
    position: absolute;
    right: 15px;
    cursor: pointer;
    top: 15px;
    width: 30px;
}
.tip_content{
    background: url(../common/resource/images/tip_box_bg.png);
    padding: 10px 40px;
    color: #999;
    text-align: center;
}
.tip_bottom{
    height: 70px;
    background: url(../common/resource/images/tip_box_bottom.png);
    position: relative;
}
.tip_bottom img{
	position: absolute;
	cursor: pointer;
    top: 18px;
    left: 115px;
    width: 72px;
    height: 25px;
}


</style>