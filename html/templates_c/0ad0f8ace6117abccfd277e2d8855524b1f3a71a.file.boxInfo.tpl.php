<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 05:42:20
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/page/page_index/boxInfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24270891857abd0f4157832-81303588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ad0f8ace6117abccfd277e2d8855524b1f3a71a' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/page/page_index/boxInfo.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24270891857abd0f4157832-81303588',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            اطلاعات صفحه
        </h3>
    </div>
    <div class="box-body">
        <p>
                <span data-toggle="tooltip" data-placement="left" title=" تاریخ آخرین تغییر "><i class="fa fa-clock-o" ></i> <?php echo jdate(" l j F Y",strtotime($_smarty_tpl->getVariable('page')->value->date_modified));?>
</span>

        </p>
    </div>
</div>
<!--  ******  -->
