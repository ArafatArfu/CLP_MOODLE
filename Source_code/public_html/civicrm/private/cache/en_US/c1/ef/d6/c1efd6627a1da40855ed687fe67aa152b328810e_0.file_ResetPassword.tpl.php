<?php
/* Smarty version 5.3.1, created on 2025-08-20 03:42:05
  from 'file:CRM/Standaloneusers/Page/ResetPassword.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.1',
  'unifunc' => 'content_68a5440d44aaf0_51229327',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1efd6627a1da40855ed687fe67aa152b328810e' => 
    array (
      0 => 'CRM/Standaloneusers/Page/ResetPassword.tpl',
      1 => 1754509238,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:CRM/common/logo.tpl' => 1,
  ),
))) {
function content_68a5440d44aaf0_51229327 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/home/clpwebor/public_html/civicrm/core/ext/standaloneusers/templates/CRM/Standaloneusers/Page';
$_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmScope')) {
throw new \Smarty\Exception('block tag \'crmScope\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?><div class="standalone-auth-form">
  <div class="standalone-auth-box">
    <?php $_smarty_tpl->renderSubTemplate('file:CRM/common/logo.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    <crm-angular-js modules="crmResetPassword">
    <crm-reset-password
        hibp="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('hibp'), ENT_QUOTES, 'UTF-8', true);?>
"
        token="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('token'), ENT_QUOTES, 'UTF-8', true);?>
" ></crm-reset-password>
    </crm-angular-js>
  </div>
</div>
<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
}
}
