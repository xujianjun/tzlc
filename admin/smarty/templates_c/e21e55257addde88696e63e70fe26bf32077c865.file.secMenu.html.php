<?php /* Smarty version Smarty-3.1.18, created on 2014-09-19 10:57:01
         compiled from "/home/wwwroot/vm-gw/touzilicai/admin/smarty/templates/script/secMenu.html" */ ?>
<?php /*%%SmartyHeaderCode:1673216959540c1736627e37-76122111%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e21e55257addde88696e63e70fe26bf32077c865' => 
    array (
      0 => '/home/wwwroot/vm-gw/touzilicai/admin/smarty/templates/script/secMenu.html',
      1 => 1410924423,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1673216959540c1736627e37-76122111',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_540c17366db251_78039368',
  'variables' => 
  array (
    'siteCfgs' => 0,
    'key' => 0,
    'menu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_540c17366db251_78039368')) {function content_540c17366db251_78039368($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>后台管理系统-主内容</title>
	<link href="/css/common.css" rel="stylesheet" type="text/css" />
	<link href="/css/main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/js/jquery/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/main.js"></script>
</head>

<body>
	<div class="mainDiv">
		<div class="breadCrumb">
			<input type="button" class="backBtn" value="返回" />
			<input type="button" class="forwardBtn" value="前进" />
			<input type="button" class="refreshBtn" value="刷新" />&nbsp;&nbsp;&nbsp;&nbsp;
			站点管理 -> <a href="/script/secMenu.php">二级菜单</a>
		</div>
		<div class="main main-secMenu">
			<div class="items">
				<div class="editMenu">
					名称: <input type="text" class="title" value="" />
					链接地址: <input type="text" class="link" value="" />
					排序: <input type="text" class="order" value="" />
					<input type="button" class="addMenu" value="添加" />
					<a href="javascript:window.location.reload();" class="cancel_saveMenu">取消</a>
					<input type="button" class="saveMenu" value="发布" />
				</div>
				<div class="menuList">
					<table style="width:100%;">
						<tr class="tr-top">
							<td colspan="4" align="center">二级菜单</td>
						</tr>
						<tr class="tr-top">
							<td style="width:30%;">名称</td>
							<td style="width:30%;">链接地址</td>
							<td style="width:10%;">排序</td>
							<td style="width:20%;">
								<input type="button" class="clearMenu" value="清空列表" />
							</td>
						</tr>
						<?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['siteCfgs']->value['secMenu']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['menu']->key;
?>
						<tr class="id_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
							<td style="width:30%;" class="title">
								<span class="text"><?php echo $_smarty_tpl->tpl_vars['menu']->value['title'];?>
</span>
							</td>
							<td style="width:30%;" class="link">
								<span class="text"><?php echo $_smarty_tpl->tpl_vars['menu']->value['link'];?>
</span>
							</td>
							<td style="width:10%;" class="order">
								<span class="text"><?php echo $_smarty_tpl->tpl_vars['menu']->value['order'];?>
</span>
							</td>
							<td style="width:20%;">
								<input type="button" class="edit_button" onclick="submit_button('edit_menu', this)" value="编辑" />
								<input type="button" class="del_button" onclick="submit_button('del_menu', this)" value="删除" />
								<input type="button" class="edit_menu edit_submit" onclick="submit_button('edit_menu_submit', this)" value="更新" />
								<input type="button" class="edit_menu edit_cancel" onclick="submit_button('edit_menu_cancel', this)" value="取消" />
							</td>
						</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php }} ?>
