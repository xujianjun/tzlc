<?php echo $this->partial('widget/list_header', array('list_header' => $pageData['list_header'])); ?>
<?php echo $this->partial('widget/breadcrumb', array('breadcrumb' => $pageData['breadcrumb'])); ?>
<?php echo $this->partial('widget/list', array('title' => $pageData['list']['node']['title'], 'items' => $pageData['list']['node']['items'], 'pager' => $pageData['list']['node']['pager'])); ?>