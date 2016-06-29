<script src="../common/resource/js/scroller.js"></script>
<script>
$('.hot .switcher').click(function(){
	$('.hot').toggleClass('col');
	
	if($('.hot').hasClass('col')){
		bannerScroller.stop();
	}else{
		bannerScroller.replay();
	}
});

$('.hot h2 span').click(function(){
	$('.hot').toggleClass('col');
	
	if($('.hot').hasClass('col')){
		bannerScroller.stop();
	}else{
		bannerScroller.replay();
	}
});
<?php $hotProducts = isset($hotProducts) ? $hotProducts : array(); ?>
var bannerScroller = new Scroller({
	container: '.hot',
	inset: '.items-list ul',
	navBars: {
		prev: '.nav-btns .btn-prev',
		next: '.nav-btns .btn-next'
	},
	trigger: '.handle li',
	styles: null,
	contentWidth: 960*<?=intval(count($hotProducts)/2+0.5); ?>,
	containerWidth: 960,
	stepLength: 960,
	onchange: function(index){
		this.panel.find('.handle li').removeClass('active');
		this.panel.find('.handle li').eq(index).addClass('active');
		//new track code
		//trackShopFilter('heroproduct-switcher',$(this).prop("id")); 
	},
	autoplay:false
});


function initHtml() {
	$('.tags li').click(function(){
		if ($(this).hasClass("disable")) {
			return;
		}
		$(".tags li").removeClass('select');
		$(this).addClass('select');
		var tag = $(this).find("em").text();
		var link = "?usage=";
		loadProducts(link+encodeURIComponent(tag), 'usage');
	});
	$('.filter-box .btn-more').click(function(){
		if(!$(".filter-box").hasClass('col-all')){
			$(".filter-box").removeClass('col-one');
			$(".filter-box").addClass('col-all');
		}else{
			$(".filter-box").addClass('col-one');
			$(".filter-box").removeClass('col-all');
		}
		updateProState();

		//add new tracking code
		//trackShopFilter('filter-option',$(this).prop("id")); 
	});

	$('.filter-box .btn-close').click(function(){	
		$(".filter-box").removeClass('col-one');
		$(".filter-box").addClass('col-all');
		updateProState();
	});

	$('.filter-box .btn-options').click(function(){
		if(!$(".filter-box").hasClass('col-one')){
			$(".filter-box").addClass('col-one');
		}else{
			$(".filter-box").removeClass('col-one');
			$(".filter-box").removeClass('col-all');
		}
		updateProState();

		//add new tracking code
		//trackShopFilter('filter-option',$(this).find(".exp").prop("id")); 
	});

	$('.filter-box .lev-2 .btn_close').click(function(e){
		$(".filter-box").removeClass('col-one');
		$(".filter-box").addClass('col-all');
		updateProState();
		e.preventDefault();
	});

	$('.filter-box .lev-3 .btn_close').click(function(e){
		$(".filter-box").addClass('col-one');
		$(".filter-box").removeClass('col-all');
		updateProState();
		e.preventDefault();
	});
	
	//add new tracking code
	$("#mc_container .main .product-box .header .order").click(function(){
		 //trackShopFilter("filter-option",$(this).prop("id")+ ($(this).prop("href").indexOf("asc") > 0 ? ":asc" : ":desc"));
	});

	var optype=0;
	$('.filter-box .pro').click(function(){
		//add new tracking code
		if ($(this).hasClass("pro2")) {
			//trackShopFilter("filter-option",$(this).find("a").prop("id")+":show-less");
		} else {
			//trackShopFilter("filter-option",$(this).find("a").prop("id")+":show-more");
		}
		



		var anyFilterSelected = false;
		$(".lev-2 ul li").each(function(){
			$(this).find("a:gt(0)").each(function(){
				if ($(this).hasClass("active")) {
					anyFilterSelected = true;
				}
			});
			
		});
		$(".lev-3 ul li").each(function(){
			$(this).find("a:gt(0)").each(function(){
				if ($(this).hasClass("all")) {
					anyFilterSelected = true;
				}
			});
			
		});
		if ($(".lev-1 .tags li.select").length > 0) {
			anyFilterSelected = true;
		}
		var openType = 2;
		if (!$(".filter-box").hasClass("col-all") && !$(".filter-box").hasClass("col-one")) {
			openType = 1;
		} else if ($(".filter-box").hasClass("col-one")) {
			openType = 2;
		}
		if (anyFilterSelected) {
			loadProducts("?open_filter="+openType, "usage");
		} else {
			if(!$(".filter-box").hasClass('col-all')){
				$(".filter-box").addClass('col-all');
				$(".filter-box").removeClass('col-one')
				optype = openType;
			}else{
				$(".filter-box").removeClass('col-all');
				if (optype == 2 || optype == 0) {
					$(".filter-box").addClass('col-one');
				}
			}
			updateProState();
		}
	});

	$(".filter-box .btn_reset").click(function(){
		var openType = 0;
		if (!$(".filter-box").hasClass("col-all") && !$(".filter-box").hasClass("col-one")) {
			openType = 1;
		} else if ($(".filter-box").hasClass("col-one")) {
			openType = 2;
		}
		//window.location.href="index.php?open_filter="+openType+"#usage";
		loadProducts("?open_filter="+openType, "usage");
	});

	$(".filter-box ul li a, .pager a, a.order").click(function(){
		var link = $(this).attr("href");
		if ($(this).hasClass("disable") || link.indexOf("javascript:")!=-1) {
			return false;
		}
		
		var openType = 0;

		if (!$(".filter-box").hasClass("col-all") && !$(".filter-box").hasClass("col-one")) {
			openType = 1;
		} else if ($(".filter-box").hasClass("col-one")) {
			openType = 2;
		}

		if (openType > 0) {
			if (link.indexOf("?")>0) {
				link = link.replace("?", "?open_filter="+openType+"&");
			} else if (link.indexOf("#")>0) {
				link = link.replace("#", "?open_filter="+openType+"#");
			} else {
				link += "?open_filter="+openType;
			}
			//$(this).prop("href", link);
		}
		var anchor = link.indexOf("#usage") > 0 ? "usage" : "product";
		link = link.replace("index.php", "");
		loadProducts(link, anchor);
		return false;
	});
	$("#mc_container .main .product-box ul.product-list>li").unbind();
	$("#mc_container .main .product-box ul.product-list>li").click(function(){
		//new track code
		//trackShopFilter('product-item',$(this).prop("id"));
		window.open($(this).find(".infobox a").prop("href"));
	});

	//GA-ID-GENERSTOR
		//热卖产品收起按钮
		$("#mc_container .main .ttl .pos-r .switcher .i-a").html('<a id="data_<?=$module;?>_heroproduct_fold" href="javascript:void 0;" style="display: inline-block;height: 21px;width: 21px;">&nbsp;</a>');
		//热卖产品了解详情按钮
		var heroproductIndex = 1;
		$("#mc_container .main .hot .items-list ul li .info-box a.btn").each(function(){
			$(this).prop("id", "data_<?=$module; ?>_heroproduct_"+heroproductIndex+"_"+$(this).prop("href").substr($(this).prop("href").lastIndexOf("=")+1));
			heroproductIndex++;
		});
		var heroproductPage = 1;
		$("#mc_container .main .hot .ttl .pos-r .handle li").each(function(){
			//data_2in1_heroproduct_page_1
			$(this).prop("id", "data_<?=$module; ?>_heroproduct_page_"+heroproductPage);
			heroproductPage++;
		});
		//
		$("#mc_container .main .hot .items-list .nav-btns .btn-prev").prop("id", "data_<?=$module; ?>_heroproduct_arrow_left");
		$("#mc_container .main .hot .items-list .nav-btns .btn-next").prop("id", "data_<?=$module; ?>_heroproduct_arrow_right");
		//Usage Module
		//data_2in1_usagemodel_1
		var usageIndex = 1;
		$("#mc_container .main .filter-box .lev-1 .header .tags li em").each(function(){
			$(this).prop("id", "data_<?=$module; ?>_usagemodel_"+usageIndex);
			//$(this).attr("data-wap_ref", "button");
			usageIndex++;
		});
		//add new tracking code
		$("#mc_container .main .filter-box .lev-1 .header .tags li em").click(function(){
			//trackShopFilter ("filter",$(this).prop("id"));
		});
		//Usage Module Desc
		var usageDescIndex = 1;
		$("#mc_container .main .filter-box .lev-1 .header .tags li span").each(function(){
			$(this).prop("id", "data_<?=$module; ?>_usagemodel_desc_"+usageDescIndex);
			//$(this).attr("data-wap_ref", "button");
			usageDescIndex++;
		});
		$("#mc_container .main .filter-box .lev-1 .header .tags li span").click(function(){
			//trackShopFilter ("filter",$(this).prop("id"));
		});

		//Product Item
		// $("#mc_container .main .product-box .product-list>li").each(function(){
		// 	var productLink = $(this).find(".infobox a").attr("href")+"";
		// 	var productId = productLink.replace(/(\.\.\/[\w\-]+\/)?detail\.php\?id\=/,"");
		// 	$(this).find(".infobox").after("<a id=\"data_<?=$module?>_product_"+productId+"\" href=\""+$(this).find(".infobox a").attr("href")+"\" style=\"display: block;position: absolute;top: 0px;left: 0px;width: 226px;z-index: 0;height: 355px;\"><img width='226' height='355' src='../common/resource/images/transplant.png' /></a>");
		// });
		//Product Sort
		$("#mc_container .main .product-box .header .order:eq(0)").prop("id", "data_<?=$module;?>_sort_price");
		$("#mc_container .main .product-box .header .order:eq(1)").prop("id", "data_<?=$module;?>_sort_hot");
		//Page
		$("#mc_container .main .product-box .pager .first").prop("id", "data_<?=$module?>_page_start");
		$("#mc_container .main .product-box .pager .prev").prop("id", "data_<?=$module?>_page_prev");
		$("#mc_container .main .product-box .pager .next").prop("id", "data_<?=$module?>_page_next");
		$("#mc_container .main .product-box .pager .last").prop("id", "data_<?=$module?>_page_end");
		$("#mc_container .main .product-box .pager .page").each(function(){
			$(this).prop("id", "data_<?=$module?>_page_"+$(this).attr("page"));
		});
		//Advanced Filter
		$("#mc_container .main .filter-box .lev-1 .header .pro a").prop("id", " data_<?=$module?>_filter_btn");
		$("#mc_container .main .filter-box.col-all .lev-1 .more-box .btn-more").prop("id", "data_<?=$module?>_filter_btn_expand_level_1");
		//$("#mc_container .main .filter-box.col-all .lev-1 .more-box .btn-more").attr("data-wap_ref", "button");
		//Filter Level1
		var lineIndex = 1;
		$("#mc_container .main .filter-box .lev-2 ul li").each(function(){
			var colIndex = 0;
			$(this).find("a").each(function(){
				if (colIndex == 0) {
					$(this).prop("id", "data_<?=$module?>_filter_level_1_line_"+lineIndex+"_all");
				} else {
					$(this).prop("id", "data_<?=$module?>_filter_level_1_line_"+lineIndex+"_"+colIndex);
				}
				colIndex++;
			});
			lineIndex++;
		});
		//add new tracking code
		$("#mc_container .main .filter-box .lev-2 ul li a").click(function(){
			//trackShopFilter("filter",$(this).prop("id")); 
		});

		//close leve1
		$("#mc_container .main .filter-box .lev-2 .btn_close").prop("id", "data_<?=$module?>_filter_btn_fold_level_1");
		//reset leve1
		$("#mc_container .main .filter-box .lev-2 .btn_reset").prop("id", "data_<?=$module?>_filter_level_1_btn_reset");
		//expend level2
		$("#mc_container .main .filter-box .btn-options .exp").prop("id", "data_<?=$module?>_filter_btn_expand_level_2");

		//filter leve2
		lineIndex = 1;
		$("#mc_container .main .filter-box .lev-3 ul li").each(function(){
			var colIndex = 0;
			$(this).find("a").each(function(){
				if (colIndex == 0) {
					$(this).prop("id", "data_<?=$module?>_filter_level_2_line_"+lineIndex+"_all");
				} else {
					$(this).prop("id", "data_<?=$module?>_filter_level_2_line_"+lineIndex+"_"+colIndex);
				}
				colIndex++;
			});
			lineIndex++;
		});
		//add new tracking code
		$("#mc_container .main .filter-box .lev-3 ul li a").click(function(){
			//trackShopFilter("filter",$(this).prop("id")); 
		});


		//close leve2
		$("#mc_container .main .filter-box .lev-3 .btn_close").prop("id", "data_<?=$module?>_filter_btn_fold_level_2");
		//reset level2
		$("#mc_container .main .filter-box .lev-3 .btn_reset").prop("id", "data_<?=$module?>_filter_level_2_btn_reset");

	//share
	var hideShareBox = true;
	$(".share").hover(function(){
		//new track code
		//trackShopFilter('collection_page', $(this).prop("id"));
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


	//cmp & wishing
	$("#mc_container .main .product-list .add-cmp input").click(function(event){
		event.stopPropagation();
		var cookieModule = getCookie("eshop_module");
		var module = $(this).attr("module") == 'laptop' ? '2in1' : $(this).attr("module");
		if (!cookieModule) {
			cookieModule = module;
			setCookie("eshop_module", cookieModule);
		}
		if ($(this).prop("checked")) {
			if (module != cookieModule || (module == 'laptop' && cookieModule == '2in1')) {
				openTip("只能对比相同种类的产品");
				$(this).prop("checked", false);
				return;
			}
			if ($("#mc_container .ws_box .tab_contents .cmp li.item").length > 3) {
				openTip("最多只能同时对比4件商品");
				$(this).prop("checked", false);
			} else {
				//new track code
				//trackShopFilter('collection-add-camp', $(this).prop("id")+":add");
				addToCmpList($(this).attr("product"));
			}
		} else {
			//new track code
			//trackShopFilter('collection-add-camp', $(this).prop("id")+":remove");
			removeFromCmpList($(this).attr("product"));
		}
	});
	$("#mc_container .main .product-list .cover .options .wishing").click(function(event){
		//new track code
		//trackShopFilter('collection_page',$(this).prop("id")); 
		event.stopPropagation();
		if ($("#mc_container .ws_box .tab_contents .wishing li.item").length >= 15) {
			openTip("最多只能添加15件心仪产品");
			return false;
		} else {
			addToWishingList($(this).attr("product"));
		}
	});
	
	initCheckBox();

	$(".pager a").click(function(){
		//new track code
		//trackShopFilter('pager',$(this).prop("id")); 
	});
}

initHtml();

function initCheckBox() {
	var cmpIds = getCookie("eshop_cmp_ids");
	if (cmpIds) {
		cmpIds = cmpIds.split(",");
	} else {
		cmpIds = [];
	}
	for (i=0;i<cmpIds.length;i++) {
		var cmpId = cmpIds[i];
		if (cmpId && cmpId != "") {
			$("#mc_container .main .product-list .product_"+cmpId+" .add-cmp input").prop("checked", true);
		}
	}
}

function updateProState() {
	var openType = 0;
		if (!$(".filter-box").hasClass("col-all") && !$(".filter-box").hasClass("col-one")) {
			openType = 1;
		} else if ($(".filter-box").hasClass("col-one")) {
			openType = 2;
		}
		if (openType > 0 && !$(".filter-box .pro").hasClass("pro2")) {
			$(".filter-box .pro").addClass("pro2");
		} else if (openType == 0 && $(".filter-box .pro").hasClass("pro2")) {
			$(".filter-box .pro").removeClass("pro2");
		}
}


function scrollToUsageModule() {
	$("html,body").animate({scrollTop:$(".filter-box").offset().top}, '500', 'swing', function() { 
	   //alert("Finished animating");
	});
	if ($(".product-box li").length < 5) {
		$(".product-list").animate({height:396}, '500', 'swing');
	}
}

function scrollToProducts() {
	$("html,body").animate({scrollTop:$(".product-box").offset().top}, '500', 'swing', function() { 
	   //alert("Finished animating");
	});
	if ($(".product-box li").length < 5) {
		$(".product-list").animate({height:396}, '500', 'swing');
	}
}

function loadProducts(param, pos) {
	var url = window.location.href.replace(/\/(index\.php)?[^\/]*$/, "/index.php")+param.replace(/#[\w]+$/,"")+"&ajax=1";
	$.ajax({  
        type : "get",
        url : url,  
        dataType : "text",
        success : function(data){  
            if (data != undefined) {
            	// $(".filter-box").html(data.filterBoxHtml);
            	// $(".product-box").css(data.productBoxHtml);
            	// $(".product-box").html(data.productBoxHtml);
            	// $(".filter-box").removeClass("col-one");
            	// $(".filter-box").removeClass("col-all");
            	// $(".filter-box").addClass(data.filterBoxCss);
            	$("#ajax-content").html(data);
            	initHtml();
            	if (pos == 'usage') {
            		scrollToUsageModule();
            	} else {
            		scrollToProducts();
            	}
            	updateProState();
            }
        },  
        error:function(p1, p2, p3){
        	<?php if (isset($_GET['debug'])) { ?>
            alert('fail');  
            <?php } ?>
        }  
    });
}













</script>