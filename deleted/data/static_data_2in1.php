<?php
$tableName = "products_2in1";
$numOfFirstFilterGroup = 3;
$usageModule = array(
	"高性价比"=>array("name"=>"高性价比", "description"=>"主流价位同时具备极致性能", "supproting"=>array("platform"=>"Baytrail"))
	,"性能超群"=>array("name"=>"性能超群", "description"=>"超跑级性能，响应超迅捷，卓越性能满足您的想象", "supproting"=>array("platform"=>"Haswell"))
	,"旅行必备"=>array("name"=>"旅行必备", "description"=>"极致轻薄，小巧便携，为背包减负；平板和PC模式随心切换，尽享无忧旅行。", "supproting"=>array())
	,"超长待机"=>array("name"=>"超长待机", "description"=>"出乎意料的电池续航能力，超长电力，极低能耗。你不收工，他不打烊。", "supproting"=>array())
	,"时尚白领最爱"=>array("name"=>"时尚白领最爱", "description"=>"紧跟时尚，工艺造型一流，娱乐办公两不误。", "supproting"=>array())
	,"游戏影音全能"=>array("name"=>"游戏影音全能", "description"=>"休闲游戏一网打尽，清晰影音娱乐，居家舒适之选。", "supproting"=>array())
	,"送女友"=>array("name"=>"送女友", "description"=>"造型时尚，轻薄小巧，前后双摄像头，女生专属", "supproting"=>array())
	,"商务甄选"=>array("name"=>"商务甄选", "description"=>"简单高效的日常计算，移动办公，统统能够满足", "supproting"=>array())
);
$hotProducts = array(
	array("name"=>"Lenovo Yoga 3 Pro", "logo"=>"logo_Lenovo.png", "screen_size"=>"13.3", "cpu"=>"英特尔®酷睿™ M处理器 ", "price"=>7899 , "form_factor"=>"插拔", "desc"=>"触控超薄笔记本，摄像头，蓝牙，香槟金。","url"=>"2in1/detail.php?id=576969", "url2"=>"http://item.jd.com/1237961.html")
	,array("name"=>"HP Pavilion X2", "logo"=>"logo_HP.png", "screen_size"=>"11.6", "cpu"=>"Intel Core i5-4202Y", "price"=>5699 , "form_factor"=>"翻转", "desc"=>"二合一系列，可拆分，红色。", "url"=>"2in1/detail.php?id=561628", "url2"=>"http://item.jd.com/1105685.html")
	,array("name"=>"HP Pavilion 11 X360", "logo"=>"logo_HP.png", "screen_size"=>"11.6", "cpu"=>"Intel Celeron N2820", "price"=>3199 , "form_factor"=>"插拔", "desc"=>"360°旋转，超薄笔记本，带触控，运行无噪音。", "url"=>"2in1/detail.php?id=563444", "url2"=>"http://item.jd.com/1512980.html")
	,array("name"=>"Lenovo Yoga2 11", "logo"=>"logo_Lenovo.png", "screen_size"=>"11.6", "cpu"=>"Intel Pentium N3520", "price"=>4499, "form_factor"=>"翻转", "desc"=>"全新轻薄Yoga，新体验，新个性，日光橙。","url"=>"2in1/detail.php?id=565508", "url2"=>"http://product.suning.com/125875867.html")
	,array("name"=>"Lenovo Miix 2 11", "logo"=>"logo_Lenovo.png", "screen_size"=>"11.6", "cpu"=>"Intel Core i3-4012Y", "price"=>4999 , "form_factor"=>"插拔", "desc"=>"办公娱乐两相宜，兼容各种Windows软件。”。", "url"=>"2in1/detail.php?id=566345", "url2"=>"http://product.suning.com/120209811.html")
	,array("name"=>"Lenovo Yoga2 13", "logo"=>"logo_Lenovo.png", "screen_size"=>"11.6", "cpu"=>"Intel Core i5-4200U", "price"=>7699 , "form_factor"=>"插拔", "desc"=>"全新设计，轻薄便携。", "url"=>"2in1/detail.php?id=553998", "url2"=>"product.suning.com/106836113.html")
//	,array("name"=>"联想 Yoga2 13", "logo"=>"logo_Lenovo.png", "screen_size"=>"13", "cpu"=>"Intel Core i5-4200U", "price"=>6999, "form_factor"=>"翻转", "desc"=>"360度自由翻转，纤薄体验，极速启动，办公娱乐无障碍。", "url"=>"2in1/detail.php?id=565511", "url2"=>"http://item.jd.com/988900.html")
//	,array("name"=>"联想 ThinkPad S1 Yoga", "logo"=>"logo_Lenovo.png", "screen_size"=>"12.5", "cpu"=>"Intel Core i5-4200U", "price"=>7499 , "form_factor"=>"翻转", "desc"=>"360度“任性”翻转, 一体化呼吸式键盘，超轻薄纯金属机身，超强性能，顶级感受。", "url"=>"2in1/detail.php?id=563128", "url2"=>"http://item.jd.com/1085027.html")
);


$filters = array(
	"品牌"=>array("全部","华硕","惠普","东芝","联想","戴尔","海尔","宏碁","联想Thinkpad","三星","微软")
	,"价格"=>array("全部","3000元以下","3000-5999元","6000-7999元","8000元-9999元","1万元以上")
	,"处理器"=>array("全部","第四代酷睿i7处理器", "第四代酷睿i5处理器", "第四代酷睿i3处理器", "第三代酷睿i7处理器", "第三代酷睿i5处理器", "第三代酷睿i3处理器", "凌动处理器Z3000系列", "凌动处理器Z2000系列", "奔腾处理器2129Y系列", "奔腾处理器N3520系列", "赛扬处理器N2820系列", "赛扬处理器N2920系列", "赛扬处理器N2910系列")
	,"屏幕尺寸"=>array("全部","8-10寸","10.1-11.6寸","12-12.5寸","13.3-14寸","15寸及以上")
	,"重量"=>array("全部","0.8KG以下","0.88-1.29KG","1.3-1.49KG","1.5-1.69KG","1.7KG-1.99KG","2KG-2.29KG","2.3KG以上")
	,"厚度"=>array("全部","16mm以下","16-17.9mm","18-19.9mm","20-23mm","23mm以上")
	,"内存"=>array("全部","2G","4G","8G","12G")
	,"英特尔技术"=>array("全部","WiDi","锐炬显卡")
	,"硬盘"=>array("全部","SSD固态硬盘","EMMC","mSATA固态硬盘","机械硬盘","机械硬盘+mSATA固态硬盘","机械硬盘+固态硬盘","闪存硬盘")
	,"硬盘容量"=>array("全部","32GB","60-64GB","80-128GB","180-256GB","500GB-512GB","750GB","1000GB")
	,"显卡"=>array("全部","独立显卡","核芯显卡","独立显卡+核芯显卡")
	,"产品形态"=>array("全部","插拔","翻转")
);
$filterNames = array(
	"brand_name"=>"品牌"
	,"price"=>"价格"
	,"cpu"=>"处理器"
	,"screen_size"=>"屏幕尺寸"
	,"weight"=>"重量"
	,"thickness"=>"厚度"
	,"memory_size"=>"内存"
	,"tech"=>"英特尔技术"
	,"harddist_type"=>"硬盘"
	,"harddisc_size"=>"硬盘容量"
	,"graphics_card"=>"显卡"
	,"product_form"=>"产品形态"
);
$filterData = array(
	"brand_name"=>array("type"=>"single", "items"=>array("华硕","惠普","东芝","联想","戴尔","海尔","宏碁","联想ThinkPad","三星","微软"))
	,"price"=>array("type"=>"range", "items"=>array("<3000"=>"3000元以下","3000-5999"=>"3000-5999元","6000-7999"=>"6000-7999元","8000-9999"=>"8000-9999元",">10000"=>"1万元以上"))
	,"cpu"=>array("type"=>"single", "items"=>array("第四代酷睿i7处理器", "第四代酷睿i5处理器", "第四代酷睿i3处理器", "第三代酷睿i7处理器", "第三代酷睿i5处理器", "第三代酷睿i3处理器", "凌动处理器Z3000系列", "凌动处理器Z2000系列", "奔腾处理器2129Y系列", "奔腾处理器N3520系列", "赛扬处理器N2820系列", "赛扬处理器N2920系列", "赛扬处理器N2910系列"))
	,"screen_size"=>array("type"=>"range", "items"=>array("8-10"=>"8-10寸","10.1-11.6"=>"10.1-11.6寸","12-12.5"=>"12-12.5寸","13.3-14"=>"13.3-14寸",">15"=>"15寸及以上"))
	,"weight"=>array("type"=>"range", "items"=>array("<0.8"=>"0.8KG以下","0.88-1.29"=>"0.88-1.29KG","1.3-1.49"=>"1.3-1.49KG","1.5-1.69"=>"1.5-1.69KG","1.7-1.99"=>"1.7-1.99KG","2-2.29"=>"2-2.29KG",">2.3"=>"2.3KG以上"))
	,"thickness"=>array("type"=>"range", "items"=>array("<16"=>"16mm以下","16-17.9"=>"16-17.9mm","18-19.9"=>"18-19.9mm","20-23"=>"20-23mm",">23"=>"23mm以上"))
	,"memory_size"=>array("type"=>"single", "items"=>array(2,4,6,8,12))
	,"tech"=>array("type"=>"like", "items"=>array("WiDi","锐炬显卡"))
	,"harddist_type"=>array("type"=>"single", "items"=>array("SSD固态硬盘","mSATA固态硬盘","机械硬盘","机械硬盘+mSATA固态硬盘","机械硬盘+固态硬盘","闪存硬盘"))//,"eMMC"
	,"harddisc_size"=>array("type"=>"range", "items"=>array("=32"=>"32GB","60-64"=>"60-64GB","80-128"=>"80-128GB","180-256"=>"180-256GB","500-512"=>"500GB-512GB","=750"=>"750GB","=1000"=>"1000GB"))
	,"graphics_card"=>array("type"=>"single", "items"=>array("核芯显卡","独立显卡+核芯显卡"))//"独立显卡",
	,"product_form"=>array("type"=>"single", "items"=>array("插拔","翻转"))
);