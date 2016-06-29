$(document).ready(function(){
	$("#btn_kv_1").click(function(){
		var btn_1_sta = $("#intel_products").is(":hidden");
		var btn_kv1_src = $("#btn_kv_1").find("img").attr("src");
		var btn_kv3_src = $("#btn_kv_3").find("img").attr("src");
		if(btn_1_sta == true){
			// $(this).html('<img src="../common/resource/images/btn_kv_1_open.png" />');
			// $("#btn_kv_3").html('<img src="../common/resource/images/btn_kv_3_close.png" />');
			$("#btn_kv_1").find("img").attr("src", btn_kv1_src.replace("close", "open"));
			$("#btn_kv_3").find("img").attr("src", btn_kv3_src.replace("open", "close"));

			$("#intel_products").show();
			$("#other_products").hide();
			$("#line2").show();
			$("#btn_kv").height("106");
		}
		
		if(btn_1_sta == false){
			//$("#btn_kv_1").html('<img src="../common/resource/images/btn_kv_1_close.png" />');
			$(this).find("img").attr("src", btn_kv1_src.replace("open", "close"));
			$("#intel_products").hide();
			$("#line2").hide();
			$("#btn_kv").height("40");
		}
		
	});
	$("#btn_kv_3").click(function(){
		var btn_3_sta = $("#other_products").is(":hidden");
		var btn_kv1_src = $("#btn_kv_1").find("img").attr("src");
		var btn_kv3_src = $("#btn_kv_3").find("img").attr("src");
		if(btn_3_sta == true){
			// $(this).html('<img src="../common/resource/images/btn_kv_3_open.png" />');
			// $("#btn_kv_1").html('<img src="../common/resource/images/btn_kv_1_close.png" />');

			$("#btn_kv_1").find("img").attr("src", btn_kv1_src.replace("open", "close"));
			$("#btn_kv_3").find("img").attr("src", btn_kv3_src.replace("close", "open"));			

			$("#intel_products").hide();
			$("#other_products").show();
			$("#line2").show();
			$("#btn_kv").height("106");
		}
		
		if(btn_3_sta == false){
			//$("#btn_kv_3").html('<img src="../common/resource/images/btn_kv_3_close.png" />');
			$("#btn_kv_3").find("img").attr("src", btn_kv3_src.replace("open", "close"));
			$("#other_products").hide();
			$("#line2").hide();
			$("#btn_kv").height("40");
		}
	});
	
	$("#btn_kv_2").click(function(){
		// $("#btn_kv_1").html('<img src="../common/resource/images/btn_kv_1_close.png" />');
		// $("#btn_kv_3").html('<img src="../common/resource/images/btn_kv_3_close.png" />');
		$("#intel_products").hide();
		$("#other_products").hide();
		$("#line2").hide();
		$("#btn_kv").height("40");
	});

	$("#btn_kv #line2 ul li").hover(function(){
			if (!$(this).find("img").hasClass("current")) {
				var imgSrc = $(this).find("img").attr("src");
				$(this).find("img").attr("src", imgSrc.replace(".png", "_h.png"));
			}
			
		}, function(){
			if (!$(this).find("img").hasClass("current")) {
				var imgSrc = $(this).find("img").attr("src");
				$(this).find("img").attr("src", imgSrc.replace("_h.png", ".png"));
			}
		}
	);

});