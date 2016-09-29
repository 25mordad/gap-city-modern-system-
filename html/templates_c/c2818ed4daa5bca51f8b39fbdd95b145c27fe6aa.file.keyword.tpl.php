<?php /* Smarty version Smarty-3.0.8, created on 2016-08-21 21:20:29
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/edit/keyword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:146746511157b9dbd5ab8ff9-96315455%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2818ed4daa5bca51f8b39fbdd95b145c27fe6aa' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/edit/keyword.tpl',
      1 => 1471798225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146746511157b9dbd5ab8ff9-96315455',
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
                    var scriptUrl = "/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/AjaxController?controller=get_keywords&id=" + <?php echo $_smarty_tpl->getVariable('product')->value->id;?>
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
                            $.post( "/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/AjaxController?controller=add_keyword", { key_id: item.id, product_id: "<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" }, function(data){
                                item.rel_id = data;
                            });
                        },
                        onDelete: function (item) {
                            $.post( "/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/AjaxController?controller=del_keyword", { id: item.rel_id });
                        },
                        onNew: function (item) {
                            $.post("/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/AjaxController?controller=new_keyword", { kw_title: item, product_id: "<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
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
