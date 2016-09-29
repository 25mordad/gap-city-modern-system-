<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 05:32:58
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/operator/boxProfile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:60119598557abcec2777381-38953194%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9925b5b3762f52d7837cbe0188fd2cca44bda20d' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/operator/boxProfile.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60119598557abcec2777381-38953194',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu " >
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="glyphicon glyphicon-user"></i>
        <span><?php echo $_SESSION['username'];?>
 <i class="caret"></i></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header bg-light-blue">
            <img src="<?php echo $_smarty_tpl->getVariable('loct')->value;?>
/img/default-avatar.png" class="img-circle" alt="User Image" />
            <p>
                <?php echo $_SESSION['name'];?>

                <small><?php echo $_SESSION['email'];?>
</small>
            </p>
        </li>

        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="/logout" class="btn btn-danger  btn-flat btn-sm">
                    خروج
                </a>
            </div>
            <div class="pull-right">
                <a href="/gadmin/operator/edit/<?php echo $_SESSION['userid'];?>
" class="btn btn-default btn-flat btn-sm">
                    پروفایل کاربری
                </a>
                <a href="/gadmin/operator/pass/<?php echo $_SESSION['userid'];?>
" class="btn btn-default btn-flat btn-sm">
تغییر کلمه عبور
                </a>
            </div>
        </li>
    </ul>
</li>
