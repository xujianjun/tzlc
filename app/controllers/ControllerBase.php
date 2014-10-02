<?php

/**
 * 页面公共变量：
 * 		siteConfig,
 * 		params[aid,article,tid,tag,cid,category],
 * 		menus
 */

use Phalcon\Tag;

class ControllerBase extends Phalcon\Mvc\Controller {
	public $_demo = false;

	public $tlObj;
	public $pagerObj;
	public $pathObj;

	public $_siteConfig;
	public $_params;
	public $_menus;
	public $_pageData;

	public function initialize() {
		$this->view->setTemplateAfter('main');
		Tag::setTitle('财途网');
		Tag::setTitleSeparator(' - ');

		$this->_initLibrary();
		$this->_initSiteConfig();
		$this->_initParams();
		$this->_initMenu();

		$actionName = $this->dispatcher->getActionName();
		$controllName = $this->dispatcher->getHandlerClass();
		$dispatcher = $controllName.'-'.$actionName;
		$this->_initPageTitle($dispatcher);
		$this->_initMetaData($dispatcher);

		$this->view->setVar("server", $_SERVER);
		$this->view->setVar("bdtongji", true);
	}

	public function _initLibrary(){
		$this->tlObj = new Tl();
		$this->pagerObj = new Pager();
		//$this->pathObj = new Path();
	}

	public function _initSiteConfig(){
		$siteConfig = include APP_PATH . "/app/config/siteconfig.php";
		$siteConfig = $siteConfig->toArray();
		$this->_siteConfig = $siteConfig;
//		echo '<pre>';print_r($siteConfig);echo '</pre>';die();
		$this->view->setVar("siteConfig", $siteConfig);
	}
	public function _initParams(){
		$params = array();
		if ($this->_demo){
			$params['nid'] = 0;
			$params['tid'] = 0;
			$nten = 'about_us';
			$params['p'] = $params['p'] ? $params['p'] : 1;
			$params['tagPrefix'] = '';

			$params['search_keyword'] = '';
		} else {
			$params['p'] = (isset($_GET['p']) && $_GET['p']) ? $_GET['p'] : 1;
			$params['nid'] = $this->dispatcher->getParam('nid', 'int');
			$params['tid'] = $this->dispatcher->getParam('tid', 'int');
			$params['tagPrefix'] = strtolower($this->dispatcher->getParam('tagPrefix'));
			$nten = $this->dispatcher->getParam('nten');
			$nten2 = $this->dispatcher->getParam('nten2');
			$nten3 = $this->dispatcher->getParam('nten3');
			$params['search_keyword'] = trim($this->dispatcher->getParam('search_keyword'), '/');
		}
		if ($params['nid']){
			$node = TreeStruct::findFirst($params['nid']);
			$params['node'] = $node;
			$params['nodeData'] = $node->TreeData;
			$relationTreeNodes = TreeStruct::findRelationTrees($node);
			$params['nodeParents'] = $relationTreeNodes['parent'];
			$params['nodeChilds'] = $relationTreeNodes['child'];
			$params['nodeSiblings'] = $relationTreeNodes['sibling'];
			$path = '';
			foreach ($params['nodeParents'] as $parentNode){
				$ptitle_en = $parentNode->TreeData->title_en;
				if (!$ptitle_en){
					continue;
				}
				$path .= '/'.$ptitle_en;
			}
//			echo 'path:'.$path.'<br>';
//			echo 'nten:'.$nten.',nten2:'.$nten2.'<br>';die();

			$urlPathTitle = array($nten, $nten2, $nten3);
			if ($urlPathTitle[0] || $urlPathTitle[1] || $urlPathTitle[2]){
				foreach ($urlPathTitle as $key=>$value){
					if (!$value){
						unset($urlPathTitle[$key]);
					}
				}
				reset($urlPathTitle);
				foreach ($params['nodeParents'] as $parentNode){
					$ptitle_en = $parentNode->TreeData->title_en;
					if (!$ptitle_en){
						continue;
					}
//					echo 'etitle:'.$ptitle_en.'<br>';
//					echo '<pre>';print_r($urlPathTitle);echo '</pre>';
					if ($ptitle_en == $urlPathTitle[key($urlPathTitle)]){
						unset($urlPathTitle[key($urlPathTitle)]);
//						echo '<pre>';print_r($urlPathTitle);echo '</pre><hr>';
						if (count($urlPathTitle) == 0){
							break;
						}
					}
				}

//				echo '<pre>';print_r($urlPathTitle);echo '</pre>';die();
				if (count($urlPathTitle) > 0){
					$url = $path.'/'.$params['nid'].'.html';
					 $this->response->redirect($url, true, 301);
			        //Disable the view to avoid rendering
			        $this->view->disable();
				}
			}
		}

		if (!$params['nid'] && ($nten || $nten2 || $nten3)){
			$ntitleEn = $nten3 ? $nten3 : ($nten2 ? $nten2 : $nten);
			$nData = TreeData::findFirst(array(
								'conditions' => "title_en = :ntitleEn:",
								'bind' => array('ntitleEn'=>$ntitleEn)
							));
			$params['nid'] = $nData->id;
			$node = TreeStruct::findFirst($params['nid']);
			$params['node'] = $node;
			$params['nodeData'] = $node->TreeData;
			$relationTreeNodes = TreeStruct::findRelationTrees($node);
			$params['nodeParents'] = $relationTreeNodes['parent'];
			$params['nodeChilds'] = $relationTreeNodes['child'];
			$params['nodeSiblings'] = $relationTreeNodes['sibling'];
		}
		if ($params['tid']){
			$tag = Tags::findFirst($params['tid']);
			$params['tag'] = $tag;
		}
//		echo '<pre>';print_r($params['node']->toArray());echo '</pre>';die();
		$this->_params = $params;
		$this->view->setVar("params", $params);
	}

	public function _initMenu(){
		$menus = array('mainMenu'=>array(), 'secMenu'=>array());
		$mainMenuRootNid = $this->_siteConfig['nodeCfg']['mainMenuRootNid'];
		$secMenuRootNid = $this->_siteConfig['nodeCfg']['secMenuRootNid'];
		$recommendNodeNum = $this->_siteConfig['nodeCfg']['recommendNodeNum'];

		//一级菜单
		$mainMenuRootNode = TreeStruct::findFirst($mainMenuRootNid);
		$temNodes = TreeStruct::find(array(
						'conditions' => 'lft>?1 and rgt<?2 and type=:type:',
						'bind' => array(1=>$mainMenuRootNode->lft, 2=>$mainMenuRootNode->rgt, 'type'=>'default'),
						'order' => 'lft asc',
					));
		$temMainMenu = array();
		foreach ($temNodes as $key=>$temNode){
			$treeData = $temNode->TreeData->toArray();
			$temMainMenu[$key] = $temNode->toArray();
			$temMainMenu[$key]['TreeData'] = $treeData;
		}
		$temMainMenu = TreeStruct::addNodesAttr($temMainMenu);

		$mainMenu = array();
		$pid = $pid2 = 0;
		$plvl = $mainMenuRootNode->lvl + 1;
		foreach ($temMainMenu as $key=>$value){
			if ($value['lvl'] == $plvl){
				$mainMenu[$value['id']] = $value;

				//判断是否为当前menu
				$mainMenu[$value['id']]['current'] = false;
				if ($this->_params['node']->id == $value['id']){
					$mainMenu[$value['id']]['current'] = true;
				} else {
					foreach($this->_params['nodeParents'] as $parent){
						if ($parent->id == $value['id']){
							$mainMenu[$value['id']]['current'] = true;
							break;
						}
					}
				}
				//推荐node
				$temRecommendNodes = TreeStruct::find(array(
								'conditions' => 'lft>?1 and rgt<?2 and type=:type:',
								'bind' => array(1=>$value['lft'], 2=>$value['rgt'], 'type'=>'article'),
								'limit' => array('number'=>$recommendNodeNum, 'offset'=>0),
								'order' => 'lft desc',
							));
				$recommendNodes = array();
				foreach ($temRecommendNodes as $key=>$temRecommendNode){
					if ($temRecommendNode){
						$treeData = $temRecommendNode->TreeData->toArray();
						$recommendNodes[$key] = $temRecommendNode->toArray();
						$recommendNodes[$key]['TreeData'] = $treeData;
					}
				}
				$recommendNodes = TreeStruct::addNodesAttr($recommendNodes);
				$mainMenu[$value['id']]['recommendNodes'] = $recommendNodes;

				//子菜单
				$mainMenu[$value['id']]['children'] = array();
				$pid = $value['id'];
			} elseif ($value['lvl'] == $plvl+1){
				$pid2 = $value['id'];
				$mainMenu[$pid]['children'][$value['id']] = $value;
			} elseif ($value['lvl'] == $plvl+2){
				$mainMenu[$pid]['children'][$pid2]['children'][] = $value;
			}
		}
		$menus['mainMenu'] = $mainMenu;

		//二级菜单
		$temNodes = TreeStruct::find(array(
						'conditions' => 'pid=?1',
						'bind' => array(1=>$secMenuRootNid),
						'order' => 'lft asc',
					));
		$secMenu = array();
		foreach ($temNodes as $key=>$temNode){
			$treeData = $temNode->TreeData->toArray();
			$secMenu[$key] = $temNode->toArray();
			$secMenu[$key]['TreeData'] = $treeData;
		}
		$secMenu = TreeStruct::addNodesAttr($secMenu);
		$menus['secMenu'] = $secMenu;

		$this->_menus = $menus;
		$this->view->setVar("menus", $menus);
	}

	public function _initPageTitle($dispatcher){
		$pageTitle = $this->_siteConfig['pageTitle'][$dispatcher];
		switch ($dispatcher){
			case 'PageController-xtList':
			case 'PageController-list':
			case 'PageController-xtSingle':
			case 'PageController-single':
				foreach ($this->_params['nodeParents'] as $key=>$nodeParent){
					if ($nodeParent->lvl >= 2){
						$pageTitle[] = $nodeParent->TreeData->title;
					}
				}
				$pageTitle[] = $this->_params['node']->TreeData->title;
				break;
			case 'PageController-tagSingle':
				$pageTitle[] = $this->_params['tag']->name;
				break;
			case 'PageController-search':
				$kw = $this->_params['search_keyword'];
				$pageTitle[] = $kw ? $kw : '搜索';
				break;
			default:
				break;
		}
		foreach ($pageTitle as $value){
			if ($value){
				Tag::prependTitle($value);
			}
		}
	}
	public function _initMetaData($dispatcher){
		$defaultMetaData = $this->_siteConfig['defaultMetaData'];
		$metaData = $this->_siteConfig['pageMetaData'][$dispatcher];

		$keywords = $description = '';
		switch ($dispatcher){
			case 'PageController-xtList':
			case 'PageController-list':
				$keywords = $this->_params['node']->TreeData->title;
				foreach ($this->_params['nodeChilds'] as $nodeChild){
					$keywords .= ','. $nodeChild->TreeData->title;
				}
				foreach ($this->_params['nodeParents'] as $nodeParent){
					$keywords .= ','. $nodeParent->TreeData->title;
				}

				break;
			case 'PageController-xtSingle':
			case 'PageController-single':
				$keywords = $this->_params['node']->TreeData->title;
				foreach ($this->_params['nodeChilds'] as $nodeChild){
					$keywords .= ','. $nodeChild->TreeData->title;
				}
				$nodeTags = NodeTags::find(array(
								'conditions' => 'nid=?1',
								'bind' => array(1=>$this->_params['node']->id),
							));
				foreach ($nodeTags as $nodeTag){
					$keywords .= ','. $nodeTag->Tags->name;
				}
				foreach ($this->_params['nodeParents'] as $nodeParent){
					$keywords .= ','. $nodeParent->TreeData->title;
				}
				$description = $this->_params['node']->TreeData->summary;
				break;
			case 'PageController-tagSingle':
				$keywords = $this->_params['tag']->name;
				$description = $this->_params['tag']->name.':'.$this->_params['tag']->description;
				break;
			case 'PageController-search':
				$keywords = $this->_params['search_keyword'];
				break;
			default:
				break;
		}

		$metaData['keywords'] = $keywords ? $keywords.'，'.$metaData['keywords'] : $metaData['keywords'];
		$metaData['keywords'] = $metaData['keywords'] ? $metaData['keywords'].'，'.$defaultMetaData['keywords'] : $defaultMetaData['keywords'];
		$metaData['description'] = $description ? $description : $metaData['description'];
		$metaData['description'] = $metaData['description'] ? $metaData['description'] : $defaultMetaData['description'];
		$this->view->setVar("metaData", $metaData);
	}


	public function _initPageData($widgets){
		if (!is_array($widgets)){
			$widgetArrs[] = $widgets;
		} else {
			$widgetArrs = $widgets;
		}
		foreach ($widgetArrs as $widget){
			list($view, $block) = explode('--', $widget);
			$widgetData = $this->fetchWidgetData($view, $block);
			if ($block){
				$this->_pageData[$view][$block] = $widgetData[$block];
			} else {
				$this->_pageData[$view] = $widgetData;
			}
		}
		$this->view->setVar("pageData", $this->_pageData);
		return $this->_pageData;
	}

	public function _initBreadcrumb(){
		$breadcrumb = '';
		if ($this->_params['nid']){
			$path = '';
			foreach ($this->_params['nodeParents'] as $parentNode){
				$ptitle_en = $parentNode->TreeData->title_en;
				if (!$ptitle_en){
					continue;
				}
				$breadcrumb .= '<li><a href="'.$path.'/'.$ptitle_en.'/">'.$parentNode->TreeData->title.'</a></li>';
				$path .= '/'.$ptitle_en;
			}
			$appfix = $this->_params['node']->type == 'article' ? '/'.$this->_params['node']->id.'.html' : '/'.$this->_params['node']->TreeData->title_en.'/';
			$breadcrumb .= '<li class="active"><a href="'.$path.$appfix.'">'.$this->_params['node']->TreeData->title.'</a></li>';
		} elseif ($this->_params['tid']){
			$breadcrumb .= '<li><a href="/tag/'.$this->_params['tag']->pinyinPrefix.'/">标签</a></li>';
			$breadcrumb .= '<li class="active"><a href="/tag/'.$this->_params['tag']->id.'.html"></li>'.$this->_params['tag']->name.'</a>';
		}
		echo $breadcrumb;
		if ($breadcrumb){
			$breadcrumb = '<li><a href="/">首页</a></li>' . $breadcrumb;
		}
		return $breadcrumb;
	}

	/*
	 * widget:
	 * 	type		名称
	 * 	slider		幻灯片
	 * 	cidian		词典
	 * 	hangqing	行情
	 * 	lilv		利率
	 * 	tool		理财工具
	 * 	list		标题，内容列表
	 * 		article	文章
	 * 	listGroup	标题列表
	 * 	navTab		含有tab的panel
	 * 	panel		区块
	 *
	 */
	public function fetchWidgetData($view, $block=''){
		$widgetData = array();

		$blockCfgKey = $block ? $view.'_'.$block : $view;
		$blockCfg = $this->_siteConfig['blockCfg'][$blockCfgKey];
		$blockNum = $this->_siteConfig['widgetCfg']['blockNum'];
		switch ($view){
			case 'slider': //理财故事
			case 'btslider':
				$widgetData[$block] = array(
					'blockName' => $block,
					'items' => $this->_siteConfig['slider'][$block]
				);
				break;
			case 'dailyword':
				$dailyword['title'] = '天天词汇';
				$dailywordTids = $this->_siteConfig['dailywordTids'];
				shuffle($dailywordTids);
				$dailyword['word'] = Tags::findFirst(array(
										"conditions" => "is_cidian = ?1 and id = ?2",
										"bind"       => array(1 => 1, 2 => $dailywordTids[0])
									))->toArray();
				$widgetData = $dailyword;
				break;
			case 'content':
				switch ($block){
					case 'node':
						$content = TreeData::findFirst($this->_params['nid'])->toArray();
						$content['content'] = htmlspecialchars_decode($content['content']);
						$widgetData[$block]['content'] = $content;
						break;
					case 'tag':
						$content = Tags::findFirst($this->_params['tid'])->toArray();
						$content['content'] = htmlspecialchars_decode($content['description']);
						$content['title'] = $content['name'];
						$widgetData[$block]['content'] = $content;
						break;
					case 'static':
						$static_content = TreeStruct::findFirst(array(
										"conditions" => "pid = ?1",
										"bind"       => array(1 => $this->_params['nid']),
										'order' 	=> 'lft asc',
									));
						$content = array();
						if ($static_content){
							$content['title'] = $static_content->TreeData->title;
							$content['content'] = htmlspecialchars_decode($static_content->TreeData->content);
						}
						$widgetData[$block]['blockName'] = $block;
						$widgetData[$block]['content'] = $content;
						break;
					default:
						break;
				}
				break;
			case 'cidian':
				$cidianCloudNum = $this->_siteConfig['widgetCfg']['cidianCloudNum'];
				$tags = Tags::fetchCidiansCloud($cidianCloudNum);
				$widgetData = $tags;
				break;
			case 'hangqing':
			case 'lilv':
			case 'tool':
				break;
			case 'taglist':
				$taglist = array();
				$itemPer = $this->_siteConfig['widgetCfg']['listItemPer'];
				$start = ($this->_params['p']-1)*$itemPer;

				if ($this->_params['tagPrefix']){
					$conditions = 'pinyinPrefix="'.$this->_params['tagPrefix'].'" and is_cidian=1';
				} else {
					$conditions = 'is_cidian=1';
				}
				$taglist['items'] = Tags::find(array(
								'conditions' => $conditions,
								'order' => 'id desc',
								'limit' => array('number'=>$itemPer, 'offset'=>$start)
							))->toArray();

				$totalTags = Tags::count($conditions);
				$params = array(
							'total_rows'=>$totalTags,
							'now_page'  =>$this->_params['p'],
							'list_rows' =>$itemPer,
				);
				$pagerLib = new Pager($params);
				$pager = $pagerLib->show(3);
				$taglist['pager'] = $pager;
//				echo '<pre>';print_r($taglist);echo '</pre>';
				$widgetData = $taglist;
				break;
			case 'taglist_header':
				$optRanges = array(97, 122);
				$options = array();
				$options[] = '0-9';
				for($i=$optRanges[0]; $i<=$optRanges[1]; $i++){
					$options[] = chr($i);
				}
				$widgetData = $options;
				break;
			case 'list':
				switch ($block){
					case 'node':
						$nodeLists = array();
						$itemPer = $this->_siteConfig['widgetCfg']['listItemPer'];
						$start = ($this->_params['p']-1)*$itemPer;
						$temNodes = TreeStruct::find(array(
										'conditions' => 'lft>?1 and rgt<?2 and type=:type:',
										'bind' => array(1=>$this->_params['node']->lft, 2=>$this->_params['node']->rgt, 'type'=>'article'),
										'limit' => array('number'=>$itemPer, 'offset'=>$start),
										'order' => 'id desc',
									));
						$nodes = array();
						foreach ($temNodes as $key=>$temNode){
							$treeData = array();
							if ($temNode->TreeData){
								$treeData = $temNode->TreeData->toArray();
							}

							$nodes[$key] = $temNode->toArray();
							$nodes[$key]['TreeData'] = $treeData;
						}
						$nodes = TreeStruct::addNodesAttr($nodes, array('menu'=>true, 'menuLevel'=>1));

						$totalNodes = TreeStruct::count(array(
											'conditions' => 'lft>?1 and rgt<?2 and type=:type:',
											'bind' => array(1=>$this->_params['node']->lft, 2=>$this->_params['node']->rgt, 'type'=>'article'),
										));
						$params = array(
									'total_rows'=>$totalNodes,
									'now_page'  =>$this->_params['p'],
									'list_rows' =>$itemPer,
						);
						$pagerLib = new Pager($params);
						$pager = $pagerLib->show(3);

						$nodeLists['title'] = $this->_params['node']->TreeData->title;
						$nodeLists['pager'] = $pager;
						$nodeLists['items'] = $nodes;

						$widgetData[$block] = $nodeLists;
						break;
					case 'tagnode':
						$tagNodesNum = $this->_siteConfig['widgetCfg']['tagNodesNum'];
						$nodeLists = array();
						if ($tid = $this->_params['tid']){
							$tagNodes = NodeTags::find(array(
											'conditions' => 'tid='.$tid,
											'limit' => $tagNodesNum
										));
							$nodes = array();
							foreach ($tagNodes as $key=>$tagNode){
								$treeStruct = $tagNode->TreeStruct;
								$treeData = $treeStruct->TreeData->toArray();
								$nodes[$key] = $treeStruct->toArray();
								$nodes[$key]['TreeData'] = $treeData;
							}
							$nodes = TreeStruct::addNodesAttr($nodes, array('menu'=>true, 'menuLevel'=>2));
							$nodeLists['items'] = $nodes;
							$nodeLists['title'] = '"'.$this->_params['tag']->name.'" 相关文章';
						}
						$widgetData[$block] = $nodeLists;
						break;
					case 'search':
						$nodeLists = array();
						$keyword = $this->_params['search_keyword'];
						if ($keyword){
							$itemPer = $this->_siteConfig['widgetCfg']['listItemPer'];
							$start = ($this->_params['p']-1)*$itemPer;
							$temNodeDatas = TreeData::find(array(
											'conditions' => 'content like :keyword:',
											'bind' => array('keyword'=>'%'.$keyword.'%'),
											'limit' => array('number'=>$itemPer, 'offset'=>$start),
											'order' => 'id desc',
										));
							$nodes = array();
							foreach ($temNodeDatas as $key=>$temNodeData){
								$treeStruct = $temNodeData->TreeStruct;
								$treeData = $temNodeData->toArray();
								$nodes[$key] = $treeStruct->toArray();
								$nodes[$key]['TreeData'] = $treeData;
							}
							$nodes = TreeStruct::addNodesAttr($nodes, array('menu'=>true, 'menuLevel'=>2));

							$totalNodes = TreeData::count(array(
											'conditions' => 'content like :keyword:',
											'bind' => array('keyword'=>'%'.$keyword.'%'),
										));
							$params = array(
										'total_rows'=>$totalNodes,
										'now_page'  =>$this->_params['p'],
										'list_rows' =>$itemPer,
							);
							$pagerLib = new Pager($params);
							$pager = $pagerLib->show(3);

//							$nodeLists['is_search'] = 1;
							$searchResultStr = $totalNodes ? $totalNodes.' 条记录' : '没有记录';
							$nodeLists['title'] = '"'.$keyword.'" 的搜索结果: '.$searchResultStr;
							$nodeLists['pager'] = $pager;
							$nodeLists['items'] = $nodes;
						}
						$widgetData[$block] = $nodeLists;
						break;
					default:
						break;
				}
				break;
			case 'listGroup':
			case 'navTab':
			case 'panel':
			case 'panel2':
			case 'panel3':
				$widgetData[$block]['blockName'] = $block;
				$widgetData[$block]['items'] = array();
				if (isset($this->_siteConfig['blockCfg'][$view.'_'.$block])){
					$blockParams = $this->_siteConfig['blockCfg'][$view.'_'.$block];
					foreach ($blockParams as $blockParam){
						$nodeLists = array('title'=>$blockParam['title'], 'link'=> $blockParam['link'], 'data'=>array());
						$blockNode = TreeStruct::findFirst($blockParam['nid']);
						$temNodes = TreeStruct::find(array(
												'conditions' => "lft>?1 and rgt<?2 and type=:type:",
												'bind' => array(1=>$blockNode->lft, 2=>$blockNode->rgt, 'type'=>'article'),
												'limit' => $blockNum,
												'order' => 'id desc',
											));
						$nodes = array();
						foreach ($temNodes as $key=>$temNode){
							$treeData = array();
							if ($temNode->TreeData){
								$treeData = $temNode->TreeData->toArray();
							}
							$nodes[$key] = $temNode->toArray();
							$nodes[$key]['TreeData'] = $treeData;
						}
						$nodes = TreeStruct::addNodesAttr($nodes);
						$nodeLists['data'] = $nodes;
						$widgetData[$block]['items'][] = $nodeLists;
					}
				} else {
					$nodeLists = array('title'=>'', 'data'=>array());
					switch ($block){
						case 'hot':
							$nodeLists['title'] = '热门文章';

							$hotNids = $this->_siteConfig['hotNids'];
							$hotNidsStr = implode(',', $hotNids);
							$temNodes = TreeStruct::find(array(
													'conditions' => "id in (".$hotNidsStr.") and type=:type:",
													'bind' => array('type'=>'article'),
													'order' => 'id asc',
												));
							$nodes = array();
							foreach ($temNodes as $key=>$temNode){
								$treeData = $temNode->TreeData->toArray();
								$nodes[$key] = $temNode->toArray();
								$nodes[$key]['TreeData'] = $treeData;
							}
							$nodes = TreeStruct::addNodesAttr($nodes);
							$nodeLists['data'] = $nodes;
							break;
						case 'relation':
							$nodeLists['title'] = '相关文章';
							if ($this->_params['node']->type == 'article'){
								$temNodes = TreeStruct::find(array(
														'conditions' => "pid=?1 and type=:type:",
														'bind' => array(1=>$this->_params['node']->pid, 'type'=>'article'),
														'limit' => $blockNum,
														'order' => 'id desc',
													));
								$nodes = array();
								foreach ($temNodes as $key=>$temNode){
									$treeData = $temNode->TreeData->toArray();
									$nodes[$key] = $temNode->toArray();
									$nodes[$key]['TreeData'] = $treeData;
								}
								$nodes = TreeStruct::addNodesAttr($nodes);
								$nodeLists['data'] = $nodes;
							}
							break;
						default:
							break;
					}
					$widgetData[$block]['items'][] = $nodeLists;
				}
				break;
			case 'breadcrumb':
				$widgetData = $this->_initBreadcrumb();
				break;
			case 'nodetag':
				$temNodeTags = NodeTags::find(array(
								'conditions' => 'nid=?1',
								'bind' => array(1=>$this->_params['node']->id),
							));
				$nodeTags = array();
				foreach ($temNodeTags as $key=>$temNodeTag){
					$tag = $temNodeTag->Tags->toArray();
					$nodeTags[$key] = $temNodeTag->toArray();
					$nodeTags[$key]['Tags'] = $tag;
				}
				$widgetData = $nodeTags;
				break;
			case 'siblings':
				$siblings = array(
					'prev' => array('title'=>'上一篇', 'item'=>array()),
					'next' => array('title'=>'下一篇', 'item'=>array()),
				);
				switch ($block){
					case 'node':
						if ($this->_params['node']->type == 'article'){
							$prevNode = TreeStruct::findFirst(array(
													'conditions' => "lft<?1 and pid=?2 and type=:type:",
													'bind' => array(1=>$this->_params['node']->lft, 2=>$this->_params['node']->pid, 'type'=>'article'),
													'order' => 'lft desc',
												));
							$nextNode = TreeStruct::findFirst(array(
													'conditions' => "lft>?1 and pid=?2 and type=:type:",
													'bind' => array(1=>$this->_params['node']->lft, 2=>$this->_params['node']->pid, 'type'=>'article'),
													'order' => 'lft asc',
												));
							$temNodes = array('prev'=>$prevNode, 'next'=>$nextNode);
							$nodes = array();
							foreach ($temNodes as $key=>$temNode){
								if ($temNode){
									$treeData = $temNode->TreeData->toArray();
									$nodes[$key] = $temNode->toArray();
									$nodes[$key]['TreeData'] = $treeData;
									$nodes[$key]['title'] = $treeData['title'];
								}
							}
							$nodes = TreeStruct::addNodesAttr($nodes);

							$siblings['prev']['item'] = $nodes['prev'];
							$siblings['next']['item'] = $nodes['next'];
						}
						break;
					case 'tag':
						$siblings['prev']['title'] = '上一个';
						$siblings['next']['title'] = '下一个';

						if ($tag = $this->_params['tag']){
							$pinyinPrefix = $tag->pinyinPrefix;
							if (!$pinyinPrefix){
								break;
							}
							$prevTag = Tags::findFirst(array(
													'conditions' => "pinyinPrefix=:pinyin: and id<?1",
													'bind' => array('pinyin'=>$pinyinPrefix, 1=>$tag->id),
													'order' => 'id desc',
												));
							$prevTag = $prevTag ? $prevTag->toArray() : array();
							$nextTag = Tags::findFirst(array(
													'conditions' => "pinyinPrefix=:pinyin: and id>?1",
													'bind' => array('pinyin'=>$pinyinPrefix, 1=>$tag->id),
													'order' => 'id asc',
												));
							$nextTag = $nextTag ? $nextTag->toArray() : array();
							$tags = array('prev'=>$prevTag, 'next'=>$nextTag);
							$tags = Tags::addTagsAttr($tags);

							foreach ($tags as $key=>$tag){
								$tags[$key]['title'] = $tag['name'];
							}

							$siblings['prev']['item'] = $tags['prev'];
							$siblings['next']['item'] = $tags['next'];
						}
						break;
					default:
						break;
				}
				$widgetData[$block]['items'] = $siblings;
				break;
			case 'xtSidebars':
				$pNids = array($this->_params['node']->id);
				foreach ($this->_params['nodeParents'] as $nodeParent){
					$pNids[] = $nodeParent->id;
				}
				$xtSidebars = TreeStruct::getXtSidebars($pNids);
				$widgetData = $xtSidebars;
				break;
			case 'list_header':
				$list_header = array();
				$temNodes = count($this->_params['nodeChilds']) ? $this->_params['nodeChilds'] : $this->_params['nodeSiblings'];
				if ($temNodes){
					foreach ($temNodes as $key=>$temNode){
						$treeData = $temNode->TreeData->toArray();
						$list_header[$key] = $temNode->toArray();
						$list_header[$key]['TreeData'] = $treeData;

						$list_header[$key]['current'] = false;
						if ($this->_params['node']->id == $temNode->id){
							$list_header[$key]['current'] = true;
						}
					}
					$list_header = TreeStruct::addNodesAttr($list_header);
				}
				$widgetData = $list_header;
				break;
			case 'search_header':
				$search_result = array();
				$search_result['search_keyword'] = $this->_params['search_keyword'];
				if ($search_result['search_keyword']){
					$search_result['search_result_title'] = '<b>"'.$this->_params['search_keyword'].'</b>" 的搜索结果.';
				} else {
					$search_result['search_result_title'] = '请输入关键字搜索！';
				}

				$widgetData = $search_result;
				break;
			case 'sitemap':
				$sitemap = array();

				$sitemap['menus'] = $this->_menus;
				$allTags = array();
				$temTags = Tags::find(array(
											'conditions' => "",
											'order' => 'pinyinPrefix',
										))->toArray();
				$temTags = Tags::addTagsAttr($temTags);
				foreach ($temTags as $key=>$temTag){
					$pinyinKey = $temTag['pinyinPrefix'] ? trim($temTag['pinyinPrefix']) : '0-9';
					$allTags[$pinyinKey][] = $temTag;
				}
				unset($temTags);
				$sitemap['tags'] = $allTags;
//				echo '<pre>';print_r($sitemap);echo '</pre>';die();
				$widgetData = $sitemap;
				break;
			case 'notfound':
				$widgetData = '';
				break;
			case 'test':
				$result = 'test';
				$widgetData = $result;
				break;
			default:
				break;
		}
		return $widgetData;
	}

}