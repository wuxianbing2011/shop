<?php
//print_r($_COOKIE['eshop_group_ids']);exit;
require_once __DIR__.'/../webconfig.php';
require_once __DIR__.'/../libs/pager.php';

require_once __DIR__.'/../data/static_data_cmp.php';
require_once __DIR__.'/../data/static_data_detail.php';

$cookieModule = !empty($_COOKIE['eshop_module']) ? $_COOKIE['eshop_module'] : (!empty($_GET['m']) ? $_GET['m'] : '');
$cookieCmpIds = !empty($_COOKIE['eshop_cmp_ids']) ? $_COOKIE['eshop_cmp_ids'] : (!empty($_GET['product']) ? $_GET['product'] : '');

if (empty($cookieModule)) {
	$cookieModule = "";
}
$cmpProducts = array();

$cookieCmpIds = explode(",", $cookieCmpIds);
$cmpProductIds = array();
foreach ($cookieCmpIds as $cmpId) {
	if (empty($cmpId) || $cmpId=="") {
		continue;
	}
	$cmpProductIds[] = $cmpId;
}
if (!empty($cmpProductIds)) {
	$rows = $db->fetchAll("select * from {$moduleToTableMap{$cookieModule}} where pconline_id in ('".implode("','", $cmpProductIds)."')");
	$rowsMap = array();
	$pids1 = array();
	foreach ($rows as $row) {
		$pids1[] = $row['pconline_id'];
		$rowsMap[$row['pconline_id']] = $row;
		$rowsMap[$row['pconline_id']]['type'] = $cookieModule;
	}
	if ($cookieModule == '2in1' && count($pids1) != count($cmpProductIds)) {
		$rows = $db->fetchAll("select * from products_laptop where pconline_id in ('".implode("','", array_diff($cmpProductIds, $pids1))."')");
		foreach ($rows as $row) {
			$rowsMap[$row['pconline_id']] = $row;
			$rowsMap[$row['pconline_id']]['type'] = 'laptop';
		}
	}
	
	foreach ($cmpProductIds as $cmpId) {
		if (!empty($rowsMap[$cmpId])) {
			$cmpProducts[] = $rowsMap[$cmpId];
		}
	}

	$sameParams = array();
	$paramMap = $fieldMap[$cookieModule]['paramDetailFields'];
	$groupIndex=0;
	foreach ($paramMap as $group) {
		foreach ($group['items'] as $paramItem) {
			$isSame = true;
			$lastValue = false;
		 	foreach ($cmpProducts as $cp) { 
		 		$field = $paramItem['field'];
		 		if ($cookieModule == '2in1' && $cp['type'] == 'laptop') {
		 			$field = $TwoInOneTolaptopFieldMap[$field];
		 		}
		 		if ($lastValue === false) {
		 			$lastValue = trim($cp[$field]);
		 		} elseif ($cp[$field] == ""){
		 			$isSame = false;
		 			break;
		 		} else {
		 			if(trim($cp[$field]) != $lastValue) {
		 				$isSame = false;
		 				break;
		 			}
		 		}
		 	}
		 	if ($isSame) {
		 		$sameParams[] = $group['group_name']."_".$paramItem['name'];
		 	}
		}
	}
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
<title>英特尔® 平板电脑、笔记本电脑、智能手机、和处理器</title>
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


#mc_container .hot{width: 960px; margin: 0 auto; position: relative;height: 169px; overflow: hidden;}
#mc_container .hot .item-list {position: relative; height: 169px;overflow: hidden;}
#mc_container .hot .item-list ul li{width: 960px; height: 169px; float: left;}
#mc_container .hot .item-list ul li .image-box{margin-top: -19px;}
#mc_container .hot .nav-btns a{display: block; width: 34px;height: 171px;position: absolute;top: 50%;margin-top: -85px;}
#mc_container .hot .nav-btns a.btn-prev{background: #fff; left: 0;}
#mc_container .hot .nav-btns a.btn-next{background: #fff;; right: 0;}
#mc_container .hot .kv-nav {position: absolute;bottom: 3px; right: 34px; width: 66px; height: 32px; background: url(../common/resource/images/search_kv_nav.png) no-repeat;}
#mc_container .hot .kv-nav a{display: inline-block; width: 30px;height: 30px;cursor: pointer;}
#mc_container .hot .kv-nav a.prev{margin-right: 2px;}

#mc_container .main .basic_info{position: relative;}
#mc_container .main .basic_info table.layout td.head{width: 120px; color: #006fc8; font-size: 18px; vertical-align: middle; font-weight: bold;}
#mc_container .main .basic_info table.layout td.head span{padding-left: 15px;}
#mc_container .main .basic_info ul.info1, #mc_container .main .basic_info ul.info3 {padding: 0px 0px 0px 12px;}
#mc_container .main .basic_info ul.info1 li,#mc_container .main .basic_info ul.info3 li {position: relative; display: inline-block; width: 190px; height: 160px; overflow: hidden; margin: 0px 9px 0px 0px;padding: 0px;}
#mc_container .main .basic_info ul.info1 li p.image-box{padding-top: 10px; text-align: center;height: 75px;overflow: hidden;}
#mc_container .main .basic_info ul.info1 li p.title{padding-top:15px; line-height: 20px;height: 20px;width: 190px; overflow: hidden;color: #0071c5; text-align: center;}
#mc_container .main .basic_info ul.info1 li p.price{padding:10px 0px 5px 0px; line-height: 20px;height: 20px;width: 190px; overflow: hidden;color: #69d6ff; text-align: center;}
#mc_container .main .basic_info ul.info1 li p.buy_btn{height:30px; text-align: center; padding-top: 5px;}
#mc_container .main .basic_info ul.info1 li p.buy_btn a{line-height: 30px;height: 30px; display: inline-block;width: 112px;background: #00adef;color: white;text-align: center;}
#mc_container .main .basic_info ul.info1 li p.btn_delete{position: absolute; top:0px;right: 0px;width: 20px;height: 20px;background: url(../common/resource/images/btn_delete.jpg) no-repeat right top;cursor: pointer;}
#mc_container .main .basic_info ul.info1 li.add {background: url(../common/resource/images/cmp_add_bg.jpg) no-repeat 40% 20%; cursor: pointer;}

#mc_container .main .basic_info table.layout table td{height: 18px; line-height: 18px; padding-top: 6px; font-size: 12px; color: #999;vertical-align: top;}
#mc_container .main .basic_info table.layout table td.icon{width: 20px; padding-top: 7px;}
#mc_container .main .basic_info table.layout table td.icon img{cursor: pointer;}
#mc_container .main .basic_info table.layout table td.title{width: 75px;}
#mc_container .main .basic_info table.layout table td.content{width: 192px;padding-right: 5px;word-break:break-all;text-align: center;}
#mc_container .main .basic_info table.layout table td.content.first{width: 125px;text-align: left;}
#mc_container .main .basic_info table.layout table td.tail{width: 0px;}

#mc_container .main .basic_info ul.info3 li {height: 50px;padding-top: 40px;padding-bottom: 20px;}
#mc_container .main .basic_info ul.info3 li p.buy_btn {text-align: center;}
#mc_container .main .basic_info ul.info3 li p.buy_btn a{line-height: 30px;height: 30px; display: inline-block;width: 112px;background: #00adef;color: white;text-align: center;}
#mc_container .main .basic_info ul.info3 li p.btn_wishing{text-align: center;padding-top: 10px;}
#mc_container .main .basic_info ul.info3 li p.btn_wishing a{display: inline-block;border: 1px solid #fdb810;height: 20px;}

#mc_container .main .param_group{padding: 20px 0px 0px 0px;}
#mc_container .main .param_group h1{color: #006fc8;font-size: 18px;font-weight: bold; position: relative;height: 40px; line-height: 40px; border-bottom: 1px solid #999;}
#mc_container .main .param_group h1 span{padding-left: 15px;}
#mc_container .main .param_group h1 em{position: absolute;top: 2px;height: 34px;width: 34px;right: 5px;cursor: pointer; background: url(../common/resource/images/param_group_open.jpg);}
#mc_container .main .param_group.close h1 em{background: url(../common/resource/images/param_group_close.jpg);}
#mc_container .main .param_group.close table{display: none;}
#mc_container .main .param_group table{margin: 20px 0px 0px 0px;}
#mc_container .main .param_group table tr:hover{background: #fafafa;}
#mc_container .main .param_group table tr th{text-align: left; vertical-align: top; width: 115px; height: 32px;padding: 6px 10px 6px 15px; line-height: 20px;color: #666;font-weight: normal;word-break: break-all;font-size: 14px;}
#mc_container .main .param_group table tr td{text-align: center; vertical-align: top; width: 190px;word-break: break-all;padding: 6px 15px 6px 5px;font-size: 14px; color: #999; line-height: 20px;}
#mc_container .main .param_group table tr td.tail{width: auto;}
#mc_container .main .param_group table tr.same td{color: #006fc8;}

#mc_container .main .choose_more {padding: 20px;text-align: right;}
#mc_container .main .choose_more a{display: inline-block; width: 160px; height: 36px; background: url(../common/resource/images/choose_more.jpg);}

#mc_container .main .basic_info .cmp_result_share_icon{position: absolute;top: 0px; z-index: 9999; right: -20px;width: 38px; height: 86px;background: url(../common/resource/images/cmp_result_share_icon.jpg) no-repeat;}
#mc_container .main .basic_info .cmp_result_share_box{display: none; position: absolute;top: 0px; z-index: 9999; right: -133px;width: 112px;border:1px solid #0873c9; border-top: none;}
#mc_container .main .basic_info .cmp_result_share_box p {padding: 5px 5px 0px 5px;background: #f2f2f2;color: #333;line-height: 18px;font-size: 12px;}
#mc_container .main .basic_info .cmp_result_share_box ul{overflow: hidden; padding: 0px; margin: 0px; height: auto; padding-top: 5px; padding-bottom: 10px;}
#mc_container .main .basic_info .cmp_result_share_box ul li{display: block; height: 22px; line-height: 22px; padding: 0px;margin: 0px;}
#mc_container .main .basic_info .cmp_result_share_box ul li.title{padding-left: 5px;background: #0071c5; color: #fff; height: 28px; line-height: 28px; margin-bottom: 10px;}
#mc_container .main .basic_info .cmp_result_share_box ul li a{color: #0071c5; display: inline-block; padding-left: 42px;}
#mc_container .main .basic_info .cmp_result_share_box ul li.sina{background: url(../common/resource/images/share_icon_sina.png) no-repeat 13px center;}
#mc_container .main .basic_info .cmp_result_share_box ul li.sohu{background: url(../common/resource/images/share_icon_sohu.png) no-repeat 13px center;}
#mc_container .main .basic_info .cmp_result_share_box ul li.qzone{background: url(../common/resource/images/share_icon_qzone.png) no-repeat 13px center;}
#mc_container .main .basic_info .cmp_result_share_box ul li.kaixin{background: url(../common/resource/images/share_icon_kaixin.png) no-repeat 13px center;}
#mc_container .main .basic_info .cmp_result_share_box ul li.renren{background: url(../common/resource/images/share_icon_renren.png) no-repeat 13px center;}

#mc_container .main .basic_info .add_param {position: relative;height: 20px;}
#mc_container .main .basic_info .add_param a{display: block;position: absolute;top: 5px; left: 1px;z-index: 3; width: 13px; background: url(../common/resource/images/icon_add_param.jpg) no-repeat;}
#mc_container .main .basic_info .add_param .param_box{display: none; position: absolute; top: 5px; left: 13px;border: 1px solid #006fc8; background: #fff; z-index: 2; min-width: 80px; max-height: 150px; overflow: auto; padding: 10px 0px;}
#mc_container .main .basic_info .add_param .param_box li{color: #999; line-height: 24px; font-size: 12px;background: #fff;cursor: pointer; padding-left: 10px;}
#mc_container .main .basic_info .add_param .param_box li:hover{color: #fff;background: #4cc5f4;}

#mc_container .main .basic_info .info2 .extra .icon {padding-top: 13px;}
#mc_container .main .basic_info .info2 .extra .param_group {padding: 0px;}
#mc_container .main .basic_info .info2 .extra .param_group h1{font-size: 16px;height: 30px;line-height: 30px;}
#mc_container .main .basic_info .info2 .extra .param_group h1 em{display: none;}
#mc_container .main .basic_info .info2 .extra .param_group table th{width: 70px; padding: 6px 0px;}
#mc_container .main .basic_info .info2 .extra .param_group table tr td.col1{width: 140px;}
#mc_container .main .basic_info .info2 .extra .param_group table tr td{width: 200px;}
#mc_container .main .basic_info .info2 .extra .param_group table tr td.tail{width: auto;}

#mc_container .main .basic_info .add_param.open a {background: url(../common/resource/images/icon_add_param2.jpg) no-repeat;}
#mc_container .main .basic_info .add_param.open .param_box{display: block;}

#mc_container .main .product-box .header .count a {color: #868686;}
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
		<div class="product-box">
			<a id="product" name="product"></a>
			<div class="header">
				<span class="count"><a id="data_comparison_breadcrumb_1" href="../">首页</a> > <a id="data_comparison_breadcrumb_2" href="../<?=$cookieModule?>"><?=isset($moduleNames[$cookieModule]) ? $moduleNames[$cookieModule].'</a> > ' : '</a>'; ?>对比结果</span>
				<?php include_once __DIR__.'/../common/search_block.php'; ?>
				
			</div>
		</div>
		<div class="basic_info">
			<table class="layout" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="head"><span></span></td>
					<td>
						<div style="margin-left:-120px;background:white;">
						<div style="display:inline-block; width:120px; vertical-align:top;color: #006fc8; font-size: 18px; font-weight: bold; padding-top:97px;">&nbsp;&nbsp;产品信息</div>
						<ul class="info1" style="display:inline-block;">
							<?php foreach ($cmpProducts as $cp) { 
									$brandField = $brandFields[$cookieModule];
									$_module = $cookieModule;
									if ($cookieModule == '2in1' && $cp['type'] == 'laptop') {
										$brandField = $brandFields['laptop'];
										$_module = 'laptop';
									}
							?>
							<li class="product_<?=$cp['pconline_id']?>">
								<p class="image-box"><img height="75" src="../product_images/<?=$cp['pconline_id'];?>.jpg" /></p>
								<p class="title"><?=$cp['name']; ?><input type="hidden" class="brand" value="<?=isset($cp[$brandField]) ? $cp[$brandField] : '英特尔'; ?>" module="<?=$cp['type']?>" /></p>
								<p class="price">￥<?=$cp['price']; ?></p>
								<p id="data_comparison_btn_delete_<?=$cp['pconline_id'];?>" class="btn_delete" product="<?=$cp['pconline_id'];?>"></p>
								<p class="buy_btn"><a id="data_comparison_btn_buy_<?=$cp['pconline_id'];?>" href="../<?=$_module; ?>/detail.php?id=<?=$cp['pconline_id']; ?>" target="_blank">立刻购买</a></p>
							</li>
							<?php } ?>
							<?php if (count($cmpProducts) < 4) { ?>
							<li class="add">
							</li>
							<?php } ?>
						</ul>
						</div>
						<?php if ($cookieModule) { ?>
						<table class="info2" width="100%" cellpadding="0" cellspacing="0">
							<?php
							$simpleInfo = $simpleInfoMap[$cookieModule];
							if ($cookieModule == '2in1') {
								$simpleInfo2 = $simpleInfoMap['laptop'];
							}
							$cookieParamIds = isset($_COOKIE['eshop_param_ids']) ? $_COOKIE['eshop_param_ids'] : "";
							if ($cookieParamIds !== "") {
								$cookieParamIds = explode(",", $cookieParamIds);
							} else {
								$cookieParamIds = array();
							}
							$paramIndex = 0;
							for($ii=0;$ii<4;$ii++) {
							?>
							<tr class="basic" param="<?=$paramIndex;?>" <?=!empty($cookieParamIds) && in_array($paramIndex, $cookieParamIds) ? ' style="display:none"' : '';?>>
								<td class="icon"><img id="data_comparison_btn_delpara_<?=$paramIndex+1?>" src="../common/resource/images/icon_remove_param.jpg" /></td>
								<?php 
								$isFirst = true;
								foreach ($cmpProducts as $cp) { 
									$info = $cookieModule == '2in1' && $cp['type']=='laptop' ? $simpleInfo2[$ii] : $simpleInfo[$ii];
								?>
									<?php if($isFirst) { ?>
									<td class="title">·<?=$info['name']; ?></td>
									<?php } ?>
									<td class="content<?=$isFirst ? ' first' : ''; ?>">
										<?php if (is_array($info['field'])) { ?>
										<?=str_replace(array("#0", "#1"), array($cp[$info['field'][0]], $cp[$info['field'][1]]), $info['format']);?>
										<?php } else { ?>
										<?=str_replace("#0", $cp[$info['field']], $info['format']);?>
										<?php } ?>
									</td>
								<?php  $isFirst=false; } ?>
								<?php for($i=0; $i<4-count($cmpProducts); $i++) { ?>
									<td class="title">&nbsp;</td><td class="content">&nbsp;</td>
								<?php } ?>

								<td class="tail"></td>
							</tr>
							<?php $paramIndex++; } ?>
							<?php
							$cookieGids = isset($_COOKIE['eshop_group_ids']) ? $_COOKIE['eshop_group_ids'] : "";
							if ($cookieGids !== "") {
								$cookieGids = explode(",", $cookieGids);
							} else {
								$cookieGids = array();
							}
							//print_r($cookieGids);exit;
							if ($cookieModule){
							$paramMap = $fieldMap[$cookieModule]['paramDetailFields'];
							foreach ($cookieGids as $gid) {
								$group = $paramMap[intval($gid)];
							?>
							<tr class="extra" group="<?=$gid; ?>">
								<td class="icon"><img src="../common/resource/images/icon_remove_param.jpg" /></td>
								<td colspan="9">
									<div class="param_group added">
										<h1>
											<span><?=$group['group_name']; ?></span>
											<em></em>
										</h1>
										<table width="100%" cellpadding="0" cellspacing="0">
											<?php foreach ($group['items'] as $paramItem) { ?>
											<tr <?=in_array($group['group_name']."_".$paramItem['name'], $sameParams) ? ' class="same"' : '';?>>
												<th><?=$paramItem['name'];?></th>
												<?php
													$first = true;
												 	foreach ($cmpProducts as $cp) { 
												 		$field = $paramItem['field'];
												 		if ($cookieModule == '2in1' && $cp['type'] == 'laptop') {
												 			$field = $TwoInOneTolaptopFieldMap[$field];
												 		}
												?>
													<td<?=$first ? ' class="col1"' : '';?>><?=!empty($cp[$paramItem['field']]) ? str_replace("#0", $cp[$paramItem['field']], $paramItem['format']) : "&nbsp;";?></td>
												<?php $first=false; } ?>
												<?php for($i=0; $i<4-count($cmpProducts); $i++) { ?>
													<td>&nbsp;</td>
												<?php } ?>
												<td class="tail"></td>
											</tr>
											<?php } ?>
										</table>
									</div>
								</td>
							</tr>
							<?php }} ?>
						</table>

						<div class="add_param">
							<a href="#"><img src="../common/resource/images/transplant.png" /></a>
							<div class="param_box">
								<ul>
								<?php
									if($cookieModule) {
									$paramMap = $fieldMap[$cookieModule]['paramDetailFields'];
									$i=0;
									foreach ($paramMap as $group) {
								?>
									<li id="data_comparison_btn_addpara_<?=$group['group_name']; ?>" group="<?=$i;?>" <?=!empty($cookieGids) && in_array($i, $cookieGids) ? ' style="display:none;"' : ''; ?>><?=$group['group_name']; ?></li>
								<?php $i++; }} ?>
								</ul>
							</div>
						</div>
						<?php } ?>
					</td>
				</tr>
			</table>
			<?php if (!empty($cookieModule)) { ?>
			<div class="cmp_result_share_icon">
			</div>
			<div class="cmp_result_share_box">
				<p>把对比结果分享给好友</p>
				<ul>
					<li class="share_item sina"><a idbase="data_comparison_share_weibo" href="javascript: void 0;">新浪微博</a></li>
					<li class="share_item sohu"><a idbase="data_comparison_share_sohu" href="javascript: void 0;">搜狐微博</a></li>
					<li class="share_item qzone"><a idbase="data_comparison_share_qq" href="javascript: void 0;">QQ空间</a></li>
					<li class="share_item kaixin"><a idbase="data_comparison_share_kaixin" href="javascript: void 0;">开心网</a></li>
					<li class="share_item renren"><a idbase="data_comparison_share_renren" href="javascript: void 0;">人人网</a></li>
				</ul>
			</div>
			<?php } ?>
		</div>

		<div class="basic_info">
			<table class="layout" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="head"><span>&nbsp;</span></td>
					<td>
						<ul class="info3">
							<?php
							 	foreach ($cmpProducts as $cp) {
							 		$_m = $cookieModule;
							 		if ($cookieModule == '2in1' && $cp['type']=='laptop') {
							 			$_m = 'laptop';
							 		} 
							?>
							<li>
								<p class="buy_btn"><a id="data_comparison_btn_buy_<?=$cp['pconline_id'];?>" href="../<?=$_m; ?>/detail.php?id=<?=$cp['pconline_id']; ?>" target="_blank">立刻购买</a></p>
								<p class="btn_wishing" product="<?=$cp['pconline_id']?>"><a id="data_comparison_btn_addwishing_<?=$cp['pconline_id'];?>" href="javascript:void 0;"><img src="../common/resource/images/btn_add_wishing.png" /></a></p>
							</li>
							<?php } ?>
							<?php for($i=0; $i<4-count($cmpProducts); $i++) { ?>
							<li></li>
							<?php } ?>
						</ul>

					</td>
				</tr>
			</table>
		</div>

		<?php if (!empty($cookieModule)) { ?>
		<?php
		$paramMap = $fieldMap[$cookieModule]['paramDetailFields'];
		$groupIndex=0;
		foreach ($paramMap as $group) {
		?>
		<div class="param_group group_<?=$groupIndex;?>"  <?=!empty($cookieGids) && in_array($groupIndex, $cookieGids) ? ' style="display:none;"' : ''; ?>>
			<h1>
				<span><?=$group['group_name']; ?></span>
				<em id="data_comparison_btn_fold"></em>
			</h1>
			<table width="100%" cellpadding="0" cellspacing="0">
				<?php foreach ($group['items'] as $paramItem) { ?>
				<tr <?=in_array($group['group_name']."_".$paramItem['name'], $sameParams) ? ' class="same"' : '';?>>
					<th><?=$paramItem['name'];?></th>
					<?php
						$first = true;

					 	foreach ($cmpProducts as $cp) { 
					 		$field = $paramItem['field'];
					 		if ($cookieModule == '2in1' && $cp['type'] == 'laptop') {
					 			$field = $TwoInOneTolaptopFieldMap[$field];
					 		}
					?>
						<td<?=$first ? ' class="col1"' : '';?>><?=!empty($cp[$field]) ? str_replace("#0", $cp[$field], $paramItem['format']) : "--&nbsp;";?></td>
					<?php $first=false; } ?>
					<?php for($i=0; $i<4-count($cmpProducts); $i++) { ?>
						<td>&nbsp;</td>
					<?php } ?>
					<td class="tail"></td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<?php $groupIndex++; } ?>


		<div class="choose_more">
			<a id="data_comparison_btn_continue" href="../<?=$cookieModule; ?>#usage"><img width="160" height="36" src="../common/resource/images/transplant.png" /></a>
		</div>
		<?php } ?>
		
		<div class="hot">
			<div class="item-list">
				<ul>
					<li>
						<div class="image-box">
							<a href="http://sale.jd.com/act/vAP7En2IhGoOR4Mp.html" target="_blank"><img width="960" src="../common/resource/images/index_hot1.jpg" /></a>
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
	</div>
	<?php include_once __DIR__.'/../common/cmp_wishing_box.php';?>
	<?php include_once __DIR__.'/../common/disclaimer.php';?>
</div>
<?php include_once __DIR__.'/../common/footer.php'; ?>
<?php include_once __DIR__.'/../common/cmp_wishing_box_js.php'; ?>
<script type="text/javascript">
// $(document).ready(function(){
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

	var hideCmpShareBox = true;
	$("#mc_container .main .basic_info .cmp_result_share_icon").hover(function(){
		hideCmpShareBox = false;
		$("#mc_container .main .basic_info .cmp_result_share_box").show();
	}, function(){
		hideCmpShareBox = true;
		var self = this;
		setTimeout(function(){
			if(hideCmpShareBox) {
				$("#mc_container .main .basic_info .cmp_result_share_box").hide();
			}
		}, 200);
	});
	$("#mc_container .main .basic_info .cmp_result_share_box").hover(function(){
		hideCmpShareBox = false;
	}, function(){
		hideCmpShareBox = true;
		var self = this;
		setTimeout(function(){
			if(hideCmpShareBox) {
				$(self).hide();
			}
		}, 200);
	});


	$("#mc_container .main .basic_info .add_param a").click(function(){
		$("#mc_container .main .basic_info .add_param").toggleClass("open");
		return false;
	});

	$("#mc_container .main .basic_info .add_param .param_box li").click(function(){
		var groupIndex = $(this).attr("group");
		var groupId = "group_"+groupIndex;
		var groupHtml = $("#mc_container .main>."+groupId).html();

		groupHtml = '<tr class="extra" group="'+groupIndex+'"><td class="icon"><img src="../common/resource/images/icon_remove_param.jpg" /></td><td colspan="9"><div class="param_group added">' + groupHtml+'</div></td></tr>';
		$("#mc_container .main .basic_info .info2").append(groupHtml);
		$("#mc_container .main .basic_info .info2 .extra .icon img:last").click(function(){
			var gid = $(this).parent().parent().attr("group");
			var cookieGids = getCookie("eshop_group_ids");
			if (cookieGids) {
				cookieGids = cookieGids.split(",");
				var newGids = [];
				for(var i=0;i<cookieGids.length;i++) {
					if (cookieGids[i]!=gid) {
						newGids.push(gid);
					}
				}
				setCookie("eshop_group_ids", newGids.join(","));
			}
			$("#mc_container .main .basic_info .add_param .param_box li[group="+gid+"]").show();
			$(this).parent().parent().remove();
			$("#mc_container .main>.group_"+gid).show();
		});

		var cookieGids = getCookie("eshop_group_ids");
		if (!cookieGids) {
			cookieGids = [];
		} else {
			cookieGids = cookieGids.split(",");
		}
		if ($.inArray(groupIndex, cookieGids)==-1) {
			cookieGids.push(groupIndex);
		}
		setCookie("eshop_group_ids", cookieGids.join(","));
		$("#mc_container .main .basic_info .add_param .param_box li[group="+groupIndex+"]").hide();
		$("#mc_container .main .basic_info .add_param").removeClass("open");
		$("#mc_container .main>."+groupId).hide();
	});
	

	$("#mc_container .main .param_group h1 em").click(function(){
		$(this).parent().parent().toggleClass("close");
		if ($(this).hasClass("close")) {
			$(this).prop("id", "data_comparison_btn_expand");
		} else {
			$(this).prop("id", "data_comparison_btn_fold");
		}
	});

	$("#mc_container .main .basic_info .info2 .extra .icon img").click(function(){
		var gid = $(this).parent().parent().attr("group");
		var cookieGids = getCookie("eshop_group_ids");
		if (cookieGids) {
			cookieGids = cookieGids.split(",");
			var newGids = [];
			for(var i=0;i<cookieGids.length;i++) {
				if (cookieGids[i]!=gid) {
					newGids.push(gid);
				}
			}
			setCookie("eshop_group_ids", newGids.join(","));
		}
		$("#mc_container .main .basic_info .add_param .param_box li[group="+gid+"]").show();
		$(this).parent().parent().remove();
		$("#mc_container .main>.group_"+gid).show();
	});
	$("#mc_container .main .basic_info .info2 .basic .icon img").click(function(){
		var cookieParamIds = getCookie("eshop_param_ids");
		if (cookieParamIds) {
			cookieParamIds = cookieParamIds.split(",");
		} else {
			cookieParamIds = [];
		}
		var paramId = $(this).parent().parent().attr("param");
		if ($.inArray(paramId, cookieParamIds) == -1) {
			cookieParamIds.push(paramId);
		}
		setCookie("eshop_param_ids", cookieParamIds.join(","));
		$(this).parent().parent().hide();
	});
	$("#mc_container .main .basic_info ul.info1 li.add").click(function(){
		//new track code
		trackShopFilter('compare-page', "btn_add_product");
		window.location.href="../<?=$cookieModule; ?>#usage";
	});
	$("#mc_container .main .basic_info ul.info1 li p.btn_delete").click(function(){
		deleteCmpProduct($(this).attr("product"));
		removeFromCmpList($(this).attr("product"));
	});

	function deleteCmpProduct (productId) {
		var index = $("#mc_container .main .basic_info ul.info1 li p.btn_delete").index($("#mc_container .main .basic_info ul.info1 li p.btn_delete[product="+productId+"]"));
		$("#mc_container .main .basic_info ul.info1 li:eq("+index+")").remove();
		if ($("#mc_container .main .basic_info ul.info1 li.add").length == 0) {
			$("#mc_container .main .basic_info ul.info1").append('<li class="add"></li>');
			$("#mc_container .main .basic_info ul.info1 li.add").click(function(){
				trackShopFilter('compare-page', "btn_add_product");
				window.location.href="../<?=$cookieModule; ?>#usage";
			});
		} else {
			$("#mc_container .main .basic_info ul.info1").append("<li></li>");
		}

		$("#mc_container .main .basic_info .layout .info2 .basic").each(function(){
			$(this).find("td.title:eq("+index+")").remove();
			$(this).find("td.content:eq("+index+")").remove();
			$(this).find("td.tail").before("<td class='title'>&nbsp;</td><td class='content'>&nbsp;</td>");
		});
		

		$("#mc_container .main .basic_info ul.info3 li:eq("+index+")").remove();
		$("#mc_container .main .basic_info ul.info3").append("<li></li>");

		$("#mc_container .main .param_group table tr").each(function(){
			$(this).find("td:eq("+index+")").remove();
			$(this).find("td.tail").before("<td>&nbsp;</td>");
		});
		var cookieProductIds = getCookie("eshop_cmp_ids");
		if (cookieProductIds) {
			cookieProductIds = cookieProductIds.split(",");
		} else {
			cookieProductIds = [];
		}
		var newIds = [];
		for (var i=0;i<cookieProductIds.length;i++) {
			if (cookieProductIds[i] != productId) {
				newIds.push(cookieProductIds[i]);
			}
		}
		setCookie("eshop_cmp_ids", newIds.join(","));
		if (newIds.length == 0) {
			setCookie("eshop_module", "");
			setCookie("eshop_group_ids", "");
			setCookie("eshop_param_ids", "");
		}
		$("#mc_container .main .param_group table tr").each(function(){
			var isSame = true;
			var lastValue = false;
			$(this).find("td").each(function(){
				if($(this).hasClass("tail")) {
					return;
				}
				if ($(this).text() == " " || $(this).text()=="") {
					return;
				}
				if ($(this).text()=="-- "|| $(this).text()=="--") {
					isSame = false;
				}
				if (lastValue === false) {
					lastValue = $(this).text();
					return;
				}
				if (lastValue != $(this).text()) {
					isSame = false;
				}
			});
			if (isSame && !$(this).hasClass("same")) {
				$(this).addClass("same");
			}
		});
	}

	//add to wishing list
	$("#mc_container .main .basic_info .info3 li .btn_wishing").click(function(){
		if ($("#mc_container .ws_box .tab_contents .wishing li.item").length >= 15) {
			openTip("最多只能添加15件心仪产品");
			return false;
		} else {
			addToWishingList2($(this).attr("product"));
		}
	});
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
		var brand = $(".product_"+productId+" .brand").val();
		var name = $(".product_"+productId+" .title").text();
		var price = $(".product_"+productId+" .price").text();

		itemHtml += '<li class="item" product="'+productId+'">';
		itemHtml += '	<p class="image-box"><img height="75" src="../product_images/'+productId+'.jpg" /></p>';
		itemHtml += '	<p class="title">'+name+'</p>';
		itemHtml += '	<p class="price">'+price+'</p>';
		itemHtml += '	<p class="buy_btn"><a href="../'+$(".product_"+productId+" .brand").attr("module")+'/detail.php?id='+productId+'" target="_blank">立刻购买</a></p>';
		itemHtml += '	<p class="btn_delete"></p>';
		itemHtml += '</li>';

		$("#mc_container .ws_box .tab_contents .wishing>ul").append(itemHtml);
		
		setTimeout(function(){
			$("#mc_container .ws_box .tab_contents .wishing>ul .btn_delete").unbind();
			$("#mc_container .ws_box .tab_contents .wishing>ul .btn_delete").click(function(){
				removeFromWishingList($(this).parent().attr("product"));
			});
		}, 500);

		if ($("#mc_container .ws_box .tab_contents .wishing>ul li.item").length > 0) {
			$("#mc_container .ws_box .tabs ul .wishing span").text("我的心愿单 ( "+$("#mc_container .ws_box .tab_contents .wishing>ul li.item").length+"/15 )");
		} else {
			$("#mc_container .ws_box .tabs ul .wishing span").text("我的心愿单");
		}
	}
    //remove from cmp box
    $("#mc_container .ws_box .tab_contents .cmp .btn_delete").click(function(){
    	deleteCmpProduct($(this).parent().attr("product"));
    });

    //share
	var hideShareBox = true;
	$(".share").hover(function(){
		hideShareBox = false;
		$(this).parent().find("ul").show();
	}, function(){
		hideShareBox = true;
		var self = this;
		setTimeout(function(){
			if(hideShareBox) {
				$(self).parent().find("ul").hide();
			}
		}, 200);
	});
	$(".product-list .cover ul").hover(function(){
		hideShareBox = false;
	}, function(){
		hideShareBox = true;
		var self = this;
		setTimeout(function(){
			if(hideShareBox) {
				$(self).hide();
			}
		}, 200);
	});
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
	var info1_offset_top = $("#mc_container .main .basic_info .info1").offset().top - 66;
	//var info3_offset_btn_buy =;
	$(window).scroll(function(){
		if ($(window).scrollTop() >= info1_offset_top) {
			$("#mc_container .main .basic_info .info1").parent().css({"position":"fixed", "top":"66px", "width":"960px", "z-index":"9","border-bottom":"2px solid #006fc8"});
			$("#mc_container .main .basic_info .info1").find(".btn_delete").hide();
			$("#mc_container .main .basic_info .cmp_result_share_icon").css({"left":($(".info1").parent().offset().left+960-20)+"px", "position":"fixed", "right":"auto"});
			$("#mc_container .main .basic_info .cmp_result_share_box").css({"left":($(".info1").parent().offset().left+960-20+38)+"px", "position":"fixed", "right":"auto"});
			//
			setTimeout(function(){$("#mc_container .main .basic_info .info1").find(".btn_delete").show();}, 10);
			
		} else {
			$("#mc_container .main .basic_info .info1").parent().css({"position":"static","width":"auto","border-bottom":"none"});
			$("#mc_container .main .basic_info .cmp_result_share_icon").css({"left":"auto", "position":"absolute", "right":"-20px"});
			$("#mc_container .main .basic_info .cmp_result_share_box").css({"left":"auto", "position":"absolute", "right":"-133px"});
			//
		}
		if ($(window).scrollTop() >=  $("#mc_container .main .basic_info .info3 .btn_wishing").offset().top-40-160-66) {
			$("#mc_container .main .basic_info ul.info1 li").css("height","190px");
		} else {
			$("#mc_container .main .basic_info ul.info1 li").css("height","160px");
		}


	});
	$("#mc_container .ws_box").removeClass("tab_wishing");
	$("#mc_container .ws_box").removeClass("tab_cmp");
// });
</script>


</body>
</html>