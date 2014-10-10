
<div class="panel panel-primary">
    <div class="panel-heading">
      <div class="panel-title"><b><a href="<?php echo $items[0]['link']; ?>"><?php echo $items[0]['title']; ?></a></b></div>
      <div class="more fright"><a href="<?php echo $items[0]['link']; ?>">更多&gt;&gt;</a></div>
    </div>
    <div class="panel-body">
      	<ul class="tl-panel-list list-unstyled">
      		<?php foreach ($items[0]['data'] as $value) { ?>
			<li><a href="<?php echo $value['link']; ?>"><?php echo $value['TreeData']['title']; ?></a></li>
			<?php } ?>
	  	</ul>
    </div>
  </div>