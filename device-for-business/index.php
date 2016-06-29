<?php
require_once __DIR__.'/../webconfig.php';
include_once __DIR__.'/../common/request_processor_refresh.php';
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
<link rel="stylesheet" href="../common/resource/css/b_css.css" type="text/css" />
<script src="../common/resource/js/jquery-1.7.2.min.js"></script>
<script src="../common/resource/js/b_js.js"></script>

</head>
<body>
<?php include_once __DIR__.'/../common/header_device.php'; ?>

<div id="mc_container">
		<div id="b_header">
		<img src="<?=$basePath;?>../common/resource/images/banner_refresh.jpg" alt="" style="display: block;">
		<div id="b_nav" class="w1168">
			<ul class="clearfix">
				<li category="business">
					<a href="javascript:void(0)">
					高端商务
					</a>
				</li>
				<li category="stationary">
				<a href="javascript:void(0)">
					固定办公
					</a>
				</li>
				<li category="customer">
				<a href="javascript:void(0)">
					柜台/客服
					</a>
				</li>
				<li category="engineering">
				<a href="javascript:void(0)">
					研发设计
					</a>
				</li>
				<li category="remote">
				<a href="javascript:void(0)">
					高效移动
					</a>
				</li>
			</ul>
		</div>

	</div>
	<div class="main">

<div id="ajax-content">
	<div id="b_content">
		<?php include_once __DIR__.'/../common/search_block_refresh.php'; ?>
		<div class="b_con_2 w1168">
			<?php if (!empty($products)) {  ?>
			<ul id="b_con_2_ul">
				<?php	foreach ($products as $p) { ?>
				<li category="<?php if ($p['m_usage'] == 'Customer Service Workers') {
					echo 'customer';
				}elseif ($p['m_usage'] == 'R&D Engineering workers'){
					echo 'engineering';
				}elseif ($p['m_usage'] == 'Business Executives&Directors'){
					echo 'business';
				}elseif ($p['m_usage'] == 'Remote Workers with in office w'){
					echo 'remote';
				}elseif ($p['m_usage'] == 'Stationary workers'){
					echo 'stationary';
				}?>" name="<?=htmlspecialchars(preg_replace('/\(.*?\)/', '', $p['name'])); ?>">
					<div class="b_con_2_goods">
						<a href="../<?php if($p['tableName'] == 'allin1'){echo 'aio';}else{echo $p['tableName'];} ?>/detail.php?id=<?=$p['pconline_id'];?>" target="_blank"><img src="../product_images/<?=$p['cover_image']?>" alt="<?=htmlspecialchars($p['name']); ?>"></a>
					</div>
					<p class="clearfix">
						<span class="left">
							<a href="../<?php if($p['tableName'] == 'allin1'){echo 'aio';}else{echo $p['tableName'];} ?>/detail.php?id=<?=$p['pconline_id'];?>" target="_blank"><?=htmlspecialchars(preg_replace('/\(.*?\)/', '', $p['name'])); ?></a>
						</span>
						<img src="<?=$basePath;?>../common/resource/images/<?php 
							if ($p['tableName'] == 'desktop'){
								echo 'sign_4';
							}elseif ($p['tableName'] == '2in1'){
								echo 'sign_2';
							}elseif ($p['tableName'] == 'laptop'){
								echo 'sign_1';
							}elseif ($p['tableName'] == 'allin1'){
								echo 'sign_5';
							}elseif ($p['tableName'] == 'tablet'){
								echo 'sign_3';
							}
						?>.png" alt="" class="left b_con_2_sign">
					</p>
					<div class="b_con_2_info">
						<p>
							<?php 
								$product_name = $p['cpu_type'];
								if ($product_name == '酷睿M') {
									echo '第六代智能英特尔®酷睿™m处理器';
								}elseif ($product_name == '第六代酷睿i5'){
									echo '第六代智能英特尔®酷睿™i5处理器';
								}elseif ($product_name == '第六代酷睿i7'){
									echo '第六代智能英特尔®酷睿™i7处理器';
								}elseif ($product_name == '第六代酷睿i3'){
									echo '第六代智能英特尔®酷睿™i3处理器';
								}else {
									echo '第六代智能英特尔®酷睿™i7处理器';
								}
							?>
						</p>
						<ol>
							<?php 
							if (($p['tableName'] !== 'desktop')&&($p['tableName'] !== 'allin1')){
									if (($p['screen_size'] !== "0")&&($p['screen_size'] !== null)) {
										echo '<li>屏幕尺寸：' . $p['screen_size'] . '英寸</li>';
									}
								}
							?>
							<?php 
							if ($p['tableName'] == '2in1'){
									if (($p['screen_radio'] !== "0")&&($p['screen_radio'] !== null)) {
										echo '<li>分辨率：' . $p['screen_radio']. '</li>';
									}
								}elseif ($p['tableName'] == 'laptop'){
									if (($p['screen_ratio'] !== "0")&&($p['screen_ratio'] !== null)) {
										echo '<li>分辨率：' . $p['screen_ratio']. '</li>';
									}
								}elseif ($p['tableName'] == 'allin1'){
									if (($p['screen_ratio'] !== "0")&&($p['screen_ratio'] !== null)) {
										echo '<li>分辨率：' . $p['screen_ratio']. '</li>';
									}
								}elseif ($p['tableName'] == 'tablet'){
									if (($p['screen_ratio'] !== "0")&&($p['screen_ratio'] !== null)) {
										echo '<li>分辨率：' . $p['screen_ratio']. '</li>';
									}
								}
							?>
							<?php 
							if ($p['mem_daxiao'] !== null || $p['memory_size'] !== null || $p['mem_rongliang'] !== null) {
								echo '<li>内存容量：';
								if ($p['tableName'] == 'desktop'){
									echo $p['mem_daxiao'];
								}elseif ($p['tableName'] == '2in1'){
									echo $p['memory_size'];
								}elseif ($p['tableName'] == 'laptop'){
									echo $p['mem_rongliang'];
								}elseif ($p['tableName'] == 'allin1'){
									echo $p['mem_rongliang'];
								}elseif ($p['tableName'] == 'tablet'){
									echo $p['mem_rongliang'];
								}
								echo 'GB</li>';
							}
							?>
							
							<?php 
								if ($p['tableName'] !== 'allin1') {
									if (($p['disk_size'] !== "0")&&($p['disk_size'] !== null)) {
									echo '<li>硬盘容量：'.($p['disk_size'] ==null ? $p['harddisc_size']:$p['disk_size']).'GB</li>';
									}
								}
							?>
							<?php 
							if ($p['tableName'] == '2in1'){
									if (($p['jixiang_weight'] !== "0")&&($p['jixiang_weight'] !== null)) {
										echo '<li>重量：约' . $p['jixiang_weight']. 'kg</li>';
									}
								}elseif ($p['tableName'] == 'laptop'){
									if (($p['weight'] !== "0")&&($p['weight'] !== null)) {
										echo '<li>重量：约' . $p['weight']. 'kg</li>';
									}
								}
							?>
							<?php 
							if ($p['tableName'] == '2in1'){
									if (($p['thickness'] !== "0")&&($p['thickness'] !== null)) {
										echo '<li>厚度：'.$p['thickness'].'mm</li>';
									}
								}elseif ($p['tableName'] == 'laptop'){
									if (($p['thickness'] !== "0")&&($p['thickness'] !== null)) {
										echo '<li>厚度：'.$p['thickness'].'mm</li>';
									}
								}
							?>
							<?php 
								if ($p['tableName'] !== 'desktop') {
									if (($p['xianka_chip'] !== "0")&&($p['xianka_chip'] !== null)) {
										echo '<li>显卡芯片：'.$p['xianka_chip'].'</li>';
									}
								}
							?>
							<?php 
							if ($p['tableName'] == '2in1'){
								if (($p['xianka_rongliang'] !== "0")&&($p['xianka_rongliang'] !== null)) {
										echo '<li>显存容量：' . $p['xianka_rongliang']. '</li>';
									}
								}elseif ($p['tableName'] == 'laptop'){
									if (($p['xiancun_rongliang'] !== "0")&&($p['xiancun_rongliang'] !== null)) {
										echo '<li>显存容量：' . $p['xiancun_rongliang']. '</li>';
									}
								}
							?>
						</ol>
						<p class="b_con_2_price">
							指导价格： <?=($p['price'] == 0 || $p['price'] == null  || $p['price'] == 'null') ? '暂无报价' : 'RMB '.$p['price']; ?>
						</p>
						<a href="../<?php if($p['tableName'] == 'allin1'){echo 'aio';}else{echo $p['tableName'];} ?>/detail.php?id=<?=$p['pconline_id'];?>" target="_blank">了解详情</a>
					</div>
				</li>
				<?php } ?>
			</ul>
			<?php } ?>
		</div>
	</div>
	

</div>
	</div>
	<div class="clear"></div>
</div>
<?php include_once __DIR__.'/../common/footer.php'; ?>
</body>
</html>
<script>
	$(function () {
		// $('.b_con_2 ul#b_con_2_ul>li:nth-child(1),.b_con_2 ul#b_con_2_ul>li:nth-child(2),.b_con_2 ul#b_con_2_ul>li:nth-child(3)').css('margin-top','0');
		
		onload_fun();
		function onload_fun(){
			for (var i=0;i<$('#b_con_2_ul> li').length;i++) {
				var con_li=$('#b_con_2_ul> li').eq(i);
// 				if (con_li.attr("category")=='gdsw')
// 				{
					con_li.css('display','block');

// 				}
			}
			con_2_fun('1');

		}
		function con_2_fun(num){
	
		var count_=0;
		var max_h=0;
		
		$('.b_con_2 ul >li').each(function(){
			
			if (num=='1') {
				$(this).find('ol').css('height','auto');
				$(this).find('ol').css('min-height','auto');
			}
			else{
				$(this).find('ol').css('min-height','216px');
				
			}
			
			if ($(this).css('display')=='block') {
				count_++;
			
				if (count_<=3) {
					$(this).css('margin-top','0');

				}
				else{
					$(this).css('margin-top','100px');
				}
				
				var ol_=$(this).find('ol');
				var sign_=$(this).find('.b_con_2_sign');
				var span_l=$(this).find('span.left');
				var span_l_p=span_l.parent('p');
				if (ol_.height()>max_h) {
					max_h=ol_.height();
				}

			// console.log(span_l.text());
			var t=	span_l.text().split('\n').length;
			if (t>=2) {
				span_l_p.css({'position':'relative','top':'-9px'});
				span_l.css('width','290px');
			}
			else{
				span_l.width('auto');
				sign_.css('margin-left','16px');

			}

			var span_l_w=span_l.text().length;

			if (span_l_w<33) {
				span_l.width('auto');
				sign_.css('margin-left','16px');
				var w_=span_l.width()+span_l.siblings().width()+16;

				if (w_<290) {
					span_l_p.width(w_+'px');
					span_l_p.css({'left':'50%','margin-left':'-'+(w_/2+30)+'px'});
				}

			}
		}
		
	})
		$('.b_con_2 ul li ol').height(max_h);
	}

		// 导航

		
		$('#b_nav ul li').click(function(){
			$(this).addClass('b_nav_checked').siblings().removeClass('b_nav_checked');
			var nav_=$(this).attr("category");

			for (var i=0;i<$('#b_con_2_ul> li').length;i++) {
				var con_li=$('#b_con_2_ul >li').eq(i);
				console.log(con_li.attr("category"));
				if (con_li.attr("category")==nav_)
				{
					con_li.css('display','block');

				}
				else{
					con_li.css('display','none');
				}
			}
			con_2_fun('1');

		})
		$('.b_con_1 div.right').click(function(){
			$('#b_nav ul li').removeClass('b_nav_checked');
			$('#b_con_2_ul >li').css('display','block');
		
				con_2_fun('0');
		})

	});
</script>
