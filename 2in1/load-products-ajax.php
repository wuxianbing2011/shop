<?php
require_once __DIR__.'/../data/static_data_2in1.php';
require_once __DIR__.'/../webconfig.php';
require_once __DIR__.'/../libs/pager.php';

$fieldMap = array("brand"=>"brand_name", "price"=>"price", "cpu"=>"cpu", "screen_size"=>"screen_size", "weight"=>"weight", "thickness"=>"thickness", "memory_size"=>"memory_size", "tech"=>"tech","disc_type"=>"harddist_type", "disc_size"=>"harddisc_size", "graphics_card"=>"graphics_card", "product_form"=>"form_factor");

$where = "1";
$pageUrl = "index.php?page={page}";

//usage param
$platform = getParam('platform');
if ($platform == 'baytrail') {
	$usage = '高性价比';
} elseif ($platform == 'haswell') {
	$usage = '性能超群';
}

//url params
if (!empty($platform)) {
	$where .= " and platform='{$platform}'";
	$pageUrl .= "&platform=".rawurlencode($platform);
}
$formFactor = getParam('form_factor');
$formFactors = array("convertible"=>"翻转", "detachable"=>"插拔");
if (!empty($formFactor)) {
	$where .= " and form_factor='{$formFactors[$formFactor]}'";
	$pageUrl .= "&form_factor=".rawurlencode($formFactor);
}

//kv display
$kv = "k8";
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if ($platform == 'baytrail' && $formFactor=='') {
	$kv = "k5";
} elseif ($platform == 'haswell' && $formFactor=='') {
	$kv = "k7";
} elseif ($platform == 'baytrail' && $formFactors[$formFactor] == '翻转') {
	$kv = "k2";
} elseif ($platform == 'baytrail' && $formFactors[$formFactor] == '插拔') {
	$kv = "k4";
} elseif ($platform == 'haswell' && $formFactors[$formFactor] == '翻转') {
	$kv = "k6";
} elseif ($platform == 'haswell' && $formFactors[$formFactor] == '插拔') {
	$kv = "k1";
} elseif (strpos($agent, 'iphone') || strpos($agent, 'ipad')){
	$kv = "k3";
}


include_once __DIR__.'/../common/request_processor.php';


?>
		<!-- 热门产品结束 -->
		<?php
		$cssClass = "col-all";
		if (getParam("open_filter") == 1) {
			$cssClass = "";
		} elseif (getParam("open_filter") == 2) {
			$cssClass = "col-one";
		}
		?>
		<div class="filter-box <?=$cssClass?>">
			<!--a id="usage" name="usage"></a-->
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
						专业检索<i class="icon"></i>
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
			<div class="lev-2">
				
				<ul>
					<?php 
						$i=0; 
						foreach ($filterData as $key => $filter) { 
							if($i>=3){break;} 
							$i++; 
							$filterUrlParam = $urlParam;
							unset($filterUrlParam[$key]); 
							$linkAll = "index.php?".implode("&", $filterUrlParam)."#usage";//(!empty($filterUrlParam) ? "index.php?".implode("&", $filterUrlParam)."#usage" : "javascript:void 0;");
					?>
					<li<?=$key == 'price' ? ' class="price"' : ($key=='cpu' ? ' class="cpu"' : '');?>>
						<em><?=$filterNames[$key]; ?><i></i></em> 
						<a href="<?=$linkAll; ?>" class="all <?=empty($usedFilters[$key]) ? 'active' : '';?>"><span>全部</span></a>
						<?php 
							
							foreach ($filter['items'] as $itemKey => $itemValue) { 
								$link = "index.php?";
								$currentParam = $key."=".($filter['type'] == 'single' ? rawurlencode($itemValue) : rawurlencode($itemKey));
								$link .= !empty($filterUrlParam) ? implode("&", $filterUrlParam)."&".$currentParam : $currentParam;
								$isSelected = !empty($selectedFilters[$key]) && ($filter['type'] == 'single'&&$itemValue==$selectedFilters[$key] || $filter['type'] == 'range'&&$itemKey==$selectedFilters[$key]);
								$cssClass = "";
								if ($isSelected) {
									$cssClass = "active";
								} elseif ($filter['type'] == 'single' && (empty($filtersAvailble[$key]) || !in_array($itemValue, $filtersAvailble[$key]))) {
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
			<div class="lev-3">
				<ul>
					<?php 
						$i=0; 
						foreach ($filterData as $key => $filter) { 
							if($i++<3){continue;} 
							
							$filterUrlParam = $urlParam;
							unset($filterUrlParam[$key]); 
							$linkAll = "index.php?".implode("&", $filterUrlParam)."#usage";
							//$linkAll = (!empty($filterUrlParam) ? "index.php?".implode("&", $filterUrlParam)."#usage" : "javascript:void 0;");
					?>
					<li>
						<em><?=$filterNames[$key]; ?></em> 
						<a href="<?=$linkAll; ?>"<?=empty($usedFilters[$key]) ? ' class="all"' : '';?>>全部</a>
						<?php 
							
							foreach ($filter['items'] as $itemKey => $itemValue) { 
								$link = "index.php?";
								$currentParam = $key."=".($filter['type'] == 'single' ? rawurlencode($itemValue) : rawurlencode($itemKey));
								$link .= !empty($filterUrlParam) ? implode("&", $filterUrlParam)."&".$currentParam : $currentParam;
								$isSelected = !empty($selectedFilters[$key]) && ($filter['type'] == 'single'&&$itemValue==$selectedFilters[$key] || $filter['type'] == 'range'&&$itemKey==$selectedFilters[$key]);
								$cssClass = "";
								///echo "Item $key $itemKey:$itemValue ".print_r($filtersAvailble[$key])."\n";
								if ($isSelected) {
									$cssClass = "all";
								} elseif ($filter['type'] == 'single' && (empty($filtersAvailble[$key]) || !in_array($itemValue, $filtersAvailble[$key]))) {
									$cssClass = "disable";
								} elseif ($filter['type'] == 'range' && (empty($filtersAvailble[$key]) || !in_array($itemKey, $filtersAvailble[$key]))) {
									$cssClass = "disable";
								}
						?>
							<a href="<?=$cssClass!="" ? "javascript:void 0;" : $link."#usage"; ?>" class="<?=$cssClass; ?>"> <?=$itemValue; ?><?=$key=='memory_size' ? 'GB' : '';?></a>
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
		</div>
		<!-- filter box end -->
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
			</div>
			
			<?php if (!empty($products)) {  ?>
			<ul class="product-list">
				<?php	foreach ($products as $p) { ?>
				<li>
					<div class="imgbox"><img width="226" src="../product_images/<?=$p['extra1']?>.jpg" /></div>
					<div class="infobox">
						<h2 title="<?=htmlspecialchars($p['name']); ?>"><strong><?//=mb_strimwidth($p['name'],0,30,'','utf-8'); ?><?=$p['name'];?></strong></h2>
						<p><?=$p['cpu'];?></p>
						<p class="price">指导价格：<em>RMB <?=$p['price'];?></em></p>
						<p><a href="<?=$p['purchase_link'];?>" target="_blank" class="btn-detail">了解详情</a></p>
					</div>
					<div class="logo"><img height="36" src="../common/resource/logo/logo_<?=$p['brand_name_en']?>.png" /></div>
					<?php if ($p['hot']) { ?>
					<div class="conner"></div>
					<?php } ?>
					<div class="cover">
						<div class="adv">
							<p><?=$p['screen_size'];?>英寸高清屏幕</p>
							<p><?=$p['harddisc_size'];?>GB <?=$p['harddist_type'];?></p>
							<p><?=$p['operating_system'];?>操作系统</p>
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