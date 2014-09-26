
<div class="footer">
	<div class="sub-nav">
		<?php $v30926324561iterator = $menus['secMenu']; $v30926324561incr = 0; $v30926324561loop = new stdClass(); $v30926324561loop->length = count($v30926324561iterator); $v30926324561loop->index = 1; $v30926324561loop->index0 = 1; $v30926324561loop->revindex = $v30926324561loop->length; $v30926324561loop->revindex0 = $v30926324561loop->length - 1; ?><?php foreach ($v30926324561iterator as $menu) { ?><?php $v30926324561loop->first = ($v30926324561incr == 0); $v30926324561loop->index = $v30926324561incr + 1; $v30926324561loop->index0 = $v30926324561incr; $v30926324561loop->revindex = $v30926324561loop->length - $v30926324561incr; $v30926324561loop->revindex0 = $v30926324561loop->length - ($v30926324561incr + 1); $v30926324561loop->last = ($v30926324561incr == ($v30926324561loop->length - 1)); ?>
		<a href="<?php echo $menu['link']; ?>"><?php echo $menu['TreeData']['title']; ?></a><?php if (!$v30926324561loop->last) { ?>|<?php } ?>
		<?php $v30926324561incr++; } ?>
	</div>
	<div class="copyright">
		<p><?php echo $siteConfig['footerCft']['cright']; ?></p>
		<p><?php echo $siteConfig['footerCft']['contentFrom']; ?></p>
		<p><?php echo $siteConfig['footerCft']['tips']; ?></p>
	</div>
</div>