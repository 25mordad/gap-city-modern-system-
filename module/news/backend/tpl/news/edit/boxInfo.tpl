<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            اطلاعات خبر
        </h3>
    </div>
    <div class="box-body">
        <p>

            <span data-toggle="tooltip" data-placement="left" title=" نویسنده "><i class="fa fa-pencil" ></i> {$operator->name}</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" تاریخ ایجاد صفحه "><i class="fa fa-clock-o" ></i> {jdate(" l j F Y",strtotime($page->date_created))}</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" تاریخ آخرین تغییر "><i class="fa fa-clock-o" ></i> {jdate(" l j F Y",strtotime($page->date_modified))}</span>
            <br>
            {if $page->pg_status neq "delete"}
                <a href="#" id="DelPageBtt" class="btn btn-danger btn-sm " role="button">حذف خبر</a>
            {else}
                <a href="#" id="unDelPageBtt" class="btn btn-warning btn-sm " role="button">بازیابی خبر</a>
            {/if}

            <script>
                $(document).on("click", "#unDelPageBtt", function(e) {
                    bootbox.dialog ({
                        message: " آیا از بازیابی این خبر مطمئن هستید؟  ",
                        buttons: {
                            success: {
                                label: "بله",
                                className: "btn-danger",
                                callback: function() {
                                    window.location.href = "/gadmin/news/undel/{$page->id}";
                                }
                            },
                            main: {
                                label: "انصراف",
                                className: "btn-primary"
                            }
                        }
                    })
                });
                $(document).on("click", "#DelPageBtt", function(e) {
                    bootbox.dialog ({
                        message: " آیا از حذف این خبر مطمئن هستید؟  ",
                        buttons: {
                            success: {
                                label: "بله",
                                className: "btn-danger",
                                callback: function() {
                                    window.location.href = "/gadmin/news/del/{$page->id}";
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

        </p>
    </div>
</div>
<!--  ******  -->
