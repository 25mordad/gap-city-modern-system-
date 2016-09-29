<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
لیست منوها
                </h3>
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm color-white" href="/gadmin/menu/new">
                        ایجاد منو جدید
                    </a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
ترتیب منو
                        </th>
                        <th>
عنوان منو
                        </th>
                        <th>
منوی مادر
                        </th>

                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $menus as $menu}
                    <tr>
                        <td>{$menu->order}</td>
                        <td>{$menu->title}</td>
                        <td>{if $menu->parent}<a href="menu/edit/{$menu->parent}">{$main_menu[$menu->parent]}</a>{else}ندارد{/if}</td>
                        <td>
                            <button class="btn btn-xs bg-navy" data-toggle="tooltip" data-placement="top" onclick="window.open('{$menu->link}','_blank')" title=" لینک منو ">
                                <i class="ace-icon fa fa-external-link-square bigger-120"></i>
                            </button>
                            <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/menu/edit/{$menu->id}'" title=" ویرایش ">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                            </button>
                            <button class="btn btn-xs btn-danger" id="DelMenuBtt{$menu->id}" data-toggle="tooltip" data-placement="top"  title=" حذف ">
                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                            </button>
                            <script>
                                $(document).on("click", "#DelMenuBtt{$menu->id}", function(e) {
                                    bootbox.dialog ({
                                        message: " آیا از حذف این منو مطمئن هستید؟  ",
                                        buttons: {
                                            success: {
                                                label: "بله",
                                                className: "btn-danger",
                                                callback: function() {
                                                    window.location.href = "/gadmin/menu/del/{$menu->id}";
                                                }
                                            },
                                            main: {
                                                label: "انصراف",
                                                className: "btn-primary"
                                            }
                                        }
                                    })
                                });
                            </script>
                        </td>
                    </tr>
                    {/foreach}
                    </tbody></table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>