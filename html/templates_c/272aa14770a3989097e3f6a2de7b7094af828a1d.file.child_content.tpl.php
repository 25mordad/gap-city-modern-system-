<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 01:28:16
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/page/child_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139478787857cddc68d338a4-02912955%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '272aa14770a3989097e3f6a2de7b7094af828a1d' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/page/child_content.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139478787857cddc68d338a4-02912955',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!isset($_smarty_tpl->getVariable('pagepaging',null,true,false)->value)){?><?php $_smarty_tpl->tpl_vars['pagepaging'] = new Smarty_variable(1, null, null);?><?php }?>
<?php $_smarty_tpl->tpl_vars['show_no'] = new Smarty_variable(10, null, null);?>
<?php $_smarty_tpl->tpl_vars['limit_from'] = new Smarty_variable((($_smarty_tpl->getVariable('pagepaging')->value*$_smarty_tpl->getVariable('show_no')->value)-$_smarty_tpl->getVariable('show_no')->value), null, null);?>
<?php $_smarty_tpl->tpl_vars['limit_to'] = new Smarty_variable($_smarty_tpl->getVariable('show_no')->value*$_smarty_tpl->getVariable('pagepaging')->value, null, null);?>
<?php $_smarty_tpl->tpl_vars['page_num'] = new Smarty_variable(ceil(count($_smarty_tpl->getVariable('all_parent')->value)/$_smarty_tpl->getVariable('show_no')->value), null, null);?>

            <script type="text/javascript">
            $('document').ready(function(){
            	scrollalert();
            });

            function scrollalert(){
                var s_p = $(window).scrollTop();
                var d_h = $(document).height();
                var w_h = $(window).height();
            	var scrolloffset=100;
            	if( s_p>=(d_h-(w_h+scrolloffset)) )
            	{
            		$.get('?pagepaging=<?php echo $_smarty_tpl->getVariable('pagepaging')->value+1;?>
', '', function(newitems){
            			$('.childslist').append(newitems);
            			
            		});
            	}
            	 timer =  setTimeout('scrollalert();', 1500);          
            }
            function stoper() {
                clearTimeout(timer);
            }
            <?php if ($_smarty_tpl->getVariable('pagepaging')->value>$_smarty_tpl->getVariable('page_num')->value-1){?>
            stoper();
            function scrollalert(){}
            <?php }?> 
            
            </script> 
<div class="list-group childslist">

    <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['name'] = 'mypage';
$_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['start'] = (int)$_smarty_tpl->getVariable('limit_from')->value;
$_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('limit_to')->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['iteration'] = 1;
            $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['total'];
            $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['mypage']['total']);
?>

    <?php if (isset($_smarty_tpl->getVariable('all_parent',null,true,false)->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['mypage']['index']])){?>

    <?php $_smarty_tpl->tpl_vars['prnt'] = new Smarty_variable($_smarty_tpl->getVariable('all_parent')->value[$_smarty_tpl->getVariable('smarty')->value['section']['mypage']['index']], null, null);?>

    <a href="/page/show/<?php echo $_smarty_tpl->getVariable('prnt')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('prnt')->value->pg_title),$_smarty_tpl);?>
" class="list-group-item ">
        <h4 class="list-group-item-heading"><?php echo $_smarty_tpl->getVariable('prnt')->value->pg_title;?>
</h4>
        <p class="list-group-item-text">
            <?php ob_start();?><?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('prnt')->value->id,'type'=>"page",'thumb'=>"thumb/",'source'=>"true"),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1!="/uploads/index/defult/defult.jpg"){?>
                <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('prnt')->value->id,'type'=>"page",'thumb'=>"thumb/",'source'=>"true"),$_smarty_tpl);?>
" class="pull-left img-rounded img-thumbnail"   >
            <?php }?>
            <?php echo $_smarty_tpl->getVariable('prnt')->value->pg_excerpt;?>

        <div class="clearfix" ></div>
        </p>
    </a>

    <?php }?>

    <?php endfor; endif; ?>
</div>

