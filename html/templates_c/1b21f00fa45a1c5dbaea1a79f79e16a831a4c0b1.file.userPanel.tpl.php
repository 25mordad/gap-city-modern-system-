<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 05:32:58
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/operator/userPanel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:33290599457abcec277f8a4-58355843%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b21f00fa45a1c5dbaea1a79f79e16a831a4c0b1' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/operator/userPanel.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33290599457abcec277f8a4-58355843',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Sidebar user panel -->
<div class="user-panel">
    <div class="pull-left image">
        <img src="<?php echo $_smarty_tpl->getVariable('loct')->value;?>
/img/default-avatar.png" class="img-circle" alt="User Image" />
    </div>
    <div class="pull-left info">
        <p>
            سلام، <?php echo $_SESSION['name'];?>
 عزیز
        </p>

        <a href="/gadmin/operator/edit/<?php echo $_SESSION['userid'];?>
"><i class="fa fa-circle text-success"></i>
        پروفایل کاربری
        </a>
    </div>
</div>