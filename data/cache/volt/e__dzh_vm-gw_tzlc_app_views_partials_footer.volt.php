
<div class="footer">
	<div class="sub-nav">
		<?php $v18445742541iterator = $menus['secMenu']; $v18445742541incr = 0; $v18445742541loop = new stdClass(); $v18445742541loop->length = count($v18445742541iterator); $v18445742541loop->index = 1; $v18445742541loop->index0 = 1; $v18445742541loop->revindex = $v18445742541loop->length; $v18445742541loop->revindex0 = $v18445742541loop->length - 1; ?><?php foreach ($v18445742541iterator as $menu) { ?><?php $v18445742541loop->first = ($v18445742541incr == 0); $v18445742541loop->index = $v18445742541incr + 1; $v18445742541loop->index0 = $v18445742541incr; $v18445742541loop->revindex = $v18445742541loop->length - $v18445742541incr; $v18445742541loop->revindex0 = $v18445742541loop->length - ($v18445742541incr + 1); $v18445742541loop->last = ($v18445742541incr == ($v18445742541loop->length - 1)); ?>
		<a href="<?php echo $menu['link']; ?>"><?php echo $menu['TreeData']['title']; ?></a><?php if (!$v18445742541loop->last) { ?>|<?php } ?>
		<?php $v18445742541incr++; } ?>
	</div>
	<div class="copyright">
		<p><?php echo $siteConfig['footerCft']['cright']; ?></p>
		<p><?php echo $siteConfig['footerCft']['contentFrom']; ?></p>
		<p><?php echo $siteConfig['footerCft']['tips']; ?></p>
	</div>
</div>