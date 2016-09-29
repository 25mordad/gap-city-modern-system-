<div class="row">
	<div class="col-md-6 " >
		<!--  box -->
		
		<div class="box box-solid box-primary">
		    <div class="box-header">
		        <h3 class="box-title">
		             محتوای محصول فارسی
		        </h3>
		    </div>
		    <div class="box-body">
		        <p>
		            <script type="text/javascript" src="{$loct}/js/tinymce/tinymce.min.js"></script>
		            <textarea id="GCMSeditor" name="fa_txt"   >{$product->fa_txt}</textarea>
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
		            Content in English
		        </h3>
		    </div>
		    <div class="box-body">
		        <p>
		            <textarea id="eneditor" name="en_txt"   >{$product->en_txt}</textarea>
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
