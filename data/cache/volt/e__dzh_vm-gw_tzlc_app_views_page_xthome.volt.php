
<div class="row">
	<div class="col-xs-12 col-md-8"><?php echo $this->partial('widget/slider', array('blockName' => $pageData['slider']['school']['blockName'], 'items' => $pageData['slider']['school']['items'])); ?></div>
    <div class="col-xs-6 col-md-4 l-xth-topright"><?php echo $this->partial('widget/dailyword', array('dailyword' => $pageData['dailyword'])); ?></div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-8 l-xth-left">
		<div class="row">
			<div class="layout-title glyph"><a href="/school/stock/">股票学堂</a></div>
			<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/navTab', array('blockName' => $pageData['navTab']['stockSchool_basic_method']['blockName'], 'items' => $pageData['navTab']['stockSchool_basic_method']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['stockSchool_trade']['items'])); ?></div>
	      	</div>
		</div>
		<div class="row">
			<div class="layout-title glyph"><a href="/school/fund/">基金学堂</a></div>
			<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['fundSchool_basic']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/navTab', array('blockName' => $pageData['navTab']['fundSchool_open_close']['blockName'], 'items' => $pageData['navTab']['fundSchool_open_close']['items'])); ?></div>
	      	</div>
	      	<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['fundSchool_money']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['fundSchool_trade']['items'])); ?></div>
	      	</div>
		</div>
		<div class="row">
			<div class="layout-title glyph"><a href="/school/forex/">外汇学堂</a></div>
			<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['forexSchool_basic']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['forexSchool_trade']['items'])); ?></div>
	      	</div>
		</div>
		<div class="row">
			<div class="layout-title glyph"><a href="/school/metal/">贵金属学堂</a></div>
			<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['metalSchool_basic']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['metalSchool_trade']['items'])); ?></div>
	      	</div>
		</div>
		<div class="row">
			<div class="layout-title glyph"><a href="/school/bank/">其他学堂</a></div>
			<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['otherSchool_bank']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['otherSchool_insurance']['items'])); ?></div>
	      	</div>
	      	<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/navTab', array('blockName' => $pageData['navTab']['otherSchool_spot_futures']['blockName'], 'items' => $pageData['navTab']['otherSchool_spot_futures']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['otherSchool_gold']['items'])); ?></div>
	      	</div>
			</div>
	</div>
	<div class="col-xs-6 col-md-4 l-xth-right">
		<?php echo $this->partial('widget/lilv', array('lilv' => $pageData['lilv'])); ?>
		<?php echo $this->partial('widget/hangqing', array('hangqing' => $pageData['hangqing'])); ?>
		<?php echo $this->partial('widget/panel2', array('items' => $pageData['panel2']['wealth_story']['items'])); ?>
		<?php echo $this->partial('widget/panel3', array('items' => $pageData['panel3']['wealth_plan']['items'])); ?>
	</div>
</div>

