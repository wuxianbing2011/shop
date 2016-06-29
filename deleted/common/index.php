<?php
$isRoot = true;
require_once __DIR__.'/webconfig.php';
require_once __DIR__.'/data/static_data_index.php';

$intelCookieUid = empty($_COOKIE['shop_dmp_uid']) ? false : str_replace("uid=", "", $_COOKIE['shop_dmp_uid']);
if (!empty($intelCookieUid)) {
	$adMasterTagUrl = "http://58.215.141.190/dmp/intel/ad_tags/get/{$intelCookieUid}";
	$appKey = "aW50ZWw=";
	$appSecret = "aW50ZWxwYXNzd29yZA==";
	$now = time();
	$sign = sha1($appSecret.$now);

	$curl = curl_init($adMasterTagUrl);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);

	$header = array(); 
	$header[] = 'Authorization: '.base64_encode("{$appKey}:{$sign}:{$now}");
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	$adMasterResponse = curl_exec($curl);
	if (!empty($adMasterResponse)) {
		//{"tags":[{"uid":"a48b828b1b4f6da98f0e0db633cb42c2","tag":""}],"code":2000}
		$adMasterTagTmp = json_decode($adMasterResponse, true);
		if (!empty($adMasterTagTmp['tags'][0])) {
			$admasterTag = $adMasterTagTmp['tags'][0];
			//$admasterTag['tag'] = '2in1';
		}
	}
}
 

$module = "index";

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<!--[if lte IE 9]>
    <meta http-equiv="X-UA-Compatible" content="IE=9"/>
<![endif]-->
<title>英特尔产品中心——轻松选购英特尔产品</title>
<link rel="stylesheet" href="common/resource/css/index.css" type="text/css" />
<link rel="stylesheet" href="common/resource/css/btn_kv.css" type="text/css" />
<script src="common/resource/js/jquery-1.7.2.min.js"></script>
<script src="common/resource/js/toolkit.js"></script>
<script src="common/resource/js/btn_kv.js"></script>
<script src="common/resource/js/scroller.js"></script>
<?php include_once('common/style.php');?>
<style type="text/css">
#mc_container .banner .kv1.inset {background: url("common/resource/images/kv-index.jpg") no-repeat scroll center center #006fc8;}
#mc_container .banner .kv1.inset h2{top: 52px;}
#mc_container .banner .kv1.inset h1{top: 80px;}
#mc_container .banner .kv1.inset p{top: 138px;}

#mc_container .search{padding: 15px 60px 0px 0px; text-align: right; width: 960px; height: 40px; margin: 65px auto 0px auto;}
#mc_container .search table{background: url("common/resource/images/search_bg.png") no-repeat;}
#mc_container .search input.keyword {color:#0071c5; font-size:14px; border:0px; height:26px; line-height:26px; width:190px; padding-left:5px;}

#mc_container .hot{width: 960px; margin: 0 auto; position: relative;height: 169px; overflow: hidden;}
#mc_container .hot .item-list {position: relative; height: 169px;overflow: hidden;}
#mc_container .hot .item-list ul li{width: 960px; height: 169px; float: left;}
/*#mc_container .hot .item-list ul li .image-box{margin-top: -19px;}*/
/*#mc_container .hot:hover .nav-btns {display: block;}*/
#mc_container .hot .nav-btns a{display: block; width: 34px;height: 171px;position: absolute;top: 50%;margin-top: -85px;cursor: pointer;}
#mc_container .hot .nav-btns a.btn-prev{background: url("common/resource/images/index_ad_arrow_left.png") no-repeat scroll 50% 50% #fff; left: 0;}
#mc_container .hot .nav-btns a.btn-next{background: url("common/resource/images/index_ad_arrow_right.png") no-repeat scroll 50% 50% #fff;; right: 0;}
#mc_container .hot .item-nav{position: absolute;top: 150px;margin: 0 auto;width: 100px;}
#mc_container .hot .item-nav li{float: left; width: 14px; height: 14px;cursor: pointer;}
#mc_container .hot .item-nav li.pre{background: url("common/resource/images/index_ad_nav_pre.png");}
#mc_container .hot .item-nav li.next{background: url("common/resource/images/index_ad_nav_next.png");}
#mc_container .hot .item-nav li.dot{background: url("common/resource/images/index_ad_nav_dot.png");}
#mc_container .hot .item-nav li.active{background: url("common/resource/images/index_ad_nav_dot2.png");}

#mc_container .hot-product, #mc_container .zhizun, #mc_container .retail{background-color: #f4f4f4;width: 960px;margin: 20px auto 0px auto;position: relative;}
#mc_container .hot-product h2{text-align: center; padding-top: 15px; line-height: 50px;font-size: 35px;color: #006fc8;}
#mc_container .hot-product p{text-align: center; line-height: 24px;font-size: 14px;color: #006fc8;}
#mc_container .hot-product ul{width: 880px; margin: 0 auto;}
#mc_container .hot-product ul li {width: 220px;float: left;padding-top: 10px;}
#mc_container .hot-product ul li h3{font-size: 14px;color: #006fc8;}
#mc_container .hot-product ul li p{text-align: left; font-size: 14px;color: #626262;width: 200px;}
#mc_container .hot-product .more{margin-top: 20px; text-align: right;padding-right: 10px;padding-bottom: 15px;}
#mc_container .hot-product .more a{color: #006fc8;}

#mc_container .zhizun, #mc_container .retail {height: 204px;}
#mc_container .zhizun h3, #mc_container .retail h3{padding-left: 65px;padding-top: 15px; font-size: 18px; color: #006fc8;}
#mc_container .zhizun .image-box, #mc_container .retail .image-box {position: absolute;width: 230px;height: 120px;top:57px;left: 65px;}
#mc_container .zhizun p, #mc_container .retail p{margin-left: 340px; width: 580px; padding-top: 10px; line-height: 24px; font-size: 14px;}
#mc_container .zhizun p.more, #mc_container .retail p.more{text-align: right; width: 610px;padding-top: 5px;}
#mc_container .zhizun p.more a, #mc_container .retail p.more a{color: #006fc8;}

#mc_container .retail .image-box {height: 128px;}

#mc_container .shops{width: 960px;margin: 20px auto 0px auto;position: relative;}
#mc_container .shops ul li{width: 320px;padding: 0px;position: relative;height: 171px;text-align: center;float: left;}
#mc_container .shops ul li a{display: block;width: 120px;height: 40px;position: absolute; right: 20px;bottom: 5px;line-height: 40px;background: transparent;}

#mc_container .hot-product ul li .btn-box{text-align: center;padding-left: 16px;}
#mc_container .hot-product ul li .btn-box a{cursor: pointer; font-size: 14px; background: #00adef; color: #fff; width: 110px; height: 30px; display: block; line-height: 30px; text-align: center;}



</style>

</head>
<body>

<script type="text/javascript"> 
MLTracker = {
	mid : 10019133, 
	serverbaseurl:"menlost.mlt01.com/",
	ers : [ {
		"type" : "pageview"
	} ],
	track : function(er) {
		this.ers.push(er); 
	}
}; 
(function() {
	var js = document.createElement("script"), scri = document .getElementsByTagName("script")[0];
	js.type = "text/javascript";
	js.async = true; scri.parentNode.insertBefore(js, scri);
	js.src ="http://static.mlt01.com/comt/dm.js"; 
})();
</script>

<?php include_once __DIR__.'/common/ga_code.php'; ?>

<?php include_once __DIR__.'/common/header.php'; ?>
<?php if (!empty($adMasterResponse)) { ?>
<div <?=empty($_GET['debug']) ? ' style="display:none;"' : '';?>>
<?php print_r($adMasterResponse); ?>
</div>
<?php } ?>
<div id="mc_container">
	<div class="banner k1">
		<div class="inset kv1">
			<?php include_once('common/btn_kv.php');?>
		</div>
	</div>

	<div class="search">
		<form id="frmSearch" name="frmSearch" method="get" action="search">
			<table align="right" width="228" height="30" cellpadding="0" cellspacing="0">
				<tr>
					<td style="padding:1px 0px 3px 1px;"><input id="keyword" name="keyword" class="keyword" /></td>
					<td style="width:35px;"><a id="data_searchbox" style="diaplay:block;" href="javascript: void 0;">　　</a></td>
				</tr>
			</table>
		</form>
	</div>

	<? /*
	<div class="hot">
		<div class="item-list">
			<ul>
				<li>
					<div class="image-box">
						<img width="960" src="common/resource/images/index_hot1.jpg" />
					</div>
				</li>
				<li>
					<div class="image-box">
						<img width="960" src="common/resource/images/index_hot1.jpg" />
					</div>
				</li>
				<li>
					<div class="image-box">
						<img width="960" src="common/resource/images/index_hot1.jpg" />
					</div>
				</li>
			</ul>
			
			<div class="nav-btns">
				<a class="btn-prev"></a>
				<a class="btn-next"></a>
			</div>
		</div>
		<div class="item-nav">
			<ul>
				<li class="pre"></li>
				<li class="dot active"></li>
				<li class="dot"></li>
				<li class="dot"></li>
				<li class="next"></li>
			</ul>
		</div>
	</div>

	*/ ?>

	





	<?php if (!empty($admasterTag['tag']) && $admasterTag['tag'] == "2in1") { ?>
		<div class="hot-product 2in1">
			<h2>热卖2合1电脑</h2>
			<p>搭载英特尔<sup>®</sup> 酷睿™ 处理器，轻薄可插拔的2合1电脑。</p>
			<ul>
				<?php $i=0; foreach ($hotProducts_2in1 as $p) {   ?>
				<li>
					<div class="product-cover">
						<img src="common/resource/hot_products/2in1/<?=($i+1)?>.jpg" height="140"/>
					</div>
					<h3><?=$p['name']?></h3>
					<p><?=$p['cpu']?></p>
					<div class="btn-box">
						<a id="data_index_hotarea_2in1_<?=$i+1?>_<?=substr($p['url'], strrpos($p['url'], "=")+1); ?>" href="<?=$p['url'];?>" target="_blank">了解详情</a>
					</div>
				</li>
				<?php if(++$i >= 4) break;} ?>
			</ul>
			<div class="clear"></div>
			<div class="more">
				<a id="data_index_hotarea_2in1_btn_more" href="2in1" target="_blank">查看更多2合1电脑 &gt;</a>
			</div>
		</div>
		<br/>
	<?php } if (!empty($admasterTag['tag']) && $admasterTag['tag'] == "tablet"){ ?>
	<div class="hot-product tablet">
		<h2>热卖平板电脑</h2>
		<p>以更快更强劲的极速应用体验，充分实现您的想象力和创造力。</p>
		<ul>
			<?php $i=0; foreach ($hotProducts_tablet as $p) {   ?>
			<li>
				<div class="product-cover">
					<img src="common/resource/hot_products/tablet/<?=($i+1)?>.jpg" height="140"/>
				</div>
				<h3><?=$p['name']?></h3>
				<p><?=$p['cpu']?></p>
				<div class="btn-box">
					<a id="data_index_hotarea_tablet_<?=$i+1;?>_<?=substr($p['url'], strrpos($p['url'], "=")+1); ?>" href="<?=$p['url'];?>" target="_blank">了解详情</a>
				</div>
			</li>
			<?php if(++$i >= 4) break;} ?>
		</ul>
		<div class="clear"></div>
		<div class="more">
			<a id="data_index_hotarea_tablet_btn_more" href="tablet" target="_blank">查看更多平板电脑 &gt;</a>
		</div>
	</div>
	<br/>
	<?php } if (!empty($admasterTag['tag']) && $admasterTag['tag'] == "aio") { ?>
	<div class="hot-product aio">
		<h2>热卖一体机</h2>
		<p>卓越性能，时尚设计</p>
		<ul>
			<?php $i=0; foreach ($hotProducts_aio as $p) {   ?>
			<li>
				<div class="product-cover">
					<img src="common/resource/hot_products/aio/<?=($i+1)?>.jpg" height="140"/>
				</div>
				<h3><?=$p['name']?></h3>
				<p><?=$p['cpu']?></p>
				<div class="btn-box">
					<a id="data_index_hotarea_aio_<?=$i+1;?>_<?=substr($p['url'], strrpos($p['url'], "=")+1); ?>" href="<?=$p['url'];?>" target="_blank">了解详情</a>
				</div>
			</li>
			<?php if(++$i >= 4) break;} ?>
		</ul>
		<div class="clear"></div>
		<div class="more">
			<a id="data_index_hotarea_aio_btn_more" href="aio" target="_blank">查看更多一体机 &gt;</a>
		</div>
	</div>
	<br/>
	<?php } ?>



	<div class="hot">
		<div class="item-list">
			<ul>
				<!-- li>
					<div class="image-box">
						<a id="data_index_banner_1" href="http://sale.jd.com/act/vAP7En2IhGoOR4Mp.html" target="_blank"><img width="960" src="common/resource/images/index_hot1.jpg" /></a>
					</div>
				</li -->
				<li>
					<div class="image-box">
						<a id="data_index_banner_1" href="http://www.intel.cn/content/www/cn/zh/laptops/laptop-products.html" target="_blank"><img width="960" src="common/resource/images/index_hot2.jpg" /></a>
					</div>
				</li>
			</ul>
			
			<div class="nav-btns" style="display:none;">
				<a id="data_index_banner_arrow_left" class="btn-prev"></a>
				<a id="data_index_banner_arrow_right" class="btn-next"></a>
			</div>
		</div>
		<div class="item-nav" style="display:none;">
			<ul>
				<li class="pre"></li>
				<li class="dot active"></li>
				<li class="dot"></li>
				<li class="dot"></li>
				<li class="next"></li>
			</ul>
		</div>
	</div>







	<?php if (empty($admasterTag['tag']) || $admasterTag['tag'] != "2in1") { ?>
		<div class="hot-product 2in1">
			<h2>热卖2合1电脑</h2>
			<p>搭载英特尔<sup>®</sup> 酷睿™ 处理器，轻薄可插拔的2合1电脑。</p>
			<ul>
				<?php $i=0; foreach ($hotProducts_2in1 as $p) {   ?>
				<li>
					<div class="product-cover">
						<img src="common/resource/hot_products/2in1/<?=$i+1?>.jpg" height="140"/>
					</div>
					<h3><?=$p['name']?></h3>
					<p><?=$p['cpu']?></p>
					<div class="btn-box">
						<a id="data_index_hotarea_2in1_<?=$i+1?>_<?=substr($p['url'], strrpos($p['url'], "=")+1); ?>" href="<?=$p['url'];?>" target="_blank">了解详情</a>
					</div>
				</li>
				<?php if(++$i >= 4) break;} ?>
			</ul>
			<div class="clear"></div>
			<div class="more">
				<a id="data_index_hotarea_2in1_btn_more" href="2in1" target="_blank">查看更多2合1电脑 &gt;</a>
			</div>
		</div>
	<?php } if (empty($admasterTag['tag']) || $admasterTag['tag'] != "tablet"){ ?>
	<div class="hot-product tablet">
		<h2>热卖平板电脑</h2>
		<p>以更快更强劲的极速应用体验，充分实现您的想象力和创造力。</p>
		<ul>
			<?php $i=0; foreach ($hotProducts_tablet as $p) {   ?>
			<li>
				<div class="product-cover">
					<img src="common/resource/hot_products/tablet/<?=($i+1)?>.jpg" height="140"/>
				</div>
				<h3><?=$p['name']?></h3>
				<p><?=$p['cpu']?></p>
				<div class="btn-box">
					<a id="data_index_hotarea_tablet_<?=$i+1;?>_<?=substr($p['url'], strrpos($p['url'], "=")+1); ?>" href="<?=$p['url'];?>" target="_blank">了解详情</a>
				</div>
			</li>
			<?php if(++$i >= 4) break;} ?>
		</ul>
		<div class="clear"></div>
		<div class="more">
			<a id="data_index_hotarea_tablet_btn_more" href="tablet" target="_blank">查看更多平板电脑 &gt;</a>
		</div>
	</div>
	<?php } if (empty($admasterTag['tag']) || $admasterTag['tag'] != "aio") { ?>
	<div class="hot-product aio">
		<h2>热卖一体机</h2>
		<p>卓越性能，时尚设计</p>
		<ul>
			<?php $i=0; foreach ($hotProducts_aio as $p) {   ?>
			<li>
				<div class="product-cover">
					<img src="common/resource/hot_products/aio/<?=($i+1)?>.jpg" height="140"/>
				</div>
				<h3><?=$p['name']?></h3>
				<p><?=$p['cpu']?></p>
				<div class="btn-box">
					<a id="data_index_hotarea_aio_<?=$i+1;?>_<?=substr($p['url'], strrpos($p['url'], "=")+1); ?>" href="<?=$p['url'];?>" target="_blank">了解详情</a>
				</div>
			</li>
			<?php if(++$i >= 4) break;} ?>
		</ul>
		<div class="clear"></div>
		<div class="more">
			<a id="data_index_hotarea_aio_btn_more" href="aio" target="_blank">查看更多一体机 &gt;</a>
		</div>
	</div>
	<?php } ?>







	<div class="zhizun">
		<h3>至尊地带</h3>
		<div class="image-box">
			<img src="common/resource/images/index_zhizun.jpg" />
		</div>
		<p>“至尊地带”是有英特尔和渠道合作伙伴强强联手，特别为高端电脑玩家打造的高端电脑专卖<br/>店。作为电脑尖端技术的前沿哨所，这里汇集了当今个人电脑领域的最新科技，以及一线厂<br/>商提供的顶级硬件配置，还有与之匹配的专家级装机咨询和一站式高端装备零售服务。顶级<br/>电脑，自己“智”造，尽在“至尊地带”。</p>
		<p class="more"><a id="data_index_partner_link" href="http://prcappzone.intel.com/cn/consumer/shop/ez/" target="_blank">立即前往至尊地带 &gt;</a></p>
	</div>

	<div class="retail">
		<h3>英特尔商用经销商</h3>
		<div class="image-box">
			<img src="common/resource/images/index_retailer.jpg" />
		</div>
		<p>
			搭载Intel Inside的商用产品可轻松融入您的业务，满足您的企业需求，可以帮助您在轻松<br/>
			为员工提供支持的同时提高部署及更新效率。立即点击查询您附近的商用产品经销商，或<br/>
			咨询我们的在线客服人员，为您的企业选择适合的英特尔商用设备。 
		</p>
		<p class="more"><br /><a id="data_index_bizvar_link" href="http://prcappzone.intel.com/biz/var/" target="_blank">立即查询离您最近的英特尔商用经销商 &gt;</a></p>
	</div>

	<div class="shops">
		<ul>
			<li>
				<img src="common/resource/images/index_shop_tmall.jpg" />
				<a id="data_index_dealer_tmall" href="http://intel-brand.tmall.com/?spm=a220m.1000858.0.0.L8HbE9&rn=c030330488139b2af30bc3808c8148b1" target="_blank">
					<img width="120" height="40" src="common/resource/images/transplant.png" /></a>
			</li>
			<li>
				<img src="common/resource/images/index_shop_jd.jpg" />
				<a id="data_index_dealer_jd" href="http://jmall.jd.com/shop/intel/index.html" target="_blank">
					<img width="120" height="40" src="common/resource/images/transplant.png" /></a>
			</li>
			<li>
				<img src="common/resource/images/index_shop_suning.jpg" />
				<a id="data_index_dealer_suning" href="http://www.suning.com/emall/brandshop_10052_10053_Intel_.html" target="_blank">
					<img width="120" height="40" src="common/resource/images/transplant.png" /></a>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<?php include_once('common/disclaimer.php');?>
</div>
<?php include_once __DIR__.'/common/footer.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
	var bannerScroller = new Scroller({
		container: '.hot',
		inset: '.item-list ul',
		navBars: {
			prev: '.nav-btns .btn-prev',
			next: '.nav-btns .btn-next'
		},
		trigger: '.item-nav li.dot',
		styles: null,
		contentWidth: 960*$(".hot .item-list ul li").length,
		containerWidth: 960,
		stepLength: 960,
		onchange: function(index){
			this.panel.find('.item-nav li.dot').removeClass('active');
			this.panel.find('.item-nav li.dot').eq(index).addClass('active');
		},
		autoplay:false
	});
	$(".item-nav").width($(".item-nav li").length * 14);
	$(".item-nav").css("left", (960-$(".item-nav").width())/2);
	$(".item-nav li.pre").click(function(){
		bannerScroller.prev();
	});
	$(".item-nav li.next").click(function(){
		bannerScroller.next();
	});

	var btn_kv1_src = $("#btn_kv_1").find("img").attr("src");
	$("#btn_kv_1").find("img").attr("src", btn_kv1_src.replace("close", "open"));
	$("#intel_products").show();
	$("#other_products").hide();
	$("#line2").show();
	$("#btn_kv").height("106");

	$("#data_searchbox").click(function(){
		try {
			MLtracker.track({"type":"event", "action":"product_search", "value": $("#keyword").val()+""});
		} catch(e) {

		}
		$('#frmSearch').submit();
	});
});

</script>
</body>
</html>
<style>
	#skip-footer  .language-selector-toggle{padding:0 6px;}
	#skip-footer li{margin-left: 0;}
	#recode50header,#skip-footer{font-family:"intel-clear","intel-clear-cyrillic","SimSun",Arial,sans-serif !important;}
	
</style>