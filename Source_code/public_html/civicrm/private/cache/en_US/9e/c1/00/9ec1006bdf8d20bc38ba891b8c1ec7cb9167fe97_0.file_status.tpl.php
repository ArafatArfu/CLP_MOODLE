<?php
/* Smarty version 5.3.1, created on 2025-08-20 03:41:18
  from 'file:CRM/common/status.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.1',
  'unifunc' => 'content_68a543de946a73_84340655',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ec1006bdf8d20bc38ba891b8c1ec7cb9167fe97' => 
    array (
      0 => 'CRM/common/status.tpl',
      1 => 1677546762,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:CRM/common/info.tpl' => 1,
  ),
))) {
function content_68a543de946a73_84340655 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/home/clpwebor/public_html/civicrm/core/templates/CRM/common';
$_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmScope')) {
throw new \Smarty\Exception('block tag \'crmScope\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
if ($_smarty_tpl->getValue('session')->getStatus(false)) {?>
  <?php $_smarty_tpl->assign('status', $_smarty_tpl->getValue('session')->getStatus(true), false, NULL);?>
  <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('status'), 'statItem', false, NULL, 'statLoop', array (
));
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('statItem')->value) {
$foreach1DoElse = false;
?>
    <?php if (!empty($_smarty_tpl->getValue('urlIsPublic'))) {?>
      <?php $_smarty_tpl->assign('infoType', "no-popup ".((string)$_smarty_tpl->getValue('statItem')['type']), false, NULL);?>
    <?php } else { ?>
      <?php $_smarty_tpl->assign('infoType', $_smarty_tpl->getValue('statItem')['type'], false, NULL);?>
    <?php }?>
    <?php $_smarty_tpl->renderSubTemplate("file:CRM/common/info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('infoTitle'=>$_smarty_tpl->getValue('statItem')['title'],'infoMessage'=>$_smarty_tpl->getSmarty()->getModifierCallback('purify')($_smarty_tpl->getSmarty()->getModifierCallback('smarty')($_smarty_tpl->getValue('statItem')['text'],'nodefaults')),'infoOptions'=>json_encode($_smarty_tpl->getSmarty()->getModifierCallback('smarty')($_smarty_tpl->getValue('statItem')['options'],'nodefaults'))), (int) 0, $_smarty_current_dir);
?>
  <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);
}
$_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
}
}
