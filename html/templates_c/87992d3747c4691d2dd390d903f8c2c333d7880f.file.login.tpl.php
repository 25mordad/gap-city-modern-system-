<?php /* Smarty version Smarty-3.0.8, created on 2016-08-14 18:39:41
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/auth/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145540080757b07ba54a4995-59462583%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87992d3747c4691d2dd390d903f8c2c333d7880f' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/auth/login.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145540080757b07ba54a4995-59462583',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl/head.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<body class="bg-black">

<div class="form-box" id="login-box">
    <div class="header">
سیستم مدیریت محتوای تحت وب گاتریا
    </div>
    <div class="body bg-gray">
    <form method="post" action="/login/<?php echo $_smarty_tpl->getVariable('redirect')->value;?>
" id="loginform">

            <div class="form-group">
                <input type="text" name="user" required class="form-control" placeholder="نام کاربری"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" required class="form-control" placeholder="کلمه عبور"/>
            </div>


            <button type="submit" class="btn bg-blue btn-block" >
                ورود
            </button>

            <p><a href="/forgot">
                    کلمه عبور خود را فراموش کرده ام
            </a></p>


    </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#loginform').bootstrapValidator();
        });
    </script>
    <div class="margin text-center">

        <span>
                              تمامی حقوق نـرمـ افـزار متعلق به
                  <a href="http://gatriya.com/" target="_blank">
                      گاتریا
                  </a>
است.
        </span>
        <br>
        Gatriya CMS <?php echo jdate("Y",strtotime("now"));?>
 <i class="fa fa-copyright"></i>
    </div>
</div>


</body>
