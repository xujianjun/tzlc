
<div class="header">
	<div class="header-top">
		<div class="logo"><a href="#"><img src="/img/logo.jpg" /></a></div>
		<div class="search-box">
			<div class="col-lg-6">
			    <div class="input-group">
			      <input type="text" class="form-control" placeholder="请输入关键字" />
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">Go!</button>
			      </span>
			    </div>
			  </div>
		</div>
	</div>
	<div class="clear"></div>

	<!--导航-->
	<div class="header-nav">
	<ul id="tl-nav">
		<li class="nav-item <?php if ($server['REQUEST_URI'] == '/') { ?> active<?php } ?>">
			<a href="/" class="nav-link">首页</a>
		</li>
		<?php $v30926324561iterator = $menus['mainMenu']; $v30926324561incr = 0; $v30926324561loop = new stdClass(); $v30926324561loop->length = count($v30926324561iterator); $v30926324561loop->index = 1; $v30926324561loop->index0 = 1; $v30926324561loop->revindex = $v30926324561loop->length; $v30926324561loop->revindex0 = $v30926324561loop->length - 1; ?><?php foreach ($v30926324561iterator as $menu) { ?><?php $v30926324561loop->first = ($v30926324561incr == 0); $v30926324561loop->index = $v30926324561incr + 1; $v30926324561loop->index0 = $v30926324561incr; $v30926324561loop->revindex = $v30926324561loop->length - $v30926324561incr; $v30926324561loop->revindex0 = $v30926324561loop->length - ($v30926324561incr + 1); $v30926324561loop->last = ($v30926324561incr == ($v30926324561loop->length - 1)); ?>
		<li class="nav-item <?php if ($menu['current']) { ?> active<?php } ?>">
			<a href="<?php echo $menu['link']; ?>" class="nav-link"><?php echo $menu['TreeData']['title']; ?></a>
			<div class="nav-dropdown <?php if ($v30926324561loop->index > 2) { ?> nav-dropdown-align-right<?php } ?>">
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
		<?php $v30926324561incr++; } ?>
	</ul>
	</div>
</div>