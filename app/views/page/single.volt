{{ partial("widget/breadcrumb", ['breadcrumb':pageData['breadcrumb']]) }}
{{ partial("widget/bdshare", ['bdshare':pageData['bdshare']]) }}
{{ partial("widget/nodetag", ['nodetag':pageData['nodetag']]) }}
{{ partial("widget/content", ['content':pageData['content']['node']['content']]) }}
{{ partial("widget/bdshare", ['bdshare':pageData['bdshare']]) }}
{{ partial("widget/siblings", ['items':pageData['siblings']['node']['items']]) }}
{{ partial("widget/panel", ['items':pageData['panel']['relation']['items']]) }}