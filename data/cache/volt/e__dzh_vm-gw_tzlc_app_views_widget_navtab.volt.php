
<div class="tl-nav-tab">
	<ul class="nav nav-tabs nav-justified">
	  <?php foreach ($items as $key => $item) { ?>
	  <li <?php if ($key == 0) { ?>class="active"<?php } ?> data-toggle="<?php echo $blockName; ?>-tab<?php echo $key; ?>">
	  	<a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a>
	  </li>
	  <?php } ?>
	</ul>
	<div class="tab-content">
		<?php foreach ($items as $key => $item) { ?>
		<div class="tab-pane fade <?php if ($key == 0) { ?>active in<?php } ?>" id="<?php echo $blockName; ?>-tab<?php echo $key; ?>">
			<ul class="tl-panel-list list-unstyled">
				<?php foreach ($item['data'] as $value) { ?>
				<li><a href="<?php echo $value['link']; ?>" title="<?php echo $value['TreeData']['title']; ?>"><?php echo $value['TreeData']['title']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
	</div>
</div>
