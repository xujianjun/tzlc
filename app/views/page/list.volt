{{ partial("widget/list_header", ['list_header':pageData['list_header']]) }}
{{ partial("widget/breadcrumb", ['breadcrumb':pageData['breadcrumb']]) }}
{{ partial("widget/list", ['title':pageData['list']['node']['title'],'items':pageData['list']['node']['items'],'pager':pageData['list']['node']['pager']]) }}