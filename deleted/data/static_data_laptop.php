<?php
$tableName = "products_laptop";
$numOfFirstFilterGroup = 3;

$usageModule = array(
	"高性价比"=>array("name"=>"高性价比", "description"=>"主流价位全能本，超实惠之选")
	, "触控超极本"=>array("name"=>"触控超极本", "description"=>"通过触摸来感受世界，完美windows8拍档!")
	, "超薄便携"=>array("name"=>"超薄便携", "description"=>"纤薄时尚, 轻巧易携，无论何时何地，都是您出行和工作的理想伴侣。")
	, "顶级游戏本"=>array("name"=>"顶级游戏本", "description"=>"超跑级性能，魔兽、使命召唤、GTA、极品飞车，一个都不能少。")
	, "开学利器"=>array("name"=>"开学利器", "description"=>"写论文、看电影、玩游戏，度过丰富多彩的学生时代，开学必入装备你值得拥有。")
	, "设计绘图"=>array("name"=>"设计绘图", "description"=>"图片处理，绘图设计，实现灵感")
	, "影音达人"=>array("name"=>"影音达人", "description"=>"居家舒适之选，超大屏幕，影音娱乐体验")
	, "商务甄选"=>array("name"=>"商务甄选", "description"=>"安全稳定，满足不同办公需求, 便携设计让出差也毫无压力， 保证工作顺利进行！")
	, "超长待机"=>array("name"=>"超长待机", "description"=>"出乎意料的电池续航能力，超长电力，极低能耗。你不收工，他不打烊。")
);
$hotProducts = array();
/* $hotProducts = array(
		array("name"=>"惠普 Pavilion 11 x2", "logo"=>"logo_HP.png", "screen_size"=>"11.6", "cpu"=>"Intel Core i3-4012Y", "price"=>5699 , "form_factor"=>"插拔", "desc"=>"可拆分式触控电脑，双电池，随心插拔，一机两用。","url"=>"2in1/detail.php?id=561630", "url2"=>"http://item.jd.com/1105677.html")
		,array("name"=>"惠普 Pavilion 11 x360", "logo"=>"logo_HP.png", "screen_size"=>"11.6", "cpu"=>"Intel Pentium N3520", "price"=>3599 , "form_factor"=>"翻转", "desc"=>"360度随心转，贴心价格，明智之选。2014移动通信大会最佳笔记本。", "url"=>"2in1/detail.php?id=567162", "url2"=>"http://item.jd.com/1105297.html")
		,array("name"=>"华硕 Transformer Book T100", "logo"=>"logo_ASUS.png", "screen_size"=>"10", "cpu"=>" Intel Atom Z3740 ", "price"=>2899 , "form_factor"=>"插拔", "desc"=>"笔记本电脑与平板的超完美结合, 高性价比，轻薄易携, 热卖推荐！", "url"=>"2in1/detail.php?id=563608", "url2"=>"http://item.jd.com/1083100.html")
		,array("name"=>"联想 Yoga2 11", "logo"=>"logo_Lenovo.png", "screen_size"=>"11.6", "cpu"=>"Intel Pentium N3520 ", "price"=>4499 , "form_factor"=>"翻转", "desc"=>"厚度仅17.2毫米，极致轻薄，多点触控，最具性价比的Yoga, 助您翻转世界！","url"=>"2in1/detail.php?id=565508", "url2"=>"http://item.jd.com/1081949.html")
		,array("name"=>"联想 Miix 2 11", "logo"=>"logo_Lenovo.png", "screen_size"=>"11.6", "cpu"=>"Intel Core i3-4012Y", "price"=>4999 , "form_factor"=>"插拔", "desc"=>"全高清触控，30毫秒急速响应，单手可掌控平板模式，娱乐办公兼备“触手可及”。", "url"=>"2in1/detail.php?id=566345", "url2"=>"http://item.jd.com/1091767.html")
		,array("name"=>"海尔 Sailing P11A", "logo"=>"logo_Haier.png", "screen_size"=>"11.6", "cpu"=>"Intel Core i3-3217U", "price"=>3999 , "form_factor"=>"插拔", "desc"=>"形变随心，超级续航, 十指触控屏, 11.9毫米机身厚度，轻松便携时尚。", "url"=>"2in1/detail.php?id=554580", "url2"=>"http://item.jd.com/942083.html")
		,array("name"=>"联想 Yoga2 13", "logo"=>"logo_Lenovo.png", "screen_size"=>"13", "cpu"=>"Intel Core i5-4200U", "price"=>6999, "form_factor"=>"翻转", "desc"=>"360度自由翻转，纤薄体验，极速启动，办公娱乐无障碍。", "url"=>"2in1/detail.php?id=565511", "url2"=>"http://item.jd.com/988900.html")
		,array("name"=>"联想 ThinkPad S1 Yoga", "logo"=>"logo_Lenovo.png", "screen_size"=>"12.5", "cpu"=>"Intel Core i5-4200U", "price"=>7499 , "form_factor"=>"翻转", "desc"=>"360度“任性”翻转, 一体化呼吸式键盘，超轻薄纯金属机身，超强性能，顶级感受。", "url"=>"2in1/detail.php?id=563128", "url2"=>"http://item.jd.com/1085027.html")
); */
$filterNames = array(
	"m_brand"=>"品牌"
	, "price"=>"价格"
	, "m_cpu"=>"处理器"
	, "screen_size"=>"屏幕尺寸"
	, "weight"=>"重量"
	, "thickness"=>"厚度"
	, "mem_rongliang"=>"内存"
	, "m_widi"=>"英特尔技术"
	, "disk_type"=>"硬盘"
	, "xianka_type"=>"显卡"
	, "disk_size"=>"硬盘容量"
	, "m_support_interface"=>"支持接口类型"
	, "m_retina"=>"是否高清屏"
	, "cd_drive_type"=>"光驱"
	, "m_is_touchable"=>"触屏"
	, "m_screen_bili"=>"屏幕比例"
);
$filterData = array(
	"m_brand"=>array("type"=>"single", "items"=>array("三星", "联想", "索尼", "神舟", "华硕", "宏碁", "微星", "惠普", "戴尔", "海尔", "清华同方"))//"LG", "典籍", "拉威", "方正", "极限矩阵", "梵泰", "深南雁", , "玖嘉久"
	, "price"=>array("type"=>"range", "items"=>array("<3000"=>"3000元以下","3000-5000"=>"3000-5000元","5000-8000"=>"5000-8000元","8000-10000"=>"8000-10000元","10000-12999"=>"10000-12999元","13000-15999"=>"13000-15999元","16000-19999"=>"16000-19999元",">20000"=>"2万元以上"))
	, "m_cpu"=>array("type"=>"single", "items"=>array("第四代酷睿i7处理器", "第四代酷睿i5处理器", "第四代酷睿i3处理器", "英特尔奔腾处理器"))
	, "screen_size"=>array("type"=>"range", "items"=>array("11-12"=>"11-12寸","12-14"=>"12-14寸","14-17"=>"14-17寸",">17"=>"17寸以上"))
	, "weight"=>array("type"=>"range", "items"=>array("<1"=>"1KG以下","1-1.99"=>"1-1.99KG","2-2.99"=>"2-2.99KG","3-3.99"=>"3-3.99KG","4-4.99"=>"4-4.99KG",">5"=>"5KG以上"))
	, "thickness"=>array("type"=>"range", "items"=>array("<10"=>"10mm以下","10-29"=>"10-29mm","30-39"=>"30-39mm","40-49"=>"40-49mm",">50"=>"50mm以上"))
	, "mem_rongliang"=>array("type"=>"single", "items"=>array("2", "4", "6", "8", "12", "16", "32"))//"1", 
	, "m_widi"=>array("type"=>"single", "items"=>array("WIDI"))
	, "disk_type"=>array("type"=>"single", "items"=>array("SATA硬盘", "SSD固态硬盘", "混合硬盘"))
	, "xianka_type"=>array("type"=>"single", "items"=>array("核芯显卡", "独立显卡+核芯显卡", "独立显卡", "其他集成显卡","锐炬显卡"))
	, "disk_size"=>array("type"=>"range", "items"=>array("<500"=>"500GB以内","500-1000"=>"500-1000GB","1000-2000"=>"1000-2000GB",">2000"=>"2000GB以上"))
	, "m_support_interface"=>array("type"=>"single", "items"=>array("HDMI接口", "SIM卡插槽", "VGA接口", "VGA接口+HDMI接口"))
	, "m_retina"=>array("type"=>"single", "items"=>array("高清屏"))//, "非高清屏"
	, "cd_drive_type"=>array("type"=>"single", "items"=>array("有光驱", "无光驱", "刻录机"))
	, "m_is_touchable"=>array("type"=>"single", "items"=>array("支持触屏操作", "不支持触屏操作"))
	, "m_screen_bili"=>array("type"=>"single", "items"=>array("16：9", "16：10", "3：2"))
);