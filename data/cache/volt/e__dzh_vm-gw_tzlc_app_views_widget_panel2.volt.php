
<div class="widget widget-panel2">
	<div class="w-title">
		<div class="title fleft"><h3><b><a href="<?php echo $items[0]['link']; ?>"><?php echo $items[0]['title']; ?></a></b></h3></div>
		<div class="seperate fleft">&nbsp;</div>
		<div class="more fright"><a href="<?php echo $items[0]['link']; ?>">更多&gt;&gt;</a></div>
	</div>
	<div class="clear"></div>
	<?php foreach ($items[0]['data'] as $key => $value) { ?>
	<div class="w-header">
		<a class="fleft" href="<?php echo $value['link']; ?>" title="<?php echo $value['TreeData']['title']; ?>"><img src="/img/cfsh/tzal-<?php echo $key + 1; ?>.jpg" width="80" height="80" alt="<?php echo $value['TreeData']['title']; ?>" title="<?php echo $value['TreeData']['title']; ?>"></a>
		<div class="fright">
			<h3><a href="<?php echo $value['link']; ?>" title="<?php echo $value['TreeData']['title']; ?>"><?php echo $value['TreeData']['title']; ?></a></h3>
			<div class="desc"><?php echo $value['TreeData']['summary']; ?></div>
		</div>
	</div>
	<?php } ?>
</div>