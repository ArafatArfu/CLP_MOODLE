<?php
/* Smarty version 5.3.1, created on 2025-08-20 03:41:18
  from 'file:CRM/Standaloneusers/Page/Login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.1',
  'unifunc' => 'content_68a543de9603f1_06903726',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f752b37c44bb9faa1c292338b9ae323e57e741b' => 
    array (
      0 => 'CRM/Standaloneusers/Page/Login.tpl',
      1 => 1754533558,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:CRM/common/logo.tpl' => 1,
    'file:CRM/common/notifications.tpl' => 1,
  ),
))) {
function content_68a543de9603f1_06903726 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/home/clpwebor/public_html/civicrm/core/ext/standaloneusers/templates/CRM/Standaloneusers/Page';
$_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmScope')) {
throw new \Smarty\Exception('block tag \'crmScope\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
$_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmScope')) {
throw new \Smarty\Exception('block tag \'crmScope\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>"standaloneusers"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>
<div class="standalone-auth-form">
  <div class="standalone-auth-box">
    <form id=login-form>
      <?php $_smarty_tpl->renderSubTemplate('file:CRM/common/logo.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
      <div class="input-wrapper">
        <label for="usernameInput" name=username class="form-label"><?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Username<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?></label>
        <input type="text" class="form-control crm-form-text" id="usernameInput" >
      </div>
      <div class="input-wrapper">
        <label for="passwordInput" class="form-label"><?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Password<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?></label>
        <input type="password" class="form-control crm-form-text" id="passwordInput">
      </div>
      <div class="login-or-forgot">
        <a href="<?php echo $_smarty_tpl->getValue('forgottenPasswordURL');?>
"><?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Forgotten password?<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?></a>
        <button id="loginSubmit" type="submit" class="btn btn-primary crm-button"><?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Log In<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?></button>
      </div>
    </form>
  </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:CRM/common/notifications.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>


<?php echo '<script'; ?>
>
  document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('login-form'),
      username = document.getElementById('usernameInput'),
      password = document.getElementById('passwordInput');

    form.addEventListener('submit', async e => {
      e.preventDefault();

      let errorMsg = '<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>"js"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Unexpected error<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>"js"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>';
      try {
        let originalUrl = location.href;
        // Remove the current status popup messages.
        CRM.$('#crm-notification-container .ui-notify-message').remove();
        const response = await CRM.api4('User', 'login', {
          identifier: username.value,
          password: password.value,
          originalUrl
        });
        if (response.url) {
          window.location = response.url;
          return;
        }
        errorMsg = response.publicError || "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>"js"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Unexpected error<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>"js"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>";
      }
      catch (e) {
        console.error('caught', e);
      }
      CRM.alert('', errorMsg, 'error', {'expires': 10000});
    });
  });
<?php echo '</script'; ?>
>

<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>"standaloneusers"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
$_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
}
}
