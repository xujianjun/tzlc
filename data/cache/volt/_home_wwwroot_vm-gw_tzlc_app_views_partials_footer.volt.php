
<div class="footer">
	<div class="sub-nav">
		<?php $v8596268831iterator = $menus['secMenu']; $v8596268831incr = 0; $v8596268831loop = new stdClass(); $v8596268831loop->length = count($v8596268831iterator); $v8596268831loop->index = 1; $v8596268831loop->index0 = 1; $v8596268831loop->revindex = $v8596268831loop->length; $v8596268831loop->revindex0 = $v8596268831loop->length - 1; ?><?php foreach ($v8596268831iterator as $menu) { ?><?php $v8596268831loop->first = ($v8596268831incr == 0); $v8596268831loop->index = $v8596268831incr + 1; $v8596268831loop->index0 = $v8596268831incr; $v8596268831loop->revindex = $v8596268831loop->length - $v8596268831incr; $v8596268831loop->revindex0 = $v8596268831loop->length - ($v8596268831incr + 1); $v8596268831loop->last = ($v8596268831incr == ($v8596268831loop->length - 1)); ?>
		<a href="<?php echo $menu['link']; ?>"><?php echo $menu['TreeData']['title']; ?></a><?php if (!$v8596268831loop->last) { ?>|<?php } ?>
		<?php $v8596268831incr++; } ?>
	</div>
	<div class="copyright">
		<p><?php echo $siteConfig['footerCft']['cright']; ?></p>
		<p><?php echo $siteConfig['footerCft']['contentFrom']; ?></p>
		<p><?php echo $siteConfig['footerCft']['tips']; ?></p>
	</div>
</div>