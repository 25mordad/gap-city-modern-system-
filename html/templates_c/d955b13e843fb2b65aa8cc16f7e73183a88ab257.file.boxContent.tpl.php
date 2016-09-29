<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 01:44:31
         compiled from "/var/www/gcms.dev/public_html/core/module/gallery/backend/tpl/gallery/edit/boxContent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45665835857cde0373d3be9-75827893%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd955b13e843fb2b65aa8cc16f7e73183a88ab257' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/gallery/backend/tpl/gallery/edit/boxContent.tpl',
      1 => 1447715362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45665835857cde0373d3be9-75827893',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            عنوان و محتوای گالری عکس
        </h3>
    </div>
    <div class="box-body">
        <p>
            <input type="text" value="<?php echo $_smarty_tpl->getVariable('page')->value->pg_title;?>
" name="pg_title" class="form-control">
            <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('loct')->value;?>
/js/tinymce/tinymce.min.js"></script>
            <textarea id="GCMSeditor" name="pg_content"   ><?php echo $_smarty_tpl->getVariable('page')->value->pg_content;?>
</textarea>
            <style>
                #GCMSeditor { height: 100px;overflow: auto }
            </style>
            <script type="text/javascript">
                tinymce.init({
                    selector: "#GCMSeditor",
                    language : 'fa_IR',
                    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify" +
                            " | bullist numlist indent | responsivefilemanager | link unlink anchor | image media" +
                            " | forecolor backcolor  | print  code ",
                    image_advtab: true ,
                    plugins : 'advlist autolink link image lists ' +
                            'charmap print preview  autosave ' +
                            'code colorpicker hr paste searchreplace table' +
                            ' textcolor wordcount responsivefilemanager ',
                    external_filemanager_path:"/filemanager/",
                    filemanager_title:"مدیریت عکس" ,
                    height:450,
                    external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
                    directionality : 'rtl'
                });
            </script>
        </p>
    </div><!-- /.box-body -->
</div><!-- /.box -->