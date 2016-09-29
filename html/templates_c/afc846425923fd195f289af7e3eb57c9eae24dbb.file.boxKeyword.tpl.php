<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 01:44:31
         compiled from "/var/www/gcms.dev/public_html/core/module/gallery/backend/tpl/gallery/edit/boxKeyword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30389709857cde037390738-44656658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'afc846425923fd195f289af7e3eb57c9eae24dbb' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/gallery/backend/tpl/gallery/edit/boxKeyword.tpl',
      1 => 1447715362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30389709857cde037390738-44656658',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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
                    var scriptUrl = "/gadmin/page/edit/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
/AjaxController?controller=get_keywords&id=" + <?php echo $_smarty_tpl->getVariable('page')->value->id;?>
;
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
                            $.post( "/gadmin/gallery/edit/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
/AjaxController?controller=add_keyword", { key_id: item.id, page_id: "<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
" }, function(data){
                                item.rel_id = data;
                            });
                        },
                        onDelete: function (item) {
                            $.post( "/gadmin/gallery/edit/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
/AjaxController?controller=del_keyword", { id: item.rel_id });
                        },
                        onNew: function (item) {
                            $.post("/gadmin/gallery/edit/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
/AjaxController?controller=new_keyword", { kw_title: item, page_id: "<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
"}, function(data){
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
