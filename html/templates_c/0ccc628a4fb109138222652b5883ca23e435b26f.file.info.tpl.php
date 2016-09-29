<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 20:07:18
         compiled from "/var/www/gcms.dev/public_html/core/module/sms/backend/tpl/sms/info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:164037036957cee2ae974e99-44039720%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ccc628a4fb109138222652b5883ca23e435b26f' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/sms/backend/tpl/sms/info.tpl',
      1 => 1447715358,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '164037036957cee2ae974e99-44039720',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box  bg-red ">
        <div class="inner">
            <h3>
                <?php echo number_format($_smarty_tpl->getVariable('GCMS_SETTING')->value['sms']['credit']);?>

                تومان
            </h3>
            <p>
                اعتبار شما
            </p>
        </div>
        <div class="icon">
            <i class="fa fa-usd"></i>
        </div>
    </div>
</div><!-- ./col -->


<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box  bg-maroon ">
        <div class="inner">
            <h3>
                <?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['sms']['number'];?>

            </h3>
            <p>
                شماره پیام کوتاه
            </p>
        </div>
        <div class="icon">
            <i class="fa fa-phone"></i>
        </div>
    </div>
</div><!-- ./col -->


<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box  bg-purple ">
        <div class="inner">
            <h3>
                <?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['sms']['plan'];?>

            </h3>
            <p>

                فارسی:
                <?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['sms']['fa_fee'];?>

                تومان، لاتین
                <?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['sms']['en_fee'];?>

                تومان
            </p>
        </div>
        <div class="icon">
            <i class="fa fa-hdd-o"></i>
        </div>

    </div>
</div><!-- ./col -->