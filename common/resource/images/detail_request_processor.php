<?php
require_once __DIR__.'/../data/static_data_cmp.php';
require_once __DIR__.'/../data/static_data_detail.php';
require_once __DIR__.'/../webconfig.php';

$map = $fieldMap[$module];
$pconlineId = intval(getParam('id'));

$tableName = "products_".str_replace(array("aio","smart-phone"), array("allin1","mobile"), $module);
$product = $db->fetchRow("select * from {$tableName} where pconline_id='{$pconlineId}'");

if (empty($product)) {
	header("Location: index.php");
	exit;
}

$images = $db->fetchAll("select * from pcol_all_product_properties where product_id='{$pconlineId}' and module='parameter' and group_name='pics'");
$articleJsonStr = $db->fetchOne("select item_value from pcol_all_product_properties where product_id='{$pconlineId}' and module='article' and item_name='detail'");

if (empty($images)) {
	$images[] = array('item_value3'=>"product_images/{$pconlineId}.jpg");
}
$trackData = array("linktype"=>"seeproduct"
	, "manufacturer"=>empty($product["m_brand_en"]) ? "" : $product["m_brand_en"]
	, "processor"=>empty($product['cpu_en']) ? "" : $product['cpu_en']
	, "retailer"=>""
	, "model"=>""
	, "price"=>$product['price']
	, "formFactor"=>"");
if (!empty($product['model'])) {
	$trackData['model'] = $product["model"];
} elseif (!empty($product['mode'])) {
	$trackData['model'] = $product["mode"];
} elseif (!empty($product['model_type'])) {
	$trackData['model'] = $product["model_type"];
} elseif (!empty($product['model_alias'])) {
	$trackData['model'] = $product["model_alias"];
}


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
<link rel="stylesheet" href="../common/resource/css/detail.css" type="text/css">
<script src="../common/resource/js/jquery-1.7.2.min.js"></script>
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
<script src="../common/resource/js/tab.js"></script>
<?php include_once __DIR__.'/../common/style.php';?>
<style type="text/css">
#mc_container .bd .tabdetails .spec table tr td.left{width: 50%; padding-right: 10px; color: #0075c1; line-height: 22px; padding-bottom: 20px;vertical-align: top;}
#mc_container .bd .tabdetails .spec table tr td.right{width: 50%; padding-left: 10px; color: #0075c1; line-height: 22px; padding-bottom: 20px;vertical-align: top;}
#mc_container .bd .tabdetails .spec td.title{width: 110px;}

#mc_container .bd .tabdetails .buy h2 {background: url(../common/resource/images/buy_title_bg.png) no-repeat; width: 832px;}
#mc_container .bd .tabdetails .buy h2 span{font-size: 16px; color: #0066ff;}
#mc_container .bd .tabdetails .buy h2 .price{font-size: 16px;}
#mc_container .bd .tabdetails .buy h2 .price em{font-size: 18px;}
#mc_container .bd .tabdetails .buy .jd{height: 60px;margin-bottom:1px;width: 832px; background: url(../common/resource/images/buy_jd_bg.png) no-repeat;}
#mc_container .bd .tabdetails .buy .jd span{line-height: 60px;font-size:14px;color: #666;}
#mc_container .bd .tabdetails .buy .jd span em, #mc_container .bd .tabdetails .buy .suning span em, #mc_container .bd .tabdetails .buy .tmall span em{font-size: 18px;}
#mc_container .bd .tabdetails .buy .suning{height: 60px;width: 832px;background: url(../common/resource/images/buy_suning_bg.png);}
#mc_container .bd .tabdetails .buy .suning span{line-height: 60px;font-size:14px; color: #666;}
#mc_container .bd .tabdetails .buy .jd a.btn_buy, #mc_container .bd .tabdetails .buy .suning a.btn_buy, #mc_container .bd .tabdetails .buy .tmall a.btn_buy{font-size: 14px;width: 100px;height: 28px;line-height: 28px;top: 15px;text-indent:0.6em;}

#mc_container .bd .tabdetails .buy .tmall{position: relative; height: 60px;width: 832px;background: url(../common/resource/images/buy_tmall_bg.png);margin: 0 auto;}
#mc_container .bd .tabdetails .buy .tmall span{line-height: 60px;font-size:14px; color: #666;margin-left: 422px;}
#mc_container .bd .tabdetails .buy .tmall a.btn_buy{background: url(../common/resource/images/btn-buy-bg.jpg);display: block;position: absolute;left: 676px;color: #fff;}
#mc_container .property .btn_buy .buy_item {height: 157px;}
#mc_container .property .btn_buy a.buy_now{background: url(../common/resource/images/btn-buynow-bg.png) right center no-repeat #00adef;}
#mc_container .property .btn_buy a.disable{background: url(../common/resource/images/btn-buynow-bg.png) right center no-repeat #333; cursor: default;}

#mc_container .property .price{clear: both;}
#mc_container .bd .tabdetails .comments .grade .infobox{height: auto;}
#mc_container .tabdetails .spec td{word-break: break-all;}

<?php 
$hoverFields = $map['hoverFields'];
if (!empty($hoverFields)) {
	$screenSize = isset($product[$hoverFields[0]['field']]) ? $product[$hoverFields[0]['field']] : 0;
	$thickness = isset($product[$hoverFields[1]['field']]) ? $product[$hoverFields[1]['field']] : 0;
	$weight = isset($product[$hoverFields[2]['field']]) ? $product[$hoverFields[2]['field']] : 0;

	$pi = array($screenSize, $thickness, $weight);
	$hoverImages = array();
	$realValues = array();
	for ($i=0; $i < 3; $i++) { 
		$hf = $hoverFields[$i];
		$realValue = floatval($pi[$i]);

		if (!empty($hf['field'])) {
			$realValues[] = array($hf['name'], $hf['format'], $realValue);
		} else {
			$realValues[] = array($hf['name'], "#0", false);
		}
		if (count($hf['images']) == 1) {
			$hoverImages[$i] =  current($hf['images']);
		} else {
			$hoverImages[$i] =  current($hf['images']);
			foreach ($hf['images'] as $cond => $img) {
				if (preg_match("/^<([\d]+([\.][\d]+)?)$/", $cond, $match) && $match[1] > $realValue) {
					$hoverImages[$i] = $img;
				} elseif (preg_match("/^>([\d]+([\.][\d]+)?)$/", $cond, $match) && $match[1] <= $realValue) {
					$hoverImages[$i] = $img;
				} elseif (preg_match("/^([\d]+([\.][\d]+)?)\-([\d]+([\.][\d]+)?)$/", $cond, $match) && $realValue >= $match[1] && $realValue < $match[3]) {
					$hoverImages[$i] = $img;
				}
			}
		}
	}
?>
#mc_container .property .features.top .size .detail {background: url(../common/resource/images/detail-feature/<?=$hoverImages[0]?>_top.png) no-repeat;}
#mc_container .property .features.top .thickness .detail {background: url(../common/resource/images/detail-feature/<?=$hoverImages[1]?>_top.png) no-repeat;}
#mc_container .property .features.top .weight .detail {background: url(../common/resource/images/detail-feature/<?=$hoverImages[2]?>_top.png) no-repeat;}

#mc_container .property .features.bottom .size .detail {background: url(../common/resource/images/detail-feature/<?=$hoverImages[0]?>_bottom.png) no-repeat;}
#mc_container .property .features.bottom .thickness .detail {background: url(../common/resource/images/detail-feature/<?=$hoverImages[1]?>_bottom.png) no-repeat;}
#mc_container .property .features.bottom .weight .detail {background: url(../common/resource/images/detail-feature/<?=$hoverImages[2]?>_bottom.png) no-repeat;}
<?php } else { ?>
#mc_container .property .features {display: none;}
<?php } ?>

#mc_container .property .features li .detail{display: none; width: 461px; height: 167px;}
#mc_container .property .features.bottom li .detail {top: 72px;}

#mc_container .property .btn_buy .buy_item ul li.disable a {color: #ccc;}
#mc_container .property .btn_buy .buy_item ul li.disable:hover {background: none;}


#mc_container .bd .tabdetails .product{height: auto; background: none;padding-bottom: 50px;}

#mc_container .property .features li:hover {  cursor:pointer; }
#mc_container .bd .tabdetails .comments .grade .showcase img{display: none;}
#mc_container .property p {height: 32px; line-height: 32px;}
#mc_container .property p em{width: 100px; height: 32px; overflow: hidden;}
#mc_container .property p span{display: inline-block; width: 310px; overflow: hidden; height: 32px;padding-left: 3px;}

#mc_container .gallery .cover .logo {position: absolute; top: 3px; left: 3px;}


</style>
</head>
<body>
<script type="text/javascript"> MLTracker = {
mid : 10019133, 
serverbaseurl:"menlost.mlt01.com/",
ers : [ {
"type" : "pageview", pid:"<?=$pconlineId;?>",pa: "<?=$module?>"
} ],
//type:"pageview"必填,且丌可修改。 //示例:uid:"123",选填,网站自身标识唯一用户的变量,需要网站方传入。需传入当前 用户uid,如无此参数,则留空丌传 //示例:pid:"123",选填,产品唯一id,该变量可用于跟踪用户浏览商品的行为来实现精 准营销。需根据当前用户所访问的产品详细页对应的产品id进行传入,如无此参数,则留 空丌传。
//示例:pa:"123456",选填,页面上产品分类唯一标识 产品分类包:tablet/2in1/laptop/desktop/aio/smart-phone。请将产品分类对应的分类 id传入,并且请线下告知id不产品分类的对应关系;如无产品分类id,可直接传入产品分类 名称(如tablet)。如无此参数,则留空丌传。
track : function(er) {
this.ers.push(er); }
}; 
(function() {
var js = document.createElement("script"), 
scri = document .getElementsByTagName("script")[0];
js.type = "text/javascript";
js.async = true; scri.parentNode.insertBefore(js, scri);
js.src ="http://static.mlt01.com/comt/dm.js"; })();
</script>
<?php include_once __DIR__.'/../common/ga_code.php'; ?>
<?php include_once __DIR__.'/../common/header.php'; ?>

<div id="mc_container">
	<div class="breadcrumb"><a id="data_detail_breadcrumb_1" href="../">产品中心</a> > <a id="data_detail_breadcrumb_2" href="index.php"><?=$map['name']; ?></a> > <a href="javascript: void 0;"><?=$product['name']; ?></a></div>
	<div class="clear">
		<div class="gallery">
			<div class="cover">
				<div class="show">
					<img src="<?=!empty($images[0]['item_value3']) ? '../'.$images[0]['item_value3'] : $images[0]['item_value'];?>" />
				</div>
				<?php
					$cpuField = !empty($map['specFields']['cpu']) ? $map['specFields']['cpu'] : false;
					$origCpuField = 'cpu';
					$origCpuTypeField = 'cpu_type';
					$rawStr = (isset($product[$cpuField]) ? $product[$cpuField] : '').(isset($product[$origCpuField]) ? $product[$origCpuField] : '').(isset($product[$origCpuTypeField]) ? $product[$origCpuTypeField] : '');
					if (preg_match("/(i3|i5|i7|赛扬|奔腾|Pentium|Celeron|凌动|atom|安腾|itanium|至强|xeon)/i", $rawStr, $match)) {
				?>
				<img src="../common/resource/images/badge/badge_<?=strtolower(str_replace(array("赛扬","奔腾","凌动","安腾","至强"), array("Celeron", "Pentium", "atom","itanium","xeon"), $match[0]));?>.jpg" class="badge" />
				<?php
					}
				?>
				<?php if(!in_array($module, array("cpu","mainboard","ssd"))) { ?>
				<img src="../common/resource/logo/logo_<?=$product['m_brand_en']; ?>.png" class="logo" />
				<?php } ?>
			</div>
			<ul class="items">
				<li id="data_detail_image_1"><img width="135" src="<?=!empty($images[0]['item_value3']) ? '../'.$images[0]['item_value3'] : $images[0]['item_value'];?>" big="<?=!empty($images[0]['item_value3']) ? '../'.$images[0]['item_value3'] : $images[0]['item_value'];?>" /></li>
				<?php if (!empty($images[1])){ ?>
				<li id="data_detail_image_2"><img width="135" src="<?=!empty($images[1]['item_value3']) ? '../'.$images[1]['item_value3'] : $images[1]['item_value'];?>" big="<?=!empty($images[1]['item_value3']) ? '../'.$images[1]['item_value3'] : $images[1]['item_value'];?>" /></li>
				<?php } ?>
				<?php if (!empty($images[2])){ ?>
				<li id="data_detail_image_3"><img width="135" src="<?=!empty($images[2]['item_value3']) ? '../'.$images[2]['item_value3'] : $images[2]['item_value'];?>" big="<?=!empty($images[2]['item_value3']) ? '../'.$images[2]['item_value3'] : $images[2]['item_value'];?>" /></li>
				<?php } ?>
			</ul>
		</div>
		<div class="property">
			<h1><?=$product['name']; ?></h1>
			<div style="min-height: 120px;">
				<?php foreach ($map['briefFields'] as $item) { 
						$field = $item['field'];
						$template = $item['format'];
				?>
				<p>
					<em><?=$item['name']; ?></em> 
					<span>
						<?php if (is_array($field)) { ?>
						<?=str_replace(array("#0", "#1"), array($product[$field[0]], $product[$field[1]]), $template);?>
						<?php } else { ?>
						<?=str_replace("#0", $product[$field], $template);?>
						<?php } ?>
					</span>
				</p>
				<?php } ?>
				<input class="brand" type="hidden" value="<?=empty($brandFields[$module]) ? '英特尔' : $product[$brandFields[$module]];?>" /> 
			</div>
			<?php if (!empty($hoverFields)) { ?>
			<ul class="features clear top">
				<li class="size">
					<div><?=$realValues[0][0]; ?><br/><?=!empty($realValues[0][2]) ? str_replace("#0", $realValues[0][1],  $realValues[0][2]) : '暂无信息';?></div>
					<div class="detail"></div>
				</li>
				<li class="thickness">
					<div><?=$realValues[1][0]; ?><br/><?=!empty($realValues[1][2]) ? str_replace("#0", $realValues[1][1],  $realValues[1][2]) : '暂无信息';?></div>
					<div class="detail"></div>
				</li>
				<li class="weight">
					<div><?=$realValues[2][0]; ?><br/><?=!empty($realValues[2][2]) ? str_replace("#0", $realValues[2][1],  $realValues[2][2]) : '暂无信息';?></div>
					<div class="detail"></div>
				</li>
			</ul>
			<?php } else { ?>
			<div style="height:75px;">&nbsp;</div>
			<?php } ?>
			
			<div class="price"><span>指导价格：</span> <em><?=$product['price'] == 0 ? '暂无价格' : 'RMB '.$product['price'];?></em></div>
			
			<div class="btn_buy">
				<a href="javascript: void 0;" class="buy_now<?=empty($product['jd_id']) && empty($product['suning_id']) && empty($product['tmall_id']) ? ' disable' : ''; ?>" <?=empty($product['jd_id']) && empty($product['suning_id']) ? '' : 'id="data_detail_summary_btn_buy"'; ?>>即刻购买</a>
				<div class="buy_item">
					<ul>
						<li<?=empty($product['jd_id']) ? ' class="disable"' : '';?>>
							<?php $trackData['retailer'] = "JD"; ?>
							<a target="_blank" data-wap="<?=htmlspecialchars(json_encode($trackData)); ?>" href="<?=empty($product['jd_id']) ? 'javascript: void 0;' : "http://item.jd.com/{$product['jd_id']}.html";?>" <?=empty($product['jd_id']) ? '' : 'id="data_detail_summary_btn_jd"';?> class="jd">京东商城购买</a>
						</li>
						<li<?=empty($product['suning_id']) ? ' class="disable"' : '';?>>
							<?php $trackData['retailer'] = "Suning"; ?>
							<a target="_blank" data-wap="<?=htmlspecialchars(json_encode($trackData)); ?>" href="<?=empty($product['suning_id']) ? 'javascript: void 0;' : "http://product.suning.com/{$product['suning_id']}.html";?>" <?=empty($product['suning_id']) ? '' : 'id="data_detail_summary_btn_suning"';?> class="suning">苏宁易购购买</a>
						</li>
						<?php if (in_array($module, array('cpu', 'mainboard', 'ssd'))) { ?>
						<li<?=empty($product['tmall_id']) ? ' class="disable"' : '';?>>
							<?php $trackData['retailer'] = "Tmall"; ?>
							<a target="_blank" data-wap="<?=htmlspecialchars(json_encode($trackData)); ?>" href="<?=empty($product['tmall_id']) ? 'javascript: void 0;' : "https://detail.tmall.com/item.htm?id={$product['tmall_id']}";?>" <?=empty($product['tmall_id']) ? '' : 'id="data_detail_summary_btn_tmall"';?> class="suning">天猫商城购买</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="action">
				<a class="add_wishing" href="javascript: void 0;">加入心愿单</a> | <a class="add_cmp" href="javascript: void 0;">加入对比</a>
			</div>
		</div>
	</div>
	
	<div class="bd">
		<div class="tabbarbox">
			<ul class="tabbar clear">
				<li id="data_detail_tab_1" class="product"><span>产品信息</span></li>
				<li id="data_detail_tab_2" class="spec"><span>规格参数</span></li>
				<li id="data_detail_tab_3" class="comment"><span>产品评价</span></li>
				<li id="data_detail_tab_4" class="buy"><span>购买链接</span></li>
			</ul>
		</div>
		
		<div class="tabdetails" style="clear:both;">
			<div class="td-item product">
			<?php
			$matchedSpecs = array();
			foreach ($productInfoMap as $key => $conds) {
				foreach ($conds as $cond) {
					if ($cond['type'] == 'like') {
						$field = !empty($map['specFields'][$key]) ? $map['specFields'][$key] : '';
						if (empty($field) || empty($product[$field])) {
							continue;
						}
						$value = strtolower($product[$field]);
						foreach ($cond['keywords'] as $kw) {
							if (strpos($value, strtolower($kw)) !== false) {
								$matchedSpecs[] = $cond;
								break;
							}
						}
					} else if ($cond['type'] == "match") {
						$isMatch = true;
						foreach ($cond['cond'] as $itemField=>$item) {
							$field = !empty($map['specFields'][$itemField]) ? $map['specFields'][$itemField] : '';
							if (empty($field) || empty($product[$field])) {
								$isMatch = false;
								break;
							}
							$value = $product[$field];
							if (strpos($item, "<") === 0) {
								$itemValue = str_replace("<", "", $item);
								if (floatval($itemValue) > floatval($value)) {
									break;
								}
							}
							$isMatch = false;
						}
						if ($isMatch) {
							$matchedSpecs[] = $cond;
						}
					}
				}
			}
			if (!empty($matchedSpecs)) {
				$i = 0;
				foreach ($matchedSpecs as $ms) {
					$td1 = "<img src=\"../common/resource/images/{$ms['image']}\" />";
					$td2 = "<h2>{$ms['title']}</h2><div class=\"content\">{$ms['description']}</div>";
					$contentStyle = ' style="padding: 0px 50px 0px 60px; "';
			?>
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="50%" <?=$i%2 == 0 ? ' style="text-align:center;"' : $contentStyle; ?>>
							<?=$i%2 == 0 ? $td1 : $td2; ?>
						</td>
						<td <?=$i%2 == 1 ? ' style="text-align:center;"' : $contentStyle; ?>>
							<?=$i%2 == 0 ? $td2 : $td1; ?>
						</td>
					</tr>
				</table>
			<?php $i++;}} ?>
			</div>
			<div class="td-item spec">
				<table width="100%" cellpadding="0" cellspacing="0">
					<?php 
					for($i=0; $i<count($map["paramDetailFields"]); $i+=2) { 
						$left = $map["paramDetailFields"][$i];
						$right = isset($map["paramDetailFields"][$i+1]) ? $map["paramDetailFields"][$i+1] : false;
						if ($module == '' && $i == 9999) {
							$right2 = isset($map["paramDetailFields"][$i+2]) ? $map["paramDetailFields"][$i+2] : false;
						}
					?>
					<tr>
						<td class="left" vlign="top">
							<div class="s1">
								<h2 style="background: url(../common/resource/images/detail_icon_<?=$left['icon'];?>.png) no-repeat;"><?=$left['group_name']?></h2>
								<table width="100%" cellpadding="0" cellspacing="0">
									<?php foreach ($left['items'] as $item) { ?>
									<tr>
										<td class="title"><?=$item['name'];?></td>
										<td>
											<?=!empty($product[$item['field']]) ? str_replace("#0", $product[$item['field']], $item['format']) : "&nbsp;";?>
										</td>
									</tr>
									<?php } ?>
								</table>
							</div>
						</td>
						<td class="right" valign="top">
							<div class="s1">
								<?php if (!empty($right)) { ?>
								<h2 style="background: url(../common/resource/images/detail_icon_<?=$right['icon'];?>.png) no-repeat;"><?=isset($right['group_name']) ? $right['group_name'] : ''; ?></h2>
								<table width="100%" cellpadding="0" cellspacing="0">
									<?php foreach ($right['items'] as $item) { ?>
									<tr>
										<td class="title"><?=$item['name'];?></td>
										<td>
											<?=!empty($product[$item['field']]) ? str_replace("#0", $product[$item['field']], $item['format']) : "&nbsp;";?>
										</td>
									</tr>
									<?php } ?>
								</table>
								<?php } ?>
							</div>
						</td>
					</tr>
					<?php } ?>
				</table>
					
					
					
			</div>
			<div class="comments td-item">
				<div class="grade">
					<h3>编辑评分</h3>
					<div class="infobox">
						<div>
							<label>编辑评分：</label>
							
							<ol class="bar">
								<li><div></div></li>
								<li><div></div></li>
								<li><div></div></li>
								<li><div></div></li>
								<li><div></div></li>
							</ol>
							
							<label>接口：</label> <span><?=$product['editor_comment_score'] > 0 ? round($product['editor_comment_score'], 1)+0.2 : '0';?></span>
							<label>操作：</label> <span><?=$product['editor_comment_score'] > 0 ? round($product['editor_comment_score'], 1)-0.3 : '0';?></span>
							<label>外观：</label> <span><?=$product['editor_comment_score'] > 0 ? round($product['editor_comment_score'], 1) : '0';?></span>
							<label>便携：</label> <span><?=$product['editor_comment_score'] > 0 ? round($product['editor_comment_score'], 1)+0.1 : '0';?></span>
						</div>
						
						<div>
							<label>优点：</label> <?=!empty($product['editor_review_merit']) ? $product['editor_review_merit'] : '暂无发现'; ?>
						</div>
						
						<div>
							<label>缺点：</label> <?=!empty($product['editor_review_defect']) ? $product['editor_review_defect'] : '暂无发现'; ?>
						</div>
						
						<div class="cite">信息来自pconline</div>
					</div>
					
					<div class="clear">
						<div class="news pull-left">
							<ul>
								<?php 
								if ($articleJsonStr != '') {
									if (!preg_match("/\\\\u[0123456789abcdef]{4}/",$articleJsonStr)) {
										$articleJsonStr = preg_replace("/u[0123456789abcdef]{4}/",'\\\\$0', $articleJsonStr);
									}

									$articles = json_decode($articleJsonStr, true); 
									if (!empty($articles) && is_array($articles)) { 
										$i=0;
										$nameMap = array("tablet"=>"pad", "laptop"=>"notebook", "desktop"=>"desktops", "2in1"=>"ultrabook", "aio"=>"aio", "cpu"=>"diy", "mainboard"=>"diy", "ssd"=>"diy", "mobile"=>"mobile");
										foreach ($articles as $a) { $i++;
											//$a['url'] = str_replace("g.pconline.com.cn/x", $nameMap[$module].".pconline.com.cn", $a['url']);
								?>
								<li><a id="data_detail_comment_<?=$i?>" href="<?=$a['url']?>" target="_blank"><?=$a['title']?></a></li>
								<?php }}} ?>
							</ul>
						</div>
						
						<div class="showcase pull-right">
							<img src="../common/resource/images/news.jpg" />
						</div>
					</div>
				</div>
				<div class="impression">
					<h3>用户印象</h3>
					
					<div class="infobox">
						<img src="../common/resource/images/<?=$product['hot'] ? 'hot' : 'hot_1'; ?>.jpg"/>
					</div>
					
					<ul class="benefit">
						<?php
						//屏幕大(56)外观漂亮(43)电脑不错(39)运行稳定(36)速度快(35)配置不错(35)性能不错(31)噪音低(29)
						if (!empty($product["jd_comments"]) && preg_match_all("/[^\(]+\([\d]+\)/", $product["jd_comments"], $matches)) {
							foreach ($matches[0] as $comment) {
						?>
						<li><?=$comment; ?></li>
						<?php }} ?>
					</ul>
				</div>
			</div>
			<div class="td-item buy">
				<h2><span><?=$product['name']; ?></span><span class="price">指导价格：<em><?=$product['price'] == 0 ? '暂无价格' : 'RMB '.$product['price'];?></em></span></h2>
				
				<div class="jd">
					<span class="price">京东价格：<em><?=$product['jd_price'] == 0 ? '暂无价格' : 'RMB '.$product['jd_price'];?></em></span>
					<?php if ($product['jd_price'] > 0) { ?>
					<?php $trackData['retailer'] = "JD"; ?>
					<a id="data_detail_btn_buy_jd" data-wap="<?=htmlspecialchars(json_encode($trackData)); ?>" target="_blank" href="<?='http://item.jd.com/'.$product['jd_id'].'.html'; ?>" class="btn_buy">即刻购买</a>
					<?php } ?>
				</div>
				<div class="suning">
					<span class="price">苏宁价格：<em><?=$product['suning_price'] == 0 ? '暂无价格' : 'RMB '.$product['suning_price'];?></em></span>
					<?php if ($product['suning_price'] > 0) { ?>
					<?php $trackData['retailer'] = "Suning"; ?>
					<a id="data_detail_btn_buy_suning" data-wap="<?=htmlspecialchars(json_encode($trackData)); ?>" target="_blank" href="<?='http://product.suning.com/'.$product['suning_id'].'.html'; ?>" class="btn_buy">即刻购买</a>
					<?php } ?>
				</div>
				<?php if (in_array($module, array('cpu', 'mainboard', 'ssd'))) { ?>
				<div class="tmall">
					<span class="price">天猫价格：<em><?=$product['tmall_price'] == 0 ? '暂无价格' : 'RMB '.$product['tmall_price'];?></em></span>
					<?php if ($product['tmall_price'] > 0) { ?>
					<?php $trackData['retailer'] = "Tmall"; ?>
					<a id="data_detail_btn_buy_tmall" data-wap="<?=htmlspecialchars(json_encode($trackData)); ?>" target="_blank" href="<?='https://detail.tmall.com/item.htm?id='.$product['tmall_id']; ?>" class="btn_buy">即刻购买</a>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php include_once __DIR__.'/../common/cmp_wishing_box.php';?>
	<?php include_once __DIR__.'/../common/disclaimer.php';?>
</div>
<?php include_once __DIR__.'/../common/footer.php'; ?>
<script src="../common/resource/js/scroller.js"></script>
<script>
$('.gallery .items li img').click(function(){
	var src = this.getAttribute('big');
	
	$('.gallery .show img').attr('src', src);
});
tab({
	s_container: '.bd',
	s_tab: '.tabbarbox li',
	s_content: '.tabdetails .td-item',
	fireevent: 'click',
	selectClass: 'active',
	ontabselect: function(e){
		//new track code
		//trackShopFilter('detail-tab', $(".tabbar li:eq("+e.index+")").prop("id")); 
	},
	onshow: function(e){}
});

$(window).scroll(function(){
	var top = $(window).scrollTop();
	
	if(top > 152){
		//show bottom
		
		$('.property .features').removeClass('top').addClass('bottom');
	}else{
		//show top
		$('.property .features').removeClass('bottom').addClass('top');
	}
});
$('.property .btn_buy').click(function(e){
	if ($("#mc_container .property .btn_buy a.buy_now").hasClass("disable")) {
		return;
	}
	$(this).find('.buy_item').toggleClass('show');
});

function showEditorGrade(grade) {
	if (grade <= 0) {
		return;
	}
	grade = grade > 5 ? 5 : grade;

	var intPart = parseInt(grade);
	var floatPart = grade - intPart;
	$(".grade .infobox .bar li:lt("+intPart+")").addClass("active");
	$(".grade .infobox .bar li:eq("+intPart+")").find("div").width(floatPart*100+"%");
	$(".grade .infobox .bar li:eq("+intPart+")").find("div").height(10);
	$(".grade .infobox .bar li:eq("+intPart+")").find("div").css("background", "#42b6ff");
}

$("#mc_container .property .action a.add_wishing").click(function(){
	//new track code
	//trackShopFilter('button-detail','btn_<?=$module?>_<?=$pconlineId?>_add_wishing');
	if ($("#mc_container .ws_box .tab_contents .wishing li.item").length >= 15) {
		alert("最多只能添加15件心仪产品");
		return false;
	} else {
		addToWishingList2("<?=$pconlineId?>");
	}
});

$("#mc_container .property .action a.add_cmp").click(function(){
	//new track code
	//trackShopFilter('button-detail','btn_<?=$module?>_<?=$pconlineId?>_add_cmp');
	var cookieModule = getCookie("eshop_module");
	var module = "<?=$module?>"; 
	module = module == 'laptop' ? '2in1' : module;
	if (!cookieModule) {
		cookieModule = module;
		setCookie("eshop_module", cookieModule);
	}
	//if ($(this).prop("checked")) {
		if (module != cookieModule || (module == 'laptop' && cookieModule == '2in1')) {
			alert("只能对比相同种类的产品");
			$(this).prop("checked", false);
			return;
		}
		if ($("#mc_container .ws_box .tab_contents .cmp li.item").length > 3) {
			alert("最多只能同时对比4件商品");
			$(this).prop("checked", false);
		} else {
			addToCmpList2("<?=$pconlineId?>");
		}
	// } else {
	// 	removeFromCmpList($(this).attr("product"));
	// }
});

function addToCmpList2(productId) {
	if ($("#mc_container .ws_box").hasClass("hide")) {
		$("#mc_container .ws_box").removeClass("hide")
	}
	$("#mc_container .ws_box").removeClass("tab_wishing");
	if (!$("#mc_container .ws_box").hasClass("tab_cmp")) {
		$("#mc_container .ws_box").addClass("tab_cmp");
	}
	var cmpIds = getCookieCmpIds();
	if ($.inArray(productId, cmpIds) == -1) {
		cmpIds.push(productId);
	}

	setCookie("eshop_cmp_ids", cmpIds.join(","));
	var itemHtml = '';
	var brand = $(".property .brand").val();
	var name = $(".property h1").text();
	var price = $(".property .price em").text();
	itemHtml += '<li class="item" product="'+productId+'">';
	itemHtml += '	<p class="image-box"><img width="80" src="../product_images/'+productId+'.jpg" /></p>';
	itemHtml += '	<p class="brand">'+brand+'</p>';
	itemHtml += '	<p class="title">'+name.replace(brand, "")+'</p>';
	itemHtml += '	<p class="price">'+price.replace("指导价格：","").replace("RMB","￥")+'</p>';
	itemHtml += '	<p class="buy_btn"><a id="data_fixed_comparison_btn_buy_'+productId+'" href="../'+"<?=$module?>"+'/detail.php?id='+productId+'" target="_blank">立刻购买</a></p>';
	itemHtml += '	<p id="data_fixed_comparison_btn_delete_'+productId+'" class="btn_delete"></p>';
	itemHtml += '</li>';
	if ($("#mc_container .ws_box .tab_contents .cmp li.item").length == 3) {
		 $("#mc_container .ws_box .tab_contents .cmp .add").replaceWith(itemHtml);
	} else {
		$("#mc_container .ws_box .tab_contents .cmp .add").before(itemHtml);
	}
	
	setTimeout(function(){
		$("#mc_container .ws_box .tab_contents .cmp .btn_delete").unbind();
		$("#mc_container .ws_box .tab_contents .cmp .btn_delete").click(function(){
			removeFromCmpList($(this).parent().attr("product"));
		});
	}, 500);

	if ($("#mc_container .ws_box .tab_contents .cmp li.item").length > 0) {
		$("#mc_container .ws_box .tabs ul .cmp span").text("产品比较 ( "+$("#mc_container .ws_box .tab_contents .cmp li.item").length+"/4 )");
	} else {
		$("#mc_container .ws_box .tabs ul .cmp span").text("产品比较");
	}
	updateFooterPos();
	updateShareId();
}

function addToWishingList2(productId) {
	var wishingIds = getCookieWishingIds();
	if ($.inArray(productId, wishingIds) == -1) {
		wishingIds.push(productId);
	} else {
		return;
	}

	if ($("#mc_container .ws_box").hasClass("hide")) {
		$("#mc_container .ws_box").removeClass("hide")
	}
	$("#mc_container .ws_box").removeClass("tab_cmp");
	if (!$("#mc_container .ws_box").hasClass("tab_wishing")) {
		$("#mc_container .ws_box").addClass("tab_wishing");
	}
	setCookie("eshop_wishing_ids", wishingIds.join(","));

	var itemHtml = '';
	var brand = $(".property .brand").val();
	var name = $(".property h1").text();
	var price = $(".property .price em").text();

	itemHtml += '<li class="item" product="'+productId+'">';
	itemHtml += '	<p class="image-box"><img height="75" src="../product_images/'+productId+'.jpg" /></p>';
	itemHtml += '	<p class="title">'+name+'</p>';
	itemHtml += '	<p class="price">'+price.replace("指导价格：","").replace("RMB","￥")+'</p>';
	itemHtml += '	<p class="buy_btn"><a id="data_fixed_wishing_btn_buy_'+productId+'"  href="../'+"<?=$module?>"+'/detail.php?id='+productId+'" target="_blank">立刻购买</a></p>';
	itemHtml += '	<p id="data_fixed_wishing_btn_delete_'+productId+'" class="btn_delete"></p>';
	itemHtml += '</li>';

	$("#mc_container .ws_box .tab_contents .wishing>ul").append(itemHtml);
	
	// setTimeout(function(){
		$("#mc_container .ws_box .tab_contents .wishing .btn_delete").unbind();
		$("#mc_container .ws_box .tab_contents .wishing .btn_delete").click(function(){
			removeFromWishingList($(this).parent().attr("product"));
		});
	// }, 500);

	if ($("#mc_container .ws_box .tab_contents .wishing li.item").length > 0) {
		$("#mc_container .ws_box .tabs ul .wishing span").text("我的心愿单 ( "+$("#mc_container .ws_box .tab_contents .wishing>ul li.item").length+"/15 )");
	} else {
		$("#mc_container .ws_box .tabs ul .wishing span").text("我的心愿单");
	}
	updateFooterPos();
	updateShareId();
}

//share
var hideShareBox2 = true;
$("#mc_container .ws_box .tab_contents .wishing .share_btn").hover(function(){
	hideShareBox2 = false;
	$("#mc_container .ws_box .tab_contents .wishing .share_box").show();
}, function(){
	hideShareBox2 = true;
	var self = this;
	setTimeout(function(){
		if(hideShareBox2) {
			$("#mc_container .ws_box .tab_contents .wishing .share_box").hide();
		}
	}, 200);
});
$("#mc_container .ws_box .tab_contents .wishing .share_box").hover(function(){
	hideShareBox2 = false;
}, function(){
	hideShareBox2 = true;
	var self = this;
	setTimeout(function(){
		if(hideShareBox2) {
			$(self).hide();
		}
	}, 200);
});

<?php if ($product['editor_comment_score'] > 0) { ?>
showEditorGrade(<?=$product['editor_comment_score']; ?>);
<?php } ?>

</script>
<?php include_once __DIR__.'/../common/cmp_wishing_box_js.php'; ?>

<script type="text/javascript">
$("#data_detail_summary_btn_buy").click(function(){
	try {
		var param = {
			type: "event", 
			action: "purchase",
			value: "<?=$pconlineId?>"
		}
		MLTracker.track(param);
	} catch(err) {

	}
});
$("#data_detail_summary_btn_jd").click(function(){
	try {
		var param = {
			type: "event", 
			action: "purchase_channel",
			value: "京东"
		}
		MLTracker.track(param);
	} catch(err) {

	}
});
$("#data_detail_summary_btn_suning").click(function(){
	try {
		var param = {
			type: "event", 
			action: "purchase_channel",
			value: "苏宁"
		}
		MLTracker.track(param);
	} catch(err) {

	}
});
</script>
</body>
</html>