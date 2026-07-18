<?php
/* Smarty version 5.3.1, created on 2025-08-20 03:41:18
  from 'file:CRM/common/footer.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.1',
  'unifunc' => 'content_68a543de97ee44_59172403',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '561f3785258e6aa5f476c90be6b3a7ecf3535223' => 
    array (
      0 => 'CRM/common/footer.tpl',
      1 => 1723084589,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:CRM/common/accesskeys.tpl' => 1,
    'file:CRM/common/contactFooter.tpl' => 1,
    'file:CRM/common/notifications.tpl' => 1,
  ),
))) {
function content_68a543de97ee44_59172403 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/home/clpwebor/public_html/civicrm/core/templates/CRM/common';
$_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmScope')) {
throw new \Smarty\Exception('block tag \'crmScope\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
$_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmPermission')) {
throw new \Smarty\Exception('block tag \'crmPermission\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmPermission')->handle(array('has'=>'access CiviCRM'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>
  <?php $_smarty_tpl->renderSubTemplate("file:CRM/common/accesskeys.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
  <?php if ($_smarty_tpl->getValue('contactId')) {?>
    <?php $_smarty_tpl->renderSubTemplate("file:CRM/common/contactFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
  <?php }?>

  <div class="crm-footer" id="civicrm-footer">
    <?php if ($_smarty_tpl->getValue('footer_status_severity')) {?>
    <span class="status<?php if ($_smarty_tpl->getValue('footer_status_severity') > 3) {?> crm-error<?php } elseif ($_smarty_tpl->getValue('footer_status_severity') > 2) {?> crm-warning<?php } else { ?> crm-ok<?php }?>">
      <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('crmURL')->handle(array('p'=>'civicrm/a/#/status'), $_smarty_tpl);?>
"><?php echo $_smarty_tpl->getValue('footer_status_message');?>
</a>
    </span>&nbsp;
    <?php } else { ?>
      <?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmPermission')) {
throw new \Smarty\Exception('block tag \'crmPermission\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmPermission')->handle(array('has'=>'administer CiviCRM'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>
    <span class="status crm-status-none">
      <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('crmURL')->handle(array('p'=>'civicrm/a/#/status'), $_smarty_tpl);?>
"><?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>System Status<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?></a>
    </span>&nbsp;
      <?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmPermission')->handle(array('has'=>'administer CiviCRM'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>
    <?php }?>
    <?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('crmVersion')->handle(array('assign'=>'version'), $_smarty_tpl);?>

    <?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(1=>'href="http://www.gnu.org/licenses/agpl-3.0.html" rel="external" target="_blank"',2=>'href="https://civicrm.org/" rel="external" target="_blank"',3=>$_smarty_tpl->getValue('version')), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Powered by <a %2>CiviCRM</a> %3, free and open source <a %1>AGPLv3</a> software.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(1=>'href="http://www.gnu.org/licenses/agpl-3.0.html" rel="external" target="_blank"',2=>'href="https://civicrm.org/" rel="external" target="_blank"',3=>$_smarty_tpl->getValue('version')), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?><br/>
  </div>
  <?php $_smarty_tpl->renderSubTemplate("file:CRM/common/notifications.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
$_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmPermission')->handle(array('has'=>'access CiviCRM'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
$_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
}
}
