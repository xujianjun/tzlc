
<div class="row">
    <div class="col-xs-6 col-md-4">{{ partial("widget/slider", ['blockName':pageData['slider']['home']['blockName'], 'items':pageData['slider']['home']['items']]) }}</div>
    <div class="col-xs-6 col-md-4">{{ partial("widget/panel", ['items':pageData['panel']['hot']['items']]) }}</div>
	<div class="col-xs-6 col-md-4 l-h-topright">{{ partial("widget/cidian", ['cidian':pageData['cidian']]) }}</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-8 l-h-left">
		<div class="row">
			<div class="layout-title glyph"><a href="/internet/">互联网金融</a></div>
			<div class="row">
	        	<div class="col-md-6">{{ partial("widget/panel", ['items':pageData['panel']['internet_licai']['items']]) }}</div>
	        	<div class="col-md-6">{{ partial("widget/panel", ['items':pageData['panel']['internet_p2p']['items']]) }}</div>
	      	</div>
	      	<div class="row">
	        	<div class="col-md-6">{{ partial("widget/navTab", ['blockName':pageData['navTab']['internet_bank_fund']['blockName'], 'items':pageData['navTab']['internet_bank_fund']['items']]) }}</div>
	        	<div class="col-md-6">{{ partial("widget/panel", ['items':pageData['panel']['internet_insurance']['items']]) }}</div>
	      	</div>
		</div>
		<div class="row">
			<div class="layout-title glyph"><a href="/school/">财经学堂</a></div>
			<div class="row">
	        	<div class="col-md-6">{{ partial("widget/navTab", ['blockName':pageData['navTab']['school_stock_fund']['blockName'], 'items':pageData['navTab']['school_stock_fund']['items']]) }}</div>
	        	<div class="col-md-6">{{ partial("widget/navTab", ['blockName':pageData['navTab']['school_forex_bank']['blockName'], 'items':pageData['navTab']['school_forex_bank']['items']]) }}</div>
	      	</div>
	      	<div class="row">
	        	<div class="col-md-6">{{ partial("widget/panel", ['items':pageData['panel']['school_insurance']['items']]) }}</div>
	        	<div class="col-md-6">{{ partial("widget/navTab", ['blockName':pageData['navTab']['school_spot_futures']['blockName'], 'items':pageData['navTab']['school_spot_futures']['items']]) }}</div>
	      	</div>
	      	<div class="row">
	        	<div class="col-md-6">{{ partial("widget/panel", ['items':pageData['panel']['school_metal']['items']]) }}</div>
	        	<div class="col-md-6">{{ partial("widget/panel", ['items':pageData['panel']['school_gold']['items']]) }}</div>
	      	</div>
		</div>
		<div class="row">
			<div class="layout-title glyph"><a href="/trade/">投资操盘</a></div>
			<div class="row">
	        	<div class="col-md-6">{{ partial("widget/navTab", ['blockName':pageData['navTab']['trade_basic_tech']['blockName'], 'items':pageData['navTab']['trade_basic_tech']['items']]) }}</div>
	        	<div class="col-md-6">{{ partial("widget/panel", ['items':pageData['panel']['trade_master']['items']]) }}</div>
	      	</div>
		</div>
	</div>
	<div class="col-xs-6 col-md-4 l-h-right">
		{{ partial("widget/lilv", ['lilv':pageData['lilv']]) }}
		{{ partial("widget/hangqing", ['hangqing':pageData['hangqing']]) }}
		{{ partial("widget/panel2", ['items':pageData['panel2']['wealth_story']['items']]) }}
		{{ partial("widget/panel3", ['items':pageData['panel3']['wealth_plan']['items']]) }}
	</div>
</div>

