<div class="header">
	<div class="header-top">
		<div class="logo"><a href="/"><img src="/img/logo.png" /></a></div>
		<div class="search-box">
			<script type="text/javascript">document.write(unescape('%3Cdiv id="bdcs"%3E%3C/div%3E%3Cscript charset="utf-8" src="http://rp.baidu.com/rp3w/3w.js?sid=14530302085926800120') + '&t=' + (Math.ceil(new Date()/3600000)) + unescape('"%3E%3C/script%3E'));</script>
			<!--
			<div class="col-lg-6">
			    <div class="input-group">
			      <input type="text" class="form-control" placeholder="请输入关键字" onkeypress="toSearch('header')" />
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">Go!</button>
			      </span>
			    </div>
			 </div>
			 -->
		</div>
	</div>
	<div class="clear"></div>

	<!--导航-->
	<div class="header-nav">
	<ul id="tl-nav">
		<li class="nav-item <?php if ($server['REQUEST_URI'] == '/') { ?> active<?php } ?>">
			<a href="/" class="nav-link">首页</a>
		</li>
		<?php $v18445742541iterator = $menus['mainMenu']; $v18445742541incr = 0; $v18445742541loop = new stdClass(); $v18445742541loop->length = count($v18445742541iterator); $v18445742541loop->index = 1; $v18445742541loop->index0 = 1; $v18445742541loop->revindex = $v18445742541loop->length; $v18445742541loop->revindex0 = $v18445742541loop->length - 1; ?><?php foreach ($v18445742541iterator as $menu) { ?><?php $v18445742541loop->first = ($v18445742541incr == 0); $v18445742541loop->index = $v18445742541incr + 1; $v18445742541loop->index0 = $v18445742541incr; $v18445742541loop->revindex = $v18445742541loop->length - $v18445742541incr; $v18445742541loop->revindex0 = $v18445742541loop->length - ($v18445742541incr + 1); $v18445742541loop->last = ($v18445742541incr == ($v18445742541loop->length - 1)); ?>
		<li class="nav-item <?php if ($menu['current']) { ?> active<?php } ?>">
			<a href="<?php echo $menu['link']; ?>" class="nav-link"><?php echo $menu['TreeData']['title']; ?></a>
			<div class="nav-dropdown <?php if ($v18445742541loop->index > 2) { ?> nav-dropdown-align-right<?php } ?>">
				<div class="nav-dropdown-trending">
					<ul class="trending">
						<?php foreach ($menu['recommendNodes'] as $recommendNode) { ?>
						<li><a href="<?php echo $recommendNode['link']; ?>"><?php echo $recommendNode['TreeData']['title']; ?></a></li>
						<?php } ?>
					</ul>
					<p class="nav-dropdown-entry"><a href="<?php echo $menu['link']; ?>">查看更多"<?php echo $menu['TreeData']['title']; ?>"&gt;&gt;</a></p>
				</div>
				<div class="nav-dropdown-channel">
					<ul class="channel">
						<?php foreach ($menu['children'] as $subMenu) { ?>
						<li><a href="<?php echo $subMenu['link']; ?>"><?php echo $subMenu['TreeData']['title']; ?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</li>
		<?php $v18445742541incr++; } ?>
	</ul>
	</div>
</div>