<?php
include_once 'model.class.php';

class Tool extends Model{
	public $_TreeStructTable = 'tree_struct';
	public $_TreeDataTable = 'tree_data';
	public $_TagsTable = 'tags';
	public $_NodeTagsTable = 'node_tags';

	public $_RootTreeId = 0;
	public $_BaseUrl = 'http://www.licaimap.com';
	public function __construct(){
		parent::__construct();
	}

	public function updateNodeTag($type, $nid=0, $pass=''){
		$res = false;
		$tags = $this->_db->select($this->_TagsTable, array('status'=>1), 'id', array(), 'order by id');
		if (!count($tags)){
			return $res;
		}

		$aLft = 2;
		$aRgt = 5703;
		$whereSql = ' where ts.lft>'.$aLft.' and ts.rgt<'.$aRgt.' ';

		$selSql = '';
		switch ($type){
			case 'delete':
				if ($pass != 'licaimaproot123'){
					return $res;
				}
				$delSql = 'delete from '.$this->_NodeTagsTable;
				$delSql .= $nid ? ' where nid='.$nid : ' where 1=1';
				$this->_db->query($delSql);
				return true;
				break;
			case 'node':
				$selSql = 'select ts.*,td.title,td.content from tree_struct ts ' .
						'left join tree_data td on ts.id=td.id ' .
						$whereSql.' and (ts.type="default" or ts.id='.$nid.') order by ts.lft';
				break;
			case 'simple':
				$selSql = 'select ts.*,td.title,td.content from tree_struct ts ' .
						'left join node_tags nt on ts.id=nt.nid ' .
						'left join tree_data td on ts.id=td.id ' .
						$whereSql.' and (ts.type="default" or nt.nid is null) order by ts.lft';
				break;
			case 'all':
				$selSql = 'select ts.*,td.title,td.content from tree_struct ts ' .
						'left join tree_data td on ts.id=td.id ' .
						$whereSql.' order by ts.lft';
				break;
			default:
				break;
		}
//		$selSql .= ' limit 10';
//		echo $selSql.'<br>';
		if (!$selSql){ return $res; }
		$nodes = $this->_db->query($selSql);
		$total = count($nodes);
//		echo '<pre>';print_r($nodes);echo '</pre>';
		$index = 0;
		$parentParams = array();
		$parentType = 'default';
		foreach ($nodes as $node){
			$index++;
			//计算父名称数组
			if ($node['type']=='default'){
				if ($parentType != 'default'){
					array_pop($parentParams);
					for ($i = count($parentParams)-1;$i>=0;$i--){
						if ($parentParams[$i]['lft']>$node['lft'] || $parentParams[$i]['rgt']<$node['rgt']){
							array_pop($parentParams);
						}
					}
				}
				$parentParams[] = array('title'=>$node['title'], 'lft'=>$node['lft'], 'rgt'=>$node['rgt']);
				$parentType = $node['type'];
				continue;
			} else {
				$parentType = $node['type'];
			}
			$parentTitles = array();
			foreach ($parentParams as $parentParam){
				$parentTitles[] = $parentParam['title'];
			}
//			echo '<pre>';print_r($parentTitles);echo '</pre>';
			//计算父名称数组 end

			$ntitle = $node['title'];
			$ncontent = $node['content'];

			$nodeTids = array();
			$cutNum = 5;
			foreach  ($tags as $tag){
				$tagname = $tag['name'];
				if (count($parentTitles) && in_array($tagname, $parentTitles)){
					$nodeTids[$tag['id']] = 10000;
					$cutNum++;
					continue;
				}

				$MatchNum = preg_match_all('/'.$tagname.'/i', $ntitle, $matches1) + preg_match_all('/'.$tagname.'/i', $ncontent, $matches2);
				if ($MatchNum > 0){
					$nodeTids[$tag['id']] = $MatchNum;
				}
			}
			arsort($nodeTids);
			$nodeTids = array_slice($nodeTids, 0, $cutNum, true);
			foreach ($nodeTids as $nodeTid=>$num){
				$insql = 'insert into node_tags values('.$node['id'].','.$nodeTid.')';
				$this->_db->query($insql);
				$line = 'nid:'.$node['id'].', ntitle:'.$ntitle.', tid:'.$nodeTid.', tname:'.$tags[$nodeTid]['name'].', num:'.$num;
				echo $line.'<br>';
				ob_flush();
				flush();
			}
		}

		return true;
	}
	public function updateTreePos(){
		$treeDirs = $this->_db->select($this->_TreeStructTable, array('type' => 'default'), '', array(), 'order by id');
		if ($treeDirs){
			foreach ($treeDirs as $treeDir){
				$treeArticles = $this->_db->select($this->_TreeStructTable, array('pid'=>$treeDir['id']), '', array(), 'order by lft');
				if ($treeArticles){
					$i = 0;
					foreach ($treeArticles as $treeArticle){
						$this->_db->update($this->_TreeStructTable, array('pos'=>$i), array('id'=>$treeArticle['id']));
						$i++;
					}
				}
			}
		}
		return true;
	}

	public function updateTreeLR(){
		$trees = $this->getTrees();
		$this->regenerateTreeLR($trees);
		$this->updateTreeLRDatas($trees);
		return true;
	}
	function updateTreeLink(){
		$sql = 'select ts.*,td.* from '.$this->_TreeStructTable.' ts left join '.$this->_TreeDataTable.' td on ts.id=td.id ' .
				'where ts.lvl>=2 order by ts.lft';
		$rows = $this->_db->query($sql);
		$sitemap = '';
		$basePath = array();
		$pathStr = '';
		$parentType = 'default';
		foreach ($rows as $row){
			if ($row['type']=='default'){
				if ($parentType != 'default'){
					array_pop($basePath);
					for ($i = count($basePath)-1;$i>=0;$i--){
						if ($basePath[$i]['lft']>$row['lft'] || $basePath[$i]['rgt']<$row['rgt']){
							array_pop($basePath);
						}
					}
				}
				$basePath[] = array('title_en'=>$row['title_en'], 'lft'=>$row['lft'], 'rgt'=>$row['rgt']);
				$pathStr = '';
				if (count($basePath)){
					foreach ($basePath as $value){
						if ($value['title_en']){
							$pathStr .= $pathStr ? $value['title_en'].'/' : '/'.$value['title_en'].'/';
						}
					}
				}
				$path = $pathStr;
			} else {
				$path = $pathStr.$row['id'].'.html';
			}
			$parentType = $row['type'];

			$this->_db->update($this->_TreeDataTable, array('link'=>$path), array('id'=>$row['id']));
		}
		return true;
	}

	public function updateTagPinyin(){
		$rows = $this->_db->select($this->_TagsTable, array('pinyinPrefix' => ''), '', array(), 'order by id');
		$total = count($rows);
		$index = 0;
		foreach ($rows as $row){
			$index++;
			$pinyinPrefix = strtolower($this->getfirstchar($row['name']));
			if (ord($pinyinPrefix)<10){
				$pinyinPrefix = 1;
			}
			if ($pinyinPrefix){
				$this->_db->update($this->_TagsTable, array('pinyinPrefix'=>$pinyinPrefix), array('id'=>$row['id']));
			}
		}
		return true;
	}
	public function updateSitemap($file){
		file_put_contents($file, '');
		$this->initTagSitemaps($file);
		$this->initTreeSitemaps2($file);
		return true;
	}


	public function updateTreeLRDatas($trees){
		foreach ($trees as $tree){
			$new_lft = $tree['new_lft'];
			$new_rgt = $tree['new_rgt'];
			$this->_db->update($this->_TreeStructTable, array('lft'=>$new_lft, 'rgt'=>$new_rgt), array('id'=>$tree['id']));
			if (isset($tree['children']) && count($tree['children'])){
				$this->updateTreeLRDatas($tree['children']);
			}
		}
	}
	public function regenerateTreeLR(&$trees, $lft=0){
		$lft += 1;
		foreach ($trees as $key=>&$tree){
			$tree["new_lft"] = $lft;
			if (isset($tree['children']) && count($tree['children'])){
				$new_rgt = $this->regenerateTreeLR($tree['children'], $lft);
			} else {
				$new_rgt = $lft+1;
			}
			$tree['new_rgt'] = $new_rgt;
			$lft = $new_rgt + 1;
		}
		return $new_rgt+1;
	}

	public function getTrees(){
		$trees = array();

		$temTrees = $this->_db->select($this->_TreeStructTable, array('pid'=>$this->_RootTreeId), '', array(), 'order by id');
		foreach ($temTrees as $temTree){
			$trees[$temTree['id']] = $temTree;
			if ($temTree['lft']+1<$temTree['rgt']){
				$trees[$temTree['id']]['children'] = $this->getTreeChilds($temTree['id']);
			}
		}
		return $trees;
	}
	public function getTreeChilds($id){
		$children = array();

		$temChildren = $this->_db->select($this->_TreeStructTable, array('pid'=>$id), '', array(), 'order by lft');
		foreach ($temChildren as $temChild){
			$children[$temChild['id']] = $temChild;
			if ($temChild['type']!='article'){
				$children[$temChild['id']]['children'] = $this->getTreeChilds($temChild['id']);
			}
		}
		return $children;
	}

	public function getfirstchar($s0){
		$firstchar_ord=ord(strtoupper($s0{0}));
		if (($firstchar_ord>=65 and $firstchar_ord<=91)or($firstchar_ord>=48 and $firstchar_ord<=57)) return $s0{0};
		$s=iconv("UTF-8","gb2312", $s0);
		$asc=ord($s{0})*256+ord($s{1})-65536;
		if($asc>=-20319 and $asc<=-20284)return "A";
		if($asc>=-20283 and $asc<=-19776)return "B";
		if($asc>=-19775 and $asc<=-19219)return "C";
		if($asc>=-19218 and $asc<=-18711)return "D";
		if($asc>=-18710 and $asc<=-18527)return "E";
		if($asc>=-18526 and $asc<=-18240)return "F";
		if($asc>=-18239 and $asc<=-17923)return "G";
		if($asc>=-17922 and $asc<=-17418)return "H";
		if($asc>=-17417 and $asc<=-16475)return "J";
		if($asc>=-16474 and $asc<=-16213)return "K";
		if($asc>=-16212 and $asc<=-15641)return "L";
		if($asc>=-15640 and $asc<=-15166)return "M";
		if($asc>=-15165 and $asc<=-14923)return "N";
		if($asc>=-14922 and $asc<=-14915)return "O";
		if($asc>=-14914 and $asc<=-14631)return "P";
		if($asc>=-14630 and $asc<=-14150)return "Q";
		if($asc>=-14149 and $asc<=-14091)return "R";
		if($asc>=-14090 and $asc<=-13319)return "S";
		if($asc>=-13318 and $asc<=-12839)return "T";
		if($asc>=-12838 and $asc<=-12557)return "W";
		if($asc>=-12556 and $asc<=-11848)return "X";
		if($asc>=-11847 and $asc<=-11056)return "Y";
		if($asc>=-11055 and $asc<=-10247)return "Z";
		return null;
	}

	public function initTagSitemaps($file){
		$rows = $this->_db->select($this->_TagsTable, array('status'=>1), '', array(), 'order by id');
		$sitemap = '';
		foreach ($rows as $row){
			$line = $this->_BaseUrl.'/tag/'.$row['id'].'.html';
			$this->writeToTxt($file, $line);
		}
	}
	public function initTreeSitemaps2($file){
		$rows = $this->_db->select($this->_TreeDataTable, 'link!=""', '', array(), 'order by id');
		foreach ($rows as $row){
			$line = $this->_BaseUrl.$row['link'];
			$this->writeToTxt($file, $line);
		}
	}

	public function initTreeSitemaps($file){
		$sql = 'select ts.*,td.* from '.$this->_TreeStructTable.' ts left join '.$this->_TreeDataTable.' td on ts.id=td.id ' .
				'where ts.lvl>=2 and ts.lft>2 and ts.rgt<5693 order by ts.lft';
		$rows = $this->_db->query($sql);

		$sitemap = '';
		$basePath = array();
		$pathStr = '/';
		$parentType = 'default';
		foreach ($rows as $row){
			if ($row['type']=='default'){
				if ($parentType != 'default'){
					array_pop($basePath);
					for ($i = count($basePath)-1;$i>=0;$i--){
						if ($basePath[$i]['lft']>$row['lft'] || $basePath[$i]['rgt']<$row['rgt']){
							array_pop($basePath);
						}
					}
				}
				$basePath[] = array('title_en'=>$row['title_en'], 'lft'=>$row['lft'], 'rgt'=>$row['rgt']);
				$pathStr = '/';
				if (count($basePath)){
					foreach ($basePath as $value){
						$pathStr .= $value['title_en'].'/';
					}
				}
				$path = $pathStr;
			} else {
				$path = $pathStr.$row['id'].'.html';
			}
			$line = $this->_BaseUrl.$path;
			$this->writeToTxt($file, $line);
			$parentType = $row['type'];
		}
	}
	public function writeToTxt($file, $line){
		file_put_contents($file, $line."\n", FILE_APPEND);
	}
}