<?php
if (isset($_GET['debug']) && $_GET['debug']=='licaimap'){
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
}

define('ROOT_PATH', dirname(__DIR__));
define('SITE_ROOT_PATH', dirname(dirname(__DIR__)));
define('SMARTY_DIR', ROOT_PATH . '/libs/Smarty-3.1.18/libs/');
set_include_path(ROOT_PATH . '/libs' . PATH_SEPARATOR . get_include_path());

require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty();
$smarty->setTemplateDir(ROOT_PATH . '/smarty/templates/');
$smarty->setCompileDir(ROOT_PATH . '/smarty/templates_c/');
$smarty->setConfigDir(ROOT_PATH . '/smarty/configs/');
$smarty->setCacheDir(ROOT_PATH . '/smarty/cache/');

include_once 'config.php';

include_once 'touzilicai.class.php';
include_once 'siteCfg.class.php';
include_once 'article.class.php';
include_once 'articleTags.class.php';
include_once 'tag.class.php';
include_once 'category.class.php';
include_once 'licaiProduct.class.php';
include_once 'menu.class.php';
include_once 'pager.class.php';
include_once 'path.class.php';
include_once 'tool.class.php';

$touzilicaiLib = new Touzilicai();
$siteCfgLib = new SiteCfg();

$categoryLib = new Category();
$articleTagsLib = new ArticleTags();
$tagLib = new Tag();
$articleLib = new Article($categoryLib, $articleTagsLib, $tagLib);

$licaiProductLib = new LicaiProduct();
$toolLib = new Tool();

$menuLib = new Menu();
$pagerLib = new Pager();
$pathLib = new Path();
$siteCfgs = $siteCfgLib->getSiteCfgs();
$smarty->assign('siteCfgs', $siteCfgs);
?>



