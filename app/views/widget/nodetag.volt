<div class="tl-nodetag">
	相关词汇：
	{% for value in nodetag %}
    <a href="/tag/{{ value['tid'] }}.html" title="{{ value['Tags']['name'] }}">{{ value['Tags']['name'] }}</a>
    {% endfor %}
</div>