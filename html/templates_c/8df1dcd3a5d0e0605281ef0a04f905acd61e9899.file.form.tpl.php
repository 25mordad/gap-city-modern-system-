<?php /* Smarty version Smarty-3.0.8, created on 2016-08-17 01:27:35
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/size/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131241379157b37e3f4fbc16-73534972%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8df1dcd3a5d0e0605281ef0a04f905acd61e9899' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/size/form.tpl',
      1 => 1471381053,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131241379157b37e3f4fbc16-73534972',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>
    <?php $_smarty_tpl->tpl_vars['form_action'] = new Smarty_variable("/gadmin/shop/size/?edit=".($_smarty_tpl->getVariable('group_product')->value->id), null, null);?>
    <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable("ویرایش", null, null);?>
<?php }else{ ?>
    <?php $_smarty_tpl->tpl_vars['form_action'] = new Smarty_variable("/gadmin/shop/newsize", null, null);?>
    <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable("ایجاد", null, null);?>
<?php }?>
<div class="row">

<br>
        <form method="post" action="<?php echo $_smarty_tpl->getVariable('form_action')->value;?>
"  >
            
            <div class="col-xs-2">

                <input type="text" placeholder="نام لاتین"  name="pg_title" id="pg_title"
                       class="form-control"
                        <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        <?php }?>
                       <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>value="<?php echo $_smarty_tpl->getVariable('group_product')->value->pg_title;?>
"<?php }?>>


            </div>
            <div class="col-xs-2">

                <input type="text" placeholder="نام فارسی"  name="pg_content" id="pg_content"
                       class="form-control"
                        <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        <?php }?>
                       <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>value="<?php echo $_smarty_tpl->getVariable('group_product')->value->pg_content;?>
"<?php }?>>


            </div>
            <div class="col-xs-2">

                <input type="text" placeholder=" کد گروه "  name="pg_excerpt" id="pg_excerpt"
                       class="form-control"
                        <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>
                        style="border: 1px solid #ffa902;background: #FFFF66;font-size: 14px"
                        <?php }?>
                       <?php if (isset($_smarty_tpl->getVariable('group_product',null,true,false)->value)){?>value="<?php echo $_smarty_tpl->getVariable('group_product')->value->pg_excerpt;?>
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
                          onclick="window.location = '/gadmin/shop/size/'"><i class="fa  fa-close " style="color: white"></i></span>
                <?php }?>
                <span class="input-group-btn " >
                        <button type="submit" class="btn btn-primary btn-flat">
                            <?php echo $_smarty_tpl->getVariable('title')->value;?>
 سایز	
                        </button>
                     </span>
            </div>

        </form>

</div>