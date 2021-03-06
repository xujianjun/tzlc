<?php

use Phalcon\Mvc\Model;

class Tags extends Model
{
    public function initialize()
	{
		$this->hasMany('id', 'ArticleTags', 'tid');
	}

	public static function fetchCidiansCloud($cidianCloudNum){
		$totalTags = Tags::count(array(
									'conditions'=>'is_cidian=?1 and status=?2',
									'bind'=>array(1=>1, 2=>1),
								));
		$randStart = mt_rand(0, $totalTags-$cidianCloudNum);
		$tags = Tags::find(array(
							'conditions'=>'is_cidian=?1 and status=?2',
							'bind'=>array(1=>1, 2=>1),
							'limit'=>array(
								'number'=>$cidianCloudNum,
								'offset'=>$randStart
							)
						))->toArray();

		$cidianBgs = array(1, 3);
		foreach ($tags as $key=>$tag){
			$randBg = mt_rand($cidianBgs[0], $cidianBgs[1]);
			$tags[$key]['randBg'] = $randBg;
		}
		return $tags;
	}

	public static function addTagsAttr($tags){
		foreach ($tags as $key=>$tag){
			$tid = $tag['id'];
			$tags[$key]['link'] = $tid ? '/tag/'.$tid.'.html' : '#';
		}
		return $tags;
	}
}
