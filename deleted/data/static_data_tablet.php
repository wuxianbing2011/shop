<?php
$tableName = "products_tablet";
$numOfFirstFilterGroup = 2;
$usageModule = array(
	"双系统变换"=>array("name"=>"双系统变换", "description"=>"支持Windows /Android双操作系统, 无与伦比的灵活操控体验！")
	, "通话平板"=>array("name"=>"通话平板", "description"=>"通话电脑随身带，联络使用更方便！")
	, "缤纷平板"=>array("name"=>"缤纷平板", "description"=>"绚丽的色彩，彰显你的个性！")
	, "旅行必备"=>array("name"=>"旅行必备", "description"=>"小巧便携，行车旅行不迷路，尽享无忧旅行。")
	, "高清视频"=>array("name"=>"高清视频", "description"=>"精彩美剧，高清大片，极速流畅不NG，移动影院随身带。")
	, "办公助手"=>array("name"=>"办公助手", "description"=>"在Windows系统平板上流畅进行Office 文档操作、快捷电子邮件收发，将效率进行到底。")
	, "单手掌控"=>array("name"=>"单手掌控", "description"=>"单手掌控掌上世界，上下班的路途中也能尽享影音娱乐。")
	, "游戏性能"=>array("name"=>"游戏性能", "description"=>"清晰画质让细节成为游戏的主角，不卡不down机，游戏画面更加生动。")
	, "送家人"=>array("name"=>"送家人", "description"=>"摄像，听歌，看电影，功能齐全，给家里人带来欢乐。")
);

$hotProducts = array(
	array("name"=>"Cube i7手写版", "logo"=>"logo_CUBE.png", "screen_size"=>"10.6", "cpu"=>"Intel Core-M", "price"=>1999 , "form_factor"=>"插拔", "desc"=>"电磁屏平板电脑，前黑后蓝。", "url"=>"tablet/detail.php?id=592308", "url2"=>"http://item.jd.com/1610471.html")
	,array("name"=>"Onda V919 3G", "logo"=>"logo_ONDA.png", "screen_size"=>"9.7", "cpu"=>"Intel Atom Z3736F", "price"=>1199 , "form_factor"=>"插拔", "desc"=>"办公娱乐二合一，清晰画质，全金属机身。", "url"=>"tablet/detail.php?id=581372", "url2"=>"http://item.jd.com/1596487403.html")
	,array("name"=>"Lenovo S8-50", "logo"=>"logo_Lenovo.png", "screen_size"=>"8", "cpu"=>"Intel Atom Z3745", "price"=>1099 , "form_factor"=>"翻转", "desc"=>"全高清屏，一手掌握，三种颜色可供选择。", "url"=>"tablet/detail.php?id=575205", "url2"=>"http://item.jd.com/1353192.html")
	,array("name"=>"Dell Venue 8 7000", "logo"=>"logo_Dell.png", "screen_size"=>"8.4", "cpu"=>"Intel Atom Z3580", "price"=>3299, "form_factor"=>"翻转", "desc"=>"超薄平板电脑，3D摄像头。", "url"=>"tablet/detail.php?id=575827", "url2"=>"item.jd.com/1489256021.html")
	,array("name"=>"Cube i8 Core M", "logo"=>"logo_CUBE.png", "screen_size"=>"8", "cpu"=>"Intel Atom Z3735E", "price"=>488 , "form_factor"=>"翻转", "desc"=>"双系统，前黑后白，全视角高清显示屏。", "url"=>"tablet/detail.php?id=570655", "url2"=>"http://item.jd.com/1340203.html")
	//,array("name"=>"联想 Lenovo miix2 8", "logo"=>"logo_Lenovo.png", "screen_size"=>"11.6", "cpu"=>"Intel Atom Z3735E", "price"=>2499 , "form_factor"=>"插拔", "desc"=>"四核超速运转，轻松办公，超长7小时待机时间。", "url"=>"http://item.jd.com/1010747.html")
	//,array("name"=>"华硕  Asus FE375", "logo"=>"logo_ASUS.png", "screen_size"=>"11.6", "cpu"=>"Intel Atom Z3560", "price"=>"暂无" , "form_factor"=>"插拔", "desc"=>"3G上网，GPS导航，多点触控，电容式触摸屏。", "url"=>"javascript:void 0;")
	//,array("name"=>"台电 Teclast X89HD", "logo"=>"logo_Teclast.png", "screen_size"=>"12.5", "cpu"=>"Intel Atom Z3735D", "price"=>1099 , "form_factor"=>"翻转", "desc"=>"极限清晰，细腻多彩，轻松畅玩双平台。", "url"=>"http://item.jd.com/1176529.html")
);

 $filterNames = array(
	"m_brand"=>"品牌"
	, "price"=>"价格"
	, "m_cpu"=>"处理器"
	, "screen_size"=>"屏幕尺寸"
	, "weight"=>"重量"
	, "m_thickness"=>"厚度"
	, "disk_size"=>"存储空间"
	, "m_retina"=>"是否高清屏"
	, "m_system"=>"操作系统"
	, "cunchu_kuozhan"=>"支持接口"
	, "m_waike_color"=>"外壳材质及颜色"
);
$filterData = array(
	"m_brand"=>array("type"=>"single", "items"=>array("驰为", "东芝", "华硕", "原道", "台电", "宏碁", "富士通", "惠普", "戴尔", "昂达", "海尔", "爱国者", "联想", "酷比魔方"))
	, "price"=>array("type"=>"range", "items"=>array("<1000"=>"1000元以下","1000-1999"=>"1000-1999元","2000-2999"=>"2000-2999元","3000-3999"=>"3000-3999元","4000-4999"=>"4000-4999元","5000-5999"=>"5000-5999元",">6000"=>"6000元以上"))
	, "m_cpu"=>array("type"=>"single", "items"=>array("英特尔凌动处理器Z3000系列", "英特尔凌动处理器Z2000系列", "其他"))
	, "screen_size"=>array("type"=>"range", "items"=>array("<7"=>"7寸以内","7-7.9"=>"7-7.9寸","8-8.9"=>"8-8.9寸","9-10.7"=>"9-10.7寸"))
	, "weight"=>array("type"=>"range", "items"=>array("200-399"=>"200-399g","400-599"=>"400-599g","600-699"=>"600-699g",">700"=>"700g以上"))
	, "m_thickness"=>array("type"=>"range", "items"=>array("6-7.95"=>"6-7.95mm","8-8.95"=>"8-8.95mm","9-9.9"=>"9-9.9mm","10-10.95"=>"10-10.95mm","11-12"=>"11-12mm"))
	, "disk_size"=>array("type"=>"single", "items"=>array("8", "16", "32", "64", "128"))
	, "m_retina"=>array("type"=>"single", "items"=>array("高清屏"))//, "非高清屏"
	, "m_system"=>array("type"=>"single", "items"=>array("Android", "Windows"))
	, "cunchu_kuozhan"=>array("type"=>"single", "items"=>array("microSD卡", "microSD卡+HDMI接口", "HDMI接口", "microSD卡+SIM卡槽", "microSD卡+SIM卡槽+HDMI接口", "其他"))
	, "m_waike_color"=>array("type"=>"like", "items"=>array("金属", "复合材料", "白色", "其他"))
);