<?php
require_once __DIR__.'/../data/static_data_cmp.php';
require_once __DIR__.'/../webconfig.php';
require_once __DIR__.'/../libs/pager.php';

$module = 'search';

$firstFields = array(
	"products_tablet"=>"cpu"
	,"products_2in1"=>"cpu"
	,"products_desktop"=>"cpu"
	,"products_laptop"=>"cpu"
	,"products_allin1"=>"cpu"
	,"products_mobile"=>"cpu"
	,"products_cpu"=>"cpu"
	,"products_ssd"=>"disk_size"
	,"products_mainboard"=>"cpu"
);

$secondFields = array(
	"products_tablet"=>array("#0英寸高清屏幕" => "screen_size", "#0GB内存 #1"=>array("mem_size", "mem_type"), "#0 操作系统"=>"operating_system")
	,"products_2in1"=>array("#0英寸高清屏幕" => "screen_size", "#0GB #1"=>array("disk_size", "disk_type"), "#0 操作系统"=>"operating_system")
	,"products_desktop"=>array("#0"=> "product_type", "#0"=>"xianka_type", "#0GB内存 #1"=>array("mem_size", "mem_type"))
	,"products_laptop"=>array("#0英寸高清屏幕" => "screen_size", "#0GB #1"=>array("disk_size", "disk_type"), "#0 操作系统"=>"operating_system")
	,"products_allin1"=>array("#0英寸高清屏幕" => "screen_size", "#0GB #1"=>array("disk_size", "disk_type"), "#0 操作系统"=>"operating_system")
	,"products_mobile"=>array("#0英寸高清屏幕" => "screen_size", "#0"=>"screen_ratio", "#0"=>"product_spec")
	,"products_cpu"=>array("#0 接口"=>"interface", "核心数量 #0"=>"core_num", "包装 #0"=>"packaging")
	,"products_ssd"=>array("#0"=>"disk_dimension", "#0 读取速度"=>"read_speed", "#0 主控芯片"=>"main_chip")
	,"products_mainboard"=>array("#0 外形尺寸"=>"outline_dimension", "最大支持内存容量 #0B"=>"max_mem_size", "适用类型 #0"=>"fit_type")
);

$recommandedProducts = array(
	array("name"=>"微软Surface Pro 64G", "intro"=>"第三代智能Intel酷睿i5 处理器", "type"=>"2in1", "hot"=>1, "link"=>"javascript: void 0;", "brand_en"=>"Microsoft", "url"=>"../2in1/detail.php?id=543282")
	,array("name"=>"联想 Helix", "intro"=>"第三代智能Intel酷睿i5处理器", "type"=>"2in1", "hot"=>1, "link"=>"javascript: void 0;", "brand_en"=>"Lenovo", "url"=>"../2in1/detail.php?id=543440")
	,array("name"=>"宏碁 TX201", "intro"=>"第三代智能Intel酷睿i5处理器", "type"=>"laptop", "hot"=>1, "link"=>"javascript: void 0;", "brand_en"=>"Acer", "url"=>"../laptop/detail.php?id=545652")
	,array("name"=>"蓝魔 I9 16GB WIFI", "intro"=>"第三代智能Intel酷睿i5处理器", "type"=>"smart-phone", "hot"=>1, "link"=>"javascript: void 0;", "brand_en"=>"RAmos", "url"=>"../tablet/detail.php?id=555253")
);

$inAjax = empty($_GET['ajax']) ? false : true;
$perPage = 8;
$page = intval(getParam('page', 1));
$page = $page>0 ? $page : 1; 
$begin = ($page - 1)*$perPage;

$keyword = isset($_GET['keyword']) ? check_plain(filter_xss($_GET['keyword'], array())) : false;
$urlParam = array();
$where = "1";
$pageUrl = "index.php?page={page}";
$order = "price-asc";
if (empty($keyword)) {
	$products = array();
	$pagerHtml = "";
	$total = 0;
} else {
	$urlParam[] = "keyword=".$keyword;
	$where .= " and (name like '%{$keyword}%' or cpu like '%{$keyword}%' or operating_system like '%{$keyword}%'  or mem_type like '%{$keyword}%'  or disk_type like '%{$keyword}%' or product_type like '%{$keyword}%'  or xianka_type like '%{$keyword}%' or product_spec like '%{$keyword}%'  or interface like '%{$keyword}%'  or fit_type like '%{$keyword}%' or brand like '%{$keyword}%' or type_name like '%{$keyword}%')";
	$pageUrl .= "&keyword=".$keyword;
	$order = getParam("order");
	if (!empty($order)) {
		$orderSql = str_replace("-", " ", $order);
	} else {
		$order = "price-asc";
		$orderSql = "price asc";
	}

	$pageUrl .= "&order=".$order;

	$products = $db->fetchAll("select * from products_all where {$where} order by {$orderSql} limit {$begin}, {$perPage}");
	$total = $db->fetchOne("select count(*) from products_all where {$where}");

	$pagerHtml = Pager::style2($page, $perPage, $total, $pageUrl."#product", 'active', 'disable');
}

?>
<?php if (!$inAjax) { ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<!--[if lte IE 9]>
    <meta http-equiv="X-UA-Compatible" content="IE=9"/>
<![endif]-->
<title>英特尔产品中心——轻松选购英特尔产品</title>
<link rel="stylesheet" href="../common/resource/css/index.css" type="text/css" />
<link rel="stylesheet" href="../common/resource/css/btn_kv.css" type="text/css" />
<script src="../common/resource/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
function getCookie(c_name){
  if (document.cookie.length>0){
    c_start=document.cookie.indexOf(c_name + "=");
    if (c_start!=-1){ 
      c_start=c_start + c_name.length+1;
      c_end=document.cookie.indexOf(";",c_start);
      if (c_end==-1){
        c_end=document.cookie.length;
      }
      return unescape(document.cookie.substring(c_start,c_end));
    } 
  }
  return "";
}

function setCookie(c_name,value){
  var exdate=new Date();
  exdate.setDate(exdate.getDate());
  document.cookie=c_name+ "=" +escape(value) + "; path=/";
}
</script>
<script src="../common/resource/js/toolkit.js"></script>
<script src="../common/resource/js/btn_kv.js"></script>
<script src="../common/resource/js/scroller.js"></script>
<?php include_once __DIR__.'/../common/style.php';?>
<style type="text/css">
#mc_container .banner .inset p{padding-left: 2px;}

#mc_container .banner .kv1.inset {background: url("../common/resource/images/kv-index.jpg") no-repeat scroll center center #006fc8;}
#mc_container .banner .kv1.inset h2{top: 52px;}
#mc_container .banner .kv1.inset h1{top: 80px;}
#mc_container .banner .kv1.inset p{top: 138px;}

#mc_container .no-data {margin-bottom: 40px;}
#mc_container .no-data p.tip{height: 72px; line-height: 55px; font-size: 14px; color: #006fc8;padding-left: 40px;background: #f4f4f4;margin-bottom: 40px;}
#mc_container .no-data .products-box h2{font-size: 18px;  line-height: 55px;  color: #fdb810;}
#mc_container .no-data .products-box ul li{width:226px;height: 320px;border:1px solid #f2f2f2; float: left;margin-right: 11px;position: relative;padding-top: 20px;padding-bottom: 10px;}
#mc_container .no-data .products-box ul li h3{font-size: 14px; color: #626262; font-weight: bold; padding-left: 12px;line-height: 22px;height: 22px;overflow: hidden;}
#mc_container .no-data .products-box ul li p{padding-left: 12px; color: #626262;line-height: 22px;height: 22px;overflow: hidden;}
#mc_container .no-data .products-box ul li .detail{padding-left: 10px; padding-top: 10px;}
#mc_container .no-data .products-box ul li .detail a{display: inline-block; width: 102px; height: 30px; background: #fdb810; text-align: center;line-height: 30px;color: #fff;}
#mc_container .no-data .products-box ul li .detail .logo{height: 29px;}
#mc_container .no-data .products-box ul li .detail .logo img{vertical-align:middle;}
#mc_container .no-data .products-box ul li .conner-hot{ width: 48px; height: 61px; position: absolute; top: 0; left: 0; background: url(../common/resource/images/conner-hot.png);}
#mc_container .no-data .products-box ul li .conner-type{width: 61px; height: 55px; position: absolute; top: 0;right: 0;}

#mc_container .hot{width: 960px; margin: 0 auto; position: relative;height: 169px; overflow: hidden;}
#mc_container .hot .item-list {position: relative; height: 169px;overflow: hidden;}
#mc_container .hot .item-list ul li{width: 960px; height: 169px; float: left;}
/*#mc_container .hot .item-list ul li .image-box{margin-top: -19px;}*/
/*#mc_container .hot:hover .nav-btns {display: block;}*/
#mc_container .hot .nav-btns a{display: block; width: 34px;height: 171px;position: absolute;top: 50%;margin-top: -85px;}
#mc_container .hot .nav-btns a.btn-prev{background: #fff; left: 0;}
#mc_container .hot .nav-btns a.btn-next{background: #fff;; right: 0;}
#mc_container .hot .kv-nav {position: absolute;bottom: 3px; right: 34px; width: 66px; height: 32px; background: url(../common/resource/images/search_kv_nav.png) no-repeat;}
#mc_container .hot .kv-nav a{display: inline-block; width: 30px;height: 30px;cursor: pointer;}
#mc_container .hot .kv-nav a.prev{margin-right: 2px;}

#mc_container .hot {margin-bottom: 50px;}
</style>

</head>
<body>
<?php include_once __DIR__.'/../common/ga_code.php'; ?>
<?php include_once __DIR__.'/../common/header.php'; ?>

<div id="mc_container">
	
	<div class="banner k1">

		<div class="inset kv1">
			<?php include_once('../common/btn_kv.php');?>
		</div>
		
		
	</div>
	<div class="main">


<div id="ajax-content">
<?php } ?>
		<div class="product-box">
			<a id="product" name="product"></a>
			<div class="header">
				<span class="count"><strong>“<?=$keyword?>”</strong> 搜索到 <strong><?=$total; ?></strong> 件相关产品</span>
				<?php 
					$orderUrl = "index.php";
					$orderUrl .= empty($urlParam) ? '?order=' : '?'.implode("&", $urlParam)."&order=";
				?>
				<?php if (!empty($products)) { ?>
				<a href="<?=$orderUrl?><?=$order=='price-desc' ? 'price-asc' : 'price-desc';?>#product" class="order <?=$order=='price-desc' ? 'desc' : '';?>">价格排序</a>
				
				<a href="<?=$orderUrl?><?=$order=='hot-desc' ? 'hot-asc' : 'hot-desc';?>#product" class="order <?=$order=='hot-desc' ? 'desc' : '';?>">热门排序</a>
				<?php } ?>
				<?php include_once __DIR__.'/../common/search_block.php'; ?>
				
			</div>
			
			<?php if (!empty($products)) {  ?>
			<ul class="product-list">
				<?php	foreach ($products as $p) { ?>
				<li class="product_<?=$p['pconline_id'];?>">
					<div class="imgbox"><img width="226" src="../product_images/<?=$p['cover_image']?>" /></div>
					<div class="infobox">
						<h2 title="<?=htmlspecialchars($p['name']); ?>"><strong><?=mb_strimwidth($p['name'],0,48,'','utf-8'); ?></strong></h2>
						<input class="brand" type="hidden" value="<?=empty($p['brand']) ? '英特尔' : $p['brand'];?>" /> 
						<p class="intro"><?=mb_strimwidth($p[$firstFields[$p['type']]], 0, 25, '', 'utf-8').($firstFields[$p['type']] == 'disk_size' ? 'GB 容量' : '');?>&nbsp;　</p>
						<p class="price">指导价格：<em><?=($p['price'] == 0 || $p['price'] == null  || $p['price'] == 'null') ? '暂无报价' : 'RMB '.$p['price']; ?></em></p>
						<?php 
						$pType = str_replace(array("products_", "allin1", "mobile"), array("", "aio", "smart-phone"), $p['type']);
						?>
						<p><a href="../<?=$pType."/detail.php?id=".$p['pconline_id'];?>" target="_blank" class="btn-detail">了解详情</a></p>
					</div>
					<div class="logo">
						<?php if (!empty($p['brand_en'])) { ?>
						<img height="36" src="../common/resource/logo/logo_<?=$p['brand_en']?>.png" />
						<?php } else { ?>
						<img height="36" src="../common/resource/logo/logo_Intel.png" />
						<?php } ?>

						<p class="add-cmp"><input id="data_<?=$pType; ?>_product_<?=$p['pconline_id'];?>_addcomparison" product="<?=$p['pconline_id'];?>" module="<?=$tableToModuleMap[$p['type']]; ?>" type="checkbox" /> 加入对比</p>
						<div class="clear"></div>
					</div>
					<?php if ($p['hot']) { ?>
					<div class="conner"></div>
					<?php } ?>
					<div class="cover">
						<div class="adv">
							<?php foreach ($secondFields[$p['type']] as $template => $value) { ?>
							<p>
								<?php if (is_array($value)) { ?>
								<?=str_replace(array("#0", "#1"), array($p[$value[0]], $p[$value[1]]), $template);?>
								<?php } else { ?>
								<?=str_replace("#0", $p[$value], $template);?>
								<?php } ?>
							</p>
							<?php } ?>
						</div>
						<div class="options">
							<p class="wishing" id="data_<?=$pType; ?>_product_<?=$p['pconline_id'];?>_addwishing" product="<?=$p['pconline_id'];?>"><img src="../common/resource/images/btn_add_wishing.png" /></p>
							<p class="share"><img src="../common/resource/images/btn_share_product.png" /></p>
							<ul>
								<li class="top_line"></li>
								<li class="share_item sina"><a id="data_<?=$pType?>_product_<?=$p['pconline_id'];?>_share_weibo" href="javascript: void 0;">新浪微博</a></li>
								<li class="share_item sohu"><a id="data_<?=$pType?>_product_<?=$p['pconline_id'];?>_share_sohu" href="javascript: void 0;">搜狐微博</a></li>
								<li class="share_item qzone"><a id="data_<?=$pType?>_product_<?=$p['pconline_id'];?>_share_qq" href="javascript: void 0;">QQ空间</a></li>
								<li class="share_item kaixin"><a id="data_<?=$pType?>_product_<?=$p['pconline_id'];?>_share_kaixin" href="javascript: void 0;">开心网</a></li>
								<li class="share_item renren"><a id="data_<?=$pType?>_product_<?=$p['pconline_id'];?>_share_renren" href="javascript: void 0;">人人网</a></li>
							</ul>
						</div>
					</div>
				</li>
				<?php } ?> 
			</ul>
			<div class="pager">
				<?=$pagerHtml; ?>
			</div>
			<?php } ?>
		</div>
<?php if (!$inAjax) { ?>
</div>
		<?php if (empty($products)) { ?>
		<div class="no-data">
			<p class="tip">抱歉，没有找到符合您搜索的产品。试试其他搜索条件吧！</p>
			<?php include_once __DIR__.'/../data/static_data_2in1.php'; ?>
			<div class="products-box">
				<h2>热卖产品</h2>
				<ul>
					<?php $i=0; foreach ($recommandedProducts as $rp) {$i++; ?>
					<li>
						<div>
							<img width="226" src="../common/resource/recommanded_products/<?=$i?>.jpg">
						</div>
						<h3><?=$rp['name']?></h3>
						<p><?=$rp['intro']?></p>
						<div class="detail">
							<a href="<?=$rp['url']?>" target="_blank">了解详情</a>
							<span class="logo">
								<img src="../common/resource/logo/logo_<?=$rp['brand_en']?>.png" />
							</span>
						</div>
						<div class="conner-hot"></div>
						<div class="conner-type"><img src="../common/resource/images/conner-type-<?=$rp['type']?>.png" /></div>
					</li>
					<?php } ?>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
		<div class="hot">
			<div class="item-list">
				<ul>
					<!-- li>
						<div class="image-box">
							<a href="http://sale.jd.com/act/vAP7En2IhGoOR4Mp.html" target="_blank"><img width="960" src="../common/resource/images/index_hot1.jpg" /></a>
						</div>
					</li -->
					<li>
						<div class="image-box">
							<a id="data_index_banner_1" href="http://www.suning.com/emall/cuxiao_10052_10051_6681_.html?utm_source=pl-00005&utm_medium=intel816&utm_campaign=sprd" target="_blank"><img width="960" src="../common/resource/images/index_hot2.jpg" /></a>
						</div>
					</li>
				</ul>
				
				<div class="nav-btns" style="display:none;">
					<a class="btn-prev"></a>
					<a class="btn-next"></a>
				</div>

				<div class="kv-nav" style="display:none;">
					<a class="prev"></a>
					<a class="next"></a>
				</div>
			</div>
			<!-- div class="item-nav">
				<ul>
					<li class="pre"></li>
					<li class="dot active"></li>
					<li class="dot"></li>
					<li class="dot"></li>
					<li class="next"></li>
				</ul>
			</div -->
		</div>
		<?php } ?>
	</div>
	<?php include_once __DIR__.'/../common/cmp_wishing_box.php';?>
	<?php include_once __DIR__.'/../common/disclaimer.php';?>
</div>
<?php include_once __DIR__.'/../common/footer.php'; ?>
<?php include_once __DIR__.'/../common/interact_js.php'; ?>
<?php include_once __DIR__.'/../common/cmp_wishing_box_js.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
	var bannerScroller = new Scroller({
		container: '.hot',
		inset: '.item-list ul',
		navBars: {
			prev: '.kv-nav .prev',
			next: '.kv-nav .next'
		},
		trigger: '.item-nav li.dot',
		styles: null,
		contentWidth: 960*$(".hot .item-list ul li").length,
		containerWidth: 960,
		stepLength: 960,
		onchange: function(index){
			// this.panel.find('.item-nav li.dot').removeClass('active');
			// this.panel.find('.item-nav li.dot').eq(index).addClass('active');
		},
		autoplay:false
	});


});
</script>

</body>
</html>
<?php } ?>