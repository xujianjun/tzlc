<?php


use Phalcon\Mvc\View;

class ApiController extends ControllerBase
{
	public function initialize() {
		parent::initialize();
		$this->view->setVar("bdtongji", false);
	}

	public function indexAction(){
		$widget = $this->dispatcher->getParam('api');
//		echo 'widget:'.$widget.'<br>';
		list($view, $block) = explode('--', $widget);
		$viewData = $this->_initPageData($widget);
//		echo '<pre>';print_r($viewData);echo '</pre>';
		if ($block){
			$viewData = $viewData[$view][$block];
		}
		echo json_encode($viewData);
		exit();
		echo $this->view->getRender('widget', $view, $viewData);
	}

}
