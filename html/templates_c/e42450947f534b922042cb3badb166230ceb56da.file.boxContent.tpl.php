<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 06:06:59
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/comment/edit/boxContent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:115599132457d2123baafb88-62787373%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e42450947f534b922042cb3badb166230ceb56da' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/comment/edit/boxContent.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '115599132457d2123baafb88-62787373',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
دیدگاه
        </h3>
    </div>
    <div class="box-body">
        <p>
            <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('loct')->value;?>
/js/tinymce/tinymce.min.js"></script>
            <textarea id="GCMSeditor" name="cm_content"  ><?php echo $_smarty_tpl->getVariable('comment')->value->cm_content;?>
</textarea>
            <script type="text/javascript">
                tinymce.init({
                    selector: "#GCMSeditor",
                    language : 'fa_IR',
                    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify" +
                            " | bullist numlist indent | responsivefilemanager | link unlink anchor | image media" +
                            " | forecolor backcolor  | print  code ",
                    image_advtab: true ,
                    plugins : 'advlist autolink link image lists ' +
                            'charmap print preview autoresize autosave ' +
                            'code colorpicker hr paste searchreplace table' +
                            ' textcolor wordcount responsivefilemanager',
                    external_filemanager_path:"/filemanager/",
                    filemanager_title:"مدیریت عکس" ,
                    external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
                    directionality : 'rtl'
                });
            </script>
        </p>
    </div><!-- /.box-body -->
</div><!-- /.box -->