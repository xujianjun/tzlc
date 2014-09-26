<div class="sitemap">
	<div class="sitemap-lvl1">
		<h2><a href="/">慧学知识框架</a></h2>
		<?php foreach ($sitemap['menus']['mainMenu'] as $menu) { ?>
		<h3><a href="<?php echo $menu['link']; ?>"><?php echo $menu['TreeData']['title']; ?></a></h3>
		<div class="sitemap-lvl2">
			<?php foreach ($menu['children'] as $menu2) { ?>
				<?php if ($menu2['children']) { ?>
					<div class="sitemap-lvl3">
					<label><a href="<?php echo $menu2['link']; ?>"><?php echo $menu2['TreeData']['title']; ?></a></label>：
					<?php foreach ($menu2['children'] as $menu3) { ?>
					<a href="<?php echo $menu3['link']; ?>"><?php echo $menu3['TreeData']['title']; ?></a>
					<?php } ?>
					</div>
				<?php } else { ?>
				<a href="<?php echo $menu2['link']; ?>"><?php echo $menu2['TreeData']['title']; ?></a>
				<?php } ?>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
	<div class="sitemap-lvl1">
		<h2><a href="/tag/">慧学财经词汇</a></h2>
		<?php foreach ($sitemap['tags'] as $pinyin => $tags) { ?>
		<h3><a href="/tag/<?php echo $pinyin; ?>/"><?php echo $pinyin; ?></a></h3>
		<div class="sitemap-lvl2">
			<?php foreach ($tags as $tag) { ?>
			<a href="<?php echo $tag['link']; ?>"><?php echo $tag['name']; ?></a>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
</div>