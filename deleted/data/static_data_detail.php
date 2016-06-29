<?php
$productInfoMap = array(
	"cpu"=>array(
		array("type"=>"like", "keywords"=>array("第四代"), "image"=>"product-cpu-1.png", "title"=>"第四代智能英特尔酷睿处理器", "description"=>"更轻、更薄、更强劲的处理器，创新的SoC整合设计和超低的能耗使芯片抛弃风扇，重量更轻。其节能设计让它的能耗相较于上一代降低了25%，但其性能却提升了11%。充沛的电力，支持播放高清视频长达9.1小时。")
		,array("type"=>"like", "keywords"=>array("四核", "奔腾", "赛扬", "凌动", "Pentium", "Celeron","ATOM"), "image"=>"product-cpu-2.png", "title"=>"英特尔高移动性的处理器家族", "description"=>"由四核芯奔腾，四核芯赛扬及凌动处理器组成的英特尔高移动性处理器家族拥有超低能耗和超强性能。让2合1电脑与您形影相随，从容面对各种复杂工作挑战。")
	)
	,"outline"=>array(
		//"weight"=>"<2", 
		array("type"=>"match", "cond"=>array("thickness"=>"<18"), "image"=>"product-weight.png", "title"=>"英特尔处理器让2合1电脑非常轻薄", "description"=>"英特尔处理器让2合1电脑非常轻薄，方便携带还能在办公室、家中、户外等多种场合自由变换PC、平板造型。")
	)
	,"ruiju"=>array(
		array("type"=>"like", "keywords" => array("锐矩"), "image"=>"product-tect-1.png", "title"=>"英特尔锐矩显卡提供内在视觉支持", "description"=>"英特尔® 锐矩显卡，结合第四代智能英特尔® 酷睿™ 处理器，交付出色的逼真多媒体体验。浸入式体验高速、惊艳 3D 游戏。快速、轻松处理高级图片和视频编辑任务。悠闲享受高清视频和出色的 4K 分辨率超高清显示。")
	)
	,"widi"=>array(
		array("type"=>"like", "keywords" => array("WiDi"), "image"=>"product-tech-2.png", "title"=>"英特尔® WiDi", "description"=>"无需线缆。无需加密狗。只需要英特尔® WiDi。轻松将 2 合 1 设备上的电影流传输至 HDTV，在家庭影院设备上玩 PC 游戏，或在会议室的大屏幕上显示平板电脑上的演示稿。您可随心选择适合的技术全面满足需求。")
	)
	,"ssd"=>array(
		array("type"=>"like", "keywords"=>array("730"), "image"=>"product-sssd-2.png", "title"=>"英特尔® 固态盘 730 系列", "description"=>"英特尔® 固态盘 730 系列将发烧级的性能和通常仅为数据中心存储产品所专有的耐用性和可靠性相结合。换句话说，这是两全其美，意味着您对此产品的质量应该毫无后顾之忧。")
		,array("type"=>"like", "keywords"=>array("530"), "image"=>"product-sssd-3.png", "title"=>"英特尔® 固态盘 530 系列", "description"=>"借助英特尔 ® 固态盘 530 系列，您的计算机将能飞速运行要求最苛刻的消费者客户端应用程序，并将轻松地满足多任务的需求。英特尔固态盘 530 系列不带移动部件，从而降低因操作过程中的震颤而引起数据丢失的风险。")
		,array("type"=>"like", "keywords"=>array("固态","SSD"), "image"=>"product-ssd-1.png", "title"=>"英特尔® 固态盘", "description"=>"无论您是要征服对手还是要运行关键的企业应用程序，总有一款适合您特定需求的英特尔® 固态盘为您服务。在各种不同的外形和容量中选取，享受高可靠性和响应速度的存储性能 — 无论用于哪种应用程序。")
	)
);
$fieldMap = array(
	"tablet" => array(
		"name"=>"平板电脑"
		,"briefFields"=>array(
			array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
			,array("name"=>"内存", "format"=>"#0GB", "field"=>"mem_rongliang")
			,array("name"=>"硬盘", "format"=>"#0GB #1", "field"=>array("disk_size","disk_type"))
			,array("name"=>"操作系统", "format"=>"#0", "field"=>"system")
		)
		,"hoverFields"=>array(
			array("name"=>"屏幕尺寸", "format"=>"#0寸", "type"=>"screen", "field"=>"screen_size", "images"=>array(
																								"<8"=>"tablet_srn_1"
																								,"8-8.9"=>"tablet_srn_2"
																								,">9"=>"tablet_srn_3"
			))
			,array("name"=>"厚度", "format"=>"#0mm", "type"=>"thickness", "field"=>"thickness", "images"=>array(
																								"<8"=>"tablet_thck_1"
																								,"8-9"=>"tablet_thck_2"
																								,"9-10"=>"tablet_thck_3"
																								,"10-11"=>"tablet_thck_4"
																								,">11"=>"tablet_thck_5"
			))
			,array("name"=>"重量", "format"=>"#0kg", "type"=>"weight", "field"=>"weight", "images"=>array(
																								"<400"=>"tablet_wght_1"
																								,">400"=>"tablet_wght_2"
			))
		)
		,"specFields"=>array(
			"cpu"=>"cpu"
			,"weight"=>""//"weight"
			,"thickness"=>""// "m_thickness"
			,"ruiju"=>""
			,"widi"=>""
			,"ssd"=>"disk_type"
		)
		,"paramDetailFields"=>array(
			array("group_name"=>"基本参数", "col"=>0, "height"=>"246", "icon"=>"basic", "items"=>array(
				array("name"=>"型号别称", "format"=>"#0", "field"=>"mode")
				,array("name"=>"上市时间", "format"=>"#0", "field"=>"onsell_time")
				,array("name"=>"定位", "format"=>"#0", "field"=>"product_positioning")//m_usage
				,array("name"=>"操作系统", "format"=>"#0", "field"=>"system")
				,array("name"=>"颜色", "format"=>"#0", "field"=>"color")
				,array("name"=>"重量", "format"=>"#0", "field"=>"weight")
				,array("name"=>"尺寸", "format"=>"#0", "field"=>"spec")
			))
			,array("group_name"=>"主要参数", "col"=>1, "height"=>"246", "icon"=>"main", "items"=>array(
				array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
				,array("name"=>"处理器类型", "format"=>"#0", "field"=>"cpu_type")
				,array("name"=>"处理器主频", "format"=>"#0GHz", "field"=>"cpu_frequency")
				,array("name"=>"系统内存", "format"=>"#0GB", "field"=>"mem_rongliang")
				,array("name"=>"内存类型", "format"=>"#0", "field"=>"mem_type")
				,array("name"=>"存储容量", "format"=>"#0GB", "field"=>"disk_size")
				,array("name"=>"硬盘类型", "format"=>"#0", "field"=>"disk_type")
				,array("name"=>"存储扩展", "format"=>"#0", "field"=>"cunchu_kuozhan")
				,array("name"=>"传感器", "format"=>"#0", "field"=>"chuanganqi")
			))
			,array("group_name"=>"屏幕参数", "col"=>0, "height"=>"160", "icon"=>"screen", "items"=>array(
				array("name"=>"屏幕尺寸", "format"=>"#0", "field"=>"screen_size")
				,array("name"=>"分辨率", "format"=>"#0", "field"=>"screen_ratio")
				,array("name"=>"显示比例", "format"=>"#0", "field"=>"screen_bili")
				,array("name"=>"屏幕特性", "format"=>"#0", "field"=>"xianshiqi_type")
				,array("name"=>"屏幕描述", "format"=>"#0", "field"=>"pingmu_desc")
			))
			,array("group_name"=>"网络通讯", "col"=>1, "height"=>"160", "icon"=>"communication", "items"=>array(
				array("name"=>"WiFi功能", "format"=>"#0", "field"=>"wuxian_tongxun")
				,array("name"=>"蓝牙功能", "format"=>"#0", "field"=>"lanya")
			))
			,array("group_name"=>"媒体功能", "col"=>0, "height"=>"138", "icon"=>"media", "items"=>array(
				array("name"=>"摄像头", "format"=>"#0", "field"=>"neizhi_shexiangtou")
				,array("name"=>"摄像辅助", "format"=>"#0", "field"=>"shexiang_fuzhu")
				,array("name"=>"扬声器", "format"=>"#0", "field"=>"yinxiang")
				,array("name"=>"音频功能", "format"=>"#0", "field"=>"yinxiao")
			))
			,array("group_name"=>"格式支持", "col"=>1, "height"=>"138", "icon"=>"support_ext", "items"=>array(
				array("name"=>"音频格式", "format"=>"#0", "field"=>"yinpin_geshi")
				,array("name"=>"视频格式", "format"=>"#0", "field"=>"shipin_geshi")
				,array("name"=>"图片格式", "format"=>"#0", "field"=>"tupian_geshi")
				,array("name"=>"文本格式", "format"=>"#0", "field"=>"wenben_geshi")
			))
			,array("group_name"=>"应用功能", "col"=>0, "height"=>"88", "icon"=>"app", "items"=>array(
				array("name"=>"预装软件", "format"=>"#0", "field"=>"fudai_software")
				,array("name"=>"应用扩展", "format"=>"#0", "field"=>"app_kuozhan")
			))
			,array("group_name"=>"按键接口", "col"=>1, "height"=>"88", "icon"=>"interface", "items"=>array(
				array("name"=>"USB", "format"=>"#0", "field"=>"usb")
				,array("name"=>"其他接口", "format"=>"#0", "field"=>"qita_jiekou")
				,array("name"=>"按钮", "format"=>"#0", "field"=>"anniu")
			))
			,array("group_name"=>"其它", "col"=>1, "height"=>"88", "icon"=>"other", "items"=>array(
				array("name"=>"续航时间", "format"=>"#0", "field"=>"gongzuo_time")
				,array("name"=>"电池类型", "format"=>"#0", "field"=>"dianchi_type")
				,array("name"=>"电源适配器", "format"=>"#0", "field"=>"dianyuan_adapter")
			))
		)
	)
	,"ssd" => array(
		"name"=>"固态硬盘"
		,"briefFields"=>array(
			array("name"=>"容量", "format"=>"#0GB", "field"=>"rongliang")
			,array("name"=>"接口类型", "format"=>"#0", "field"=>"jiekou_leixing")
			,array("name"=>"有无外壳", "format"=>"#0", "field"=>"waike")
		)
		,"hoverFields"=>array(
		)
		,"specFields"=>array(
			"cpu"=>""
			,"weight"=>""
			,"thickness"=>""
			,"ruiju"=>""
			,"widi"=>""
			,"ssd"=>"name"
		)
		,"paramDetailFields"=>array(
			array("group_name"=>"基本参数", "col"=>0, "height"=>"246", "icon"=>"basic", "items"=>array(
				array("name"=>"型号", "format"=>"#0", "field"=>"model")
				,array("name"=>"容量", "format"=>"#0GB", "field"=>"rongliang")
				,array("name"=>"硬盘容量", "format"=>"#0GB", "field"=>"disk_size")
				,array("name"=>"硬盘尺寸", "format"=>"#0", "field"=>"disk_chicun")
				,array("name"=>"接口类型", "format"=>"#0", "field"=>"jiekou_leixing")
				,array("name"=>"闪存类型", "format"=>"#0", "field"=>"flash_type")
				,array("name"=>"主控芯片", "format"=>"#0", "field"=>"main_chip")
				,array("name"=>"数据读取速度", "format"=>"#0MB/Sec", "field"=>"read_speed")
				,array("name"=>"数据写入速度", "format"=>"#0MB/Sec", "field"=>"write_speed")
			))
			,array("group_name"=>"其它", "col"=>1, "height"=>"246", "icon"=>"other", "items"=>array(
				array("name"=>"外壳", "format"=>"#0", "field"=>"waike")
			))
		)
	)
	,"cpu" => array(
		"name"=>"CPU"
		,"briefFields"=>array(
			array("name"=>"处理器", "format"=>"#0", "field"=>"model_type")//m_processor
			,array("name"=>"主频", "format"=>"#0GHz", "field"=>"main_frequency")
			,array("name"=>"集成显卡", "format"=>"#0", "field"=>"jixian_model")
		)
		,"hoverFields"=>array(
		)
		,"specFields"=>array(
			"cpu"=>"model_type"//m_processor
			,"weight"=>""
			,"thickness"=>""
			,"ruiju"=>""
			,"widi"=>""
			,"ssd"=>""
		)
		,"paramDetailFields"=>array(
			array("group_name"=>"主要参数", "col"=>0, "height"=>"268", "icon"=>"basic", "items"=>array(
				array("name"=>"型号", "format"=>"#0", "field"=>"model_type")
				,array("name"=>"芯片厂方", "format"=>"#0", "field"=>"brand_name")
				,array("name"=>"接口类型", "format"=>"#0", "field"=>"interface")
				,array("name"=>"核心类型", "format"=>"#0", "field"=>"core")
				,array("name"=>"生产工艺", "format"=>"#0纳米", "field"=>"production_technics")
				,array("name"=>"核心数量", "format"=>"#0", "field"=>"core_num")
				,array("name"=>"线程数", "format"=>"#0", "field"=>"thread_num")
				,array("name"=>"主频", "format"=>"#0GHz", "field"=>"main_frequency")
				,array("name"=>"Turbo Boost", "format"=>"#0", "field"=>"turbo_boost")
				,array("name"=>"三级缓存", "format"=>"#0", "field"=>"cache3")
			))
			,array("group_name"=>"功能参数", "col"=>1, "height"=>"268", "icon"=>"main", "items"=>array(
				array("name"=>"显示核心型号", "format"=>"#0", "field"=>"jixian_model")
				,array("name"=>"支持内存频率", "format"=>"#0", "field"=>"max_mem_frequency")
				,array("name"=>"超线程技术", "format"=>"#0", "field"=>"hyper_threading")
				,array("name"=>"64位处理器", "format"=>"#0", "field"=>"64bit")
			))
			,array("group_name"=>"其它", "col"=>0, "height"=>"120", "icon"=>"other", "items"=>array(
				array("name"=>"其他特性", "format"=>"#0", "field"=>"other_performance")
				,array("name"=>"属性关键字", "format"=>"#0", "field"=>"prop_keyword")
			))
		)
	)
	,"mainboard" => array(
		"name"=>"主板"
		,"briefFields"=>array(
			array("name"=>"处理器", "format"=>"#0", "field"=>"m_support_cpu")
			,array("name"=>"适用平台", "format"=>"#0GB", "field"=>"fit_model")
		)
		,"hoverFields"=>array(
		)
		,"specFields"=>array(
			"cpu"=>"m_support_cpu"
			,"outline"=>""
			,"tech"=>""
			,"ssd"=>""
		)
		,"paramDetailFields"=>array(
			array("group_name"=>"主要参数", "col"=>0, "height"=>"268", "icon"=>"basic", "items"=>array(
				array("name"=>"型号", "format"=>"#0", "field"=>"model")
				,array("name"=>"适用类型", "format"=>"#0", "field"=>"fit_model")
				,array("name"=>"芯片厂商", "format"=>"#0", "field"=>"brand_name")
				,array("name"=>"芯片组或北桥芯片", "format"=>"#0", "field"=>"chip_group")
				,array("name"=>"CPU插槽", "format"=>"#0", "field"=>"cpu_slot")
				,array("name"=>"支持CPU类型", "format"=>"#0", "field"=>"cpu_support")
				,array("name"=>"主板架构", "format"=>"#0", "field"=>"mainboard_structure")
				,array("name"=>"支持内存类型", "format"=>"#0", "field"=>"support_mem_type")
				,array("name"=>"支持通道模式", "format"=>"#0", "field"=>"support_channel_mode")
				,array("name"=>"内存插槽", "format"=>"#0", "field"=>"mem_slot_num")
				,array("name"=>"内存频率", "format"=>"#0", "field"=>"mem_frequency")
				,array("name"=>"最大支持内存", "format"=>"#0", "field"=>"max_mem")
			))
			,array("group_name"=>"板载芯片", "col"=>1, "height"=>"268", "icon"=>"main", "items"=>array(
				array("name"=>"集成显卡核心", "format"=>"#0", "field"=>"jixian")
				,array("name"=>"板载声卡", "format"=>"#0", "field"=>"neizhi_shengka")
				,array("name"=>"板载网卡", "format"=>"#0", "field"=>"neizhi_wangka")
			))
			,array("group_name"=>"扩展参数", "col"=>0, "height"=>"120", "icon"=>"interface", "items"=>array(
				array("name"=>"硬盘接口", "format"=>"#0", "field"=>"disk_interface")
				,array("name"=>"SATA III接口数", "format"=>"#0", "field"=>"sata_iii_num")
				,array("name"=>"磁盘阵列类型", "format"=>"#0", "field"=>"cipan_zhenlie_type")
				,array("name"=>"扩展插槽", "format"=>"#0", "field"=>"pci_slot")
				,array("name"=>"PCI插槽", "format"=>"#0", "field"=>"pci_num")
				,array("name"=>"扩展接口", "format"=>"#0", "field"=>"other_slot_num")
				,array("name"=>"USB接口数", "format"=>"#0", "field"=>"usb_num")
			))
			,array("group_name"=>"其它", "col"=>1, "height"=>"268", "icon"=>"other", "items"=>array(
				array("name"=>"电源回路", "format"=>"#0相电路", "field"=>"dianyuan_huilu")
				,array("name"=>"电源接口", "format"=>"#0", "field"=>"dianyuan_interface")
				,array("name"=>"外形尺寸", "format"=>"#0", "field"=>"waixing_chicun")
				,array("name"=>"附件", "format"=>"#0", "field"=>"attachment")
			))
		)
	)
	,"laptop" => array(
		"name"=>"笔记本电脑"
		,"briefFields"=>array(
			array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
			,array("name"=>"内存", "format"=>"#0GB", "field"=>"mem_rongliang")
			,array("name"=>"硬盘", "format"=>"#0GB #1", "field"=>array("disk_size","disk_type"))
			,array("name"=>"显卡", "format"=>"#0", "field"=>"xianka_type")
		)
		,"hoverFields"=>array(
			array("name"=>"屏幕尺寸", "format"=>"#0寸", "type"=>"screen", "field"=>"screen_size", "images"=>array(
																								"<12"=>"laptop_srn_1"
																								,"12-14"=>"laptop_srn_2"
																								,"14-17"=>"laptop_srn_3"
																								,">17"=>"laptop_srn_4"
			))
			,array("name"=>"厚度", "format"=>"#0mm", "type"=>"thickness", "field"=>"thickness", "images"=>array(
																								"<10"=>"laptop_thck_1"
																								,"10-30"=>"laptop_thck_2"
																								,"30-40"=>"laptop_thck_3"
																								,">40"=>"laptop_thck_4"
			))
			,array("name"=>"重量", "format"=>"#0kg", "type"=>"weight", "field"=>"weight", "images"=>array(
																								"<1"=>"laptop_wght_1"
																								,"1-2"=>"laptop_wght_2"
																								,"2-3"=>"laptop_wght_3"
																								,"3-4"=>"laptop_wght_4"
																								,">4"=>"laptop_wght_5"
			))
		)
		,"specFields"=>array(
			"cpu"=>"cpu_type"
			,"weight"=>"weight"
			,"thickness"=>""// "thickness"
			,"ruiju"=>""// "m_ruijuxianka"
			,"widi"=>"m_widi"
			,"ssd"=>"disk_type"
		)
		,"paramDetailFields"=>array(
			array("group_name"=>"基本参数", "col"=>0, "height"=>"268", "icon"=>"basic", "items"=>array(
				array("name"=>"型号别称", "format"=>"#0", "field"=>"model_alias")
				,array("name"=>"上市时间", "format"=>"#0", "field"=>"onsell_time")
				,array("name"=>"产品定位", "format"=>"#0", "field"=>"product_positioning")
				,array("name"=>"操作系统", "format"=>"#0", "field"=>"operating_system")
			))
			,array("group_name"=>"处理器", "col"=>1, "height"=>"120", "icon"=>"main", "items"=>array(
				array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
				,array("name"=>"核心/线程", "format"=>"#0", "field"=>"core_thread")
				,array("name"=>"核心架构", "format"=>"#0", "field"=>"core_framework")
				,array("name"=>"处理器类型", "format"=>"#0", "field"=>"cpu_type")
				,array("name"=>"处理器主频", "format"=>"#0GHz", "field"=>"cpu_frequency")
				,array("name"=>"加速技术", "format"=>"#0", "field"=>"jiasu_tech")
				,array("name"=>"二级缓存", "format"=>"#0", "field"=>"cache2")
				,array("name"=>"三级缓存", "format"=>"#0", "field"=>"cache3")
			))
			,array("group_name"=>"存储设备", "col"=>0, "height"=>"120", "icon"=>"storage", "items"=>array(
				array("name"=>"内存容量", "format"=>"#0GB", "field"=>"mem_rongliang")
				,array("name"=>"内存类型", "format"=>"#0", "field"=>"mem_type")
				,array("name"=>"硬盘类型", "format"=>"#0", "field"=>"disk_type")
				,array("name"=>"硬盘参数", "format"=>"#0", "field"=>"disk_param")
				,array("name"=>"硬盘容量", "format"=>"#0GB", "field"=>"disk_size")
			))
			,array("group_name"=>"显示屏", "col"=>1, "height"=>"120", "icon"=>"screen2", "items"=>array(
				array("name"=>"屏幕尺寸", "format"=>"#0英寸", "field"=>"screen_size")
				,array("name"=>"分辨率", "format"=>"#0", "field"=>"screen_ratio")
				,array("name"=>"显示屏描述", "format"=>"#0", "field"=>"xianshiping_char")
			))
			,array("group_name"=>"显卡", "col"=>0, "height"=>"120", "icon"=>"xianka", "items"=>array(
				array("name"=>"显卡类型", "format"=>"#0", "field"=>"xianka_type")
				,array("name"=>"显卡芯片", "format"=>"#0", "field"=>"xianka_chip")
				,array("name"=>"显存容量", "format"=>"#0", "field"=>"xiancun_rongliang")
				,array("name"=>"显存位宽", "format"=>"#0", "field"=>"xiancun_weikuan")
				,array("name"=>"显存类型", "format"=>"#0", "field"=>"xiancun_leixing")
				,array("name"=>"流处理器数量", "format"=>"#0", "field"=>"liuchuliqi_num")
				,array("name"=>"显卡性能", "format"=>"#0", "field"=>"xianka_texing")
			))
			,array("group_name"=>"媒体设备", "col"=>1, "height"=>"120", "icon"=>"media", "items"=>array(
				array("name"=>"摄像头", "format"=>"#0", "field"=>"shexiangtou")
				,array("name"=>"扬声器", "format"=>"#0", "field"=>"yinxiang")
				,array("name"=>"音频系统", "format"=>"#0", "field"=>"yinpin_sys")
			))
			,array("group_name"=>"通讯", "col"=>0, "height"=>"120", "icon"=>"network", "items"=>array(
				array("name"=>"无线通讯", "format"=>"#0", "field"=>"wuxian_tongxun")
				,array("name"=>"网卡", "format"=>"#0", "field"=>"wangka")
			))
			,array("group_name"=>"输入输出", "col"=>1, "height"=>"120", "icon"=>"interface", "items"=>array(
				array("name"=>"输入设备", "format"=>"#0", "field"=>"shurushebei")
				,array("name"=>"USB", "format"=>"#0", "field"=>"usb")
				,array("name"=>"读卡器", "format"=>"#0", "field"=>"dukaqi")
				,array("name"=>"其它接口", "format"=>"#0", "field"=>"qitajiekou")
			))
			,array("group_name"=>"规格定位", "col"=>0, "height"=>"120", "icon"=>"doc", "items"=>array(
				array("name"=>"电源类型", "format"=>"#0", "field"=>"dianchi_type")
				,array("name"=>"电源适配器", "format"=>"#0", "field"=>"dianyuan_adapter")
				,array("name"=>"续航时间", "format"=>"#0", "field"=>"xuhang_time")
				,array("name"=>"规格", "format"=>"#0", "field"=>"spec")
				,array("name"=>"厚度", "format"=>"#0", "field"=>"thickness")
				,array("name"=>"重量", "format"=>"#0", "field"=>"weight")
				,array("name"=>"外观外壳", "format"=>"#0", "field"=>"waike")
			))
			,array("group_name"=>"其它", "col"=>1, "height"=>"120", "icon"=>"other", "items"=>array(
				array("name"=>"附带软件", "format"=>"#0", "field"=>"fudai_software")
				,array("name"=>"配件", "format"=>"#0", "field"=>"peijian")
			))
		)
	)
	,"desktop" => array(
		"name"=>"台式机"
		,"briefFields"=>array(
			array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
			,array("name"=>"内存", "format"=>"#0GB", "field"=>"mem_daxiao")
			,array("name"=>"硬盘", "format"=>"#0GB #1", "field"=>array("disk_size","disk_type"))
			,array("name"=>"显卡", "format"=>"#0", "field"=>"xianka_type")
		)
		,"hoverFields"=> array()
		// array(
		// 	array("name"=>"屏幕尺寸", "format"=>"#0寸", "type"=>"screen", "field"=>"xianshiqi_size", "images"=>array(
		// 																						"<17"=>"desktop_srn_1"
		// 																						,"17-20"=>"desktop_srn_2"
		// 																						,"20-27"=>"desktop_srn_3"
		// 																						,">27"=>"desktop_srn_3"
		// 	))
		// 	,array("name"=>"厚度", "format"=>"#0mm", "type"=>"thickness", "field"=>"", "images"=>array(
		// 																						"*"=>"desktop_thck_1"
		// 	))
		// 	,array("name"=>"重量", "format"=>"#0kg", "type"=>"weight", "field"=>"", "images"=>array(
		// 																						"*"=>"desktop_wght_1"
		// 	))
		// )
		,"specFields"=>array(
			"cpu"=>"cpu_type"
			,"weight"=>""
			,"thickness"=>""
			,"ruiju"=>""
			,"widi"=>""
			,"ssd"=>"disk_type"
		)
		,"paramDetailFields"=>array(
			array("group_name"=>"基本参数", "col"=>0, "height"=>"268", "icon"=>"basic", "items"=>array(
				array("name"=>"型号", "format"=>"#0", "field"=>"model")
				,array("name"=>"类型", "format"=>"#0", "field"=>"leixing")
				,array("name"=>"操作系统", "format"=>"#0", "field"=>"operating_system")
				,array("name"=>"显示器", "format"=>"#0", "field"=>"xianshiqi_type")
				,array("name"=>"尺寸", "format"=>"#0英寸", "field"=>"xianshiqi_size")
				,array("name"=>"分辨率", "format"=>"#0", "field"=>"xianshiqi_xingneng")
			))
			,array("group_name"=>"处理器", "col"=>1, "height"=>"268", "icon"=>"main", "items"=>array(
				array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
				,array("name"=>"处理器类型", "format"=>"#0", "field"=>"cpu_type")
				,array("name"=>"处理器频率", "format"=>"#0", "field"=>"cpu_frequency")
				,array("name"=>"三级缓存", "format"=>"#0", "field"=>"cache3")
			))
			,array("group_name"=>"硬件参数", "col"=>0, "height"=>"268", "icon"=>"storage", "items"=>array(
				array("name"=>"内存类型", "format"=>"#0", "field"=>"mem_type")
				,array("name"=>"内存大小", "format"=>"#0GB", "field"=>"mem_daxiao")
				,array("name"=>"硬盘类型", "format"=>"#0", "field"=>"disk_type")
				,array("name"=>"硬盘参数", "format"=>"#0", "field"=>"disk_param")
				,array("name"=>"硬盘容量", "format"=>"#0", "field"=>"disk_size")
				,array("name"=>"光驱", "format"=>"#0", "field"=>"cd_drive_type")
				,array("name"=>"光驱描述", "format"=>"#0", "field"=>"cd_drive_speed")
				,array("name"=>"显卡类型", "format"=>"#0", "field"=>"xianka_type")
				,array("name"=>"显卡芯片", "format"=>"#0", "field"=>"xianshika_type")
			))
			,array("group_name"=>"通讯", "col"=>1, "height"=>"268", "icon"=>"network", "items"=>array(
				array("name"=>"网卡", "format"=>"#0", "field"=>"wangka")
			))
			,array("group_name"=>"其他硬件", "col"=>0, "height"=>"268", "icon"=>"interface", "items"=>array(
				array("name"=>"声卡", "format"=>"#0", "field"=>"shengka")
				,array("name"=>"读卡器", "format"=>"#0", "field"=>"dukaqi")
				,array("name"=>"接口 USB接口", "format"=>"#0", "field"=>"interface")
				,array("name"=>"音频接口", "format"=>"#0", "field"=>"")
				,array("name"=>"视频接口", "format"=>"#0", "field"=>"")
				,array("name"=>"网络接口", "format"=>"#0", "field"=>"")
				,array("name"=>"键盘/鼠标", "format"=>"#0", "field"=>"keyboard")
				,array("name"=>"机箱重量", "format"=>"约#0kg", "field"=>"jixiang_weight")
			))
			,array("group_name"=>"媒体设备", "col"=>1, "height"=>"268", "icon"=>"media", "items"=>array(
				array("name"=>"摄像头", "format"=>"#0", "field"=>"")
				,array("name"=>"扬声器", "format"=>"#0", "field"=>"shengka")
				,array("name"=>"音频系统", "format"=>"#0", "field"=>"")
			))
		)
	)
	,"aio" => array(
		"name"=>"一体机"
		,"briefFields"=>array(
			array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
			,array("name"=>"内存", "format"=>"#0GB", "field"=>"mem_rongliang")
			,array("name"=>"硬盘", "format"=>"#0GB #1", "field"=>array("disk_size","disk_type"))
			,array("name"=>"显卡", "format"=>"#0", "field"=>"xianka_type")
		)
		,"hoverFields"=> array()
		// array(
		// 	array("name"=>"屏幕尺寸", "format"=>"#0寸", "type"=>"screen", "field"=>"screen_size", "images"=>array(
		// 																						"<17"=>"aio_srn_1"
		// 																						,"17-19"=>"aio_srn_2"
		// 																						,"19-22"=>"aio_srn_3"
		// 																						,"22-24"=>"aio_srn_4"
		// 																						,">27"=>"aio_srn_5"
		// 	))
		// 	,array("name"=>"厚度", "format"=>"#0mm", "type"=>"thickness", "field"=>"", "images"=>array(
		// 																						"*"=>"aio_thck_1"
		// 	))
		// 	,array("name"=>"重量", "format"=>"#0kg", "type"=>"weight", "field"=>"weight", "images"=>array(
		// 																						"*"=>"aio_wght_1"
		// 	))
		// )
		,"specFields"=>array(
			"cpu"=>"cpu_type"
			,"weight"=>""
			,"thickness"=>""
			,"ruiju"=>""
			,"widi"=>""
			,"ssd"=>"disk_type"
		)
		,"paramDetailFields"=>array(
			array("group_name"=>"基本参数", "col"=>0, "height"=>"246", "icon"=>"basic", "items"=>array(
				array("name"=>"型号", "format"=>"#0", "field"=>"model")
				,array("name"=>"显示屏尺寸", "format"=>"#0英寸", "field"=>"screen_size")
				,array("name"=>"屏幕描述", "format"=>"#0", "field"=>"screen_desk")//m_usage
				,array("name"=>"分辨率", "format"=>"#0", "field"=>"screen_ratio")
				,array("name"=>"预装系统", "format"=>"#0", "field"=>"operating_system")
				,array("name"=>"产品类型", "format"=>"#0", "field"=>"product_type")
			))
			,array("group_name"=>"处理器", "col"=>1, "height"=>"246", "icon"=>"main", "items"=>array(
				array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
				,array("name"=>"处理器类型", "format"=>"#0", "field"=>"cpu_type")
				,array("name"=>"处理器频率", "format"=>"#0GHz", "field"=>"cpu_frequency")//m_usage
				,array("name"=>"二级缓存", "format"=>"#0", "field"=>"cache2")
				,array("name"=>"三级缓存", "format"=>"#0", "field"=>"cache3")
			))
			,array("group_name"=>"硬件参数", "col"=>0, "height"=>"246", "icon"=>"xianka", "items"=>array(
				array("name"=>"内存容量", "format"=>"#0", "field"=>"mem_rongliang")
				,array("name"=>"内存类型", "format"=>"#0", "field"=>"mem_type")
				,array("name"=>"硬盘类型", "format"=>"#0", "field"=>"disk_type")//m_usage
				,array("name"=>"硬盘容量", "format"=>"#0", "field"=>"disk_size")
				,array("name"=>"显卡类型", "format"=>"#0", "field"=>"xianka_type")
				,array("name"=>"显卡芯片", "format"=>"#0", "field"=>"xianka_chip")
				,array("name"=>"显存容量", "format"=>"#0", "field"=>"xiancun_rongliang")
			))
			,array("group_name"=>"通讯", "col"=>1, "height"=>"246", "icon"=>"network", "items"=>array(
				array("name"=>"无线网卡", "format"=>"#0", "field"=>"wuxian_tongxun")
			))
			,array("group_name"=>"媒体设备", "col"=>0, "height"=>"246", "icon"=>"media", "items"=>array(
				array("name"=>"声卡", "format"=>"#0", "field"=>"shengka")
				,array("name"=>"扬声器", "format"=>"#0", "field"=>"neizhi_yangshengqi")
				,array("name"=>"摄像头", "format"=>"#0", "field"=>"neizhi_shexiangtou")
			))
			,array("group_name"=>"其它", "col"=>1, "height"=>"246", "icon"=>"other", "items"=>array(
				array("name"=>"读卡器", "format"=>"#0", "field"=>"dukaqi")
				,array("name"=>"外部接口", "format"=>"#0", "field"=>"waibu_jiekou")
				,array("name"=>"键盘/鼠标", "format"=>"#0", "field"=>"jianshu")//m_usage
				,array("name"=>"其它性能", "format"=>"#0", "field"=>"qita_xingneng")
				,array("name"=>"附带软件", "format"=>"#0", "field"=>"fudai_software")
				,array("name"=>"售后服务", "format"=>"#0", "field"=>"shouhou")
			))
		)
	)
	,"smart-phone" => array(
		"name"=>"智能手机"
		,"briefFields"=>array(
			array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
			,array("name"=>"屏幕尺寸", "format"=>"#0英寸", "field"=>"mainscreen_size")
			,array("name"=>"重量", "format"=>"约#0", "field"=>"weight")
			,array("name"=>"厚度", "format"=>"#0", "field"=>"thickness")
		)
		,"hoverFields"=>array(
			array("name"=>"屏幕尺寸", "format"=>"#0寸", "type"=>"screen", "field"=>"mainscreen_size", "images"=>array(
																								"<3"=>"smart-phone_srn_1"
																								,"3-4"=>"smart-phone_srn_2"
																								,"4-5"=>"smart-phone_srn_3"
																								,">5"=>"smart-phone_srn_4"
			))
			,array("name"=>"厚度", "format"=>"#0mm", "type"=>"thickness", "field"=>"thickness", "images"=>array(
																								"<9"=>"smart-phone_thck_1"
																								,">9"=>"smart-phone_thck_2"
			))
			,array("name"=>"重量", "format"=>"#0kg", "type"=>"weight", "field"=>"weight", "images"=>array(
																								"*"=>"smart-phone_wght_1"
			))
		)
		,"specFields"=>array(
			"cpu"=>"cpu"
			,"weight"=>"weight"
			,"thickness"=>""// "thickness"
			,"ruiju"=>""
			,"widi"=>""
			,"ssd"=>""
		)
		,"paramDetailFields"=>array(
			array("group_name"=>"基本参数", "col"=>0, "height"=>"246", "icon"=>"basic", "items"=>array(
				array("name"=>"型号别称", "format"=>"#0", "field"=>"model")
				,array("name"=>"手机类型", "format"=>"#0", "field"=>"mobile_type")
				,array("name"=>"上市时间", "format"=>"#0年", "field"=>"onsell_time")
			))
			,array("group_name"=>"网络支持", "col"=>1, "height"=>"246", "icon"=>"network2", "items"=>array(
				array("name"=>"2G/3G网络", "format"=>"#0", "field"=>"2g_3g")
				,array("name"=>"手机频段", "format"=>"#0", "field"=>"mobile_pinduan")
			))
			,array("group_name"=>"屏幕", "col"=>0, "height"=>"246", "icon"=>"screen", "items"=>array(
				array("name"=>"主屏尺寸", "format"=>"#0英寸", "field"=>"mainscreen_size")
				,array("name"=>"屏幕分辨率", "format"=>"#0", "field"=>"screen_ratio")
				,array("name"=>"屏幕技术/材质", "format"=>"#0", "field"=>"screen_caizhi")//m_usage
				,array("name"=>"主屏色彩", "format"=>"#0", "field"=>"screen_secai")
				,array("name"=>"触摸屏", "format"=>"#0", "field"=>"chumo")
			))
			,array("group_name"=>"硬件参数", "col"=>1, "height"=>"246", "icon"=>"storage", "items"=>array(
				array("name"=>"系统", "format"=>"#0", "field"=>"system")
				,array("name"=>"电池容量", "format"=>"#0", "field"=>"dianchi_spec")
				,array("name"=>"CPU品牌", "format"=>"#0", "field"=>"cpu_brand")//m_usage
				,array("name"=>"CPU", "format"=>"#0", "field"=>"cpu")
				,array("name"=>"运行内存", "format"=>"#0", "field"=>"mem_runtime")
				,array("name"=>"内置容量", "format"=>"#0", "field"=>"neizhi_rongliang")
				,array("name"=>"扩展卡", "format"=>"#0", "field"=>"kuozhanka")
				,array("name"=>"其他特性", "format"=>"#0", "field"=>"qita_texing")
			))
			,array("group_name"=>"拍照功能", "col"=>0, "height"=>"246", "icon"=>"camera", "items"=>array(
				array("name"=>"后置摄像头", "format"=>"#0万像素", "field"=>"houzhi_shexiangtou")
				,array("name"=>"前置摄像头", "format"=>"#0", "field"=>"qianzhi_shexiangtou")
				,array("name"=>"传感器类型", "format"=>"#0", "field"=>"chuanganqi_type")//m_usage
				,array("name"=>"闪光灯", "format"=>"#0", "field"=>"shanguangdeng")
				,array("name"=>"照片质量", "format"=>"#0", "field"=>"zhaopian_zhiliang")
				,array("name"=>"拍摄特色", "format"=>"#0", "field"=>"bianjiao_mode")
				,array("name"=>"数码变焦", "format"=>"#0", "field"=>"shuma_bianjiao")
				,array("name"=>"视频拍摄", "format"=>"#0", "field"=>"shipin_paishe")
			))
			,array("group_name"=>"外观", "col"=>1, "height"=>"246", "icon"=>"appearance", "items"=>array(
				array("name"=>"手机外形", "format"=>"#0", "field"=>"shouji_waixing")
				,array("name"=>"外壳颜色", "format"=>"#0", "field"=>"waike_yanse")
				,array("name"=>"尺寸", "format"=>"#0", "field"=>"tiji")//m_usage
				,array("name"=>"重量", "format"=>"#0", "field"=>"weight")
				,array("name"=>"标准配置", "format"=>"#0", "field"=>"biaozhun_peizhi")
				,array("name"=>"机身特点", "format"=>"#0", "field"=>"jishen_tedian")
			))
			,array("group_name"=>"数据应用功能", "col"=>0, "height"=>"246", "icon"=>"communication", "items"=>array(
				array("name"=>"蓝牙", "format"=>"#0", "field"=>"lanya")
				,array("name"=>"数据业务", "format"=>"#0", "field"=>"shujuyewu")
				,array("name"=>"数据线", "format"=>"#0", "field"=>"shujuxian")//m_usage
				,array("name"=>"GPS定位系统", "format"=>"#0", "field"=>"gps")
			))
			,array("group_name"=>"基本功能", "col"=>1, "height"=>"246", "icon"=>"network", "items"=>array(
				array("name"=>"通讯录", "format"=>"#0", "field"=>"tongxunlu")
				,array("name"=>"信息功能", "format"=>"#0", "field"=>"xinxigongneng")
				,array("name"=>"输入法", "format"=>"#0", "field"=>"shurufa")//m_usage
				,array("name"=>"主要功能", "format"=>"#0", "field"=>"zhuyao_gongneng")
				,array("name"=>"附加功能", "format"=>"#0", "field"=>"fujia_gongneng")
			))
			,array("group_name"=>"多媒体娱乐功能", "col"=>0, "height"=>"246", "icon"=>"game", "items"=>array(
				array("name"=>"多媒体", "format"=>"#0", "field"=>"duomeiti")
				,array("name"=>"MP3播放器", "format"=>"#0", "field"=>"mp3_player")
				,array("name"=>"视频播放", "format"=>"#0", "field"=>"shipin_play")//m_usage
				,array("name"=>"图形浏览", "format"=>"#0", "field"=>"tuxing_liulan")
			))
		)
	)
	,"2in1" => array(
		"name"=>"2合1电脑"
		,"briefFields"=>array(
			array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
			,array("name"=>"内存", "format"=>"#0GB", "field"=>"memory_size")
			,array("name"=>"硬盘", "format"=>"#0GB #1", "field"=>array("harddisc_size","harddist_type"))
			,array("name"=>"显卡", "format"=>"#0", "field"=>"xianka_type")
		)
		,"hoverFields"=>array(
			array("name"=>"屏幕尺寸", "format"=>"#0寸", "type"=>"screen", "field"=>"screen_size", "images"=>array(
																								"<10"=>"2in1_srn_1"
																								,"10-13"=>"2in1_srn_2"
																								,"13-14.1"=>"2in1_srn_3"
																								,">15"=>"2in1_srn_4"
			))
			,array("name"=>"厚度", "format"=>"#0mm", "type"=>"thickness", "field"=>"thickness", "images"=>array(
																								"<16"=>"2in1_thck_1"
																								,"16-18"=>"2in1_thck_2"
																								,"18-20"=>"2in1_thck_3"
																								,"20-23"=>"2in1_thck_4"
																								,">23"=>"2in1_thck_5"
			))
			,array("name"=>"重量", "format"=>"#0kg", "type"=>"weight", "field"=>"weight", "images"=>array(
																								"<0.8"=>"2in1_wght_1"
																								,"0.8-1.3"=>"2in1_wght_2"
																								,"1.3-1.7"=>"2in1_wght_3"
																								,">1.7"=>"2in1_wght_4"
			))
		)
		,"specFields"=>array(
			"cpu"=>"cpu"
			,"weight"=>"weight"
			,"thickness"=>"thickness"
			,"ruiju"=>"tech"
			,"widi"=>"tech"
			,"ssd"=>"harddist_type"
		)
		,"paramDetailFields"=>array(
			array("group_name"=>"基本参数", "col"=>0, "height"=>"246", "icon"=>"basic", "items"=>array(
				array("name"=>"型号别称", "format"=>"#0", "field"=>"model")
				,array("name"=>"上市时间", "format"=>"#0", "field"=>"onsale_time")
				,array("name"=>"产品定位", "format"=>"#0", "field"=>"product_dingwei")//m_usage
				,array("name"=>"超级本定位", "format"=>"#0", "field"=>"ultrabook_dingwei")
				,array("name"=>"操作系统", "format"=>"#0", "field"=>"operating_system")
			))
			,array("group_name"=>"处理器", "col"=>1, "height"=>"246", "icon"=>"main", "items"=>array(
				array("name"=>"处理器", "format"=>"#0", "field"=>"cpu")
				,array("name"=>"线程/核心", "format"=>"#0", "field"=>"core_thread")
				,array("name"=>"核心架构", "format"=>"#0", "field"=>"core_jiagou")//m_usage
				,array("name"=>"处理器类型", "format"=>"#0", "field"=>"cpu_type")
				,array("name"=>"处理器主频", "format"=>"#0GHz", "field"=>"cpu_zhupin")
				,array("name"=>"加速技术", "format"=>"#0", "field"=>"jiasu_jishu")
				,array("name"=>"二级缓存", "format"=>"#0", "field"=>"cache2")
				,array("name"=>"三级缓存", "format"=>"#0", "field"=>"cache3")
			))
			,array("group_name"=>"显示卡", "col"=>0, "height"=>"246", "icon"=>"xianka", "items"=>array(
				array("name"=>"显卡类型", "format"=>"#0", "field"=>"xianka_type")
				,array("name"=>"显卡芯片", "format"=>"#0", "field"=>"xianka_chip")
				,array("name"=>"显存容量", "format"=>"#0", "field"=>"xianka_rongliang")//m_usage
				,array("name"=>"显存类型", "format"=>"#0", "field"=>"xiancun_leixing")
				,array("name"=>"显卡性能", "format"=>"#0", "field"=>"xianka_xingneng")
			))
			,array("group_name"=>"显示屏", "col"=>1, "height"=>"246", "icon"=>"screen3", "items"=>array(
				array("name"=>"屏幕尺寸", "format"=>"#0英寸", "field"=>"screen_size")
				,array("name"=>"分辨率", "format"=>"#0", "field"=>"screen_radio")
				,array("name"=>"屏幕类型", "format"=>"#0", "field"=>"screen_leixing")//m_usage
				,array("name"=>"显示屏描述", "format"=>"#0", "field"=>"screen_spec")
			))
			,array("group_name"=>"存储设备", "col"=>0, "height"=>"246", "icon"=>"storage", "items"=>array(
				array("name"=>"内存容量", "format"=>"#0", "field"=>"neicun_daxiao")
				,array("name"=>"内存类型", "format"=>"#0", "field"=>"neicun_type")
				,array("name"=>"最大支持内存", "format"=>"#0", "field"=>"neicun_max")//m_usage
				,array("name"=>"硬盘类型", "format"=>"#0", "field"=>"harddist_type")
				,array("name"=>"硬盘容量", "format"=>"#0GB", "field"=>"harddisc_size")
				,array("name"=>"光驱类型", "format"=>"#0", "field"=>"cddrive_type")
			))
			,array("group_name"=>"媒体设备", "col"=>1, "height"=>"246", "icon"=>"setting", "items"=>array(
				array("name"=>"摄像头", "format"=>"#0", "field"=>"shexiangtou")
				,array("name"=>"扬声器", "format"=>"#0", "field"=>"yangshengqi")
				,array("name"=>"音频系统", "format"=>"#0", "field"=>"yinpin_sys")
			))
			,array("group_name"=>"规格定位", "col"=>0, "height"=>"246", "icon"=>"pin", "items"=>array(
				array("name"=>"电池类型", "format"=>"#0", "field"=>"dianchi_type")
				,array("name"=>"电源适配器", "format"=>"#0", "field"=>"dianyuan_adapter")
				,array("name"=>"续航时间", "format"=>"#0", "field"=>"xuhang")//m_usage
				,array("name"=>"规格", "format"=>"#0", "field"=>"guige")
				,array("name"=>"厚度", "format"=>"#0mm", "field"=>"thickness")
				,array("name"=>"重量", "format"=>"约#0kg", "field"=>"weight")
				,array("name"=>"外壳外观", "format"=>"#0", "field"=>"waike")
			))
			,array("group_name"=>"通讯", "col"=>1, "height"=>"246", "icon"=>"network", "items"=>array(
				array("name"=>"无线通讯", "format"=>"#0", "field"=>"wuxian_tongxun")
			))
			,array("group_name"=>"其它", "col"=>1, "height"=>"246", "icon"=>"other", "items"=>array(
				array("name"=>"附带软件", "format"=>"#0", "field"=>"fudai_ruanjian")
				,array("name"=>"配件", "format"=>"#0", "field"=>"peijian")
			))
		)
	)
);