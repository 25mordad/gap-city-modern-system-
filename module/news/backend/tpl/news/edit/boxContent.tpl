<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            عنوان و محتوای خبر
        </h3>
    </div>
    <div class="box-body">
        <p>
            <input type="text" value="{$page->pg_title}" name="pg_title" class="form-control">
            <script type="text/javascript" src="{$loct}/js/tinymce/tinymce.min.js"></script>
            <textarea id="GCMSeditor" name="pg_content"   >{$page->pg_content}</textarea>
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