<?php
/* Smarty version 5.3.1, created on 2025-08-20 03:41:18
  from 'file:CRM/common/standalone.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.1',
  'unifunc' => 'content_68a543de8343d9_04557274',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '85388a5124639b25da9f0128427a81ccbac88077' => 
    array (
      0 => 'CRM/common/standalone.tpl',
      1 => 1754533234,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:CRM/common/debug.tpl' => 1,
    'file:CRM/common/status.tpl' => 1,
    'file:CRM/Form/".((string)$_smarty_tpl->getValue(\'formTpl\')).".tpl' => 1,
    'file:CRM/common/publicFooter.tpl' => 1,
    'file:CRM/common/footer.tpl' => 1,
  ),
))) {
function content_68a543de8343d9_04557274 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/home/clpwebor/public_html/civicrm/core/templates/CRM/common';
$_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmScope')) {
throw new \Smarty\Exception('block tag \'crmScope\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?><!DOCTYPE html >
<html lang="<?php echo substr((string) $_smarty_tpl->getValue('config')->lcMessages, (int) 0, (int) 2);?>
" class="crm-standalone <?php if (!empty($_smarty_tpl->getValue('urlIsPublic'))) {?>crm-standalone-frontend<?php }?>">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->getValue('config')->resourceBase;?>
i/logo_lg.png" >

  <?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')) {
throw new \Smarty\Exception('block tag \'crmRegion\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')->handle(array('name'=>'html-header'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>
  <?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')->handle(array('name'=>'html-header'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>

  <title><?php if ((null !== ($_smarty_tpl->getValue('docTitle') ?? null))) {
echo $_smarty_tpl->getValue('docTitle');
} else { ?>CiviCRM<?php }?></title>
</head>
<body>
  <?php if ($_smarty_tpl->getValue('config')->debug) {?>
  <?php $_smarty_tpl->renderSubTemplate("file:CRM/common/debug.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
  <?php }?>

  <div id="crm-container" class="crm-container standalone-page-padding <?php if (!empty($_smarty_tpl->getValue('urlIsPublic'))) {?>crm-public<?php }?>" lang="<?php echo substr((string) $_smarty_tpl->getValue('config')->lcMessages, (int) 0, (int) 2);?>
" xml:lang="<?php echo substr((string) $_smarty_tpl->getValue('config')->lcMessages, (int) 0, (int) 2);?>
">
    <?php if ($_smarty_tpl->getValue('breadcrumb')) {?>
      <nav aria-label="<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'htmlattribute'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Breadcrumb<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'htmlattribute'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>" class="breadcrumb"><ol>
        <li><a href="/civicrm/dashboard?reset=1" ><?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Home<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?></a></li>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('breadcrumb'), 'crumb', false, 'key');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('key')->value => $_smarty_tpl->getVariable('crumb')->value) {
$foreach0DoElse = false;
?>
          <li><a href="<?php echo $_smarty_tpl->getValue('crumb')['url'];?>
"><?php echo $_smarty_tpl->getValue('crumb')['title'];?>
</a></li>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </ol></nav>
    <?php }?>

    <?php if ($_smarty_tpl->getValue('standaloneErrors')) {?>
      <div class="standalone-errors">
        <ul><?php echo $_smarty_tpl->getValue('standaloneErrors');?>
</ul>
      </div>
    <?php }?>

    <?php if ($_smarty_tpl->getValue('pageTitle')) {?>
      <div class="crm-page-title-wrapper">
        <h1 class="crm-page-title"><?php echo $_smarty_tpl->getValue('pageTitle');?>
</h1>
      </div>
    <?php }?>

    <?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')) {
throw new \Smarty\Exception('block tag \'crmRegion\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')->handle(array('name'=>'page-header'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>
    <?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')->handle(array('name'=>'page-header'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>

    <div class="clear"></div>

    <div id="crm-main-content-wrapper">
      <?php $_smarty_tpl->renderSubTemplate("file:CRM/common/status.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
      <?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')) {
throw new \Smarty\Exception('block tag \'crmRegion\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')->handle(array('name'=>'page-body'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>
        <?php if ((null !== ($_smarty_tpl->getValue('isForm') ?? null)) && $_smarty_tpl->getValue('isForm') && (null !== ($_smarty_tpl->getValue('formTpl') ?? null))) {?>
          <?php $_smarty_tpl->renderSubTemplate("file:CRM/Form/".((string)$_smarty_tpl->getValue('formTpl')).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        <?php } else { ?>
          <?php $_smarty_tpl->renderSubTemplate($_smarty_tpl->getValue('tplFile'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        <?php }?>
      <?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')->handle(array('name'=>'page-body'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>
    </div>

    <?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')) {
throw new \Smarty\Exception('block tag \'crmRegion\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')->handle(array('name'=>'page-footer'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>
      <?php if (!empty($_smarty_tpl->getValue('urlIsPublic'))) {?>
        <?php $_smarty_tpl->renderSubTemplate("file:CRM/common/publicFooter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
      <?php } else { ?>
        <?php $_smarty_tpl->renderSubTemplate("file:CRM/common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
      <?php }?>
    <?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmRegion')->handle(array('name'=>'page-footer'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>
  </div>
</body>
</html>
<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
}
}
