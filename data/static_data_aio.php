<?php
$tableName = "products_allin1";
$numOfFirstFilterGroup = 3;
$usageModule = array(
	"智慧家居"=>array("name"=>"智慧家居", "description"=>"居家舒适之选，超凡视听，新潮娱乐完美家居搭档。")
	, "性能超群"=>array("name"=>"性能超群", "description"=>"强悍性能，响应超迅捷，卓越满足你想象。")
	, "游戏专属"=>array("name"=>"游戏专属", "description"=>"游戏专属精品，为玩家带来趣味横生的体验, 不容错过！")
	, "影音全能"=>array("name"=>"影音全能", "description"=>"清晰影音娱乐，精心打造专业家庭影院试听环境，居家舒适之选。")
	, "高性价比"=>array("name"=>"高性价比", "description"=>"主流价位同时具备极致性能")
	, "触控一体"=>array("name"=>"触控一体", "description"=>"享受触控的乐趣，用手指进行办公、娱乐、游戏，直观的人机交互体验。")
	, "开学利器"=>array("name"=>"开学利器", "description"=>"避免桌面的杂乱无章,最大程度节省成本节约空间。")
	, "商务甄选"=>array("name"=>"商务甄选", "description"=>"专为商务打造的一体机设备采用创新设计，并具备卓越的性能和稳定性，企业环境不可或缺。")
);

$hotProducts = array(
	array("name"=>"Lenovo HORIZON 2e", "logo"=>"logo_Lenovo.png", "screen_size"=>"21.5", "cpu"=>"Intel Core i3-4030U", "price"=>4999 , "form_factor"=>"插拔", "desc"=>"智能桌面，全高清多点触控，支持多人互动。","url"=>"aio/detail.php?id=575694", "url2"=>"http://item.jd.com/1604672218.html")
	,array("name"=>"Acer AZ3615-N81", "logo"=>"logo_Acer.png", "screen_size"=>"23", "cpu"=>"Intel Core i3 4130T", "price"=>4699 , "form_factor"=>"翻转", "desc"=>"1G独显，DVD刻录，IPS显示屏。", "url"=>"aio/detail.php?id=580015", "url2"=>"http://item.jd.com/1183250.html")
	,array("name"=>"联想 B5040", "logo"=>"logo_Lenovo.png", "screen_size"=>"23", "cpu"=>"Intel Core i5 4460T", "price"=>5999 , "form_factor"=>"插拔", "desc"=>"专业游戏一体机，军规游戏四级主板。", "url"=>"aio/detail.php?id=579972","url2"=>"http://item.jd.com/1493001589.html")
	,array("name"=>"联想 IdeaCentre Horizon2e", "logo"=>"logo_Lenovo.png", "screen_size"=>"21.5", "cpu"=>"Intel Core i3 4005U", "price"=>4149 , "form_factor"=>"插拔", "desc"=>"21.5英寸全高清多点触控屏。", "url"=>"aio/detail.php?id=575694","url2"=>"http://item.jd.com/1501198282.html")
);

$filterNames = array(
	"m_brand"=>"品牌"
	, "price"=>"价格"
	, "cpu_type"=>"处理器"
	, "screen_size"=>"屏幕尺寸"
	, "mem_rongliang"=>"内存"
	, "disk_type"=>"硬盘"
	, "xianka_type"=>"显卡"
	, "m_is_touchable"=>"是否支持触屏"
	//, "m_tech"=>"英特尔技术"
	, "operating_system"=>"操作系统"
	, "m_wuxianwangka"=>"是否内置无线网卡"
	, "m_support_interface"=>"支持接口类型"
	, "disk_size"=>"存储空间"
	, "m_retina"=>"高清屏"
	, "m_cd_drive"=>"光驱"
);
$filterData = array(
	"m_brand"=>array("type"=>"single", "items"=>array("LG", "三星", "联想", "索尼", "神舟", "典籍", "华硕", "宏碁", "微星", "惠普", "戴尔", "拉威", "方正", "极限矩阵", "梵泰", "海尔", "深南雁", "清华同方", "玖嘉久", "优威派克"))
	, "price"=>array("type"=>"range", "items"=>array("<2000"=>"2000元以下","2000-3000"=>"2000-3000元","3000-4000"=>"3000-4000元","4000-5000"=>"4000-5000元","5000-6999"=>"5000-6999元","7000-7999"=>"7000-7999元","8000-9999"=>"8000-9999元",">10000"=>"1万元以上"))
	, "cpu_type"=>array("type"=>"single", "items"=>array("英特尔第四代酷睿i7处理器", "英特尔第四代酷睿i5处理器", "英特尔第四代酷睿i3处理器", "凌动处理器D525系列", "凌动处理器D2000系列", "凌动处理器D252系列", "凌动处理器N230系列", "凌动处理器N270系列", "英特尔奔腾四核处理器", "英特尔奔腾双核处理器", "英特尔赛扬四核处理器", "英特尔赛扬双核处理器", "其他"))
	, "screen_size"=>array("type"=>"range", "items"=>array("15-17"=>"15-17寸","17-19"=>"17-19寸","19-20"=>"19-20寸","20-22"=>"20-22寸","22-24"=>"22-24寸",">27"=>"27寸以上"))
	, "mem_rongliang"=>array("type"=>"single", "items"=>array("1", "2", "4", "6", "8", "12", "16"))
	, "disk_type"=>array("type"=>"single", "items"=>array("SATA硬盘", "SSD固态硬盘", "混合硬盘", "SSHD硬盘"))
	, "xianka_type"=>array("type"=>"single", "items"=>array("核芯显卡", "核芯显卡+独立显卡", "独立显卡", "其他集成显卡"))
	, "m_is_touchable"=>array("type"=>"single", "items"=>array("支持触屏操作", "不支持触屏操作"))
	//, "m_tech"=>array("type"=>"single", "items"=>array("WIDI"))
	, "operating_system"=>array("type"=>"single", "items"=>array("Chrome OS", "DOS", "Linux", "Windows", "其他"))
	, "m_wuxianwangka"=>array("type"=>"single", "items"=>array("内置无线网卡", "无内置无线网卡"))
	, "m_support_interface"=>array("type"=>"single", "items"=>array("HDMI接口", "VGA接口", "VGA+HDMI接口", "其他"))
	, "disk_size"=>array("type"=>"range", "items"=>array("<500"=>"500GB以内","500-1000"=>"500-1000GB","1000-2000"=>" 1000-2000GB"))
	, "m_retina"=>array("type"=>"single", "items"=>array("高清屏"))//, "非高清屏"
	, "m_cd_drive"=>array("type"=>"single", "items"=>array("有光驱", "无光驱", "刻录机"))
);