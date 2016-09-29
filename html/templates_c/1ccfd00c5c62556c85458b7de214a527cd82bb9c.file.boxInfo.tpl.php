<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:58:00
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/editgroup/boxInfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:60912913757ced270eaf334-65915510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1ccfd00c5c62556c85458b7de214a527cd82bb9c' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/editgroup/boxInfo.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60912913757ced270eaf334-65915510',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            اطلاعات گروه خبری
        </h3>
    </div>
    <div class="box-body">
        <p>

            <span data-toggle="tooltip" data-placement="left" title=" نویسنده "><i class="fa fa-pencil" ></i> <?php echo $_smarty_tpl->getVariable('operator')->value->name;?>
</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" تاریخ ایجاد صفحه "><i class="fa fa-clock-o" ></i> <?php echo jdate(" l j F Y",strtotime($_smarty_tpl->getVariable('page')->value->date_created));?>
</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" تاریخ آخرین تغییر "><i class="fa fa-clock-o" ></i> <?php echo jdate(" l j F Y",strtotime($_smarty_tpl->getVariable('page')->value->date_modified));?>
</span>


        </p>
    </div>
</div>
<!--  ******  -->
