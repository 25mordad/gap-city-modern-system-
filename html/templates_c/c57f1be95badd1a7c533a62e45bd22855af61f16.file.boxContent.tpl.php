<?php /* Smarty version Smarty-3.0.8, created on 2016-08-21 23:11:36
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/boxContent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23491865957b9f5e0666b16-20706936%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c57f1be95badd1a7c533a62e45bd22855af61f16' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/boxContent.tpl',
      1 => 1471542968,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23491865957b9f5e0666b16-20706936',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
	<div class="col-md-6 " >
		<!--  box -->
		
		<div class="box box-solid box-primary">
		    <div class="box-header">
		        <h3 class="box-title">
		            عنوان و محتوای محصول فارسی
		        </h3>
		    </div>
		    <div class="box-body">
		        <p>
		            <input type="text" value="<?php echo $_smarty_tpl->getVariable('product')->value->fa_title;?>
" name="fa_title" class="form-control">
		            <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('loct')->value;?>
/js/tinymce/tinymce.min.js"></script>
		            <textarea id="GCMSeditor" name="fa_txt"   ><?php echo $_smarty_tpl->getVariable('product')->value->fa_txt;?>
</textarea>
		            <style>
		                #GCMSeditor { height: 50px;overflow: auto }
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
	</div>
	<div class="col-md-6 " >
		<!--  box -->
		
		<div class="box box-solid box-primary">
		    <div class="box-header">
		        <h3 class="box-title">
		            Title and Content in English
		        </h3>
		    </div>
		    <div class="box-body">
		        <p>
		            <input type="text" value="<?php echo $_smarty_tpl->getVariable('product')->value->en_title;?>
" name="en_title" class="form-control">
		            <textarea id="eneditor" name="en_txt"   ><?php echo $_smarty_tpl->getVariable('product')->value->en_txt;?>
</textarea>
		            <style>
		                #eneditor { height: 50px;overflow: auto }
		            </style>
		            <script type="text/javascript">
		                tinymce.init({
		                    selector: "#eneditor",
		                    language : 'en_GB',
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
		                    directionality : 'ltr'
		                });
		            </script>
		        </p>
		    </div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>

</div>
