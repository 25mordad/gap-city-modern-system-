<?php /* Smarty version Smarty-3.0.8, created on 2016-09-28 21:51:34
         compiled from "/var/www/gcms.dev/public_html/core/module/packaging/backend/tpl/packaging/index/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178930128057ec0a2e0982c8-22500074%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40c97569e2f7728a2c0339549e0bdaf8ac70b693' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/packaging/backend/tpl/packaging/index/form.tpl',
      1 => 1475086892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178930128057ec0a2e0982c8-22500074',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_GET['edit'])){?>
    <?php $_smarty_tpl->tpl_vars['form_action'] = new Smarty_variable("/gadmin/packaging/?edit=".($_smarty_tpl->getVariable('bag')->value->id), null, null);?>
    <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable("ویرایش", null, null);?>
<?php }else{ ?>
    <?php $_smarty_tpl->tpl_vars['form_action'] = new Smarty_variable("/gadmin/packaging/new", null, null);?>
    <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable("ایجاد", null, null);?>
<?php }?>
<div class="row">
<br>
        <form method="post" action="<?php echo $_smarty_tpl->getVariable('form_action')->value;?>
"  >
            
            <div class="col-xs-3">

                <select name="pg_title" class="col-md-12" id="pg_title"
                <?php if (isset($_GET['edit'])){?>
                        style= "border: 1px solid #ffa902;background: #FFFF66;font-size: 14px;"
                        <?php }?>
                >
                	<option value="0"> انتخاب نماینده فروش </option>
                	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
?>
                	<option value="<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
" <?php if ($_smarty_tpl->getVariable('bag')->value->pg_title==$_smarty_tpl->getVariable('row')->value->id){?>selected="selected" <?php }?>><?php echo $_smarty_tpl->getVariable('row')->value->params;?>
 - <?php echo $_smarty_tpl->getVariable('row')->value->username;?>
 </option>
                	<?php }} ?>
                </select>


            </div>
            <div class="col-xs-2">

                <input type="text" placeholder="تاریخ ارسال بسته " data-toggle="tooltip" data-placement="top" title="تاریخ ارسال بسته" name="date_modified" id="date_modified"
                       class="form-control"
                       style= "font-family: verdana
                        <?php if (isset($_GET['edit'])){?>
                        ;border: 1px solid #ffa902;background: #FFFF66;font-size: 14px;
                        <?php }?>
                        "
                       <?php if (isset($_GET['edit'])){?>value="<?php echo date("Y-m-d",strtotime($_smarty_tpl->getVariable('bag')->value->date_modified));?>
"
                       <?php }else{ ?>
                       value="<?php echo date("Y-m-d",strtotime("now"));?>
"
                       <?php }?>>


            </div>
            
            
            
            <div class="col-xs-3 input-group ">


                 <input type="text" placeholder=" مسوول ارسال "  title=" مسوول ارسال" data-toggle="tooltip" data-placement="top" name="pg_content" id="pg_content"
                       class="form-control"
                        <?php if (isset($_GET['edit'])){?>
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        <?php }?>
                       <?php if (isset($_GET['edit'])){?>value="<?php echo $_smarty_tpl->getVariable('bag')->value->pg_content;?>
"<?php }?>>
                
                <?php if (isset($_GET['edit'])){?>
                    <span class="input-group-addon btn btn-danger"
                          data-toggle="tooltip" data-placement="right" title="انصراف"
                          onclick="window.location = '/gadmin/packaging'"><i class="fa  fa-close " style="color: white"></i></span>
                <?php }?>
                <span class="input-group-btn " >
                        <button type="submit" class="btn btn-primary btn-flat">
                            <?php echo $_smarty_tpl->getVariable('title')->value;?>
 بسته
                        </button>
                     </span>
            </div>

        </form>

</div>