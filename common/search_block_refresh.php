<div class="b_con_1">
	<div class="clearfix w1168">
		<form id="frmSearch" name="frmSearch" method="get" action="../search">
			<div class="left clearfix">
				<input id="keyword" name="keyword" type="text" placeholder="查找机型" class="left">
				<a id="data_searchbox" class="right" href="javascript:void 0;"></a>
			</div>
			<div class="right">
				<a href="javascript:void(0)">
				显示全部
				</a>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
$("#data_searchbox").click(function(){
	try {
		var param = {
			type: "event", 
			action: "product_search",
			value: $("#keyword").val()+""
		}
		MLTracker.track(param);
	} catch(e) {

	}
	$('#frmSearch').submit();
});
</script>