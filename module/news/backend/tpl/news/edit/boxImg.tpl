<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            تصویرهای شاخص خبر
        </h3>
    </div>
    <div class="box-body">
        <p>


        <div id="IndexPagePic" class="dropzone">
            فایلها را از سیستم خود بکشید و اینجا رها کنید یا اینجا کلیک کنید و فایل انتخاب کنید.
        </div>
        <script type="text/javascript">
            var myDropzone = new Dropzone("div#IndexPagePic", { url:"/gadmin/news/edit/{$page->id}/AjaxController?controller=UplImgInx&part=news&id={$page->id}&type=news"})
            myDropzone.on('queuecomplete', function () {
                location.reload();
            });

        </script>
        </p>
        <p id="PicDisplay">
        <div class="clearfix" ></div>
        {foreach $pageImg as $pgIm}
            <div class="col-md-3" >
                <a href="" data-toggle="modal" data-target="#displayPic{$pgIm->id}" >
                    <img  alt="{$pgIm->im_name}" src="{$pgIm->im_path}/thumb/{$pgIm->im_name}" class="img-thumbnail" >
                </a>
                <a href="?delImgInx={$pgIm->id}"  >
                    <span class="badge bg-red"  >حذف</span>
                </a>
                <div class="modal fade" id="displayPic{$pgIm->id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel" style="font-family: verdana">
                                    {$pgIm->im_name}
                                </h4>
                            </div>
                            <div class="modal-body">
                                <a href="{$pgIm->im_path}{$pgIm->im_name}" target="_blank" class="btn  btn-block btn-sm bg-orange btn-flat " style="font-family: verdana">{$pgIm->im_path}{$pgIm->im_name}</a>
                                <div class="clearfix" ></div>
                                <img  alt="{$pgIm->im_name}" src="{$pgIm->im_path}{$pgIm->im_name}"   >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        {/foreach}
        <div class="clearfix" ></div>
        </p>
    </div><!-- /.box-body -->
</div><!-- /.box -->