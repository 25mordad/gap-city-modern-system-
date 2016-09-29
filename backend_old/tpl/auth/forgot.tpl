<head>
<base href="/gadmin/" />
<!-- META -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- META -->
<!-- CSS -->
<link href="{$loct}/css/reset.css" rel="stylesheet" type="text/css" />
<link href="{$loct}/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{$loct}/css/jquery.jscrollpane.css" media="all" />
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="{$loct}/css/style_ie_fix.css" />
<![endif]-->
<!-- CSS -->
<!--[if lte IE 8]>
<link href="{$loct}/css/fix_ie6.css" rel="stylesheet" type="text/css" />
<script>
alert("شما از مرورگر اینترنت اکسپلورر بسیار قدیمی استفاده می کنید");
window.location = "http://updateyourbrowser.gatriya.com/"
</script>
<![endif]-->
<!-- JS -->
<script type="text/javascript" src="{$loct}/js/jquery.min.js"></script>
<!-- JS -->
<title>GCMS :: سیستم مدیریت محتوای تحت وب گاتریا :: Gatriya.com</title>
</head>
<body style="background: #999999;">
    <div class="center">

  		<div class="wrapper "  >
  		    <style>
              .login { background: url({$loct}/images/login.png) no-repeat ; width: 770px; height:600px; margin: 0 auto; }
              .l_f { width: 355px; height: 160px; margin: 390px 205px 0 0; float: right;}

              .login_form label { width: 100px; float: right;font-family: BYekan; font-size:16px; margin-right: 20px; color: #333333; margin-top: 5px;}
              .login_form input { width: 200px; border: 1px solid #cccccc;border-radius: 5px; padding: 5px 10px 5px 10px; margin-top: 5px; color: #cccccc;direction:ltr;}
              .login_form input:focus { color: #333333; border: 1px solid #333333;}
              .login_form input[type=submit] { background: url({$loct}/images/login_btt.png) bottom no-repeat ; text-align: center; margin: 10px 50px 0 0; width: 271px; height: 28px; padding: 0;font-family: BYekan; font-size:16px; cursor: pointer; border-radius: 5px; }
               .login_form input[type=submit]:hover{ box-shadow: 0 0 10px red;background: url({$loct}/images/login_btt.png) top no-repeat}
               .l_f span { background: url({$loct}/images/forgot.png) bottom no-repeat ; text-align: center; margin: 10px 50px 0 0; width: 271px; height: 20px; padding: 10px 0 ;  cursor: pointer; border-radius: 5px; float: right; color: white; }
               .l_f span:hover { background: url({$loct}/images/forgot.png) top }
    input.error:focus ,
	input.error { border: 1px solid red; }
    label.error { font-family: tahoma; font-size: 9px; margin: -10px 10px 0 0; color: red; }

	      		.auth_alarm { position: absolute; top: 50px; }
            </style>
  			<div class="auth_alarm">{include file="tpl/alert.tpl"}</div>

            <div class="login ">
                <div class="l_f ">
                <script type="text/javascript" src="{$loct}/js/jquery.validate.js"></script>
                {literal}
                <script>
                  $(document).ready(function(){
                    $("#loginform").validate({
                  rules: {
                    user    : "required" ,
                    email	: "required email"
                  }
                });
                  });
                  </script>
                  {/literal}
                    <form method="post" action="/forgot" class="login_form" id="loginform">
                        <label for="user">نام کاربری</label>
                        <input type="text" name="user" id="user"  />

                        <label for="email">ایمیل</label>
                        <input type="email" name="email" id="email"  />

                        <input type="submit" name="submit" value="بازیابی کلمه عبور"  />
                        <div class="clear"></div>
                    </form>
                    <a href="/login"><span>بازگشت به صفحه ورود</span></a>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
  		</div>
  	</div>
    <div class="footer ">
  		<div class="wrapper" >
  		    <div class="f_menu">

            </div>
            <div class="clear"></div>
            <div class="right copyright">
                <a href="http://gatriya.com" target="_blank">گاتریا</a>
                 ؛  سـیـسـتـمـ مـدیـریـتـ مـحـتـوا تحت وبـــ ::
                  تمامی حقوق نـرمـ افـزار متعلق به
                  <a href="http://rses.ir/" target="_blank">آرســـس</a>
                  مـی باشد.
            </div>
            <div class="left cp_img"></div>
            <div class="clear"></div>
  		</div>
  	</div>
</body>