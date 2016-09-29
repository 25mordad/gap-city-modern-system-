<?php /* Smarty version Smarty-3.0.8, created on 2016-08-28 06:42:56
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/category/filter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:73500369057c248a8eb56c7-17275392%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e15524dc62c34d1b114847ad87a70e23b1668678' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/category/filter.tpl',
      1 => 1472350375,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '73500369057c248a8eb56c7-17275392',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="panel-group" id="accordionNo">
                <!--Category-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a data-toggle="collapse" href="#collapseCategory"
                                                   class="collapseWill active ">
                            <span class="pull-left"> <i class="fa fa-caret-right"></i></span> گروه‌های محصولات </a></h4>
                    </div>
                    <div id="collapseCategory" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked tree">
                                <li class="active dropdown-tree open-tree"><a class="dropdown-tree-a"> 
                                 <?php echo $_smarty_tpl->getVariable('group')->value->pg_content;?>
 </a>
                                    <ul class="category-level-2 dropdown-menu-tree">
                                        <?php  $_smarty_tpl->tpl_vars['sc'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('SubCat')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sc']->key => $_smarty_tpl->tpl_vars['sc']->value){
?>
		                                <li><a href="/shop/category/<?php echo $_smarty_tpl->getVariable('sc')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('sc')->value->pg_content),$_smarty_tpl);?>
+<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('sc')->value->pg_title),$_smarty_tpl);?>
">  <?php echo $_smarty_tpl->getVariable('sc')->value->pg_content;?>
 </a></li>
		                                <?php }} ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/Category menu end-->

            
            </div>
        </div>
