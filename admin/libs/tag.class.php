<?php
include_once 'model.class.php';

class Tag extends Model{
	public $_table = 'tags';
	public function __construct(){
		parent::__construct();
	}

	public function countTags($condition = array(), $filter=false){
		if ($filter){
			$where = '';
			if ($from_id = $condition['from_id'] && $to_id = $condition['to_id']){
				$where .= $where ? ' and id between '.$from_id.' and '.$to_id : ' id between '.$from_id.' and '.$to_id;
			} elseif ($from_id = $condition['from_id']){
				$where .= $where ? ' and id >= '.$from_id : ' id >= '.$from_id;
			} elseif ($to_id = $condition['to_id']){
				$where .= $where ? ' and id <= '.$to_id : ' id <= '.$to_id;
			}
			if ($title = $condition['title']){
				$where .= $where ? ' and name like "%'.$title.'%"' : ' name like "%'.$title.'%"';
			}
			$sql = 'select count(*) as num from '.$this->_table.' where'.$where.$orderby;
			$tags = $this->_db->query($sql);
		} else {
			$tags = $this->_db->select($this->_table, $condition, '', array('count(*) as num'));
		}
		return $tags[0]['num'];
	}

	public function getTags($condition = array(), $indexKey='', $filter=false, $limit=' limit 0,20'){
		if ($filter){
			$where = '';
			if ($from_id = $condition['from_id'] && $to_id = $condition['to_id']){
				$where .= $where ? ' and id between '.$from_id.' and '.$to_id : ' id between '.$from_id.' and '.$to_id;
			} elseif ($from_id = $condition['from_id']){
				$where .= $where ? ' and id >= '.$from_id : ' id >= '.$from_id;
			} elseif ($to_id = $condition['to_id']){
				$where .= $where ? ' and id <= '.$to_id : ' id <= '.$to_id;
			}
			if ($title = $condition['title']){
				$where .= $where ? ' and name like "%'.$title.'%"' : ' name like "%'.$title.'%"';
			}
			if ($order = $condition['order']){
				$orderby = ' order by '.$order;
			}
			$sql = 'select * from '.$this->_table.' where'.$where.$orderby;
			$tags = $this->_db->query($sql, $indexKey);
		} else {
			$tags = $this->_db->select($this->_table, $condition, $indexKey, array(), '', $limit);
		}
		return $tags;
	}

	public function updateTag($params){
		$id = $params['id'];
		unset($params['id']);
		if ($id){
			$res = $this->_db->update($this->_table, $params, array('id'=>$id));
		} else {
			$res = $this->_db->insert($this->_table, $params);
		}
		return $res;
	}

	public function delTag($id){
		$res = $this->_db->update($this->_table, array('status'=>0), array('id'=>$id));
		return $res;
	}

	//新的后台筛选还是
	public function filterTags($params){
		$result = array();

		$defaultParams = array(
			'tlat_startid' => 0,
			'tlat_endid' => 0,
			'tlat_name' => '',
			'tlat_desc' => '',
			'tlat_is_cidian' => 10,
			'tlat_status' => 10,

			'page' => 1,
			'pagesize' => 20,
			'order' => array('key'=>'','type'=>'')
		);
		$params = $params + $defaultParams;

		$whereSql = ' where 1';
		if ($params['tlat_startid']){
			$whereSql .= ' and id>='.$params['tlat_startid'];
		}
		if ($params['tlat_endid']){
			$whereSql .= ' and id<='.$params['tlat_endid'];
		}
		if ($params['tlat_name']){
			$whereSql .= ' and name like "%'.$params['tlat_name'].'%"';
		}
		if ($params['tlat_desc']){
			$whereSql .= ' and description like "%'.$params['tlat_desc'].'%"';
		}
		if ($params['tlat_is_cidian']!=10){
			$whereSql .= ' and is_cidian='.$params['tlat_is_cidian'];
		}
		if ($params['tlat_status']!=10){
			$whereSql .= ' and status='.$params['tlat_status'];
		}
		$start = ($params['page'] - 1) * $params['pagesize'];
		$limitSql = $params['pagesize']>0 ? ' limit '.$start.','.$params['pagesize'] : '';

		$orderSql = ' order by id desc';
		if ($params['order']['key']){
			$orderSql = ' order by '.$params['order']['key'];
			$orderSql .= $params['order']['type']=='order_asc' ? ' asc' : ' desc';
		}

		$countSql = 'select count(*) as num from '.$this->_table.$whereSql;
		$countTags = $this->_db->query($countSql);
		$result['total'] = $countTags[0]['num'];

		$fetchSql = 'select * from '.$this->_table.$whereSql.$orderSql.$limitSql;
		$tags = $this->_db->query($fetchSql);
		$result['list'] = $tags;

		return $result;
	}
}