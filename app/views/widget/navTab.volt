
<div class="tl-nav-tab">
	<ul class="nav nav-tabs nav-justified">
	  {% for key,item in items %}
	  <li {% if key==0 %}class="active"{% endif %} data-toggle="{{ blockName }}-tab{{ key }}">
	  	<a href="{{ item['link'] }}">{{ item['title'] }}</a>
	  </li>
	  {% endfor %}
	</ul>
	<div class="tab-content">
		{% for key,item in items %}
		<div class="tab-pane fade {% if key==0 %}active in{% endif %}" id="{{ blockName }}-tab{{ key }}">
			<ul class="tl-panel-list list-unstyled">
				{% for value in item['data'] %}
				<li><a href="{{ value['link'] }}" title="{{ value['TreeData']['title'] }}">{{ value['TreeData']['title'] }}</a></li>
				{% endfor %}
			</ul>
		</div>
		{% endfor %}
	</div>
</div>
