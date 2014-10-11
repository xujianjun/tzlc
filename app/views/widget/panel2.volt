
<div class="widget widget-panel2">
	<div class="w-title">
		<div class="title fleft"><h3><b><a href="{{ items[0]['link'] }}">{{ items[0]['title'] }}</a></b></h3></div>
		<div class="seperate fleft">&nbsp;</div>
		<div class="more fright"><a href="{{ items[0]['link'] }}">更多&gt;&gt;</a></div>
	</div>
	<div class="clear"></div>
	{% for key,value in items[0]['data'] %}
	<div class="w-header">
		<a class="fleft" href="{{ value['link'] }}" title="{{ value['TreeData']['title'] }}"><img src="/img/cfsh/tzal-{{ key+1 }}.jpg" width="80" height="80" alt="{{ value['TreeData']['title'] }}" title="{{ value['TreeData']['title'] }}"></a>
		<div class="fright">
			<h3><a href="{{ value['link'] }}" title="{{ value['TreeData']['title'] }}">{{ value['TreeData']['title'] }}</a></h3>
			<div class="desc">{{ value['TreeData']['summary'] }}</div>
		</div>
	</div>
	{% endfor %}
</div>