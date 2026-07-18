<?php
/* Smarty version 5.3.1, created on 2025-08-20 03:41:18
  from 'file:CRM/common/info.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.1',
  'unifunc' => 'content_68a543de954b04_97924717',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ccaedbc3a2ae8b6834ffa6842eb3737a4b585e25' => 
    array (
      0 => 'CRM/common/info.tpl',
      1 => 1677546762,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68a543de954b04_97924717 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/home/clpwebor/public_html/civicrm/core/templates/CRM/common';
$_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmScope')) {
throw new \Smarty\Exception('block tag \'crmScope\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
if ($_smarty_tpl->getSmarty()->getModifierCallback('smarty')($_smarty_tpl->getValue('infoMessage'),'nodefaults') || $_smarty_tpl->getSmarty()->getModifierCallback('smarty')($_smarty_tpl->getValue('infoTitle'),'nodefaults')) {?>
  <div class="messages status <?php echo $_smarty_tpl->getValue('infoType');?>
"<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('smarty')($_smarty_tpl->getValue('infoOptions'),'nodefaults')) {?> data-options='<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('smarty')($_smarty_tpl->getValue('infoOptions'),'nodefaults');?>
'<?php }?>>
    <?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('icon')) {
throw new \Smarty\Exception('block tag \'icon\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('icon')->handle(array('icon'=>"fa-info-circle"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
$_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('icon')->handle(array('icon'=>"fa-info-circle"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>
    <span class="msg-title"><?php echo $_smarty_tpl->getValue('infoTitle');?>
</span>
    <span class="msg-text"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('purify')($_smarty_tpl->getSmarty()->getModifierCallback('smarty')($_smarty_tpl->getValue('infoMessage'),'nodefaults'));?>
</span>
  </div>
<?php }
$_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
}
}
