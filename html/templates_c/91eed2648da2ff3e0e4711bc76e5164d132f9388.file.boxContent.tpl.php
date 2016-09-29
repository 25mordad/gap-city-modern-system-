<?php /* Smarty version Smarty-3.0.8, created on 2016-08-25 04:35:47
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/box/edit/boxContent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:134361208357be365b34d668-78676794%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '91eed2648da2ff3e0e4711bc76e5164d132f9388' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/box/edit/boxContent.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '134361208357be365b34d668-78676794',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            عنوان و محتوای بلوک
        </h3>
    </div>
    <div class="box-body">
        <p>
            <input type="text" value="<?php echo $_smarty_tpl->getVariable('box')->value->box_title;?>
" name="box_title" class="form-control">
            <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('loct')->value;?>
/js/tinymce/tinymce.min.js"></script>
            <textarea id="GCMSeditor" name="box_content"  ><?php echo $_smarty_tpl->getVariable('box')->value->box_content;?>
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