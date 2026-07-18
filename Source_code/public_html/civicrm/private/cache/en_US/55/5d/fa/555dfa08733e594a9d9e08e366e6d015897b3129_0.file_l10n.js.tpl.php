<?php
/* Smarty version 5.3.1, created on 2025-08-20 03:41:18
  from 'file:CRM/common/l10n.js.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.1',
  'unifunc' => 'content_68a543de677490_55546156',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '555dfa08733e594a9d9e08e366e6d015897b3129' => 
    array (
      0 => 'CRM/common/l10n.js.tpl',
      1 => 1738895830,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68a543de677490_55546156 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/home/clpwebor/public_html/civicrm/core/templates/CRM/common';
$_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('crmScope')) {
throw new \Smarty\Exception('block tag \'crmScope\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>// http://civicrm.org/licensing
// <?php echo '<script'; ?>
> Generated <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('crmDate')(time(),'%d %b %Y %H:%M:%S');?>

(function($) {
  // Config settings
  CRM.config.userFramework = <?php echo json_encode($_smarty_tpl->getValue('config')->userFramework);?>
;
    CRM.config.resourceBase = <?php echo json_encode($_smarty_tpl->getValue('config')->userFrameworkResourceURL);?>
;
    CRM.config.packagesBase = <?php $_smarty_tpl->getSmarty()->getRuntime('Capture')->open($_smarty_tpl, 'default', 'packagesBase', null);
echo $_smarty_tpl->getSmarty()->getFunctionHandler('crmResURL')->handle(array('expr'=>'[civicrm.packages]/'), $_smarty_tpl);
$_smarty_tpl->getSmarty()->getRuntime('Capture')->close($_smarty_tpl);
echo json_encode($_smarty_tpl->getValue('packagesBase'));?>
;
  CRM.config.lcMessages = <?php echo json_encode($_smarty_tpl->getValue('lcMessages'));?>
;
  CRM.config.locale = <?php echo json_encode($_smarty_tpl->getValue('locale'));?>
;
  CRM.config.cid = <?php echo json_encode($_smarty_tpl->getValue('cid'));?>
;
  $.datepicker._defaults.dateFormat = CRM.config.dateInputFormat = <?php echo json_encode($_smarty_tpl->getValue('dateInputFormat'));?>
;
  CRM.config.timeIs24Hr = <?php if ($_smarty_tpl->getValue('timeInputFormat') == 2) {?>true<?php } else { ?>false<?php }?>;
  CRM.config.ajaxPopupsEnabled = <?php echo json_encode($_smarty_tpl->getValue('ajaxPopupsEnabled'));?>
;
  CRM.config.allowAlertAutodismissal = <?php echo json_encode($_smarty_tpl->getValue('allowAlertAutodismissal'));?>
;
  CRM.config.resourceCacheCode = <?php echo json_encode($_smarty_tpl->getValue('resourceCacheCode'));?>
;
  CRM.config.quickAdd = <?php echo json_encode($_smarty_tpl->getValue('quickAdd'));?>
;

  // Merge entityRef settings
  CRM.config.entityRef = $.extend({}, <?php echo json_encode($_smarty_tpl->getValue('entityRef'));?>
, CRM.config.entityRef || {});

  // Initialize CRM.url and CRM.formatMoney
  CRM.url({back: '<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('crmURL')->handle(array('p'=>"civicrm/crmajax-placeholder-url-path",'q'=>"civicrm-placeholder-url-query=1",'h'=>0,'fb'=>1), $_smarty_tpl);?>
', front: '<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('crmURL')->handle(array('p'=>"civicrm/crmajax-placeholder-url-path",'q'=>"civicrm-placeholder-url-query=1",'h'=>0,'fe'=>1), $_smarty_tpl);?>
'});
  CRM.formatMoney('init', false, <?php echo json_encode($_smarty_tpl->getValue('moneyFormat'));?>
);

  // Localize select2
  $.fn.select2.defaults.formatNoMatches = "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>None found.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>";
  $.fn.select2.defaults.formatLoadMore = "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Loading...<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>";
  $.fn.select2.defaults.formatSearching = "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Searching...<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>";
  $.fn.select2.defaults.formatInputTooShort = function() {
    return ($(this).data('api-entity') === 'contact' || $(this).data('api-entity') === 'Contact') ? <?php echo $_smarty_tpl->getValue('contactSearch');?>
 : <?php echo $_smarty_tpl->getValue('otherSearch');?>
;
  };

  // Localize jQuery UI
  $.ui.dialog.prototype.options.closeText = "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Close<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>";

  // Localize jQuery DataTables
  // Note the first two defaults set here aren't localization related,
  // but need to be set globally for all DataTables.
  $.extend( $.fn.dataTable.defaults, {
    "searching": false,
    "jQueryUI": true,
    "language": {
      "emptyTable": "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>None found.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
      "info":  "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js',1=>'_START_',2=>'_END_',3=>'_TOTAL_'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Showing %1 to %2 of %3 entries<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js',1=>'_START_',2=>'_END_',3=>'_TOTAL_'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
      "infoEmpty": "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Showing 0 to 0 of 0 entries<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
      "infoFiltered": "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js',1=>'_MAX_'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>(filtered from %1 total entries)<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js',1=>'_MAX_'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
      "infoPostFix": "",
      "thousands": <?php echo json_encode($_smarty_tpl->getValue('config')->monetaryThousandSeparator);?>
,
      "lengthMenu": "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js',1=>'_MENU_'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Show %1 entries<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js',1=>'_MENU_'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
      "loadingRecords": " ",
      "processing": " ",
      "zeroRecords": "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>None found.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
      "paginate": {
        "first": "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>First<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
        "last": "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Last<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
        "next": "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Next<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
        "previous": "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Previous<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>"
      }
    }
  });

  // Localize strings for jQuery.validate
  var messages = {
    required: "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>This field is required.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
    remote: "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please fix this field.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
    email: "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter a valid email address.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
    url: "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter a valid URL.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
    date: "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter a valid date.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
    dateISO: "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter a valid date (YYYY-MM-DD).<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
    number: "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter a valid number.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
    digits: "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter only digits.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
    creditcard: "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter a valid credit card number.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
    equalTo: "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter the same value again.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
    accept: "<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter a value with a valid extension.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>",
    maxlength: $.validator.format("<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter no more than {0} characters.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>"),
    minlength: $.validator.format("<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter at least {0} characters.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>"),
    rangelength: $.validator.format("<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter a value between {0} and {1} characters long.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>"),
    range: $.validator.format("<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter a value between {0} and {1}.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>"),
    max: $.validator.format("<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter a value less than or equal to {0}.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>"),
    min: $.validator.format("<?php $_block_repeat=true;
if (!$_smarty_tpl->getSmarty()->getBlockHandler('ts')) {
throw new \Smarty\Exception('block tag \'ts\' not callable or registered');
}

echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
  ob_start();
?>Please enter a value greater than or equal to {0}.<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('ts')->handle(array('escape'=>'js'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
?>")
  };
  $.extend($.validator.messages, messages);
  

  var params = {
    errorClass: 'crm-inline-error alert-danger',
    messages: {},
    ignore: '.select2-offscreen, [readonly], :hidden:not(.crm-select2), .crm-no-validate',
    ignoreTitle: true,
    errorPlacement: function(error, element) {
      if (element.prop('type') === 'radio') {
        error.appendTo(element.parents('div.content')[0]);
      }
      else {
        error.insertAfter(element);
      }
    }
  };

  // use civicrm notifications when there are errors
  params.invalidHandler = function(form, validator) {
    // If there is no container for display then red text will still show next to the invalid fields
    // but there will be no overall message. Currently the container is only available on backoffice pages.
    if ($('#crm-notification-container').length) {
      $.each(validator.errorList, function(k, error) {
        $(error.element).parents('.crm-custom-accordion.collapsed').crmAccordionToggle();
        $(error.element).parents('.crm-custom-accordion').prop('open', true);
        $(error.element).crmError(error.message);
      });
    }
  };

  CRM.validate = {
    _defaults: params,
    params: {},
    functions: []
  };

})(jQuery);

<?php $_block_repeat=false;
echo $_smarty_tpl->getSmarty()->getBlockHandler('crmScope')->handle(array('extensionKey'=>''), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
}
}
