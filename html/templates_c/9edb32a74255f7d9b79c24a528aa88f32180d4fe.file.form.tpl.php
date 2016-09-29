<?php /* Smarty version Smarty-3.0.8, created on 2016-08-16 23:39:36
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/color/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:201098921157b364f0774681-99149054%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9edb32a74255f7d9b79c24a528aa88f32180d4fe' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/color/form.tpl',
      1 => 1471374536,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201098921157b364f0774681-99149054',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>
    <?php $_smarty_tpl->tpl_vars['form_action'] = new Smarty_variable("/gadmin/shop/color/?edit=".($_smarty_tpl->getVariable('group_product')->value->id), null, null);?>
    <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable("ویرایش", null, null);?>
<?php }else{ ?>
    <?php $_smarty_tpl->tpl_vars['form_action'] = new Smarty_variable("/gadmin/shop/newcolor", null, null);?>
    <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable("ایجاد", null, null);?>
<?php }?>
<div class="row">

<br>
        <form method="post" action="<?php echo $_smarty_tpl->getVariable('form_action')->value;?>
"  >
            
            <div class="col-xs-3">

                <input type="text" placeholder="نام لاتین"  name="pg_title" id="pg_title"
                       class="form-control"
                        <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        <?php }?>
                       <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>value="<?php echo $_smarty_tpl->getVariable('group_product')->value->pg_title;?>
"<?php }?>>


            </div>
            <div class="col-xs-3">

                <input type="text" placeholder="نام فارسی"  name="pg_content" id="pg_content"
                       class="form-control"
                        <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        <?php }?>
                       <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>value="<?php echo $_smarty_tpl->getVariable('group_product')->value->pg_content;?>
"<?php }?>>


            </div>
            
            
            <div class="col-xs-3 input-group ">


                <input type="text" class="form-control "
                       placeholder="ترتیب نمایش "
                       name="pg_order"
                        <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>
                            style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        <?php }?>
                        <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>value="<?php echo $_smarty_tpl->getVariable('group_product')->value->pg_order;?>
"<?php }else{ ?>value="0"<?php }?>
                        >
                <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>
                    <span class="input-group-addon btn btn-danger"
                          data-toggle="tooltip" data-placement="right" title="انصراف"
                          onclick="window.location = '/gadmin/shop/color/'"><i class="fa  fa-close " style="color: white"></i></span>
                <?php }?>
                <span class="input-group-btn " >
                        <button type="submit" class="btn btn-primary btn-flat">
                            <?php echo $_smarty_tpl->getVariable('title')->value;?>
 رنگ
                        </button>
                     </span>
            </div>

        </form>

</div>