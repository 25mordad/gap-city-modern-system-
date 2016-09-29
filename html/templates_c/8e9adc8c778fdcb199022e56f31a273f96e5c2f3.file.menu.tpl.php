<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 06:23:37
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:47394667157d21621380400-09516017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e9adc8c778fdcb199022e56f31a273f96e5c2f3' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/menu.tpl',
      1 => 1473386016,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '47394667157d21621380400-09516017',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars fa-2x"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">
                <img src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/img/HayatiLogo.png" width="250" alt="HayatiGroup">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="#page-top">HOME</a>
                </li>
                <li>
                    <a class="page-scroll" href="#about">About Us</a>
                </li>
                <li>
                    <a class="page-scroll" href="#project">Products</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contact us</a>
                </li>
                <li>
                    <a class="page-scroll" href="#" data-toggle="modal" data-target="#myModal">Webmail</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" tabindex="-1" id="myModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">webmail Login</h4>
      </div>
      <div class="modal-body" >
        		<div id="forms">


                        <form target="_blank" method="post" action="https://ob2.hostgator.com:2096/login/" id="login_form" >
                            <div class="input-req-login user-label"><label for="user">Email Address</label></div>
                            <div class="input-field-login icon username-container">
                                <input type="text" required="" tabindex="1" class="std_textbox" placeholder="Enter your email address." value="" autofocus="autofocus" id="user" name="user" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAVVJREFUOBGlUr9LhWAUvf5AZ6eWGt2CDEFEGjMI+id6Q9DY2xoEdWmqKYIe9Cc0NbZFQ1NIq0vx3CycDdTOpXh8+j1s8IMj5xzvvd77eYkmnDiO79UJ+Zy6oaPKAcgl8A4cQ38CAfg18PXnFWma7rRtu4D+1jRtFkVRDk7cwV3XddvAEficTZwb6F1gHzxiA8lX0B6w1zTNBXt8po5AqqIoM+ANeDAMg0chVVVPoV+BR13XU/ZwzqBfgCeMcP5rTXzirp6VYY0kSQ4x5y2wNXwnanSyRMyHLprMYS6AzaE/1PwBFFGkS1yXbNs2eZ5Hpmn26nCs1IEYgQ9QGIYUBLwWRHmeU13XYsj4b3Qch3zfp6qqekmiGO0gyzIqy5Jc1yXLssS8FZfuYPUGBDNSURSiJfHRAlL0GmNyAWmRsF28IP/uATeDv1RIHcA8AZZruu1ZHMOxP66qe9DAZLEcAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                            </div>
                            <div class="input-req-login user-pw" style="margin-top:15px;"><label for="pass">Password</label></div>
                            <div class="input-field-login icon password-container">
                                <input type="password" required="" tabindex="2" class="std_textbox" placeholder="Enter your email password." id="pass" name="pass" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAVVJREFUOBGlUr9LhWAUvf5AZ6eWGt2CDEFEGjMI+id6Q9DY2xoEdWmqKYIe9Cc0NbZFQ1NIq0vx3CycDdTOpXh8+j1s8IMj5xzvvd77eYkmnDiO79UJ+Zy6oaPKAcgl8A4cQ38CAfg18PXnFWma7rRtu4D+1jRtFkVRDk7cwV3XddvAEficTZwb6F1gHzxiA8lX0B6w1zTNBXt8po5AqqIoM+ANeDAMg0chVVVPoV+BR13XU/ZwzqBfgCeMcP5rTXzirp6VYY0kSQ4x5y2wNXwnanSyRMyHLprMYS6AzaE/1PwBFFGkS1yXbNs2eZ5Hpmn26nCs1IEYgQ9QGIYUBLwWRHmeU13XYsj4b3Qch3zfp6qqekmiGO0gyzIqy5Jc1yXLssS8FZfuYPUGBDNSURSiJfHRAlL0GmNyAWmRsF28IP/uATeDv1RIHcA8AZZruu1ZHMOxP66qe9DAZLEcAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                            </div>
                            <div id="button_container" style="width: 285px;">
                                <div class="login-btn">
                                    <button tabindex="3" id="login_submit" type="submit" name="login">Log in</button>
                                </div>
                            </div>
                            <div id="push" class="clear"></div>
                        </form>

                    <!--CLOSE forms -->
                    </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->