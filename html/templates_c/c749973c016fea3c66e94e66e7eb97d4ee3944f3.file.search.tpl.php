<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 06:06:39
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/comment/index/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18100969557d212275f2118-09337674%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c749973c016fea3c66e94e66e7eb97d4ee3944f3' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/comment/index/search.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18100969557d212275f2118-09337674',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="box-tools pull-left">
    <div >

        <form method="get" action="/gadmin/comment/?"  >
            <div class="input-group input-group-sm">
                    <span class="input-group-btn" >
                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                     </span>
                <input type="text" placeholder="عبارت جستجو..."  name="search" id="search" class="form-control" <?php if ($_GET['search']!="NULL"){?>value="<?php echo $_GET['search'];?>
"<?php }?>>
                <?php if ($_GET['search']!="NULL"){?><span class="input-group-addon btn btn-danger"
                                                        data-toggle="tooltip" data-placement="right" title=" حذف عبارت جستجو "
                                                        onclick="window.location = '?paging=1&search=NULL&cm_type=<?php echo $_GET['cm_type'];?>
&cm_status=<?php echo $_GET['cm_status'];?>
'"><i class="fa  fa-close " style="color: white"></i></span><?php }?>
            </div>
            <input type="hidden" name="paging" value="1" />
            <input type="hidden" name="cm_type" value="<?php echo $_GET['cm_type'];?>
" />
            <input type="hidden" name="cm_status" value="<?php echo $_GET['cm_status'];?>
" />
        </form>
    </div>
</div>