<?php
/* Smarty version 5.3.1, created on 2025-08-20 03:41:18
  from 'file:CRM/common/logo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.1',
  'unifunc' => 'content_68a543de966f61_71717316',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42e08de962e1a5f4efd6fc2f8ae2e251a47605a6' => 
    array (
      0 => 'CRM/common/logo.tpl',
      1 => 1754509238,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68a543de966f61_71717316 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/home/clpwebor/public_html/civicrm/core/templates/CRM/common';
$_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmScope')) {
throw new \Smarty\Exception('block tag \'crmScope\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?><img class="crm-logo" src="<?php echo $_smarty_tpl->getValue('config')->resourceBase;?>
i/logo.svg" alt="<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'htmlattribute'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Logo for CiviCRM, with intersecting blue and green triangles<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'htmlattribute'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>">
<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
}
}
