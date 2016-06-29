<script type="text/javascript">
$("#mc_container .ws_box .tab_contents .cmp .btn_delete").click(function(){
	removeFromCmpList($(this).parent().attr("product"));
});
$("#mc_container .ws_box .tab_contents .wishing .btn_delete").click(function(){
	removeFromWishingList($(this).parent().attr("product"));
});
$("#mc_container .ws_box .tab_contents .cmp .add").click(function(){
	//new track code
	//trackShopFilter('cmp-option', $(this).prop("id"));

	var cookieModule = getCookie("eshop_module");
	window.location.href="../"+cookieModule;
});
$("#mc_container .ws_box .tab_contents .cmp .options .btn_cmp").click(function(){
	if ($("#mc_container .ws_box .tab_contents .cmp li.item").length < 2) {
		openTip("必须选择两件以上的商品才能比较");
		return false;
	}
	return true;
});
$("#mc_container .ws_box .tab_contents .cmp .options .clear_all").click(function(){
	clearCmpList();
});

if ($("#mc_container .ws_box .tab_contents .cmp li.item").length > 0) {
	$("#mc_container .ws_box .tabs ul .cmp span").text("产品比较 ( "+$("#mc_container .ws_box .tab_contents .cmp li.item").length+"/4 )");
} else {
	$("#mc_container .ws_box .tabs ul .cmp span").text("产品比较");
}

if ($("#mc_container .ws_box .tab_contents .wishing li.item").length > 0) {
	$("#mc_container .ws_box .tabs ul .wishing span").text("我的心愿单 ( "+$("#mc_container .ws_box .tab_contents .wishing li.item").length+"/15 )");
} else {
	$("#mc_container .ws_box .tabs ul .wishing span").text("我的心愿单");
}

if ($("#mc_container .ws_box .tab_contents .cmp li.item").length > 0 || $("#mc_container .ws_box .tab_contents .wishing li.item").length > 0) {
	$("#mc_container .ws_box").removeClass("tab_wishing");
	$("#mc_container .ws_box").removeClass("tab_cmp");
}

function getCookieCmpIds() {
	var cmpIds = getCookie("eshop_cmp_ids");
	if (cmpIds) {
		cmpIds = cmpIds.split(",");
	} else {
		cmpIds = [];
	}
	var newIds = [];
	for (i=0;i<cmpIds.length;i++) {
		var cmpId = cmpIds[i];
		if (cmpId && cmpId != "") {
			newIds.push(cmpId);
		}
	}
	return newIds;
}

function getCookieWishingIds() {
	var wishingIds = getCookie("eshop_wishing_ids");
	if (wishingIds) {
		wishingIds = wishingIds.split(",");
	} else {
		wishingIds = [];
	}
	var newIds = [];
	for (i=0;i<wishingIds.length;i++) {
		var wId = wishingIds[i];
		if (wId && wId != "") {
			newIds.push(wId);
		}
	}
	return newIds;
}

function addToCmpList(productId) {
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

	setCookie("eshop_cmp_ids", cmpIds.join(","), {path: '/'});
	var itemHtml = '';
	var brand = $(".product_"+productId+" .brand").val();
	var name = $(".product_"+productId+" h2 strong").text();
	var price = $(".product_"+productId+" .price").text();
	itemHtml += '<li class="item" product="'+productId+'">';
	itemHtml += '	<p class="image-box"><img width="80" src="../product_images/'+productId+'.jpg" /></p>';
	itemHtml += '	<p class="brand">'+brand+'</p>';
	itemHtml += '	<p class="title">'+name.replace(brand, "")+'</p>';
	itemHtml += '	<p class="price">'+price.replace("指导价格：","").replace("RMB","￥")+'</p>';
	itemHtml += '	<p class="buy_btn"><a id="data_fixed_comparison_btn_buy_'+productId+'" href="../'+$(".product_"+productId+" .add-cmp input").attr("module")+'/detail.php?id='+productId+'" target="_blank">立刻购买</a></p>';
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
function removeFromCmpList(productId) {
	var cmpIds = getCookieCmpIds();
	if ($.inArray(productId, cmpIds) != -1) {
		var newIds = [];
		for(var i=0; i<cmpIds.length;i++) {
			if (cmpIds[i] != productId) {
				newIds.push(cmpIds[i]);
			}
		}
		cmpIds = newIds;
	}
	setCookie("eshop_cmp_ids", cmpIds.join(","));
	$("#mc_container .ws_box .tab_contents .cmp li.item[product="+productId+"]").remove();
	if($("#mc_container .ws_box .tab_contents .cmp li.item").length == 0) {
		$("#mc_container .ws_box").removeClass("tab_cmp");
		if ($("#mc_container .ws_box .tab_contents .wishing li.item").length == 0) {
			$("#mc_container .ws_box").addClass("hide");
		} else {
			$("#mc_container .ws_box").addClass("tab_wishing");
		}
		clearCmpCookies();
	} else if ($("#mc_container .ws_box .tab_contents .cmp li.add").length == 0) {
		$("#mc_container .ws_box .tab_contents .cmp .options").before('<li id="data_fixed_comparison_btn_add" class="add"></li>');
		$("#mc_container .ws_box .tab_contents .cmp .add").click(function(){
			//new track code
			//trackShopFilter('cmp-option', $(this).prop("id"));
			window.location.href="../"+ getCookie("eshop_module");;
		});
	}
	$("#mc_container .main .product-list .product_"+productId+" .add-cmp input").prop("checked", false);

	if ($("#mc_container .ws_box .tab_contents .cmp li.item").length > 0) {
		$("#mc_container .ws_box .tabs ul .cmp span").text("产品比较 ( "+$("#mc_container .ws_box .tab_contents .cmp li.item").length+"/4 )");
	} else {
		$("#mc_container .ws_box .tabs ul .cmp span").text("产品比较");
	}
	updateFooterPos();
	updateShareId();
}

function clearCmpList() {
	$("#mc_container .ws_box .tab_contents .cmp li.item").remove();
	$("#mc_container .ws_box").removeClass("tab_cmp");
	if ($("#mc_container .ws_box .tab_contents .wishing li.item").length == 0) {
		$("#mc_container .ws_box").addClass("hide");
	} else {
		$("#mc_container .ws_box").addClass("tab_wishing");
	}
	if ($("#mc_container .ws_box .tab_contents .cmp li.add").length == 0) {
		$("#mc_container .ws_box .tab_contents .cmp .options").before('<li class="add"></li>');
		$("#mc_container .ws_box .tab_contents .cmp .add").click(function(){
			//new track code
			//trackShopFilter('cmp-option', $(this).prop("id"));
			window.location.href="../"+ getCookie("eshop_module");;
		});
	}
	$("#mc_container .main .product-list .add-cmp input:checked").prop("checked", false);
	$("#mc_container .ws_box .tabs ul .cmp span").text("产品比较");
	
	clearCmpCookies();
	updateFooterPos();
	updateShareId();
}

function clearCmpCookies() {
	setCookie("eshop_cmp_ids", "");
	setCookie("eshop_module", "");
	setCookie("eshop_group_ids", "");
	setCookie("eshop_param_ids", "");
	//other things
}

function addToWishingList(productId) {
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
	setCookie("eshop_wishing_ids", wishingIds.join(","), {path: '/'});

	var itemHtml = '';
	var brand = $(".product_"+productId+" .brand").val();
	var name = $(".product_"+productId+" h2 strong").text();
	var price = $(".product_"+productId+" .price").text();

	itemHtml += '<li class="item" product="'+productId+'">';
	itemHtml += '	<p class="image-box"><img height="75" src="../product_images/'+productId+'.jpg" /></p>';
	itemHtml += '	<p class="title">'+name+'</p>';
	itemHtml += '	<p class="price">'+price.replace("指导价格：","").replace("RMB","￥")+'</p>';
	itemHtml += '	<p class="buy_btn"><a id="data_fixed_wishing_btn_buy_'+productId+'" href="../'+$(".product_"+productId+" .add-cmp input").attr("module")+'/detail.php?id='+productId+'" target="_blank">立刻购买</a></p>';
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
function removeFromWishingList(productId) {
	var wishingIds = getCookieWishingIds();
	if ($.inArray(productId, wishingIds) != -1) {
		var newIds = [];
		for(var i=0; i<wishingIds.length;i++) {
			if (wishingIds[i] != productId) {
				newIds.push(wishingIds[i]);
			}
		}
		wishingIds = newIds;
	}
	setCookie("eshop_wishing_ids", wishingIds.join(","));
	$("#mc_container .ws_box .tab_contents .wishing>ul li.item[product="+productId+"]").remove();
	if($("#mc_container .ws_box .tab_contents .wishing>ul li.item").length == 0) {
		$("#mc_container .ws_box").removeClass("tab_wishing");
		if ($("#mc_container .ws_box .tab_contents .cmp li.item").length == 0) {
			$("#mc_container .ws_box").addClass("hide");
		} else {
			$("#mc_container .ws_box").addClass("tab_cmp");
		}
		
	}
	if ($("#mc_container .ws_box .tab_contents .wishing>ul li.item").length > 0) {
		$("#mc_container .ws_box .tabs ul .wishing span").text("我的心愿单 ( "+$("#mc_container .ws_box .tab_contents .wishing li.item").length+"/15 )");
	} else {
		$("#mc_container .ws_box .tabs ul .wishing span").text("我的心愿单");
	}
	updateFooterPos();
	updateShareId();
}

$("#mc_container .ws_box .tabs .cmp").click(function(){
	$("#mc_container .ws_box").toggleClass("tab_cmp");
	$("#mc_container .ws_box").removeClass("tab_wishing");
	updateFooterPos();
	$(this).prop("id", "data_fixed_fold");
});

$("#mc_container .ws_box .tabs .wishing").click(function(){
	$("#mc_container .ws_box").toggleClass("tab_wishing");
	$("#mc_container .ws_box").removeClass("tab_cmp");
	updateFooterPos();
	$(this).prop("id", "data_fixed_fold");
});

$("#mc_container .ws_box .tabs .wishing em").click(function(event){
	//new track code
	//trackShopFilter('cmp-option', $(this).prop("id"));
	event.stopPropagation();
	$(this).prop("id", "data_fixed_expand");
	if ($("#mc_container .ws_box").hasClass("tab_wishing")) {
		$("#mc_container .ws_box").removeClass("tab_wishing");
		return;
	}
	if ($("#mc_container .ws_box").hasClass("tab_cmp")) {
		$("#mc_container .ws_box").removeClass("tab_cmp");
		return;
	}
	if ($("#mc_container .ws_box .tab_contents .cmp li.item").length > 0 || $("#mc_container .ws_box .tab_contents .wishing>ul li.item").length > 0) {
		$("#mc_container .ws_box").toggleClass("tab_cmp");
		$("#mc_container .ws_box").removeClass("tab_wishing");
	} else {
		$("#mc_container .ws_box").toggleClass("tab_wishing");
		$("#mc_container .ws_box").removeClass("tab_cmp");
	}
	$(this).prop("id", "data_fixed_fold");
});
updateFooterPos();
function updateFooterPos() {
	
}

//share rel
$("#mc_container .main .product-box ul.product-list li .cover .options ul li.share_item").click(function(event){
	//new track code
	//trackShopFilter('sns-share',$(this).find("a").prop("id"));

	var platform = $(this).prop("class").replace("share_item ", "");
	var title = $(this).parent().parent().parent().parent().find(".infobox h2").prop("title");
	var productId = $(this).parent().parent().parent().parent().find(".logo .add-cmp input").attr("product");
	var productModule = $(this).parent().parent().parent().parent().find(".logo .add-cmp input").attr("module");
	var url = window.location.href.replace(/\/[\w\-]+\/(index\.php)?[^\/]*$/, "/"+productModule+"/detail.php?id="+productId);
	var pic = window.location.href.replace(/\/[\w\-]+\/(index\.php)?[^\/]*$/, "/product_images/"+productId+".jpg");
	shareToSns(platform, title, url, pic);
	event.stopPropagation();
});

$("#mc_container .ws_box .tab_contents .wishing>.share_box ul li.share_item").click(function(){
	if ($("#mc_container .ws_box .tab_contents .wishing li.item").length == 0) {
		openTip("不能分享空的心愿单");
		return false;
	}
	var platform = $(this).prop("class").replace("share_item ", "");
	var title = "我心仪的商品，大家看看怎么样";
	var url = window.location.href.replace(/\/[\w\-]+\/((index|detail)\.php)?[^\/]*$/, "/wishing/?product="+getCookie("eshop_wishing_ids"));
	var pids = getCookie("eshop_wishing_ids").split(",");
	var pic = window.location.href.replace(/\/[\w\-]+\/((index|detail)\.php)?[^\/]*$/, "/product_images/"+pids[0]+".jpg");
	shareToSns(platform, title, url, pic);
});

function updateShareId() {
	var wishingIds = getCookieWishingIds();
	wishingIds = wishingIds.join("_");
	$("#mc_container .ws_box .tab_contents .wishing>.share_box ul li.share_item a").each(function(){
		$(this).prop("id", $(this).attr("idbase")+"_"+wishingIds);
	});

	var cmpIds = getCookieCmpIds();
	cmpIds = cmpIds.join("_");
	$("#mc_container .main .basic_info .cmp_result_share_box ul li.share_item a").each(function(){
		$(this).prop("id", $(this).attr("idbase")+"_"+cmpIds);
	});
}

$("#mc_container .main .basic_info .cmp_result_share_box ul li.share_item").click(function(){
	//new track code
	//trackShopFilter('compare-sns-share',$(this).find("a").prop("id"));
	if ($("#mc_container .main .basic_info .info1 li .image-box").length == 0) {
		openTip("请选择对比商品后再分享");
		return false;
	}
	var platform = $(this).prop("class").replace("share_item ", "");
	var title = "这几款商品哪个更适合我，大家给点意见吧";
	var url = window.location.href.replace(/\/[\w\-]+\/((index|detail)\.php)?[^\/]*$/, "/compare/?product="+getCookie("eshop_cmp_ids")+"&m="+getCookie("eshop_module"));
	var pids = getCookie("eshop_cmp_ids").split(",");
	var pic = window.location.href.replace(/\/[\w\-]+\/((index|detail)\.php)?[^\/]*$/, "/product_images/"+pids[0]+".jpg");
	shareToSns(platform, title, url, pic);
});


function shareToSns(platform, content, url, pic) {
	content = encodeURIComponent(content);
	url = encodeURIComponent(url);
	pic = encodeURIComponent(pic);
	if (platform == "sina") {
		window.open("http://service.weibo.com/share/share.php?url="+url+"&title="+content+"&pic="+pic);
	} else if (platform == "sohu") {
		void((function(s, d, e, r, l, p, t, z, c) {
			var f = 'http://t.sohu.com/third/post.jsp?',u = z || d.location,p = ['&appkey=', '', '&url=', e(u), '&title=', e(t || d.title), '&content=', c || 'gb2312', '&pic=', e(p || '')].join('');
			function a() {if (!window.open([f, p].join(''), 'mb', ['toolbar=0,status=0,resizable=1,width=660,height=470,left=', (s.width - 660)/2, ',top=', (s.height - 470)/2].join(''))) {u.href = [f, p].join('');}};
				if (/Firefox/.test(navigator.userAgent)) { 
					setTimeout(a, 0); 
				} else { a(); }})(screen,document,encodeURIComponent, '', '', '', content,url,'utf-8'));
	} else if (platform == "qzone") {
		window.open("http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url="+url+"&title="+content);
	} else if (platform == "kaixin") {
		d=document;
		t=d.selection?(d.selection.type!='None'?d.selection.createRange().text:''):(d.getSelection?d.getSelection():'');
		void(kaixin=window.open('http://www.kaixin001.com/~repaste/repaste.php?&rurl='+escape(url)+'&rtitle='+content+'&rcontent='+content,'kaixin'));
		kaixin.focus();
	} else if (platform == "renren") {
		//window.open("http://www.connect.renren.com/share/sharer?url="+url+"&title="+content);
		window.open("http://widget.renren.com/dialog/share?resourceUrl="+url+"&srcUrl="+url+"&title="+content+"&description=");
	}
}

$(".footer").after('<div class="tip_box_bg"><div class="tip_box"><div class="tip_top"><img src="../common/resource/images/transplant.png" /></div><div class="tip_content"></div><div class="tip_bottom"><img src="../common/resource/images/transplant.png" /></div></div></div>');
setTimeout(function(){
	$(".tip_box_bg .tip_box .tip_top img, .tip_box_bg .tip_box .tip_bottom img").click(function(){
		$(".tip_box_bg").hide();
		$(".tip_content").html("");
	});
}, 100);
function openTip(msg) {
	$(".tip_box_bg").show();
	$(".tip_content").html(msg);
}

updateShareId();
</script>