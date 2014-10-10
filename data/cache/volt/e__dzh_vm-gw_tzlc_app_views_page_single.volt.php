<?php echo $this->partial('widget/breadcrumb', array('breadcrumb' => $pageData['breadcrumb'])); ?>
<?php echo $this->partial('widget/bdshare', array('bdshare' => $pageData['bdshare'])); ?>
<?php echo $this->partial('widget/nodetag', array('nodetag' => $pageData['nodetag'])); ?>
<?php echo $this->partial('widget/content', array('content' => $pageData['content']['node']['content'])); ?>
<?php echo $this->partial('widget/bdshare', array('bdshare' => $pageData['bdshare'])); ?>
<?php echo $this->partial('widget/siblings', array('items' => $pageData['siblings']['node']['items'])); ?>
<?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['relation']['items'])); ?>