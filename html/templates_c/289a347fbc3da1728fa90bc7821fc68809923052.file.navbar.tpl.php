<?php /* Smarty version Smarty-3.0.8, created on 2016-09-22 02:47:13
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/navbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187297910757e314f9026473-17884003%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '289a347fbc3da1728fa90bc7821fc68809923052' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/navbar.tpl',
      1 => 1474499831,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187297910757e314f9026473-17884003',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Fixed navbar start -->
<div class="navbar navbar-tshop navbar-fixed-top megamenu" role="navigation">
	<?php $_template = new Smarty_Internal_Template("tpl/top.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php $_template = new Smarty_Internal_Template("tpl/menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

    <div class="search-full text-right"><a class="pull-right search-close"> <i class=" fa fa-times-circle"> </i> </a>

        <div class="searchInputBox pull-right">
            <input type="search" onkeypress="checkInterMain(event);" id="qInputMain"  name="q" placeholder="کلمه جستجو را وارد کنید و فقط دکمه اینتر را بزنید."
                   class="search-input" style="font-family: Gandom;" >
            <button class="btn-nobg search-btn" type="button"><i class="fa fa-search"> </i></button>
        </div>
    </div>
    <!--/.search-full-->
					<script type="text/javascript">
                             function goSearchMain() {
                             	
                             	qInputMain = document.getElementById('qInputMain').value;
                             	
                             	window.location = "/shop/searchProduct/?paging=1&q="+qInputMain+"&barcode=NULL&brand=ALL";
					}
                             function checkInterMain(e) {
                             	if(e.keyCode == 13)
                             		goSearchMain();
					}
                             </script>
</div>
<!-- /.Fixed navbar  -->
