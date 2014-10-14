<?php

/**
 * 分页类
 *
 * @author JiangJian <silverd@sohu.com>
 * @copyright 2011-2012 xiangle.com
 * $Id: Page.php 1152 2012-02-22 04:50:49Z lujun $
 * @version    2011-06-02  ::  JiangJian  ::  Create File
 */
class Pager
{
    /**
     * 底部分页条
     *
     * @param int       $total        总记录数
     * @param int       $pageSize     每页几条
     * @param int       $curPage      当前页码
     * @param string    $mpurl        基本URL
     * @param array     $params       附加参数
     * @param int       $adjacents    相邻页码按钮数
     * @param string    $auchor       跳转后定位锚点
     * @return string
     */
    public function get($total, $pageSize, $curPage, $mpurl, $params = array(), $adjacents = 2, $auchor = '')
    {
    	/*<div class="pagination">
<a class="first" href="#">&lt;&lt;</a>
<a class="prev" href="#">&lt;</a>
<a href="#" class="current">1</a>
<a href="#">2</a><a href="#">3</a>
<a href="#">4</a>...<a href="#">8</a>
<a href="#">9</a><a href="#">10</a>
<a class="next" href="#">&gt;</a>
<a class="end" href="#">&gt;&gt;</a>
</div>*/
        $multipage = '';
        $mpurl     = self::setMpUrl($mpurl, $params);
        $realpages = 1;

        if ($total > $pageSize) {
            $realpages = @ceil($total / $pageSize);
            $maxpage   = 10000;
            $pages     = $maxpage && $maxpage < $realpages ? $maxpage : $realpages;

            $multipage .= '<a class="first" title="第一页" href="' . $mpurl . '&page=' . 1 . $auchor . '">&lt;&lt;</a>';

            // 上一页
            if ($curPage > 1) {
                $multipage .= '<a title="上一页" class="prev" href="' . $mpurl . '&page=' . ($curPage - 1) . $auchor . '">&lt;</a>';
            }

            // 第一页
            if ($curPage > ($adjacents + 1)) {
                $multipage .= '<a href="' . $mpurl . $auchor . '" >1</a>';
            }

            // 间隔
            if ($curPage > ($adjacents + 2)) {
                $multipage .= '<span class="simple">...</span>';
            }

            $from = ($curPage > $adjacents) ? ($curPage - $adjacents) : 1;
            $to   = ($curPage < ($pages - $adjacents)) ? ($curPage + $adjacents) : $pages;

            for ($i = $from; $i <= $to; $i++) {
                if ($i == $curPage) {
                    $multipage .= '<a href="#" class="current">' . $i . '</a>';
                } elseif ($i == 1) {
                    $multipage .= '<a href="' . $mpurl . $auchor . '" title="' . $i . '">' . $i . '</a>';
                } else {
                    $multipage .= '<a href="' . $mpurl . '&page=' . $i . $auchor . '" title="' . $i . '">' . $i . '</a>';
                }
            }

            // 间隔
            if ($curPage < ($pages - $adjacents - 1)) {
                $multipage .= '...';
            }

            // 最后一页
            if ($curPage < ($pages - $adjacents)) {
                $multipage .= '<a href="' . $mpurl . '&page=' . $pages . $auchor . '" title="' . $pages . '">' . $pages . '</a>';
            }

            // 下一页
            if ($curPage < $pages) {
                $multipage .= '<a href="' . $mpurl . '&page=' . ($curPage + 1) . $auchor . '" title="下一页" class="next">&gt;</a>';
            }

            $multipage .= '<a class="end" href="' . $mpurl . '&page=' . $pages . $auchor . '">&gt;&gt;</a>';

            $multipage = $multipage ? $multipage : '';
        } else {
        	$multipage = '<a class="first" href="javascript:;">&lt;&lt;</a><a href="javascript:;">1</a><a class="end" href="javascript:;">&gt;&gt;</a>';
        }
        return $multipage;
    }

    public static function page2($mpurl, $params1, $params2, $type)
    {
        $mpurl1     = self::setMpUrl($mpurl, $params1);
        $mpurl2     = self::setMpUrl($mpurl, $params2);
        if (1 == $type) {
            return '<a>结果只有一页</a>';
        }

        if (2 == $type ) {
            return '<a href="' . $mpurl1 . '&pageT=n" >下一页</a>';
        }

        if (3 == $type ) {
            return '<a  href="' . $mpurl2 . '&pageT=u">上一页</a>';
        }

        $multipage = '<a  href="' . $mpurl2 . '&pageT=u">上一页</a><a href="' . $mpurl1 . '&pageT=n" >下一页</a>';

        return $multipage;
    }



    /**
     * 根据条件组合生成 URL
     *
     * @param string $mpurl 基本URL
     * @param array $params 附加参数
     * @return string
     */
    public static function setMpUrl($mpurl, $params = array())
    {
        if (strpos($mpurl, '?') === false && substr($mpurl, -1, 1) != '/') {
            $mpurl .= '/';
        }
        $mpurl .= (strpos($mpurl, '?') === false ? '?' : '&') ;

        $mpurl .= self::httpBuildQuery($params);

        return $mpurl;
    }

    public Static function httpBuildQuery($params)
    {
    	$paramUrl = '';
    	if ($params) {
        	foreach ($params as $key => $val) {
        		if (is_array($val)) {
        			foreach ($val as $val1) {
        				$paramUrl .= '&' . $key .'[]=' .  $val1;
        			}
        		} else {
        			$paramUrl .= '&' . $key . '=' . $val;
        		}
        	}
        }
        return $paramUrl;
    }

}