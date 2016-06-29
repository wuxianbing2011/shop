<div style="float:right; margin-top:8px; background:url('../common/resource/images/search_bg.png') no-repeat;width:228px; height:30px;">
					<form id="frmSearch" name="frmSearch" method="get" action="../search">
						<div style="float:left;width:195px;padding:1px 0px 0px 1px;">
							<input id="keyword" name="keyword" style="height:26px; border:0px; line-height:26px; padding-left:5px; width:190px;" />
						</div>
						<div style="float:left;width:30px;height: 30px; line-height:30px;">
							<a id="data_searchbox" style="display:block;width:30px; height:27px;" href="javascript:void 0;"></a>
						</div>
					</form>
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