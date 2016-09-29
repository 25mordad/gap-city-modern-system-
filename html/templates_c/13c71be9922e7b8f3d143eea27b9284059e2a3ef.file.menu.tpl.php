<?php /* Smarty version Smarty-3.0.8, created on 2016-09-22 21:55:42
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77924947757e42226e46dd2-70833544%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13c71be9922e7b8f3d143eea27b9284059e2a3ef' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/menu.tpl',
      1 => 1474568736,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77924947757e42226e46dd2-70833544',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- ################-->
 <!-- START TOP MENU -->
 <!-- ################-->
  <div class="nav-reaction">
    <div class="navbar navbar-static-top"> 
      <!-- navbar-fixed-top -->
      <div class="navbar-inner">
        <div class="container"> <a class="brand" href="/page"> 
		<img src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/images/logo.png" alt="Logo"></a>
          <div id="main-nav">
            <div class="nav-collapse collapse">
              <ul class="nav">
			  <?php  $_smarty_tpl->tpl_vars['gcms_menu'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('gcms_menus')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['gcms_menu']->key => $_smarty_tpl->tpl_vars['gcms_menu']->value){
?>
	               <?php echo smarty_function_all_menu_child(array('id'=>$_smarty_tpl->getVariable('gcms_menu')->value->id),$_smarty_tpl);?>

	               <li
	               <?php if (isset($_smarty_tpl->getVariable('menu_childs',null,true,false)->value)){?> class="dropdown" <?php }?>
	               <?php ob_start();?><?php echo $_smarty_tpl->getVariable('gcms_menu')->value->link;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->getVariable('gcms_menu')->value->id;?>
<?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo $_SERVER['REQUEST_URI'];?>
<?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo smarty_function_isactivemenu(array('menu_link'=>$_tmp1,'menu_id'=>$_tmp2,'url'=>$_tmp3),$_smarty_tpl);?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4){?> class="active" <?php }?> >
	               <a
	                       <?php if (isset($_smarty_tpl->getVariable('menu_childs',null,true,false)->value)){?>data-toggle="dropdown" class="dropdown-toggle" <?php }?>
	                       href="<?php echo $_smarty_tpl->getVariable('gcms_menu')->value->link;?>
"><?php echo $_smarty_tpl->getVariable('gcms_menu')->value->title;?>
<?php if (isset($_smarty_tpl->getVariable('menu_childs',null,true,false)->value)){?><b class="caret"></b><?php }?></a>
	               <?php if (isset($_smarty_tpl->getVariable('menu_childs',null,true,false)->value)){?>
	                   <ul class="dropdown-menu">
	                       <?php  $_smarty_tpl->tpl_vars['menu_child'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu_childs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['menu_child']->key => $_smarty_tpl->tpl_vars['menu_child']->value){
?>
	                           <li><a href="<?php echo $_smarty_tpl->getVariable('menu_child')->value->link;?>
"><?php echo $_smarty_tpl->getVariable('menu_child')->value->title;?>
</a></li>
	                       <?php }} ?>
	                   </ul>
	               <?php }?>
	               </li>
	           <?php }} ?>
                
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   <!-- ################-->
 <!-- END TOP MENU -->
 <!-- ################-->
