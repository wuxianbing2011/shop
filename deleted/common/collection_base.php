<?php
require_once __DIR__.'/../data/static_data_cmp.php';
require_once __DIR__.'/../webconfig.php';
require_once __DIR__.'/../libs/pager.php';

if (file_exists(__DIR__.'/../data/static_data_'.$module.'.php')) {
	require_once __DIR__.'/../data/static_data_'.$module.'.php';
}

if (file_exists(__DIR__.'/../'.$module.'/custom_processor.php')) {
	require_once __DIR__.'/../'.$module.'/custom_processor.php';
}

include_once __DIR__.'/../common/request_processor.php';

$fieldAllMap = array(
	"tablet"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "cpu"=>"m_cpu", "brand_en"=>"m_brand_en", "screen_size"=>"screen_size", "mem_size"=>"mem_rongliang", "mem_type"=>"mem_type", "operating_system"=>"m_system")
	,"2in1"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"extra1", "hot"=>"hot", "cover_image"=>"cover_image", "cpu"=>"cpu", "brand_en"=>"brand_name_en", "screen_size"=>"screen_size", "disk_size"=>"harddisc_size", "disk_type"=>"harddist_type", "operating_system"=>"operating_system")
	,"desktop"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "cpu"=>"m_cpu", "brand_en"=>"m_brand_en", "product_type"=>"leixing", "xianka_type"=>"xianka_type", "mem_size"=>"mem_daxiao", "mem_type"=>"mem_type")
	,"laptop"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "cpu"=>"m_cpu", "brand_en"=>"m_brand_en", "screen_size"=>"screen_size", "disk_size"=>"disk_size", "disk_type"=>"disk_type", "operating_system"=>"operating_system")
	,"aio"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "cpu"=>"cpu_type", "brand_en"=>"m_brand_en", "screen_size"=>"screen_size", "disk_size"=>"disk_size", "disk_type"=>"disk_type", "operating_system"=>"operating_system")
	,"smart-phone"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "cpu"=>"cpu", "screen_size"=>"mainscreen_size", "screen_ratio"=>"screen_ratio", "product_spec"=>"product_tezheng")
	,"cpu"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "cpu"=>"m_processor", "interface"=>"interface", "core_num"=>"core_num", "packaging"=>"packaging")
	,"ssd"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "disk_size"=>"rongliang", "disk_dimension"=>"disk_chicun", "read_speed"=>"read_speed", "main_chip"=>"main_chip")
	,"mainboard"=>array("name"=>"name", "price"=>"price", "pconline_id"=>"pconline_id", "hot"=>"hot", "cover_image"=>"cover_image", "cpu"=>"m_support_cpu", "outline_dimension"=>"waixing_chicun", "max_mem_size"=>"max_mem", "fit_type"=>"fit_model")
);
$firstFields = array("tablet"=>"cpu", "2in1"=>"cpu", "desktop"=>"cpu", "laptop"=>"cpu", "aio"=>"cpu", "smart-phone"=>"cpu", "cpu"=>"cpu", "ssd"=>"disk_size", "mainboard"=>"cpu");
$secondFields = array(
	"tablet"=>array("#0英寸高清屏幕" => "screen_size", "#0GB内存 #1"=>array("mem_size", "mem_type"), "#0 操作系统"=>"operating_system")
	,"2in1"=>array("#0英寸高清屏幕" => "screen_size", "#0GB #1"=>array("disk_size", "disk_type"), "#0 操作系统"=>"operating_system")
	,"desktop"=>array("#0"=> "product_type", "#0"=>"xianka_type", "#0GB内存 #1"=>array("mem_size", "mem_type"))
	,"laptop"=>array("#0英寸高清屏幕" => "screen_size", "#0GB #1"=>array("disk_size", "disk_type"), "#0 操作系统"=>"operating_system")
	,"aio"=>array("#0英寸高清屏幕" => "screen_size", "#0GB #1"=>array("disk_size", "disk_type"), "#0 操作系统"=>"operating_system")
	,"smart-phone"=>array("#0英寸高清屏幕" => "screen_size", "#0"=>"screen_ratio", "#0"=>"product_spec")
	,"cpu"=>array("#0 接口"=>"interface", "核心数量 #0"=>"core_num", "包装 #0"=>"packaging")
	,"ssd"=>array("#0"=>"disk_dimension", "#0 读取速度"=>"read_speed", "#0 主控芯片"=>"main_chip")
	,"mainboard"=>array("#0 外形尺寸"=>"outline_dimension", "最大支持内存容量 #0B"=>"max_mem_size", "适用类型 #0"=>"fit_type")
);
$fieldMap = $fieldAllMap[$module];
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
<title>英特尔® 平板电脑、笔记本电脑、智能手机、和处理器</title>
<link rel="stylesheet" href="../common/resource/css/index.css" type="text/css" />
<link rel="stylesheet" href="../common/resource/css/btn_kv.css" type="text/css" />
<script src="../common/resource/js/jquery-1.7.2.min.js"></script>
<script src="../common/resource/js/toolkit.js"></script>
<script src="../common/resource/js/btn_kv.js"></script>
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

<?php include_once __DIR__.'/../common/style.php';?>
<?php
if (file_exists(__DIR__.'/../'.$module.'/custom_style.php')) {
	require_once __DIR__.'/../'.$module.'/custom_style.php';
}
?>

<?php if ($module == '2in1') { ?>
<script language='JavaScript1.1' src='//pixel.mathtag.com/event/js?mt_id=782024&mt_adid=143326&v1=&v2=&v3=&s1=&s2=&s3='></script>
<?php } elseif ($module == 'aio') { ?>
<script language='JavaScript1.1' src='//pixel.mathtag.com/event/js?mt_id=782027&mt_adid=143326&v1=&v2=&v3=&s1=&s2=&s3='></script>
<?php } elseif ($module == 'cpu') { ?>
<script language='JavaScript1.1' src='//pixel.mathtag.com/event/js?mt_id=782021&mt_adid=143326&v1=&v2=&v3=&s1=&s2=&s3='></script>
<?php } elseif ($module == 'desktop') { ?>
<script language='JavaScript1.1' src='//pixel.mathtag.com/event/js?mt_id=782025&mt_adid=143326&v1=&v2=&v3=&s1=&s2=&s3='></script>
<?php } elseif ($module == 'laptop') { ?>
<script language='JavaScript1.1' src='//pixel.mathtag.com/event/js?mt_id=782026&mt_adid=143326&v1=&v2=&v3=&s1=&s2=&s3='></script>
<?php } elseif ($module == 'mainboard') { ?>
<script language='JavaScript1.1' src='//pixel.mathtag.com/event/js?mt_id=782022&mt_adid=143326&v1=&v2=&v3=&s1=&s2=&s3='></script>
<?php } elseif ($module == 'smart-phone') { ?>
<script language='JavaScript1.1' src='//pixel.mathtag.com/event/js?mt_id=782028&mt_adid=143326&v1=&v2=&v3=&s1=&s2=&s3='></script>
<?php } elseif ($module == 'ssd') { ?>
<script language='JavaScript1.1' src='//pixel.mathtag.com/event/js?mt_id=782020&mt_adid=143326&v1=&v2=&v3=&s1=&s2=&s3='></script>
<?php } elseif ($module == 'tablet') { ?>
<script language='JavaScript1.1' src='//pixel.mathtag.com/event/js?mt_id=782023&mt_adid=143326&v1=&v2=&v3=&s1=&s2=&s3='></script>
<?php } ?>
</head>
<body>
<script type="text/javascript"> 
MLTracker = {
mid : 10019133, 
serverbaseurl:"menlost.mlt01.com/",
ers : [ {
"type" : "pageview", pa: "<?=$module?>"
} ],
//type:"pageview"必填,且丌可修改。 //示例:uid:"123",选填,网站自身标识唯一用户的变量,需要网站方传入。需传入当前 用户uid,如无此参数,则留空丌传 //示例:pid:"123",选填,产品唯一id,该变量可用于跟踪用户浏览商品的行为来实现精 准营销。需根据当前用户所访问的产品详细页对应的产品id进行传入,如无此参数,则留 空丌传。
//示例:pa:"123456",选填,页面上产品分类唯一标识 产品分类包:tablet/2in1/laptop/desktop/aio/smart-phone。请将产品分类对应的分类 id传入,并且请线下告知id不产品分类的对应关系;如无产品分类id,可直接传入产品分类 名称(如tablet)。如无此参数,则留空丌传。
track : function(er) {
this.ers.push(er); }
}; 

(function() {
var js = document.createElement("script"), scri = document .getElementsByTagName("script")[0];
js.type = "text/javascript";
js.async = true; scri.parentNode.insertBefore(js, scri);
js.src ="http://static.mlt01.com/comt/dm.js"; })();
</script>
<?php include_once __DIR__.'/../common/ga_code.php'; ?>
<?php include_once __DIR__.'/../common/header.php'; ?>

<div id="mc_container">
	<?php
	if (file_exists(__DIR__.'/../'.$module.'/custom_kv.php')) {
		require_once __DIR__.'/../'.$module.'/custom_kv.php';
	}
	?>
	<div class="main">
		<?php if (!empty($hotProducts) && count($hotProducts) > 0) { ?>
		<div class="hot <?=(!empty($platform) || !empty($formFactor))  ? 'col' : ''; ?>">
			<div class="ttl">
				<h2><em>热卖产品</em><span>展开热卖产品</span></h2>
				<div class="pos-r">
					<ul class="handle">
						<li class="active"></li>
						<?=str_repeat("<li></li>", intval(count($hotProducts)*1.0/2+0.5) - 1); ?>
					</ul>
					
					<div class="switcher">
						<span class="i-stack"><i>&nbsp;&nbsp;&nbsp;&nbsp;</i><b>&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
						<span class="i-a"></span>
					</div>
				</div>
				
			</div>
			
			<div class="items-list">
				<ul>
					<?php  for ($i=0; $i < count($hotProducts); $i+=2) { ?>
					<li>
						<div class="product l">
							<div class="img-box">
								<img height="217" src="../common/resource/hot_products/<?=$module."/".($i+1);?>.jpg" />
							</div>
							<div class="info-box">
								<h3><?=$hotProducts[$i]['desc'];?></h3>
								<p class="spec"><strong><?=$hotProducts[$i]['name'];?></strong></p>
								<p class="spec"><?=$hotProducts[$i]['cpu'];?></p>
								<p class="price">指导价格：<em>RMB <?=$hotProducts[$i]['price'];?></em></p>
								<p>
									<a href="<?=(strpos($hotProducts[$i+1]['url'], 'http://') !== false || $hotProducts[$i+1]['url']=="javascript:void 0;") ? $hotProducts[$i]['url'] : '../'.$hotProducts[$i]['url'];?>" class="btn" target="_blank">了解详情</a> <span class="logo"><img height="29" src="../common/resource/logo/<?=$hotProducts[$i]['logo'];?>" /></span>
								</p>
							</div>
							<div class="conner"></div>
						</div>
						<?php if (!empty($hotProducts[$i+1])) { ?>
						<div class="product r">
							<div class="img-box">
								<img height="217" src="../common/resource/hot_products/<?=$module."/".($i+2);?>.jpg" />
							</div>
							<div class="info-box">
								<h3><?=$hotProducts[$i+1]['desc'];?></h3>
								<p class="spec"><strong><?=$hotProducts[$i+1]['name'];?></strong></p>
								<p class="spec"><?=$hotProducts[$i+1]['cpu'];?></p>
								<p class="price">指导价格：<em>RMB <?=$hotProducts[$i+1]['price'];?></em></p>
								<p>
									<a href="<?=(strpos($hotProducts[$i+1]['url'], 'http://') !== false || $hotProducts[$i+1]['url']=="javascript:void 0;") ? $hotProducts[$i+1]['url'] : '../'.$hotProducts[$i+1]['url'];?>" class="btn" target="_blank">了解详情</a> <span class="logo"><img height="29" src="../common/resource/logo/<?=$hotProducts[$i+1]['logo'];?>" /></span>
								</p>
							</div>
							<div class="conner"></div>
						</div>
						<?php } ?>
					</li>
					<?php } ?>
					
				</ul>
				
				<div class="nav-btns">
					<a class="btn-prev"></a>
					<a class="btn-next"></a>
				</div>
			</div>
			
			<div class="liner"></div>
		</div>
		<?php } ?>
		<!-- 热门产品结束 -->

<div id="ajax-content">
<?php } ?>

	<?php if (!empty($filterData)) { ?>
		
		<?php
		$cssClass = "col-all";
		if (getParam("open_filter") == 1 || $module == 'cpu') {
			$cssClass = "";
		} elseif (getParam("open_filter") == 2 || $module == 'mainboard' || $module == 'ssd') {
			$cssClass = "col-one";
		}
		?>

		<div class="filter-box <?=$cssClass?>">
			<!--a id="usage" name="usage"></a-->
			<?php if (!empty($usageModule)) { ?>
			<div class="lev-1">
				<div class="header">
					<ul class="tags">
						<?php 
						foreach ($usageModule as $usageKey => $usageInfo) { 
							$cssClass = '';
							if ($usageKey==$usage) {
								$cssClass = 'select';
							}
						?>
						<li class="<?=$cssClass; ?>">
							<em><?=$usageKey; ?><i></i></em>
							<span><img src="../common/resource/images/icon-cup.jpg" style="vertical-align:middle;margin-right:10px;margin-top:-5px;"/><?=$usageInfo['description']; ?></span>
						</li>
						<?php } ?>
					</ul>
					
					<div class="pro">
						<a id="data_<?=$module?>_show_options" href="javascript:void 0;">&nbsp;&nbsp;</a>
					</div>
				</div>
				<div class="content">
					<ul>
						<li>&nbsp;　<!--极致轻薄，小巧便携，为背包减负；平板和PC模式随心切换，尽享无忧旅行。--></li>
					</ul>
				</div>
				<div class="more-box">
					<div class="btn-more">展开查找更多相关产品</div>
					<!--div class="btn-close">收起</div-->
				</div>
			</div>
			<?php } ?>
			<div class="lev-2">
				
				<ul>
					<?php 
						$i=0; 
						foreach ($filterData as $key => $filter) { 
							if($i>=$numOfFirstFilterGroup){break;} 
							$i++; 
							$filterUrlParam = $urlParam;
							unset($filterUrlParam[$key]); 
							$linkAll = "index.php?".implode("&", $filterUrlParam)."#usage";//(!empty($filterUrlParam) ? "index.php?".implode("&", $filterUrlParam)."#usage" : "javascript:void 0;");
					?>
					<li class="<?=$key; ?>">
						<em><?=$filterNames[$key]; ?><i></i></em> 
						<a href="<?=$linkAll; ?>" class="all <?=empty($usedFilters[$key]) ? 'active' : '';?>"><span>全部</span></a>
						<?php 
							
							foreach ($filter['items'] as $itemKey => $itemValue) { 
								$link = "index.php?";
								$currentParam = $key."=".($filter['type'] != 'range' ? rawurlencode($itemValue) : rawurlencode($itemKey));
								$link .= !empty($filterUrlParam) ? implode("&", $filterUrlParam)."&".$currentParam : $currentParam;
								$isSelected = !empty($selectedFilters[$key]) && ($filter['type'] != 'range'&&$itemValue==$selectedFilters[$key] || $filter['type'] == 'range'&&$itemKey==$selectedFilters[$key]);
								$cssClass = "";
								if ($isSelected) {
									$cssClass = "active";
								} elseif ($filter['type'] != 'range' && (empty($filtersAvailble[$key]) || !in_array($itemValue, $filtersAvailble[$key]))) {
									$cssClass = "disable";
								} elseif ($filter['type'] == 'range' && (empty($filtersAvailble[$key]) || !in_array($itemKey, $filtersAvailble[$key]))) {
									$cssClass = "disable";
								}
								
						?>
							<a href="<?=$cssClass!="" ? "javascript:void 0;" : $link."#usage"; ?>" class="<?=$cssClass; ?>"> <?=$key=='cpu' ? '<span>' : '';?><?=$itemValue; ?><?=$key=='cpu' ? '</span>' : '';?></a>
						<?php } ?>
					</li>
					<?php } ?>
				</ul>
				<a href="javascript:void 0;" class="btn_close"></a>
				<a href="javascript:void 0;" class="btn_reset">重置</a>
			</div>
			<?php if (count($filterData) > $numOfFirstFilterGroup) { ?>
			<div class="lev-3">
				<ul>
					<?php 
						$i=0; 
						foreach ($filterData as $key => $filter) { 
							if($i++<$numOfFirstFilterGroup){continue;} 
							
							$filterUrlParam = $urlParam;
							unset($filterUrlParam[$key]); 
							$linkAll = "index.php?".implode("&", $filterUrlParam)."#usage";
							//$linkAll = (!empty($filterUrlParam) ? "index.php?".implode("&", $filterUrlParam)."#usage" : "javascript:void 0;");
					?>
					<li class="<?=$key; ?>">
						<em><?=$filterNames[$key]; ?></em> 
						<a href="<?=$linkAll; ?>"<?=empty($usedFilters[$key]) ? ' class="all all2"' : ' class="all2"';?>>全部</a>
						<?php 
							
							foreach ($filter['items'] as $itemKey => $itemValue) { 
								$link = "index.php?";
								$currentParam = $key."=".($filter['type'] != 'range' ? rawurlencode($itemValue) : rawurlencode($itemKey));
								$link .= !empty($filterUrlParam) ? implode("&", $filterUrlParam)."&".$currentParam : $currentParam;
								$isSelected = !empty($selectedFilters[$key]) && ($filter['type'] != 'range'&&$itemValue==$selectedFilters[$key] || $filter['type'] == 'range'&&$itemKey==$selectedFilters[$key]);
								$cssClass = "";
								///echo "Item $key $itemKey:$itemValue ".print_r($filtersAvailble[$key])."\n";
								if ($isSelected) {
									$cssClass = "all";
								} elseif ($filter['type'] != 'range' && (empty($filtersAvailble[$key]) || !in_array($itemValue, $filtersAvailble[$key]))) {
									$cssClass = "disable";
								} elseif ($filter['type'] == 'range' && (empty($filtersAvailble[$key]) || !in_array($itemKey, $filtersAvailble[$key]))) {
									$cssClass = "disable";
								}
						?>
							<a href="<?=$cssClass!="" ? "javascript:void 0;" : $link."#usage"; ?>" class="<?=$cssClass; ?>"> <?=$itemValue; ?><?=$key==$memField ? 'GB' : '';?></a>
						<?php } ?>
					</li>
					<?php } ?>
				</ul>
				<a href="javascript:void 0;" class="btn_reset">重置</a>
				
				<a href="javascript:void 0;" class="btn_close"></a>
			</div>
			<div class="btn-options">
				<span class="exp">展开更多选项</span>
				<span class="col">收起选项</span>
			</div>
			<?php } ?>
		</div>
		<!-- filter box end -->
	<?php } ?>
		<div class="product-box">
			<a id="product" name="product"></a>
			<div class="header">
				<span class="count">已选择的产品 <strong><?=$total; ?></strong></span>
				<?php 
					$orderUrl = "index.php";
					$orderUrl .= empty($urlParam) ? '?order=' : '?'.implode("&", $urlParam)."&order=";
				?>
				<a href="<?=$orderUrl?><?=$order=='price-desc' ? 'price-asc' : 'price-desc';?>#product" class="order <?=$order=='price-desc' ? 'desc' : '';?>">价格排序</a>
				
				<a href="<?=$orderUrl?><?=$order=='hot-desc' ? 'hot-asc' : 'hot-desc';?>#product" class="order <?=$order=='hot-desc' ? 'desc' : '';?>">热门排序</a>
				<?php include_once __DIR__.'/../common/search_block.php'; ?>
			</div>
			
			<?php if (!empty($products)) {  ?>
			<ul class="product-list">
				<?php	foreach ($products as $p) { ?>
				<li class="product_<?=$p['pconline_id'];?>" id="data_<?=$module?>_product_<?=$p['pconline_id']?>">
					<div class="imgbox"><img width="226" src="../product_images/<?=$p['cover_image']?>" /></div>
					<div class="infobox">
						<h2 title="<?=htmlspecialchars($p['name']); ?>"><strong><?=mb_strimwidth($p['name'],0,48,'','utf-8'); ?></strong></h2>
						<input class="brand" type="hidden" value="<?=empty($brandFields[$module]) ? '英特尔' : $p[$brandFields[$module]];?>" /> 
						<p class="intro"><?=mb_strimwidth($p[$fieldMap[$firstFields[$module]]], 0, 25, '', 'utf-8').($firstFields[$module] == 'disk_size' ? 'GB 容量' : '');?>&nbsp;　</p>
						<p class="price">指导价格：<em><?=($p['price'] == 0 || $p['price'] == null  || $p['price'] == 'null') ? '暂无报价' : 'RMB '.$p['price']; ?></em></p>
						<p><a href="../<?=$module?>/detail.php?id=<?=$p['pconline_id'];?>" target="_blank" class="btn-detail">了解详情</a></p>
					</div>
					<div class="logo">
						<p class="logo-image">
							<?php if (!empty($p['m_brand_en'])) { ?>
							<img height="36" src="../common/resource/logo/logo_<?=$p['m_brand_en']?>.png" />
							<?php } else { ?>
							<img height="36" src="../common/resource/logo/logo_Intel.png" />
							<?php } ?>
						</p>
						<p class="add-cmp"><input id="data_<?=$module?>_product_<?=$p['pconline_id'];?>_addcomparison" product="<?=$p['pconline_id'];?>" module="<?=$module; ?>" type="checkbox" /> 加入对比</p>
						<div class="clear"></div>
					</div>
					<?php if ($p['hot']) { ?>
					<div class="conner"></div>
					<?php } ?>
					<div class="cover">
						<div class="adv">
							<?php foreach ($secondFields[$module] as $template => $value) { ?>
							<p>
								<?php if (is_array($value)) { ?>
								<?=str_replace(array("#0", "#1"), array($p[$fieldMap[$value[0]]], $p[$fieldMap[$value[1]]]), $template);?>
								<?php } else { ?>
								<?=str_replace("#0", $p[$fieldMap[$value]], $template);?>
								<?php } ?>
							</p>
							<?php } ?>
						</div>
						<div class="options">
							<p id="data_<?=$module?>_product_<?=$p['pconline_id'];?>_addwishing" class="wishing" product="<?=$p['pconline_id'];?>"><img src="../common/resource/images/btn_add_wishing.png" /></p>
							<p id="data_<?=$module?>_product_<?=$p['pconline_id'];?>_share" class="share"><img src="../common/resource/images/btn_share_product.png" /></p>
							<ul>
								<li class="top_line"></li>
								<li class="share_item sina"><a id="data_<?=$module?>_product_<?=$p['pconline_id'];?>_share_weibo" href="javascript: void 0;">新浪微博</a></li>
								<li class="share_item sohu"><a id="data_<?=$module?>_product_<?=$p['pconline_id'];?>_share_sohu" href="javascript: void 0;">搜狐微博</a></li>
								<li class="share_item qzone"><a id="data_<?=$module?>_product_<?=$p['pconline_id'];?>_share_qq" href="javascript: void 0;">QQ空间</a></li>
								<li class="share_item kaixin"><a id="data_<?=$module?>_product_<?=$p['pconline_id'];?>_share_kaixin" href="javascript: void 0;">开心网</a></li>
								<li class="share_item renren"><a id="data_<?=$module?>_product_<?=$p['pconline_id'];?>_share_renren" href="javascript: void 0;">人人网</a></li>
							</ul>
						</div>
					</div>
				</li>
				<?php } ?> 
			</ul>
			<?php } else { ?>

			<?php } ?>
			<div class="pager">
				<?=$pagerHtml; ?>
			</div>
		</div>
<?php if (!$inAjax) { ?>
</div>
	</div>
	<?php include_once __DIR__.'/../common/cmp_wishing_box.php';?>
	<?php include_once __DIR__.'/../common/disclaimer.php';?>

</div>
<?php include_once __DIR__.'/../common/footer.php'; ?>
<?php include_once __DIR__.'/../common/interact_js.php'; ?>
<?php include_once __DIR__.'/../common/cmp_wishing_box_js.php'; ?>
<?php
if (file_exists(__DIR__.'/../'.$module.'/custom_js.php')) {
	require_once __DIR__.'/../'.$module.'/custom_js.php';
}
?>
</body>
</html>
<?php } ?>