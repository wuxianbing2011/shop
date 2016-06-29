<script type="text/javascript">
   //configure analytics
    var wapGeo = 'prc-na';
    var wapLocalCode = 'cn-zh';
    var wa_product_id = "<?=$pconlineId; ?>";
    var wa_product_manufacturer = "<?=$trackData['manufacturer']?>";
    var wa_product_processors = "<?=$trackData['processor']; ?>";
    var wa_product_model = "<?=$trackData['model'];?>";
    var wa_product_formFactor = "<?=$trackData['formFactor'];?>";
 
   //load analytics
   (function() {
                var host = (window.document.location.protocol == 'http:') ? "http://www.intel.com" : "https://www-ssl.intel.com";
                var url = host+"/content/dam/www/global/wap/wap-prcappshop.js"; //wap file url
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;  po.src = url;
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();

    

</script>