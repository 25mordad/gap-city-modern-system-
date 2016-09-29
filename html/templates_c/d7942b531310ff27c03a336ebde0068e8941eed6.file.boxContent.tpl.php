<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 05:42:20
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/page/page_index/boxContent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:74982439157abd0f415ba92-54332170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd7942b531310ff27c03a336ebde0068e8941eed6' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/page/page_index/boxContent.tpl',
      1 => 1447715370,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '74982439157abd0f415ba92-54332170',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            عنوان و محتوای صفحه
        </h3>
    </div>
    <div class="box-body">
        <p>
            <input type="text" value="<?php echo $_smarty_tpl->getVariable('page')->value->pg_title;?>
" name="pg_title" class="form-control">
            <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('loct')->value;?>
/js/tinymce/tinymce.min.js"></script>
            <textarea id="GCMSeditor" name="pg_content"  ><?php echo $_smarty_tpl->getVariable('page')->value->pg_content;?>
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