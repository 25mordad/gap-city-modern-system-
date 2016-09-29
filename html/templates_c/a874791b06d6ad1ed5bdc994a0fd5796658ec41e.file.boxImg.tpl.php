<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:58:00
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/editgroup/boxImg.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177272892157ced270f0e092-80943013%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a874791b06d6ad1ed5bdc994a0fd5796658ec41e' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/editgroup/boxImg.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177272892157ced270f0e092-80943013',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            تصویرهای شاخص گروه خبری
        </h3>
    </div>
    <div class="box-body">
        <p>


        <div id="IndexPagePic" class="dropzone">
            فایلها را از سیستم خود بکشید و اینجا رها کنید یا اینجا کلیک کنید و فایل انتخاب کنید.
        </div>
        <script type="text/javascript">
            var myDropzone = new Dropzone("div#IndexPagePic", { url:"/gadmin/news/editgroup/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
/AjaxController?controller=UplImgInx&part=newsgroup&id=<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
&type=newsgroup"})
            myDropzone.on('queuecomplete', function () {
                location.reload();
            });

        </script>
        </p>
        <p id="PicDisplay">
        <div class="clearfix" ></div>
        <?php  $_smarty_tpl->tpl_vars['pgIm'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pageImg')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pgIm']->key => $_smarty_tpl->tpl_vars['pgIm']->value){
?>
            <div class="col-md-3" >
                <a href="" data-toggle="modal" data-target="#displayPic<?php echo $_smarty_tpl->getVariable('pgIm')->value->id;?>
" >
                    <img  alt="<?php echo $_smarty_tpl->getVariable('pgIm')->value->im_name;?>
" src="<?php echo $_smarty_tpl->getVariable('pgIm')->value->im_path;?>
/thumb/<?php echo $_smarty_tpl->getVariable('pgIm')->value->im_name;?>
" class="img-thumbnail" >
                </a>
                <a href="?delImgInx=<?php echo $_smarty_tpl->getVariable('pgIm')->value->id;?>
"  >
                    <span class="badge bg-red"  >حذف</span>
                </a>
                <div class="modal fade" id="displayPic<?php echo $_smarty_tpl->getVariable('pgIm')->value->id;?>
" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="font-family: verdana">
                                    <?php echo $_smarty_tpl->getVariable('pgIm')->value->im_name;?>

                                </h4>
                            </div>
                            <div class="modal-body">
                                <a href="<?php echo $_smarty_tpl->getVariable('pgIm')->value->im_path;?>
<?php echo $_smarty_tpl->getVariable('pgIm')->value->im_name;?>
" target="_blank" class="btn  btn-block btn-sm bg-orange btn-flat " style="font-family: verdana"><?php echo $_smarty_tpl->getVariable('pgIm')->value->im_path;?>
<?php echo $_smarty_tpl->getVariable('pgIm')->value->im_name;?>
</a>
                                <div class="clearfix" ></div>
                                <img  alt="<?php echo $_smarty_tpl->getVariable('pgIm')->value->im_name;?>
" src="<?php echo $_smarty_tpl->getVariable('pgIm')->value->im_path;?>
<?php echo $_smarty_tpl->getVariable('pgIm')->value->im_name;?>
"   >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php }} ?>
        <div class="clearfix" ></div>
        </p>
    </div><!-- /.box-body -->
</div><!-- /.box -->