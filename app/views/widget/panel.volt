
<div class="panel panel-primary">
    <div class="panel-heading">
      <div class="panel-title"><b><a href="{{ items[0]['link'] }}">{{ items[0]['title'] }}</a></b></div>
      <div class="more fright"><a href="{{ items[0]['link'] }}">更多&gt;&gt;</a></div>
    </div>
    <div class="panel-body">
      	<ul class="tl-panel-list list-unstyled">
      		{% for value in items[0]['data'] %}
			<li><a href="{{ value['link'] }}">{{ value['TreeData']['title'] }}</a></li>
			{% endfor %}
	  	</ul>
    </div>
  </div>