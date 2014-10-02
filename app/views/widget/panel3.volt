
<div class="widget widget-panel2">
	<div class="w-title">
		<div class="title fleft"><h3><b><a href="{{ items[0]['link'] }}">{{ items[0]['title'] }}</a></b></h3></div>
		<div class="seperate fleft">&nbsp;</div>
		<div class="more fright"><a href="{{ items[0]['link'] }}">更多&gt;&gt;</a></div>
	</div>
	<div class="clear"></div>
	<div class="w-header">
		<a class="fleft" href="{{ siteConfig['cfshHeadNode']['lcgs']['link'] }}"><img src="{{ siteConfig['cfshHeadNode']['lcgs']['img_path'] }}" width="80" height="80" alt="{{ siteConfig['cfshHeadNode']['lcgs']['alt'] }}"></a>
		<div class="fright">
			<h3><a href="{{ siteConfig['cfshHeadNode']['lcgs']['link'] }}">{{ siteConfig['cfshHeadNode']['lcgs']['title'] }}</a></h3>
			<p>{{ siteConfig['cfshHeadNode']['lcgs']['desc'] }}</p>
		</div>
	</div>
	<div class="clear"></div>
	<ul class="w-list">
		{% for value in items[0]['data'] %}
        <li><a href="{{ value['link'] }}">{{ value['TreeData']['title'] }}</a></li>
        {% endfor %}
	</ul>
</div>