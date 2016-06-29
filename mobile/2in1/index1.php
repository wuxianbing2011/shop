<?php
require_once __DIR__.'/../../webconfig.php';
$where = "1";
$brand = getParam("brand", false);
$price = getParam("price", false);
if (!empty($brand)) {
	$where .= " and brand_name_en='{$brand}'";
}
if (!empty($price)) {
	if (preg_match("/^<([\d]+)$/", $price, $match)) {
		$where .= " and price < '{$match[1]}'";
	} elseif (preg_match("/^>([\d]+)$/", $price, $match)) {
		$where .= " and price > '{$match[1]}'";
	} elseif (preg_match("/^([\d]+)\-([\d]+)$/", $price, $match)) {
		$where .= " and price >= '{$match[1]}' and price <='{$match[2]}'";
	}
}

$types = array("hot"=>"hot", "new"=>"id", "price"=>"price");
$type = getParam('t', false);
if (empty($type)) {
	$type = 'hot';
}
$order = getParam('r', false);
if (empty($order)) {
	$order = 'desc';
}

$products = $db->fetchAll("select * from products_2in1 where {$where} order by {$types[$type]} {$order} limit 10");
$total = $db->fetchOne("select count(*) from products_2in1 where {$where}");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="url" content="http://m.intel.com/cn/zh/home.html"/>
<script src="http://m.intel.cn/etc/designs/intelmobile/appclientlibs/js/libs/modernizr-2.0.6.min.js,Mjm.5bYgYJ7VCY.js+jquery,_jquery-1.7.2.min.js,Mjm.Hpd-lVHxLh.js.pagespeed.jc.J51OSGwOlR.js"></script><script>eval(mod_pagespeed_hZZCJO9T5I);</script>
<script>eval(mod_pagespeed_913tl24OJM);</script>
<script type="text/javascript" lang="javascript" src="http://cdn.gigya.com/JS/socialize.js?apikey=3_L2ZhMUzebeenWQTrGaMen3ITUITZ9oMV-tLmIGrZG4DWsNgwDhXeeQ_60DZv4b8Q"></script>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript"></script>
<link rel="icon" type="image/vnd.microsoft.icon" href="/etc/designs/intelmobile/favicon.ico">
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="/etc/designs/intelmobile/favicon.ico">
<link rel="stylesheet" href="http://m.intel.cn/etc/designs/intelmobile/static-reskin.css+newglobalnav.css.pagespeed.cc.uRb6Wcp9Bo.css" type="text/css"/>
<title> 英特尔® 2合1产品</title>
<style>body{font-family:arial!important}</style>
<link rel="canonical" href="">
<script type="text/javascript">$(document).ready(function(){var BrowserDetect={init:function(){this.browser=this.searchString(this.dataBrowser)||"An unknown browser";this.version=this.searchVersion(navigator.userAgent)||this.searchVersion(navigator.appVersion)||"an unknown version";this.OS=this.searchString(this.dataOS)||"an unknown OS";},searchString:function(data){for(var i=0;i<data.length;i++){var dataString=data[i].string;var dataProp=data[i].prop;this.versionSearchString=data[i].versionSearch||data[i].identity;if(dataString){if(dataString.indexOf(data[i].subString)!=-1)
return data[i].identity;}else if(dataProp)
return data[i].identity;}},searchVersion:function(dataString){var index=dataString.indexOf(this.versionSearchString);if(index==-1)
return;return parseFloat(dataString.substring(index+this.versionSearchString.length+1));},dataBrowser:[{string:navigator.userAgent,subString:"Chrome",identity:"Chrome"},{string:navigator.userAgent,subString:"OmniWeb",versionSearch:"OmniWeb/",identity:"OmniWeb"},{string:navigator.vendor,subString:"Apple",identity:"Safari",versionSearch:"Version"},{prop:window.opera,identity:"Opera",versionSearch:"Version"},{string:navigator.vendor,subString:"iCab",identity:"iCab"},{string:navigator.vendor,subString:"KDE",identity:"Konqueror"},{string:navigator.userAgent,subString:"Firefox",identity:"Firefox"},{string:navigator.vendor,subString:"Camino",identity:"Camino"},{string:navigator.userAgent,subString:"Netscape",identity:"Netscape"},{string:navigator.userAgent,subString:"MSIE",identity:"Explorer",versionSearch:"MSIE"},{string:navigator.userAgent,subString:"Gecko",identity:"Mozilla",versionSearch:"rv"},{string:navigator.userAgent,subString:"Mozilla",identity:"Netscape",versionSearch:"Mozilla"}],dataOS:[{string:navigator.platform,subString:"Win",identity:"Windows"},{string:navigator.platform,subString:"Mac",identity:"Mac"},{string:navigator.userAgent,subString:"iPhone",identity:"iPhone/iPod"},{string:navigator.platform,subString:"Linux",identity:"Linux"}]};BrowserDetect.init();var redirectioncookie=getCookie("redirectedToBigBrowser");var redirectionURL=$('link[rel=canonical]').attr('href');var enableRedirection="no";var isFromBBSite="false";if((redirectionURL!=""&&redirectionURL!=undefined)&&redirectioncookie==""&&(screen.width>="1024"&&screen.height>="768")&&(BrowserDetect.OS=='Windows'||BrowserDetect.OS=='Mac'||BrowserDetect.OS=='Linux')&&(BrowserDetect.browser=='Chrome'||BrowserDetect.browser=='Firefox'||BrowserDetect.browser=='Explorer'||BrowserDetect.browser=='Opera')&&enableRedirection=='yes'&&isFromBBSite=='false'){setCookie("redirectedToBigBrowser","yes");window.location.replace(redirectionURL);}});function getCookie(cookieName){var allCookies=document.cookie.split('; ');for(var i=0;i<allCookies.length;i++){var cookiePair=allCookies[i].split('=');if(cookiePair[0]==cookieName){return cookiePair[1];}}
return"";}
function setCookie(cookieName,cookieValue){cookieValue=encodeURIComponent(cookieValue);if(/MSIE (\d+\.\d+);/.test(navigator.userAgent)){document.cookie=cookieName+"="+cookieValue+";expires=60*10*1000; path=/";}else{document.cookie=cookieName+"="+cookieValue+";expires=; path=/";}}
function removeCookie(cookieName){document.cookie=cookieName+"=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";}</script>
<meta property="og:title" content="英特尔® 2合1产品"/>
<meta property="og:type" content="company"/>
<meta property="og:url" content="http://m.intel.com/cn/zh/home.html"/>
<meta property="og:site_name" content="Intel-Mobile"/>
<meta property="og:description" content="英特尔® 2合1产品"/>
<meta name="description" content="英特尔® 2合1产品"/>
<meta name="localecode" content="zh_CN"/>
<meta name="google-site-verification" content="abcdferegdtdfeuekdmdkejehe"/>
<meta name="language" content="zh"/>
<meta name="location" content="ch"/>
<link rel="apple-touch-icon-precomposed" href="http://m.intel.cn/etc/designs/intelmobile/img/icons/xintel-com-57.png.pagespeed.ic.MuV-TfqwC7.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://m.intel.cn/etc/designs/intelmobile/img/icons/xintel-com-72.png.pagespeed.ic.QlTZfy8oA5.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://m.intel.cn/etc/designs/intelmobile/img/icons/xintel-com-114.png.pagespeed.ic.bSnR6kEQT-.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://m.intel.cn/etc/designs/intelmobile/img/icons/xintel-com-144.png.pagespeed.ic.s-Y1YeAf3U.png">
	<link rel="stylesheet" href="resource/css/index.css" type="text/css">
	<script src="resource/js/toolkit.js"></script>
	<script src="resource/js/tab.js"></script>
	<style type="text/css">
	#mc-container .main{padding-bottom: 0px;}
	</style>
</head>
<body marginheight="0" topmargin="0" marginwidth="0" style="height:auto;">
<div id="wrapper" class="page mobilepage shoppage touch wapwrapper" id="wrapper" data-component-id="1" data-component="ces-keynote">
<div class="siteheader globalheader">
<header>
<div class="component" data-component="globalheader" data-component-id="1">
<div id="header-bar" class="clearfix">
<div class="scrollbar">
<div id="logo">
<a href="http://m.intel.cn/cn/zh/home.html"><img src="http://m.intel.cn/content/dam/intelmobile/images/ximobile-logo.png.pagespeed.ic.LEdZ8EkUFt.png" alt="" pagespeed_url_hash="1417751138"> </a>
</div>
<ul class="search-nav">
<li id="search-item"><div class="nub"></div> <a href="#search-menu" class="dropdown-trigger"> <img src="http://m.intel.cn/content/dam/intelmobile/images/xicon-search.png.pagespeed.ic.8UlF6iK9EO.png" alt="" class="search-icon-normal" pagespeed_url_hash="2186989809">
<img src="http://m.intel.cn/content/dam/intelmobile/images/xbtn-search-normal.png.pagespeed.ic.QRAmhUOvuO.png" alt="" class="search-icon-active" style="display: none;" pagespeed_url_hash="2201754764"/> </a></li>
<li id="menu-item"><div class="nub"></div>
<span class="menu_button_fix"><a href="javascript:void(0);" class="dropdown-trigger-menu"><img src="http://m.intel.cn/content/dam/intelmobile/images/xicon-menu.png.pagespeed.ic.6M1PTROY3L.png" alt="" pagespeed_url_hash="3785967024"/>
</a>
</span>
</li>
</ul>
</div>
</div>
<div id="category-menu" class="dropdown-menu">
<div class="overlay"></div>
<div class="topmainmenu hide">
<div id="layer2logo" class="hide">
<a href="http://m.intel.cn/cn/zh/home.html"><img src="http://m.intel.cn/content/dam/intelmobile/images/ximobile-logo.png.pagespeed.ic.LEdZ8EkUFt.png" alt="" pagespeed_url_hash="1417751138"> </a>
</div>
<ul class="menuLevel1">
<li class="level1_links"><span>产品
<div class='curl'></div>
<div class="flip-bg hide">
<img src="http://m.intel.cn/content/dam/intelmobile/images/xflip-bg-new.png.pagespeed.ic.OYfO7m-Omy.jpg" pagespeed_url_hash="86520693"/>
</div> </span>
<ul class="innerLevel" id="产品">
<div class="li_tag">
<li>
<a href="http://m.intel.cn/cn/zh/intel-products/tablets.html" style=" background: #fff; color: #004280; border-bottom: 1px #ebeaea solid;">
英特尔芯平板——越极速，越精彩</a>
</li>
<div class="li_tag">
<li>
<a href="http://m.intel.cn/cn/zh/intel-products/2-in-1.html" style=" background: #fff; color: #004280; border-bottom: 1px #ebeaea solid;">
2 合 1</a>
</li>
<div class="li_tag">
<li>
<a href="http://m.intel.cn/cn/zh/intel-products/all-in-one-pcs.html" style=" background: #fff; color: #004280; border-bottom: 1px #ebeaea solid;">
采用 Intel Inside® 的一体机</a>
</li>
<div class="li_tag">
<li>
<a href="http://m.intel.cn/cn/zh/intel-products/ultrabook.html" style=" background: #fff; color: #004280; border-bottom: 1px #ebeaea solid;">
超极本™ - 源自英特尔</a>
</li>
<div class="li_tag">
<li>
</li>
<div class="li_tag">
<li>
<a href="http://m.intel.cn/cn/zh/intel-products/core-family.html" style=" background: #fff; color: #004280; border-bottom: 1px #ebeaea solid;">
智能英特尔® 酷睿™ 处理器</a>
</li>
</div>
</ul>
</li>
<li class="level1_links"><span>购买英特尔产品
<div class='curl'></div>
<div class="flip-bg hide">
<img src="http://m.intel.cn/content/dam/intelmobile/images/xflip-bg-new.png.pagespeed.ic.OYfO7m-Omy.jpg" pagespeed_url_hash="86520693"/>
</div> </span>
<ul class="innerLevel" id="购买英特尔产品">
<div class="li_tag">
<li>
<a href="http://m.intel.cn/cn/zh/products/ultrabooks.html" style=" background: #fff; color: #004280; border-bottom: 1px #ebeaea solid;">
超极本™</a>
</li>
</div>
</ul>
</li>
<li class="level1_links"><a href="http://m.intel.cn/cn/zh/technologies.html" id="英特尔技术">英特尔技术
<div class='curl'></div>
<div class="flip-bg hide">
<img src="http://m.intel.cn/content/dam/intelmobile/images/xflip-bg-new.png.pagespeed.ic.OYfO7m-Omy.jpg" pagespeed_url_hash="86520693"/>
</div>
</a>
</li>
<li class="level1_links"><span>主题
<div class='curl'></div>
<div class="flip-bg hide">
<img src="http://m.intel.cn/content/dam/intelmobile/images/xflip-bg-new.png.pagespeed.ic.OYfO7m-Omy.jpg" pagespeed_url_hash="86520693"/>
</div> </span>
<ul class="innerLevel" id="主题">
<div class="li_tag">
<li>
<a href="http://m.intel.cn/cn/zh/topics-overview/enterprise-mobility.html" style=" background: #fff; color: #004280; border-bottom: 1px #ebeaea solid;">
移动生产力</a>
</li>
<div class="li_tag">
<li>
<a href="http://m.intel.cn/cn/zh/topics-overview/big-data-analytics.html" style=" background: #fff; color: #004280; border-bottom: 1px #ebeaea solid;">
英特尔® 大数据分析创新</a>
</li>
<div class="li_tag">
<li>
<a href="http://m.intel.cn/cn/zh/topics-overview/cloud-computing.html" style=" background: #fff; color: #004280; border-bottom: 1px #ebeaea solid;">
云计算</a>
</li>
</div>
</ul>
</li>
</ul>
<div id="nav-footer"></div>
</div>
</div>
<div id="search-menu" class="dropdown-menu">
<div class="parbase searchcomponent">
<div class="component" data-component="searchcomponent" data-component-id="1">
<div id="modal-search" class="tipped-modal">
<form action="http://m.intel.cn/cn/zh/search-result.html" method="get" id="form-search" name="form-search" onsubmit="return submitSearchForm();">
<div class="text-input">
<input id="search-term" name="search-term" type="text" class="text" onkeyup="getKeys('zh_CN')" value="" placeholder="Search..">
<input id="device-selector" name="device-selector" type="hidden" value="">
<a id="clear-search" title="Clear" href="#">Clear</a>
<input type="image" src="http://m.intel.cn/content/dam/intelmobile/images/xbtn-search-normal.png.pagespeed.ic.QRAmhUOvuO.png" class="search-btn-normal">
<input type="image" src="http://m.intel.cn/content/dam/intelmobile/images/xbtn-search-active.png.pagespeed.ic.xn1K39_G7g.png" class="search-btn-active hide">
</div>
<div id="suggestions" style="background-color:#FFF;">
</div>
</form>
</div>
<img src="http://m.intel.cn/content/dam/intelmobile/images/xsearch-bg.png.pagespeed.ic.Ix_EQOgtXQ.png" class="search-bg" pagespeed_url_hash="50596051"/>
</div>
</div>
</div>
</div>
</header>

<script>var campaign="";var audience="";var haswell="true";var pagePath="http://m.intel.cn/content/intelmobile/cn/zh/intel-products/tablets"
if(campaign!=null&&campaign!="")
document.cookie="sector="+campaign+";path=/";else if(haswell=="true")
document.cookie="sector="+"home"+";path=/";if(audience!=null&&audience!=""&&(pagePath.indexOf("products"))==-1)
document.cookie="audience="+audience+";path=/";</script>
<script>try{$('.li_tag a').click(function(){var myUrl=$(this).attr('href');if((myUrl!=null)&&(myUrl!="")){if(myUrl.indexOf('http')<0){myUrl=window.location.protocol+"//"+window.location.host+myUrl;}
window.location=myUrl;}});}
catch(err){}</script>
</div>
<div id="main" role="main">
<div>
<div id="homepage" class="home tiles-content">
<div class="parsys contentPar"><div class="htmlcontainer parbase section">

<div id="mc-container">
	<div class="main">
		<header>
			<div class="page-top">
				<span class="page-ttl dropBtn" onclick="showProMenu(this,$('#proDropMenu'),event)">选购英特尔2合1产品<!-- i class="iconBox dropIcon"></i --></span>
				<a href="javascript:void(0);" onclick="showSearch($('.searchWrap'))" class="searchTrigger"><i class="iconBox searchIcon"></i></a>
			</div>
		</header>
		<ul class="tab-wrap fixed-tab-wrap">				
			<li class="tab fLeft <?=$type=='hot' ? 'currentTab' : '';?>"><a onclick="tracking('ProductListSortHot')" href="index.php?t=hot&r=desc">热品</a><i class="iconBox orderIcon"></i></li>
			<li class="tab fLeft <?=$type=='new' ? 'currentTab' : '';?>"><a onclick="tracking('ProductListSortNew')" href="index.php?t=new&r=desc">新品</a><i class="iconBox orderIcon"></i></li>
			<li class="tab fLeft <?=$type=='price' ? 'currentTab' : '';?>"><a onclick="tracking('ProductListSortPrice')" href="index.php?t=price&r=<?=$type=='price'&&$order == 'asc' ? 'desc' : 'asc'; ?>">价格</a><i class="iconBox orderIcon"></i></li>
			<li class="tab"><a href="filter.php">筛选</a></li>
		</ul>
		<ul class="item-list-wrap productListWrap">
			<?php foreach ($products as $p) { ?>
			<li class="itemList proList" onclick="showDetail('<?=$p['purchase_link']?>',8)">
				<div class="itemImgWrap">
					<img width="120" src="../../product_images/<?=$p['extra1']?>.jpg">
					<p class="proPrice"><?=$p['price'] == 0 ? '暂无报价' : "￥{$p['price']}元";?></p>
					<p class="btn_buy">
						<span><em>立即购买</em><i class="iconBox rightArrowIcon"></i></span>
					</p>
				</div>
				<div class="itemInfoWrap">
					<p class="item-ttl">
						<span class="itemName"><?=$p['brand_name']?></span>
						
					</p>
					<p class="proSeries"><?=$p['name']; ?></p>
					<!--p class="proMark">超极本</p-->		
					<p class="itemParam"><span class="leftSpan">处理器：</span><?=$p['cpu']; ?> </p>
					<p class="itemParam"><span class="leftSpan"> 产品形态：</span><?=$p['form_factor']; ?> </p>
					<p class="itemParam"><span class="leftSpan"> 屏幕尺寸：</span><?=$p['screen_size']; ?>英寸 </p>
				</div>
			</li>
			<?php } ?>
		</ul>
		<p class="loadBtn" nextpage="2"><span class="itemNumContainer"><?=count($products)?>/<?=$total?></span>点击加载更多产品</p>
		
	</div>
</div>

</div>
</div>
</div>
</div>
</div>
<div class="footer globalfooter">
<script type="text/javascript">var fb_language="zh_CN";var org_language="zh";</script>
<div id="footer_position">
<footer>
<div class="component" data-component="globalfooter" data-component-id="1">
<div id="language">
<a href="http://m.intel.cn/cn/zh/language-selector.html">China (简体中文)</a>
</div>
<nav>
<ul>
<li><a href="http://www.intel.cn/content/www/cn/zh/homepage.html" target="_blank">www.intel.cn</a>
</li>
<li><a href="http://www.intel.cn/content/www/cn/zh/legal/terms-of-use.html" target="_blank">使用条款</a>
</li>
<li><a href="http://www.intel.cn/content/www/cn/zh/legal/trademarks.html" target="_blank">*商标</a>
</li>
<li><a href="http://www.intel.com/content/www/cn/zh/privacy/intel-online-privacy-notice-summary.html" target="">隐私</a>
</li>
<li><a href="http://www.intel.com/content/www/cn/zh/privacy/intel-cookie-notice.html" target="_blank">Cookie</a>
</li>
<li><a href="http://www.miibeian.gov.cn/state/outPortal/loginPortal.action;jsessionid=RRCdPr9GMQw52phdVDPJBJd2cxc8bWvy2HdK9vKvkG0hQygXWqQq%21991620579" target="_blank">沪 ICP 备 09028403 号</a>
</li>
</ul>
<small>® 英特尔公司</small>
</nav>
</div>
</footer>
</div>
<script text="text/javascript">$(document).ready(function(){var val="http://m.intel.cn/apps/intelmobile/templates/homepage";val=val+"|";val=val+"http://m.intel.cn/content/intelmobile/cn/zh/intel-products/tablets";var expiration_date=new Date();expiration_date.setTime(expiration_date.getTime()+(90*24*60*60*1000));expiration_date=expiration_date.toGMTString();document.cookie="intelmobile_last_visited_page="+val+";expires="+expiration_date+";path=/";});</script>
<script src="http://m.intel.cn/etc/designs/intelmobile/appclientlibs/js/intel.mobile-reskin.js,Mjm.hHvMlaarEq.js+helper.js,Mjm.KXRphz6m5q.js+articlelanding.js,Mjm.h8MKqQf4io.js+sitesearch.js,Mjm.kfMvGonJvP.js.pagespeed.jc.1KExIvYGgT.js"></script>
<script>eval(mod_pagespeed_ATQoS6rxA_);</script>
<script>eval(mod_pagespeed_ClYBULEjAB);</script>
<script>eval(mod_pagespeed_GCxF7cerze);</script>
<script>eval(mod_pagespeed_JnRawuZdLH);</script>
<script type="text/javascript">s={};var wapTrackingEnv="prod";s['cqUrl']="/content/intelmobile/cn/zh/intel-products/tablets";s['pageType']="homepage";</script>
<script type="text/javascript" src="http://m.intel.cn/etc/designs/intelmobile/appclientlibs/js/example-controller-reskin.js"></script>
<script type="text/javascript" src="http://m.intel.cn/etc/designs/intelmobile/appclientlibs/js/seo-properties.js.pagespeed.jm.6cWD_Ht_XO.js"></script>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher:"ur-661b55e5-341-5a95-e973-c4ac96945400",lang:'zh',fbLang:'zh_CN',shorten:false});</script>
<script src="http://m.intel.cn/etc/designs/intelmobile/appclientlibs/js/plugins.js,Mjm.AfVbz9-g0r.js+jquery.iframetracker.js,Mjm.YfKTCKEQyj.js.pagespeed.jc.oQn8oUS1ec.js"></script>
<script>eval(mod_pagespeed_xZE4KzC5Wz);</script>
<script>eval(mod_pagespeed_tTqwW2kPkQ);</script>
<script type="text/javascript">var getUrl=window.location.href;if(getUrl.indexOf("search-result")==-1){var footer=document.getElementsByClassName('globalfooter')[0];var script=document.createElement('script');script.setAttribute('type','text/javascript');script.setAttribute('src','http://www.intel.com/content/dam/www/global/wap/wap-mobile.js');footer.appendChild(script);}
</script>
</div>
</div>
<script>
tab({
	s_container: '.product-filter',
	s_tab: '.tab-wrap li',
	s_content: '.tab-content ul',
	selectClass: 'currentTab'
});

function showDetail(url){
	window.location.href = url;
}

function initLoadButton() {
	$(".loadBtn").click(function(){
		if ($(this).attr("nextpage") == 0) {
			return;
		}
		var url = window.location.href.replace(/\/(index\.php)?[^\/]*$/, "/get-products-ajax.php");
		url += "?t="+encodeURIComponent("<?=$type;?>");
		url += "&r="+encodeURIComponent("<?=$order;?>");
		url += "&page="+$(this).attr("nextpage");
		<?php if (!empty($brand)) { ?>
			url += "&brand="+encodeURIComponent("<?=$brand;?>");
		<?php } ?>
		<?php if (!empty($price)) { ?>
			url += "&price="+encodeURIComponent("<?=$price;?>");
		<?php } ?>
		$.ajax({  
	        type : "get",
	        url : url,  
	        dataType : "json",
	        success : function(data){  
	            if (data != undefined && data.success==1) {
	            	$(".productListWrap").append(data.productsHtml);
	            	$(".loadBtn").attr("nextpage", data.nextpage);
	            	$(".loadBtn .itemNumContainer").html(data.pagerHtml);
	            }
	        },  
	        error:function(p1, p2, p3){  
	            //alert('fail');  
	        }  
	    });
	});
}

$(document).ready(function(){
	initLoadButton();
});
</script>
</body>
</html>