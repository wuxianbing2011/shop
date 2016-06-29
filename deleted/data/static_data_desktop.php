<?php
$tableName = "products_desktop";
$numOfFirstFilterGroup = 3;
$usageModule = array(
	"高性价比"=>array("name"=>"高性价比", "description"=>"主流价位同时具备极致性能")
	, "性能超群"=>array("name"=>"性能超群", "description"=>"稳定操作，扩展便捷，娱乐办公两不误。")
	, "顶级游戏"=>array("name"=>"顶级游戏", "description"=>"骨灰级游戏玩家顶级战斗装备，超高清显示，强悍性能助你横扫战场！")
	, "影音全能"=>array("name"=>"影音全能", "description"=>"超清视频, 逼真音效，犹如置身于电影院, 充分感受极致影音的魅力。")
	, "商务甄选"=>array("name"=>"商务甄选", "description"=>"满足主流办公应用，高效智能，商务办公必备!")
	, "超大存储"=>array("name"=>"超大存储", "description"=>"硬盘给力，高清电影，大型3D游戏存储不再愁！")
);
$hotProducts = array();

$filterNames = array(
	"m_brand"=>"品牌"
	, "price"=>"价格"
	, "m_cpu"=>"处理器"
	, "xianshiqi_size"=>"屏幕尺寸"
	, "mem_daxiao"=>"内存"
	, "disk_type"=>"硬盘"
	, "xianka_type"=>"显卡"
	, "m_wangka"=>"是否内置无线网卡"
	, "disk_size"=>"存储空间"
	, "jixiang"=>"机箱形式"
);
$filterData = array(
	"m_brand"=>array("type"=>"single", "items"=>array("英特尔", "华硕", "宏碁", "惠普", "戴尔", "方正", "明基", "海尔", "清华同方", "神舟", "联想", "长城", "Maingear"))//, "其他"
	, "price"=>array("type"=>"range", "items"=>array("<3000"=>"3000元以下","3000-3999"=>"3000-3999元","4000-4999"=>"4000-4999元","5000-5999"=>"5000-5999元","6000-6999"=>"6000-6999元","7000-7999"=>"7000-7999元","8000-10000"=>"8000-10000元"))
	, "m_cpu"=>array("type"=>"single", "items"=>array("第四代酷睿i7处理器", "第四代酷睿i5处理器", "第四代酷睿i3处理器", "第三代酷睿i7处理器", "第三代酷睿i5处理器", "第三代酷睿i3处理器", "第二代酷睿i7处理器", "第二代酷睿i5处理器", "第二代酷睿i3处理器", "凌动处理器D2000系列", "凌动处理器D525系列", "凌动处理器N330系列", "英特尔四核芯奔腾处理器", "英特尔双核芯奔腾处理器", "英特尔四核芯赛扬处理器", "英特尔双核芯赛扬处理器", "英特尔赛扬处理器", "双核芯奔腾处理器"))
	, "xianshiqi_size"=>array("type"=>"range", "items"=>array("15-17"=>"15-17寸","17-20"=>"17-20寸","20-22"=>"20-22寸","22-24"=>"22-24寸","24-27"=>"24-27寸",">27"=>"27寸以上"))
	, "mem_daxiao"=>array("type"=>"single", "items"=>array("1", "2", "4", "6", "8", "12", "16"))
	, "disk_type"=>array("type"=>"single", "items"=>array("SATA硬盘", "SATA硬盘+SSD固态硬盘", "SSD硬盘", "其他硬盘"))
	, "xianka_type"=>array("type"=>"single", "items"=>array("核芯显卡", "独立显卡", "其他集成显卡"))
	, "m_wangka"=>array("type"=>"single", "items"=>array("内置无线网卡"))//, "无内置无线网卡"
	, "disk_size"=>array("type"=>"range", "items"=>array("<500"=>"500GB以内","500-1000"=>"500-1000GB ","1000-2000"=>"1000-2000GB",">2000"=>"2000GB以上"))
	, "jixiang"=>array("type"=>"single", "items"=>array("立式", "卧式", "微塔式", "其他"))
);