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

$page = intval(getParam('page', 1));
$page = $page < 1 ? 1 : $page;
$begin = ($page - 1)*10;

$products = $db->fetchAll("select * from products_2in1 where {$where} order by {$types[$type]} {$order} limit {$begin},10");
$total = $db->fetchOne("select count(*) from products_2in1 where {$where}");

$data = array("success"=>1);
$productsHtml = "";
foreach($products as $p) {
	$productPrice = $p['price'] == 0 ? '暂无报价' : "￥{$p['price']}元";
	$productsHtml .= <<<EOF
			<li class="itemList proList" onclick="showDetail('{$p['purchase_link']}',8)">
				<div class="itemImgWrap">
					<img width="120" src="../../product_images/{$p['extra1']}.jpg" />
					<p class="proPrice">{$productPrice}</p>
					<p class="btn_buy">
						<span><em>立即购买</em><i class="iconBox rightArrowIcon"></i></span>
					</p>
				</div>
				<div class="itemInfoWrap">
					<p class="item-ttl">
						<span class="itemName">{$p['brand_name']}</span>
						
					</p>
					<p class="proSeries">{$p['name']}</p>
					<!--p class="proMark">超极本</p-->		
					<p class="itemParam"><span class="leftSpan">处理器：</span>{$p['cpu']} </p>
					<p class="itemParam"><span class="leftSpan">产品形态：</span>{$p['form_factor']} </p>
					<p class="itemParam"><span class="leftSpan">屏幕尺寸：</span>{$p['screen_size']}英寸 </p>
				</div>
			</li>
EOF;
}
$data['productsHtml'] = $productsHtml;

if ($begin + 10 >= $total) {
	$data['nextpage'] = 0;
	$data['pagerHtml'] = $total . "/" . $total;
} else {
	$data['nextpage'] = $page+1;
	$data['pagerHtml'] = $page*10 . "/" . $total;
}
exit(json_encode($data));
