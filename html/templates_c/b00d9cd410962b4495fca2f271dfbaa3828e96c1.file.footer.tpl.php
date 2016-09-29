<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 06:51:16
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:138353786557d21c9c227dc5-61904488%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b00d9cd410962b4495fca2f271dfbaa3828e96c1' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/footer.tpl',
      1 => 1473387668,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138353786557d21c9c227dc5-61904488',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<section id="contact2" class="container-fluid text-center">
    <div class="col-lg-6 col-lg-offset-3">
    <p>
         <span style="font-weight: bolder;padding: 5px">Visitors: <?php echo $_smarty_tpl->getVariable('static_key_getPageviews')->value;?>
</span> 
         <span style="font-weight: bolder;padding: 5px 5px 5px 200px">Today: <?php echo date('d/m/Y',strtotime('now'));?>
</span>
         </p>
        <ul class="list-inline lead">
            <li><a href="https://www.instagram.com/Hayatigroup/" target="_blank"><i class="fa fa-instagram fa-inverse fa-2x fa-fw"></i></a></li>
            <li><a href="http://hayatigroup.trustpass.alibaba.com/" target="_blank"><img
            style="margin: -20px 0 0 0"
             src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/img/alb.png" alt="alibaba"></a></li>
        </ul>
        <p>
         <br>
        Copyright &copy; <a href="http://hayatigroup.com/" >hayatigroup.com</a> :: All Rights Reserved © <?php echo date('Y',strtotime('now'));?>

        <br><a  href="http://gatriya.com" target="_blank" title="گاتریا">
            Powered By Gatriya
        </a>
        </p>
    </div>
</section>