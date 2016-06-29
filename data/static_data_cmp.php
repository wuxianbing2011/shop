<?php
$moduleToTableMap = array("tablet"=>"products_tablet"
	,"2in1"=>"products_2in1"
	,"desktop"=>"products_desktop"
	,"laptop"=>"products_laptop"
	,"aio"=>"products_allin1"
	,"smart-phone"=>"products_mobile"
	,"cpu"=>"products_cpu"
	,"ssd"=>"products_ssd"
	,"mainboard"=>"products_mainboard");
$moduleNames = array("tablet"=>"平板电脑"
	,"2in1"=>"2合1"
	,"desktop"=>"台式机"
	,"laptop"=>"笔记本电脑"
	,"aio"=>"一体机"
	,"smart-phone"=>"智能手机"
	,"cpu"=>"处理器"
	,"ssd"=>"固态硬盘"
	,"mainboard"=>"主板");
$tableToModuleMap = array("products_tablet"=>"tablet"
	,"products_2in1"=>"2in1"
	,"products_desktop"=>"desktop"
	,"products_laptop"=>"laptop"
	,"products_allin1"=>"aio"
	,"products_mobile"=>"smart-phone"
	,"products_cpu"=>"cpu"
	,"products_ssd"=>"ssd"
	,"products_mainboard"=>"mainboard");
$brandFields = array("tablet"=>"m_brand", "2in1"=>"brand_name", "desktop"=>"m_brand", "laptop"=>"m_brand", "aio"=>"m_brand", "smart-phone"=>"m_brand", "cpu"=>"", "ssd"=>"", "mainboard"=>"");
$TwoInOneTolaptopFieldMap = array(
	"model"=>"model_alias"
	,"onsale_time"=>"onsell_time"
	,"product_dingwei"=>"product_positioning"
	,"ultrabook_dingwei"=>"ultrabook_positioning"
	,"operating_system"=>"operating_system"

	,"chuliqi"=>"cpu"
	,"core_thread"=>"core_thread"
	,"core_jiagou"=>"core_framework"
	,"cpu_type"=>"cpu_type"
	,"cpu_zhupin"=>"cpu_frequency"
	,"jiasu_jishu"=>"jiasu_tech"
	,"cache2"=>"cache2"
	,"cache3"=>"cache3"

	,"xianka_type"=>"xianka_type"
	,"xianka_chip"=>"xianka_chip"
	,"xianka_rongliang"=>"xiancun_rongliang"
	,"xiancun_leixing"=>"xiancun_leixing"
	,"xianka_xingneng"=>"xianka_texing"

	,"screen_size"=>"screen_size"
	,"screen_radio"=>"screen_ratio"
	,"screen_leixing"=>"screen_type"
	,"screen_spec"=>"xianshiping_char"

	,"neicun_daxiao"=>"mem_rongliang"
	,"neicun_type"=>"mem_type"
	,"neicun_max"=>"max_mem"///////////////
	,"harddist_type"=>"disk_type"
	,"harddisc_size"=>"disk_size"
	,"cddrive_type"=>"cd_drive_type"

	,"shexiangtou"=>"shexiangtou"
	,"yangshengqi"=>"yinxiang"
	,"yinpin_sys"=>"yinpin_sys"

	,"dianchi_type"=>"dianchi_type"
	,"dianyuan_adapter"=>"dianyuan_adapter"
	,"xuhang"=>"xuhang_time"
	,"guige"=>"spec"
	,"thickness"=>"thickness"
	,"weight"=>"weight"
	,"waike"=>"waike"

	,"wuxian_tongxun"=>"wuxian_tongxun"

	,"fudai_ruanjian"=>"fudai_software"
	,"peijian"=>"peijian"
);
$doubleData = array( 565510, 565516, 569017, 566755, 563128, 569368, 559590, 561261, 559587, 565508, 556893, 560231, 556892, 553985, 569367, 569372, 559589, 557721, 561275, 553012, 555151, 569376, 553998, 560622, 566756, 564831, 545767, 568681, 560124, 553958, 569018, 563737, 543282, 561628, 557004, 563129, 560479, 569375, 553022, 565511, 555150, 561627, 559588, 553031, 569377, 560619, 566345);

$simpleInfoMap = array(
	"tablet"=>array(
		array("name"=>"处理器", "format"=>"#0", "field"=>"m_cpu")
		,array("name"=>"内存", "format"=>"#0GB", "field"=>"mem_rongliang")
		,array("name"=>"硬盘", "format"=>"#0GB #1", "field"=>array("disk_size","disk_type"))
		,array("name"=>"操作系统", "format"=>"#0", "field"=>"m_system")
	)
	,"2in1"=>array(
		array("name"=>"处理器", "format"=>"#0", "field"=>"chuliqi")
		,array("name"=>"内存", "format"=>"#0GB", "field"=>"memory_size")
		,array("name"=>"硬盘", "format"=>"#0GB #1", "field"=>array("harddisc_size","harddist_type"))
		,array("name"=>"显卡", "format"=>"#0", "field"=>"xianka_type")
	)
	,"desktop"=>array(
		array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
		,array("name"=>"内存", "format"=>"#0GB", "field"=>"mem_daxiao")
		,array("name"=>"硬盘", "format"=>"#0GB #1", "field"=>array("disk_size","disk_type"))
		,array("name"=>"显卡", "format"=>"#0", "field"=>"xianka_type")
	)
	,"laptop"=>array(
		array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
		,array("name"=>"内存", "format"=>"#0GB", "field"=>"mem_rongliang")
		,array("name"=>"硬盘", "format"=>"#0GB #1", "field"=>array("disk_size","disk_type"))
		,array("name"=>"显卡", "format"=>"#0", "field"=>"xianka_type")
	)
	,"aio"=>array(
		array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
		,array("name"=>"内存", "format"=>"#0GB", "field"=>"mem_rongliang")
		,array("name"=>"硬盘", "format"=>"#0GB #1", "field"=>array("disk_size","disk_type"))
		,array("name"=>"显卡", "format"=>"#0", "field"=>"xianka_type")
	)
	,"smart-phone"=>array(
		array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
		,array("name"=>"屏幕尺寸", "format"=>"#0英寸", "field"=>"mainscreen_size")
		,array("name"=>"重量", "format"=>"约#0", "field"=>"weight")
		,array("name"=>"厚度", "format"=>"#0", "field"=>"thickness")
	)
	,"cpu"=>array(
		array("name"=>"处理器", "format"=>"#0", "field"=>"m_processor")
		,array("name"=>"主频", "format"=>"#0GHz", "field"=>"main_frequency")
		,array("name"=>"集成显卡", "format"=>"#0", "field"=>"jixian_model")
		,array("name"=>"核心数量", "format"=>"#0", "field"=>"core_num")
	)
	,"ssd"=>array(
		array("name"=>"容量", "format"=>"#0GB", "field"=>"rongliang")
		,array("name"=>"接口类型", "format"=>"#0", "field"=>"jiekou_leixing")
		,array("name"=>"有无外壳", "format"=>"#0", "field"=>"waike")
		,array("name"=>"硬盘尺寸", "format"=>"#0", "field"=>"disk_chicun")
	)
	,"mainboard"=>array(
		array("name"=>"支持处理器", "format"=>"#0", "field"=>"m_support_cpu")
		,array("name"=>"适用平台", "format"=>"#0GB", "field"=>"fit_model")
		,array("name"=>"总线技术", "format"=>"#0", "field"=>"hyper_transport_bus_tech")
		,array("name"=>"芯片", "format"=>"#0", "field"=>"chip_group")
	)
);
















