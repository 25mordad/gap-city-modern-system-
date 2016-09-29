<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 01:44:51
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/gallery/index/txt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77517785157cde04b4d0a84-59382298%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e83cfcaa166e562d082d91a7075d29f06af33a3' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/gallery/index/txt.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77517785157cde04b4d0a84-59382298',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lists_gallery')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
?>
    <div class="col-md-3">
            <div class="thumbnail">
                <a href="/gallery/show/<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->pg_title),$_smarty_tpl);?>
"  ><img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('row')->value->id,'type'=>"gallery",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('row')->value->pg_title;?>
" class="img-rounded"></a>
                <div class="caption">
                    <h3><?php echo $_smarty_tpl->getVariable('row')->value->pg_title;?>
</h3>
                    <p><?php echo $_smarty_tpl->getVariable('row')->value->pg_excerpt;?>
</p>
                    <p>
                        <a  href="/gallery/show/<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->pg_title),$_smarty_tpl);?>
" class="btn btn-primary col-md-12" role="button">نمایش گالری</a>
                        <div class="clearfix" ></div>
                    </p>
                </div>
            </div>
    </div>
    <?php }} ?>
</div>
