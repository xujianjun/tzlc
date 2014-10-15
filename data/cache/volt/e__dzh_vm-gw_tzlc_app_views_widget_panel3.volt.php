
<div class="widget widget-panel2">
	<div class="w-title">
		<div class="title fleft"><h3><b><a href="<?php echo $items[0]['link']; ?>"><?php echo $items[0]['title']; ?></a></b></h3></div>
		<div class="seperate fleft">&nbsp;</div>
		<div class="more fright"><a href="<?php echo $items[0]['link']; ?>">更多&gt;&gt;</a></div>
	</div>
	<div class="clear"></div>
	<div class="w-header">
		<a class="fleft" href="<?php echo $siteConfig['cfshHeadNode']['lcgs']['link']; ?>" title="<?php echo $siteConfig['cfshHeadNode']['lcgs']['title']; ?>"><img src="<?php echo $siteConfig['cfshHeadNode']['lcgs']['img_path']; ?>" width="80" height="80" alt="<?php echo $siteConfig['cfshHeadNode']['lcgs']['alt']; ?>" title="<?php echo $siteConfig['cfshHeadNode']['lcgs']['title']; ?>" /></a>
		<div class="fright">
			<h3><a href="<?php echo $siteConfig['cfshHeadNode']['lcgs']['link']; ?>" title="<?php echo $siteConfig['cfshHeadNode']['lcgs']['title']; ?>"><?php echo $siteConfig['cfshHeadNode']['lcgs']['title']; ?></a></h3>
			<p><?php echo $siteConfig['cfshHeadNode']['lcgs']['desc']; ?></p>
		</div>
	</div>
	<div class="clear"></div>
	<ul class="w-list">
		<?php foreach ($items[0]['data'] as $value) { ?>
        <li><a href="<?php echo $value['link']; ?>" title="<?php echo $value['TreeData']['title']; ?>"><?php echo $value['TreeData']['title']; ?></a></li>
        <?php } ?>
	</ul>
</div>