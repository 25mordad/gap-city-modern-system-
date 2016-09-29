<?php /* Smarty version Smarty-3.0.8, created on 2016-08-15 20:21:37
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/edit/boxParamslist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131561759457b1e509c8c9e9-25058332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfebe4695c393d47a318c47a36e929ebbcb11d51' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/edit/boxParamslist.tpl',
      1 => 1447715354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131561759457b1e509c8c9e9-25058332',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="modal fade" id="paramsList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    لیست پارامترهای محصول
                </h4>
            </div>
            <div class="modal-body">

                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('params')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
?>
                        <label class="col-md-4">
                            <?php echo $_smarty_tpl->getVariable('row')->value->param_name;?>
 (<?php echo $_smarty_tpl->getVariable('row')->value->param_tag;?>
)
                            <input type="text"  value="<?php echo $_smarty_tpl->getVariable('param_vals')->value[$_smarty_tpl->getVariable('row')->value->id]["value"];?>
" name="value_<?php echo $_smarty_tpl->getVariable('param_vals')->value[$_smarty_tpl->getVariable('row')->value->id]["rel_id"];?>
"  class="form-control">
                        </label>
                    <?php }} ?>
                    <div class="clearfix" ></div>
                    <button class="btn btn-success " name="update_params">
به روز رسانی پارامترها
                    </button>
                    <div class="clearfix" ></div>

            </div>
        </div>
    </div>
</div>