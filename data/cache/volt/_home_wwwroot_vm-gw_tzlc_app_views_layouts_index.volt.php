
<div class="row">
    <div class="col-xs-6 col-md-4"><?php echo $this->partial('widget/slider', array('blockName' => $pageData['slider']['home']['blockName'], 'items' => $pageData['slider']['home']['items'])); ?></div>
    <div class="col-xs-6 col-md-4"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['hot']['items'])); ?></div>
	<div class="col-xs-6 col-md-4 l-h-topright"><?php echo $this->partial('widget/cidian', array('cidian' => $pageData['cidian'])); ?></div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-8 l-h-left">
		<div class="row">
			<div class="layout-title">互联网金融</div>
			<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['internet_licai']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['internet_p2p']['items'])); ?></div>
	      	</div>
	      	<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/navTab', array('blockName' => $pageData['navTab']['internet_bank_fund']['blockName'], 'items' => $pageData['navTab']['internet_bank_fund']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['internet_insurance']['items'])); ?></div>
	      	</div>
		</div>
		<div class="row">
			<div class="layout-title">财经学堂</div>
			<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/navTab', array('blockName' => $pageData['navTab']['school_stock_fund']['blockName'], 'items' => $pageData['navTab']['school_stock_fund']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/navTab', array('blockName' => $pageData['navTab']['school_forex_bank']['blockName'], 'items' => $pageData['navTab']['school_forex_bank']['items'])); ?></div>
	      	</div>
	      	<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['school_insurance']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/navTab', array('blockName' => $pageData['navTab']['school_spot_futures']['blockName'], 'items' => $pageData['navTab']['school_spot_futures']['items'])); ?></div>
	      	</div>
	      	<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['school_metal']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['school_gold']['items'])); ?></div>
	      	</div>
		</div>
		<div class="row">
			<div class="layout-title">投资操盘</div>
			<div class="row">
	        	<div class="col-md-6"><?php echo $this->partial('widget/navTab', array('blockName' => $pageData['navTab']['trade_basic_tech']['blockName'], 'items' => $pageData['navTab']['trade_basic_tech']['items'])); ?></div>
	        	<div class="col-md-6"><?php echo $this->partial('widget/panel', array('items' => $pageData['panel']['trade_master']['items'])); ?></div>
	      	</div>
		</div>
	</div>
	<div class="col-xs-6 col-md-4 l-h-right">
		<?php echo $this->partial('widget/lilv', array('lilv' => $pageData['lilv'])); ?>
		<?php echo $this->partial('widget/panel2', array('items' => $pageData['panel2']['wealth_story']['items'])); ?>
		<?php echo $this->partial('widget/panel2', array('items' => $pageData['panel2']['wealth_plan']['items'])); ?>
	</div>
</div>

