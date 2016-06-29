<div class="ws_box <?=!empty($_COOKIE['eshop_cmp_ids']) ? 'tab_cmp' : (!empty($_COOKIE['eshop_wishing_ids']) ? 'tab_wishing' : 'hide'); ?>">
		<div class="tabs">
			<ul>
				<li id="data_fixed_comparison_tab" class="cmp"><span>产品比较</span><em></em></li>
				<li id="data_fixed_wishing_tab" class="wishing"><span>我的心愿单</span><em id="data_fixed_expand"></em></li>
			</ul>
		</div>
		<div class="tab_contents">
			<div class="cmp">
				<ul>
					<?php
					$cookieCmpIds = !empty($_COOKIE['eshop_cmp_ids']) ? $_COOKIE['eshop_cmp_ids'] : '';
					$cookieCmpIds = explode(",", $cookieCmpIds);
					$cmpProductIds = array();
					foreach ($cookieCmpIds as $cmpId) {
						if (empty($cmpId) || $cmpId=="") {
							continue;
						}
						$cmpProductIds[] = $cmpId;
					}
					if (!empty($cmpProductIds)) {
						$rows = $db->fetchAll("select * from products_all where pconline_id in ('".implode("','", $cmpProductIds)."')");
						$rowsMap = array();
						foreach ($rows as $row) {
							if (in_array($row['pconline_id'], $doubleData) && $row['type'] != "products_2in1") {
								continue;
							}
							$rowsMap[$row['pconline_id']] = $row;
						}
						$cmpProducts = array();
						foreach ($cmpProductIds as $cmpId) {
							if (!empty($rowsMap[$cmpId])) {
								$cmpProducts[] = $rowsMap[$cmpId];
							}
						}

						foreach ($cmpProducts as $cmpp) {
					?>
					<li class="item" product="<?=$cmpp['pconline_id'];?>">
						<p class="image-box"><img width="80" src="../product_images/<?=$cmpp['pconline_id'];?>.jpg" /></p>
						<p class="brand"><?=empty($cmpp['brand']) ? '英特尔' : $cmpp['brand'];?></p>
						<p class="title"><?=str_replace($cmpp['brand'], "", $cmpp['name']); ?></p>
						<p class="price"><?=empty($cmpp['price']) ? '暂无报价' : '￥'.$cmpp['price'];?></p>
						<p class="buy_btn"><a id="data_fixed_comparison_btn_buy_<?=$cmpp['pconline_id'];?>" href="../<?=$tableToModuleMap[$cmpp['type']];?>/detail.php?id=<?=$cmpp['pconline_id'];?>" target="_blank">立刻购买</a></p>
						<p id="data_fixed_comparison_btn_delete_<?=$cmpp['pconline_id'];?>" class="btn_delete"></p>
					</li>
					<?php }} ?>

					<?php if (empty($cmpProducts) || count($cmpProducts) < 4) { ?>
					<li id="data_fixed_comparison_btn_add" class="add"></li>
					<?php } ?>
					<li class="options">
						<a id="data_fixed_comparison_btn_compare" class="btn_cmp" href="../compare">立即对比</a>
						<a id="data_fixed_comparison_btn_clear" class="clear_all" href="javascript: void 0;">清空产品</a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="wishing">
				<ul>
					<?php
					$cookieWishingIds = !empty($_COOKIE['eshop_wishing_ids']) ? $_COOKIE['eshop_wishing_ids'] : '';
					$cookieWishingIds = explode(",", $cookieWishingIds);
					$wishingProductIds = array();
					foreach ($cookieWishingIds as $wId) {
						if (empty($wId) || $wId=="") {
							continue;
						}
						$wishingProductIds[] = $wId;
					}
					if (!empty($wishingProductIds)) {
						$rows = $db->fetchAll("select * from products_all where pconline_id in ('".implode("','", $wishingProductIds)."')");
						$rowsMap = array();
						foreach ($rows as $row) {
							if (in_array($row['pconline_id'], $doubleData) && $row['type'] != "products_2in1") {
								continue;
							}
							$rowsMap[$row['pconline_id']] = $row;
						}
						$wishingProducts = array();
						foreach ($wishingProductIds as $wId) {
							if (!empty($rowsMap[$wId])) {
								$wishingProducts[] = $rowsMap[$wId];
							}
						}

						foreach ($wishingProducts as $wp) {
					?>
					<li class="item" product="<?=$wp['pconline_id']?>">
						<p class="image-box"><img height="75" src="../product_images/<?=$wp['pconline_id']?>.jpg" /></p>
						<p class="title"><?=$wp['name']; ?></p>
						<p class="price"><?=empty($wp['price']) ? '暂无报价' : '￥'.$wp['price'];?></p>
						<p class="buy_btn"><a id="data_fixed_wishing_btn_buy_<?=$wp['pconline_id'];?>" href="../<?=$tableToModuleMap[$wp['type']];?>/detail.php?id=<?=$wp['pconline_id'];?>" target="_blank">立刻购买</a></p>
						<p id="data_fixed_wishing_btn_delete_<?=$wp['pconline_id'];?>" class="btn_delete"></p>
					</li>
					<?php }} ?>
				</ul>
				<div class="share_btn"></div>
				<div class="share_box">
					<ul>
						<li class="title">分享您的心愿单</li>
						<li class="share_item sina"><a idbase="data_fixed_share_weibo" href="#">新浪微博</a></li>
						<li class="share_item sohu"><a idbase="data_fixed_share_sohu" href="#">搜狐微博</a></li>
						<li class="share_item qzone"><a idbase="data_fixed_share_qq" href="#">QQ空间</a></li>
						<li class="share_item kaixin"><a idbase="data_fixed_share_kaixin" href="#">开心网</a></li>
						<li class="share_item renren"><a idbase="data_fixed_share_renren" href="#">人人网</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>