<?php
/* Smarty version 5.3.1, created on 2025-08-20 03:41:18
  from 'file:CRM/common/notifications.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.1',
  'unifunc' => 'content_68a543de96ded4_81613031',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '88385b58edff146b034951c933ac8ea790173a52' => 
    array (
      0 => 'CRM/common/notifications.tpl',
      1 => 1754509238,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68a543de96ded4_81613031 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/home/clpwebor/public_html/civicrm/core/templates/CRM/common';
$_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmScope')) {
throw new \Smarty\Exception('block tag \'crmScope\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?><div id="crm-notification-container" role="alert" aria-live="assertive" aria-atomic="true" style="display:none">
  <div id="crm-notification-alert" class="#{type}">
    <div class="icon ui-notify-close" title="<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'htmlattribute'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>close<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'htmlattribute'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>"> </div>
    <a class="ui-notify-cross ui-notify-close" href="#" title="<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'htmlattribute'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>close<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'htmlattribute'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>">x</a>
    <h1>#{title}</h1>
    <div class="notify-content">#{text}</div>
  </div>
</div>
<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
}
}
