<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            اطلاعات دیدگاه
        </h3>
    </div>
    <div class="box-body">
        <p>

            <span data-toggle="tooltip" data-placement="left" title=" نویسنده "><i class="fa fa-pencil" ></i> {$comment->cm_author}</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" ایمیل "><i class="fa fa-envelope" ></i> {$comment->cm_email}</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" کشور ">
            <img src="http://ipinfodb.com/img/flags/{strtolower($countryCode['countryCode'])}.gif" /> {$countryCode['countryName']}
            </span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" شهر "><i class="fa fa-map-marker" ></i> {$countryCode['regionName']} | {$countryCode['cityName']}</span>
            <br>
            <span class="verdana" data-toggle="tooltip" data-placement="left" title=" شناسه "> {$comment->cm_ip }</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" تاریخ ارسال "><i class="fa fa-clock-o" ></i> {jdate(" l j F Y",strtotime($comment->cm_date))}</span>
            <br>
            {$arr_types = [
            'page'=>"صفحات",
            'news' => "اخبار",
            'gallery' => "گالری عکس",
            'sound' => "گالری صوتی"
            ]}
            <span data-toggle="tooltip" data-placement="left" title="  مکان (بخش » صفحه)  ">{$arr_types[$comment->cm_type]} &raquo; <a href="/gadmin/{$comment->cm_type}/edit/{$comment->id_other}">{showtitle id=$comment->id_other chagetoplus="false" }</a></span>
            <br>
            {if $comment->cm_status neq "delete"}
                <a href="#" id="DelCommentBtt" class="btn btn-danger btn-sm " role="button">حذف دیدگاه</a>
            {else}
                <a href="#" id="unDelCommentBtt" class="btn btn-warning btn-sm " role="button">بازیابی دیدگاه</a>
            {/if}

            <script>
                $(document).on("click", "#unDelCommentBtt", function(e) {
                    bootbox.dialog ({
                        message: " آیا از بازیابی این دیدگاه مطمئن هستید؟  ",
                        buttons: {
                            success: {
                                label: "بله",
                                className: "btn-danger",
                                callback: function() {
                                    window.location.href = "/gadmin/comment/undel/{$comment->id}";
                                }
                            },
                            main: {
                                label: "انصراف",
                                className: "btn-primary"
                            }
                        }
                    })
                });
                $(document).on("click", "#DelCommentBtt", function(e) {
                    bootbox.dialog ({
                        message: " آیا از حذف این دیدگاه مطمئن هستید؟  ",
                        buttons: {
                            success: {
                                label: "بله",
                                className: "btn-danger",
                                callback: function() {
                                    window.location.href = "/gadmin/comment/del/{$comment->id}";
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
