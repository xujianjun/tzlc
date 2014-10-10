<?php

return new \Phalcon\Config(array(
    'siteCfg'	=> array(
        'title'  	=> '慧学网',
        'subTitle'  => '身边的理财知识库',
        'logoFile' 	=> APP_PATH . '/public/img/logo.png',
    ),
    'cacheCfg' 	=> array(
        'expireTime' => 3600,
    ),
    'footerCft'	=> array(
    	'cright'	=> 'CopyRight © 2014 <a target="_blank" href="http://www.miitbeian.gov.cn/">鲁ICP备14026710号-1</a> 慧学屋',
    	'contentFrom'	=> '本站资源多收集于网络,版权归原作者所有,若有侵权,请联系我们. admin@licaimap.com',
    	'tips'		=> '声明：本站发布的所有资料或图片仅仅用于学习与交流，投资者依据本网站提供的内容进行投资所造成的盈亏与本网站无关。',
    ),
    'nodeCfg'	=> array(
		'menuRootNid' => 6975,
        'mainMenuRootNid' => 2,
        'secMenuRootNid' => 6977,
        'recommendNodeNum' => 6,
        'articleRootNid' => 2,
        'tzalHeadNid' => 6348,
        'lcghHeadNid' => 6751
    ),
    'widgetCfg'	=> array(
    	'cidianCloudNum' => 30,
        'tagNodesNum' => 20,
        'listItemPer' => 20,
        'blockNum' => 6,
    ),
    'slider' => array(
		'home' => array(
			array('title'=>'丈夫一人挣钱风险大 设置备用金增家庭保险', 'img_path'=>'/img/slider/hs-byj.jpg', 'link'=>'/wealth/story/6333.html', 'alt'=>'丈夫一人挣钱风险大 设置备用金增家庭保险'),
			array('title'=>'单身工薪族应稳健当先 放弃短线思路', 'img_path'=>'/img/slider/hs-wj.jpg', 'link'=>'/wealth/story/6343.html', 'alt'=>'单身工薪族应稳健当先 放弃短线思路'),
			array('title'=>'月入近1万元家庭 如何理财积攒创业资本', 'img_path'=>'/img/slider/hs-jt.jpg', 'link'=>'/wealth/story/6360.html', 'alt'=>'月入近1万元家庭 如何理财积攒创业资本'),
			array('title'=>'月入六千 单身汉如何理财', 'img_path'=>'/img/slider/hs-dsh.jpg', 'link'=>'/wealth/story/6388.html', 'alt'=>'月入六千 单身汉如何理财'),
		),
		'school' => array(
			array('title'=>'威廉指标（W％R）', 'img_path'=>'/img/slider/ss-wl.jpg', 'link'=>'/trade/tech/583.html', 'alt'=>'威廉指标（W％R）'),
			array('title'=>'K线六种形态', 'img_path'=>'/img/slider/ss-kx.jpg', 'link'=>'/trade/tech/517.html', 'alt'=>'K线六种形态'),
			array('title'=>'相对强弱指标（RSI）', 'img_path'=>'/img/slider/ss-rsi.jpg', 'link'=>'/trade/tech/581.html', 'alt'=>'相对强弱指标（RSI）'),
			array('title'=>'怎样研判成交量的变化', 'img_path'=>'/img/slider/ss-cjl.jpg', 'link'=>'/trade/tech/542.html', 'alt'=>'怎样研判成交量的变化'),
		),
	),
	'cfshHeadNode' => array(
		/*'tzal' => array(
			'title'=>'准购房族如何让首付款“赚起来”',
			'desc' => '理财专家表示，对于平均年化收益率一般在3%左右的货币基金而言，好的“货基宝宝”常常毫厘必争。',
			'img_path'=>'/img/cfsh-head/tzal.jpg',
			'link'=>'/wealth/story/6348.html',
			'alt'=>'准购房族'
		),*/
		'lcgs' => array(
			'title'=>'犹太人如何培养孩子的财商',
			'desc' => '犹太人善经商，天下人尽知，大名鼎鼎的格林斯潘、伯南克、巴菲特、索罗斯...',
			'img_path'=>'/img/cfsh/lcgs-0.jpg',
			'link'=>'/wealth/plan/6496.html',
			'alt'=>'月入过万'
		),
	),
    'blockCfg'	=> array(
    	'slider_home' => array(array('nid' => 29,'title' => '投资案例')),
        'slider_school' => array(array('nid' => 9,'title' => '财经学堂')),
        'navTab_school_stock_fund' => array(array('nid' => 17,'title' => '股票学堂'),array('nid' => 18,'title' => '基金学堂')),
        'navTab_school_forex_bank' => array(array('nid' => 19,'title' => '外汇学堂'),array('nid' => 20,'title' => '银行学堂')),
        'navTab_school_spot_futures' => array(array('nid' => 22,'title' => '现货学堂'),array('nid' => 23,'title' => '期货学堂')),
        'panel_internet_licai' => array(array('nid' => 13,'title' => '互联网理财')),
        'panel_internet_p2p' => array(array('nid' => 14,'title' => 'p2p网贷')),
        'navTab_internet_bank_fund' => array(array('nid' => 15,'title' => '银行理财'), array('nid' => 16,'title' => '基金理财')),
        'panel_internet_insurance' => array(array('nid' => 66,'title' => '保险理财')),
        'panel_school_insurance' => array(array('nid' => 21,'title' => '保险学堂')),
        'panel_school_metal' => array(array('nid' => 24,'title' => '贵金属学堂')),
        'panel_school_gold' => array(array('nid' => 25,'title' => '黄金学堂')),
        'navTab_trade_basic_tech' => array(array('nid' => 26,'title' => '基本面分析'), array('nid' => 27,'title' => '技术面分析')),
        'panel_trade_master' => array(array('nid' => 28,'title' => '大师攻略')),
        'panel2_wealth_story' => array(array('nid' => 29,'title' => '投资案例', 'link' => '/wealth/story/')),
        'panel3_wealth_plan' => array(array('nid' => 30,'title' => '理财规划', 'link' => '/wealth/plan/')),
        //'panel2_wealth_product' => array(array('nid' => 31,'title' => '产品评测')),

        'navTab_stockSchool_basic_method' => array(array('nid' => 34,'title' => '基础知识'),array('nid' => 36,'title' => '操盘攻略')),
        'panel_stockSchool_trade' => array(array('nid' => 35,'title' => '交易指南')),
        'panel_fundSchool_basic' => array(array('nid' => 37,'title' => '基金入门')),
        'navTab_fundSchool_open_close' => array(array('nid' => 38,'title' => '开放式基金'),array('nid' => 39,'title' => '封闭式基金')),
        'panel_fundSchool_money' => array(array('nid' => 40,'title' => '货币基金')),
        'panel_fundSchool_trade' => array(array('nid' => 41,'title' => '基金技巧')),
        'panel_forexSchool_basic' => array(array('nid' => 42,'title' => '外汇入门')),
        'panel_forexSchool_trade' => array(array('nid' => 43,'title' => '炒汇技巧')),
        'panel_metalSchool_basic' => array(array('nid' => 56,'title' => '基础知识')),
        'panel_metalSchool_trade' => array(array('nid' => 58,'title' => '投资技巧')),
        'panel_otherSchool_bank' => array(array('nid' => 20,'title' => '银行学堂')),
        'panel_otherSchool_insurance' => array(array('nid' => 21,'title' => '保险学堂')),
        'navTab_otherSchool_spot_futures' => array(array('nid' => 22,'title' => '现货学堂'),array('nid' => 23,'title' => '期货学堂')),
        'panel_otherSchool_gold' => array(array('nid' => 25,'title' => '黄金学堂')),
    ),
    'pageTitle' => array(
		'IndexController-index' => array('股票.贵金属.理财知识'),
		'PageController-xtHome' => array('财经学堂'),

		'PageController-xtList' => array(),
		'PageController-xtSingle' => array(),
		'PageController-list' => array(),
		'PageController-single' => array(),
		'PageController-tagList' => array('词典'),
		'PageController-tagSingle' => array('词典'),
		'PageController-search' => array(),

		'StaticController-about' => array('关于我们'),
		'StaticController-contact' => array('联系我们'),
		'StaticController-mianze' => array('免责条款'),
		'StaticController-sitemap' => array('网站地图'),
    ),
    'defaultMetaData' => array(
		'keywords' => '慧学网',
		'description' => '慧学网提供提供最专业最全的理财学习网站，提供投资学堂、财经词典、互联网金融、互联网理财、投资案例、理财故事等服务。',
    ),
    'pageMetaData' => array(
		'IndexController-index' => array('keywords' => '投资，理财，股票，基金，外汇，债券，贵金属，黄金，期货，现货，银行，保险，财经学堂，互联网金融，互联网理财，P2P网贷，投资案例，理财规划', 'description' => ''),
		'PageController-xtHome' => array('keywords' => '投资，理财，财经学堂，股票，基金，外汇，债券，贵金属，黄金，期货，现货，银行，保险', 'description' => '慧学网财经学堂提供最专业最全的投资理财知识，涵盖股票、基金、外汇、债券、贵金属、黄金、期货、现货、银行、保险等投资领域。'),

		'PageController-xtList' => array('keywords' => '财经学堂，投资，理财', 'description' => '慧学网财经学堂提供最专业最全的投资理财知识，涵盖股票、基金、外汇、债券、贵金属、黄金、期货、现货、银行、保险等投资领域。'),
		'PageController-xtSingle' => array('keywords' => '财经学堂，投资，理财', 'description' => ''),
		'PageController-list' => array('keywords' => '投资，理财', 'description' => ''),
		'PageController-single' => array('keywords' => '投资，理财', 'description' => ''),
		'PageController-tagList' => array('keywords' => '词典，投资，理财', 'description' => '慧学网财经词典提供最专业最全的理财词汇的中英文学习，涵盖股票、基金、外汇、债券、贵金属、黄金、期货、现货、银行、保险等投资领域。'),
		'PageController-tagSingle' => array('keywords' => '词典，投资，理财', 'description' => ''),
		'PageController-search' => array('keywords' => '搜索，投资，理财', 'description' => ''),

		'StaticController-about' => array('keywords' => '关于我们，投资，理财', 'description' => ''),
		'StaticController-contact' => array('keywords' => '联系我们，投资，理财', 'description' => ''),
		'StaticController-mianze' => array('keywords' => '免责条款，投资，理财', 'description' => ''),
		'StaticController-sitemap' => array('keywords' => '网站地图，投资，理财', 'description' => ''),
    ),
    'hotNids' => array(7184,7133,7148,1870,6407,7172),
    'dailywordTids' => array(9,37,55,60,71,89,90),
));
