<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            کلمات کلیدی
        </h3>
    </div>
    <div class="box-body">
        <p>
            <input type="text" id="demo-input-facebook-theme" name=""  />
            <script type="text/javascript">
                $(document).ready(function() {
                    $("input[type=button]").click(function () {
                        alert("Would submit: " + $(this).siblings("input[type=text]").val());
                    });
                    var result = null;
                    var scriptUrl = "/gadmin/page/edit/{$page->id}/AjaxController?controller=get_keywords&id=" + {$page->id};
                    $.ajax({
                        url: scriptUrl,
                        type: 'get',
                        dataType: 'html',
                        async: false,
                        success: function(data) {
                            result = eval(data);
                        }
                    });
                    $("#demo-input-facebook-theme").tokenInput(document.URL+ "/AjaxController?controller=get_suggestions", {
                        prePopulate: result,
                        onAdd: function (item) {
                            $.post( "/gadmin/page/edit/{$page->id}/AjaxController?controller=add_keyword", { key_id: item.id, page_id: "{$page->id}" }, function(data){
                                item.rel_id = data;
                            });
                        },
                        onDelete: function (item) {
                            $.post( "/gadmin/page/edit/{$page->id}/AjaxController?controller=del_keyword", { id: item.rel_id });
                        },
                        onNew: function (item) {
                            $.post("/gadmin/page/edit/{$page->id}/AjaxController?controller=new_keyword", { kw_title: item, page_id: "{$page->id}"}, function(data){
                                $("#demo-input-facebook-theme").tokenInput("add", eval(data));
                            });
                        }
                    });
                });
            </script>
        <div class="clearfix" ></div>
        </p>
    </div>
</div>
<!--  ******  -->
