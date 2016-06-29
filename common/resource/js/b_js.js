//  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
//
//  ga('create', 'UA-63927566-8', 'auto');
//  ga('send', 'pageview');
  
$(function () {
		onload_fun();
		function onload_fun(){
			for (var i=0;i<$('#b_con_2_ul> li').length;i++) {
				var con_li=$('#b_con_2_ul> li').eq(i);
				if (con_li.attr("category")=='gdsw')
				{
					con_li.css('display','block');

				}
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

		// ����
		$('#b_nav ul li').click(function(){
			$(this).addClass('b_nav_checked').siblings().removeClass('b_nav_checked');
			var nav_=$(this).attr("category");

			for (var i=0;i<$('#b_con_2_ul> li').length;i++) {
				var con_li=$('#b_con_2_ul >li').eq(i);
				if (con_li.attr("category")==nav_)
				{
					con_li.css('display','block');
				}
				else{
					con_li.css('display','none');
				}
			}
			con_2_fun('1');
			var index_=$(this).index();
	
			switch(index_)
			{
				case 0:ga('send', 'event', 'Navigation', 'click', 'Business');break;
				case 1:ga('send', 'event', 'Navigation', 'click', 'stationary');break;
				case 2:ga('send', 'event', 'Navigation', 'click', 'customer');break;
				case 3:ga('send', 'event', 'Navigation', 'click', 'engineering');break;
				case 4:ga('send', 'event', 'Navigation', 'click', 'remote');break;

				default:"";
			}


		})
		$('.b_con_1 div.right').click(function(){
			ga('send', 'event', 'Navigation', 'click', 'index');
			$('#b_con_2_ul >li').css('display','block');

			con_2_fun('0');
		})
		$(".b_con_2 ul > li span,.b_con_2 ul > li .b_con_2_goods,.b_con_2 ul > li .b_con_2_info a").click(function(){
			var name=$(this).closest('li').attr('name');
			ga('send', 'event', 'Product', 'click', name);
//			ga('send', 'event','purchase-now',name,'shop');
		})
	


	});
	


