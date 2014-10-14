
//分页下拉框变化
function changeIPP(){
	var itemPerPage = $('.items-per-page').val();
	addCookie('tlIPP', itemPerPage);
	location.reload();
	return false;
}
function edit_tag(id){
	var trObj = $('tr.id_'+id);
	if (id && trObj.length){
		var id = trObj.find('.id').text(),
			pinyinPrefix = trObj.find('.pinyinPrefix').text();
			name = trObj.find('.name').text(),
			desc = trObj.find('.desc').text(),
			is_cidian = trObj.find('.is_cidian').text(),
			status = trObj.find('.status').text();

		is_cidian = is_cidian=='是'?1:0;
		status = status=='是'?1:0;
		$("#tag-dialog-form").find('.id').val(id);
		$("#tag-dialog-form").find('.pinyinPrefix').val(pinyinPrefix);
		$("#tag-dialog-form").find('.name').val(name);
		$("#tag-dialog-form").find('.desc').val(desc);
		$("#tag-dialog-form").find('.is_cidian').val(is_cidian);
		$("#tag-dialog-form").find('.status').val(status);
	} else {
		$("#tag-dialog-form").find('.id').val('');
		$("#tag-dialog-form").find('.pinyinPrefix').val('');
		$("#tag-dialog-form").find('.name').val('');
		$("#tag-dialog-form").find('.desc').val('');
		$("#tag-dialog-form").find('.is_cidian').val('');
		$("#tag-dialog-form").find('.status').val('');
	}
	$("#tag-dialog-form").dialog("open");
}
function del_tag(id,elem){
	if (confirm('确认删除该标签吗？')){
		$.post( "/script/tag.php", {act:'del_tag',id:id}, function(data){
			if (data[0]){
		  		alert(data[1]);
		  		$(elem).closest('tr').remove();
	   		} else {
	   			alert(data[1]);
	   		}
	   		return false;
		},'json');
	}
}
function addCookie(name,value){
	var cookieString=name+"="+encodeURIComponent(value)+';path=/;domain=.licaimap.com';
	document.cookie=cookieString;
}
function getCookie(name){
	var strCookie=decodeURIComponent(document.cookie);
	var arrCookie=strCookie.split("; ");
	for(var i=0; i<arrCookie.length; i++){
		var arr=arrCookie[i].split("=");
		if(arr[0]==name)return arr[1];
	}
	return "";
}
function deleteCookie(name){
	var date=new Date();
	date.setTime(date.getTime()-10000);
	document.cookie=name+"=v;path=/;domain=.licaimap.com; expires="+date.toGMTString();
}

$(function() {
	$(window).scroll( function() {
		if ($(document).scrollTop()>130){
			$(".table_header").attr('style', 'top:0;position:fixed;');
		} else {
			$(".table_header").attr('style', '');
		}
	});

	if ($("#tag-dialog-form").length){
		$("#tag-dialog-form").dialog({
			autoOpen: false,
			height: 500,
			width: 550,
			modal: true,
			buttons: {
				"提交": function() {
					var id, name, desc, is_cidian, status;
					id = $('#tag-dialog-form .id').val();
					pinyinPrefix = $('#tag-dialog-form .pinyinPrefix').val();
					name = $('#tag-dialog-form .name').val();
					desc = $('#tag-dialog-form .desc').val();
					is_cidian = $('#tag-dialog-form .is_cidian').val();
					status = $('#tag-dialog-form .status').val();
					$.post( "/script/tag.php", {act:'edit_tag',id:id,pinyinPrefix:pinyinPrefix,name:name,desc:desc,is_cidian:is_cidian,status:status}, function(data){
						if (data[0]){
					  		alert(data[1]);
				   			window.location.reload();
				   		} else {
				   			alert(data[1]);
				   		}
				   		return false;
					},'json');
				},
				"取消": function() {
					$(this).dialog("close");
				}
			},
			close: function() {}
		});
	}

});

