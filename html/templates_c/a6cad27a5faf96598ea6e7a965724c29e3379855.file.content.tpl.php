<?php /* Smarty version Smarty-3.0.8, created on 2016-09-04 05:58:25
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/menu/edit/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:213103060057cb78b9722210-14230550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6cad27a5faf96598ea6e7a965724c29e3379855' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/menu/edit/content.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '213103060057cb78b9722210-14230550',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    ویرایش منو <?php echo $_smarty_tpl->getVariable('menu')->value->title;?>

                </h3>
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm" href="/gadmin/menu/">
                        لیست منوها
                    </a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive padding">
                <form method="post" action="/gadmin/menu/edit/<?php echo $_smarty_tpl->getVariable('menu')->value->id;?>
" id="editMenuForm" >
                    <div class="clearfix" ></div>
                    <div class="form-group col-md-4 ">
                        <label>
                            عنوان منو
                        </label>
                        <input required type="text" name="title" id="title"  value="<?php echo $_smarty_tpl->getVariable('menu')->value->title;?>
" placeholder="عنوان منو"   class="form-control">
                    </div>
                    <div class="clearfix" ></div>
                    <div class="form-group col-md-4">
                        <label>
                            ترتیب منو
                        </label>
                        <input required type="number"  name="order" id="order"  value="<?php echo $_smarty_tpl->getVariable('menu')->value->order;?>
"  class="form-control">
                            <span class="help-block fontSize10">
                                یک عدد صحیح است که ترتیب قرار گرفتن منو در سایت را تعیین می‌کندبا ترتیب منوهای دیگر مقایسه و مکان منو در سایت مشخص می‌شود
                            </span>

                    </div>
                    <div class="clearfix" ></div>
                    <div class="form-group col-md-4">
                        <label>
                            لینک منو
                        </label>
                        <input required type="text"  name="link" id="link" value="<?php echo $_smarty_tpl->getVariable('menu')->value->link;?>
"  class="form-control">
                            <span class="help-block fontSize10">
آدرس نسبی به صفحه مورد نظر
                                <a href="<?php echo $_smarty_tpl->getVariable('menu')->value->link;?>
" target="_blank" ><i class="ace-icon fa fa-external-link-square bigger-120"></i></a>
                                <br>مثال: gallery/
                            </span>

                    </div>
                    <div class="clearfix" ></div>
                    <div class="form-group col-md-4">
                        <label>
                            انتخاب منوی مادر
                        </label>
                        <select class="form-control"  name="parent" id="parent"  >
                            <option value="0" selected="selected">بدون منوی مادر</option>
                            <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('main_menu')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->getVariable('menu')->value->parent==$_smarty_tpl->tpl_vars['key']->value){?>selected="selected"<?php }?> ><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</option>
                            <?php }} ?>
                        </select>
                    </div>
                    <div class="clearfix" ></div>
                    <div class="form-group col-md-2 col-sm-2">
                        <label>
                            &nbsp;
                        </label>
                        <button class="btn btn-success btn-block btn-flat " type="submit">
                            ثبت
                        </button>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('#newMenuForm').bootstrapValidator();
                        });
                    </script>
                </form>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>